-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.67-community-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema ordersms
--

CREATE DATABASE IF NOT EXISTS ordersms;
USE ordersms;

--
-- Definition of table `daftarharga`
--

DROP TABLE IF EXISTS `daftarharga`;
CREATE TABLE `daftarharga` (
  `kode` char(20) NOT NULL,
  `menuid` char(3) NOT NULL,
  `tanggal` datetime NOT NULL,
  `harga` double NOT NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftarharga`
--

/*!40000 ALTER TABLE `daftarharga` DISABLE KEYS */;
INSERT INTO `daftarharga` (`kode`,`menuid`,`tanggal`,`harga`) VALUES 
 ('0992008-11-30','099','2008-11-30 00:00:00',40000),
 ('0992008-12-05','099','2008-12-05 00:00:00',0);
/*!40000 ALTER TABLE `daftarharga` ENABLE KEYS */;


--
-- Definition of table `handphone`
--

DROP TABLE IF EXISTS `handphone`;
CREATE TABLE `handphone` (
  `handphoneno` int(10) unsigned NOT NULL auto_increment,
  `model` char(30) NOT NULL,
  `port` char(20) NOT NULL,
  `connection` char(20) NOT NULL,
  `activeyn` char(1) NOT NULL,
  PRIMARY KEY  USING BTREE (`handphoneno`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `handphone`
--

/*!40000 ALTER TABLE `handphone` DISABLE KEYS */;
INSERT INTO `handphone` (`handphoneno`,`model`,`port`,`connection`,`activeyn`) VALUES 
 (1,'n70','com5','at115200','N'),
 (3,'auto','com8','at115200','N'),
 (4,'n70','com10','at115200','N'),
 (5,'auto','com10','at115200','Y'),
 (6,'auto','com11','fbuspl2303','N'),
 (7,'auto','com11','fbus','N'),
 (8,'auto','/dev/ttyUSB0','fbuspl2303','N');
/*!40000 ALTER TABLE `handphone` ENABLE KEYS */;


--
-- Definition of table `inbox`
--

DROP TABLE IF EXISTS `inbox`;
CREATE TABLE `inbox` (
  `pesanno` int(10) unsigned NOT NULL auto_increment,
  `pesan` varchar(160) NOT NULL,
  `nohp` char(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY  (`pesanno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox`
--

/*!40000 ALTER TABLE `inbox` DISABLE KEYS */;
/*!40000 ALTER TABLE `inbox` ENABLE KEYS */;


--
-- Definition of table `jenis`
--

DROP TABLE IF EXISTS `jenis`;
CREATE TABLE `jenis` (
  `jenisid` char(3) NOT NULL,
  `nama` varchar(60) NOT NULL,
  PRIMARY KEY  (`jenisid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

/*!40000 ALTER TABLE `jenis` DISABLE KEYS */;
INSERT INTO `jenis` (`jenisid`,`nama`) VALUES 
 ('001','Makanan'),
 ('002','Minuman');
/*!40000 ALTER TABLE `jenis` ENABLE KEYS */;


--
-- Definition of table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `userid` char(30) NOT NULL,
  `logindate` datetime NOT NULL,
  `userip` char(15) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `login`
--

/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`userid`,`logindate`,`userip`) VALUES 
 ('administrator','2008-12-05 01:52:56','127.0.0.1'),
 ('niqmk','2008-12-05 01:52:56','127.0.0.1');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;


--
-- Definition of table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menuid` char(3) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `kodemenu` char(3) NOT NULL,
  `restoranid` char(3) NOT NULL,
  `jenisid` char(3) NOT NULL,
  `activeyn` char(1) NOT NULL,
  PRIMARY KEY  (`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`menuid`,`nama`,`kodemenu`,`restoranid`,`jenisid`,`activeyn`) VALUES 
 ('001','Nasi Putih','NPH','001','','Y'),
 ('002','Daging Rendang','DRG','001','','Y'),
 ('003','Daging Empal','DEL','001','','Y'),
 ('004','Daging Kinca','DEA','001','','Y'),
 ('005','Ayam Goreng','AGG','001','','Y'),
 ('006','Ayam Pop','APP','001','','Y'),
 ('007','Ayam Kari','AKI','001','','Y'),
 ('008','Ayam Panggang','APG','001','','Y'),
 ('009','Paru','PRU','001','','Y'),
 ('010','Kikil','KIL','001','','Y'),
 ('011','Otak','OTK','001','','Y'),
 ('012','Ati','ATI','001','','Y'),
 ('013','Ampela','APL','001','','Y'),
 ('014','Telur Dadar','TDR','001','','Y'),
 ('015','Telur Bulat','TBT','001','','Y'),
 ('016','Tempe','TPE','001','','Y'),
 ('017','Tahu','THU','001','','Y'),
 ('018','Perkedel','PKL','001','','Y'),
 ('019','Ikan Goreng','IGG','001','','Y'),
 ('020','Kepala Ikan','KIN','001','','Y'),
 ('021','Sop','SOP','001','','Y'),
 ('022','Nasi Goreng Ikan Asin','NGI','002','','Y'),
 ('023','Nasi Goreng Seafood','NGS','002','','Y'),
 ('024','Nasi Goreng Spesial','NGS','002','','Y');
