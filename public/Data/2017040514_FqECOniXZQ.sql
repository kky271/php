-- CLTPHP SQL Backup
-- Time:2017-04-05 14:51:47
-- http://www.cltphp.com 

--
-- 表的结构 `clt_ad`
-- 
DROP TABLE IF EXISTS `clt_ad`;
CREATE TABLE `clt_ad` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '广告名称',
  `type_id` tinyint(5) NOT NULL COMMENT '所属位置',
  `pic` varchar(200) NOT NULL DEFAULT '' COMMENT '广告图片URL',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT '广告链接',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `sort` int(11) NOT NULL COMMENT '排序',
  `open` tinyint(2) NOT NULL COMMENT '1=审核  0=未审核',
  PRIMARY KEY (`ad_id`),
  KEY `plug_ad_adtypeid` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_ad`表中的数据 `clt_ad`
--
INSERT INTO `clt_ad` VALUES (15,'如何优雅的装饰客厅',1,'/uploads/20170223/6f728d80d0b9f26bfefafe49d5d99c2b.jpg','',1480909037,1,1);
INSERT INTO `clt_ad` VALUES (16,'内页横幅',5,'/uploads/20161212/9000ba8250cccd2be494d4241c56afe2.jpg','',1480909132,50,1);
INSERT INTO `clt_ad` VALUES (17,'如何优雅的装饰客厅01',1,'http://bpic.588ku.com/back_pic/03/71/89/8657b8591f90b53.jpg','',1481788850,2,1);
INSERT INTO `clt_ad` VALUES (18,'如何优雅的装饰客厅02',1,'/uploads/20161215/08d9c6acbdc8035815acd3bb9acb3b49.jpg','',1481788869,3,1);
INSERT INTO `clt_ad` VALUES (19,'如何优雅的装饰客厅03',1,'/uploads/20161215/08d9c6acbdc8035815acd3bb9acb3b49.jpg','',1481789413,50,1);
--
-- 表的结构 `clt_ad_type`
-- 
DROP TABLE IF EXISTS `clt_ad_type`;
CREATE TABLE `clt_ad_type` (
  `type_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '广告位名称',
  `sort` int(11) NOT NULL COMMENT '广告位排序',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_ad_type`表中的数据 `clt_ad_type`
--
INSERT INTO `clt_ad_type` VALUES (1,'顶部轮播',1);
INSERT INTO `clt_ad_type` VALUES (5,'内页横幅',2);
--
-- 表的结构 `clt_admin`
-- 
DROP TABLE IF EXISTS `clt_admin`;
CREATE TABLE `clt_admin` (
  `admin_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(20) NOT NULL COMMENT '管理员用户名',
  `pwd` varchar(70) NOT NULL COMMENT '管理员密码',
  `group_id` mediumint(8) DEFAULT NULL COMMENT '分组ID',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `realname` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `tel` varchar(30) DEFAULT NULL COMMENT '电话号码',
  `hits` int(8) NOT NULL DEFAULT '1' COMMENT '登陆次数',
  `ip` varchar(20) DEFAULT NULL COMMENT 'IP地址',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `mdemail` varchar(50) DEFAULT '0' COMMENT '传递修改密码参数加密',
  `is_open` tinyint(2) DEFAULT '0' COMMENT '审核状态',
  PRIMARY KEY (`admin_id`),
  KEY `admin_username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_admin`表中的数据 `clt_admin`
--
INSERT INTO `clt_admin` VALUES (1,'admin','0192023a7bbd73250516f069df18b500',1,'1109305987@qq.com','','18792402229',74,'127.0.0.1',1482132862,'0',1);