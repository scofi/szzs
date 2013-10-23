<?php
/**
 * DOUCO TEAM
 * ============================================================================
 * * COPYRIGHT DOUCO 2013-2014.
 * http://www.douco.com;
 * ----------------------------------------------------------------------------
 * Author:DouCo
 * Id: init.php 2012-10-19
 */

if (!defined('IN_DOUCO'))
{
	die('Hacking attempt');
}

/* 开启SESSION */
session_start();

/* error_reporting */
error_reporting(E_ALL ^ E_NOTICE);

/* 关闭 set_magic_quotes_runtime*/
@set_magic_quotes_runtime(0);

/* 调整时区 */
if (PHP_VERSION >= '5.1')
{
	date_default_timezone_set('PRC');
}

include_once ('../data/config.php');

/* 定义常量 */
define('ROOT_PATH', str_replace(ADMIN_PATH . '/include/init.php', '', str_replace('\\', '/', __FILE__)));
define('ROOT_URL', preg_replace('/' . ADMIN_PATH . '\//Ums', '', dirname('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']) . "/"));

if (!file_exists(ROOT_PATH . "data/install.lock"))
{
	header("Location: " . ROOT_URL . "install/index.php\n");
	exit ();
}

require(ROOT_PATH . 'include/smarty/Smarty.class.php');
require(ROOT_PATH . 'include/mysql.class.php');
require(ROOT_PATH . ADMIN_PATH . '/include/action.class.php');
require(ROOT_PATH . ADMIN_PATH . '/include/check.class.php');

/* 实例化类 */
$dou = new Action($dbhost, $dbuser, $dbpass, $dbname, $prefix, DOU_CHARSET);
$check = new Check();

/* 定义DOU_SHELL */
define('DOU_SHELL', $dou->get_one("SELECT value FROM " . $dou->table('config') . " WHERE name = 'hash_code'"));

/* 交互数据转义操作。*/
$dou->dou_magic_quotes();

//SMARTY配置
$smarty = new smarty();
$smarty->config_dir = ROOT_PATH . "include/smarty/Config_File.class.php"; //目录变量
$smarty->caching = false; //是否使用缓存
$smarty->template_dir = ROOT_PATH . ADMIN_PATH . "/templates"; //模板存放目录
$smarty->compile_dir = ROOT_PATH . "cache/compile/" . ADMIN_PATH; //编译目录
$smarty->cache_dir = ROOT_PATH . "cache/static/" . ADMIN_PATH; //缓存目录
$smarty->left_delimiter = "{"; //左定界符
$smarty->right_delimiter = "}"; //右定界符

//如果编译和缓存目录不存在则建立
if (!file_exists($smarty->compile_dir))
{
	mkdir($smarty->compile_dir, 0777);
}

//读取站点信息
if (!defined('NO_CHECK'))
{
	$row = $dou->admin_check($_SESSION['user_id'], $_SESSION['shell']);
	$user = array (
		'user_id' => $row['user_id'],
		'user_name' => $row['user_name'],
		'email' => $row['email'],
		'action_list' => $row['action_list']
	);

	$smarty->assign("user", $user);
}

//读取站点信息
$_CFG = $dou->get_config();
$smarty->assign("site", $_CFG);

/* 载入语言文件 */
require (ROOT_PATH . 'languages/' . $_CFG['language'] . '/admin.lang.php');

//通用信息调用
$smarty->assign("lang", $_LANG);

//Smarty 过滤器
function remove_html_comments($source, & $smarty)
{
	return $source = preg_replace('/<!--.*{(.*)}.*-->/U', '{$1}', $source);
}
$smarty->register_prefilter('remove_html_comments');
?>