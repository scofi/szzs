-- MySQL dump 10.11
--
-- Host: localhost    Database: hzszzs
-- ------------------------------------------------------
-- Server version	5.0.45-community-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP DATABASE IF EXISTS hzszzs;
CREATE DATABASE hzszzs;
use hzszzs;
--
-- Table structure for table `hzsad`
--

DROP TABLE IF EXISTS `hzsad`;
CREATE TABLE `hzsad` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `ad_name` varchar(60) NOT NULL default '',
  `ad_link` varchar(255) NOT NULL default '',
  `ad_img` varchar(255) NOT NULL,
  `sort` tinyint(1) unsigned NOT NULL default '50',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzsad`
--

LOCK TABLES `hzsad` WRITE;
/*!40000 ALTER TABLE `hzsad` DISABLE KEYS */;
INSERT INTO `hzsad` VALUES (1,'广告图片01','http://www.douco.com','data/slide/20130514acunau.jpg',1),(2,'广告图片02','http://www.douco.com','data/slide/20130514rjzqdt.jpg',2),(3,'广告图片03','http://www.douco.com','data/slide/20130514xxsctt.jpg',3),(4,'广告图片04','http://www.douco.com','data/slide/20130523hiqafl.jpg',4);
/*!40000 ALTER TABLE `hzsad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsadmin`
--

DROP TABLE IF EXISTS `hzsadmin`;
CREATE TABLE `hzsadmin` (
  `user_id` smallint(5) unsigned NOT NULL auto_increment,
  `user_name` varchar(60) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `action_list` text NOT NULL,
  `add_time` int(11) NOT NULL default '0',
  `last_login` int(11) NOT NULL default '0',
  `last_ip` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzsadmin`
--

