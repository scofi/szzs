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
	$id = $dou->get_one("SELECT id FROM " . $dou->table('page') . " WHERE unique_id = '" . $unique_id . "'");
}
else
{
	$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
}

$page = get_page_info($id);

/* 判断单页面ID是否存在 */
if (!$page)
{
	header("Location: " . ROOT_URL . "\n");
	exit();
}

if ($page['parent_id'] == 0)
{
	$top_id = $id;
}
else
{
	$top_id = $page['parent_id'];
}

if ($top_id == $id)
{
	$smarty->assign("top_cur", 'top_cur');
}

/* 获取meta和title信息 */
$smarty->assign('page_title', $dou->page_title('page', '', $page['page_name']));
$smarty->assign('keywords', $page['keywords']);
$smarty->assign('description', $page['description']);

/* 初始化导航栏 */
$smarty->assign('nav_top_list', $dou->get_nav('0', 'page', $id, 'top'));
$smarty->assign('nav_list', $dou->get_nav('0', 'page', $id));
$smarty->assign('nav_bottom_list', $dou->get_nav('0', 'page', $id, 'bottom'));

/* 初始化数据 */
$smarty->assign('ur_here', $dou->ur_here('page', '', $page['page_name']));
$smarty->assign('page_list', $dou->get_page_list($top_id, $id));
$smarty->assign('top', get_page_info($top_id));
$smarty->assign('page', $page);

$smarty->display('page.dwt');

/**
 +----------------------------------------------------------
 * 获取单页面信息
 +----------------------------------------------------------
 */
function get_page_info($id = 0)
{
	$query = $GLOBALS['dou']->select($GLOBALS['dou']->table(page), '*', '`id` = \'' . $id . '\'');
	$page = $GLOBALS['dou']->fetch_array($query);

	if ($page)
	{
		$page['url'] = $GLOBALS['dou']->rewrite_url('page', $page['id'], $page['unique_id']);
	}

	return $page;
}
?>