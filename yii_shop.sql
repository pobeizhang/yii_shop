-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: yii_shop
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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

--
-- Table structure for table `shop_admin_user`
--

DROP TABLE IF EXISTS `shop_admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adminuser` varchar(32) DEFAULT '' COMMENT '后台管理员账号',
  `adminpwd` char(32) DEFAULT '' COMMENT '后台管理员密码',
  `adminemail` varchar(50) DEFAULT '' COMMENT '后台管理员邮箱，用作修改密码',
  `logintime` int(10) unsigned DEFAULT '0' COMMENT '后台管理员登录时间',
  `loginip` int(10) unsigned DEFAULT '0' COMMENT '后台管理员登录ip',
  `created_time` int(10) unsigned DEFAULT '0' COMMENT '后台管理员账号创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='后台管理员数据表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_admin_user`
--

LOCK TABLES `shop_admin_user` WRITE;
/*!40000 ALTER TABLE `shop_admin_user` DISABLE KEYS */;
INSERT INTO `shop_admin_user` VALUES (1,'admin','7fef6171469e80d32c0559f88b377245','dulei1618@163.com',1477983498,1929152024,1470050103),(2,'杜磊','202cb962ac59075b964b07152d234b70','1620202112@qq.com',1470218177,2130706433,1470050103),(3,'admin123','202cb962ac59075b964b07152d234b70','876466227@qq.com',0,0,0),(4,'张莹莹','89db097b8717a73fcd6893edd9a7a111','13264038896@163.com',0,0,0),(5,'test','202cb962ac59075b964b07152d234b70','test@test.com',0,0,0),(6,'a','202cb962ac59075b964b07152d234b70','a@a.com',0,0,0),(7,'b','202cb962ac59075b964b07152d234b70','b@b.com',0,0,0),(8,'c','202cb962ac59075b964b07152d234b70','c@c.com',0,0,0),(9,'d','202cb962ac59075b964b07152d234b70','d@d.com',0,0,0),(10,'e','202cb962ac59075b964b07152d234b70','e@e.com',0,0,0),(12,'v','7fef6171469e80d32c0559f88b377245','v@test.com',0,0,0);
/*!40000 ALTER TABLE `shop_admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_home_address`
--

DROP TABLE IF EXISTS `shop_home_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_home_address` (
  `addressid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单地址表主键id',
  `firstname` varchar(32) NOT NULL DEFAULT '' COMMENT '用户姓氏',
  `lastname` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名字',
  `company` varchar(100) NOT NULL DEFAULT '' COMMENT '用户公司地址',
  `address` text NOT NULL COMMENT '用户商品邮寄地址',
  `postcode` char(6) NOT NULL DEFAULT '' COMMENT '商品邮寄邮编编号',
  `telephone` varchar(15) NOT NULL DEFAULT '' COMMENT '用户电话',
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '订单对应的用户主键id',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单地址创建时间',
  `email` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`addressid`),
  KEY `shop_home_address_userid` (`userid`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户点单地址表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_home_address`
--

LOCK TABLES `shop_home_address` WRITE;
/*!40000 ALTER TABLE `shop_home_address` DISABLE KEYS */;
INSERT INTO `shop_home_address` VALUES (1,'杜','磊','','北京朝阳区十八里店南桥','100000','18518150393',2,1473462381,'dulei1618@163.com'),(2,'张','莹莹','','北京十八里店南桥','100000','13264038896',2,1473463085,'13264038896@163.com'),(4,'test','tst','','北京市朝阳区tsetest','100000','18518150393',19,1477572210,'dulei1618@163.com');
/*!40000 ALTER TABLE `shop_home_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_home_cart`
--

DROP TABLE IF EXISTS `shop_home_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_home_cart` (
  `cartid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车id',
  `productid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `productnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '购物车中商品的数量',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品的价格',
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户的id',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '购物车创建时间',
  PRIMARY KEY (`cartid`),
  KEY `shop_home_cart_productid` (`productid`) USING BTREE,
  KEY `shop_home_cart_userid` (`userid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='购物车数据表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_home_cart`
--

LOCK TABLES `shop_home_cart` WRITE;
/*!40000 ALTER TABLE `shop_home_cart` DISABLE KEYS */;
INSERT INTO `shop_home_cart` VALUES (8,3,1,16999.00,19,1477877139),(9,1,1,112.00,19,1477877149);
/*!40000 ALTER TABLE `shop_home_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_home_category`
--

DROP TABLE IF EXISTS `shop_home_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_home_category` (
  `cid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类表的主键id',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '分类的标题',
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='商品的分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_home_category`
--

LOCK TABLES `shop_home_category` WRITE;
/*!40000 ALTER TABLE `shop_home_category` DISABLE KEYS */;
INSERT INTO `shop_home_category` VALUES (1,'衣服',0,1470967511),(2,'电子产品',0,1470967516),(4,'电脑',2,1470993078),(5,'平板电脑',2,1470993130),(7,'上衣',1,1471085042),(8,'裤子',1,1471085067),(9,'短裤',8,1471085329),(10,'长裤',8,1471085484);
/*!40000 ALTER TABLE `shop_home_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_home_order`
--

DROP TABLE IF EXISTS `shop_home_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_home_order` (
  `orderid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `addressid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '邮寄地址id',
  `amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单总价',
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `expressid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '快递id',
  `expressno` varchar(50) NOT NULL DEFAULT '',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单创建时间',
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '订单更新时间',
  PRIMARY KEY (`orderid`),
  KEY `shop_home_order_userid` (`userid`) USING HASH,
  KEY `shop_home_order_expressid` (`expressid`) USING HASH,
  KEY `shop_home_order_addressid` (`addressid`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='用户订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_home_order`
--

LOCK TABLES `shop_home_order` WRITE;
/*!40000 ALTER TABLE `shop_home_order` DISABLE KEYS */;
INSERT INTO `shop_home_order` VALUES (1,2,1,85463.00,100,2,'',1474970996,'2016-09-27 10:10:06'),(2,2,2,102442.00,202,3,'',1475479537,'2016-10-03 07:52:36'),(3,2,1,171130.00,260,2,'883135847193347742',1475479631,'2016-10-24 13:45:36'),(4,2,1,205128.00,100,2,'',1477377853,'2016-10-25 06:46:37'),(10,19,4,132.00,100,2,'',1477572167,'2016-10-27 12:43:34'),(11,19,0,0.00,0,0,'',1477616654,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `shop_home_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_home_order_detail`
--

DROP TABLE IF EXISTS `shop_home_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_home_order_detail` (
  `detailid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单详情表主键id',
  `productid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品价钱',
  `productnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品数量',
  `orderid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '订单主键id',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单详情表创建时间',
  PRIMARY KEY (`detailid`),
  KEY `shop_home_order_detail_productid` (`productid`) USING HASH,
  KEY `shop_home_order_detail_orderid` (`orderid`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='订单详情表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_home_order_detail`
--

LOCK TABLES `shop_home_order_detail` WRITE;
/*!40000 ALTER TABLE `shop_home_order_detail` DISABLE KEYS */;
INSERT INTO `shop_home_order_detail` VALUES (1,3,16999.00,5,1,1474970996),(2,1,112.00,4,1,1474970996),(3,3,16999.00,6,2,1475479537),(4,1,112.00,4,2,1475479537),(5,3,16999.00,10,3,1475479631),(6,1,112.00,10,3,1475479631),(7,3,16999.00,12,4,1477377853),(8,1,112.00,10,4,1477377853),(13,1,112.00,1,10,1477572167),(14,3,16999.00,1,11,1477616654),(15,1,112.00,1,11,1477616654);
/*!40000 ALTER TABLE `shop_home_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_home_product`
--

DROP TABLE IF EXISTS `shop_home_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_home_product` (
  `pid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品表主键',
  `cid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商品对应的分类id',
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '商品标题',
  `descr` text NOT NULL COMMENT '商品额描述',
  `num` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商品库存',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品的价格',
  `cover` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商品图片上传之后图床的地址',
  `pics` text NOT NULL COMMENT '所有的图片(将多张图片整合为json形式存储)',
  `issale` enum('1','0') NOT NULL DEFAULT '1' COMMENT '是否促销，0表示不促销，1表示促销',
  `saleprice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '促销价格',
  `ishot` enum('1','0') NOT NULL DEFAULT '1' COMMENT '是否是热卖，0表示不是热卖，1表示是热卖',
  `ison` enum('1','0') NOT NULL DEFAULT '0' COMMENT '是否下架，0表示不下架，1表示上架',
  `istui` enum('1','0') NOT NULL DEFAULT '1' COMMENT '是否推荐，0表示不推荐，1表示推荐',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品添加时间',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_home_product`
--

LOCK TABLES `shop_home_product` WRITE;
/*!40000 ALTER TABLE `shop_home_product` DISABLE KEYS */;
INSERT INTO `shop_home_product` VALUES (1,7,'毛衣','毛衣描述',969,123.00,'http://obzlvnjse.bkt.clouddn.com/57b52d7749dd0','{\"57b52d7771c21\":\"http:\\/\\/obzlvnjse.bkt.clouddn.com\\/57b52d7771c21\",\"57b52d778e2f9\":\"http:\\/\\/obzlvnjse.bkt.clouddn.com\\/57b52d778e2f9\",\"57b52d77af1d3\":\"http:\\/\\/obzlvnjse.bkt.clouddn.com\\/57b52d77af1d3\"}','1',112.00,'1','1','1',0),(3,4,'AppleMacBook Pro','<h1>Apple MacBook Pro 15.4英寸笔记本电脑 银色(Core i7 处理器/16GB内存/512GB SSD闪存/Retina屏 MJLT2CH)</h1>',963,16999.00,'http://obzlvnjse.bkt.clouddn.com/57c8ec348f477','{\"57c8ec34ac2b8\":\"http:\\/\\/obzlvnjse.bkt.clouddn.com\\/57c8ec34ac2b8\",\"57c8ec34cb45b\":\"http:\\/\\/obzlvnjse.bkt.clouddn.com\\/57c8ec34cb45b\"}','0',16999.00,'1','1','1',0);
/*!40000 ALTER TABLE `shop_home_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_home_profile`
--

DROP TABLE IF EXISTS `shop_home_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_home_profile` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `truename` varchar(32) DEFAULT '' COMMENT '会员真是姓名',
  `nickname` varchar(32) DEFAULT '' COMMENT '会员昵称',
  `age` tinyint(3) unsigned DEFAULT '0' COMMENT '会员年龄',
  `sex` enum('2','1','0') DEFAULT '0' COMMENT '0表示保密，1表示’男‘，2表示’女‘',
  `birthday` date DEFAULT '2016-01-01' COMMENT '会员生日',
  `company` varchar(100) DEFAULT '' COMMENT '会员所在公司名称',
  `created_time` int(10) unsigned DEFAULT '0' COMMENT '会员补充信息填写时间',
  `uid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '对应的会员表中的主键id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户详情表，关联前台会员表，用作会员信息的补充';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_home_profile`
--

LOCK TABLES `shop_home_profile` WRITE;
/*!40000 ALTER TABLE `shop_home_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_home_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_home_user`
--

DROP TABLE IF EXISTS `shop_home_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_home_user` (
  `uid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `homename` varchar(32) DEFAULT '' COMMENT '用户名',
  `homepwd` char(32) DEFAULT '' COMMENT '用户密码',
  `homeemail` varchar(100) DEFAULT '' COMMENT '用户邮箱',
  `created_time` int(10) unsigned DEFAULT '0' COMMENT '用户注册时间',
  `openid` char(32) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='前台会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_home_user`
--

LOCK TABLES `shop_home_user` WRITE;
/*!40000 ALTER TABLE `shop_home_user` DISABLE KEYS */;
INSERT INTO `shop_home_user` VALUES (1,'dulei','2b5960e1e619230bfc08a1015e2a85a3','dulei1618@163.com',1470476608,'0'),(2,'zhangyingying','89db097b8717a73fcd6893edd9a7a111','13264038896@163.com',1470476636,'0'),(5,'wangwu','7fef6171469e80d32c0559f88b377245','wangwu@test.com',1470535698,'0'),(7,'zhaoliu','7fef6171469e80d32c0559f88b377245','zhaoliu@test.com',1470536130,'0'),(15,'test','7fef6171469e80d32c0559f88b377245','test@test.com',1470555172,'0'),(17,'yii_shop57a6f16a83b10','10f3935b49a6e27b34f4d0e0aeca2be1','1620202112@qq.com',1470558572,'0'),(18,'test123','7fef6171469e80d32c0559f88b377245','test123@test.com',1470737273,'0'),(19,'tt','7fef6171469e80d32c0559f88b377245','',1477493420,'A23B8989316D7D542B30A8D9B86E1CA1');
/*!40000 ALTER TABLE `shop_home_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-01 15:03:24