INSERT INTO `menu` (`menuid`,`nama`,`kodemenu`,`restoranid`,`jenisid`,`activeyn`) VALUES 
 ('025','Nasi Goreng Pete','NGP','002','','Y'),
 ('026','Nasi Capcay','NCY','002','','Y'),
 ('027','Nasi Daging Cah Jamur','NDC','002','','Y'),
 ('028','Nasi Daging Cah Cabai','NDC','002','','Y'),
 ('029','Nasi Daging Sapi Lada Hitam','NDS','002','','Y'),
 ('030','Nasi Ayam Saos Tomat','NAS','002','','Y'),
 ('031','Nasi Ayam Cah Cabai','NAC','002','','Y'),
 ('032','Nasi Tim','NTM','002','','Y'),
 ('033','Nasi Campur','NCR','002','','Y'),
 ('034','Nasi Ayam Hainam','NAH','002','','Y'),
 ('035','Bakmi Ayam','BAM','002','','Y'),
 ('036','Bakmi Ayam Saos Tomat','BAS','002','','Y'),
 ('037','Bakmi Bakso','BBS','002','','Y'),
 ('038','Bakmi Pangsit Rebus','BPR','002','','Y'),
 ('039','Bakmi Pangsit Goreng','BPG','002','','Y'),
 ('040','Bakmi Swekiaw Goreng','BSG','002','','Y'),
 ('041','Bakmi Special','BSL','002','','Y'),
 ('042','Bakmi Udang Tahu Pedas','BUT','002','','Y'),
 ('043','Bakmi Goreng Seafood','BGS','002','','Y'),
 ('044','Bakmi Goreng Spesial','BGS','002','','Y');
INSERT INTO `menu` (`menuid`,`nama`,`kodemenu`,`restoranid`,`jenisid`,`activeyn`) VALUES 
 ('045','Kwetiaw Goreng Sapi','KGS','002','','Y'),
 ('046','Kwetiaw Seafood','KSD','002','','Y'),
 ('047','I Fu Mie','IFM','002','','Y'),
 ('048','Siomay Ayam (isi 3)','SAM','002','','Y'),
 ('049','Pangsit Goreng (isi 3)','PGG','002','','Y'),
 ('050','Chicken Teriyaki','CTI','003','','Y'),
 ('051',' Chicken Yakiniku','CYI','003','','Y'),
 ('052','Beef Teriyaki','BTI','003','','Y'),
 ('053','Beef Yakiniku','BYI','003','','Y'),
 ('054','Ebi Furai','EFI','003','','Y'),
 ('055','Ebi Katsu','EKU','003','','Y'),
 ('056','Egg Chicken Roll','ECR','003','','Y'),
 ('057','Ekkado','EKD','003','','Y'),
 ('058','Kani Roll','KRL','003','','Y'),
 ('059','Shrimp Roll','SRL','003','','Y'),
 ('060','Spicy Chicken','SCN','003','','Y'),
 ('061','Sukiyaki','SKI','003','','Y'),
 ('062','Tori Baaga','TBA','003','','Y'),
 ('063','Pangsit Udang','PUG','003','','Y'),
 ('064','Gyoza','GYA','003','','Y'),
 ('065','Shumay Furai','SFI','003','','Y'),
 ('066','Ebi Fried','EFD','003','','Y');
