-- MySQL dump 10.11
--
-- Host: localhost    Database: ncanecom_db
-- ------------------------------------------------------
-- Server version	5.0.85-community-log

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
-- Table structure for table `active_guests`
--

DROP TABLE IF EXISTS `active_guests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `active_users`
--

DROP TABLE IF EXISTS `active_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `banned_users`
--

DROP TABLE IF EXISTS `banned_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mail_tbl`
--

DROP TABLE IF EXISTS `mail_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_tbl` (
  `mail_id` int(11) NOT NULL auto_increment,
  `mail_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `mail_ip` varchar(15) NOT NULL default '',
  `mail_to_mail` varchar(100) NOT NULL default '',
  `mail_to_name` varchar(100) NOT NULL default '',
  `mail_from_mail` varchar(100) NOT NULL default '',
  `mail_from_name` varchar(100) NOT NULL default '',
  `ncane_id` varchar(8) NOT NULL default '',
  PRIMARY KEY  (`mail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=866 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ncane_log`
--

DROP TABLE IF EXISTS `ncane_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ncane_log` (
  `id` int(11) NOT NULL auto_increment,
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `page` varchar(255) NOT NULL default '',
  `log_entry` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ncane_tbl`
--

DROP TABLE IF EXISTS `ncane_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ncane_tbl` (
  `ncane_id` varchar(8) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `ncane_url` varchar(8000) NOT NULL,
  `ncane_desc` varchar(255) NOT NULL,
  `ncane_hit` bigint(20) NOT NULL default '0',
  `ncane_ip` int(11) default NULL,
  `ncane_date` datetime NOT NULL default '2008-01-01 00:00:00',
  `ncane_lastdate` datetime NOT NULL default '2008-01-01 00:00:00',
  `ncane_exp` tinyint(1) NOT NULL default '0',
  `ncane_adult` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`ncane_id`),
  KEY `ncane_date` (`ncane_date`),
  KEY `user_name` (`user_name`),
  KEY `ncane_url` (`ncane_url`(767)),
  KEY `ncane_ip` (`ncane_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `ncane_vw`
--

DROP TABLE IF EXISTS `ncane_vw`;
/*!50001 DROP VIEW IF EXISTS `ncane_vw`*/;
/*!50001 CREATE TABLE `ncane_vw` (
  `ncane_id` varchar(8),
  `user_name` varchar(30),
  `ncane_url` varchar(8000),
  `ncane_desc` varchar(255),
  `ncane_hit` bigint(20),
  `ncane_ip` varbinary(31),
  `ncane_date` datetime,
  `ncane_lastdate` datetime,
  `ncane_exp` tinyint(1),
  `ncane_adult` tinyint(1)
) ENGINE=MyISAM */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) default NULL,
  `userid` varchar(32) default NULL,
  `userlevel` tinyint(1) unsigned NOT NULL,
  `email` varchar(50) default NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`username`),
  UNIQUE KEY `IDX_email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Final view structure for view `ncane_vw`
--

/*!50001 DROP TABLE `ncane_vw`*/;
/*!50001 DROP VIEW IF EXISTS `ncane_vw`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ncanecom`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ncane_vw` AS select `ncane_tbl`.`ncane_id` AS `ncane_id`,`ncane_tbl`.`user_name` AS `user_name`,`ncane_tbl`.`ncane_url` AS `ncane_url`,`ncane_tbl`.`ncane_desc` AS `ncane_desc`,`ncane_tbl`.`ncane_hit` AS `ncane_hit`,inet_ntoa(`ncane_tbl`.`ncane_ip`) AS `ncane_ip`,`ncane_tbl`.`ncane_date` AS `ncane_date`,`ncane_tbl`.`ncane_lastdate` AS `ncane_lastdate`,`ncane_tbl`.`ncane_exp` AS `ncane_exp`,`ncane_tbl`.`ncane_adult` AS `ncane_adult` from `ncane_tbl` */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-02-24  6:07:02
