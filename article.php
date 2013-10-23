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
$rewrite = isset($_REQUEST['rewrite']) ? intval($_REQUEST['rewrite']) : 0;
$_REQUEST['unique_id'] = $check->is_unique_id($_REQUEST['unique_id']) ? $_REQUEST['unique_id'] : 0; 

$cat_id = $dou->get_one("SELECT cat_id FROM " . $dou->table('article') . " WHERE id = '$id'");
$unique_id = $dou->get_one("SELECT unique_id FROM " . $dou->table('article_category') . " WHERE cat_id = '$cat_id'");

/* 伪静态别名验证 */
if ($_REQUEST['unique_id'] && $unique_id != $_REQUEST['unique_id'])
{
	header("Location: " . ROOT_URL . "\n");
	exit();
}
elseif ($_REQUEST['rewrite'] && $unique_id && !$_REQUEST['unique_id'])
{
	header("Location: " . ROOT_URL . "\n");
	exit();
}

$query = $dou->select($dou->table(article), '*', '`id` = \'' . $id . '\'');
$article = $dou->fetch_array($query);
$article['add_time'] = date("Y-m-d", $article['add_time']);

/* 判断文章ID是否存在 */
if (!$article)
{
	header("Location: " . ROOT_URL . "\n");
	exit();
}

/* 格式化自定义参数 */
$defined_article = explode(',', $article['defined']);
foreach ($defined_article as $row)
{
	$row = explode('：', str_replace(":", "：", $row));

	if ($row['1'])
	{
		$defined[] = array (
			"arr" => $row['0'],
			"value" => $row['1']
		);
	}
}

/* 访问统计 */
$click = $article['click'] + 1;
$sql = "update " . $dou->table('article') . " SET click = '$click' WHERE id = '$id'";
$dou->query($sql);

/* 获取meta和title信息 */
$smarty->assign('page_title', $dou->page_title('article_category', $cat_id, $article['title']));
$smarty->assign('keywords', $article['keywords']);
$smarty->assign('description', $article['description']);

/* 初始化导航栏 */
$smarty->assign('nav_top_list', $dou->get_nav('0', 'article_category', '', 'top'));
$smarty->assign('nav_list', $dou->get_nav('0', 'article_category', $cat_id));
$smarty->assign('nav_bottom_list', $dou->get_nav('0', 'article_category', '', 'bottom'));

/* 初始化数据 */
$smarty->assign('ur_here', $dou->ur_here('article_category', $cat_id, $article['title']));
$smarty->assign('article_category', $dou->get_article_category($cat_id));
$smarty->assign('article', $article);
$smarty->assign('defined', $defined);

$smarty->display('article.dwt', $id);
?>