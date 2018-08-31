DROP database phpsreps_db;
CREATE database phpsreps_db;

CREATE TABLE `phpsreps_db`.`items` (
    `item_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Item ID',
    `item_name` VARCHAR(255) NOT NULL COMMENT 'Item Name',
    `item_desc` VARCHAR(255) NOT NULL COMMENT 'Item Description',
    `item_stock` INT NOT NULL COMMENT 'Item Stock Level',
    `item_cost` DECIMAL(5,2) NOT NULL COMMENT 'Cost Price',
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    PRIMARY KEY (`item_id`));
