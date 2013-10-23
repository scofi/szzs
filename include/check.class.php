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

class Check
{
	/**
	 * 判断别名是否规范
	 */
	function is_unique_id($unique)
	{
		if (preg_match("/^[a-z0-9-]+$/", $unique))
		{
			return true;
		}
	}


}
?>