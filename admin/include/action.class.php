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

if (!defined('IN_DOUCO'))
{
	die('Hacking attempt');
}

class Action extends DbMysql
{
	/**
	 +----------------------------------------------------------
	 * 获取网站信息
	 +----------------------------------------------------------
	 */
	function get_config()
	{
		$query = $this->select_all(config);
		while ($row = $this->fetch_array($query))
		{
			$config[$row[name]] = $row[value];
		}
		return $config;
	}

	/**
	 +----------------------------------------------------------
	 * 用户权限判断
	 +----------------------------------------------------------
	 */
	function admin_check($user_id, $shell, $action_list = ALL)
	{
		if ($row = $this->admin_state($user_id, $shell))
		{
			$this->admin_ontime(10800);
			return $row;
		}
		else
		{
			header("Location: " . ROOT_URL . ADMIN_PATH . "/login.php\n");
			exit;
		}
	}
	
	/**
	 +----------------------------------------------------------
	 * 用户状态
	 +----------------------------------------------------------
	 */
	function admin_state($user_id, $shell)
	{
		$query = $this->select($this->table(admin), '*', '`user_id` = \'' . $user_id . '\'');
		$user = $this->fetch_array($query);
		
		//如果$user则开始比对$shell值
		$check_shell = is_array($user) ? $shell == md5($user['user_name'] . $user['password'] . DOU_SHELL) : FALSE;

		//如果比对$shell吻合，则返回会员信息，否则返回空
		return $check_shell ? $user : NULL;
	}

	/**
	 +----------------------------------------------------------
	 * 登录超时默认为3小时(10800秒)
	 +----------------------------------------------------------
	 */
	function admin_ontime($timeout = '10800')
	{
		$ontime = $_SESSION[ontime];
		$cur_time = time();
		if ($cur_time - $ontime > $timeout)
		{
			session_destroy();
		}
		else
		{
			$_SESSION[ontime] = time();
		}
	}

	/**
	 +----------------------------------------------------------
	 * 获取下级单页面列表
	 +----------------------------------------------------------
	 */
	function get_page_list()
	{
		$sql = "SELECT * FROM " . $this->table('page') . " WHERE parent_id = '0' ORDER BY id ASC";
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$child = $this->get_page_child($row['id']);

			$page_list[] = array (
				"id" => $row['id'],
				"unique_id" => $row['unique_id'],
				"page_name" => $row['page_name'],
				"child" => $child
			);
		}

