-- --------------------------------------------------------
-- Host:                         davinchi.com-ext.com
-- Server version:               5.1.54-log - MySQL Community Server (GPL) by Remi
-- Server OS:                    redhat-linux-gnu
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for studioPortal
CREATE DATABASE IF NOT EXISTS `studioPortal` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `studioPortal`;

-- Dumping structure for table studioPortal.accessCondition
CREATE TABLE IF NOT EXISTS `accessCondition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `accessOrder` int(11) DEFAULT NULL,
  `fieldName` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `accessOperand` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `accessCondition` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `accessLogic` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- Dumping data for table studioPortal.accessCondition: 2 rows
/*!40000 ALTER TABLE `accessCondition` DISABLE KEYS */;
INSERT INTO `accessCondition` (`id`, `access`, `accessOrder`, `fieldName`, `accessOperand`, `accessCondition`, `accessLogic`) VALUES
	(19, 'Pro', 1, 'Product', 'Contains', 'Pro', '');
INSERT INTO `accessCondition` (`id`, `access`, `accessOrder`, `fieldName`, `accessOperand`, `accessCondition`, `accessLogic`) VALUES
	(20, 'Free', 1, 'Product', 'Contains', 'Free', '');
/*!40000 ALTER TABLE `accessCondition` ENABLE KEYS */;

-- Dumping structure for table studioPortal.activityLog
CREATE TABLE IF NOT EXISTS `activityLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logtime` datetime NOT NULL,
  `user` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `activity` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `detail` varchar(250) COLLATE utf8_bin DEFAULT '',
  `beforeupdate` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `afterupdate` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- Dumping data for table studioPortal.activityLog: 18 rows
/*!40000 ALTER TABLE `activityLog` DISABLE KEYS */;
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(34, '2014-03-21 19:03:35', 'boonsom@mindfireinc.com', 'Edit contact', 'mem003', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(35, '2014-03-21 19:06:20', 'boonsom@mindfireinc.com', 'Edit contact', 'mem003', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(36, '2014-03-21 19:08:48', 'boonsom@mindfireinc.com', 'Edit contact', 'mem003', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(37, '2014-03-21 19:11:54', 'boonsom@mindfireinc.com', 'Edit contact', 'mem003', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(38, '2014-03-21 19:12:26', 'boonsom@mindfireinc.com', 'Edit contact', 'mem003', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(39, '2014-03-24 16:46:16', 'kdutta@mindfireinc.com', 'Edit contact', 'mem004', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(40, '2014-03-25 18:03:04', 'kdutta@mindfireinc.com', 'Edit contact', 'mem003', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(41, '2014-03-26 15:47:08', 'kdutta@mindfireinc.com', 'Edit contact', 'mem008', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(42, '2014-03-27 10:49:35', 'kdutta@mindfireinc.com', 'Add/Edit user', 'tim.mandell@geneseo.com', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(43, '2014-03-27 10:53:21', 'kdutta@mindfireinc.com', 'Add/Edit user', 'tim.mandell@geneseo.com', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(44, '2014-03-27 11:01:39', 'kdutta@mindfireinc.com', 'Add/Edit user', 'tim.mandell@geneseo.com', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(45, '2014-03-27 11:02:49', 'tim.mandell@geneseo.com', 'Edit contact', 'mem006', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(46, '2014-03-27 15:14:41', 'kdutta@mindfireinc.com', 'Edit contact', 'mem006', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(47, '2014-03-27 16:22:57', 'kdutta@mindfireinc.com', 'Edit contact', 'mem006', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(48, '2014-03-27 17:19:03', 'kdutta@mindfireinc.com', 'Edit contact', 'mem006', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(49, '2014-05-02 15:39:57', 'kdutta@mindfireinc.com', 'Edit contact', 'mem004', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(50, '2014-06-20 14:01:47', 'kdutta@mindfireinc.com', 'Edit contact', 'mem008', NULL, NULL);
INSERT INTO `activityLog` (`id`, `logtime`, `user`, `activity`, `detail`, `beforeupdate`, `afterupdate`) VALUES
	(51, '2014-06-20 14:08:17', 'kdutta@mindfireinc.com', 'Edit contact', 'mem008', NULL, NULL);
/*!40000 ALTER TABLE `activityLog` ENABLE KEYS */;

-- Dumping structure for table studioPortal.shire_dms
CREATE TABLE IF NOT EXISTS `shire_dms` (
  `purl` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `trackingno` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `createdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- Dumping data for table studioPortal.shire_dms: 208 rows
/*!40000 ALTER TABLE `shire_dms` DISABLE KEYS */;
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('DavidGilliam', '1Z6591749094889358', '2017-07-13 00:28:35');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('DavidGilliam', '1Z6591749090746367', '2017-07-13 00:28:35');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('DavidGilliam', '1Z6591749094221372', '2017-07-13 00:28:35');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('DavidGilliam', '1Z6591749092714389', '2017-07-13 00:28:35');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('DavidGilliam', '1Z6591749093625394', '2017-07-13 00:28:35');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('DavidGilliam', '1Z6591749094354407', '2017-07-13 00:28:35');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('DavidGilliam', '1Z6591749092301413', '2017-07-13 00:28:35');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('DavidGilliam', '1Z6591749094866426', '2017-07-13 00:28:35');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AshleyDavisNail', '1Z6591749094449430', '2017-07-13 01:00:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AshleyDavisNail', '1Z6591749093450448', '2017-07-13 01:00:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AshleyDavisNail', '1Z6591749094269456', '2017-07-13 01:00:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AshleyDavisNail', '1Z6591749094306469', '2017-07-13 01:00:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AshleyDavisNail', '1Z6591749090961473', '2017-07-13 01:00:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AshleyDavisNail', '1Z6591749091634486', '2017-07-13 01:00:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AshleyDavisNail', '1Z6591749093725491', '2017-07-13 01:00:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AshleyDavisNail', '1Z6591749094634506', '2017-07-13 01:00:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749091761517', '2017-07-13 07:46:55');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749092506523', '2017-07-13 07:46:55');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749094269536', '2017-07-13 07:46:55');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749094450544', '2017-07-13 07:46:55');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749090449554', '2017-07-13 07:46:55');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749094666562', '2017-07-13 07:46:55');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749094501579', '2017-07-13 07:46:55');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749092354581', '2017-07-13 07:46:55');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749090625596', '2017-07-13 07:48:08');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749091714603', '2017-07-13 07:48:08');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749093021616', '2017-07-13 07:48:08');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749091946621', '2017-07-13 07:48:08');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749090889632', '2017-07-13 07:48:08');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749092250648', '2017-07-13 07:48:08');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749093429650', '2017-07-13 07:48:08');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RyanBroome', '1Z6591749091826662', '2017-07-13 07:48:08');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('PatriciaStevenson', '1Z6591749094841676', '2017-07-13 07:55:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('PatriciaStevenson', '1Z6591749094874686', '2017-07-13 07:55:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('PatriciaStevenson', '1Z6591749094325699', '2017-07-13 07:55:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('PatriciaStevenson', '1Z6591749090594709', '2017-07-13 07:55:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('PatriciaStevenson', '1Z6591749091081716', '2017-07-13 07:55:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('PatriciaStevenson', '1Z6591749093186725', '2017-07-13 07:55:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('PatriciaStevenson', '1Z6591749094309733', '2017-07-13 07:55:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('PatriciaStevenson', '1Z6591749091850742', '2017-07-13 07:55:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749093209754', '2017-07-13 09:20:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749090786761', '2017-07-13 09:20:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749091981771', '2017-07-13 09:20:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749094194787', '2017-07-13 09:20:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749094825792', '2017-07-13 09:20:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749091274802', '2017-07-13 09:20:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749090941815', '2017-07-13 09:20:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749091226828', '2017-07-13 09:20:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749094529835', '2017-07-13 09:21:15');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749093250842', '2017-07-13 09:21:15');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749094789859', '2017-07-13 09:21:15');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749091546867', '2017-07-13 09:21:15');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749090921873', '2017-07-13 09:21:15');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749090314887', '2017-07-13 09:21:15');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749092125891', '2017-07-13 09:21:15');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KarenVignale', '1Z6591749093754905', '2017-07-13 09:21:15');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MelanieSebby', '1Z6591749036382512', '2017-07-13 09:24:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MelanieSebby', '1Z6591749033548125', '2017-07-13 09:24:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MelanieSebby', '1Z6591749033391937', '2017-07-13 09:24:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MelanieSebby', '1Z6591749036397944', '2017-07-13 09:24:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MelanieSebby', '1Z6591749023130157', '2017-07-13 09:24:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MelanieSebby', '1Z6591749023832569', '2017-07-13 09:24:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MelanieSebby', '1Z6591749020029175', '2017-07-13 09:24:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MelanieSebby', '1Z6591749038123986', '2017-07-13 09:24:32');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749092601910', '2017-07-13 09:54:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749091066920', '2017-07-13 09:54:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749091549935', '2017-07-13 09:54:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749091450942', '2017-07-13 09:54:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749093169959', '2017-07-13 09:54:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749094106961', '2017-07-13 09:54:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749091661974', '2017-07-13 09:54:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749093234986', '2017-07-13 09:54:02');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749091225990', '2017-07-13 09:54:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749093035003', '2017-07-13 09:54:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749091062013', '2017-07-13 09:54:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749092707020', '2017-07-13 09:54:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749090370030', '2017-07-13 09:54:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749091451049', '2017-07-13 09:54:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749093350056', '2017-07-13 09:54:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749093467065', '2017-07-13 09:54:50');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749094202071', '2017-07-13 11:29:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749092955084', '2017-07-13 11:29:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749092126096', '2017-07-13 11:29:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749094115102', '2017-07-13 11:29:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749091322116', '2017-07-13 11:29:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749091147128', '2017-07-13 11:29:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749090990138', '2017-07-13 11:29:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749093251145', '2017-07-13 11:29:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749090330154', '2017-07-13 11:36:31');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749094627167', '2017-07-13 11:36:31');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749093542170', '2017-07-13 11:36:31');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749094475189', '2017-07-13 11:36:31');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749094826193', '2017-07-13 11:36:31');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749091995202', '2017-07-13 11:36:31');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749093382218', '2017-07-13 11:36:31');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('StacyWhite', '1Z6591749091387226', '2017-07-13 11:36:31');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AprilCraig', '1Z6591749093410231', '2017-07-13 12:20:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AprilCraig', '1Z6591749091851241', '2017-07-13 12:20:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AprilCraig', '1Z6591749094110250', '2017-07-13 12:20:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AprilCraig', '1Z6591749092587268', '2017-07-13 12:20:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AprilCraig', '1Z6591749094682277', '2017-07-13 12:20:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AprilCraig', '1Z6591749092795284', '2017-07-13 12:20:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AprilCraig', '1Z6591749094326296', '2017-07-13 12:20:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AprilCraig', '1Z6591749091675307', '2017-07-13 12:20:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JohnKovatch', '1Z6591749092242317', '2017-07-13 12:39:21');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JohnKovatch', '1Z6591749093427321', '2017-07-13 12:39:21');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JohnKovatch', '1Z6591749092630335', '2017-07-13 12:39:21');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JohnKovatch', '1Z6591749092251343', '2017-07-13 12:39:21');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JohnKovatch', '1Z6591749094690357', '2017-07-13 12:39:21');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JohnKovatch', '1Z6591749092347366', '2017-07-13 12:39:21');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JohnKovatch', '1Z6591749092622371', '2017-07-13 12:39:21');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JohnKovatch', '1Z6591749092915386', '2017-07-13 12:39:21');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('TineraMathews', '1Z6591749090626399', '2017-07-13 12:45:25');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('TineraMathews', '1Z6591749093155400', '2017-07-13 12:45:25');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('TineraMathews', '1Z6591749092902416', '2017-07-13 12:45:25');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('TineraMathews', '1Z6591749092267425', '2017-07-13 12:45:25');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('TineraMathews', '1Z6591749093650437', '2017-07-13 12:45:25');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('TineraMathews', '1Z6591749094451445', '2017-07-13 12:45:25');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('TineraMathews', '1Z6591749092070459', '2017-07-13 12:45:25');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('TineraMathews', '1Z6591749093907464', '2017-07-13 12:45:25');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RogerRude', '1Z6591749092362474', '2017-07-13 12:56:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RogerRude', '1Z6591749094835487', '2017-07-13 12:56:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RogerRude', '1Z6591749093726490', '2017-07-13 12:56:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RogerRude', '1Z6591749091435503', '2017-07-13 12:56:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RogerRude', '1Z6591749090362512', '2017-07-13 12:56:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RogerRude', '1Z6591749092907528', '2017-07-13 12:56:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RogerRude', '1Z6591749091470537', '2017-07-13 12:56:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('RogerRude', '1Z6591749093451545', '2017-07-13 12:56:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MaryThigpen', '1Z6591749091250551', '2017-07-13 13:13:38');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MaryThigpen', '1Z6591749092267569', '2017-07-13 13:13:38');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MaryThigpen', '1Z6591749093902576', '2017-07-13 13:13:38');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MaryThigpen', '1Z6591749093555586', '2017-07-13 13:13:38');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MaryThigpen', '1Z6591749093626599', '2017-07-13 13:13:38');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MaryThigpen', '1Z6591749091515604', '2017-07-13 13:13:38');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MaryThigpen', '1Z6591749094622617', '2017-07-13 13:13:38');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('MaryThigpen', '1Z6591749090347628', '2017-07-13 13:13:38');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749091090635', '2017-07-13 13:35:57');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749094251643', '2017-07-13 13:35:57');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749092230651', '2017-07-13 13:35:57');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749092427663', '2017-07-13 13:35:57');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749092242675', '2017-07-13 13:35:57');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749094075683', '2017-07-13 13:35:57');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749090326696', '2017-07-13 13:35:57');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ArtiVyas', '1Z6591749093395704', '2017-07-13 13:35:57');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749035000999', '2017-07-13 14:26:49');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749035624208', '2017-07-13 14:26:49');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749022637611', '2017-07-13 14:26:49');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749090682711', '2017-07-13 14:26:49');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749094587728', '2017-07-13 14:26:49');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749092510732', '2017-07-13 14:26:49');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749091851741', '2017-07-13 14:26:49');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749090010759', '2017-07-13 14:26:49');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749094387766', '2017-07-13 14:27:29');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749092382774', '2017-07-13 14:27:29');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749037965220', '2017-07-13 14:27:29');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749091395780', '2017-07-13 14:27:29');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749093826793', '2017-07-13 14:27:29');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749036411034', '2017-07-13 14:27:29');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749092075801', '2017-07-13 14:27:29');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('AngelaJenkins-Thomas', '1Z6591749031259049', '2017-07-13 14:27:29');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749093542812', '2017-07-13 14:54:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749090627825', '2017-07-13 14:54:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749090730838', '2017-07-13 14:54:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749091251845', '2017-07-13 14:54:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749094590858', '2017-07-13 14:54:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749093147866', '2017-07-13 14:54:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749094322870', '2017-07-13 14:54:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749090515884', '2017-07-13 14:54:24');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('VanceRoberts', '1Z6591749094126896', '2017-07-13 16:11:28');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('VanceRoberts', '1Z6591749092555908', '2017-07-13 16:11:28');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('VanceRoberts', '1Z6591749093202911', '2017-07-13 16:11:28');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('VanceRoberts', '1Z6591749093467921', '2017-07-13 16:11:28');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('VanceRoberts', '1Z6591749090750932', '2017-07-13 16:11:28');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('VanceRoberts', '1Z6591749092451949', '2017-07-13 16:11:28');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('VanceRoberts', '1Z6591749090970954', '2017-07-13 16:11:28');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('VanceRoberts', '1Z6591749093707966', '2017-07-13 16:11:28');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KelleyFitting', '1Z6591749093062975', '2017-07-13 19:10:09');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KelleyFitting', '1Z6591749091435987', '2017-07-13 19:10:09');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KelleyFitting', '1Z6591749091226999', '2017-07-13 19:10:09');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KelleyFitting', '1Z6591749094836002', '2017-07-13 19:10:09');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KelleyFitting', '1Z6591749094663010', '2017-07-13 19:10:09');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KelleyFitting', '1Z6591749093108023', '2017-07-13 19:10:09');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KelleyFitting', '1Z6591749092571033', '2017-07-13 19:10:09');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('KelleyFitting', '1Z6591749090452040', '2017-07-13 19:10:09');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749094151055', '2017-07-13 22:55:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749091068062', '2017-07-13 22:55:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749093603078', '2017-07-13 22:55:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749094156087', '2017-07-13 22:55:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749090127099', '2017-07-13 22:55:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749093916105', '2017-07-13 22:55:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749092923117', '2017-07-13 22:55:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JesikaBennett-Sogar', '1Z6591749094548127', '2017-07-13 22:55:26');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ShaniaMontgomery', '1Z6591749091191133', '2017-07-13 22:57:40');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ShaniaMontgomery', '1Z6591749090252140', '2017-07-13 22:57:40');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ShaniaMontgomery', '1Z6591749094131157', '2017-07-13 22:57:40');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ShaniaMontgomery', '1Z6591749090228168', '2017-07-13 22:57:40');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ShaniaMontgomery', '1Z6591749090943171', '2017-07-13 22:57:40');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ShaniaMontgomery', '1Z6591749093676188', '2017-07-13 22:57:40');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ShaniaMontgomery', '1Z6591749090827190', '2017-07-13 22:57:40');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('ShaniaMontgomery', '1Z6591749094796207', '2017-07-13 22:57:40');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JacobMoore', '1Z6591749092983213', '2017-07-13 23:49:52');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JacobMoore', '1Z6591749092788229', '2017-07-13 23:49:52');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JacobMoore', '1Z6591749091611232', '2017-07-13 23:49:52');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JacobMoore', '1Z6591749091852240', '2017-07-13 23:49:52');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JacobMoore', '1Z6591749090911259', '2017-07-13 23:49:52');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JacobMoore', '1Z6591749091188263', '2017-07-13 23:49:52');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JacobMoore', '1Z6591749090083270', '2017-07-13 23:49:52');
INSERT INTO `shire_dms` (`purl`, `trackingno`, `createdate`) VALUES
	('JacobMoore', '1Z6591749094996287', '2017-07-13 23:49:52');
