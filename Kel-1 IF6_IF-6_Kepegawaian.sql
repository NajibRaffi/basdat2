/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - najibdatabase
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`najibdatabase` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `najibdatabase`;

/*Table structure for table `absen` */

DROP TABLE IF EXISTS `absen`;

CREATE TABLE `absen` (
  `id_absen` varchar(50) NOT NULL,
  `alfa` int(11) DEFAULT NULL,
  `sakit` int(11) DEFAULT NULL,
  `izin` int(11) DEFAULT NULL,
  `id_petugas` varchar(50) DEFAULT NULL,
  `id_jabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_absen`),
  KEY `id_petugas` (`id_petugas`),
  KEY `id_jabatan` (`id_jabatan`),
  CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `akunpetugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `absen_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `absen` */

insert  into `absen`(`id_absen`,`alfa`,`sakit`,`izin`,`id_petugas`,`id_jabatan`) values 
('absen1',0,1,0,'petugas1','jab1'),
('absen2',0,2,3,'petugas2','jab2'),
('absen3',0,3,4,'petugas3','jab3'),
('absen4',0,4,6,'petugas4',NULL);

/*Table structure for table `akunpetugas` */

DROP TABLE IF EXISTS `akunpetugas`;

CREATE TABLE `akunpetugas` (
  `id_petugas` varchar(50) NOT NULL,
  `nama_petugas` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan','privasi') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `password` text DEFAULT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `akunpetugas` */

insert  into `akunpetugas`(`id_petugas`,`nama_petugas`,`email`,`jenis_kelamin`,`tanggal_lahir`,`password`) values 
('ADMIN','admin','admin123@gmail.com','privasi','2022-07-11','admin123'),
('petugas1','najib raffi irdiana','najibganteng123@gmail.com','laki-laki','2001-04-26','najib123'),
('petugas2','Rully Fadya','Rully@gmail.com','perempuan','2001-04-27','rully123'),
('petugas3','Mutia','mutia@gmail.com','perempuan','2001-04-28','mutia123'),
('petugas4','Hanung','hanung@gmail.com','laki-laki','2001-08-16','hanung123');

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(50) NOT NULL,
  `jabatan` text DEFAULT NULL,
  `mulai_jabat` date DEFAULT NULL,
  `akhir_jabat` date DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id_jabatan`,`jabatan`,`mulai_jabat`,`akhir_jabat`) values 
('jab1','CEO','0000-00-00',NULL),
('jab2','IT Manager','0000-00-00',NULL),
('jab3','Backend Management','0000-00-00',NULL),
('jab4','UI/UX Management','0000-00-00',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
