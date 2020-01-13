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