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
$smarty->assign('cur', 'article_category');

/**
 +----------------------------------------------------------
 * 分类列表
 +----------------------------------------------------------
 */
if ($_REQUEST['rec'] == 'default')
{
	$smarty->assign('ur_here', $_LANG['article_category']);
	$smarty->assign('action_link', array (
		'text' => $_LANG['article_category_add'],
		'href' => 'article_category.php?rec=add'
	));

	$article_list = $dou->get_article_category();

	$smarty->assign('article_list', $article_list);
	$smarty->display('article_category.htm');
}

/**
 +----------------------------------------------------------
 * 分类添加
 +----------------------------------------------------------
 */
elseif ($_REQUEST['rec'] == 'add')
{
	$smarty->assign('ur_here', $_LANG['article_category_add']);
	$smarty->assign('action_link', array (
		'text' => $_LANG['article_category'],
		'href' => 'article_category.php'
	));

	$smarty->assign('form_action', 'insert');
	$smarty->display('article_category.htm');
}

elseif ($_REQUEST['rec'] == 'insert')
{
	$sql = "INSERT INTO " . $dou->table('article_category') . " (cat_id, unique_id, cat_name, keywords, description, sort)" .
	" VALUES (NULL, '$_POST[unique_id]', '$_POST[cat_name]', '$_POST[keywords]', '$_POST[description]', '$_POST[sort]')";
	$dou->query($sql);
	
	if (!$check->is_unique_id($_POST['unique_id']))
	{
		$dou->dou_msg($_LANG['unique_id_wrong'], 'article_category.php?rec=edit&cat_id=' . mysql_insert_id(), '', '5');
	}

	$dou->create_admin_log($_LANG['article_category_add'] . ": " . $_POST[cat_name]);
	$dou->dou_msg($_LANG['article_category_add_succes'], 'article_category.php');
}

/**
 +----------------------------------------------------------
 * 分类编辑
 +----------------------------------------------------------
 */
elseif ($_REQUEST['rec'] == 'edit')
{
	$smarty->assign('ur_here', $_LANG['article_category_edit']);
	$smarty->assign('action_link', array (
		'text' => $_LANG['article_category'],
		'href' => 'article_category.php'
	));

	$cat_id = trim($_REQUEST['cat_id']);
	$query = $dou->select($dou->table(article_category), '*', '`cat_id` = \'' . $cat_id . '\'');
	$cat_info = $dou->fetch_array($query);

	$smarty->assign('form_action', 'update');
	$smarty->assign('cat_info', $cat_info);
	$smarty->display('article_category.htm');
}

elseif ($_REQUEST['rec'] == 'update')
{
	$sql = "update " . $dou->table('article_category') . " SET cat_name = '$_POST[cat_name]', unique_id = '$_POST[unique_id]', keywords = '$_POST[keywords]' ,description = '$_POST[description]', sort = '$_POST[sort]' WHERE cat_id = '$_POST[cat_id]'";
	$dou->query($sql);
	
	if (!$check->is_unique_id($_POST['unique_id']))
	{
		$dou->dou_msg($_LANG['unique_id_wrong'], 'article_category.php?rec=edit&cat_id=' . $_POST['cat_id'], '', '5');
	}

	$dou->create_admin_log($_LANG['article_category_edit'] . ": " . $_POST[cat_name]);
	$dou->dou_msg($_LANG['article_category_edit_succes'], 'article_category.php');
}

/**
 +----------------------------------------------------------
 * 分类删除
 +----------------------------------------------------------
 */
elseif ($_REQUEST['rec'] == 'del')
{
	$cat_id = trim($_REQUEST['cat_id']);

	$cat_name = $dou->get_one("SELECT cat_name FROM " . $dou->table('article_category') . " WHERE cat_id = '$cat_id'");
	$is_parent = $dou->get_one("SELECT id FROM " . $dou->table('article') . " WHERE cat_id = '$cat_id'");
	
	if ($is_parent)
	{
		$_LANG['article_category_del_is_parent'] = preg_replace('/d%/Ums', $cat_name, $_LANG['article_category_del_is_parent']);
		$dou->dou_msg($_LANG['article_category_del_is_parent'], 'article_category.php', '', '3');
	}
	else
	{
		if ($_POST['confirm'])
		{
			$dou->create_admin_log($_LANG['article_category_del'] . ": " . $cat_name);
			$dou->delete($dou->table(article_category), "cat_id = $cat_id", 'article_category.php');
		}
		else
		{
			$_LANG['del_check'] = preg_replace('/d%/Ums', $cat_name, $_LANG['del_check']);
			$dou->dou_msg($_LANG['del_check'], 'article_category.php', '', '30', "article_category.php?rec=del&cat_id=$cat_id");
		}
	}
	
}
?>