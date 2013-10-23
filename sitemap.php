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
require(ROOT_PATH . 'include/sitemap.class.php');

if (!intval($GLOBALS['_CFG']['sitemap']))
{
	exit ();
}

$domain = ROOT_URL;
$today  = date('Y-m-d');

$sm = new SiteMap($domain, $today);
header('Content-type: application/xml; charset=utf-8');
die($sm-> build_sitemap());

?>