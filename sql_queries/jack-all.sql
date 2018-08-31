CREATE database php_sreps;

USE php_sreps;

CREATE TABLE `php_sreps`.`item` (
    `item_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Item ID',
    `item_name` VARCHAR(255) NOT NULL COMMENT 'Item Name',
    `item_desc` VARCHAR(255) NOT NULL COMMENT 'Item Description',
    `item_stock` INT NOT NULL COMMENT 'Item Stock Level',
    `item_cost` DECIMAL NOT NULL COMMENT 'Cost Price',
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    PRIMARY KEY (`item_id`)
);

CREATE TABLE `php_sreps`.`sale` (
    `sale_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Sale ID',
    `item_id` INT(10) UNSIGNED NOT NULL COMMENT 'Item ID',
    `sale_price` DECIMAL NOT NULL COMMENT 'Item Sale Price',
    `sale_qty` INT NOT NULL COMMENT 'Quantity Sold',
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    PRIMARY KEY (`sale_id`),
    FOREIGN KEY (`item_id`) REFERENCES item(`item_id`)
);