INSERT INTO `menu` (`menuid`,`nama`,`kodemenu`,`restoranid`,`jenisid`,`activeyn`) VALUES 
 ('067','Hamburger','HBR','004','','Y'),
 ('068','Double Hamburger','DHR','004','','Y'),
 ('069','Cheese Hamburger','CBR','004','','Y'),
 ('070','Double Cheeseburger','DCR','004','','Y'),
 ('071','Chicken Sandwich','CSH','004','','Y'),
 ('072','Spicy Chicken Sandwich','SCS','004','','Y'),
 ('073','Chicken Hamburger','CHR','004','','Y'),
 ('074','Filet-O-Fish','FOF','004','','Y'),
 ('075','Hot Dog','HDG','004','','Y'),
 ('076','Side Garden Salad','SGS','004','','Y'),
 ('077','Half Boiled Egg','HBE','004','','Y'),
 ('078','Scrambled Egg','SEG','004','','Y'),
 ('079','Ommelet Egg','OGG','004','','Y'),
 ('080','Onion Ring (isi 5)','ORG','004','','Y'),
 ('081','Hash Browns','HBS','004','','Y'),
 ('082','Small French Fries','SFS','004','','Y'),
 ('083','Medium French Fries','MFS','004','','Y'),
 ('084','Large French Fries','LFF','004','','Y'),
 ('085','Chicken Nuggets Small (isi 4)','CNS','004','','Y'),
 ('086','Chicken Nuggets Medium(isi 6)','CNM','004','','Y');
INSERT INTO `menu` (`menuid`,`nama`,`kodemenu`,`restoranid`,`jenisid`,`activeyn`) VALUES 
 ('087','Chicken Nuggets Large (isi 10)','CNL','004','','Y'),
 ('088','Apple Pie','APE','004','','Y'),
 ('089','Waffle + Syrup','WSP','004','','Y'),
 ('090','Es Teh Tawar','ETT','005','','Y'),
 ('091','Es Teh Manis','ETM','005','','Y'),
 ('092','Teh Kotak Sosro','TKS','005','','Y'),
 ('093','Fruit Tea Jambu','FTJ','005','','Y'),
 ('094','Fruit Tea Strawberry','FTS','005','','Y'),
 ('095','Fruit Tea Orange','FTO','005','','Y'),
 ('096','Fruit Tea Anggur','FTA','005','','Y'),
 ('097','Aqua Gelas','AGS','005','','Y'),
 ('098','Aqua Botol','ABL','005','','Y'),
 ('100','Pocari Sweat Kaleng','PSK','005','','Y'),
 ('101','Pocari Sweat Botol','PSB','005','','Y'),
 ('102','Mizone Passion Fruit','MPF','005','','Y'),
 ('103','Mizone Orange Lime','MOL','005','','Y'),
 ('104','Coca-Cola Kaleng','CCK','005','','Y'),
 ('105','Sprite kaleng','SKG','005','','Y'),
 ('106','Fanta Kaleng','FKG','005','','Y'),
 ('107','Pepsi Kaleng','PKG','005','','Y'),
 ('108','You C 1000','YCO','005','','Y');
INSERT INTO `menu` (`menuid`,`nama`,`kodemenu`,`restoranid`,`jenisid`,`activeyn`) VALUES 
 ('109','Soda Susu','SSU','005','','Y'),
 ('110','Fruit Punch','FPH','005','','Y'),
 ('111','Lemonade Squash','LSH','005','','Y'),
 ('112','Jus Jambu Merah','JJM','005','','Y'),
 ('113','Jus Melon','JMN','005','','Y'),
 ('114','Jus Semangka','JSA','005','','Y'),
 ('115','Jus Mangga','JMA','005','','Y'),
 ('116','Jus Tomat','JTT','005','','Y'),
 ('117','Jus Pepaya','JPA','005','','Y'),
 ('118','Jus Pear Syanglie','JPE','005','','Y'),
 ('119','Jus apel','JAL','005','','Y'),
 ('120','Jus Kiwi','JKI','005','','Y'),
 ('121','Jus Jeruk','JJK','005','','Y'),
 ('122','Jus Strawberry','JSY','005','','Y');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


--
-- Definition of table `outbox`
--

