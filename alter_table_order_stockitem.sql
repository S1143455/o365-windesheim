ALTER TABLE `order_stockitem` ADD `ItemAmount` INT(10) NOT NULL AFTER `StockItemID`, ADD `TotalCartPrice` DECIMAL(18,2) NOT NULL AFTER `ItemAmount`;