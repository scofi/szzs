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

/* REQUEST获取 */
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;


$query = $dou->select($dou->table("buildings"), '*', '`id` = \'' . $id . '\'');
$buildings = $dou->fetch_array($query);

/* 判断作品ID是否存在 */
if (!$buildings)
{
	header("Location: " . ROOT_URL . "\n");
	exit();
}

/* 生成缩略图的文件名 */
$images = $image = explode(" ", $buildings['house_images']);
for($i = 0; $i<count($images); $i++){
	$image = explode(".", $images[$i]);
	$thumb_images[$i] = ROOT_URL . $image[0] . "_thumb." . $image[1];
}

/*配置作品的图片和缩略图*/
$buildings['images'] = $images;
$buildings['thumb_images'] = $thumb_images;
$buildings['images_count'] = count($images);

/*配置父类导航*/
$buildings['parent_url'] = ROOT_URL."buildings_category.php?id={$buildings['house_status']}";

/*获取设计师信息*/
$query = $dou->select($dou->table("team"), '*', '`id` = \'' . $buildings['house_designer_id'] . '\'');
$desinger =  $dou->fetch_array($query);

/*获取网站信息*/
$webhome =  $dou->get_config();
$qq_s    =  explode(',',$webhome['qq']);
$webhome['qq'] = array();
foreach($qq_s as $qq){
	$webhome['qq'][] = trim($qq);
}



/* 获取meta和title信息 */
$smarty->assign('page_title', $buildings['houses']);
$smarty->assign('keywords', $buildings['houses']);
$smarty->assign('description', $buildings['houses']);

/* 初始化导航栏 */
$smarty->assign('nav_top_list', $dou->get_nav('0', 'buildings', '', 'top'));
$smarty->assign('nav_list', $dou->get_nav('0', 'buildings', $cat_id));
$smarty->assign('nav_bottom_list', $dou->get_nav('0', 'buildings', '', 'bottom'));

//配置面包屑导航
$params = array('p_name'=>'buildings_category', 'p_id'=>$buildings['house_status'], 'mod_name'=>$buildings['houses']);
$params['p_value'] = $buildings['house_status'] == 1?"作品案例":"在建工厂";
$ur_here = $dou->my_ur_here($params);



/* 初始化数据 */
$smarty->assign('ur_here', $ur_here);
$smarty->assign('buildings', $buildings);
$smarty->assign('designer', $desinger);
$smarty->assign('webhome', $webhome);

$smarty->display('buildings.dwt', $id);
?>