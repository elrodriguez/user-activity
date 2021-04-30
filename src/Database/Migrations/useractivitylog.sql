/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.4.18-MariaDB : Database - user_activity_log
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`user_activity_log` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `user_activity_log`;

/*Table structure for table `activity_log` */

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `component` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `data_json_old` longtext COLLATE utf8_spanish_ci DEFAULT NULL,
  `data_json_updated` longtext COLLATE utf8_spanish_ci DEFAULT NULL,
  `table_name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `table_column_id` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `model_name` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `route` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `context` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `response_code` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `response_message` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `type_activity` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `user_id` bigint(20) DEFAULT NULL,
  `user` longtext COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


