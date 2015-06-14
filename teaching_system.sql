-- MySQL dump 10.13  Distrib 5.6.16, for osx10.7 (x86_64)
--
-- Host: localhost    Database: teaching_system
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin   ','2015-06-02 13:20:11','admin'),(2,'test   ','2015-06-02 05:20:11','test');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '资源目录id',
  `name` varchar(20) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `credit` int(11) NOT NULL DEFAULT '0',
  `type` varchar(20) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (1,0,'math','2015-06-03 14:08:00',444,'数学课',NULL),(2,0,'php','2015-06-03 14:08:05',2,'cs课',NULL),(3,0,'english','2015-06-03 14:08:08',100,'英语课',NULL),(4,0,'微积分1','2015-06-06 07:15:08',4,NULL,NULL),(5,0,'微积分2','2015-06-06 07:15:08',2,NULL,NULL),(6,0,'微积分3','2015-06-06 07:15:39',3,NULL,NULL),(7,0,'大学英语1','2015-06-06 07:15:39',3,NULL,NULL),(8,0,'工程图学','2015-06-06 07:16:50',2,NULL,NULL),(9,0,'物理实验','2015-06-06 07:16:50',2,NULL,NULL),(10,0,'常微分','2015-06-06 07:17:09',1,NULL,NULL),(11,0,'偏微分','2015-06-06 07:17:09',2,NULL,NULL),(12,0,'程序设计基础','2015-06-06 07:18:00',4,NULL,NULL),(13,0,'面向对象程序设计','2015-06-06 07:18:00',2,NULL,NULL),(14,0,'计算机网络基础','2015-06-06 07:18:22',2,NULL,NULL),(15,0,'人工智能','2015-06-06 07:18:22',2,NULL,NULL),(16,0,'数值分析','2015-06-06 07:19:07',3,NULL,NULL),(17,0,'嵌入式系统','2015-06-06 07:19:07',2,NULL,NULL);
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_class`
--

DROP TABLE IF EXISTS `course_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `fid` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `class_info` varchar(300) DEFAULT NULL COMMENT ' 时间，地点',
  `capacity` int(11) NOT NULL COMMENT '班级可容人数',
  `certainty` int(11) NOT NULL,
  `uncertainty` int(11) NOT NULL,
  `lab` int(11) NOT NULL COMMENT '是否需要实验室',
  `campus` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `course_class_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `course_class_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_class`
--

LOCK TABLES `course_class` WRITE;
/*!40000 ALTER TABLE `course_class` DISABLE KEYS */;
INSERT INTO `course_class` VALUES (4,1,1,0,'2015-06-02 13:11:40','{\"class_info\":\n    [\n        {\n            \"day\":\"monday\",\n            \"time\" :[1,2,3,4],\n            \"classroom\":\"207\"\n        },\n        {\n            \"day\":\"monday\",\n            \"time\" :[11,12,13],\n            \"classroom\":\"207\"\n        }\n    ]\n}',5,5,0,0,''),(5,2,2,0,'2015-06-02 13:11:40','{\"class_info\":\n    [\n        {\n            \"day\":\"friday\",\n            \"time\" :[1,2,3,4],\n            \"classroom\":\"207\"\n        },\n        {\n            \"day\":\"friday\",\n            \"time\" :[11,12,13],\n            \"classroom\":\"207\"\n        }\n    ]\n}',7,6,0,0,''),(6,3,3,0,'2015-06-02 13:11:40','{\"class_info\":\n    [\n        {\n            \"day\":\"monday\",\n            \"time\" :[1,2],\n            \"classroom\":\"207\"\n        },\n        {\n            \"day\":\"monday\",\n            \"time\" :[13],\n            \"classroom\":\"207\"\n        }\n    ]\n}',3,4,0,0,''),(8,2,1,0,'2015-06-03 13:01:50','{\"class_info\":\n    [\n        {\n            \"day\":\"monday\",\n            \"time\" :[1,2,3,4],\n            \"classroom\":\"207\"\n        },\n        {\n            \"day\":\"tuesday\",\n            \"time\" :[11,12,13],\n            \"classroom\":\"207\"\n        }\n    ]\n}',1,3,0,0,'');
/*!40000 ALTER TABLE `course_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homework`
--

DROP TABLE IF EXISTS `homework`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homework` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '文件夹id',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homework`
--

LOCK TABLES `homework` WRITE;
/*!40000 ALTER TABLE `homework` DISABLE KEYS */;
INSERT INTO `homework` VALUES (1,0,'3.txt',2,'2015-06-09 17:58:44','',0),(2,36,'3.txt',2,'2015-06-09 18:04:35','',0);
/*!40000 ALTER TABLE `homework` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resdir`
--

