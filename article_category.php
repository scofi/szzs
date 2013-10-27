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
$unique_id = trim($_REQUEST['unique_id']);

if ($check->is_unique_id($unique_id))
{
	$cat_id = $dou->get_one("SELECT cat_id FROM " . $dou->table('article_category') . " WHERE unique_id = '$unique_id'");
}
else
{
	$cat_id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
}

/* 分类信息 */
$sql = "SELECT * FROM " . $dou->table('article_category') . " WHERE cat_id = '$cat_id'";
$query = $dou->query($sql);
$cate_info = $dou->fetch_array($query);

/* 判断分类信息是否存在 */
if ((!is_array($cate_info) && $unique_id) || (!is_array($cate_info) && $cat_id))
{
	header("Location: " . ROOT_URL . "\n");
	exit();
}

/* 文章列表 */
$page = trim($_REQUEST['page']) ? trim($_REQUEST['page']) : 1;
$limit = $dou->pager('article', $_CFG['display_article'], $page, $cat_id);

if ($cat_id)
{
	$where = " WHERE cat_id = $cat_id";
}

$sql = "SELECT id, title, content, cat_id, add_time, click, description FROM " . $dou->table('article') . $where . " ORDER BY id DESC" . $limit;
$query = $dou->query($sql);

while ($row = $dou->fetch_array($query))
{
	$cat_name = $dou->get_one("SELECT cat_name FROM " . $dou->table('article_category') . " WHERE cat_id = '$row[cat_id]'");
	$url = $dou->rewrite_url('article', $row['id']);
	$add_time = date("Y-m-d", $row['add_time']);
	$add_time_short = date("m-d", $row['add_time']);

	$description = $row['description'] ? $row['description'] : $dou->dou_substr($row['content'], 200);

	$article_list[] = array (
		"id" => $row['id'],
		"cat_id" => $row['cat_id'],
		"cat_name" => $cat_name,
		"title" => $row['title'],
		"add_time" => $add_time,
		"add_time_short" => $add_time_short,
		"click" => $row['click'],
		"description" => $description,
		"url" => $url
	);
}

/* 获取meta和title信息 */
if (!$cat_id)
{
	$cate_info['keywords'] = $_CFG['site_keywords'];
	$cate_info['description'] = $_CFG['site_description'];
}
$smarty->assign('page_title', $dou->page_title('article_category', $cat_id));
$smarty->assign('keywords', $cate_info['keywords']);
$smarty->assign('description', $cate_info['description']);

/* 初始化导航栏 */
$smarty->assign('nav_top_list', $dou->get_nav('0', 'article_category', '', 'top'));
$smarty->assign('nav_list', $dou->get_nav('0', 'article_category', $cat_id));
$smarty->assign('nav_bottom_list', $dou->get_nav('0', 'article_category', '', 'bottom'));

/*
 * 如果面包屑导航栏有三级的话，去除中间一级
 */
$url_here = $dou->ur_here('article_category', $cat_id);
$matches  = preg_split("/<b>><\/b>/", $url_here);
if(count($matches)==2){
	$url_here = $matches[1];
}
/* 初始化数据 */
$smarty->assign('ur_here', $url_here);
$smarty->assign('article_category', $dou->get_article_category($cat_id));
$smarty->assign('article_list', $article_list);

$smarty->display('article_category.dwt');
?>