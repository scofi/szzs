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

/*
 * 获取作品状态信息，默认为1——已经建成作品
 */
$house_status = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;

/**
 * 作品分类只有两种，如果既不是已建成作品，又不是在建工地，则是非法访问
 */
if($house_status!=1 && $house_status!=2){
	header("Location: " . ROOT_URL . "\n");
	exit();
}
/* 作品列表 */
$page  = trim($_REQUEST['page']) ? trim($_REQUEST['page']) : 1;
$limit = $dou->myPager('buildings', 4, $page, 'house_status', $house_status,"_category");
$where = " WHERE house_status = '$house_status'";

$sql = "SELECT * FROM " . $dou->table('buildings') . $where . "ORDER BY  sort_value desc ,add_time desc " . $limit;
$query = $dou->query($sql);

while ($row = $dou->fetch_array($query))
{ 
	$url = $dou->rewrite_url('buildings', $row['id']);

	/* 生成缩略图的文件名 */
	$images 		= explode(" ", $row['house_images']);
	$thumb 			= ROOT_URL .$images[0];
    $row['house_status'] = $row['house_status']==0?"在建工地":"作品案例";
    $row['url']     = $url;
    $row['thumb']	= $thumb;
	$bulidings_list[] = $row;
}

/* 获取meta和title信息 */

$cate_info['keywords'] = $_CFG['site_keywords'];
$cate_info['description'] = $_CFG['site_description'];

$page_title = $house_status==1?"作品案例":"在建工厂";
$smarty->assign('page_title', $page_title);
$smarty->assign('keywords', $cate_info['keywords']);
$smarty->assign('description', $cate_info['description']);

/* 初始化导航栏 */
$smarty->assign('nav_top_list', $dou->get_nav('0', 'buildings', '', 'top'));
$smarty->assign('nav_list', $dou->get_nav('0', 'buildings', $cat_id));
$smarty->assign('nav_bottom_list', $dou->get_nav('0', 'buildings', '', 'bottom'));


/* 初始化数据 */
$smarty->assign('ur_here', $page_title);
$smarty->assign('buildings_title', $page_title);
$smarty->assign('buildings_list', $bulidings_list);

$smarty->display('buildings_category.dwt');
?>