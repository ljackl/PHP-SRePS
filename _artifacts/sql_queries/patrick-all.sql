DROP database phpsreps_db;

CREATE database phpsreps_db;

CREATE TABLE `phpsreps_db`.`items` (
    `item_id` INT NOT NULL AUTO_INCREMENT COMMENT 'Item ID',
    `item_name` VARCHAR(255) NOT NULL COMMENT 'Item Name',
    `item_desc` VARCHAR(255) NOT NULL COMMENT 'Item Description',
    `item_stock` INT NOT NULL COMMENT 'Item Stock Level',
    `item_cost` DECIMAL NOT NULL COMMENT 'Cost Price',
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    PRIMARY KEY (`item_id`));

CREATE TABLE `phpsreps_db`.`sales` (
    `sale_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Sale ID',
    `sale_price` DECIMAL NOT NULL COMMENT 'Item Sale Price',
    `sale_qty` INT NOT NULL COMMENT 'Quantity Sold',
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    `item_id` INT(10) NOT NULL,
    PRIMARY KEY (`sale_id`));

ALTER TABLE `phpsreps_db`.`sales`
ADD CONSTRAINT sales_items_item_id_foreign
FOREIGN KEY fk_item_id(item_id)
REFERENCES `phpsreps_db`.`items`(item_id);
