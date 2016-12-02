/*
SQLyog Community v12.2.0 (64 bit)
MySQL - 5.5.24-log : Database - farmfood
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`farmfood` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `farmfood`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`active`,`created`,`modified`) values 
(1,'Moong Beans',1,'2016-09-23 08:07:02','2016-09-23 11:12:01'),
(2,'Urad beans',1,'2016-09-23 08:18:17','2016-09-23 10:32:14'),
(3,'Toor - Red Gram',1,'2016-09-23 08:18:25','2016-09-23 10:13:42'),
(4,'Moong Dal',1,'2016-09-23 10:32:33','2016-09-23 10:32:33'),
(5,'Urad Dal',1,'2016-09-23 10:32:45','2016-09-23 10:32:45'),
(6,'Toor Dal',1,'2016-09-23 10:32:53','2016-09-23 10:32:53');

/*Table structure for table `category_products` */

DROP TABLE IF EXISTS `category_products`;

CREATE TABLE `category_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `category_products` */

/*Table structure for table `delivery_locations` */

DROP TABLE IF EXISTS `delivery_locations`;

CREATE TABLE `delivery_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `delivery_time` varchar(55) DEFAULT NULL,
  `free_delivery` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `delivery_locations` */

insert  into `delivery_locations`(`id`,`name`,`active`,`delivery_time`,`free_delivery`,`created`,`modified`) values 
(1,'Vidyuth Nagar (MIG Ph-2, BHEL)',1,'3 - 6 working days',1,'2016-09-29 10:50:31','2016-09-29 11:39:55'),
(3,'ValueLabs',1,'3-6 working days',1,'2016-09-29 11:38:32','2016-09-29 11:38:32');

/*Table structure for table `guests` */

DROP TABLE IF EXISTS `guests`;

CREATE TABLE `guests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `mobile` int(10) unsigned DEFAULT NULL,
  `address` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `guests` */

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT '1',
  `sort` int(11) DEFAULT '0',
  `extension` varchar(20) DEFAULT NULL,
  `type` varchar(55) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `caption` varchar(255) NOT NULL,
  `highlight` tinyint(1) DEFAULT '0',
  `content_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `images` */

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text,
  `from_name` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `from_mobile` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `messages` */

/*Table structure for table `order_products` */

DROP TABLE IF EXISTS `order_products`;

CREATE TABLE `order_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `product_name` varchar(55) DEFAULT NULL,
  `max_retail_price` int(10) unsigned DEFAULT NULL,
  `selling_price` int(10) unsigned DEFAULT NULL,
  `weight` int(10) unsigned DEFAULT NULL,
  `category_name` varchar(55) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `order_products` */

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shopping_cart_id` int(10) unsigned NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `mobile` int(10) DEFAULT NULL,
  `address` text,
  `message` text,
  `status` varchar(55) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `location` varchar(55) DEFAULT NULL,
  `payment_method` varchar(55) DEFAULT NULL,
  `free_delivery` tinyint(1) DEFAULT '0',
  `delivery_time` varchar(55) DEFAULT NULL,
  `delivery_location_id` int(10) DEFAULT NULL,
  `booked` tinyint(1) DEFAULT '0',
  `booked_date` date DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT '0',
  `confirmed_date` date DEFAULT NULL,
  `delivered` tinyint(1) DEFAULT '0',
  `delivery_date` date DEFAULT NULL,
  `cancelled` tinyint(1) DEFAULT '0',
  `cancelled_date` date DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `closed_date` date DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `discount_amount` int(11) DEFAULT NULL,
  `promo_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT '1',
  `description` text,
  `max_retail_price` int(7) unsigned DEFAULT '0',
  `selling_price` int(7) unsigned DEFAULT '0',
  `in_stock` tinyint(1) unsigned DEFAULT '1',
  `priority` int(2) unsigned DEFAULT '1',
  `featured` tinyint(1) unsigned DEFAULT '1',
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `weight` int(10) unsigned DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`active`,`description`,`max_retail_price`,`selling_price`,`in_stock`,`priority`,`featured`,`meta_keywords`,`meta_description`,`created`,`modified`,`weight`,`category_id`) values 
(7,'Moong Beans - 2 Kg',1,'Moong beans description<br><p><br></p>',240,180,1,1,1,'','','2016-09-23 10:36:03','2016-09-28 06:33:51',2000,1),
(8,'Moong Beans - 1 Kg',1,'',140,90,1,1,0,'','','2016-09-23 10:36:47','2016-09-23 13:48:22',1000,1),
(9,'Moong Beans - 5 Kg',1,'',720,400,1,1,1,'','','2016-09-23 10:37:48','2016-09-23 11:38:50',5000,1),
(10,'Urad Dal - 1 Kg - with chilka',1,'<p>description of Urad dal with chilka<br></p>',190,120,0,1,1,'','','2016-09-23 10:39:23','2016-09-23 13:22:03',1000,5);

/*Table structure for table `promo_codes` */

DROP TABLE IF EXISTS `promo_codes`;

CREATE TABLE `promo_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `promo_code` varchar(55) DEFAULT NULL,
  `description` text,
  `discount_price` int(5) unsigned DEFAULT '0',
  `active` tinyint(1) unsigned DEFAULT '0',
  `reseller_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `promo_codes` */

/*Table structure for table `resellers` */

DROP TABLE IF EXISTS `resellers`;

CREATE TABLE `resellers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `mobile` int(10) unsigned DEFAULT NULL,
  `address` text,
  `active` tinyint(1) unsigned DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `referred_by` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `resellers` */

/*Table structure for table `shopping_cart_products` */

DROP TABLE IF EXISTS `shopping_cart_products`;

CREATE TABLE `shopping_cart_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `shopping_cart_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `shopping_cart_products` */

/*Table structure for table `shopping_carts` */

DROP TABLE IF EXISTS `shopping_carts`;

CREATE TABLE `shopping_carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_booked` tinyint(1) unsigned DEFAULT '0',
  `total_amount` int(8) unsigned DEFAULT '0',
  `discount_amount` int(8) unsigned DEFAULT '0',
  `promo_code` varchar(55) DEFAULT NULL,
  `promo_code_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `guest_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `shopping_carts` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `reset_link` text,
  `admin` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`mobile`,`active`,`created`,`modified`,`reset_link`,`admin`) values 
(9,'Preetham','preetham.pawar@gmail.com','55ce0e405a34470d08650771bf644af1','9494203060',1,'2016-09-19 11:53:04','2016-09-21 06:58:41',NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
