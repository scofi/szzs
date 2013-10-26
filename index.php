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

/* 获取关于我们信息 */
$sql = "SELECT * FROM " . $dou->table('page') . " WHERE id = '1'";
$query = $dou->query($sql);
$about = $dou->fetch_array($query);

/* 写入到index数组 */
$index['about_name'] = $about['page_name'];
$index['about_content'] = $dou->dou_substr($about['content'], 300);
$index['about_link'] = $dou->rewrite_url('page', '1');
$index['works_link'] = $dou->rewrite_url('product_category','1');
$index['buildings_link'] = $dou->rewrite_url('product_category','2');
$index['bestteam_link'] = $dou->rewrite_url('product_category','4');
$index['article_link'] = $dou->rewrite_url('article_category');
$index['free_measure_link'] = $dou->rewrite_url('article_category',4);
$index['owner_comments_link'] = $dou->rewrite_url('article_category',5);
$index['ask_question_link'] = $dou->rewrite_url('article_category',3);

/* 获取meta和title信息 */
$smarty->assign('page_title', $_CFG['site_title']);
$smarty->assign('keywords', $_CFG['site_keywords']);
$smarty->assign('description', $_CFG['site_description']);

/* 初始化导航栏 */
$smarty->assign('nav_top_list', $dou->get_nav('0', '', '', 'top'));
$smarty->assign('nav_list', $dou->get_nav('0'));
$smarty->assign('nav_bottom_list', $dou->get_nav('0', '', '', 'bottom'));

/* 初始化数据 */
$smarty->assign('index', 'index'); // 是否为首页的标志
$smarty->assign('index_ad', get_ad_list());
$smarty->assign('link', get_link_list());
$smarty->assign('index', $index);
$smarty->assign('recommend_works', $dou->get_recommend_product(1, $_CFG['home_display_product']));
$smarty->assign('recommend_bestteam', $dou->get_recommend_product(4, $_CFG['home_display_product']));
$smarty->assign('recommend_buildings',   $dou->get_recommend_product(2, $_CFG['home_display_product']));
$smarty->assign('recommend_article', $dou->get_recommend_article(1, $_CFG['home_display_article']));
$smarty->assign('recommend_ask_question', $dou->get_recommend_article(3, $_CFG['home_display_article']));
$smarty->assign('recommend_owner_comments', $dou->get_recommend_article(5, $_CFG['home_display_article']));
$smarty->assign('recommend_free_measure', $dou->get_recommend_article(4, $_CFG['home_display_article']));

$smarty->display('index.dwt');

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
		$image = explode(".", $row[image]);
		$thumb = $image[0] . "_thumb." . $image[1];

		$ad_list[] = array (
			"id" => $row['id'],
			"ad_name" => $row['ad_name'],
			"ad_link" => $row['ad_link'],
			"ad_img" => $row[ad_img],
			"thumb" => $thumb,
			"sort" => $row['sort']
		);
	}

	return $ad_list;
}

/**
 +----------------------------------------------------------
 * 获取下级幻灯列表
 +----------------------------------------------------------
 */
function get_link_list()
{
	$sql = "SELECT * FROM " . $GLOBALS['dou']->table('link') . " ORDER BY sort ASC, id ASC";
	$query = $GLOBALS['dou']->query($sql);
	while ($row = $GLOBALS['dou']->fetch_array($query))
	{
		$link_list[] = array (
			"id" => $row['id'],
			"link_name" => $row['link_name'],
			"link_url" => $row['link_url'],
			"sort" => $row['sort']
		);
	}

	return $link_list;
}






?>