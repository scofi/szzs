<?php
/**
 * DOUCO TEAM
 * ============================================================================
 * * COPYRIGHT DOUCO 2013-2014.
 * http://www.douco.com;
 * ----------------------------------------------------------------------------
 * Author:DouCo
 * Release Date: 2013-8-28
 */

define('IN_DOUCO', true);

require(dirname(__FILE__) . '/include/init.php');
require(ROOT_PATH . ADMIN_PATH . '/include/backup.class.php');

$smarty->assign('cur', 'backup');

/* 初始化 */
$sqlcharset = str_replace('-', '', DOU_CHARSET);
$dump = new Backup($sqlcharset);

@ set_time_limit(0);

$_REQUEST['rec'] = $_REQUEST['rec'] ? trim($_REQUEST['rec']) : 'default';

/**
 +----------------------------------------------------------
 * 数据备份
 +----------------------------------------------------------
 */
if ($_REQUEST['rec'] == 'default')
{
	$smarty->assign('ur_here', $_LANG['backup']);
	$smarty->assign('action_link', array (
		'text' => $_LANG['backup_restore'],
		'href' => 'backup.php?rec=restore'
	));

	$query = $dou->query("SHOW TABLE STATUS LIKE '" . $prefix . "%'");
	while ($table = $dou->fetch_array($query))
	{
		$table[checked] = $table['Engine'] == 'MyISAM' ? ' ' : 'disabled';
		$totalsize += $table['Data_length'] + $table['Index_length'];

		if ($table['Data_length'] > 10240)
		{
			$table['Data_length'] = ceil($table['Data_length'] / 1024) . "KB";
		}
		$tables[] = $table;
	}
	$totalsize = ceil($totalsize / 1024);
	
	//根据时间生成备份文件名
	$file_name = 'D' . date('Ymd') . 'T' . date('His');
	
	$smarty->assign('tables', $tables);
	$smarty->assign('totalsize', $totalsize);
	$smarty->assign('file_name', $file_name);

}

/**
 +----------------------------------------------------------
 * 数据备份
 +----------------------------------------------------------
 */
if ($_REQUEST['rec'] == 'backup')
{
	$fileid = isset ($_REQUEST['fileid']) ? $_REQUEST['fileid'] : 1;
	$tables = $_REQUEST['tables'];
	$vol_size = $_REQUEST['vol_size'];
	$totalsize = $_REQUEST['totalsize'];
	$file_name = $_REQUEST['file_name'];

	if ($fileid == 1 && $tables)
	{
		if (!isset ($tables) || !is_array($tables))
		{
			$dou->dou_msg($_LANG['backup_no_select'], 'backup.php');
		}
		$cache_file = ROOT_PATH . 'data/backup/tables.php';
		$content = "<?php\r\n";
		$content .= "\$data = " . var_export($tables, true) . ";\r\n";
		$content .= "?>";
		file_put_contents($cache_file, $content, LOCK_EX);
	}
	else
	{
		include ROOT_PATH . 'data/backup/tables.php';
		$tables = $data;
		if (!$tables)
		{
			$dou->dou_msg($_LANG['backup_no_select'], 'backup.php');
		}
	}

	if ($dou->version() > '4.1' && $sqlcharset)
	{
		$dou->query("SET NAMES '" . $sqlcharset . "';\n\n");
	}

	$sqldump = '';
	$tableid = isset ($_REQUEST['tableid']) ? $_REQUEST['tableid'] - 1 : 0;
	$startfrom = isset ($_REQUEST['startfrom']) ? intval($_REQUEST['startfrom']) : 0;
	$tablenumber = count($tables);

	for ($i = $tableid; $i < $tablenumber && strlen($sqldump) < $vol_size * 1024; $i++)
	{
		$sqldump .= $dump->sql_dumptable($tables[$i], $vol_size, $startfrom, strlen($sqldump));
		$startfrom = 0;
	}

	if (trim($sqldump))
	{
		$sqldump = "-- douweb v1.x SQL Dump Program\n" .
		"-- " . ROOT_URL . "\n" .
		"-- \n" .
		"-- DATE : " . date('Y-m-d H:i:s') . "\n" .
		"-- MYSQL SERVER VERSION : " . $dou->version() . "\n" .
		"-- PHP VERSION : " . PHP_VERSION . "\n" .
		"-- Douweb VERSION : " . $_CFG['dou_version'] . "\n\n" .
		$sqldump;

		$tableid = $i;

		if ($vol_size > $totalsize)
		{
			$sql_file_name = $file_name . '.sql';
		}
		else
		{
			$sql_file_name = $file_name . '_' . $fileid . '.sql';
		}

		$fileid++;

		$bakfile = ROOT_PATH . '/data/backup/' . $sql_file_name;

		if (!is_writable(ROOT_PATH . '/data/backup/'))
		{
			$dou->dou_msg($_LANG['backup_no_save'], 'backup.php');
		}

		file_put_contents($bakfile, $sqldump);
		@ chmod($bakfile, 0777);

		$dou->create_admin_log($_LANG['backup'] . ": " . $sql_file_name);

		$_LANG['backup_file_success'] = preg_replace('/d%/Ums', $sql_file_name, $_LANG['backup_file_success']);
		$dou->dou_msg($_LANG['backup_file_success'], 'backup.php?rec=' . $_REQUEST['rec'] . '&vol_size=' . $vol_size . '&totalsize=' . $totalsize . '&file_name=' . $file_name . '&tableid=' . $tableid . '&fileid=' . $fileid . '&startfrom=' . $startrow);
	}
	else
	{
		@ unlink(ROOT_PATH . 'data/backup/tables.php');
		$dou->dou_msg($_LANG['backup_success'], 'backup.php');
	}

}

