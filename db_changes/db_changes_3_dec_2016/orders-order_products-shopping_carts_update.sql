CREATE TABLE `orders` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shopping_cart_id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(55) DEFAULT NULL,
  `email` VARCHAR(250) DEFAULT NULL,
  `mobile` INT(10) DEFAULT NULL,
  `address` TEXT,
  `message` TEXT,
  `status` VARCHAR(55) DEFAULT NULL,
  `transaction_date` DATE DEFAULT NULL,
  `created` DATETIME DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `user_id` INT(11) DEFAULT NULL,
  `guest_id` INT(11) DEFAULT NULL,
  `location` VARCHAR(55) DEFAULT NULL,
  `payment_method` VARCHAR(55) DEFAULT NULL,
  `free_delivery` TINYINT(1) DEFAULT '0',
  `delivery_time` VARCHAR(55) DEFAULT NULL,
  `delivery_location_id` INT(10) DEFAULT NULL,
  `booked` TINYINT(1) DEFAULT '0',
  `booked_date` DATE DEFAULT NULL,
  `confirmed` TINYINT(1) DEFAULT '0',
  `confirmed_date` DATE DEFAULT NULL,
  `delivered` TINYINT(1) DEFAULT '0',
  `delivery_date` DATE DEFAULT NULL,
  `cancelled` TINYINT(1) DEFAULT '0',
  `cancelled_date` DATE DEFAULT NULL,
  `closed` TINYINT(1) DEFAULT '0',
  `closed_date` DATE DEFAULT NULL,
  `total_amount` INT(11) DEFAULT NULL,
  `discount_amount` INT(11) DEFAULT NULL,
  `promo_code` VARCHAR(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MYISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1



CREATE TABLE `order_products` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` INT(10) UNSIGNED DEFAULT NULL,
  `category_id` INT(10) UNSIGNED DEFAULT NULL,
  `quantity` INT(10) UNSIGNED NOT NULL,
  `order_id` INT(10) UNSIGNED DEFAULT NULL,
  `product_name` VARCHAR(55) DEFAULT NULL,
  `max_retail_price` INT(10) UNSIGNED DEFAULT NULL,
  `selling_price` INT(10) UNSIGNED DEFAULT NULL,
  `weight` INT(10) UNSIGNED DEFAULT NULL,
  `category_name` VARCHAR(55) DEFAULT NULL,
  `created` DATETIME DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1




CREATE TABLE `shopping_carts` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_booked` TINYINT(1) UNSIGNED DEFAULT '0',
  `total_amount` INT(8) UNSIGNED DEFAULT '0',
  `discount_amount` INT(8) UNSIGNED DEFAULT '0',
  `promo_code` VARCHAR(55) DEFAULT NULL,
  `promo_code_id` INT(10) UNSIGNED DEFAULT NULL,
  `created` DATETIME DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `user_id` INT(10) UNSIGNED DEFAULT NULL,
  `guest_id` INT(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MYISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1


