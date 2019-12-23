# Host: localhost  (Version: 5.5.53)
# Date: 2019-12-06 09:27:58
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "ycm_quickentry"
#

DROP TABLE IF EXISTS `ycm_quickentry`;
CREATE TABLE `ycm_quickentry` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT '' COMMENT '名称',
  `laytext` varchar(50) DEFAULT '' COMMENT '完整标题',
  `type` smallint(5) DEFAULT '0' COMMENT '归类，1=快捷入口，2=内容统计',
  `controller` varchar(20) DEFAULT '' COMMENT '控制器名',
  `action` varchar(20) DEFAULT '' COMMENT '操作名',
  `vars` varchar(100) DEFAULT '' COMMENT 'URL参数字符串',
  `groups` smallint(5) DEFAULT '0' COMMENT '分组，1=模型',
  `checked` tinyint(4) DEFAULT '0' COMMENT '选中，0=否，1=是',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态，1=有效，0=无效',
  `sort_order` int(10) DEFAULT '0' COMMENT '排序',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='快捷入口表';

#
# Data for table "ycm_quickentry"
#

/*!40000 ALTER TABLE `ycm_quickentry` DISABLE KEYS */;
INSERT INTO `ycm_quickentry` VALUES (1,'产品','产品列表',1,'Product','index','channel=2',1,0,1,3,1569232484,1575273999),(2,'下载','下载列表',1,'Download','index','channel=4',1,0,1,4,1569232484,1575273999),(3,'文章','文章列表',1,'Article','index','channel=1',1,0,1,6,1569232484,1575273999),(4,'图集','图集列表',1,'Images','index','channel=3',1,0,1,7,1569232484,1575273999),(5,'内容管理','内容列表',1,'Archives','index','',0,1,1,13,1569232484,1574820795),(7,'回收站','回收站',1,'RecycleBin','archives_index','',0,1,1,4,1569232484,1574820795),(8,'栏目管理','栏目管理',1,'Arctype','index','',0,0,1,5,1569232484,1574820795),(9,'留言','留言列表',1,'Guestbook','index','channel=8',1,0,1,6,1569232484,1575273999),(10,'网站信息','网站信息',1,'System','web','',0,1,1,7,1569232484,1574820795),(11,'水印配置','水印配置',1,'System','water','',0,0,1,8,1569232484,1574820795),(12,'缩略图配置','缩略图配置',1,'System','thumb','',0,0,1,9,1569232484,1574820795),(13,'数据备份','数据备份',1,'Tools','index','',0,0,1,11,1569232484,1574820795),(14,'URL配置','URL配置',1,'Seo','index','inc_type=seo',0,0,1,1,1569232484,1574820795),(15,'模板管理','模板管理',1,'Filemanager','index','',0,0,1,6,1569232484,1574820795),(16,'SiteMap','SiteMap',1,'Seo','index','inc_type=sitemap',0,0,1,12,1569232484,1574820795),(17,'频道模型','频道模型',1,'Channeltype','index','',0,0,1,2,1569232484,1574820795),(18,'广告管理','广告管理',1,'AdPosition','index','',0,1,1,3,1569232484,1574820795),(19,'友情链接','友情链接',1,'Links','index','',0,0,1,10,1569232484,1574820795),(20,'Tags管理','Tags管理',1,'Tags','index','',0,0,1,14,1569232484,1574820795),(21,'管理员管理','管理员管理',1,'Admin','index','',0,1,1,15,1569232484,1574820795),(22,'邮件配置','邮件配置',1,'System','smtp','',0,0,1,16,1569232484,1574820795),(23,'文章','文章列表',2,'Article','index','channel=1',1,1,1,1,1569310798,1575273999),(24,'产品','产品列表',2,'Product','index','channel=2',1,1,1,2,1569310798,1575273999),(25,'下载','下载列表',2,'Download','index','channel=4',1,0,1,4,1569310798,1575273999),(26,'图集','图集列表',2,'Images','index','channel=3',1,1,1,3,1569310798,1575273999),(27,'留言','留言列表',2,'Guestbook','index','channel=8',1,1,1,5,1569310798,1575273999),(28,'广告','广告管理',2,'AdPosition','index','',0,0,1,6,1569232484,1574820836),(29,'友情链接','友情链接',2,'Links','index','',0,1,1,7,1569232484,1574820836),(30,'Tags标签','Tags管理',2,'Tags','index','',0,0,1,8,1569232484,1574820836),(31,'会员','会员管理',2,'Member','users_index','',0,1,0,7,1569232484,1575273999),(32,'插件应用','插件应用',1,'Weapp','index','',0,0,0,17,1569232484,1575273999),(33,'会员中心','会员中心',1,'Member','users_index','',0,0,0,18,1569232484,1575273999),(34,'商城中心','商城中心',1,'Shop','index','',0,0,0,19,1569232484,1575273999),(35,'订单','订单管理',2,'Shop','index','',0,1,0,6,1569232484,1575273999),(36,'人才招聘','人才招聘列表',1,'Custom','index','channel=9',1,0,1,100,1574233851,1575273999),(37,'人才招聘','人才招聘列表',2,'Custom','index','channel=9',1,0,1,9,1574233853,1575273999);
/*!40000 ALTER TABLE `ycm_quickentry` ENABLE KEYS */;