DROP TABLE IF EXISTS `resdir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resdir` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `cid` int(10) NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `homework` tinyint(1) NOT NULL DEFAULT '0',
  `ddl` int(11) NOT NULL,
  `uploader` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resdir`
--

LOCK TABLES `resdir` WRITE;
/*!40000 ALTER TABLE `resdir` DISABLE KEYS */;
INSERT INTO `resdir` VALUES (23,0,0,'','英语','./Upload/英语',0,0,'','2015-06-08 15:32:59'),(24,23,1,'','老师','./Upload/23/24',0,0,'','2015-06-08 15:32:59'),(36,24,1,'','作业1','./Upload/23/24/作业1',1,234,'','2015-06-09 09:48:35');
/*!40000 ALTER TABLE `resdir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource`
--

DROP TABLE IF EXISTS `resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fid` int(20) NOT NULL,
  `context` mediumtext COLLATE utf8_unicode_ci,
  `hits` int(6) DEFAULT NULL,
  `addtime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='资源';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource`
--

LOCK TABLES `resource` WRITE;
/*!40000 ALTER TABLE `resource` DISABLE KEYS */;
INSERT INTO `resource` VALUES (2,'sad',1,'todo',0,'2015-05-29 21:57:51'),(3,'ssad',1,'todo',0,'2015-05-29 21:58:44'),(4,'556874c881fbd.txt',1,'todo',0,'2015-05-29 22:16:40'),(5,'55689403646fb.docx',1,NULL,0,'2015-05-30 00:29:55'),(6,'55689578196a5.docx',1,NULL,0,'2015-05-30 00:36:08'),(7,'556897546c8fd.txt',1,'#include <iostream>\r\n\r\nusing namespace std;\r\n\r\nint main()\r\n{\r\n    int i,j,k,l,m,n,o,p;\r\n    int step[5000000];\r\n    char line[5];\r\n    int ee[18];\r\n    int a[5000000];\r\n    ee[0]=1;\r\n    for (i=1;i<=17;i++) ee[i]=ee[i-1]*2;\r\n    for (i=1;i<=4;i++)\r\n    {\r\n        for (j=1;j<=4;j++)\r\n        {\r\n            cin>>line[j];\r\n            if (line[j]==\'w\') k=k+ee[(i-1)*4+j];\r\n        }\r\n    }\r\n    int now,next,up,down,left,right;\r\n    a[0]=k;step[1]=1;now=0;next=1;\r\n    do\r\n    {\r\n        for (i=1;i<=16;i++)\r\n            if (a[now]&ee[i]==0)\r\n            {\r\n                k=a[now];\r\n                k=k+ee[i];\r\n                if (i+4<=16) k=k^ee[i+4];\r\n                if (i-4>0) k=k^ee[i-4];\r\n                if (i%4!=0) k=k^ee[i+1];\r\n                if (i%4!=1) k=k^ee[i-1];\r\n                a[next]=k;\r\n                step[next]=step[now]+1;\r\n                if ((k==0)||(k==ee[17])) {cout<<step[next];return 0;}\r\n                next=next+1;\r\n            }\r\n        now=now+1;\r\n    } while (next>4500000);\r\n    cout<<\"Impossible\";\r\n    return 0;\r\n}\r\n',0,'2015-05-30 00:44:04'),(8,'556ba996467d1.txt',1,'5',0,'2015-06-01 08:38:46'),(9,'5573007e3605a.txt',1,'5',0,'2015-06-06 22:15:28'),(10,'557300b2a52f2.txt',1,'5',0,'2015-06-06 22:16:18'),(11,'55730242a9ffd.txt',1,'5',0,'2015-06-06 22:22:58'),(12,'557428574a352.txt',1,'5',0,'2015-06-07 19:17:47'),(13,'5574e8104adf4.txt',1,'5',0,'2015-06-08 08:55:44'),(14,'5_29.txt',1,'5',0,'2015-06-08 09:14:06'),(15,'辛浩.txt',1,'0',0,'2015-06-08 09:23:36'),(16,'辛浩.txt',1,'',0,'2015-06-08 09:26:01'),(17,'心意.txt',1,'5月党支部会议\r\n请假：夏立伟，王禹杰\r\n\r\n总之会内容：\r\n	1.万博同学，手续审核。\r\n	2.五好党支部。\r\n	3.学院活动，6.7号素拓活动\r\n	4.下周五，书记副书记报告会。\r\n万博发展：\r\n六月活动：马演出\r\n分享：\r\n价值多元化：\r\n	1.有市场，新闻媒体的堕落\r\n	2.国家要有包容性，但是自己的三观要有底线，不多指责别人，不如内省自己\r\n	3.适合自己，不影响他人\r\n	4.等价交换，人不能自己独自的存活\r\n\r\n贪污腐败治理\r\n	1.贪官，精神污染。\r\n	2.人性善恶，西方定义恶，东方善。\r\n	3.监狱现身说法：国企董事长，交通局局长。\r\n\r\n成为受欢迎的人：\r\n	1.无私奉献\r\n	2.榜样的力量\r\n	3.等价交换，不要忘了自己的成长（自私（对更强学习）是为了更好的无私（对弱者））\r\n\r\n最烦：不为国家家庭做贡献，只会发牢骚的。。。（负能量）',0,'2015-06-08 09:39:19'),(18,'2.txt',0,'1231inasdasd',0,'2015-06-09 00:13:20'),(19,'2.txt',0,'1231inasdasd',0,'2015-06-09 00:31:45'),(20,'2.txt',24,'1231inasdasd',0,'2015-06-09 00:33:29'),(21,'全文.txt',0,'5月党支部会议\r\n请假：夏立伟，王禹杰\r\n\r\n总之会内容：\r\n	1.万博同学，手续审核。\r\n	2.五好党支部。\r\n	3.学院活动，6.7号素拓活动\r\n	4.下周五，书记副书记报告会。\r\n万博发展：\r\n六月活动：马演出\r\n分享：\r\n价值多元化：\r\n	1.有市场，新闻媒体的堕落\r\n	2.国家要有包容性，但是自己的三观要有底线，不多指责别人，不如内省自己\r\n	3.适合自己，不影响他人\r\n	4.等价交换，人不能自己独自的存活\r\n\r\n贪污腐败治理\r\n	1.贪官，精神污染。\r\n	2.人性善恶，西方定义恶，东方善。\r\n	3.监狱现身说法：国企董事长，交通局局长。\r\n\r\n成为受欢迎的人：\r\n	1.无私奉献\r\n	2.榜样的力量\r\n	3.等价交换，不要忘了自己的成长（自私（对更强学习）是为了更好的无私（对弱者））\r\n\r\n最烦：不为国家家庭做贡献，只会发牢骚的。。。（负能量）',0,'2015-06-09 20:39:12'),(22,'全文.txt',0,'5月党支部会议\r\n请假：夏立伟，王禹杰\r\n\r\n总之会内容：\r\n	1.万博同学，手续审核。\r\n	2.五好党支部。\r\n	3.学院活动，6.7号素拓活动\r\n	4.下周五，书记副书记报告会。\r\n万博发展：\r\n六月活动：马演出\r\n分享：\r\n价值多元化：\r\n	1.有市场，新闻媒体的堕落\r\n	2.国家要有包容性，但是自己的三观要有底线，不多指责别人，不如内省自己\r\n	3.适合自己，不影响他人\r\n	4.等价交换，人不能自己独自的存活\r\n\r\n贪污腐败治理\r\n	1.贪官，精神污染。\r\n	2.人性善恶，西方定义恶，东方善。\r\n	3.监狱现身说法：国企董事长，交通局局长。\r\n\r\n成为受欢迎的人：\r\n	1.无私奉献\r\n	2.榜样的力量\r\n	3.等价交换，不要忘了自己的成长（自私（对更强学习）是为了更好的无私（对弱者））\r\n\r\n最烦：不为国家家庭做贡献，只会发牢骚的。。。（负能量）',0,'2015-06-09 20:43:29');
/*!40000 ALTER TABLE `resource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `admission_year` int(11) NOT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `major` varchar(30) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'张三','2015-06-02 13:06:50',2012,'12345678901','计算机科学','202cb962ac59075b964b07152d234b70'),(2,'李四','2015-06-02 13:06:50',2012,'12345678901','软件工程','202cb962ac59075b964b07152d234b70'),(3,'王五','2015-06-02 13:06:50',2011,'12345678901','计算机科学','202cb962ac59075b964b07152d234b70'),(4,'赵六','2015-06-02 13:06:50',2012,'12345678901','软件工程','202cb962ac59075b964b07152d234b70'),(5,'香港记者','2015-06-02 13:06:50',2013,'12345678901','新闻学','202cb962ac59075b964b07152d234b70'),(6,'西方记者','2015-06-02 13:06:50',2014,'12345678901','新闻学','202cb962ac59075b964b07152d234b70'),(7,'台湾记者','2015-06-02 13:06:50',2015,'12345678901','中文','202cb962ac59075b964b07152d234b70'),(16,'华莱士','2015-06-10 15:17:50',2012,'911','哲♂学','202cb962ac59075b964b07152d234b70');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_course`
--

DROP TABLE IF EXISTS `student_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_class_id` int(11) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  `grade` int(11) NOT NULL COMMENT '成绩',
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `course_class_id` (`course_class_id`),
  CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  CONSTRAINT `student_course_ibfk_2` FOREIGN KEY (`course_class_id`) REFERENCES `course_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_course`
--

LOCK TABLES `student_course` WRITE;
/*!40000 ALTER TABLE `student_course` DISABLE KEYS */;
INSERT INTO `student_course` VALUES (1,1,4,1,0,0),(5,2,4,1,0,0),(7,2,6,1,0,0),(9,3,4,1,0,0),(10,3,5,1,0,0),(11,3,6,1,0,0),(13,4,4,1,0,0),(14,4,5,1,0,0),(15,4,6,1,0,0),(16,4,8,1,0,0),(17,6,8,1,0,0),(18,5,8,1,0,0),(19,6,5,1,0,0),(20,5,5,1,0,0),(21,7,4,1,0,0),(22,7,5,1,0,0),(23,7,6,1,0,0),(25,2,5,1,0,0);
/*!40000 ALTER TABLE `student_course` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Course_Insert` AFTER INSERT ON `student_course`
 FOR EACH ROW BEGIN
    UPDATE `course_class` SET certainty=(
        SELECT count(*) 
        FROM student_course 
        WHERE student_course.course_class_id=NEW.course_class_id AND confirmed=1 AND finished=0
    ), uncertainty=(
        SELECT count(*) 
        FROM student_course 
        WHERE student_course.course_class_id=NEW.course_class_id AND confirmed=0 AND finished=0
    ) WHERE id=NEW.course_class_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Course_Update` AFTER UPDATE ON `student_course`
 FOR EACH ROW BEGIN
    UPDATE `course_class` SET certainty=(
        SELECT count(*) 
        FROM student_course 
        WHERE student_course.course_class_id=NEW.course_class_id AND confirmed=1 AND finished=0
    ), uncertainty=(
        SELECT count(*) 
        FROM student_course 
        WHERE student_course.course_class_id=NEW.course_class_id AND confirmed=0 AND finished=0
    ) WHERE id=NEW.course_class_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Course_Delete` AFTER DELETE ON `student_course`
 FOR EACH ROW BEGIN
    UPDATE `course_class` SET certainty=(
        SELECT count(*) 
        FROM student_course 
        WHERE student_course.course_class_id=OLD.course_class_id AND confirmed=1 AND finished=0
    ), uncertainty=(
        SELECT count(*) 
        FROM student_course 
        WHERE student_course.course_class_id=OLD.course_class_id AND confirmed=0 AND finished=0
    ) WHERE id=OLD.course_class_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `student_course_add`