DROP TABLE IF EXISTS `outbox`;
CREATE TABLE `outbox` (
  `pesanno` int(10) unsigned NOT NULL auto_increment,
  `pesan` varchar(160) NOT NULL,
  `nohp` char(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY  (`pesanno`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outbox`
--

/*!40000 ALTER TABLE `outbox` DISABLE KEYS */;
/*!40000 ALTER TABLE `outbox` ENABLE KEYS */;


--
-- Definition of table `pemakai`
--

DROP TABLE IF EXISTS `pemakai`;
CREATE TABLE `pemakai` (
  `userid` char(30) NOT NULL,
  `username` varchar(60) NOT NULL,
  `userpwd` varchar(100) NOT NULL,
  `statusyn` char(1) NOT NULL,
  `activeyn` char(1) NOT NULL,
  `email` char(30) NOT NULL,
  `address` text NOT NULL,
  `handphone` char(30) NOT NULL,
  `phone` char(30) NOT NULL,
  `handphoneyn` char(1) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemakai`
--

/*!40000 ALTER TABLE `pemakai` DISABLE KEYS */;
INSERT INTO `pemakai` (`userid`,`username`,`userpwd`,`statusyn`,`activeyn`,`email`,`address`,`handphone`,`phone`,`handphoneyn`) VALUES 
 ('administrator','administrator','1fa1f2eed594958af203da50e3362e01','Y','Y','','','','','Y'),
 ('anonymous','anonymous','d41d8cd98f00b204e9800998ecf8427e','Y','Y','anonymous@gmail.com','Jl. Indonesia Raya','','','Y');
/*!40000 ALTER TABLE `pemakai` ENABLE KEYS */;


--
-- Definition of table `restoran`
--

DROP TABLE IF EXISTS `restoran`;
CREATE TABLE `restoran` (
  `restoranid` char(3) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `buka` varchar(5) NOT NULL,
  `tutup` varchar(5) NOT NULL,
  `activeyn` char(1) NOT NULL,
  PRIMARY KEY  USING BTREE (`restoranid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restoran`
--

/*!40000 ALTER TABLE `restoran` DISABLE KEYS */;
INSERT INTO `restoran` (`restoranid`,`nama`,`buka`,`tutup`,`activeyn`) VALUES 
 ('001','Rumah Makan Padang','09:00','19:00','Y'),
 ('002','Rumah Makan Chinese Food','09:00','19:00','Y'),
 ('003','Rumah Makan Tempura','09:00','19:00','Y'),
 ('004','Joint Burger','09:00','19:00','Y'),
 ('005','Kedai Minuman','09:00','19:00','Y');
/*!40000 ALTER TABLE `restoran` ENABLE KEYS */;


--
-- Definition of table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `sessionid` varchar(32) NOT NULL,
  `expiry` int(10) unsigned NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`sessionid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` (`sessionid`,`expiry`,`value`) VALUES 
 ('5277a31f888a948d6251d0626120bdec',1228419863,'');
/*!40000 ALTER TABLE `session` ENABLE KEYS */;


--
-- Definition of table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `settingno` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`settingno`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`settingno`,`name`,`value`) VALUES 
 (1,'port','4'),
 (2,'service center','0'),
 (3,'auto refresh','5'),
 (4,'model','5110'),
 (5,'auto reply','1'),
 (6,'connectivity','5');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;


--
-- Definition of table `tdkeranjang`
--

DROP TABLE IF EXISTS `tdkeranjang`;
CREATE TABLE `tdkeranjang` (
  `nodetil` char(28) NOT NULL,
  `nokeranjang` char(10) NOT NULL,
  `menuid` char(3) NOT NULL,
  `qty` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`nodetil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tdkeranjang`
--

/*!40000 ALTER TABLE `tdkeranjang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tdkeranjang` ENABLE KEYS */;


--
-- Definition of table `tdorder`
--

DROP TABLE IF EXISTS `tdorder`;
CREATE TABLE `tdorder` (
  `nodetil` char(13) NOT NULL,
  `menuid` char(3) NOT NULL,
  `notransaksi` char(10) NOT NULL,
  `qty` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`nodetil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tdorder`
--

/*!40000 ALTER TABLE `tdorder` DISABLE KEYS */;
/*!40000 ALTER TABLE `tdorder` ENABLE KEYS */;


--
-- Definition of table `thkeranjang`
--

DROP TABLE IF EXISTS `thkeranjang`;
CREATE TABLE `thkeranjang` (
  `nokeranjang` char(10) NOT NULL,
  `userid` char(15) NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  USING BTREE (`nokeranjang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thkeranjang`
--

/*!40000 ALTER TABLE `thkeranjang` DISABLE KEYS */;
/*!40000 ALTER TABLE `thkeranjang` ENABLE KEYS */;


--
-- Definition of table `thorder`
--

DROP TABLE IF EXISTS `thorder`;
CREATE TABLE `thorder` (
  `notransaksi` char(10) NOT NULL,
  `userid` char(15) NOT NULL,
  `tanggal` datetime NOT NULL,
  `statusyn` char(1) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `jamdikirm` datetime NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  USING BTREE (`notransaksi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thorder`
--

/*!40000 ALTER TABLE `thorder` DISABLE KEYS */;
/*!40000 ALTER TABLE `thorder` ENABLE KEYS */;


--
-- Definition of table `voucher`
--

DROP TABLE IF EXISTS `voucher`;
CREATE TABLE `voucher` (
  `voucherid` char(11) NOT NULL,
  `userid` char(15) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  (`voucherid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher`
--

/*!40000 ALTER TABLE `voucher` DISABLE KEYS */;
/*!40000 ALTER TABLE `voucher` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
