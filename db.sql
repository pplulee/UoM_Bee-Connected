-- MySQL dump 10.16  Distrib 10.1.47-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: groupr3
-- ------------------------------------------------------
-- Server version	10.1.47-MariaDB

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa-solid fa-bars',
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (2,'Fashion','fa-solid fa-shirt',1),(3,'Food','fa-solid fa-burger',1),(4,'Shopping','fa-solid fa-basket-shopping',1),(5,'Study','fa-solid fa-graduation-cap',1),(14,'Travel','fa-solid fa-compass',1),(15,'Sport','fa-solid fa-futbol',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `pid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'post ID',
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `category` text COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `author` bigint(11) NOT NULL COMMENT 'linked to userid',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'visible or not',
  `view` bigint(20) unsigned NOT NULL DEFAULT '0',
  `attach_pic` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `author` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (55,'this is a really big post to test big posts!!!!!!!','Fashion','Yourself required no at thoughts delicate landlord it be. Branched dashwood do is whatever it. Farther be chapter at visited married in it pressed. By distrusts procuring be oh frankness existence believing instantly if. Doubtful on an juvenile as of servants insisted. Judge why maids led sir whose guest drift her point. Him comparison especially friendship was who sufficient attachment favourable how. Luckily but minutes ask picture man perhaps are inhabit. How her good all sang more why.',1,0,8,'','0000-00-00 00:00:00'),(57,'Storytelling Fashion Photography','Fashion','I was reading through the Diversity in Fashion Photography thread and I saw a couple of interesting points. The photoshoot storytelling made me wonder is that do you think storytelling is vital for a photographer’s legacy and do you believe there are photographers (old&new) who are still masters at this?\r\n\r\n',10,0,2,'caa23029a867fae0bf7a6d65f2b.jpg','0000-00-00 00:00:00'),(58,'Does anyone take honey for health benefits?','Food','Ironically in the last two days I heard about the benefits of honey. I know many use honey as a preferred sweetener over say more processed sugars, or simply like to use it to sweeten drinks, cook with it etc.\r\n\r\nI was watching a youtube video from a channel that I sometimes watch (for recipe ideas etc), and in the vid, many of the recipes used Manuka honey. Ah, but then noticed it was a sponsored video by a company that sells that honey (the honey was $45 for 17 ounces).\r\n\r\nAnd the other was on a story on my local news, they were celebrating someone turning 100, and he said that was one of his tips (he took some honey everyday). So long winded .... but just curious if anyone takes honey for reasons other than taste and/or prefer it over say other sugars. And why.\r\n\r\nJust curious (I will look it up too since new to me).\r\nThanks.',10,0,7,'','0000-00-00 00:00:00'),(59,'Any budget friendly shops in manchester?','Shopping','I just arrived to manchester for uni, and I am planning on going on a shopping spree, but the budget is very limited. Does anyone know a good and cheap places to stock from in manchester?',10,0,0,'','0000-00-00 00:00:00'),(60,'How is classes going with you?','Study','I just wanna know how the classes are going with everyone.',10,0,7,'','0000-00-00 00:00:00'),(61,'PSA: Samsung Galaxy Buds Live on 50% discount','Shopping','This is a public service announcment. The Samsung Galaxy Buds Live are going on a 50% discount on amazon. This is your chance to get good buds for a low price!',10,0,61,'','0000-00-00 00:00:00'),(64,'I am new here','Sport','Hello everyone, first time using this forum. Wanted to ask if anyone will be up for the coming UCL final? I have two spare tickets!! Fastest comment gets them!',11,0,45,'','2022-03-27 21:00:32'),(72,'Testing the image','Travel','Testing the image to make sure it shows up normally in read more mode',11,0,38,'80c2c9ce3f1fe7bff3ab41756ab.jpg','2022-03-28 20:30:42'),(79,'i am reporting this post!','Fashion','This post is really horrible and i want to report it!!!!!',10,1,0,'','2022-03-30 01:30:44'),(82,'testing transparent picture','Fashion','This is a test for transparent pictures.',10,0,4,'846401952270b193645fa901218.png','2022-03-30 14:25:21'),(83,'Lounge chair by Troy Smith!','Fashion','this weird-looking chair I found.',10,0,4,'24f3b63cab32702e687f4ac6994.jpg','2022-03-30 20:30:50'),(84,'If you have the chance to go to Malta, take it!','Travel','It&#039;s indeed a beautiful island, with a very interesting history.',10,0,1,'a473f4af7213b5fb868f7506f3c.png','2022-03-30 20:34:31'),(85,'Dave Office Chair - £50 @ Homebase','Shopping','found this huge discount through this link!\r\nhttps://www.homebase.co.uk/dave-office-chair-white-faux-leather/12887224.html',10,0,13,'3571eb38f40c61ea70a40d36a65.jpg','2022-03-30 20:39:51'),(86,'medium steak is the best! Convince me otherwise.','Food','I don&#039;t get people having well-done steak as it tastes like charcoal while medium-rare tastes too bloody. Medium steak is objectively the best and I dare you to convince me otherwise.',10,0,2,'','2022-03-30 20:44:32'),(87,'forgetting your homework during remote learning...','Study','oops! I forgot my homework at home...',10,0,5,'226f6c6c24655a242e3c9d7626d.jpg','2022-03-30 20:47:31'),(89,'Manchester Central Library','Travel','I highly recommend visiting this place. It is the largest public library in Manchester and is open to the public free of charge during the day. Especially, the reading Room on the first floor has a huge echo wall and I think its really cool!',6,0,14,'','2022-03-31 18:11:36'),(92,'hi','Fashion','hello everyone',1,0,2,'','2022-04-01 04:46:12');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reply` (
  `rid` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `reply_to` bigint(20) NOT NULL DEFAULT '0' COMMENT '0 if reply to post',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `visible` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date` datetime NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reply`
--

LOCK TABLES `reply` WRITE;
/*!40000 ALTER TABLE `reply` DISABLE KEYS */;
INSERT INTO `reply` VALUES (1,61,1,0,'qwdkqj wndqwdnk qwdklqwdkqjwndq wdnkqwdklqwdkq jwndqwdnk qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl qwdkqj wndq wdn kqwd qwdkqjw ndqw dnkqwdkl qwdkqj wndqwdnk qwdklqwdkqjwndq wdnkqwdklqwdkq jwndqwdnk qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl qwdkqj wndq wdn kqwddklqwdkqjwndq wdnkqwdklqwdkq jwndqwdnk qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl qwdkqj wndq wdn kqwd qwdkqjw ndqw dnkqwdkl',1,'0000-00-00 00:00:00'),(2,61,1,0,'test',1,'2022-03-27 20:00:59'),(3,61,1,0,'Just got it, loving it. Thanks for sharing!',1,'2022-03-27 18:36:01'),(4,61,1,0,'test',1,'2022-03-27 18:44:53'),(5,61,1,0,'dnk qwdklqwdkqjwndq wdnkqwdklqwdkq jwndqwdnk qwdkl',1,'2022-03-27 18:45:08'),(6,61,1,0,'qwdkqj wndqwdnk qwdklqwdkqjwndq wdnkqwdklqwdkq jwndqwdnk qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dn',1,'2022-03-27 18:47:38'),(7,61,1,0,'test2',1,'2022-03-27 18:47:53'),(8,60,1,0,'test2',1,'2022-03-27 20:54:53'),(9,60,1,0,'helooo',1,'2022-03-27 20:55:19'),(10,64,11,0,'I want them!',1,'2022-03-27 21:01:11'),(14,69,1,0,'11',0,'2022-03-28 06:26:54'),(17,72,1,0,'This image looks great!',1,'2022-03-29 10:09:11'),(19,72,10,0,'what an amazing image!',1,'2022-03-30 00:50:23'),(22,74,10,0,'Warning: move_uploaded_file(C:/xampp/htdocs/data/image_post/b16090310ed456d0e3d4a6928d9.jpg): Failed to open stream: No such file or directory in C:\\xampp\\htdocs\\comp10120_group_project\\include\\function.php on line 255',1,'2022-03-30 01:03:22'),(23,74,10,0,'Warning: move_uploaded_file(): Unable to move &quot;C:\\xampp\\tmp\\phpD07E.tmp&quot; to &quot;C:/xampp/htdocs/data/image_post/b16090310ed456d0e3d4a6928d9.jpg&quot; in C:\\xampp\\htdocs\\comp10120_group_project\\include\\function.php on line 255',1,'2022-03-30 01:04:57'),(25,74,10,0,'this is the error i get when i try to upload an image to this post and i think it affects both my ability to upload an image to a post and as a profile picture. I use C:\\xampp\\htdocs\\comp10120_group_project instead of C:\\xampp\\htdocs for the project. Is this a problem we actually need to solve?',1,'2022-03-30 01:21:51'),(26,85,1,0,'Nice!',1,'2022-03-30 23:05:03'),(27,55,1,0,'1111',1,'2022-03-31 18:13:52'),(28,55,1,0,'2222',1,'2022-03-31 18:14:15'),(29,64,7,0,'me!!!',1,'2022-03-31 18:16:24'),(30,91,2,0,'Yup everything works perfectly!',1,'2022-03-31 15:40:15');
/*!40000 ALTER TABLE `reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'report ID',
  `type` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL COMMENT 'user who report',
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `solved` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`reportid`),
  KEY `userid` (`userid`),
  KEY `pid` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `report` VALUES (1,'post',50,1,'too long',1,'0000-00-00 00:00:00'),(4,'post',50,2,'test',1,'0000-00-00 00:00:00'),(5,'post',52,1,'000',1,'0000-00-00 00:00:00'),(6,'post',62,1,'2222',1,'2022-03-27 19:37:56'),(7,'post',69,9,'举办喵',1,'2022-03-28 06:25:44'),(8,'comment',14,1,'0',1,'2022-03-28 06:31:14'),(9,'comment',17,1,'Bad guy!',0,'2022-03-29 10:09:41'),(10,'post',79,10,'what a horrible post! ofc course i want to report!',1,'2022-03-30 01:31:18'),(11,'post',87,10,'he forgot his homework!!!',0,'2022-03-31 18:10:47'),(12,'comment',2,6,'test',0,'2022-04-01 18:27:52'),(13,'comment',26,6,'I agree with you ',0,'2022-04-01 18:29:54');
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` bigint(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `permission` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','$2y$10$C9YZ0Ff5NfIpV1pd7xzCTu2d2w6QRE1SFJfA2cN9/PME549zqIwUa','&quot;hello&quot;',255),(2,'pavel','$2y$10$zk74VYeTroYnzFi/U5kFNuI8niRJv0NxF/vQmtr/cF8VHa0l8iriK','',1),(6,'xiao','$2y$10$r1NoxtoIphb0lfoPXANalubBZYhK6xlJmIHqEENIQOXWnIfcmCgDW','',1),(7,'Jinjin Huang','$2y$10$t5L87gNFfj4k8S1NIZ5sMezHxJ2c.mjPX9AoIG04Pjb76JKUfZ/XW','',1),(8,'new_user','$2y$10$tPC9jr/mSXERdoLs/FVn4.WCxCGdQb4Ik.K9eMRG9sxcuqTY6Kzbi',NULL,1),(9,'testuser','$2y$10$gKcWCHwUSm5JRSV.LobeLew4i84kOhnhHaBjDQhsUKA1oPUv6/336','',1),(10,'abdul','$2y$10$l4GPW9S1T7ONKoIkvFSKce5NOaGq3bm5LmieXDPq0yJzMnkkPjVYO','Whatever it is, good for you!',1),(11,'ghazaryan','$2y$10$LqBE6Fkt3a2jzIYsv3PFlOApw2cHmdaqIBm4Iw8yaO3R2sJ/j52Z2','',1),(12,'pavelghazaryan997','$2y$10$Dz0XJh6.YbdEG1t2w.4EqulrZQsMpTRloI7BItlRMHud/jyapDbTW',NULL,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_login`
--

DROP TABLE IF EXISTS `user_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_login` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) DEFAULT NULL,
  `ip` text COLLATE utf8_unicode_ci,
  `datetime` datetime DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login`
--

LOCK TABLES `user_login` WRITE;
/*!40000 ALTER TABLE `user_login` DISABLE KEYS */;
INSERT INTO `user_login` VALUES (1,1,'127.0.0.1','2022-03-30 18:37:39',1),(2,1,'127.0.0.1','2022-03-30 18:37:39',1),(3,1,'0.0.0.0','2022-03-30 22:05:57',1),(4,1,'0.0.0.0','2022-03-30 22:05:57',1),(5,1,'0.0.0.0','2022-03-30 22:52:46',1),(6,1,'0.0.0.0','2022-03-30 22:52:46',1),(7,1,'127.0.0.1','2022-03-31 18:08:04',1),(8,1,'127.0.0.1','2022-03-31 18:08:04',1),(9,9,'127.0.0.1','2022-03-31 18:08:55',1),(10,9,'127.0.0.1','2022-03-31 18:08:55',1),(11,10,'127.0.0.1','2022-03-31 18:09:29',1),(12,10,'127.0.0.1','2022-03-31 18:09:29',1),(13,1,'127.0.0.1','2022-03-31 18:11:07',1),(14,1,'127.0.0.1','2022-03-31 18:11:07',1),(15,2,'0.0.0.0','2022-03-31 12:12:58',1),(16,2,'0.0.0.0','2022-03-31 12:12:58',1),(17,2,'0.0.0.0','2022-03-31 15:38:15',1),(18,2,'0.0.0.0','2022-03-31 15:38:16',1),(19,1,'127.0.0.1','2022-04-01 04:45:48',1),(20,1,'127.0.0.1','2022-04-01 04:45:48',1);
/*!40000 ALTER TABLE `user_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'groupr3'
--

--
-- Dumping routines for database 'groupr3'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-01 20:07:36