--

DROP TABLE IF EXISTS `student_course_add`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_course_add` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_class_id` int(11) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `student_course_add_ibfk_1` (`student_id`),
  KEY `student_course_add_ibfk_2` (`course_class_id`),
  CONSTRAINT `student_course_add_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  CONSTRAINT `student_course_add_ibfk_2` FOREIGN KEY (`course_class_id`) REFERENCES `course_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_course_add`
--

LOCK TABLES `student_course_add` WRITE;
/*!40000 ALTER TABLE `student_course_add` DISABLE KEYS */;
INSERT INTO `student_course_add` VALUES (1,5,4,0),(2,5,6,1),(3,6,8,1),(4,5,8,1),(5,6,5,1),(6,5,5,1),(8,7,4,1),(9,7,5,1),(13,7,6,1),(14,2,5,1);
/*!40000 ALTER TABLE `student_course_add` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(128) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (1,'东方记者','2015-06-02 12:03:41','202cb962ac59075b964b07152d234b70','长者','12345678901','zhangzhe@zju.edu.cn','你们呀，还要学习一个'),(2,'西方记者','2015-06-02 12:03:56','202cb962ac59075b964b07152d234b70','哲学家','12345678901','hualaishi@zju.edu.cn','比你们不知高到哪里去了'),(3,'南方记者','2015-06-02 12:04:07','202cb962ac59075b964b07152d234b70','新闻学家','12345678901','north@zju.edu.cn','不要总想弄个大新闻'),(4,'北方记者','2015-06-10 15:33:28','202cb962ac59075b964b07152d234b70',NULL,'12345678900','south@zju.edu.cn','I\'m angry');
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timeset`
--

DROP TABLE IF EXISTS `timeset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timeset` (
  `year_id` int(11) NOT NULL,
  `xk1_s` date DEFAULT NULL,
  `xk1_e` date DEFAULT NULL,
  `xk2_s` date DEFAULT NULL,
  `xk2_e` date DEFAULT NULL,
  `xk3_s` date DEFAULT NULL,
  `xk3_e` date DEFAULT NULL,
  `bx1_s` date DEFAULT NULL,
  `bx1_e` date DEFAULT NULL,
  `bx2_s` date DEFAULT NULL,
  `bx2_e` date DEFAULT NULL,
  `bx3_s` date DEFAULT NULL,
  `bx3_e` date DEFAULT NULL,
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeset`
--

LOCK TABLES `timeset` WRITE;
/*!40000 ALTER TABLE `timeset` DISABLE KEYS */;
INSERT INTO `timeset` VALUES (1,'2015-06-20','2015-06-27','2015-09-01','2015-09-08','2015-09-20','2015-09-23','2015-07-01','2015-07-03','2015-09-11','2015-09-13','2015-09-25','2015-09-27');
/*!40000 ALTER TABLE `timeset` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-11 16:28:18
