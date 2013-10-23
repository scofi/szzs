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
include_once(ROOT_PATH . 'include/upload.class.php');

$images_dir = 'data/slide/'; //文件上传路径 结尾加斜杠
$thumb_dir = 'thumb/'; //缩略图路径（必须在$images_dir下建立） 结尾加斜杠
$img = new Upload(ROOT_PATH . $images_dir, $thumb_dir); //实例化类文件

/* rec操作项的初始化 */
if (empty ($_REQUEST['rec']))
{
	$_REQUEST['rec'] = 'default';
}
else
{
	$_REQUEST['rec'] = trim($_REQUEST['rec']);
}

/* rec操作项的初始化 */
$rec = trim($_REQUEST['rec']);
$smarty->assign('cur', 'ad');

/* 对页面进行相应赋值 */
$smarty->assign('rec', $rec);
$smarty->assign('ur_here', $_LANG['ad']);
$smarty->assign('ad_list', get_ad_list());

/**
 +----------------------------------------------------------
 * 幻灯列表
 +----------------------------------------------------------
 */
if ($_REQUEST['rec'] == 'default')
{
  $smarty->display('ad.htm');
}

/**
 +----------------------------------------------------------
 * 幻灯添加处理
 +----------------------------------------------------------
 */
elseif ($rec == 'insert')
{
	/* 上传图片生成 */
	$name = date('Ymd');
	for ($i = 0; $i < 6; $i++)
	{
		$name .= chr(mt_rand(97, 122));
	}

	$upfile = $img->upload_image('ad_img', "$name"); //上传的文件域
	$file = $images_dir . $upfile;
	$img->to_file = true;
	$img->make_thumb($upfile, 100, 100);

	$sql = "INSERT INTO " . $dou->table('ad') . " (id, ad_name, ad_link, ad_img, sort)" .
	" VALUES (NULL, '$_POST[ad_name]', '$_POST[ad_link]', '$file', '$_POST[sort]')";
	$dou->query($sql);

	$dou->create_admin_log($_LANG['ad_add'] . ": " . $_POST[ad_name]);
	$dou->dou_msg($_LANG['ad_add_succes'], 'ad.php');
}

/**
 +----------------------------------------------------------
 * 幻灯编辑
 +----------------------------------------------------------
 */
elseif ($rec == 'edit')
{
	$id = trim($_REQUEST['id']);
	$query = $dou->select($dou->table('ad'), '*', '`id` = \'' . $id . '\'');
	$ad = $dou->fetch_array($query);

	$smarty->assign('id', $id);
	$smarty->assign('ad', $ad);
	
  $smarty->display('ad.htm');
}

elseif ($rec == 'update')
{
	/* 分析广告图片名称 */
	$basename = basename($_POST['ad_img']);
	$file_name = substr($basename, 0, strrpos($basename, '.'));

	/* 上传图片生成 */
	if ($_FILES['ad_img']['name'] != "")
	{
		$upfile = $img->upload_image('ad_img', "$file_name"); //上传的文件域
		$file = $images_dir . $upfile;
		$img->to_file = true;
		$img->make_thumb($upfile, 100, 100);

		$up_file = ", image='$file'";
	}

	$sql = "update " . $dou->table('ad') . " SET ad_name='$_POST[ad_name]'" . $up_file . " ,ad_link = '$_POST[ad_link]', sort = '$_POST[sort]' WHERE id = '$_POST[id]'";
	$dou->query($sql);

	$dou->create_admin_log($_LANG['ad_edit'] . ": " . $_POST[ad_name]);

	$dou->dou_msg($_LANG['ad_edit_succes'], 'ad.php');
}

/**
 +----------------------------------------------------------
 * 幻灯删除
 +----------------------------------------------------------
 */
elseif ($rec == 'del')
{
	$id = trim($_REQUEST['id']);
	$ad_name = $dou->get_one("SELECT ad_name FROM " . $dou->table('ad') . " WHERE id = '$id'");

	if ($_POST['confirm'])
	{
		/* 删除相应商品图片 */
		$ad_img = $dou->get_one("SELECT ad_img FROM " . $dou->table('ad') . " WHERE id = '$id'");
		$file_name = basename($ad_img);
		$image = explode(".", $file_name);
		$ad_img_thumb = $images_dir . $thumb_dir . $image['0'] . "_thumb." . $image['1'];
		@unlink(ROOT_PATH . $ad_img);
		@unlink(ROOT_PATH . $ad_img_thumb);

		$dou->create_admin_log($_LANG['ad_del'] . ": " . $ad_name);
		$dou->delete($dou->table('ad'), "id = $id", 'ad.php');
	}
	else
	{
		$_LANG['del_check'] = preg_replace('/d%/Ums', $ad_name, $_LANG['del_check']);
		$dou->dou_msg($_LANG['del_check'], 'ad.php', '', '30', "ad.php?rec=del&id=$id");
	}
}

/**
 +----------------------------------------------------------
 * 获取下级幻灯列表
 +----------------------------------------------------------
 */
function get_ad_list()
{
	$sql = "SELECT * FROM " . $GLOBALS['dou']->table('ad') . " ORDER BY sort ASC, id ASC";
	$query = $GLOBALS['dou']->query($sql);
	while ($row = $GLOBALS['dou']->fetch_array($query))
	{
		$file_name = basename($row['ad_img']);
		$image = explode(".", $file_name);
		$thumb = ROOT_URL . $GLOBALS['images_dir'] . $GLOBALS['thumb_dir'] . $image['0'] . "_thumb." . $image['1'];

		$ad_list[] = array (
			"id" => $row['id'],
			"ad_name" => $row['ad_name'],
			"ad_link" => $row['ad_link'],
			"ad_img" => $row['ad_img'],
			"thumb" => $thumb,
			"sort" => $row['sort']
		);
	}

	return $ad_list;
}


?>