/**
 +----------------------------------------------------------
 * 备份删除
 +----------------------------------------------------------
 */
if ($_REQUEST['rec'] == 'del')
{
	$sql_file_name = $_GET['sql_file_name'];

	if ($_POST['confirm'])
	{
	  if (file_exists("../data/backup/" . $sql_file_name))
		{
			@unlink("../data/backup/" . $sql_file_name);
		}

		$dou->create_admin_log($_LANG['backup_del'] . ": " . $sql_file_name);
		$dou->dou_msg($_LANG['backup_del_success'], 'backup.php?rec=restore');
	}
	else
	{
		$_LANG['del_check'] = preg_replace('/d%/Ums', $sql_file_name, $_LANG['del_check']);
		$dou->dou_msg($_LANG['del_check'], 'backup.php?rec=restore', '', '30', "backup.php?rec=del&sql_file_name=$sql_file_name");
	}
}

/**
 +----------------------------------------------------------
 * 备份下载
 +----------------------------------------------------------
 */
if ($_REQUEST['rec'] == 'down')
{
	$sql_file_name = $dou->addslashes_deep($_GET['sql_file_name']);
	ob_clean();
	if ($fp = @ fopen("../data/backup/" . $sql_file_name, 'r'))
	{
		header("Content-type: application/zip");
		header("Content-Disposition: attachment; filename=" . $sql_file_name);
		header("Accept-Ranges: bytes");
		header("Content-Length:" . filesize("backup/" . $sql_file_name));
		header('Content-transfer-encoding: binary');
		while (!@ feof($fp))
			echo fread($fp, 10240);
	}
}

/**
 +----------------------------------------------------------
 * 恢复备份
 +----------------------------------------------------------
 */
if ($_REQUEST['rec'] == 'restore')
{
	$smarty->assign('ur_here', $_LANG['backup_restore']);
	$smarty->assign('action_link', array (
		'text' => $_LANG['backup'],
		'href' => 'backup.php'
	));

	$sqlfiles = glob(ROOT_PATH . 'data/backup/*.sql');

	if (is_array($sqlfiles))
	{
		$prepre = '';
		$info = $infos = array ();
		foreach ($sqlfiles AS $id => $sqlfile)
		{
			if (strpos(basename($sqlfile), '.sql'))
			{
				$sql_file_name = $info['sql_file_name'] = basename($sqlfile);
				if (filesize($sqlfile) < 1048576)
				{
					$info['filesize'] = round(filesize($sqlfile) / 1024, 2) . "K";
				}
				else
				{
					$info['filesize'] = round(filesize($sqlfile) / (1024 * 1024), 2) . "M";
				}
				$info['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));

				if (preg_match('/_([0-9])+\.sql$/', $sql_file_name, $match))
				{
					$info['number'] = $match[1];
				}
				$prepre = $info['pre'];
				$infos[] = $info;
			}
		}
		$smarty->assign('infos', $infos);
	}
}

/**
 +----------------------------------------------------------
 * 从服务器上导入数据
 +----------------------------------------------------------
 */
if ($_REQUEST['rec'] == 'import')
{
	$sql_file_name = $_REQUEST['sql_file_name'];
	preg_match('/(.*)_([0-9])+\.sql$/', $sql_file_name, $match);

	/* 判断是否有分卷 */
	if ($match)
	{
		$fileid = $_REQUEST['fileid'] ? $_REQUEST['fileid'] : 1;
		$sql_file_name = $match['1'] . "_" . $fileid . ".sql";
	}

	$restore_now = preg_replace('/d%/Ums', $sql_file_name, $_LANG['backup_restore_now']);

	$file_path = ROOT_PATH . 'data/backup/' . $sql_file_name;

	/* 判断是否有分卷 */
	if ($match)
	{
		/* 判断SQL文件是否存在 */
		if (file_exists($file_path))
		{
			$sql = file_get_contents($file_path);
			$dump->sql_execute($sql);

			$fileid++;
			$dou->dou_msg($restore_now, "backup.php?rec=" . $_REQUEST['rec'] . "&sql_file_name=" . $sql_file_name . "&fileid=" . $fileid);
		}
		else
		{
			$dou->create_admin_log($_LANG['backup_restore'] . ": " . $sql_file_name);
			$dou->dou_msg($_LANG['backup_restore_success'], 'backup.php?rec=restore');
		}
	}
	else
	{
		$sql = file_get_contents($file_path);
		$dump->sql_execute($sql);

		$dou->create_admin_log($_LANG['backup_restore'] . ": " . $sql_file_name);
		$dou->dou_msg($_LANG['backup_restore_success'], 'backup.php?rec=restore');
	}

}

$smarty->display('backup.htm');
?>
