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

/* rec操作项的初始化 */
if (empty ($_REQUEST['rec']))
{
	$_REQUEST['rec'] = 'default';
}
else
{
	$_REQUEST['rec'] = trim($_REQUEST['rec']);
}

$smarty->assign('rec', $_REQUEST['rec']);
$smarty->assign('cur', 'nav');

/**
 +----------------------------------------------------------
 * 导航列表
 +----------------------------------------------------------
 */
if ($_REQUEST['rec'] == 'default')
{
	$smarty->assign('ur_here', $_LANG['nav']);
	$smarty->assign('action_link', array (
		'text' => $_LANG['nav_add'],
		'href' => 'nav.php?rec=add'
	));

	/* 获得请求的导航类型 */
	$type = $_REQUEST['type'] ? trim($_REQUEST['type']) : 'middle';
	
	$smarty->assign('type', $type);

	$sql = "SELECT * FROM " . $dou->table('nav') . " WHERE parent_id = '0' AND type = '$type' ORDER BY sort, id ASC";
	$query = $dou->query($sql);
	
	while ($row = $dou->fetch_array($query))
	{
		$child = $dou->get_nav_child($row['id']);

		if ($row['module'] == 'nav')
		{
			$guide = $row['guide'];
		}
		else
		{
			$guide = $dou->rewrite_url($row['module'], $row['guide']);
		}

		$nav_list[] = array (
			"id" => $row['id'],
			"nav_name" => $row['nav_name'],
			"guide" => $guide,
			"sort" => $row['sort'],
			"child" => $child
		);
	}

	$smarty->assign('nav_list', $nav_list);
	$smarty->display('nav.htm');
}

/**
 +----------------------------------------------------------
 * 导航添加处理
 +----------------------------------------------------------
 */
elseif ($_REQUEST['rec'] == 'add')
{
	$smarty->assign('ur_here', $_LANG['nav']);
	$smarty->assign('action_link', array (
		'text' => $_LANG['nav_list'],
		'href' => 'nav.php'
	));

	//初始化导航调用到的数据
	$page_list = $dou->get_page_list();
	$product_list = $dou->get_product_category();
	$article_list = $dou->get_article_category();
	$nav_list = $dou->get_nav_child(0);

	$smarty->assign('page_list', $page_list);
	$smarty->assign('product_list', $product_list);
	$smarty->assign('article_list', $article_list);
	$smarty->assign('nav_list', $nav_list);
	$smarty->display('nav.htm');
}

elseif ($_REQUEST['rec'] == 'insert')
{
	$nav_menu = explode(",", $_POST[nav_menu]);
	$module = $nav_menu[0];
	
	if ($module == 'nav')
	{
		$guide = $dou->auto_http(trim($_POST['guide']));
		$nav_name = $_POST[nav_name];
	}
	else
	{
		$guide = $nav_menu[1];
		$nav_name = $nav_menu[2];
	}

	$sql = "INSERT INTO " . $dou->table('nav') . " (id, module, nav_name, guide, parent_id, type, sort)" .
	" VALUES (NULL, '$module', '$nav_name', '$guide', '$_POST[parent_id]', '$_POST[type]', '$_POST[sort]')";
	$dou->query($sql);

	$dou->create_admin_log($_LANG['nav_add'] . ": " . $nav_name);

	$dou->dou_msg($_LANG['nav_add_succes'], "nav.php?type=" . $_POST[type]);
}

/**
 +----------------------------------------------------------
 * 导航编辑
 +----------------------------------------------------------
 */
elseif ($_REQUEST['rec'] == 'edit')
{
	$smarty->assign('ur_here', $_LANG['nav']);
	$smarty->assign('action_link', array (
		'text' => $_LANG['nav_list'],
		'href' => 'nav.php'
	));

	$id = trim($_REQUEST['id']);
	$query = $dou->select($dou->table('nav'), '*', '`id` = \'' . $id . '\'');
	$nav_info = $dou->fetch_array($query);

	if ($nav_info['module'] == 'nav')
	{
		$nav_info['guide'] = $nav_info['guide'];
	}
	else
	{
		$nav_info['guide'] = $dou->rewrite_url($nav_info['module'], $nav_info['guide']);
	}

	//初始化导航调用到的数据
	$page_list = $dou->get_page_list();
	$product_list = $dou->get_product_category();
	$article_list = $dou->get_article_category();
	$nav_list = $dou->get_nav_child('0', $nav_info['type'], $id);

	$smarty->assign('page_list', $page_list);
	$smarty->assign('product_list', $product_list);
	$smarty->assign('article_list', $article_list);
	$smarty->assign('nav_list', $nav_list);
	$smarty->assign('nav_info', $nav_info);
	$smarty->display('nav.htm');
}

elseif ($_REQUEST['rec'] == 'update')
{
	/* 上传图片生成 */
	if ($_POST['guide'])
	{
		$_POST['guide'] = $dou->auto_http(trim($_POST['guide']));
		$guide = ", guide='$_POST[guide]'";
	}

	$sql = "update " . $dou->table('nav') . " SET nav_name = '$_POST[nav_name]'" . $guide . ",parent_id = '$_POST[parent_id]', type = '$_POST[type]', sort = '$_POST[sort]' WHERE id = '$_POST[id]'";
	$dou->query($sql);

	$dou->create_admin_log($_LANG['nav_edit'] . ": " . $_POST[nav_name]);

	$dou->dou_msg($_LANG['nav_edit_succes'], "nav.php?type=" . $_POST[type]);
}

/**
 +----------------------------------------------------------
 * 导航删除
 +----------------------------------------------------------
 */
elseif ($_REQUEST['rec'] == 'del')
{
	$id = trim($_REQUEST['id']);

	$nav_name = $dou->get_one("SELECT nav_name FROM " . $dou->table('nav') . " WHERE id = '$id'");
	$is_parent = $dou->get_one("SELECT id FROM " . $dou->table('nav') . " WHERE parent_id = '$id'");
	
	if ($is_parent)
	{
		$_LANG['nav_del_is_parent'] = preg_replace('/d%/Ums', $nav_name, $_LANG['nav_del_is_parent']);
		$dou->dou_msg($_LANG['nav_del_is_parent'], 'nav.php', '', '3');
	}
	else
	{
		if ($_POST['confirm'])
		{
			$dou->create_admin_log($_LANG['nav_del'] . ": " . $nav_name);
			$dou->delete($dou->table('nav'), "id = $id", 'nav.php');
		}
		else
		{
			$_LANG['del_check'] = preg_replace('/d%/Ums', $nav_name, $_LANG['del_check']);
			$dou->dou_msg($_LANG['del_check'], 'nav.php', '', '30', "nav.php?rec=del&id=$id");
		}
	}

}



?>