LOCK TABLES `hzsadmin` WRITE;
/*!40000 ALTER TABLE `hzsadmin` DISABLE KEYS */;
INSERT INTO `hzsadmin` VALUES (1,'admin','','96e79218965eb72c92a549dd5a330112','ALL',1382453013,1383407430,'127.0.0.1');
/*!40000 ALTER TABLE `hzsadmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsadmin_log`
--

DROP TABLE IF EXISTS `hzsadmin_log`;
CREATE TABLE `hzsadmin_log` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `create_time` int(10) unsigned NOT NULL default '0',
  `user_id` tinyint(3) unsigned NOT NULL default '0',
  `action` varchar(255) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `create_time` (`create_time`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzsadmin_log`
--

LOCK TABLES `hzsadmin_log` WRITE;
/*!40000 ALTER TABLE `hzsadmin_log` DISABLE KEYS */;
INSERT INTO `hzsadmin_log` VALUES (1,1381887740,1,'系统设置: 编辑成功','127.0.0.1'),(2,1381887745,1,'编辑导航: 公司简介','127.0.0.1'),(3,1381887749,1,'编辑幻灯: 广告图片01','127.0.0.1'),(4,1381887753,1,'编辑单页面: 联系我们','127.0.0.1'),(5,1381887756,1,'编辑商品分类: 电子数码','127.0.0.1'),(6,1381887759,1,'编辑文章分类: 公司动态','127.0.0.1'),(7,1381887775,1,'编辑单页面: 企业荣誉','127.0.0.1'),(8,1381887778,1,'编辑单页面: 公司简介','127.0.0.1'),(9,1381887781,1,'编辑单页面: 营销网络','127.0.0.1'),(10,1382453025,1,'管理员登录: 登录成功！','127.0.0.1'),(11,1382456642,1,'添加导航: 设为首页','127.0.0.1'),(12,1382456747,1,'删除导航: 设为首页','127.0.0.1'),(13,1382484608,1,'管理员登录: 登录成功！','127.0.0.1'),(14,1382484654,1,'编辑幻灯: 广告图片01','127.0.0.1'),(15,1382484706,1,'编辑幻灯: 广告图片03','127.0.0.1'),(16,1382484725,1,'编辑幻灯: 广告图片02','127.0.0.1'),(17,1382484753,1,'编辑幻灯: 广告图片04','127.0.0.1'),(18,1382571503,1,'管理员登录: 登录成功！','127.0.0.1'),(19,1382705008,1,'管理员登录: 登录成功！','127.0.0.1'),(20,1382714934,1,'管理员登录: 登录成功！','127.0.0.1'),(21,1382714996,1,'编辑导航: 作品案例','127.0.0.1'),(22,1382715030,1,'编辑导航: 企业详情','127.0.0.1'),(23,1382715067,1,'编辑导航: 精英团队','127.0.0.1'),(24,1382715106,1,'编辑导航: 在建工地','127.0.0.1'),(25,1382715125,1,'编辑导航: 业主评论','127.0.0.1'),(26,1382715149,1,'编辑导航: 免费预约','127.0.0.1'),(27,1382715168,1,'删除导航: 企业荣誉','127.0.0.1'),(28,1382715175,1,'删除导航: 发展历程','127.0.0.1'),(29,1382715181,1,'删除导航: 联系我们','127.0.0.1'),(30,1382715189,1,'删除导航: 电子数码','127.0.0.1'),(31,1382715196,1,'删除导航: 家居百货','127.0.0.1'),(32,1382715203,1,'删除导航: 母婴用品','127.0.0.1'),(33,1382715211,1,'删除导航: 公司动态','127.0.0.1'),(34,1382715218,1,'删除导航: 行业新闻','127.0.0.1'),(35,1382716415,1,'编辑商品: 亨氏Heinz金装粒粒面鳕鱼胡萝卜面','127.0.0.1'),(36,1382716562,1,'删除商品: 亨氏Heinz金装粒粒面鳕鱼胡萝卜面','127.0.0.1'),(37,1382716577,1,'删除商品: GOOD IN (\'14\',\'13\',\'12\',\'11\',\'10\',\'9\',\'8\',\'7\',\'6\',\'5\',\'4\',\'3\',\'2\',\'1\')','127.0.0.1'),(38,1382716615,1,'删除商品分类: 母婴用品','127.0.0.1'),(39,1382716780,1,'编辑商品分类: 作品案例','127.0.0.1'),(40,1382716874,1,'编辑商品分类: 在建工地','127.0.0.1'),(41,1382717015,1,'添加商品: 新凯家园','127.0.0.1'),(42,1382717291,1,'添加分类: 精英团队','127.0.0.1'),(43,1382717867,1,'系统设置: 编辑成功','127.0.0.1'),(44,1382717905,1,'系统设置: 编辑成功','127.0.0.1'),(45,1382717931,1,'系统设置: 编辑成功','127.0.0.1'),(46,1382718566,1,'编辑商品: 新凯家园十分丰富是否萨法撒旦 ','127.0.0.1'),(47,1382723024,1,'编辑商品: 新凯家园','127.0.0.1'),(48,1382723258,1,'添加商品: 正场自建别墅','127.0.0.1'),(49,1382723320,1,'添加商品: 德民花苑 ','127.0.0.1'),(50,1382723417,1,'添加商品: 设计牛人','127.0.0.1'),(51,1382724398,1,'删除导航: 联系我们','127.0.0.1'),(52,1382725609,1,'编辑文章分类: 问题咨询','127.0.0.1'),(53,1382725658,1,'添加文章: 请问价格区间有哪些','127.0.0.1'),(54,1382725989,1,'编辑文章分类: 免费量房','127.0.0.1'),(55,1382726041,1,'添加分类: 业主评论','127.0.0.1'),(56,1382727248,1,'添加文章:  家庭装修','127.0.0.1'),(57,1382727664,1,'添加文章: 选择涂料色彩时要全面考虑','127.0.0.1'),(58,1382727719,1,'添加文章: 曹小姐','127.0.0.1'),(59,1382787119,1,'管理员登录: 登录成功！','127.0.0.1'),(60,1382787128,1,'系统设置: 编辑成功','127.0.0.1'),(61,1382787455,1,'管理员登录: 登录成功！','127.0.0.1'),(62,1382787500,1,'系统设置: 编辑成功','127.0.0.1'),(63,1382789270,1,'编辑友情链接: 百度','127.0.0.1'),(64,1382789404,1,'系统设置: 编辑成功','127.0.0.1'),(65,1382789704,1,'系统设置: 编辑成功','127.0.0.1'),(66,1382844767,1,'管理员登录: 登录成功！','127.0.0.1'),(67,1382858981,1,'管理员登录: 登录成功！','127.0.0.1'),(68,1382859958,1,'编辑单页面: 杭州尚宅装饰公司','127.0.0.1'),(69,1382861055,1,'编辑单页面: 杭州尚宅装饰公司','127.0.0.1'),(70,1382961360,1,'管理员登录: 登录成功！','127.0.0.1'),(71,1383060764,1,'管理员登录: 登录成功！','127.0.0.1'),(72,1383063180,1,'系统设置: 编辑成功','127.0.0.1'),(73,1383064191,1,'系统设置: 编辑成功','127.0.0.1'),(74,1383064220,1,'系统设置: 编辑成功','127.0.0.1'),(75,1383064671,1,'删除商品: GOOD IN (\'102\',\'101\',\'100\',\'99\',\'98\',\'97\',\'95\',\'94\',\'93\',\'92\',\'91\',\'90\')','127.0.0.1'),(76,1383064692,1,'删除商品: GOOD IN (\'89\',\'88\',\'87\',\'86\',\'85\',\'84\')','127.0.0.1'),(77,1383064905,1,'添加商品: 测试3','127.0.0.1'),(78,1383065079,1,'添加商品: 测试4','127.0.0.1'),(79,1383065103,1,'添加商品: 测试5','127.0.0.1'),(80,1383065128,1,'添加商品: 测试6','127.0.0.1'),(81,1383070210,1,'添加商品: tese6','127.0.0.1'),(82,1383234261,1,'管理员登录: 登录成功！','127.0.0.1'),(83,1383392398,1,'管理员登录: 登录成功！','127.0.0.1'),(84,1383392417,1,'系统设置: 编辑成功','127.0.0.1'),(85,1383392540,1,'系统设置: 编辑成功','127.0.0.1'),(86,1383407430,1,'管理员登录: 登录成功！','127.0.0.1'),(87,1383407539,1,'删除文章:  家庭装修','127.0.0.1'),(88,1383407549,1,'删除文章分类: 免费量房','127.0.0.1'),(89,1383407667,1,'添加分类: 联系我们','127.0.0.1'),(90,1383407743,1,'添加文章: 联系我们 ','127.0.0.1'),(91,1383408372,1,'删除文章: ARTICLE IN (\'10\',\'6\',\'5\',\'4\',\'3\',\'2\',\'1\')','127.0.0.1'),(92,1383408380,1,'删除文章分类: 公司动态','127.0.0.1'),(93,1383408410,1,'编辑文章分类: 新闻中心','127.0.0.1');
/*!40000 ALTER TABLE `hzsadmin_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsarticle`
--

DROP TABLE IF EXISTS `hzsarticle`;
CREATE TABLE `hzsarticle` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `cat_id` smallint(5) NOT NULL default '0',
  `title` varchar(150) NOT NULL default '',
  `defined` text NOT NULL,
  `content` longtext NOT NULL,
  `keywords` varchar(255) NOT NULL default '',
  `add_time` int(10) unsigned NOT NULL default '0',
  `click` smallint(6) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzsarticle`
--

LOCK TABLES `hzsarticle` WRITE;
/*!40000 ALTER TABLE `hzsarticle` DISABLE KEYS */;
INSERT INTO `hzsarticle` VALUES (7,2,'移动互联网发展下的企业网变革','','移动互联网作为桌面互联网的一个延伸和发展，是一个以宽带IP为核心技术，可为智能移动终端提供语音、视频、图像等全媒体资讯以及数据全业务服务的下一代网络。智能手机和平板电脑的快速普及、应用程序的App化互联网交付、虚拟化与云计算等技术的快速发展，促使互联网正在极快地由传统的桌面互联网向移动互联网转变。<br />\r\n<br />\r\n在全新的移动互联网时代，传统的企业IT基础架构也要进行相应变革，以更好地适应业务互联网化、移动化的需求。本文将讨论在移动互联网快速发展的背景下，新一代企业网络相较于传统的企业网络将在如下方面进行的变化：建设新一代云中心(Cloud Center)采用混合云进行业务交付、通过Wi-Fi等技术实现统一稳定的终端连接(Connectivity)，通过Internet对设备进行透明的云管理(Cloud Management)，以支撑移动互联网业务的发展。<br />\r\n　　<br />\r\nNETGEAR亚太区技术总监杨子江<br />\r\n一、移动互联网发展下的企业应用新模式<br />\r\n移动互联网时代，企业将采用虚拟化技术协同，融合公有云和私有云，以强大的混合云方式通过SaaS(软件即服务)的方式，以互联网和企业内部网络基础架构为管道，通过智能移动终端承载企业的业务应用，直面未来需求。<br />\r\n<br />\r\n接入设备<br />\r\n桌面计算机和笔记本电脑是是传统常用的终端，最近这些年来包括如以IOS、 Android、Windows Mobile为系统的各种平板电脑、智能手机以及RFID标签设备及其他移动类设备发展极为迅速。<br />\r\n<br />\r\n接入时间、地点、人物<br />\r\n移动互联网环境下，工作人员摆脱了只有在固定地点、固定时间才能进行业务应用的局限,他们可以随时随地进行移动办公，任何人、任何设备、任何地点安全地运行在任何网络之上，这是以往以PC为基础的桌面互联网时代所未有的简单方便的接入。<br />\r\n<br />\r\n接入方式<br />\r\n移动互联网发展下企业网络常见有三种主流的终端联网方式：Wi-Fi无线接入(无线局域网)、3G/4G移动网络(无线广域网)、有线以太网接入(有线局域网)。<br />\r\n<br />\r\n应用 APP化<br />\r\n企业网的各种业务应用APP化，以互联网和企业内部的局域网络为管道，以移动终端为载体进行业务交付的模式已成为大趋势。<br />','移动互联网发展下的企业网变革',1372261909,2,''),(8,2,'企业网站文章标题该如何去撰写','','企业网站撰写文章目的是为什么?首先要请我们编辑或者是优化的人员想一想。如果你说只是为了更新，为了网站收录，获得搜索引擎的青睐。其实你错了，你已经走入了一个误区，那就是文章并不是给搜索引擎看的，而是给用户看。下面看单仁资讯先为你列出目前存在的一些误区，之后再提出一些建议。<br />\r\n<br />\r\n误区一：文章标题需要很吸引眼球<br />\r\n<br />\r\n有人就说了，文章标题是一篇文章是否成功的一半，只有文章标题好才能够吸引点击。其实这个说的是没错，但是这对于企业网站并不适合。试想用户到你网站难道就是去看文章的?当然不是。一般用户是有疑问或者需要解决什么问题，所以再去搜索，之后才会进入你的网站。当然你网站首页关键词是有限，所以还是需要靠文章或者产品的长尾词来进行扩充，这部分才是流量的主力军。就如“英特尔手机“农村包围城市”，就等厂商进来”虽然很吸引眼球但这样的标题用户会去搜索吗?反之在企业网站中我们就不应该进入这样的思维误区。<br />\r\n<br />\r\n误区二：标题很学术<br />\r\n<br />\r\n标题很学术，对于企业网站行不通。我们时刻应该要知道的就是企业文章是一种宣传，更是一种获取流量的最大的源泉。除非你的网站很知名，要不别人是不会进入你的网站，这个时候我们就需要通过一些解决用户，给用户提供比较有见解的文章来吸引用户。所以我们的标题也不能很学术，只需要站在一个用户的角度来思考问题即可。<br />\r\n<br />\r\n建议：<br />\r\n<br />\r\n一：企业文章标题是吸引用户点击进来，也是用户搜索进入的第一个接口，我们不能只考虑到吸引，但是没有想到是否有用户去搜索。企业写文章主要应该是站在用户的角度，帮助用户解决问题，这样这篇文章才会被人搜索到，才会有价值的存在。比如“企业如何做好网络营销”这个文章标题不是那么的夺目，但是会给用户解决问题，能够告诉用户怎么去做网络营销，当有不知道的如何去做网络营销的用户，就会有去搜索，当你能够解决他的问题，这样这篇文章才是成功的。<br />\r\n<br />\r\n二：标题需要直白而且用户常搜索，标题写的好，但是没人搜索，也就没人去看你这篇文章。所以我们应该需要直白的标题，还有就是组合用户常搜索的关键词。这样就会当用户搜索的时候搜索引擎就会判断，当你标题中含有用户搜索的关键词，这个时候也就会排名靠前。<br />\r\n<br />\r\n　　所以作为一名编辑，我们不能够只是站在自己的角度来写文章标题，我们应该是站在用户的角度来撰写标题。对于一家企业来说，我们在互联网上要想获得客户，我们就需要从细节出发，就如文章的标题，我们都需要考虑很多。只有全面，够系统，网站才能够真正的成为金牌业务员。<br />','企业网站文章标题该如何去撰写',1372261997,0,''),(9,2,'详解如何利用RSS进行网络推广','','网络推广方法有很多，RSS推广就是其中的一种，RSS订阅能够为网站增加访问量，这是众人皆知的事实。不过，如何推广RSS，让更多人知道并促使更多人订阅RSS，却是一个很大的问题。下面就有我给大家讲解一下什么事RSS推广，如何利用RSS进行网络推广。<br />\r\n<br />\r\n首先来说说什么是RSS？<br />\r\n<br />\r\nRSS是在线共享内容的一种简单方式（也叫聚合内容，Really Simple Syndication）。通常在时效性比较强的内容上使用RSS订阅能更快速获取信息。网站提供RSS输出，有利于让用户获取网站内容的最新信息。网络用户可以在客户端借助于支持RSS的聚合工具软件（如SharpReader，NwezCrawler，FeedDemon），在不打开网站内容页面的情况下阅读支持RSS输出的网站内容。<br />\r\n<br />\r\n那么RSS有什么用途呢？<br />\r\n<br />\r\n订阅BLOG，可以订阅工作中所需的技术文章，也可以订阅与你有共同爱好的作者的Blog，总之，对什么感兴趣就可以订什么。<br />\r\n<br />\r\n订阅新闻，无论是奇闻怪事、明星消息、体坛风云，只要你想知道的，都可以订阅。<br />\r\n<br />\r\n你再也不用一个网站一个网站，一个网页一个网页去逛了。只要这将你需要的内容订阅在一个RSS阅读器中，这些内容就会自动出现你的阅读器里，你也不必为了一个急切想知道的消息而不断的刷新网页，因为一旦有了更新，RSS阅读器就会自己通知你。<br />\r\n<br />\r\n什么是RSS推广？<br />\r\n<br />\r\nRSS推广即指利用RSS这一互联网工具传递营销信息的网络营销推广模式。RSS推广通常是与EDM（电子邮件营销）配合使用的。因为RSS的特点比EDM具有更多的优势，可以对后者进行替代和补充。且RSS与EDM也有许多相似之处，它们之间的根本区别是向用户传递有价值信息的方式不同。RSS和EDM相比，主要有一下几个有点：<br />\r\n<br />\r\n1、多样性、个性化信息的聚合。RSS是一种基于XML（Extensible Markup Language，扩展性标识语言）标准，是一种互联网上被广泛采用的内容包装和投递协议，任何内容源都可以采用这种方式来发布，包括专业新闻、网络营销、企业、甚至个人等站点。若在用户端安装了RSS阅读器软件，用户就可以按照喜好、有选择性地将感兴趣的内容来源聚合到该软件的界面中，为用户提供多来源信息的“一站式”服务。<br />\r\n<br />\r\n2、信息发布的时效强、成本低廉。由于用户端RSS阅读器中的信息是随着订阅源信息的更新而及时更新的，所以极大地提高了信息的时效性和价值。此外，服务器端信息的RSS包装在技术实现上极为简单，而且是一次性的工作，使长期的信息发布边际成本几乎降为零，这完全是传统的电子邮件、互联网浏览等发布方式所无法比拟的。<br />\r\n<br />\r\n3、无“垃圾”信息和信息量过大的问题。RSS阅读器中的信息是完全由用户订阅的，对于用户没有订阅的内容，以及弹出式广告、垃圾邮件等无关信息则会被完全屏蔽掉。因而不会有令人烦恼的“噪音”干扰。此外，在用户端获取信息并不需要专用的类似电子邮箱那样的“RSS 信箱”来存储，因而不必担心信息内容的过大问题。<br />\r\n<br />\r\n4、没有病毒邮件的影响。在RSS阅读器中保存的只是所订阅信息的摘要，要查看其详细内容与到网站上通过浏览器阅读没有太大差异，因而不必担心病毒邮件的危害。<br />\r\n<br />\r\n5、本地内容管理便利。对下载到RSS阅读器里订阅内容，用户可以进行离线阅读、存档保留、搜索排序及相关分类等多种管理操作，使阅读器软件不仅是一个“阅读”器，而且还是一个用户随身的“资料库”。<br />\r\n<br />\r\n虽然RSS的有点很多，但是缺点也很明显。RSS营销的定位性不如EDM强，我们很难主动选择让谁订阅我们的RSS，因此RSS很难实现个性化营销。同时RSS也不容易做到像EDM那样跟踪营销的效果。<br />\r\n<br />\r\n总之，RSS与EDM相比具有很大的优势，特别是克服了EDM中常出现的垃圾邮件、病毒、信息即时性差等致命缺点，因而将有力地促进RSS的推广应用。所以，网络推广者者一定要加以足够地重视，以增强自己的竞争优势。当然RSS营销模式还有很多的问题要面对，对于如何有效地利用更需深入地研究探讨。<br />\r\n<br />\r\n前面说过RSS推广处于刚起步阶段，是一种新式的网络推广方法，下面我在介绍一下RSS推广实战操作的方法，主要有以下几种简单方法：<br />\r\n<br />\r\n1、提交RSS<br />\r\n<br />\r\n提交到哪里呢？网络上有很多专门针对RSS的搜索引擎和RSS分类目录，我们贺姨将网站的RSS提交给这些站点。这样不仅可以促进搜索引擎收录、增加RSS曝光率，还能为网站增加链接广度；既可以带来流量，又能加快搜索引擎收录与信息的推广。<br />\r\n<br />\r\n2、RSS图标<br />\r\n<br />\r\n有条件的话给你的网站增加RSS订阅吧，并将网站RSS订阅图标放在醒目的位置。<br />\r\n<br />\r\n3、量身定制内容<br />\r\n<br />\r\n针对不同的用户推送不同的内容，让用户愿意去订阅他们想要的内容。<br />\r\n<br />\r\n4、邮件中增加RSS订阅链接<br />\r\n<br />\r\n一种不错的病毒式推广，一方面是EDM的补充，随着网民网龄的增加，使用RSS代替EDM的会越来越多。<br />\r\n<br />\r\n5、多功能应用<br />\r\n<br />\r\n比如让用户通过RSS订阅的方式获取天气预报、订阅感兴趣的分类广告信息，网络商城还可以用它来传递物流跟踪信息、传递商品打折通知、拍卖商品的实时竞价情况等等。<br />','详解如何利用RSS进行网络推广',1372262040,13,'详解如何利'),(11,3,'请问价格区间有哪些','','请问价格区间有哪些','',1382725658,0,''),(29,6,'联系我们 ','','<h3>\r\n	<span style=\"background-color:#ffffff;\"><span style=\"font-weight:bold;\">从尚装饰</span></span>\r\n</h3>\r\n<h3>\r\n	<span style=\"background-color:#ffffff;\"><span style=\"color:#000000;\"><span style=\"font-weight:bold;\">电话</span>：0513-80212220</span></span>\r\n</h3>\r\n<p style=\"font-family:宋体, Arial, Helvetica, sans-serif;color:#666666;font-size:14px;\">\r\n	<span style=\"background-color:#ffffff;\"><span style=\"color:#000000;\"><span style=\"font-weight:bold;\">手机</span>：15695261314</span></span>\r\n</p>\r\n<p style=\"font-family:宋体, Arial, Helvetica, sans-serif;color:#666666;font-size:14px;\">\r\n	<span style=\"background-color:#ffffff;\"><span style=\"color:#000000;\"><span style=\"font-weight:bold;\">传真</span>：0513-80212220</span></span>\r\n</p>\r\n<p style=\"font-family:宋体, Arial, Helvetica, sans-serif;color:#666666;font-size:14px;\">\r\n	<span style=\"background-color:#ffffff;\"><span style=\"color:#000000;\"><span style=\"font-weight:bold;\">邮箱</span>：<a href=\"mailto:529022345@qq.com\">529022345@qq.com</a></span></span>\r\n</p>\r\n<p style=\"font-family:宋体, Arial, Helvetica, sans-serif;color:#666666;font-size:14px;\">\r\n	<span style=\"background-color:#ffffff;\"><span style=\"color:#000000;\"><b>扣扣</b>：529022345</span></span>\r\n</p>\r\n<p style=\"font-family:宋体, Arial, Helvetica, sans-serif;color:#666666;font-size:14px;\">\r\n	<span style=\"background-color:#ffffff;\"><span style=\"color:#000000;\"><span style=\"font-weight:bold;\">地址</span>：南通崇川区钟秀中路91号北濠大厦14楼</span></span>\r\n</p>\r\n<p style=\"font-family:宋体, Arial, Helvetica, sans-serif;color:#666666;font-size:14px;\">\r\n	<span style=\"background-color:#ffffff;\"><span style=\"color:#000000;\"><span style=\"font-weight:bold;\">公交线路</span>：公交：乘坐16路 到 财神道精品家居馆 下车向东步行300米 乘坐55路 到 北濠新村二桥 下车步行53米 乘坐24路 到 钟秀路濠西路西 下车步行59米</span></span>\r\n</p>','',1383407743,12,''),(13,3,'选择涂料色彩时要全面考虑','','如何<a href=\"http://www.conshan.com/Content.aspx?id=231\"><strong><span style=\"background-color:;\">选择涂料色彩时要全面考虑</span></strong></a>','',1382727664,1,''),(14,5,'曹小姐','','装修真是件麻烦事，光选装饰公司就是件头疼的事，最后选择了朋友推荐的从尚，符设计不愧资深设计师，对我们家的风格、格局设计的一步到位，价格也很便宜','',1382727719,2,''),(15,5,'曹小姐','','装修真是件麻烦事，光选装饰公司就是件头疼的事，最后选择了朋友推荐的从尚，符设计不愧资深设计师，对我们家的风格、格局设计的一步到位，价格也很便宜','',1382727719,2,''),(16,5,'曹小姐','','装修真是件麻烦事，光选装饰公司就是件头疼的事，最后选择了朋友推荐的从尚，符设计不愧资深设计师，对我们家的风格、格局设计的一步到位，价格也很便宜','',1382727719,4,''),(28,5,'徐先生','','其实真的很坑爹非常坑爹特别坑爹其实真的很坑爹非常坑爹特别坑爹其实真的很坑爹非常坑爹特别坑爹其实真的很坑爹非常坑爹特别坑爹<br>','111',1383390023,0,'');
/*!40000 ALTER TABLE `hzsarticle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsarticle_category`
--

DROP TABLE IF EXISTS `hzsarticle_category`;
CREATE TABLE `hzsarticle_category` (
  `cat_id` smallint(5) NOT NULL auto_increment,
  `unique_id` varchar(30) NOT NULL default '',
  `cat_name` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `sort` tinyint(1) unsigned NOT NULL default '50',
  PRIMARY KEY  (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzsarticle_category`
--

LOCK TABLES `hzsarticle_category` WRITE;
/*!40000 ALTER TABLE `hzsarticle_category` DISABLE KEYS */;
INSERT INTO `hzsarticle_category` VALUES (2,'industry','新闻中心','行业新闻','最新行业资讯和公司的新闻',20),(3,'askquesstion','问题咨询','','',50),(6,'contact','联系我们','联系我们','',50),(5,'ownercomments','业主评论','','',50);
/*!40000 ALTER TABLE `hzsarticle_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsbuildings`
--

DROP TABLE IF EXISTS `hzsbuildings`;
CREATE TABLE `hzsbuildings` (
  `id` int(11) NOT NULL auto_increment COMMENT '作品Id',
  `houses` varchar(50) NOT NULL COMMENT '楼盘',
  `house_type` varchar(50) default NULL COMMENT '房屋类型',
  `house_structure` varchar(50) default NULL COMMENT '户型结构',
  `house_proportion` varchar(50) default NULL COMMENT '户型面积',
  `design_style` varchar(50) default NULL COMMENT '设计风格',
  `house_place` varchar(50) default NULL COMMENT '空间场所',
  `house_hue` varchar(50) default NULL COMMENT '设计风格--色调',
  `house_designer_id` int(11) default NULL,
  `house_images` varchar(1000) default NULL COMMENT '作品图片，命名格式：作品id_图片编号.jpg(eg: 1_1.jpg）图片间以空格隔开',
  `house_status` int(11) default '2' COMMENT '作品状态：0--在建中  1——已完成',
  `add_time` datetime NOT NULL COMMENT '添加时间',
  `sort_value` int(11) NOT NULL default '0' COMMENT '作品排序值，值越大，排序越靠前',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='存储作品案例和在建工地信息';

--
-- Dumping data for table `hzsbuildings`
--

LOCK TABLES `hzsbuildings` WRITE;
/*!40000 ALTER TABLE `hzsbuildings` DISABLE KEYS */;
INSERT INTO `hzsbuildings` VALUES (1,'正场自建别墅 ','独栋别墅','六室三厅三卫','232平','简欧','客厅',NULL,1,'images/product/16.jpg images/product/104.jpg images/product/16.jpg images/product/106.jpg images/product/107.jpg images/product/104.jpg',2,'2013-12-19 12:34:13',3),(2,'测试2 ','茅草房','三卫','123平','重装','厕所',NULL,2,'images/product/104.jpg images/product/104.jpg images/product/104.jpg',1,'2013-12-19 12:34:13',3),(3,'东欧茅草房 ','独栋别墅','1仓','26平','简欧','厨房',NULL,1,'images/product/106.jpg  images/product/106.jpg ',2,'2013-12-19 12:34:13',3),(4,'西北大帐篷 ','茅草房','一穴','13平','重装','地下室',NULL,2,'images/product/107.jpg',1,'2013-12-19 12:34:13',3),(5,'正场自建别墅 ','独栋别墅','六室三厅三卫','232平','简欧','客厅',NULL,1,'images/product/16.jpg images/product/104.jpg images/product/16.jpg images/product/106.jpg images/product/107.jpg images/product/104.jpg',2,'2013-12-19 12:34:13',3),(6,'测试2 ','茅草房','三卫','123平','重装','厕所',NULL,2,'images/product/104.jpg images/product/104.jpg images/product/104.jpg',1,'2013-12-19 12:34:13',3),(7,'东欧茅草房 ','独栋别墅','1仓','26平','简欧','厨房',NULL,1,'images/product/106.jpg images/product/106.jpg',1,'2013-12-19 12:34:13',3),(8,'西北大帐篷 ','茅草房','一穴','13平','重装','地下室',NULL,2,'images/product/107.jpg ',1,'2013-12-19 12:34:13',3),(9,'正场自建别墅 ','独栋别墅','六室三厅三卫','232平','简欧','客厅',NULL,1,'images/product/16.jpg images/product/104.jpg images/product/16.jpg images/product/106.jpg images/product/107.jpg images/product/104.jpg',1,'2013-12-19 12:34:13',3),(10,'测试2 ','茅草房','三卫','123平','重装','厕所',NULL,2,'images/product/104.jpg images/product/104.jpg images/product/104.jpg',1,'2013-12-19 12:34:13',3),(11,'东欧茅草房 ','独栋别墅','1仓','26平','简欧','厨房',NULL,1,'images/product/106.jpg  images/product/106.jpg ',1,'2013-12-19 12:34:13',3),(12,'西北大帐篷 ','茅草房','一穴','13平','重装','地下室',NULL,2,'images/product/107.jpg ',2,'2013-12-19 12:34:13',3),(13,'正场自建别墅 ','独栋别墅','六室三厅三卫','232平','简欧','客厅',NULL,1,'images/product/16.jpg images/product/104.jpg images/product/16.jpg images/product/106.jpg images/product/107.jpg images/product/104.jpg',2,'2013-12-19 12:34:13',3),(14,'测试2 ','茅草房','三卫','123平','重装','厕所',NULL,2,'images/product/104.jpg images/product/104.jpg images/product/104.jpg',1,'2013-12-19 12:34:13',3),(15,'东欧茅草房 ','独栋别墅','1仓','26平','简欧','厨房',NULL,1,'images/product/106.jpg  images/product/106.jpg ',1,'2013-12-19 12:34:13',3),(16,'西北大帐篷 ','茅草房','一穴','13平','重装','地下室',NULL,2,'images/product/107.jpg ',1,'2013-12-19 12:34:13',3);
/*!40000 ALTER TABLE `hzsbuildings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsconfig`
--

DROP TABLE IF EXISTS `hzsconfig`;
CREATE TABLE `hzsconfig` (
  `name` varchar(80) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(10) NOT NULL default '',
  `box` varchar(255) NOT NULL default '',
  `tab` varchar(10) NOT NULL default 'main',
  `sort` tinyint(3) unsigned NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzsconfig`
--

LOCK TABLES `hzsconfig` WRITE;
/*!40000 ALTER TABLE `hzsconfig` DISABLE KEYS */;
INSERT INTO `hzsconfig` VALUES ('site_name','杭州尚宅装饰官方网站','text','','main',1),('site_title','杭州尚宅装饰官方网站','text','','main',2),('site_keywords','杭州尚宅装饰官方网站','text','','main',3),('site_description','杭州尚宅装饰官方网站','text','','main',4),('site_theme','default','select','','main',5),('site_logo','logo.gif','file','','main',6),('site_address','福建省漳州市芗城区','text','','main',7),('site_closed','0','radio','','main',8),('icp','','text','','main',9),('tel','0596-8888888','text','','main',10),('fax','0596-6666666','text','','main',11),('qq','1101322632,1101322632,1101322632,1101322632','text','','main',12),('email','your@domain.com','text','','main',13),('language','zh_cn','select','','main',14),('rewrite','0','radio','','main',15),('sitemap','1','radio','','main',16),('code','','textarea','','main',17),('display_product','10','text','','display',1),('display_article','10','text','','display',2),('home_display_product','6','text','','display',3),('home_display_article','5','text','','display',4),('thumb_width','135','text','','display',5),('thumb_height','135','text','','display',6),('defined_product','','text','','defined',1),('defined_article','','text','','defined',2),('build_date','1382453013','hidden','','',100),('hash_code','ae4f111fb516d9dad784431ff86c40ac','hidden','','',101),('douphp_version','v1.0 BETA4 20131012','hidden','','',102);
/*!40000 ALTER TABLE `hzsconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzslink`
--

DROP TABLE IF EXISTS `hzslink`;
CREATE TABLE `hzslink` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `link_name` varchar(60) NOT NULL default '',
  `link_url` varchar(255) NOT NULL default '',
  `sort` tinyint(1) unsigned NOT NULL default '50',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzslink`
--

LOCK TABLES `hzslink` WRITE;
/*!40000 ALTER TABLE `hzslink` DISABLE KEYS */;
INSERT INTO `hzslink` VALUES (1,'百度','http://www.baidu.com',127);
/*!40000 ALTER TABLE `hzslink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsnav`
--

DROP TABLE IF EXISTS `hzsnav`;
CREATE TABLE `hzsnav` (
  `id` mediumint(8) NOT NULL auto_increment,
  `module` varchar(20) NOT NULL,
  `nav_name` varchar(255) NOT NULL,
  `guide` varchar(255) NOT NULL,
  `parent_id` smallint(5) NOT NULL default '0',
  `type` varchar(10) NOT NULL,
  `sort` tinyint(1) unsigned NOT NULL default '50',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzsnav`
--

LOCK TABLES `hzsnav` WRITE;
/*!40000 ALTER TABLE `hzsnav` DISABLE KEYS */;
INSERT INTO `hzsnav` VALUES (1,'page','企业详情','1',0,'middle',10),(5,'buildings_category','作品案例','1',0,'middle',20),(6,'buildings_category','在建工地','2',0,'middle',30),(7,'article_category','业主评论','5',0,'middle',40),(8,'order','免费预约','0',0,'middle',60),(15,'team_category','精英团队','2',0,'middle',50),(16,'page','联系我们','4',0,'top',50),(17,'page','公司简介','1',0,'bottom',10),(18,'page','营销网络','6',0,'bottom',20),(19,'page','企业荣誉','2',0,'bottom',30),(20,'page','人才招聘','5',0,'bottom',40),(21,'page','联系我们','4',0,'bottom',50);
/*!40000 ALTER TABLE `hzsnav` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsorder`
--

DROP TABLE IF EXISTS `hzsorder`;
CREATE TABLE `hzsorder` (
  `id` int(11) NOT NULL auto_increment COMMENT '预约Id',
  `name` varchar(20) NOT NULL COMMENT '业主姓名',
  `phone` varchar(12) NOT NULL COMMENT '联系电话',
  `estate_name` varchar(50) default NULL COMMENT '小区名称',
  `detail_address` varchar(200) default NULL COMMENT '详尽地址',
  `house_type` varchar(20) default NULL COMMENT '房屋户型',
  `decorate_type` varchar(20) default NULL COMMENT '装修类型',
  `decorate_method` varchar(20) default NULL COMMENT '装修方式',
  `expect_start_time` varchar(20) default NULL COMMENT '期望开始装修时间',
  `decorate_request` varchar(1000) default NULL COMMENT '装修要求',
  `order_status` int(11) NOT NULL default '0' COMMENT '预约申请状态：0--待处理  1——已处理',
  `add_time` datetime NOT NULL COMMENT '添加时间',
  `budget` varchar(30) default NULL,
  `house_area` varchar(20) default NULL COMMENT '房屋面积',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='存储预约信息';

--
-- Dumping data for table `hzsorder`
--

LOCK TABLES `hzsorder` WRITE;
/*!40000 ALTER TABLE `hzsorder` DISABLE KEYS */;
INSERT INTO `hzsorder` VALUES (1,'王先生','120','紫薇花园','静安区','三室两厅','精装','全包','2012-12-19 12:01:12','要最好的',1,'2013-10-11 12:11:11','2-5万','34平米'),(2,'王先生','120','紫薇花园','静安区','三室两厅','精装','全包','2013-10-19 12:01:12','要最好的',1,'2013-01-11 12:11:11','2-5万','34平米'),(3,'王先生','120','紫薇花园','静安区','三室两厅','精装','全包','2012-12-19 12:01:12','要最好的',1,'2013-02-11 12:11:11','2-5万','34平米'),(4,'王先生','120','紫薇花园','静安区','三室两厅','精装','全包','2010-12-19 12:01:12','要最好的',1,'2013-03-11 12:11:11','2-5万','34平米'),(12,'徐先生','129088786','沁水新城','地球上','室1卫','商业装修','半包','明天 ','要弄好',1,'2013-11-02 23:45:58','3~4万','111平米');
/*!40000 ALTER TABLE `hzsorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzspage`
--

DROP TABLE IF EXISTS `hzspage`;
CREATE TABLE `hzspage` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `unique_id` varchar(30) NOT NULL default '',
  `parent_id` smallint(5) NOT NULL default '0',
  `page_name` varchar(150) NOT NULL default '',
  `content` longtext NOT NULL,
  `keywords` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzspage`
--

LOCK TABLES `hzspage` WRITE;
/*!40000 ALTER TABLE `hzspage` DISABLE KEYS */;
INSERT INTO `hzspage` VALUES (1,'about',0,'杭州尚宅装饰公司','<p>\r\n	DouPHP 是一款轻量级企业网站管理系统，基于PHP+Mysql架构的，可运行在Linux、Windows、MacOSX、Solaris等各种平台上，系统搭载Smarty模板引擎，支持自定义伪静态，前台模板采用DIV+CSS设计，后台界面设计简洁明了，功能简单易具有良好的用户体验，稳定性好、扩展性及安全性强，可面向中小型站点提供网站建设解决方案。\r\n</p>\r\n<p>\r\n	<img src=\"/images/upload/image/20131027/20131027080403_39588.jpg\" alt=\"\" />\r\n</p>','公司简介','公司简介'),(2,'honor',1,'企业荣誉','企业荣誉','企业荣誉','企业荣誉'),(3,'history',1,'发展历程','发展历程','发展历程','发展历程'),(4,'contact',1,'联系我们','通讯地址：<br />\r\n<span style=\"color:#D7D7D7;\">--------------------------------------------------------------------------------------------------------------------------------</span><br />\r\n福建省漳州市芗城区胜利东路天下广场C6幢707，邮编363000<br />\r\n&nbsp;<br />\r\n客服邮箱：<br />\r\n<span style=\"color:#D7D7D7;\">--------------------------------------------------------------------------------------------------------------------------------</span><br />\r\nDouCo售后服务邮箱：service@douco.com<br />\r\nDouCo业务受理邮箱：hi@douco.com<br />\r\n如您需要订制开发请在邮件中注明您的大概要求，我们将在一个工作日内给予回复。<br />\r\n&nbsp;<br />\r\n客服电话：<br />\r\n<span style=\"color:#D7D7D7;\">--------------------------------------------------------------------------------------------------------------------------------</span><br />\r\nDouCo的建站咨询电话为400-606-1245 或者 0596-2523596。<br />\r\n客服电话工作时间为周一至周日 8:00-20:00，节假日不休息，免长途话费。<br />\r\n我们将随时为您献上真诚的服务。<br />\r\n&nbsp;<br />\r\n网站网址：<br />\r\n<span style=\"color:#D7D7D7;\">--------------------------------------------------------------------------------------------------------------------------------</span><br />\r\nwww.douco.com<br />','联系我们','联系我们'),(5,'job',0,'人才招聘','人才招聘','人才招聘','人才招聘'),(6,'market',0,'营销网络','营销网络','营销网络','营销网络');
/*!40000 ALTER TABLE `hzspage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsproduct`
--

DROP TABLE IF EXISTS `hzsproduct`;
CREATE TABLE `hzsproduct` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `cat_id` smallint(5) NOT NULL default '0',
  `product_name` varchar(150) NOT NULL default '',
  `price` decimal(10,2) unsigned NOT NULL default '0.00',
  `defined` text NOT NULL,
  `content` longtext NOT NULL,
  `product_image` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `add_time` int(10) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzsproduct`
--

LOCK TABLES `hzsproduct` WRITE;
/*!40000 ALTER TABLE `hzsproduct` DISABLE KEYS */;
INSERT INTO `hzsproduct` VALUES (80,1,'正场自建别墅','0.00','','','images/product/80.jpg','',1382723258,''),(81,2,'德民花苑 ','0.00','','','images/product/81.jpg','',1382723320,''),(82,4,'设计牛人','0.00','','','images/product/82.jpg','',1382723417,''),(83,1,'正场自建别墅','0.00','','','images/product/80.jpg','',0,''),(108,0,'tese6','0.00','','','images/product/108.jpg','',1383070210,''),(107,2,'测试6','0.00','','','images/product/107.jpg','',1383065128,''),(106,0,'测试5','0.00','','','images/product/106.jpg','',1383065103,''),(104,1,'测试3','111.00','','','images/product/104.jpg','',1383064905,''),(105,2,'测试4','0.00','','','images/product/105.jpg','',1383065079,''),(96,2,'德民花苑 ','0.00','','','images/product/81.jpg','',0,''),(103,4,'设计牛人','0.00','','','images/product/82.jpg','',0,'');
/*!40000 ALTER TABLE `hzsproduct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsproduct_category`
--

DROP TABLE IF EXISTS `hzsproduct_category`;
CREATE TABLE `hzsproduct_category` (
  `cat_id` smallint(5) NOT NULL auto_increment,
  `unique_id` varchar(30) NOT NULL default '',
  `cat_name` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `sort` tinyint(1) unsigned NOT NULL default '50',
  PRIMARY KEY  (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hzsproduct_category`
--

LOCK TABLES `hzsproduct_category` WRITE;
/*!40000 ALTER TABLE `hzsproduct_category` DISABLE KEYS */;
INSERT INTO `hzsproduct_category` VALUES (1,'work-list','作品案例','房屋装饰','装饰房屋',10),(2,'buildings','在建工地','装饰房屋','装饰房屋',20),(4,'best-team','精英团队','','',50);
/*!40000 ALTER TABLE `hzsproduct_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hzsteam`
--

DROP TABLE IF EXISTS `hzsteam`;
CREATE TABLE `hzsteam` (
  `id` int(11) NOT NULL default '0' COMMENT '设计师Id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `graduate_from` varchar(50) default NULL COMMENT '毕业院校',
  `position` varchar(50) default NULL COMMENT '职位',
  `working_time` varchar(50) default NULL COMMENT '从业年限',
  `skilled_in_style` varchar(100) default NULL COMMENT '擅长风格',
  `design_philosophy` varchar(400) default NULL COMMENT '设计理念',
  `honor` varchar(1000) default NULL COMMENT '个人荣誉',
  `working_experience` varchar(1000) default NULL COMMENT '工作经历',
  `sex` varchar(5) default NULL COMMENT '性别：0--男、1--女',
  `occupational_identity` varchar(50) default NULL COMMENT '职业身份',
  `address` varchar(100) default NULL COMMENT '现在居住地',
  `design_price` varchar(50) default NULL COMMENT '设计费，eg:150元/平米',
  `skilled_in_project` varchar(100) default NULL COMMENT '擅长项目',
  `skilled_in_area` varchar(100) default NULL COMMENT '擅长领域',
  `add_time` datetime NOT NULL COMMENT '添加时间',
  `sort_value` int(11) NOT NULL default '0' COMMENT '作品排序值，值越大，排序越靠前',
  `image` varchar(50) default NULL COMMENT '相片',
  `start_work_time` varchar(50) default NULL COMMENT '从业时间',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='存储精英团队中每一个人的信息';

--
-- Dumping data for table `hzsteam`
--

LOCK TABLES `hzsteam` WRITE;
/*!40000 ALTER TABLE `hzsteam` DISABLE KEYS */;
INSERT INTO `hzsteam` VALUES (1,' 吴春','北京科技大学','设计师 ','三年~五年','现代,简欧,田园风格,混搭 ','对于设计有着不断探索，追求一种真实与想象空间结合的成果，适用各种实质的物料、光线与影像的新技术做法，色彩、质感、艺术品、时尚的家具搭配，合理的人性空间，完美的设计理念，为业主创造完善的生活空间，演绎自我的居饰品味。','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院\r <br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br>2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院<br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br> 2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','男','首席设计师',NULL,'40~60元 / 平米','复式及别墅高端设计、普通家装','住宅公寓,写字楼,专卖展示店,其他','2013-10-10 10:00:00',0,'images/product/108.jpg',NULL),(2,' 张藏','西安邮电太学','设计师','八年','现代,简欧,田园风格,混搭 ','对于设计有着不断探索，追求一种真实与想象空间结合的成果，适用各种实质的物料、光线与影像的新技术做法，色彩、质感、艺术品、时尚的家具搭配，合理的人性空间，完美的设计理念，为业主创造完善的生活空间，演绎自我的居饰品味。','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院<br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家','2004-2005常州强龙装饰设计师 <br>2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院<br> ','男','小跟班','月球','400~600元 / 平米',NULL,'住锋','2015-10-10 00:10:00',0,'images/product/105.jpg','去年'),(3,' 吴春','北京科技大学','设计师 ','设计师','现代,简欧,田园风格,混搭 ','对于设计有着不断探索，追求一种真实与想象空间结合的成果，适用各种实质的物料、光线与影像的新技术做法，色彩、质感、艺术品、时尚的家具搭配，合理的人性空间，完美的设计理念，为业主创造完善的生活空间，演绎自我的居饰品味。','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院\r <br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br>2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院<br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br> 2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','男','首席设计师',NULL,'40~60元 / 平米','复式及别墅高端设计、普通家装','住宅公寓,写字楼,专卖展示店,其他','2013-10-10 10:00:00',0,'images/product/108.jpg',NULL),(4,' 吴春','北京科技大学','设计师 ','三年~五年','现代,简欧,田园风格,混搭 ','对于设计有着不断探索，追求一种真实与想象空间结合的成果，适用各种实质的物料、光线与影像的新技术做法，色彩、质感、艺术品、时尚的家具搭配，合理的人性空间，完美的设计理念，为业主创造完善的生活空间，演绎自我的居饰品味。','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院\r <br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br>2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院<br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br> 2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','男','首席设计师',NULL,'40~60元 / 平米','复式及别墅高端设计、普通家装','住宅公寓,写字楼,专卖展示店,其他','2013-10-10 10:00:00',0,'images/product/108.jpg',NULL),(5,' 吴春','北京科技大学','设计师 ','三年~五年','现代,简欧,田园风格,混搭 ','对于设计有着不断探索，追求一种真实与想象空间结合的成果，适用各种实质的物料、光线与影像的新技术做法，色彩、质感、艺术品、时尚的家具搭配，合理的人性空间，完美的设计理念，为业主创造完善的生活空间，演绎自我的居饰品味。','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院\r <br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br>2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院<br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br> 2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','男','首席设计师',NULL,'40~60元 / 平米','复式及别墅高端设计、普通家装','住宅公寓,写字楼,专卖展示店,其他','2013-10-10 10:00:00',0,'images/product/108.jpg',NULL),(6,' 吴春','北京科技大学','设计师 ','三年~五年','现代,简欧,田园风格,混搭 ','对于设计有着不断探索，追求一种真实与想象空间结合的成果，适用各种实质的物料、光线与影像的新技术做法，色彩、质感、艺术品、时尚的家具搭配，合理的人性空间，完美的设计理念，为业主创造完善的生活空间，演绎自我的居饰品味。','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院\r <br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br>2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院<br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br> 2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','男','首席设计师',NULL,'40~60元 / 平米','复式及别墅高端设计、普通家装','住宅公寓,写字楼,专卖展示店,其他','2013-10-10 10:00:00',0,'images/product/108.jpg',NULL),(7,' 吴春','北京科技大学','设计师 ','三年~五年','现代,简欧,田园风格,混搭 ','对于设计有着不断探索，追求一种真实与想象空间结合的成果，适用各种实质的物料、光线与影像的新技术做法，色彩、质感、艺术品、时尚的家具搭配，合理的人性空间，完美的设计理念，为业主创造完善的生活空间，演绎自我的居饰品味。','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院\r <br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br>2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院<br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br> 2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','男','首席设计师',NULL,'40~60元 / 平米','复式及别墅高端设计、普通家装','住宅公寓,写字楼,专卖展示店,其他','2013-10-10 10:00:00',0,'images/product/108.jpg',NULL),(8,' 吴春','北京科技大学','设计师 ','三年~五年','现代,简欧,田园风格,混搭 ','对于设计有着不断探索，追求一种真实与想象空间结合的成果，适用各种实质的物料、光线与影像的新技术做法，色彩、质感、艺术品、时尚的家具搭配，合理的人性空间，完美的设计理念，为业主创造完善的生活空间，演绎自我的居饰品味。','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院\r <br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br>2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','2003年毕业于南京河海大学<br> 2004年加盟东易日盛装饰股份有限公司主任设计师<br> 2008年进修清华美术学院<br> 2009年南通大学色彩学培训讲师 <br> 2006至2008年美庭家居装饰设计有限公司首席设计师<br> 2009至2010年业之峰装饰工程有限公司首席设计师<br>2011年至今南通从尚装饰工程有限公司设计总监','男','首席设计师',NULL,'40~60元 / 平米','复式及别墅高端设计、普通家装','住宅公寓,写字楼,专卖展示店,其他','2013-10-10 10:00:00',0,'images/product/108.jpg',NULL);
/*!40000 ALTER TABLE `hzsteam` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-02 16:57:31