/*!40000 ALTER TABLE `shire_dms` ENABLE KEYS */;

-- Dumping structure for table studioPortal.trackingData
CREATE TABLE IF NOT EXISTS `trackingData` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Member_ID` varchar(50) COLLATE utf8_bin DEFAULT '',
  `TrackingNumber` varchar(50) COLLATE utf8_bin DEFAULT '',
  `WalMartOrderNumber` varchar(50) COLLATE utf8_bin DEFAULT '',
  `ListSent` varchar(50) COLLATE utf8_bin DEFAULT '',
  `OfferSent` varchar(50) COLLATE utf8_bin DEFAULT '',
  `CardSent` varchar(50) COLLATE utf8_bin DEFAULT '',
  `OrderPlaced` varchar(50) COLLATE utf8_bin DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- Dumping data for table studioPortal.trackingData: 21 rows
/*!40000 ALTER TABLE `trackingData` DISABLE KEYS */;
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(1, '2014-03-25 11:56:23', 'mem003', 'TRK001', 'WAL001', 'L001', 'O001', 'C001', 'OP001');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(2, '2014-03-25 11:56:26', 'mem003', 'TRK002', 'WAL002', 'L002', 'O002', 'C002', 'OP002');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(3, '2014-03-25 19:48:48', 'mem003', 'TRK003', 'WAL003', 'L003', 'O003', 'C003', 'OP003');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(4, '2014-03-25 19:52:11', 'mem003', 'TRK004', 'WAL004', 'L004', 'O004', 'C004', 'OP004');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(5, '2014-03-25 19:54:33', 'mem003', 'TRK005', 'WAL005', 'L005', 'O005', 'C005', 'OP005');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(6, '2014-03-25 20:00:21', 'mem003', 'TRK006', 'WAL006', 'L006', 'O006', 'C006', 'OP006');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(7, '2014-03-25 20:02:07', 'mem003', 'TRK007', 'WAL007', 'L007', 'O007', 'C007', 'OP007');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(8, '2014-03-25 20:06:59', 'mem003', 'TRK008', 'WAL008', 'L008', 'O008', 'C008', 'OP008');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(9, '2014-03-25 20:08:20', 'mem003', 'TRK009', 'WAL009', 'L009', 'O009', 'C009', 'OP009');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(10, '2014-03-25 20:11:59', 'mem003', 'TRK010', 'WAL010', 'L010', 'O010', 'C010', 'OP010');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(11, '2014-03-25 20:21:32', 'mem003', 'TRK011', 'WAL011', 'L011', 'O011', 'C011', 'OP011');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(12, '2014-03-25 20:28:34', 'mem003', 'TRK012', 'WAL012', 'L012', 'O012', 'C012', 'OP012');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(15, '2014-03-25 20:30:40', 'mem003', 'TRK014', 'WAL014', 'L014', 'O014', 'C014', 'OP014');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(16, '2014-03-26 13:26:00', 'mem003', 'TRK013', 'WAL013', 'L013', 'O013', 'C013', 'OP013');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(17, '2014-03-26 13:27:39', 'mem003', 'TRK015', 'WAL015', 'L015', 'O015', 'C015', 'OP015');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(18, '2014-03-26 13:29:08', 'mem003', 'TRK016', 'WAL016', 'L016', 'O016', 'C016', 'OP016');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(19, '2014-03-26 13:35:52', 'mem003', 'TRK018', 'WAL018', 'L018', 'O018', 'C018', 'OP018');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(20, '2014-03-26 13:38:53', 'mem003', 'TRK017', 'WAL017', 'L017', 'O017', 'C017', 'OP017');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(21, '2014-03-26 15:48:25', 'mem008', '1Z608884YW60959140 ', 'JY234', '', '', '', '');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(22, '2014-03-27 15:16:15', 'mem006', '1Zaskjdhasjdhas', 'cdsdscdsc', '', '', '', '');
INSERT INTO `trackingData` (`id`, `createOn`, `Member_ID`, `TrackingNumber`, `WalMartOrderNumber`, `ListSent`, `OfferSent`, `CardSent`, `OrderPlaced`) VALUES
	(23, '2014-03-27 16:24:18', 'mem006', '', '', '', '', 'Birthday Card', '');
/*!40000 ALTER TABLE `trackingData` ENABLE KEYS */;

-- Dumping structure for table studioPortal.userAccess
CREATE TABLE IF NOT EXISTS `userAccess` (
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `access` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- Dumping data for table studioPortal.userAccess: 2 rows
/*!40000 ALTER TABLE `userAccess` DISABLE KEYS */;
INSERT INTO `userAccess` (`email`, `access`) VALUES
	('crm@mindfireinc.com', 'Pro');
INSERT INTO `userAccess` (`email`, `access`) VALUES
	('tim.mandell@geneseo.com', 'Pro');
/*!40000 ALTER TABLE `userAccess` ENABLE KEYS */;

-- Dumping structure for table studioPortal.users
CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(50) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `superadmin` varchar(50) COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- Dumping data for table studioPortal.users: 5 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`email`, `firstname`, `lastname`, `password`, `superadmin`) VALUES
	('boonsom@mindfireinc.com', 'boonsom', 'coa', 'atm123', 'Y');
INSERT INTO `users` (`email`, `firstname`, `lastname`, `password`, `superadmin`) VALUES
	('kdutta@mindfireinc.com', 'Kushal', 'Dutta', '1234', 'Y');
INSERT INTO `users` (`email`, `firstname`, `lastname`, `password`, `superadmin`) VALUES
	('crm@mindfireinc.com', 'crm', 'crm', 'crm', '');
INSERT INTO `users` (`email`, `firstname`, `lastname`, `password`, `superadmin`) VALUES
	('tim.mandell@geneseo.com', 'Tim', 'Mandell', '1234', 'Y');
INSERT INTO `users` (`email`, `firstname`, `lastname`, `password`, `superadmin`) VALUES
	('Stadiumnissanreporting@gmail.com', 'Stadium', 'Nissan', 'Stadium1!', 'Y');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table studioPortal.xmediaAPI
CREATE TABLE IF NOT EXISTS `xmediaAPI` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountname` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `PartnerGuid` varchar(250) COLLATE utf8_bin NOT NULL DEFAULT '',
  `PartnerPwd` varchar(250) COLLATE utf8_bin NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=397 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- Dumping data for table studioPortal.xmediaAPI: 79 rows
