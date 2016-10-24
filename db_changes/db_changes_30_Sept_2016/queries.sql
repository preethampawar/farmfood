-- db changes
DROP TABLE IF EXISTS `delivery_locations`;
CREATE TABLE `delivery_locations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(55) DEFAULT NULL,
  `created` DATETIME DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `free_delivery` TINYINT(1) DEFAULT '0',
  `active` TINYINT(1) DEFAULT '1',
  `delivery_time` VARCHAR(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shopping_cart_id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(55) DEFAULT NULL,
  `email` VARCHAR(250) DEFAULT NULL,
  `mobile` INT(10) UNSIGNED DEFAULT NULL,
  `address` TEXT,
  `message` TEXT,
  `status` VARCHAR(55) DEFAULT NULL,
  `transaction_date` DATE DEFAULT NULL,
  `created` DATETIME DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `user_id` INT(11) NOT NULL,
  `location` VARCHAR(55) DEFAULT NULL,
  `payment_type` VARCHAR(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) 