		return $page_list;
	}

	/**
	 +----------------------------------------------------------
	 * 获取下级单页面子页面
	 +----------------------------------------------------------
	 */
	function get_page_child($parent_id = '0', $out_id = '')
	{
		$out = $out_id ? " AND id != $out_id" : '';
		$sql = "SELECT * FROM " . $this->table('page') . " WHERE parent_id = '$parent_id'" . $out . " ORDER BY id ASC";
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$parent_name = $this->get_one("SELECT title FROM " . $this->table('page') . " WHERE id = '" . $row[parent_id] . "'");
			$page_child[] = array (
				"id" => $row['id'],
				"unique_id" => $row['unique_id'],
				"parent_id" => $row['parent_id'],
				"parent_name" => $parent_name,
				"page_name" => $row['page_name']
			);
		}

		return $page_child;
	}

	/**
	 +----------------------------------------------------------
	 * 获取商品分类
	 +----------------------------------------------------------
	 */
	function get_product_category()
	{
		$sql = "SELECT * FROM " . $this->table('product_category') . " ORDER BY sort ASC,cat_id ASC";
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$product_list[] = array (
				"cat_id" => $row['cat_id'],
				"unique_id" => $row['unique_id'],
				"cat_name" => $row['cat_name'],
				"keywords" => $row['keywords'],
				"description" => $row['description'],
				"sort" => $row[sort]
			);
		}
		return $product_list;
	}

	/**
	 +----------------------------------------------------------
	 * 获取文章分类
	 +----------------------------------------------------------
	 */
	function get_article_category()
	{
		$sql = "SELECT * FROM " . $this->table('article_category') . " ORDER BY sort ASC,cat_id ASC";
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$article_list[] = array (
				"cat_id" => $row['cat_id'],
				"unique_id" => $row['unique_id'],
				"cat_name" => $row['cat_name'],
				"keywords" => $row['keywords'],
				"description" => $row['description'],
				"sort" => $row[sort]
			);
		}
		return $article_list;
	}

	/**
	 +----------------------------------------------------------
	 * 获取文章列表
	 +----------------------------------------------------------
	 */
	function get_article_list($cat_id = '')
	{
		if ($cat_id)
		{
			$where = "and a.cat_id = $cat_id ";
		}

		$sql = "SELECT a.id, a.title, a.cat_id, a.add_time, c.cat_name FROM " . $this->table('article') . " AS a, " . $this->table('article_category') . " AS c WHERE a.cat_id = c.cat_id " . $where . "ORDER BY id ASC";
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$add_time = date("Y-m-d", $row['add_time']);

			$article_list[] = array (
				"id" => $row['id'],
				"cat_id" => $row['cat_id'],
				"cat_name" => $row['cat_name'],
				"title" => $row['title'],
				"add_time" => $add_time
			);
		}

		return $article_list;
	}

	/**
	 +----------------------------------------------------------
	 * 获取管理员日志
	 +----------------------------------------------------------
	 */
	function create_admin_log($action)
	{
		$create_time = time();
		$ip = $this->get_ip();

		$sql = "INSERT INTO " . $this->table('admin_log') . " (id, create_time, user_id, action ,ip)" .
		" VALUES (NULL, '$create_time', '$_SESSION[user_id]', '$action', '$ip')";
		$this->query($sql);
	}

	/**
	 +----------------------------------------------------------
	 * 获取管理员日志
	 +----------------------------------------------------------
	 */
	function get_admin_log($user_id = '', $num = '')
	{
		if ($user_id)
		{
			$where = " WHERE user_id = " . $user_id;
		}
		if ($num)
		{
			$limit = " LIMIT $num";
		}

		$sql = "SELECT * FROM " . $this->table('admin_log') . $where . " ORDER BY id DESC" . $limit;
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$create_time = date("Y-m-d", $row[create_time]);
			$user_name = $this->get_one("SELECT user_name FROM " . $this->table('admin') . " WHERE user_id = " . $row['user_id']);

			$log_list[] = array (
				"id" => $row['id'],
				"create_time" => $create_time,
				"user_name" => $user_name,
				"action" => $row['action'],
				"ip" => $row['ip']
			);
		}

		return $log_list;
	}

	/**
	 +----------------------------------------------------------
	 * 分页
	 +----------------------------------------------------------
	 */
	function pager($table, $page_size = '10', $page, $cat_id = '')
	{
		if ($cat_id)
		{
			$where = " WHERE cat_id = $cat_id";
		}
		
		$sql = "SELECT * FROM " . $this->table($table) . $where;
		
		$record_count = mysql_num_rows($this->query($sql));

		if ($table == 'admin_log')
		{
			$url = "manager.php?rec=manager_log";
			$get_request = "&page=";
		}
		else
		{
			$url = $GLOBALS['cur'] . ".php";
			$get_request = $cat_id ? "?id=$cat_id&page=" : "?page=";
		}
		
		$page_count = ceil($record_count / $page_size);
		$previous = $url . $get_request . ($page > 1 ? $page -1 : 0);
		$next = $url . $get_request . ($page_count > $page ? $page +1 : 0);
		$last = $url . $get_request . $page_count;

		$pager = array (
			"record_count" => $record_count,
			"page_size" => $page_size,
			"page" => $page,
			"page_count" => $page_count,
			"previous" => $previous,
			"next" => $next,
			"first" => $url,
			"last" => $last,
		);

		$start = ($page -1) * $page_size;
		$limit = " LIMIT $start, $page_size";

		$GLOBALS['smarty']->assign('pager', $pager);

		return $limit;
	}

	/**
	 +----------------------------------------------------------
	 * 获取下级导航菜单
	 +----------------------------------------------------------
	 */
	function get_nav_child($parent_id = '0', $type = 'middle', $out_id = '')
	{
		$out = $out_id ? " AND id != $out_id" : '';
		
		$sql = "SELECT * FROM " . $this->table('nav') . " WHERE parent_id = '$parent_id' AND type = '$type'" . $out . " ORDER BY sort, id ASC";
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			if ($row['module'] == 'nav')
			{
				$guide = $row['guide'];
			}
			else
			{
				$guide = $this->rewrite_url($row['module'], $row['guide']);
			}

			$nav_list[] = array (
				"id" => $row['id'],
				"nav_name" => $row['nav_name'],
				"guide" => $guide,
				"sort" => $row['sort']
			);
		}

		return $nav_list;
	}

	/**
	 +----------------------------------------------------------
	 * 重写 URL 地址
	 +----------------------------------------------------------
	 */
	function rewrite_url($module, $id)
	{
		$is_category = strpos($module, 'category');
		
		if (intval($GLOBALS['_CFG']['rewrite']))
		{
			$filename = $module != 'page' ? '/' . $id : '';
			$item = !$is_category ? $filename . '.html' : '';
			$url = $this->get_unique($module, $id) . $item;
		}
		else
		{
			$id = $id ? '?id=' . $id : '';
			$url = $module . '.php' . $id;
		}
		
		return ROOT_URL . $url;
	}

	/**
	 +----------------------------------------------------------
	 * 获取别名
	 +----------------------------------------------------------
	 */
	function get_unique($module, $id)
	{
		$filed = $module == 'page' ? id : cat_id;
		
		$unique_id = $this->get_one("SELECT unique_id FROM " . $this->table($module) . " WHERE " . $filed . " = " . $id);
		
		//把分类页和列表的别名统一
		$module = preg_replace("/\_category/",'',$module);
		
		//伪静态时使用的完整别名
		if ($module == 'page')
		{
			$unique = $unique_id;
		}
		else
		{
			$unique = $unique_id ? '/' . $unique_id : $unique_id;
			$unique = $module . $unique;
		}
		
		return $unique;
	}

	/**
	 +----------------------------------------------------------
	 * 获取当前目录子文件夹
	 +----------------------------------------------------------
	 */
	function get_subdirs($dir)
	{
		$subdirs = array ();
		if (!$dh = opendir($dir))
			return $subdirs;
		$i = 0;
		while ($f = readdir($dh))
		{
			if ($f == '.' || $f == '..')
				continue;
			//如果只要子目录名, path = $f;
			//$path = $dir.'/'.$f;
			$path = $f;
			$subdirs[$i] = $path;
			$i++;
		}
		return $subdirs;
	}

	/**
	 +----------------------------------------------------------
	 * 获取真实IP地址
	 +----------------------------------------------------------
	 */
	function get_ip()
	{
		$ip = false;
		if (!empty ($_SERVER["HTTP_CLIENT_IP"]))
		{
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		}
		if (!empty ($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
			if ($ip)
			{
				array_unshift($ips, $ip);
				$ip = FALSE;
			}
			for ($i = 0; $i < count($ips); $i++)
			{
				if (!preg_match("/^(10|172\.16|192\.168)\./", $ips[$i]))
				{
					$ip = $ips[$i];
					break;
				}
			}
		}
		return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
	}

	/**
	 +----------------------------------------------------------
	 * 清除缓存及已编译模板
	 +----------------------------------------------------------
	 */
	function dou_clear_cache($dir)
	{
		$dir = realpath($dir);
		if (!$dir || !@ is_dir($dir))
			return 0;
		$handle = @ opendir($dir);
		if ($dir[strlen($dir) - 1] != DIRECTORY_SEPARATOR)
			$dir .= DIRECTORY_SEPARATOR;
		while ($file = @ readdir($handle))
		{
			if ($file != '.' && $file != '..')
			{
				if (@ is_dir($dir . $file) && !is_link($dir . $file))
					$this->dou_clear_cache($dir . $file);
				else
					@ unlink($dir . $file);
			}
		}
		closedir($handle);
	}

	/**
	 +----------------------------------------------------------
	 * 递归方式的对变量中的特殊字符进行转义
	 +----------------------------------------------------------
	 */
	function addslashes_deep($value)
	{
		if (empty ($value))
		{
			return $value;
		}

		if (is_array($value))
		{
			foreach ((array) $value as $k => $v)
			{
				unset ($value[$k]);
				$k = addslashes($k);
				if (is_array($v))
					$value[$k] = $this->addslashes_deep($v);
				else
					$value[$k] = addslashes($v);
			}
		}
		else
		{
			$value = addslashes($value);
		}
		return $value;
	}

	/**
	 +----------------------------------------------------------
	 * 递归方式的对变量中的特殊字符去除转义
	 +----------------------------------------------------------
	 */
	function stripslashes_deep($value)
	{
		if (empty ($value))
		{
			return $value;
		}

		if (is_array($value))
		{
			foreach ((array) $value as $k => $v)
			{
				unset ($value[$k]);
				$k = stripslashes($k);
				if (is_array($v))
				{
					$value[$k] = $this->stripslashes_deep($v);
				}
				else
				{
					$value[$k] = stripslashes($v);
				}
			}
		}
		else
		{
			$value = stripslashes($value);
		}
		return $value;
	}

	/**
	 +----------------------------------------------------------
	 * 交互数据转义操作
	 +----------------------------------------------------------
	 */
	function dou_magic_quotes()
	{
		if (!@get_magic_quotes_gpc())
		{
			if (!empty($_GET)) $_GET = $this->addslashes_deep($_GET);
			if (!empty($_POST)) $_POST = $this->addslashes_deep($_POST);
			$_COOKIE = $this->addslashes_deep($_COOKIE);
			$_REQUEST = $this->addslashes_deep($_REQUEST);
		}
	}
	
	/**
	 +----------------------------------------------------------
	 * 给URL自动上http://
	 +----------------------------------------------------------
	 */
	function auto_http($url)
	{
		if (strpos($url, 'http://') === false && strpos($url, 'https://') === false)
		{
				$url = 'http://' . trim($url);
		}
		else
		{
				$url = trim($url);
		}
		return $url;
	}
	
	/**
	 +----------------------------------------------------------
	 * 版本升级提示
	 +----------------------------------------------------------
	 */
	function dou_api($apiget)
	{
		global $_CFG;
		global $sys_info;
		
	  $apiget = "ver=$_CFG[douphp_version]&lang=$_CFG[language]&php_ver=$sys_info[php_ver]&mysql_ver=$sys_info[mysql_ver]&os=$sys_info[os]&web_server=$sys_info[web_server]&charset=$sys_info[charset]&template=$_CFG[site_theme]&url=" . ROOT_URL;
		return "http://api.douco.com/update.php".'?'.$apiget;
	}

	/**
	 +----------------------------------------------------------
	 * 创建IN查询如"IN('1','2')";
	 +----------------------------------------------------------
	 */
	function create_sql_in($arr)
	{
		foreach ($arr AS $list)
		{
			$sql_in .= $sql_in ? ",'$list'" : "'$list'";
		}
		return "IN ($sql_in)";
	}

	/**
	 +----------------------------------------------------------
	 * 后台通用信息提示
	 +----------------------------------------------------------
	 */
	function dou_msg($text, $url = '', $out = '', $time = '3', $check = '')
	{
		if (!$text)
		{
			$text = $GLOBALS['_LANG']['dou_msg_success'];
		}
		
		$GLOBALS['smarty']->assign('ur_here', $GLOBALS['_LANG']['dou_msg']);
		$GLOBALS['smarty']->assign('text', $text);
		$GLOBALS['smarty']->assign('url', $url);
		$GLOBALS['smarty']->assign('out', $out);
		$GLOBALS['smarty']->assign('time', $time);
		$GLOBALS['smarty']->assign('check', $check);
		
		//根据跳转时间生成跳转提示
		$cue = preg_replace('/d%/Ums', $time, $GLOBALS['_LANG']['dou_msg_cue']);
		$GLOBALS['smarty']->assign('cue', $cue);

		$GLOBALS['smarty']->display('dou_msg.htm');
		exit ();
	}



}
?>