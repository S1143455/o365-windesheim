ALTER TABLE `stockitem`
DROP COLUMN `AttachmentID`,
ADD COLUMN `StockItemDescription` VARCHAR(100) NULL AFTER `SpecialDealID`;
CREATE TABLE `attachmentcategorie` (
  `AttachmentCategorieID` INT NOT NULL AUTO_INCREMENT,
  `attachmentID` INT NOT NULL,
  `categoryID` INT NOT NULL,
  `lastEditedBy` INT NOT NULL,
  PRIMARY KEY (`AttachmentCategorieID`));
CREATE TABLE `attachmentstockitem` (
  `AttachmentStockItemID` INT NOT NULL AUTO_INCREMENT,
  `AttachmentID` INT NOT NULL,
  `StockItemID` INT NOT NULL,
  `lastEditedBy` INT NOT NULL,
  PRIMARY KEY (`AttachmentStockItemID`));

ALTER TABLE `attachments`
ADD COLUMN `URL` VARCHAR(45) NULL AFTER `LastEditedBy`,
ADD COLUMN `Active` TINYINT NULL AFTER `URL`,
CHANGE COLUMN `FileLocation` `FileLocation` VARCHAR(250) NULL ;

ALTER TABLE `stockitem` 
ADD COLUMN `TimesVisited` VARCHAR(100) NULL AFTER `StockItemDescription`;
ALTER TABLE `stockitem` 
CHANGE COLUMN `TimesVisited` `TimesVisited` INT NULL DEFAULT NULL ;
