<?php
/**
 * DOUCO TEAM
 * ============================================================================
 * * COPYRIGHT DOUCO 2013-2014.
 * http://www.douco.com;
 * ----------------------------------------------------------------------------
 * Author:DouCo
 * Id: action.class.php 2012-10-22
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
			$config[$row['name']] = $row['value'];
		}
		return $config;
	}

	/**
	 +----------------------------------------------------------
	 * 获取文章分类
	 +----------------------------------------------------------
	 */
	function get_article_category($current_id)
	{
		$sql = "SELECT cat_id, cat_name FROM " . $this->table('article_category') . " ORDER BY sort ASC,cat_id ASC";
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$url = $this->rewrite_url('article_category', $row['cat_id']);
			$cur = $this->dou_current('article_category', $row['cat_id'], 'article_category', $current_id);

			$article_category[] = array (
				"cat_id" => $row['cat_id'],
				"cat_name" => $row['cat_name'],
				"cur" => $cur,
				"url" => $url
			);
		}
		return $article_category;
	}

	/**
	 +----------------------------------------------------------
	 * 获取文章列表
	 +----------------------------------------------------------
	 */
	function get_recommend_article($cat_id = '', $num = '')
	{
		if ($cat_id)
		{
			$where = " WHERE cat_id = $cat_id ";
		}
		if ($num)
		{
			$limit = " LIMIT $num";
		}

		$sql = "SELECT id, title, add_time FROM " . $this->table('article') . $where . "ORDER BY id DESC" . $limit;
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$url = $this->rewrite_url('article', $row['id']);
			$add_time_short = date("m-d", $row['add_time']);

			$article_list[] = array (
				"id" => $row['id'],
				"title" => $row['title'],
				"add_time_short" => $add_time_short,
				"url" => $url
			);
		}
		
		return $article_list;
	}

	/**
	 +----------------------------------------------------------
	 * 获取商品分类
	 +----------------------------------------------------------
	 */
	function get_product_category($current_id)
	{
		$sql = "SELECT cat_id, cat_name FROM " . $this->table('product_category') . " ORDER BY sort ASC,cat_id ASC";
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$url = $this->rewrite_url('product_category', $row['cat_id']);
			$cur = $this->dou_current('product_category', $row['cat_id'], 'product_category', $current_id);

			$product_category[] = array (
				"cat_id" => $row['cat_id'],
				"cat_name" => $row['cat_name'],
				"cur" => $cur,
				"url" => $url
			);
		}
		return $product_category;
	}

	/**
	 +----------------------------------------------------------
	 * 获取商品列表
	 +----------------------------------------------------------
	 */
	function get_recommend_product($cat_id = '', $num = '')
	{
		if ($cat_id)
		{
			$where = " WHERE cat_id = $cat_id ";
		}
		if ($num)
		{
			$limit = " LIMIT $num";
		}

		$sql = "SELECT id, product_name, price, product_image FROM " . $this->table('product') . $where . "ORDER BY id DESC" . $limit;
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$url = $this->rewrite_url('product', $row['id']);
			$image = explode(".", $row['product_image']);
			$thumb = ROOT_URL . $image[0] . "_thumb." . $image[1];
			$price = $row['price'] > 0 ? $this->price_format($row['price']) : $GLOBALS['_LANG']['price_discuss'];

			$product_list[] = array (
				"id" => $row['id'],
				"name" => $row['product_name'],
				"price" => $price,
				"thumb" => $thumb,
				"url" => $url
			);
		}
		
		return $product_list;
	}

	/**
	 +----------------------------------------------------------
	 * 格式化商品价格
	 +----------------------------------------------------------
	 */
	function price_format($price = '', $decimals = '2')
	{
		$price = number_format($price, $decimals);
		$price_format = preg_replace('/d%/Ums', $price, $GLOBALS['_LANG']['price_format']);

		return $price_format;
	}

	/**
	 +----------------------------------------------------------
	 * 获取指定分类单页面列表
	 +----------------------------------------------------------
	 */
	function get_page_list($parent_id = '', $current_id)
	{
		if ($parent_id)
		{
			$where = "where parent_id = $parent_id ";
		}

		$sql = "SELECT * FROM " . $this->table('page') . $where . " ORDER BY id ASC";
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			$url = $this->rewrite_url('page', $row['id']);
			$cur = $this->dou_current('page', $row['id'], 'page', $current_id);

			$page_list[] = array (
				"id" => $row['id'],
				"parent_id" => $row['parent_id'],
				"page_name" => $row['page_name'],
				"cur" => $cur,
				"url" => $url
			);
		}

		return $page_list;
	}

	/**
	 +----------------------------------------------------------
	 * 分页
	 +----------------------------------------------------------
	 */
	function pager($table, $page_size = '10', $page, $cat_id = '')
	{
		$rewrite = intval($GLOBALS['_CFG']['rewrite']);

		if ($cat_id)
		{
			$where = " WHERE cat_id = $cat_id";
		}

		$sql = "SELECT * FROM " . $this->table($table) . $where;

		$record_count = mysql_num_rows($this->query($sql));

		$url = $this->rewrite_url($table . '_category', $cat_id);

		if ($rewrite)
		{
			$get_request = "/o";
		}
		else
		{
			$get_request = $cat_id ? "&page=" : "?page=";
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
			"last" => $last
		);

		$start = ($page -1) * $page_size;
		$limit = " LIMIT $start, $page_size";

		$GLOBALS['smarty']->assign('pager', $pager);

		return $limit;
	}

	/**
	 +----------------------------------------------------------
	 * 获取导航菜单
	 * $parent_id 默认获取一级导航
	 * $current_module 当前页面模型名称
	 * $current_id 当前页面分类ID
	 +----------------------------------------------------------
	 */
	function get_nav($parent_id = 0, $current_module = '', $current_id = '', $type = 'middle')
	{
		$sql = "SELECT * FROM " . $this->table('nav') . " WHERE parent_id = '$parent_id' AND type = '$type' ORDER BY sort,id ASC";
		$query = $this->query($sql);

		while ($row = $this->fetch_array($query))
		{
			if ($row['module'] == 'nav')
			{
				$url = $row['guide'];
			}
			else
			{
				$url = $this->rewrite_url($row['module'], $row['guide']);
			}
			
			$child = $this->get_nav_child($row['id']);
			$cur = $this->dou_current($row['module'], $row['guide'], $current_module, $current_id);

			$nav_list[] = array (
				"id" => $row['id'],
				"nav_name" => $row['nav_name'],
				"url" => $url,
				"sort" => $row['sort'],
				"cur" => $cur,
				"child" => $child
			);
		}

		return $nav_list;
	}

	/**
	 +----------------------------------------------------------
	 * 获取下级导航菜单
	 +----------------------------------------------------------
	 */
	function get_nav_child($parent_id = 0)
	{
		$sql = "SELECT * FROM " . $this->table('nav') . " WHERE parent_id = '$parent_id' ORDER BY sort, id ASC";
		$query = $this->query($sql);
		while ($row = $this->fetch_array($query))
		{
			if ($row['module'] == 'nav')
			{
				$url = $row['guide'];
			}
			else
			{
				$url = $this->rewrite_url($row['module'], $row['guide']);
			}

			$nav_list[] = array (
				"id" => $row['id'],
				"parent_id" => $row['parent_id'],
				"nav_name" => $row['nav_name'],
				"url" => $url
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
		$table_module = $module;
		
		//非单页面和分类模型下获取分类ID
		if (!strpos($module, 'category') && $module != 'page')
		{
			$id = $this->get_one("SELECT cat_id FROM " . $this->table($module) . " WHERE id = " . $id);
			$table_module = $module . '_category';
		}
		
		$unique_id = $this->get_one("SELECT unique_id FROM " . $this->table($table_module) . " WHERE " . $filed . " = " . $id);
		
		//把分类页和列表的别名统一
		$module = preg_replace("/\_category/",'',$module);
		
		//伪静态时使用的完整别名
		if ($module == 'page')
		{
			$unique = $unique_id;
		}
		elseif ($module == 'article')
		{
			$unique = $unique_id ? '/' . $unique_id : $unique_id;
			$unique = 'news' . $unique;
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
	 * 高亮当前菜单
	 +----------------------------------------------------------
	 */
	function dou_current($module, $id, $current_module, $current_id = '')
	{
		if ($id == $current_id && $module == $current_module)
		{
			return true;
		}
		elseif (!$id && $module == $current_module)
		{
			return true;
		}
	}
	
	/**
	 +----------------------------------------------------------
	 * 当前位置
	 +----------------------------------------------------------
	 */
	function ur_here($module, $cat_id = '', $title = '')
	{
		//如果是单页面，则只执行这一句
		if ($module == 'page')
		{
			return $title;
			exit ();
		}

		//模块名称
		$main = "<a href=" . $this->rewrite_url($module) . ">" . $GLOBALS['_LANG'][$module] . "</a>";

		//如果存在分类
		if ($cat_id)
		{
			$cat_name = $this->get_one("SELECT cat_name FROM " . $this->table($module) . " WHERE cat_id = '" . $cat_id . "'");

			//如果存在标题
			if ($title)
			{
				$category = "<b>></b><a href=" . $this->rewrite_url($module, $cat_id) . ">" . $cat_name . "</a>";
			}
			else
			{
				$category = "<b>></b>$cat_name";
			}
		}

		//如果存在标题
		if ($title)
		{
			$title = "<b>></b>" . $title;
		}

		$ur_here = $main . $category . $title;

		return $ur_here;
	}

	/**
	 +----------------------------------------------------------
	 * 标题
	 +----------------------------------------------------------
	 */
	function page_title($module, $cat_id = '', $title = '')
	{
		//如果是单页面，则只执行这一句
		if ($module == 'page')
		{
			return $title . " | " . $GLOBALS[_CFG]['site_name'];
			exit ();
		}

		//主栏目
		if ($GLOBALS['_LANG'][$module])
		{
			$main = $GLOBALS['_LANG'][$module] . " | ";
		}

		//如果存在分类
		if ($cat_id)
		{
			$cat_name = $this->get_one("SELECT cat_name FROM " . $this->table($module) . " WHERE cat_id = '" . $cat_id . "'");
			$category = $cat_name . " | ";
		}

		//如果存在标题
		if ($title)
		{
			$title = $title . " | ";
		}

		$page_title = $title . $category . $main . $GLOBALS[_CFG]['site_name'];

		return $page_title;
	}

	/**
	 +----------------------------------------------------------
	 * 清除html,换行，空格类
	 +----------------------------------------------------------
	 */
	function dou_substr($str, $length, $charset = "utf-8")
	{
		$str = trim($str); //清除字符串两边的空格
		$str = strip_tags($str, ""); //利用php自带的函数清除html格式
		$str = preg_replace("/\t/", "", $str); //使用正则表达式匹配需要替换的内容，如：空格，换行，并将替换为空。
		$str = preg_replace("/\r\n/", "", $str);
		$str = preg_replace("/\r/", "", $str);
		$str = preg_replace("/\n/", "", $str);
		$str = preg_replace("/ /", "", $str);
		$str = preg_replace("/&nbsp; /", "", $str); //匹配html中的空格
		$str = trim($str); //清除字符串两边的空格

		if (function_exists("mb_substr"))
		{
			$substr = mb_substr($str, 0, $length, $charset);
		}
		else
		{
			$c['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
			$c['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
			preg_match_all($c[$charset], $str, $match);
			$substr = join("", array_slice($match[0], 0, $length));
		}

		return $substr;
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
	 * 版本升级提示
	 +----------------------------------------------------------
	 */
	function dou_api($apiget)
	{
		return "http://api.douco.com/update.php" . '?' . $apiget;
	}

}
?>