/*!40000 ALTER TABLE `xmediaAPI` DISABLE KEYS */;
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(306, 'Waybetter Marketing', 'WaybetterMarketingAPIUser', 'd5a6f43185e350b82eca351da3bf88');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(307, 'CampaignLauncher', 'CampaignLauncherAPIUser', '4e98af380d523688c0504e98af3=');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(308, 'AIC_Application', 'WaybetterMarketingAPIUser', 'd5a6f43185e350b82eca351da3bf88');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(309, 'Newman Freshmen', 'WaybetterMarketingAPIUser', 'd5a6f43185e350b82eca351da3bf88');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(311, 'Denver', 'WaybetterMarketingAPIUser', 'd5a6f43185e350b82eca351da3bf88');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(312, 'Newman Adult', 'WaybetterMarketingAPIUser', 'd5a6f43185e350b82eca351da3bf88');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(313, 'MindFire Client Profile', 'MindFireClientProfileAPIUser', '889fb7cc0247c78900c36b9c26744');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(314, 'Diamond Marketing Solutions', 'DiamondMarketingSolutionsAPIUser', '814108c84f41f88ef1ab97f7c801d');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(315, 'MetLife Defender', 'DiamondMarketingSolutionsAPIUser', '814108c84f41f88ef1ab97f7c801d');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(316, 'MetLife Defender Test', 'DiamondMarketingSolutionsAPIUser', '814108c84f41f88ef1ab97f7c801d');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(333, 'Davis Equipment', 'EdwardsGraphicsArtsAPIUser', 'c75549a9f4007a0940245ca00090');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(334, 'Global Printing', 'GlobalPrintingAPIUser', 'e10ccdb8d4c28d30766aa8c966');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(330, 'Edwards Graphics Arts', 'EdwardsGraphicsArtsAPIUser', 'c75549a9f4007a0940245ca00090');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(331, 'Turfwerks', 'EdwardsGraphicsArtsAPIUser', 'c75549a9f4007a0940245ca00090');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(332, 'Wellness Brands', 'EdwardsGraphicsArtsAPIUser', 'c75549a9f4007a0940245ca00090');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(322, 'CPS Gumpert', 'CPSGumpertAPIUser', '20026b6f7dded36a54c3d9fab262');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(323, 'Ironmark Registration', 'CPSGumpertAPIUser', '20026b6f7dded36a54c3d9fab262');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(325, 'AIM Integrated Solutions ', 'AIMIntegratedSolutionsAPIUser', '5446e58c54effa47bdc33440f3da');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(326, 'Chiron Nurture', 'AIMIntegratedSolutionsAPIUser', '5446e58c54effa47bdc33440f3da');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(327, 'First Choice', 'AIMIntegratedSolutionsAPIUser', '5446e58c54effa47bdc33440f3da');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(328, 'RCS Wireless Technology', 'AIMIntegratedSolutionsAPIUser', '5446e58c54effa47bdc33440f3da');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(329, 'Uwharrie Point', 'AIMIntegratedSolutionsAPIUser', '5446e58c54effa47bdc33440f3da');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(335, 'Cox Automotive', 'CoxAutomotiveAPIUser', 'c5662ded84d5fe59b18c69dc48');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(336, 'ExampleDealer', 'CoxAutomotiveAPIUser', 'c5662ded84d5fe59b18c69dc48');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(353, 'Brand Agent', 'BrandAgentAPIUser', '125d499351b1493ea2e9d3d9b1f91116');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(338, 'College-Application', 'ClarkCommunicationsAPIUser', 'd01cee58_bfa36f2c93ca34b08ec1b');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(339, 'Toccoa Falls College', 'ClarkCommunicationsAPIUser', 'd01cee58_bfa36f2c93ca34b08ec1b');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(340, 'Sandy Alexander', 'SandyAlexanderAPIUser', '4b4015d2b1d4efe897727470898');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(341, 'Sandy Alexander Test', 'SandyAlexanderAPIUser', '4b4015d2b1d4efe897727470898');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(342, 'Sandy Alexander - Salesforce', 'SandyAlexanderAPIUser', '4b4015d2b1d4efe897727470898');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(343, 'Centre College', 'SandyAlexanderAPIUser', '4b4015d2b1d4efe897727470898');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(344, 'STEP', 'SandyAlexanderAPIUser', '4b4015d2b1d4efe897727470898');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(345, 'MindFire Partner Communication (live)', 'MindFirePartnerCommunicationAPIUser', '9daaf9a2a10783d1cb945b2b12');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(346, 'FLRC Redirect', 'FLRCRedirectAPIUser', '230fb974a41d1269fdd7d4041b');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(347, 'MindFire Master', 'MarketingAPIUser', 'E59pyTwEJJao6VjsWTBmLGzMr78=');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(348, 'Test Account', 'EdwardsGraphicsArtsAPIUser', 'c75549a9f4007a0940245ca00090');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(349, 'A-Link', 'A-LinkAPIUser', '610ffbfe071e86498ab6fedc35b');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(350, 'Vision Benefits of America', 'A-LinkAPIUser', '610ffbfe071e86498ab6fedc35b');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(351, 'A-Link Sales & Marketing', 'A-LinkAPIUser', '610ffbfe071e86498ab6fedc35b');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(352, 'Fonteva', 'FontevaAPIUser', '3c23edd9fb958b3fc417d50ee0');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(354, 'Keiger Direct', 'KeigerDirectAPIUser', '1ad9ccb7984ab3923306a2f9e9e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(355, 'Salem College Live Campaign', 'KeigerDirectAPIUser', '1ad9ccb7984ab3923306a2f9e9e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(356, 'The Watermark Group', 'fe46c04b_4707_42f6_ab0b_6a3756d86a76', '5869Ff2a-2e92-434D-902f-89b48Bb40244');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(357, 'TWG Sales', 'fe46c04b_4707_42f6_ab0b_6a3756d86a76', '5869Ff2a-2e92-434D-902f-89b48Bb40244');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(358, 'Lakes Print', '72f223c6_b8c4_4ae0_8928_67e69e67e9a8', '10c8De3f-02dc-4db4-c738-dDc535aeb6d3');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(359, 'NW Bank Omaha PURL', '72f223c6_b8c4_4ae0_8928_67e69e67e9a8', '10c8De3f-02dc-4db4-c738-dDc535aeb6d3');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(360, '85327_TFC_2015', 'ClarkCommunicationsAPIUser', 'd01cee58_bfa36f2c93ca34b08ec1b');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(361, '85352_TFCevents_2015', 'ClarkCommunicationsAPIUser', 'd01cee58_bfa36f2c93ca34b08ec1b');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(362, 'Ventas Strategies', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(363, 'zStadium Nissan', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(364, 'Brasso Nissan Apr2016', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(377, 'Myers Orleans GM', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(366, 'Northstar Ford 042016', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(367, 'Integrity Hyundai', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(368, 'Demo2', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(369, 'Koch Lincoln June 2016', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(370, 'Northstar Ford Jul16', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(371, 'Knight VW Aug16', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(372, 'College Ford', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(373, 'Brasso Nissan', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(374, 'Stadium Nissan', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(375, 'Windsor Ford', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(376, 'Marlborough Ford', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(378, 'Northstar Ford', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(379, 'McDonald Nissan', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(380, 'DK Ford', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(381, 'Myers Bells Corners Hyundai', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(384, 'McDonald Chev Buick GMC', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(383, 'Koch Ford Athabasa', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(385, 'Okotoks Honda', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(390, 'Marketing for McArdle', 'McArdleSolutionsAPIUser', 'e1428857d2ef4b89fbbd68983660dc');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(389, 'Myers Kemptville GM', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(388, 'Myers Kanata Hyundai', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(391, 'Rosetown Mainline GM', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(392, 'Knight VW', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(393, 'Honda House', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(394, 'Stauffer Motors', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(395, 'Anderson Kia', 'Ventas Strategies', '846a4340e6b4e');
INSERT INTO `xmediaAPI` (`id`, `accountname`, `PartnerGuid`, `PartnerPwd`) VALUES
	(396, 'Myers Orleans Nissan', 'Ventas Strategies', '846a4340e6b4e');
/*!40000 ALTER TABLE `xmediaAPI` ENABLE KEYS */;

-- Dumping structure for table studioPortal.xmediaContact
CREATE TABLE IF NOT EXISTS `xmediaContact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `accountid` int(11) NOT NULL DEFAULT '0',
  `orderid` int(11) NOT NULL DEFAULT '0',
  `fieldname` varchar(250) COLLATE utf8_bin NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6835 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- Dumping data for table studioPortal.xmediaContact: 1,193 rows
/*!40000 ALTER TABLE `xmediaContact` DISABLE KEYS */;
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(533, 'paagla123@gmail.com', 228, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(532, 'paagla123@gmail.com', 228, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(321, 'joep@waybettermarketing.com', 1348, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(428, 'joep@waybettermarketing.com', 886, 12, 'Major2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3052, 'Stadiumnissanreporting@gmail.com', 2848, 7, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1180, 'Ethan@aimisresults.com', 1297, 10, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2343, 'jason.quinn@ega.com', 1146, 14, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2342, 'jason.quinn@ega.com', 1146, 13, 'Note');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2341, 'jason.quinn@ega.com', 1146, 12, 'LastOrderDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3021, 'stadiumnissanreporting@gmail.com', 2848, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3411, 'anne@wedrivesales.ca', 2918, 15, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(531, 'paagla123@gmail.com', 228, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(530, 'paagla123@gmail.com', 228, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(529, 'paagla123@gmail.com', 228, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(528, 'paagla123@gmail.com', 228, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(527, 'paagla123@gmail.com', 228, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3410, 'anne@wedrivesales.ca', 2918, 14, 'PIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4149, 'anne@wedrivesales.ca', 2942, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(320, 'joep@waybettermarketing.com', 1348, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(319, 'joep@waybettermarketing.com', 1348, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(318, 'joep@waybettermarketing.com', 1348, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(317, 'joep@waybettermarketing.com', 1348, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(316, 'joep@waybettermarketing.com', 1348, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(315, 'joep@waybettermarketing.com', 1348, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(322, 'joep@waybettermarketing.com', 1348, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2065, 'kdutta@mindfireinc.com', 886, 12, 'Activity1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2066, 'kdutta@mindfireinc.com', 886, 13, 'Activity1_Interest');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2064, 'kdutta@mindfireinc.com', 886, 11, 'DeliveryPointIndicator');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2063, 'kdutta@mindfireinc.com', 886, 10, 'Freshmen_Transfer');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2062, 'kdutta@mindfireinc.com', 886, 9, 'Fulltime_Parttime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2061, 'kdutta@mindfireinc.com', 886, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2060, 'kdutta@mindfireinc.com', 886, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(333, 'dmedrano@mindfireinc.com', 886, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(334, 'dmedrano@mindfireinc.com', 886, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(335, 'dmedrano@mindfireinc.com', 886, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(336, 'dmedrano@mindfireinc.com', 886, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(337, 'dmedrano@mindfireinc.com', 886, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(338, 'dmedrano@mindfireinc.com', 886, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(339, 'dmedrano@mindfireinc.com', 886, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(340, 'dmedrano@mindfireinc.com', 886, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(341, 'dmedrano@mindfireinc.com', 886, 9, 'DateofBirth');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(342, 'dmedrano@mindfireinc.com', 886, 10, 'High_School');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(427, 'joep@waybettermarketing.com', 886, 11, 'Major1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(426, 'joep@waybettermarketing.com', 886, 10, 'DateofBirth');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(425, 'joep@waybettermarketing.com', 886, 9, 'High_School');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(423, 'joep@waybettermarketing.com', 886, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(424, 'joep@waybettermarketing.com', 886, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(422, 'joep@waybettermarketing.com', 886, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(420, 'joep@waybettermarketing.com', 886, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(421, 'joep@waybettermarketing.com', 886, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(419, 'joep@waybettermarketing.com', 886, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(418, 'joep@waybettermarketing.com', 886, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(417, 'joep@waybettermarketing.com', 886, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2059, 'kdutta@mindfireinc.com', 886, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2058, 'kdutta@mindfireinc.com', 886, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2057, 'kdutta@mindfireinc.com', 886, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2056, 'kdutta@mindfireinc.com', 886, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2055, 'kdutta@mindfireinc.com', 886, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2054, 'kdutta@mindfireinc.com', 886, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4637, 'kdutta@mindfireinc.com', 2848, 11, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4189, 'stadiumsale@gmail.com', 2942, 19, 'CompleteDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4188, 'stadiumsale@gmail.com', 2942, 18, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4187, 'stadiumsale@gmail.com', 2942, 17, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4636, 'kdutta@mindfireinc.com', 2848, 10, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4635, 'kdutta@mindfireinc.com', 2848, 9, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3424, 'boonsom@mindfireinc.com', 228, 6, 'Anniversary');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(429, 'joep@waybettermarketing.com', 886, 13, 'Beginning_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(430, 'joep@waybettermarketing.com', 886, 14, 'Freshmen_Transfer');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(431, 'joep@waybettermarketing.com', 886, 15, 'Fulltime_Parttime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(432, 'joep@waybettermarketing.com', 886, 16, 'Gender');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(433, 'joep@waybettermarketing.com', 886, 17, 'US_Citizen');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(434, 'joep@waybettermarketing.com', 886, 18, 'English_Native');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(435, 'joep@waybettermarketing.com', 886, 19, 'Signature');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(436, 'joep@waybettermarketing.com', 886, 20, 'Signature_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(447, 'kdutta@mindfireinc.com', 1405, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(448, 'kdutta@mindfireinc.com', 1405, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(449, 'kdutta@mindfireinc.com', 1405, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(450, 'kdutta@mindfireinc.com', 1405, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(451, 'kdutta@mindfireinc.com', 1405, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(452, 'kdutta@mindfireinc.com', 1405, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(453, 'kdutta@mindfireinc.com', 1405, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(454, 'kdutta@mindfireinc.com', 1405, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(455, 'kdutta@mindfireinc.com', 1405, 9, 'Signed_License_Agreement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3980, 'brassoreports@gmail.com', 2918, 13, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(506, 'ccackowski@dmsolutions.com', 1359, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(505, 'ccackowski@dmsolutions.com', 1359, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(504, 'ccackowski@dmsolutions.com', 1359, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(503, 'ccackowski@dmsolutions.com', 1359, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(502, 'ccackowski@dmsolutions.com', 1359, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(501, 'ccackowski@dmsolutions.com', 1359, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(500, 'ccackowski@dmsolutions.com', 1359, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(507, 'ccackowski@dmsolutions.com', 1359, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(508, 'ccackowski@dmsolutions.com', 1359, 9, 'RecordID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1751, 'cdriscoll@mindfireinc.com', 1405, 9, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1749, 'cdriscoll@mindfireinc.com', 1405, 7, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1748, 'cdriscoll@mindfireinc.com', 1405, 6, 'Signed_License_Agreement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1747, 'cdriscoll@mindfireinc.com', 1405, 5, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(534, 'paagla123@gmail.com', 228, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(535, 'paagla123@gmail.com', 228, 9, 'AUTHCODE');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(536, 'paagla123@gmail.com', 228, 10, 'Provider_Office');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2339, 'jason.quinn@ega.com', 1146, 10, 'ScriptResult');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2340, 'jason.quinn@ega.com', 1146, 11, 'LetterType');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2338, 'jason.quinn@ega.com', 1146, 9, 'ScriptInfo');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2337, 'jason.quinn@ega.com', 1146, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1378, 'cdriscoll@mindfireinc.com', 228, 9, 'OfferSent');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1377, 'cdriscoll@mindfireinc.com', 228, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(598, 'kdutta@mindfireinc.com', 1309, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(599, 'kdutta@mindfireinc.com', 1309, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(600, 'kdutta@mindfireinc.com', 1309, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(601, 'kdutta@mindfireinc.com', 1309, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(602, 'kdutta@mindfireinc.com', 1309, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(603, 'kdutta@mindfireinc.com', 1309, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(604, 'kdutta@mindfireinc.com', 1309, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(605, 'kdutta@mindfireinc.com', 1309, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(606, 'kdutta@mindfireinc.com', 1309, 9, 'Address_Permanent');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(607, 'Jthorpe@cpsgumpert.com', 1508, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(608, 'Jthorpe@cpsgumpert.com', 1508, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(609, 'Jthorpe@cpsgumpert.com', 1508, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(610, 'Jthorpe@cpsgumpert.com', 1508, 4, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(611, 'Jthorpe@cpsgumpert.com', 1508, 5, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(612, 'Jthorpe@cpsgumpert.com', 1508, 6, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(613, 'Jthorpe@cpsgumpert.com', 1508, 7, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(614, 'Jthorpe@cpsgumpert.com', 1508, 8, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(615, 'Jthorpe@cpsgumpert.com', 1508, 9, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(616, 'Jthorpe@cpsgumpert.com', 1508, 10, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(617, 'boonsom@mindfireinc.com', 1359, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(618, 'boonsom@mindfireinc.com', 1359, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(619, 'boonsom@mindfireinc.com', 1359, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(620, 'boonsom@mindfireinc.com', 1359, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(621, 'boonsom@mindfireinc.com', 1359, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(622, 'boonsom@mindfireinc.com', 1359, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(623, 'boonsom@mindfireinc.com', 1359, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(624, 'boonsom@mindfireinc.com', 1359, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(625, 'boonsom@mindfireinc.com', 1359, 9, 'employeeID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(651, 'kdutta@mindfireinc.com', 1508, 8, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(650, 'kdutta@mindfireinc.com', 1508, 7, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(649, 'kdutta@mindfireinc.com', 1508, 6, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(648, 'kdutta@mindfireinc.com', 1508, 5, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(647, 'kdutta@mindfireinc.com', 1508, 4, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(646, 'kdutta@mindfireinc.com', 1508, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(645, 'kdutta@mindfireinc.com', 1508, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(644, 'kdutta@mindfireinc.com', 1508, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(652, 'kdutta@mindfireinc.com', 1508, 9, 'Address2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(653, 'kdutta@mindfireinc.com', 1508, 10, 'VendorVisitor');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(654, 'kdutta@mindfireinc.com', 1508, 11, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3408, 'anne@wedrivesales.ca', 2918, 12, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(914, 'ethan@aimisresults.com', 912, 17, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(913, 'ethan@aimisresults.com', 912, 16, 'Employment_size');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(912, 'ethan@aimisresults.com', 912, 15, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(711, 'jthorpe@cpsgumpert.com', 1508, 11, 'rating');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5292, 'brassoreports@gmail.com', 3404, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(710, 'jthorpe@cpsgumpert.com', 1508, 10, 'comments');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(709, 'jthorpe@cpsgumpert.com', 1508, 9, 'SalesRep_Employee_Name');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(708, 'jthorpe@cpsgumpert.com', 1508, 8, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(707, 'jthorpe@cpsgumpert.com', 1508, 7, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(706, 'jthorpe@cpsgumpert.com', 1508, 6, 'Title');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(705, 'jthorpe@cpsgumpert.com', 1508, 5, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(704, 'jthorpe@cpsgumpert.com', 1508, 4, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(703, 'jthorpe@cpsgumpert.com', 1508, 3, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(702, 'jthorpe@cpsgumpert.com', 1508, 2, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(701, 'jthorpe@cpsgumpert.com', 1508, 1, 'VendorVisitor');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6450, 'shoodjer@turfwerks.com', 882, 16, 'GMLastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(911, 'ethan@aimisresults.com', 912, 14, 'Category');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(910, 'ethan@aimisresults.com', 912, 13, 'Campaign');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(908, 'ethan@aimisresults.com', 912, 11, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(909, 'ethan@aimisresults.com', 912, 12, 'Address2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(907, 'ethan@aimisresults.com', 912, 10, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(906, 'ethan@aimisresults.com', 912, 9, 'Unsubscribed');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(904, 'ethan@aimisresults.com', 912, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(905, 'ethan@aimisresults.com', 912, 8, 'Whose_Contact');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(903, 'ethan@aimisresults.com', 912, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(901, 'ethan@aimisresults.com', 912, 4, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(902, 'ethan@aimisresults.com', 912, 5, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(900, 'ethan@aimisresults.com', 912, 3, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(815, 'ethan@aimisresults.com', 1297, 9, 'unsubscribed');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(814, 'ethan@aimisresults.com', 1297, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(813, 'ethan@aimisresults.com', 1297, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(812, 'ethan@aimisresults.com', 1297, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(811, 'ethan@aimisresults.com', 1297, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(809, 'ethan@aimisresults.com', 1297, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(810, 'ethan@aimisresults.com', 1297, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(808, 'ethan@aimisresults.com', 1297, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(807, 'ethan@aimisresults.com', 1297, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(816, 'ethan@aimisresults.com', 1297, 10, 'notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(817, 'ethan@aimisresults.com', 1297, 11, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(898, 'ethan@aimisresults.com', 912, 1, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(899, 'ethan@aimisresults.com', 912, 2, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2336, 'jason.quinn@ega.com', 1146, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1752, 'cdriscoll@mindfireinc.com', 1405, 10, 'Title');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2814, 'anne@wedrivesales.ca', 2848, 13, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2813, 'anne@wedrivesales.ca', 2848, 12, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2191, 'brad@thewatermarkgroup.com', 2173, 10, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2190, 'brad@thewatermarkgroup.com', 2173, 9, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2188, 'brad@thewatermarkgroup.com', 2173, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(970, 'ethan@aimisresults.com', 1004, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(969, 'ethan@aimisresults.com', 1004, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(968, 'ethan@aimisresults.com', 1004, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(967, 'ethan@aimisresults.com', 1004, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(966, 'ethan@aimisresults.com', 1004, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(965, 'ethan@aimisresults.com', 1004, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(964, 'ethan@aimisresults.com', 1004, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(971, 'ethan@aimisresults.com', 1004, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(972, 'ethan@aimisresults.com', 1004, 9, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(973, 'ethan@aimisresults.com', 1004, 10, 'notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2189, 'brad@thewatermarkgroup.com', 2173, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1109, 'Ethan@aimisresults.com', 912, 11, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1108, 'Ethan@aimisresults.com', 912, 10, 'Unsubscribed');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1106, 'Ethan@aimisresults.com', 912, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1107, 'Ethan@aimisresults.com', 912, 9, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1105, 'Ethan@aimisresults.com', 912, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1103, 'Ethan@aimisresults.com', 912, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2187, 'brad@thewatermarkgroup.com', 2173, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1376, 'cdriscoll@mindfireinc.com', 228, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1375, 'cdriscoll@mindfireinc.com', 228, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1374, 'cdriscoll@mindfireinc.com', 228, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1373, 'cdriscoll@mindfireinc.com', 228, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1372, 'cdriscoll@mindfireinc.com', 228, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1371, 'cdriscoll@mindfireinc.com', 228, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1370, 'cdriscoll@mindfireinc.com', 228, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1457, 'bgreen@oneclearchoice.com', 775, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1342, 'jmq303@gmail.com', 882, 6, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1746, 'cdriscoll@mindfireinc.com', 1405, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1341, 'jmq303@gmail.com', 882, 5, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1340, 'jmq303@gmail.com', 882, 4, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1339, 'jmq303@gmail.com', 882, 3, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6449, 'shoodjer@turfwerks.com', 882, 15, 'GMFirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4505, 'kochlincolnsale@gmail.com', 3135, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1179, 'Ethan@aimisresults.com', 1297, 9, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1178, 'Ethan@aimisresults.com', 1297, 8, 'Address_status');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1176, 'Ethan@aimisresults.com', 1297, 6, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1177, 'Ethan@aimisresults.com', 1297, 7, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1175, 'Ethan@aimisresults.com', 1297, 5, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1174, 'Ethan@aimisresults.com', 1297, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1104, 'Ethan@aimisresults.com', 912, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1102, 'Ethan@aimisresults.com', 912, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1101, 'Ethan@aimisresults.com', 912, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1100, 'Ethan@aimisresults.com', 912, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1099, 'Ethan@aimisresults.com', 912, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1110, 'Ethan@aimisresults.com', 912, 12, 'Source_list');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1111, 'Ethan@aimisresults.com', 912, 13, 'Campaign');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1112, 'Ethan@aimisresults.com', 912, 14, 'Title');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1744, 'cdriscoll@mindfireinc.com', 1405, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1745, 'cdriscoll@mindfireinc.com', 1405, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1173, 'Ethan@aimisresults.com', 1297, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1172, 'Ethan@aimisresults.com', 1297, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1171, 'Ethan@aimisresults.com', 1297, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1181, 'Ethan@aimisresults.com', 1297, 11, 'Address2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1182, 'kdutta@mindfireinc.com', 1693, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1183, 'kdutta@mindfireinc.com', 1693, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1184, 'kdutta@mindfireinc.com', 1693, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1185, 'kdutta@mindfireinc.com', 1693, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1186, 'kdutta@mindfireinc.com', 1693, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1187, 'kdutta@mindfireinc.com', 1693, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1188, 'kdutta@mindfireinc.com', 1693, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1189, 'kdutta@mindfireinc.com', 1693, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1190, 'kdutta@mindfireinc.com', 1693, 9, 'IsSeed');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1338, 'jmq303@gmail.com', 882, 2, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1337, 'jmq303@gmail.com', 882, 1, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2186, 'brad@thewatermarkgroup.com', 2173, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2185, 'brad@thewatermarkgroup.com', 2173, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2184, 'brad@thewatermarkgroup.com', 2173, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2183, 'brad@thewatermarkgroup.com', 2173, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1455, 'bgreen@oneclearchoice.com', 775, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1456, 'bgreen@oneclearchoice.com', 775, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2812, 'anne@wedrivesales.ca', 2848, 11, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2335, 'jason.quinn@ega.com', 1146, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2334, 'jason.quinn@ega.com', 1146, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2333, 'jason.quinn@ega.com', 1146, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2331, 'jason.quinn@ega.com', 1146, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3029, 'stadiumnissanreporting@gmail.com', 2848, 9, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3030, 'stadiumnissanreporting@gmail.com', 2848, 10, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3031, 'stadiumnissanreporting@gmail.com', 2848, 11, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2182, 'brad@thewatermarkgroup.com', 2173, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1454, 'bgreen@oneclearchoice.com', 775, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1453, 'bgreen@oneclearchoice.com', 775, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1452, 'bgreen@oneclearchoice.com', 775, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1451, 'bgreen@oneclearchoice.com', 775, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1450, 'bgreen@oneclearchoice.com', 775, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1458, 'bgreen@oneclearchoice.com', 775, 9, 'major');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1459, 'bgreen@oneclearchoice.com', 775, 10, 'prevDeclaredMajor');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1750, 'cdriscoll@mindfireinc.com', 1405, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1743, 'cdriscoll@mindfireinc.com', 1405, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2332, 'jason.quinn@ega.com', 1146, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1511, 'cdriscoll@mindfireinc.com', 1296, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1512, 'cdriscoll@mindfireinc.com', 1296, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1513, 'cdriscoll@mindfireinc.com', 1296, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1514, 'cdriscoll@mindfireinc.com', 1296, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1515, 'cdriscoll@mindfireinc.com', 1296, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1516, 'cdriscoll@mindfireinc.com', 1296, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1517, 'cdriscoll@mindfireinc.com', 1296, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1518, 'cdriscoll@mindfireinc.com', 1296, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1519, 'cdriscoll@mindfireinc.com', 1296, 9, 'Password');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3051, 'Stadiumnissanreporting@gmail.com', 2848, 6, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3036, 'stadiumnissanreporting@gmail.com', 2848, 16, 'CustomerNumber');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3035, 'stadiumnissanreporting@gmail.com', 2848, 15, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1626, 'Ethan@aimisresults.com', 1004, 8, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1625, 'Ethan@aimisresults.com', 1004, 7, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1624, 'Ethan@aimisresults.com', 1004, 6, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1623, 'Ethan@aimisresults.com', 1004, 5, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1621, 'Ethan@aimisresults.com', 1004, 3, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1622, 'Ethan@aimisresults.com', 1004, 4, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1620, 'Ethan@aimisresults.com', 1004, 2, 'notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1619, 'Ethan@aimisresults.com', 1004, 1, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1926, 'ddaniels@artizenstudios.com', 1143, 1, 'PhotoURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2313, 'cdriscoll@mindfireinc.com', 194, 8, 'Anniversary');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3034, 'stadiumnissanreporting@gmail.com', 2848, 14, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3027, 'stadiumnissanreporting@gmail.com', 2848, 7, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3028, 'stadiumnissanreporting@gmail.com', 2848, 8, 'Appointment_Time');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1753, 'cdriscoll@mindfireinc.com', 1405, 11, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4634, 'kdutta@mindfireinc.com', 2848, 8, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5205, 'jason.quinn@ega.com', 882, 8, 'BusinessType');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5204, 'jason.quinn@ega.com', 882, 7, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5203, 'jason.quinn@ega.com', 882, 6, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5202, 'jason.quinn@ega.com', 882, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5201, 'jason.quinn@ega.com', 882, 4, 'Bids');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2203, 'brad@thewatermarkgroup.com', 2173, 22, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4504, 'kochlincolnsale@gmail.com', 3135, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1833, 'alim@mindfireinc.com', 1563, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1834, 'alim@mindfireinc.com', 1563, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1835, 'alim@mindfireinc.com', 1563, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1836, 'alim@mindfireinc.com', 1563, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1837, 'alim@mindfireinc.com', 1563, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1838, 'alim@mindfireinc.com', 1563, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1839, 'alim@mindfireinc.com', 1563, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1840, 'alim@mindfireinc.com', 1563, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1841, 'alim@mindfireinc.com', 1563, 9, 'EmployeeStatus');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6448, 'shoodjer@turfwerks.com', 882, 14, 'OEmail');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4503, 'kochlincolnsale@gmail.com', 3135, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4502, 'kochlincolnsale@gmail.com', 3135, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2312, 'cdriscoll@mindfireinc.com', 194, 7, 'StudioSignUpDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2311, 'cdriscoll@mindfireinc.com', 194, 6, 'LWCSignUpDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2310, 'cdriscoll@mindfireinc.com', 194, 5, 'Platform');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2309, 'cdriscoll@mindfireinc.com', 194, 4, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3033, 'stadiumnissanreporting@gmail.com', 2848, 13, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3025, 'stadiumnissanreporting@gmail.com', 2848, 5, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2197, 'brad@thewatermarkgroup.com', 2173, 16, 'Website');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2196, 'brad@thewatermarkgroup.com', 2173, 15, 'Title');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1927, 'ddaniels@artizenstudios.com', 1143, 2, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1928, 'ddaniels@artizenstudios.com', 1143, 3, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1929, 'ddaniels@artizenstudios.com', 1143, 4, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1930, 'ddaniels@artizenstudios.com', 1143, 5, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1931, 'ddaniels@artizenstudios.com', 1143, 6, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1932, 'ddaniels@artizenstudios.com', 1143, 7, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1933, 'ddaniels@artizenstudios.com', 1143, 8, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(1934, 'ddaniels@artizenstudios.com', 1143, 9, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2202, 'brad@thewatermarkgroup.com', 2173, 21, 'TwitterAccount');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2201, 'brad@thewatermarkgroup.com', 2173, 20, 'LinkedInAccount');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2200, 'brad@thewatermarkgroup.com', 2173, 19, 'IsSeed');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2199, 'brad@thewatermarkgroup.com', 2173, 18, 'Gender');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2198, 'brad@thewatermarkgroup.com', 2173, 17, 'Extension');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3032, 'stadiumnissanreporting@gmail.com', 2848, 12, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6452, 'anne@wedrivesales.ca', 3411, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6451, 'shoodjer@turfwerks.com', 882, 17, 'GMPhone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6814, 'myorleansnissansale@gmail.com', 4583, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2147, 'nbcrockett@keiger.com', 1940, 10, 'PreviousCounselor');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2146, 'nbcrockett@keiger.com', 1940, 9, 'TransferStudent');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2145, 'nbcrockett@keiger.com', 1940, 8, 'DataOrigin');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2144, 'nbcrockett@keiger.com', 1940, 7, 'Country');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2143, 'nbcrockett@keiger.com', 1940, 6, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2142, 'nbcrockett@keiger.com', 1940, 5, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2141, 'nbcrockett@keiger.com', 1940, 4, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2140, 'nbcrockett@keiger.com', 1940, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2139, 'nbcrockett@keiger.com', 1940, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2138, 'nbcrockett@keiger.com', 1940, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2308, 'cdriscoll@mindfireinc.com', 194, 3, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2307, 'cdriscoll@mindfireinc.com', 194, 2, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2306, 'cdriscoll@mindfireinc.com', 194, 1, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2195, 'brad@thewatermarkgroup.com', 2173, 14, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2194, 'brad@thewatermarkgroup.com', 2173, 13, 'Fax');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2193, 'brad@thewatermarkgroup.com', 2173, 12, 'BirthDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2192, 'brad@thewatermarkgroup.com', 2173, 11, 'Address2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6434, 'kdutta@mindfireinc.com', 228, 10, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6813, 'myorleansnissansale@gmail.com', 4583, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6407, 'knightvwsale@gmail.com', 3291, 16, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6406, 'knightvwsale@gmail.com', 3291, 15, 'Make');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5305, 'brassoreports@gmail.com', 3404, 16, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6433, 'kdutta@mindfireinc.com', 228, 9, 'Gender');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6432, 'kdutta@mindfireinc.com', 228, 8, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6431, 'kdutta@mindfireinc.com', 228, 7, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6430, 'kdutta@mindfireinc.com', 228, 6, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6429, 'kdutta@mindfireinc.com', 228, 5, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6428, 'kdutta@mindfireinc.com', 228, 4, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6427, 'kdutta@mindfireinc.com', 228, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6812, 'myorleansnissansale@gmail.com', 4583, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6447, 'shoodjer@turfwerks.com', 882, 13, 'SalesRep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6446, 'shoodjer@turfwerks.com', 882, 12, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6445, 'shoodjer@turfwerks.com', 882, 11, 'Classification');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2442, 'jaci@alinkprinting.com', 1914, 15, 'SalesRep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2440, 'jaci@alinkprinting.com', 1914, 13, 'Title');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2441, 'jaci@alinkprinting.com', 1914, 14, 'Salescode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2436, 'jaci@alinkprinting.com', 1914, 9, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2439, 'jaci@alinkprinting.com', 1914, 12, 'Prefix');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2438, 'jaci@alinkprinting.com', 1914, 11, 'Fax');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2437, 'jaci@alinkprinting.com', 1914, 10, 'Businesstype');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2435, 'jaci@alinkprinting.com', 1914, 8, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2434, 'jaci@alinkprinting.com', 1914, 7, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2433, 'jaci@alinkprinting.com', 1914, 6, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2432, 'jaci@alinkprinting.com', 1914, 5, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2431, 'jaci@alinkprinting.com', 1914, 4, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2430, 'jaci@alinkprinting.com', 1914, 3, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2429, 'jaci@alinkprinting.com', 1914, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2428, 'jaci@alinkprinting.com', 1914, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2314, 'cdriscoll@mindfireinc.com', 194, 9, 'Gender');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2330, 'jason.quinn@ega.com', 1146, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3026, 'stadiumnissanreporting@gmail.com', 2848, 6, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3024, 'stadiumnissanreporting@gmail.com', 2848, 4, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3023, 'stadiumnissanreporting@gmail.com', 2848, 3, 'vehicle_financing');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2811, 'anne@wedrivesales.ca', 2848, 10, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2810, 'anne@wedrivesales.ca', 2848, 9, 'vehicle_financing');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2809, 'anne@wedrivesales.ca', 2848, 8, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2808, 'anne@wedrivesales.ca', 2848, 7, 'Make');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2807, 'anne@wedrivesales.ca', 2848, 6, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2806, 'anne@wedrivesales.ca', 2848, 5, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2805, 'anne@wedrivesales.ca', 2848, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2804, 'anne@wedrivesales.ca', 2848, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2803, 'anne@wedrivesales.ca', 2848, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2802, 'anne@wedrivesales.ca', 2848, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4632, 'kdutta@mindfireinc.com', 2848, 6, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4633, 'kdutta@mindfireinc.com', 2848, 7, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2815, 'anne@wedrivesales.ca', 2848, 14, 'Appointment_Time');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2816, 'anne@wedrivesales.ca', 2848, 15, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2817, 'anne@wedrivesales.ca', 2848, 16, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(2818, 'anne@wedrivesales.ca', 2848, 17, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3022, 'stadiumnissanreporting@gmail.com', 2848, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3050, 'Stadiumnissanreporting@gmail.com', 2848, 5, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3049, 'Stadiumnissanreporting@gmail.com', 2848, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3048, 'Stadiumnissanreporting@gmail.com', 2848, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3047, 'Stadiumnissanreporting@gmail.com', 2848, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3046, 'Stadiumnissanreporting@gmail.com', 2848, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6443, 'shoodjer@turfwerks.com', 882, 9, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4186, 'stadiumsale@gmail.com', 2942, 16, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3423, 'boonsom@mindfireinc.com', 228, 5, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3422, 'boonsom@mindfireinc.com', 228, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3421, 'boonsom@mindfireinc.com', 228, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3420, 'boonsom@mindfireinc.com', 228, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3419, 'boonsom@mindfireinc.com', 228, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3409, 'anne@wedrivesales.ca', 2918, 13, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3983, 'brassoreports@gmail.com', 2918, 16, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3982, 'brassoreports@gmail.com', 2918, 15, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3981, 'brassoreports@gmail.com', 2918, 14, 'Make');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3976, 'brassoreports@gmail.com', 2918, 9, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3977, 'brassoreports@gmail.com', 2918, 10, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3978, 'brassoreports@gmail.com', 2918, 11, 'PIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3979, 'brassoreports@gmail.com', 2918, 12, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3975, 'brassoreports@gmail.com', 2918, 8, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3974, 'brassoreports@gmail.com', 2918, 7, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3407, 'anne@wedrivesales.ca', 2918, 11, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3406, 'anne@wedrivesales.ca', 2918, 10, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3405, 'anne@wedrivesales.ca', 2918, 9, 'Appointment_Time');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3404, 'anne@wedrivesales.ca', 2918, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3403, 'anne@wedrivesales.ca', 2918, 7, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3402, 'anne@wedrivesales.ca', 2918, 6, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3401, 'anne@wedrivesales.ca', 2918, 5, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3973, 'brassoreports@gmail.com', 2918, 6, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3270, 'brassoreports1@gmail.com', 2918, 9, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3269, 'brassoreports1@gmail.com', 2918, 8, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3268, 'brassoreports1@gmail.com', 2918, 7, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3267, 'brassoreports1@gmail.com', 2918, 6, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3266, 'brassoreports1@gmail.com', 2918, 5, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3265, 'brassoreports1@gmail.com', 2918, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3264, 'brassoreports1@gmail.com', 2918, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3263, 'brassoreports1@gmail.com', 2918, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3262, 'brassoreports1@gmail.com', 2918, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3271, 'brassoreports1@gmail.com', 2918, 10, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3272, 'brassoreports1@gmail.com', 2918, 11, 'Appointment_Time');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3273, 'brassoreports1@gmail.com', 2918, 12, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3274, 'brassoreports1@gmail.com', 2918, 13, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3275, 'brassoreports1@gmail.com', 2918, 14, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3276, 'brassoreports1@gmail.com', 2918, 15, 'PIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3971, 'brassoreports@gmail.com', 2918, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3972, 'brassoreports@gmail.com', 2918, 5, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3969, 'brassoreports@gmail.com', 2918, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3400, 'anne@wedrivesales.ca', 2918, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3335, 'Brassoreports@gmail.com', 2918, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3336, 'Brassoreports@gmail.com', 2918, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3337, 'Brassoreports@gmail.com', 2918, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3338, 'Brassoreports@gmail.com', 2918, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3339, 'Brassoreports@gmail.com', 2918, 5, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3340, 'Brassoreports@gmail.com', 2918, 6, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3341, 'Brassoreports@gmail.com', 2918, 7, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3342, 'Brassoreports@gmail.com', 2918, 8, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3343, 'Brassoreports@gmail.com', 2918, 9, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3344, 'Brassoreports@gmail.com', 2918, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3345, 'Brassoreports@gmail.com', 2918, 11, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3346, 'Brassoreports@gmail.com', 2918, 12, 'PIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3347, 'Brassoreports@gmail.com', 2918, 13, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3348, 'Brassoreports@gmail.com', 2918, 14, 'Make');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3349, 'Brassoreports@gmail.com', 2918, 15, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3399, 'anne@wedrivesales.ca', 2918, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3398, 'anne@wedrivesales.ca', 2918, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3397, 'anne@wedrivesales.ca', 2918, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3970, 'brassoreports@gmail.com', 2918, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3968, 'brassoreports@gmail.com', 2918, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3412, 'anne@wedrivesales.ca', 2918, 16, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3425, 'boonsom@mindfireinc.com', 228, 7, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4631, 'kdutta@mindfireinc.com', 2848, 5, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4630, 'kdutta@mindfireinc.com', 2848, 4, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4629, 'kdutta@mindfireinc.com', 2848, 3, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4185, 'stadiumsale@gmail.com', 2942, 15, 'PIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4184, 'stadiumsale@gmail.com', 2942, 14, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4183, 'stadiumsale@gmail.com', 2942, 13, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4182, 'stadiumsale@gmail.com', 2942, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4181, 'stadiumsale@gmail.com', 2942, 11, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4180, 'stadiumsale@gmail.com', 2942, 10, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4179, 'stadiumsale@gmail.com', 2942, 9, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4178, 'stadiumsale@gmail.com', 2942, 8, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4177, 'stadiumsale@gmail.com', 2942, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4176, 'stadiumsale@gmail.com', 2942, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4175, 'stadiumsale@gmail.com', 2942, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4174, 'stadiumsale@gmail.com', 2942, 4, 'Phone_Cell');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4173, 'stadiumsale@gmail.com', 2942, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4627, 'kdutta@mindfireinc.com', 2848, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3949, 'northstarfordsale@gmail.com', 2968, 15, 'PIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3948, 'northstarfordsale@gmail.com', 2968, 14, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3946, 'northstarfordsale@gmail.com', 2968, 12, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3947, 'northstarfordsale@gmail.com', 2968, 13, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3945, 'northstarfordsale@gmail.com', 2968, 11, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3944, 'northstarfordsale@gmail.com', 2968, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3943, 'northstarfordsale@gmail.com', 2968, 9, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3942, 'northstarfordsale@gmail.com', 2968, 8, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3941, 'northstarfordsale@gmail.com', 2968, 7, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3940, 'northstarfordsale@gmail.com', 2968, 6, 'vehicle_financing');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3938, 'northstarfordsale@gmail.com', 2968, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3939, 'northstarfordsale@gmail.com', 2968, 5, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3937, 'northstarfordsale@gmail.com', 2968, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3936, 'northstarfordsale@gmail.com', 2968, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3935, 'northstarfordsale@gmail.com', 2968, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(3950, 'northstarfordsale@gmail.com', 2968, 16, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4172, 'stadiumsale@gmail.com', 2942, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4171, 'stadiumsale@gmail.com', 2942, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4016, 'tchown@automotive8.ca', 2942, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4017, 'tchown@automotive8.ca', 2942, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4018, 'tchown@automotive8.ca', 2942, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4019, 'tchown@automotive8.ca', 2942, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4020, 'tchown@automotive8.ca', 2942, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4021, 'tchown@automotive8.ca', 2942, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4022, 'tchown@automotive8.ca', 2942, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4023, 'tchown@automotive8.ca', 2942, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4024, 'tchown@automotive8.ca', 2942, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4025, 'tchown@automotive8.ca', 2942, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4026, 'tchown@automotive8.ca', 2942, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4027, 'tchown@automotive8.ca', 2942, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4628, 'kdutta@mindfireinc.com', 2848, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4150, 'anne@wedrivesales.ca', 2942, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4151, 'anne@wedrivesales.ca', 2942, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4152, 'anne@wedrivesales.ca', 2942, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4153, 'anne@wedrivesales.ca', 2942, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4154, 'anne@wedrivesales.ca', 2942, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4155, 'anne@wedrivesales.ca', 2942, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4156, 'anne@wedrivesales.ca', 2942, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4157, 'anne@wedrivesales.ca', 2942, 9, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6444, 'shoodjer@turfwerks.com', 882, 10, 'Address2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6442, 'shoodjer@turfwerks.com', 882, 8, 'BusinessType');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6441, 'shoodjer@turfwerks.com', 882, 7, 'GMEmail');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6440, 'shoodjer@turfwerks.com', 882, 6, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4190, 'stadiumsale@gmail.com', 2942, 20, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4191, 'stadiumsale@gmail.com', 2942, 21, 'Address2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4286, 'anne@wedrivesales.ca', 3029, 13, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4285, 'anne@wedrivesales.ca', 3029, 12, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4284, 'anne@wedrivesales.ca', 3029, 11, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4281, 'anne@wedrivesales.ca', 3029, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4282, 'anne@wedrivesales.ca', 3029, 9, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4283, 'anne@wedrivesales.ca', 3029, 10, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4280, 'anne@wedrivesales.ca', 3029, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4279, 'anne@wedrivesales.ca', 3029, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4278, 'anne@wedrivesales.ca', 3029, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4277, 'anne@wedrivesales.ca', 3029, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4276, 'anne@wedrivesales.ca', 3029, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4275, 'anne@wedrivesales.ca', 3029, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4506, 'kochlincolnsale@gmail.com', 3135, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4484, 'shoodjer@Davisequip.com', 920, 7, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4466, 'integrityhyundaisale@gmail.com', 3029, 14, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4467, 'integrityhyundaisale@gmail.com', 3029, 15, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4468, 'integrityhyundaisale@gmail.com', 3029, 16, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4462, 'integrityhyundaisale@gmail.com', 3029, 10, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4463, 'integrityhyundaisale@gmail.com', 3029, 11, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4464, 'integrityhyundaisale@gmail.com', 3029, 12, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4465, 'integrityhyundaisale@gmail.com', 3029, 13, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4457, 'integrityhyundaisale@gmail.com', 3029, 5, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4458, 'integrityhyundaisale@gmail.com', 3029, 6, 'PIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4459, 'integrityhyundaisale@gmail.com', 3029, 7, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4460, 'integrityhyundaisale@gmail.com', 3029, 8, 'vehicle_financing');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4461, 'integrityhyundaisale@gmail.com', 3029, 9, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4274, 'anne@wedrivesales.ca', 3029, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4287, 'anne@wedrivesales.ca', 3029, 14, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4288, 'anne@wedrivesales.ca', 3029, 15, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4289, 'anne@wedrivesales.ca', 3029, 16, 'PIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4455, 'integrityhyundaisale@gmail.com', 3029, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4456, 'integrityhyundaisale@gmail.com', 3029, 4, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4453, 'integrityhyundaisale@gmail.com', 3029, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4454, 'integrityhyundaisale@gmail.com', 3029, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4398, 'kdutta@mindfireinc.com', 3029, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4397, 'kdutta@mindfireinc.com', 3029, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4395, 'kdutta@mindfireinc.com', 3029, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4396, 'kdutta@mindfireinc.com', 3029, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4394, 'kdutta@mindfireinc.com', 3029, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4393, 'kdutta@mindfireinc.com', 3029, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4392, 'kdutta@mindfireinc.com', 3029, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4391, 'kdutta@mindfireinc.com', 3029, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4390, 'kdutta@mindfireinc.com', 3029, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4389, 'kdutta@mindfireinc.com', 3029, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4388, 'kdutta@mindfireinc.com', 3029, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4387, 'kdutta@mindfireinc.com', 3029, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4386, 'kdutta@mindfireinc.com', 3029, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4483, 'shoodjer@Davisequip.com', 920, 6, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4482, 'shoodjer@Davisequip.com', 920, 5, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4481, 'shoodjer@Davisequip.com', 920, 4, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4480, 'shoodjer@Davisequip.com', 920, 3, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4479, 'shoodjer@Davisequip.com', 920, 2, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4478, 'shoodjer@Davisequip.com', 920, 1, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4507, 'kochlincolnsale@gmail.com', 3135, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4508, 'kochlincolnsale@gmail.com', 3135, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4509, 'kochlincolnsale@gmail.com', 3135, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4510, 'kochlincolnsale@gmail.com', 3135, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4511, 'kochlincolnsale@gmail.com', 3135, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4512, 'kochlincolnsale@gmail.com', 3135, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4513, 'kochlincolnsale@gmail.com', 3135, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4514, 'kochlincolnsale@gmail.com', 3135, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4515, 'kochlincolnsale@gmail.com', 3135, 14, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4516, 'kochlincolnsale@gmail.com', 3135, 15, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6811, 'myorleansnissansale@gmail.com', 4583, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6810, 'myorleansnissansale@gmail.com', 4583, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4529, 'anne@wedrivesales.ca', 3135, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4530, 'anne@wedrivesales.ca', 3135, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4531, 'anne@wedrivesales.ca', 3135, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4532, 'anne@wedrivesales.ca', 3135, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4533, 'anne@wedrivesales.ca', 3135, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4534, 'anne@wedrivesales.ca', 3135, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4535, 'anne@wedrivesales.ca', 3135, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4536, 'anne@wedrivesales.ca', 3135, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4537, 'anne@wedrivesales.ca', 3135, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4538, 'anne@wedrivesales.ca', 3135, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4539, 'anne@wedrivesales.ca', 3135, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4540, 'anne@wedrivesales.ca', 3135, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4541, 'anne@wedrivesales.ca', 3135, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4542, 'anne@wedrivesales.ca', 3135, 14, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5200, 'jason.quinn@ega.com', 882, 3, 'Anniversary');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4580, 'jason.quinn@ega.com', 956, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4578, 'anne@wedrivesales.ca', 3193, 9, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4579, 'anne@wedrivesales.ca', 3193, 10, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4577, 'anne@wedrivesales.ca', 3193, 8, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4575, 'anne@wedrivesales.ca', 3193, 6, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4576, 'anne@wedrivesales.ca', 3193, 7, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4574, 'anne@wedrivesales.ca', 3193, 5, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4573, 'anne@wedrivesales.ca', 3193, 4, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4572, 'anne@wedrivesales.ca', 3193, 3, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4571, 'anne@wedrivesales.ca', 3193, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4570, 'anne@wedrivesales.ca', 3193, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4581, 'jason.quinn@ega.com', 956, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4582, 'jason.quinn@ega.com', 956, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4583, 'jason.quinn@ega.com', 956, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4584, 'jason.quinn@ega.com', 956, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4585, 'jason.quinn@ega.com', 956, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4586, 'jason.quinn@ega.com', 956, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4587, 'jason.quinn@ega.com', 956, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4588, 'jason.quinn@ega.com', 956, 9, 'Country');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4589, 'jason.quinn@ega.com', 956, 10, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5212, 'jason.quinn@ega.com', 920, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5211, 'jason.quinn@ega.com', 920, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5210, 'jason.quinn@ega.com', 920, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5209, 'jason.quinn@ega.com', 920, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5208, 'jason.quinn@ega.com', 920, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5207, 'jason.quinn@ega.com', 920, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5206, 'jason.quinn@ega.com', 920, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5199, 'jason.quinn@ega.com', 882, 2, 'Address2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5198, 'jason.quinn@ega.com', 882, 1, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(4638, 'kdutta@mindfireinc.com', 2848, 12, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6405, 'knightvwsale@gmail.com', 3291, 14, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6402, 'knightvwsale@gmail.com', 3291, 11, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6403, 'knightvwsale@gmail.com', 3291, 12, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6400, 'knightvwsale@gmail.com', 3291, 9, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6401, 'knightvwsale@gmail.com', 3291, 10, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6399, 'knightvwsale@gmail.com', 3291, 8, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6398, 'knightvwsale@gmail.com', 3291, 7, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6397, 'knightvwsale@gmail.com', 3291, 6, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6395, 'knightvwsale@gmail.com', 3291, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6396, 'knightvwsale@gmail.com', 3291, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6394, 'knightvwsale@gmail.com', 3291, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6392, 'knightvwsale@gmail.com', 3291, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6393, 'knightvwsale@gmail.com', 3291, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5766, 'anne@wedrivesales.ca', 3404, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5764, 'anne@wedrivesales.ca', 3404, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5763, 'anne@wedrivesales.ca', 3404, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5304, 'brassoreports@gmail.com', 3404, 15, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5303, 'brassoreports@gmail.com', 3404, 14, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5762, 'anne@wedrivesales.ca', 3404, 9, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5761, 'anne@wedrivesales.ca', 3404, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5231, 'Brassoreports@gmail.com', 3404, 15, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5230, 'Brassoreports@gmail.com', 3404, 14, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5229, 'Brassoreports@gmail.com', 3404, 13, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5228, 'Brassoreports@gmail.com', 3404, 12, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5222, 'Brassoreports@gmail.com', 3404, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5227, 'Brassoreports@gmail.com', 3404, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5226, 'Brassoreports@gmail.com', 3404, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5225, 'Brassoreports@gmail.com', 3404, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5224, 'Brassoreports@gmail.com', 3404, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5223, 'Brassoreports@gmail.com', 3404, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5221, 'Brassoreports@gmail.com', 3404, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5220, 'Brassoreports@gmail.com', 3404, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5219, 'Brassoreports@gmail.com', 3404, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5218, 'Brassoreports@gmail.com', 3404, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5022, 'StadiumSale@gmail.com', 3405, 4, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5021, 'StadiumSale@gmail.com', 3405, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5019, 'StadiumSale@gmail.com', 3405, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5020, 'StadiumSale@gmail.com', 3405, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5783, 'anne@wedrivesales.ca', 3405, 14, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5782, 'anne@wedrivesales.ca', 3405, 13, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5781, 'anne@wedrivesales.ca', 3405, 12, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5780, 'anne@wedrivesales.ca', 3405, 11, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5779, 'anne@wedrivesales.ca', 3405, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5778, 'anne@wedrivesales.ca', 3405, 9, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5777, 'anne@wedrivesales.ca', 3405, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5776, 'anne@wedrivesales.ca', 3405, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5775, 'anne@wedrivesales.ca', 3405, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5774, 'anne@wedrivesales.ca', 3405, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5773, 'anne@wedrivesales.ca', 3405, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5772, 'anne@wedrivesales.ca', 3405, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5771, 'anne@wedrivesales.ca', 3405, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5770, 'anne@wedrivesales.ca', 3405, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5217, 'Brassoreports@gmail.com', 3404, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5485, 'stadiumsale@gmail.com', 3405, 13, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5484, 'stadiumsale@gmail.com', 3405, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5483, 'stadiumsale@gmail.com', 3405, 11, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5482, 'stadiumsale@gmail.com', 3405, 10, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5481, 'stadiumsale@gmail.com', 3405, 9, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5480, 'stadiumsale@gmail.com', 3405, 8, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5479, 'stadiumsale@gmail.com', 3405, 7, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5478, 'stadiumsale@gmail.com', 3405, 6, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5477, 'stadiumsale@gmail.com', 3405, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5302, 'brassoreports@gmail.com', 3404, 13, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5301, 'brassoreports@gmail.com', 3404, 12, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5300, 'brassoreports@gmail.com', 3404, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5299, 'brassoreports@gmail.com', 3404, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5298, 'brassoreports@gmail.com', 3404, 9, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5297, 'brassoreports@gmail.com', 3404, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5296, 'brassoreports@gmail.com', 3404, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5295, 'brassoreports@gmail.com', 3404, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5294, 'brassoreports@gmail.com', 3404, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5293, 'brassoreports@gmail.com', 3404, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5475, 'stadiumsale@gmail.com', 3405, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5458, 'collegefordsale@gmail.com', 3341, 7, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5459, 'collegefordsale@gmail.com', 3341, 8, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5474, 'stadiumsale@gmail.com', 3405, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5457, 'collegefordsale@gmail.com', 3341, 6, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5456, 'collegefordsale@gmail.com', 3341, 5, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5455, 'collegefordsale@gmail.com', 3341, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5453, 'collegefordsale@gmail.com', 3341, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5454, 'collegefordsale@gmail.com', 3341, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5452, 'collegefordsale@gmail.com', 3341, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5765, 'anne@wedrivesales.ca', 3404, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5760, 'anne@wedrivesales.ca', 3404, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5759, 'anne@wedrivesales.ca', 3404, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5758, 'anne@wedrivesales.ca', 3404, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5757, 'anne@wedrivesales.ca', 3404, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5756, 'anne@wedrivesales.ca', 3404, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5755, 'anne@wedrivesales.ca', 3404, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5754, 'anne@wedrivesales.ca', 3404, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5213, 'jason.quinn@ega.com', 920, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5214, 'jason.quinn@ega.com', 920, 9, 'Country');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5215, 'jason.quinn@ega.com', 920, 10, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5216, 'jason.quinn@ega.com', 920, 11, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5232, 'Brassoreports@gmail.com', 3404, 16, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5291, 'brassoreports@gmail.com', 3404, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5290, 'brassoreports@gmail.com', 3404, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5476, 'stadiumsale@gmail.com', 3405, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5473, 'stadiumsale@gmail.com', 3405, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5306, 'brassoreports@gmail.com', 3404, 17, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5307, 'brassoreports@gmail.com', 3404, 18, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5403, 'windsorfordsale@gmail.com', 3354, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5402, 'windsorfordsale@gmail.com', 3354, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5401, 'windsorfordsale@gmail.com', 3354, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5400, 'windsorfordsale@gmail.com', 3354, 9, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5399, 'windsorfordsale@gmail.com', 3354, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5397, 'windsorfordsale@gmail.com', 3354, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5398, 'windsorfordsale@gmail.com', 3354, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5396, 'windsorfordsale@gmail.com', 3354, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5395, 'windsorfordsale@gmail.com', 3354, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5394, 'windsorfordsale@gmail.com', 3354, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5392, 'windsorfordsale@gmail.com', 3354, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5393, 'windsorfordsale@gmail.com', 3354, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5414, 'marlfordsale@gmail.com', 3350, 9, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5413, 'marlfordsale@gmail.com', 3350, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5412, 'marlfordsale@gmail.com', 3350, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5411, 'marlfordsale@gmail.com', 3350, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5410, 'marlfordsale@gmail.com', 3350, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5409, 'marlfordsale@gmail.com', 3350, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5408, 'marlfordsale@gmail.com', 3350, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5407, 'marlfordsale@gmail.com', 3350, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5406, 'marlfordsale@gmail.com', 3350, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6089, 'anne@wedrivesales.ca', 3354, 11, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6088, 'anne@wedrivesales.ca', 3354, 10, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6087, 'anne@wedrivesales.ca', 3354, 9, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6086, 'anne@wedrivesales.ca', 3354, 8, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6085, 'anne@wedrivesales.ca', 3354, 7, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6084, 'anne@wedrivesales.ca', 3354, 6, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6083, 'anne@wedrivesales.ca', 3354, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6082, 'anne@wedrivesales.ca', 3354, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6081, 'anne@wedrivesales.ca', 3354, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6080, 'anne@wedrivesales.ca', 3354, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6079, 'anne@wedrivesales.ca', 3354, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5404, 'windsorfordsale@gmail.com', 3354, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5405, 'windsorfordsale@gmail.com', 3354, 14, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5415, 'marlfordsale@gmail.com', 3350, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5416, 'marlfordsale@gmail.com', 3350, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5417, 'marlfordsale@gmail.com', 3350, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5418, 'marlfordsale@gmail.com', 3350, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5419, 'marlfordsale@gmail.com', 3350, 14, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5420, 'marlfordsale@gmail.com', 3350, 15, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5445, 'anne@wedrivesales.ca', 3291, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5444, 'anne@wedrivesales.ca', 3291, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5443, 'anne@wedrivesales.ca', 3291, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5442, 'anne@wedrivesales.ca', 3291, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5441, 'anne@wedrivesales.ca', 3291, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5440, 'anne@wedrivesales.ca', 3291, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5439, 'anne@wedrivesales.ca', 3291, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5438, 'anne@wedrivesales.ca', 3291, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5437, 'anne@wedrivesales.ca', 3291, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5436, 'anne@wedrivesales.ca', 3291, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5435, 'anne@wedrivesales.ca', 3291, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5446, 'anne@wedrivesales.ca', 3291, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5447, 'anne@wedrivesales.ca', 3291, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5448, 'anne@wedrivesales.ca', 3291, 14, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5449, 'anne@wedrivesales.ca', 3291, 15, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5450, 'anne@wedrivesales.ca', 3291, 16, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5451, 'anne@wedrivesales.ca', 3291, 17, 'vehicle_financing');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6057, 'myerskanhysale@gmail.com', 3325, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6056, 'myerskanhysale@gmail.com', 3325, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5875, 'tchown@automotive8.ca', 3429, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5874, 'anne@wedrivesales.ca', 3429, 16, 'PIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5873, 'anne@wedrivesales.ca', 3429, 15, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5872, 'anne@wedrivesales.ca', 3429, 14, 'CompleteDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5871, 'anne@wedrivesales.ca', 3429, 13, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5870, 'anne@wedrivesales.ca', 3429, 12, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6016, 'myersgmsale@gmail.com', 3429, 9, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6017, 'myersgmsale@gmail.com', 3429, 10, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6015, 'myersgmsale@gmail.com', 3429, 8, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6014, 'myersgmsale@gmail.com', 3429, 7, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6013, 'myersgmsale@gmail.com', 3429, 6, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6012, 'myersgmsale@gmail.com', 3429, 5, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6011, 'myersgmsale@gmail.com', 3429, 4, 'Make');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5869, 'anne@wedrivesales.ca', 3429, 11, 'Make');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5868, 'anne@wedrivesales.ca', 3429, 10, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5867, 'anne@wedrivesales.ca', 3429, 9, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5865, 'anne@wedrivesales.ca', 3429, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5866, 'anne@wedrivesales.ca', 3429, 8, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5864, 'anne@wedrivesales.ca', 3429, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5863, 'anne@wedrivesales.ca', 3429, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6008, 'myersgmsale@gmail.com', 3429, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5862, 'anne@wedrivesales.ca', 3429, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5861, 'anne@wedrivesales.ca', 3429, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5767, 'anne@wedrivesales.ca', 3404, 14, 'Make');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5768, 'anne@wedrivesales.ca', 3404, 15, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5769, 'anne@wedrivesales.ca', 3404, 16, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5860, 'anne@wedrivesales.ca', 3429, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6010, 'myersgmsale@gmail.com', 3429, 3, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5859, 'anne@wedrivesales.ca', 3429, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6009, 'myersgmsale@gmail.com', 3429, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5876, 'tchown@automotive8.ca', 3429, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5877, 'tchown@automotive8.ca', 3429, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5878, 'tchown@automotive8.ca', 3429, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5879, 'tchown@automotive8.ca', 3429, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5880, 'tchown@automotive8.ca', 3429, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5881, 'tchown@automotive8.ca', 3429, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5882, 'tchown@automotive8.ca', 3429, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5883, 'tchown@automotive8.ca', 3429, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5884, 'tchown@automotive8.ca', 3429, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5885, 'tchown@automotive8.ca', 3429, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5886, 'tchown@automotive8.ca', 3429, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5887, 'tchown@automotive8.ca', 3429, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6425, 'kdutta@mindfireinc.com', 228, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6426, 'kdutta@mindfireinc.com', 228, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5905, 'shoodjer@DAVISEQUIP.com', 920, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5906, 'shoodjer@DAVISEQUIP.com', 920, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5907, 'shoodjer@DAVISEQUIP.com', 920, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5908, 'shoodjer@DAVISEQUIP.com', 920, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5909, 'shoodjer@DAVISEQUIP.com', 920, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5910, 'shoodjer@DAVISEQUIP.com', 920, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5911, 'shoodjer@DAVISEQUIP.com', 920, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5912, 'shoodjer@DAVISEQUIP.com', 920, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5913, 'shoodjer@DAVISEQUIP.com', 920, 9, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5914, 'shoodjer@DAVISEQUIP.com', 920, 10, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5940, 'mcdonaldnissansale@gmail.com', 4377, 11, 'IdealReplacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5939, 'mcdonaldnissansale@gmail.com', 4377, 10, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5938, 'mcdonaldnissansale@gmail.com', 4377, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5937, 'mcdonaldnissansale@gmail.com', 4377, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5936, 'mcdonaldnissansale@gmail.com', 4377, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5935, 'mcdonaldnissansale@gmail.com', 4377, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5934, 'mcdonaldnissansale@gmail.com', 4377, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5933, 'mcdonaldnissansale@gmail.com', 4377, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5932, 'mcdonaldnissansale@gmail.com', 4377, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5931, 'mcdonaldnissansale@gmail.com', 4377, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5930, 'mcdonaldnissansale@gmail.com', 4377, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5941, 'mcdonaldnissansale@gmail.com', 4377, 12, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5942, 'mcdonaldnissansale@gmail.com', 4377, 13, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5943, 'mcdonaldnissansale@gmail.com', 4377, 14, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5975, 'myersbcsale@gmail.com', 3326, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5974, 'myersbcsale@gmail.com', 3326, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5973, 'myersbcsale@gmail.com', 3326, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5972, 'myersbcsale@gmail.com', 3326, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5971, 'myersbcsale@gmail.com', 3326, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5970, 'myersbcsale@gmail.com', 3326, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5969, 'myersbcsale@gmail.com', 3326, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5968, 'myersbcsale@gmail.com', 3326, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5967, 'myersbcsale@gmail.com', 3326, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5976, 'myersbcsale@gmail.com', 3326, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5977, 'myersbcsale@gmail.com', 3326, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5978, 'myersbcsale@gmail.com', 3326, 12, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5979, 'myersbcsale@gmail.com', 3326, 13, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5980, 'myersbcsale@gmail.com', 3326, 14, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5981, 'myersbcsale@gmail.com', 3326, 15, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5982, 'myersbcsale@gmail.com', 3326, 16, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5983, 'anne@wedrivesales.ca', 3326, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5984, 'anne@wedrivesales.ca', 3326, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5985, 'anne@wedrivesales.ca', 3326, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5986, 'anne@wedrivesales.ca', 3326, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5987, 'anne@wedrivesales.ca', 3326, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5988, 'anne@wedrivesales.ca', 3326, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5989, 'anne@wedrivesales.ca', 3326, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5990, 'anne@wedrivesales.ca', 3326, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5991, 'anne@wedrivesales.ca', 3326, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5992, 'anne@wedrivesales.ca', 3326, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5993, 'anne@wedrivesales.ca', 3326, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5994, 'anne@wedrivesales.ca', 3326, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5995, 'anne@wedrivesales.ca', 3326, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(5996, 'anne@wedrivesales.ca', 3326, 14, 'CompleteDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6055, 'myerskanhysale@gmail.com', 3325, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6054, 'myerskanhysale@gmail.com', 3325, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6053, 'myerskanhysale@gmail.com', 3325, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6052, 'myerskanhysale@gmail.com', 3325, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6051, 'myerskanhysale@gmail.com', 3325, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6050, 'myerskanhysale@gmail.com', 3325, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6049, 'myerskanhysale@gmail.com', 3325, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6048, 'myerskanhysale@gmail.com', 3325, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6047, 'myerskanhysale@gmail.com', 3325, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6046, 'myerskanhysale@gmail.com', 3325, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6033, 'okotokshondasale@gmail.com', 4668, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6034, 'okotokshondasale@gmail.com', 4668, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6035, 'okotokshondasale@gmail.com', 4668, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6036, 'okotokshondasale@gmail.com', 4668, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6037, 'okotokshondasale@gmail.com', 4668, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6038, 'okotokshondasale@gmail.com', 4668, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6039, 'okotokshondasale@gmail.com', 4668, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6040, 'okotokshondasale@gmail.com', 4668, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6041, 'okotokshondasale@gmail.com', 4668, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6042, 'okotokshondasale@gmail.com', 4668, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6043, 'okotokshondasale@gmail.com', 4668, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6044, 'okotokshondasale@gmail.com', 4668, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6045, 'okotokshondasale@gmail.com', 4668, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6058, 'myerskanhysale@gmail.com', 3325, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6059, 'myerskanhysale@gmail.com', 3325, 14, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6060, 'myerskanhysale@gmail.com', 3325, 15, 'Make');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6061, 'myerskanhysale@gmail.com', 3325, 16, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6809, 'myorleansnissansale@gmail.com', 4583, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6808, 'myorleansnissansale@gmail.com', 4583, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6807, 'myorleansnissansale@gmail.com', 4583, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6090, 'myerskemptsale@gmail.com', 4963, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6091, 'myerskemptsale@gmail.com', 4963, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6092, 'myerskemptsale@gmail.com', 4963, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6093, 'myerskemptsale@gmail.com', 4963, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6094, 'myerskemptsale@gmail.com', 4963, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6095, 'myerskemptsale@gmail.com', 4963, 6, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6096, 'myerskemptsale@gmail.com', 4963, 7, 'Make');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6097, 'myerskemptsale@gmail.com', 4963, 8, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6098, 'myerskemptsale@gmail.com', 4963, 9, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6099, 'myerskemptsale@gmail.com', 4963, 10, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6100, 'myerskemptsale@gmail.com', 4963, 11, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6101, 'myerskemptsale@gmail.com', 4963, 12, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6102, 'myerskemptsale@gmail.com', 4963, 13, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6103, 'myerskemptsale@gmail.com', 4963, 14, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6104, 'myerskemptsale@gmail.com', 4963, 15, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6105, 'myerskemptsale@gmail.com', 4963, 16, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6438, 'shoodjer@turfwerks.com', 882, 4, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6439, 'shoodjer@turfwerks.com', 882, 5, 'Lease');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6188, 'ken.cratty@mcardlesolutions.com', 896, 13, 'Company_long');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6186, 'ken.cratty@mcardlesolutions.com', 896, 11, 'SalesRep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6187, 'ken.cratty@mcardlesolutions.com', 896, 12, 'CampaignName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6185, 'ken.cratty@mcardlesolutions.com', 896, 10, 'Unsub');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6184, 'ken.cratty@mcardlesolutions.com', 896, 9, 'Phone_Respnse');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6183, 'ken.cratty@mcardlesolutions.com', 896, 8, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6181, 'ken.cratty@mcardlesolutions.com', 896, 6, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6182, 'ken.cratty@mcardlesolutions.com', 896, 7, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6180, 'ken.cratty@mcardlesolutions.com', 896, 5, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6179, 'ken.cratty@mcardlesolutions.com', 896, 4, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6178, 'ken.cratty@mcardlesolutions.com', 896, 3, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6177, 'ken.cratty@mcardlesolutions.com', 896, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6176, 'ken.cratty@mcardlesolutions.com', 896, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6189, 'ken.cratty@mcardlesolutions.com', 896, 14, 'Title_long');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6190, 'ken.cratty@mcardlesolutions.com', 896, 15, 'unsubquestion');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6369, 'rosetownsale@gmail.com', 4375, 17, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6368, 'rosetownsale@gmail.com', 4375, 16, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6366, 'rosetownsale@gmail.com', 4375, 14, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6367, 'rosetownsale@gmail.com', 4375, 15, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6365, 'rosetownsale@gmail.com', 4375, 13, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6364, 'rosetownsale@gmail.com', 4375, 12, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6363, 'rosetownsale@gmail.com', 4375, 11, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6362, 'rosetownsale@gmail.com', 4375, 10, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6361, 'rosetownsale@gmail.com', 4375, 9, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6360, 'rosetownsale@gmail.com', 4375, 8, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6359, 'rosetownsale@gmail.com', 4375, 7, 'Make');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6357, 'rosetownsale@gmail.com', 4375, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6358, 'rosetownsale@gmail.com', 4375, 6, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6356, 'rosetownsale@gmail.com', 4375, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6437, 'shoodjer@turfwerks.com', 882, 3, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6436, 'shoodjer@turfwerks.com', 882, 2, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6435, 'shoodjer@turfwerks.com', 882, 1, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6287, 'kdutta@mindfireinc.com', 1296, 26, 'MiddleName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6286, 'kdutta@mindfireinc.com', 1296, 25, 'LinkedInAccount');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6285, 'kdutta@mindfireinc.com', 1296, 24, 'IsSeed');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6284, 'kdutta@mindfireinc.com', 1296, 23, 'Gender');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6283, 'kdutta@mindfireinc.com', 1296, 22, 'Fax');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6282, 'kdutta@mindfireinc.com', 1296, 21, 'FacebookAccount');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6281, 'kdutta@mindfireinc.com', 1296, 20, 'Extension');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6280, 'kdutta@mindfireinc.com', 1296, 19, 'DeliveryPointIndicator');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6279, 'kdutta@mindfireinc.com', 1296, 18, 'dateRegistered');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6278, 'kdutta@mindfireinc.com', 1296, 17, 'Country');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6277, 'kdutta@mindfireinc.com', 1296, 16, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6276, 'kdutta@mindfireinc.com', 1296, 15, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6275, 'kdutta@mindfireinc.com', 1296, 14, 'BirthDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6274, 'kdutta@mindfireinc.com', 1296, 13, 'Anniversary');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6273, 'kdutta@mindfireinc.com', 1296, 12, 'adminUsername');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6272, 'kdutta@mindfireinc.com', 1296, 11, 'adminPassword');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6271, 'kdutta@mindfireinc.com', 1296, 10, 'Address2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6270, 'kdutta@mindfireinc.com', 1296, 9, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6269, 'kdutta@mindfireinc.com', 1296, 8, 'activeStatus');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6268, 'kdutta@mindfireinc.com', 1296, 7, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6267, 'kdutta@mindfireinc.com', 1296, 6, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6266, 'kdutta@mindfireinc.com', 1296, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6265, 'kdutta@mindfireinc.com', 1296, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6264, 'kdutta@mindfireinc.com', 1296, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6263, 'kdutta@mindfireinc.com', 1296, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6262, 'kdutta@mindfireinc.com', 1296, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6288, 'kdutta@mindfireinc.com', 1296, 27, 'Password');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6289, 'kdutta@mindfireinc.com', 1296, 28, 'PhotoURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6290, 'kdutta@mindfireinc.com', 1296, 29, 'platformsUsed');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6291, 'kdutta@mindfireinc.com', 1296, 30, 'Prefix');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6292, 'kdutta@mindfireinc.com', 1296, 31, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6293, 'kdutta@mindfireinc.com', 1296, 32, 'Suffix');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6294, 'kdutta@mindfireinc.com', 1296, 33, 'Title');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6295, 'kdutta@mindfireinc.com', 1296, 34, 'TwitterAccount');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6296, 'kdutta@mindfireinc.com', 1296, 35, 'Website');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6297, 'kdutta@mindfireinc.com', 1296, 36, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6298, 'kdutta@mindfireinc.com', 1296, 37, 'ZipPlus4');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6299, 'kdutta@mindfireinc.com', 0, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6300, 'kdutta@mindfireinc.com', 0, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6301, 'kdutta@mindfireinc.com', 0, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6302, 'kdutta@mindfireinc.com', 0, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6303, 'kdutta@mindfireinc.com', 0, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6304, 'kdutta@mindfireinc.com', 0, 6, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6305, 'kdutta@mindfireinc.com', 0, 7, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6306, 'kdutta@mindfireinc.com', 0, 8, 'activeStatus');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6307, 'kdutta@mindfireinc.com', 0, 9, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6308, 'kdutta@mindfireinc.com', 0, 10, 'Address2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6309, 'kdutta@mindfireinc.com', 0, 11, 'adminPassword');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6310, 'kdutta@mindfireinc.com', 0, 12, 'adminUsername');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6311, 'kdutta@mindfireinc.com', 0, 13, 'Anniversary');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6312, 'kdutta@mindfireinc.com', 0, 14, 'BirthDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6313, 'kdutta@mindfireinc.com', 0, 15, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6314, 'kdutta@mindfireinc.com', 0, 16, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6315, 'kdutta@mindfireinc.com', 0, 17, 'Country');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6316, 'kdutta@mindfireinc.com', 0, 18, 'dateRegistered');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6317, 'kdutta@mindfireinc.com', 0, 19, 'DeliveryPointIndicator');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6318, 'kdutta@mindfireinc.com', 0, 20, 'Extension');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6319, 'kdutta@mindfireinc.com', 0, 21, 'FacebookAccount');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6320, 'kdutta@mindfireinc.com', 0, 22, 'Fax');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6321, 'kdutta@mindfireinc.com', 0, 23, 'Gender');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6322, 'kdutta@mindfireinc.com', 0, 24, 'IsSeed');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6323, 'kdutta@mindfireinc.com', 0, 25, 'LinkedInAccount');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6324, 'kdutta@mindfireinc.com', 0, 26, 'MiddleName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6325, 'kdutta@mindfireinc.com', 0, 27, 'Password');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6326, 'kdutta@mindfireinc.com', 0, 28, 'PhotoURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6327, 'kdutta@mindfireinc.com', 0, 29, 'platformsUsed');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6328, 'kdutta@mindfireinc.com', 0, 30, 'Prefix');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6329, 'kdutta@mindfireinc.com', 0, 31, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6330, 'kdutta@mindfireinc.com', 0, 32, 'Suffix');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6331, 'kdutta@mindfireinc.com', 0, 33, 'Title');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6332, 'kdutta@mindfireinc.com', 0, 34, 'TwitterAccount');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6333, 'kdutta@mindfireinc.com', 0, 35, 'Website');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6334, 'kdutta@mindfireinc.com', 0, 36, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6335, 'kdutta@mindfireinc.com', 0, 37, 'ZipPlus4');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6355, 'rosetownsale@gmail.com', 4375, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6354, 'rosetownsale@gmail.com', 4375, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6353, 'rosetownsale@gmail.com', 4375, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6370, 'rosetownsale@gmail.com', 4375, 18, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6404, 'knightvwsale@gmail.com', 3291, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6453, 'anne@wedrivesales.ca', 3411, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6454, 'anne@wedrivesales.ca', 3411, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6455, 'anne@wedrivesales.ca', 3411, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6456, 'anne@wedrivesales.ca', 3411, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6457, 'anne@wedrivesales.ca', 3411, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6458, 'anne@wedrivesales.ca', 3411, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6459, 'anne@wedrivesales.ca', 3411, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6460, 'anne@wedrivesales.ca', 3411, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6461, 'anne@wedrivesales.ca', 3411, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6462, 'anne@wedrivesales.ca', 3411, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6463, 'anne@wedrivesales.ca', 3411, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6464, 'anne@wedrivesales.ca', 3411, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6465, 'anne@wedrivesales.ca', 3411, 14, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6466, 'anne@wedrivesales.ca', 3411, 15, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6806, 'myorleansnissansale@gmail.com', 4583, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6805, 'andersonkiasale@gmail.com', 16380, 16, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6804, 'andersonkiasale@gmail.com', 16380, 15, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6803, 'andersonkiasale@gmail.com', 16380, 14, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6802, 'andersonkiasale@gmail.com', 16380, 13, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6801, 'andersonkiasale@gmail.com', 16380, 12, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6799, 'andersonkiasale@gmail.com', 16380, 10, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6800, 'andersonkiasale@gmail.com', 16380, 11, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6798, 'andersonkiasale@gmail.com', 16380, 9, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6737, 'shoodjer@davisequip.com', 920, 1, 'AccountID');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6738, 'shoodjer@davisequip.com', 920, 2, 'Company');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6739, 'shoodjer@davisequip.com', 920, 3, 'Address1');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6740, 'shoodjer@davisequip.com', 920, 4, 'Address2');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6741, 'shoodjer@davisequip.com', 920, 5, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6742, 'shoodjer@davisequip.com', 920, 6, 'State');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6743, 'shoodjer@davisequip.com', 920, 7, 'Zip');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6744, 'shoodjer@davisequip.com', 920, 8, 'SalesRep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6745, 'shoodjer@davisequip.com', 920, 9, 'BusinessType');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6746, 'anne@wedrivesales.ca', 16336, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6747, 'anne@wedrivesales.ca', 16336, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6748, 'anne@wedrivesales.ca', 16336, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6749, 'anne@wedrivesales.ca', 16336, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6750, 'anne@wedrivesales.ca', 16336, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6751, 'anne@wedrivesales.ca', 16336, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6752, 'anne@wedrivesales.ca', 16336, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6753, 'anne@wedrivesales.ca', 16336, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6754, 'anne@wedrivesales.ca', 16336, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6755, 'anne@wedrivesales.ca', 16336, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6756, 'anne@wedrivesales.ca', 16336, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6757, 'anne@wedrivesales.ca', 16336, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6758, 'anne@wedrivesales.ca', 16336, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6759, 'anne@wedrivesales.ca', 16336, 14, 'PIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6760, 'stauffersale@gmail.com', 16336, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6761, 'stauffersale@gmail.com', 16336, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6762, 'stauffersale@gmail.com', 16336, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6763, 'stauffersale@gmail.com', 16336, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6764, 'stauffersale@gmail.com', 16336, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6765, 'stauffersale@gmail.com', 16336, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6766, 'stauffersale@gmail.com', 16336, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6767, 'stauffersale@gmail.com', 16336, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6768, 'stauffersale@gmail.com', 16336, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6769, 'stauffersale@gmail.com', 16336, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6770, 'stauffersale@gmail.com', 16336, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6771, 'stauffersale@gmail.com', 16336, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6772, 'stauffersale@gmail.com', 16336, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6773, 'stauffersale@gmail.com', 16336, 14, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6797, 'andersonkiasale@gmail.com', 16380, 8, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6796, 'andersonkiasale@gmail.com', 16380, 7, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6795, 'andersonkiasale@gmail.com', 16380, 6, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6794, 'andersonkiasale@gmail.com', 16380, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6793, 'andersonkiasale@gmail.com', 16380, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6792, 'andersonkiasale@gmail.com', 16380, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6791, 'andersonkiasale@gmail.com', 16380, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6790, 'andersonkiasale@gmail.com', 16380, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6734, 'hondahousesale@gmail.com', 3411, 20, 'TrimLevel');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6735, 'hondahousesale@gmail.com', 3411, 21, 'VIN');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6815, 'myorleansnissansale@gmail.com', 4583, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6731, 'hondahousesale@gmail.com', 3411, 17, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6732, 'hondahousesale@gmail.com', 3411, 18, 'PurchaseTime');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6733, 'hondahousesale@gmail.com', 3411, 19, 'sales_rep');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6729, 'hondahousesale@gmail.com', 3411, 15, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6730, 'hondahousesale@gmail.com', 3411, 16, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6727, 'hondahousesale@gmail.com', 3411, 13, 'BusPhone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6728, 'hondahousesale@gmail.com', 3411, 14, 'Dist');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6725, 'hondahousesale@gmail.com', 3411, 11, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6726, 'hondahousesale@gmail.com', 3411, 12, 'vehicle_financing');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6723, 'hondahousesale@gmail.com', 3411, 9, 'City');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6724, 'hondahousesale@gmail.com', 3411, 10, 'ideal_replacement');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6721, 'hondahousesale@gmail.com', 3411, 7, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6722, 'hondahousesale@gmail.com', 3411, 8, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6719, 'hondahousesale@gmail.com', 3411, 5, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6720, 'hondahousesale@gmail.com', 3411, 6, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6718, 'hondahousesale@gmail.com', 3411, 4, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6716, 'hondahousesale@gmail.com', 3411, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6717, 'hondahousesale@gmail.com', 3411, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6715, 'hondahousesale@gmail.com', 3411, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6816, 'myorleansnissansale@gmail.com', 4583, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6817, 'myorleansnissansale@gmail.com', 4583, 12, 'ModelYear');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6818, 'myorleansnissansale@gmail.com', 4583, 13, 'Model');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6819, 'myorleansnissansale@gmail.com', 4583, 14, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6820, 'myorleansnissansale@gmail.com', 4583, 15, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6821, 'anne@wedrivesales.ca', 16380, 1, 'FirstName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6822, 'anne@wedrivesales.ca', 16380, 2, 'LastName');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6823, 'anne@wedrivesales.ca', 16380, 3, 'Phone');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6824, 'anne@wedrivesales.ca', 16380, 4, 'Mobile');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6825, 'anne@wedrivesales.ca', 16380, 5, 'Email');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6826, 'anne@wedrivesales.ca', 16380, 6, 'FollowUp');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6827, 'anne@wedrivesales.ca', 16380, 7, 'Followup_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6828, 'anne@wedrivesales.ca', 16380, 8, 'Appointment_Date');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6829, 'anne@wedrivesales.ca', 16380, 9, 'SalesmanCode');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6830, 'anne@wedrivesales.ca', 16380, 10, 'Sold_Lost');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6831, 'anne@wedrivesales.ca', 16380, 11, 'Notes');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6832, 'anne@wedrivesales.ca', 16380, 12, 'PURL');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6833, 'anne@wedrivesales.ca', 16380, 13, 'VisitDate');
INSERT INTO `xmediaContact` (`id`, `username`, `accountid`, `orderid`, `fieldname`) VALUES
	(6834, 'anne@wedrivesales.ca', 16380, 14, 'PurchaseTime');
/*!40000 ALTER TABLE `xmediaContact` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
