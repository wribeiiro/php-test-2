/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.19 : Database - test_2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `product_type_id` int NOT NULL,
  `price` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_type_id` (`product_type_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_type_id`) REFERENCES `products_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 ;

/*Data for the table `products` */

insert  into `products`(`id`,`description`,`product_type_id`,`price`,`created_at`,`updated_at`) values 
(4,'Keyboard',1,234.0000,'2020-12-14 16:34:09','2020-12-15 14:02:24'),
(5,'Headset',1,45.0000,'2020-12-14 16:38:11','2020-12-15 14:02:32'),
(21,'PHP Book',5,34.0000,'2020-12-14 20:39:43','2020-12-15 14:02:43'),
(22,'Course Book',5,50.0000,'2020-12-14 22:08:27','2020-12-15 14:11:34');

/*Table structure for table `products_type` */

DROP TABLE IF EXISTS `products_type`;

CREATE TABLE `products_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `tax_percentage` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ;

/*Data for the table `products_type` */

insert  into `products_type`(`id`,`description`,`tax_percentage`,`created_at`,`updated_at`) values 
(1,'Type Default',7.5000,'2020-12-14 09:31:37','2020-12-15 14:10:51'),
(3,'Assessories',10.0000,'2020-12-14 17:27:46','2020-12-15 14:10:55'),
(5,'Books',5.0000,'2020-12-14 20:36:52','2020-12-15 14:10:48'),
(6,'Courses',12.0000,'2020-12-14 20:39:06','2020-12-15 14:11:24');

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `total_price` decimal(11,4) DEFAULT '0.0000',
  `total_tax` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ;

/*Data for the table `sales` */

insert  into `sales`(`id`,`client_name`,`total_price`,`total_tax`,`created_at`,`updated_at`) values 
(5,'CLIENT TEST',320.8600,20.9300,'2020-12-15 14:31:44',NULL);

/*Table structure for table `sales_item` */

DROP TABLE IF EXISTS `sales_item`;

CREATE TABLE `sales_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sale_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` decimal(11,4) DEFAULT '0.0000',
  `price` decimal(11,4) DEFAULT '0.0000',
  `tax` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sale_id` (`sale_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `sales_item_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ;

/*Data for the table `sales_item` */

insert  into `sales_item`(`id`,`sale_id`,`product_id`,`quantity`,`price`,`tax`,`created_at`,`updated_at`) values 
(4,5,4,1.0000,251.5500,17.5500,'2020-12-15 14:31:44',NULL),
(5,5,5,1.0000,48.3800,3.3800,'2020-12-15 14:31:44',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
