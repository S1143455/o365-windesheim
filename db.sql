CREATE TABLE People (PersonID int(11) NOT NULL AUTO_INCREMENT, FullName varchar(50) NOT NULL, LogonName varchar(50) NOT NULL UNIQUE, HashedPassword blob NOT NULL, IsSystemUser tinyint NOT NULL, Role varchar(50) NOT NULL, PhoneNumber varchar(20) NOT NULL, EmailAddress varchar(50) NOT NULL UNIQUE, Photo blob, LastEditedBy int(11) NOT NULL, CONSTRAINT PersonID PRIMARY KEY (PersonID)) ENGINE=InnoDB;
CREATE TABLE PaymentMethod (PaymentMethodID int(11) NOT NULL AUTO_INCREMENT, PaymentMethodName varchar(50) NOT NULL, LastEditedBy int(11) NOT NULL, PRIMARY KEY (PaymentMethodID)) ENGINE=InnoDB;
CREATE TABLE Deliverymethod (DeliveryMethodID int(10) NOT NULL AUTO_INCREMENT, `DeliveryMethodName` varchar(50), LastEditedBy int(11) NOT NULL, PRIMARY KEY (DeliveryMethodID)) ENGINE=InnoDB;
CREATE TABLE customer (CustomerID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,    AddressID int(10) NOT NULL,    PersonID int(10) NOT NULL,    ShoppingCartID int(10),    Gender varchar(10) NOT NULL,    newsletter boolean NULL,    TermsAndConditions boolean NULL);
CREATE TABLE Supplier (SupplierID int(11) NOT NULL AUTO_INCREMENT, SupplierName varchar(50) NOT NULL, PrimaryContactPersonID int(11) NOT NULL, AlternateContactPersonID int(11) NOT NULL, SupplierReference varchar(50) NOT NULL, InternalComments blob NOT NULL, WebsiteURL varchar(250) NOT NULL, LastEditedBy int(11) NOT NULL, AddressID int(11) NOT NULL, PRIMARY KEY (SupplierID)) ENGINE=InnoDB;
CREATE TABLE Address (AddressId int(11) NOT NULL AUTO_INCREMENT, Address varchar(250) NOT NULL, Zipcode varchar(50) NOT NULL, PersonId int(11) NOT NULL, LastEditedBy int(11) NOT NULL, PRIMARY KEY (AddressId)) ENGINE=InnoDB;
CREATE TABLE Order_StockItem (orderStockItemId int(10) NOT NULL AUTO_INCREMENT, OrderID int(11) NOT NULL, StockItemID int(11) NOT NULL, PRIMARY KEY (orderStockItemId)) ENGINE=InnoDB;
CREATE TABLE `Order` (OrderID int(11) NOT NULL AUTO_INCREMENT, CustomerID int(10) NOT NULL, OrderDate date, ExpectedDeliveryDate date, LastEditedBy int(11) NOT NULL, DeliveryMethodID int(10) NOT NULL, PaymentMethodID int(11) NOT NULL, SpecialDealID int(11), PRIMARY KEY (OrderID)) ENGINE=InnoDB;
CREATE TABLE Attachments (AttachmentID int(11) NOT NULL AUTO_INCREMENT, AlternateText varchar(250), FileLocation varchar(250) NOT NULL, LastEditedBy int(11) NOT NULL, StockItemId int(11), PRIMARY KEY (AttachmentID)) ENGINE=InnoDB;
CREATE TABLE SpecialDeals (SpecialDealID int(11) NOT NULL AUTO_INCREMENT, DealDescription varchar(250), StartDate date NOT NULL, EndDate date, DiscountPercentage int(11) NOT NULL, DealCode int(11) NOT NULL, LastEditedBy int(11) NOT NULL, PRIMARY KEY (SpecialDealID)) ENGINE=InnoDB;
CREATE TABLE category (CategoryID int(11) NOT NULL AUTO_INCREMENT, CategoryName varchar(50) NOT NULL, LastEditedBy int(11) NOT NULL, ParentCategory int(11), PRIMARY KEY (CategoryID)) ENGINE=InnoDB;
CREATE TABLE StockItem (StockItemId int(11) NOT NULL AUTO_INCREMENT, StockItemName varchar(50) NOT NULL, SupplierID int(11) NOT NULL, Brand varchar(50) NOT NULL, `Size` int(10), LoadTimeDays int(11), IsChillerStock tinyint, BarCode varchar(50) NOT NULL, TaxRate int(11) NOT NULL, UnitPrice int(11) NOT NULL, MarketingComments blob, CategoryID int(11) NOT NULL, LastEditedBy int(11) NOT NULL, PRIMARY KEY (StockItemId)) ENGINE=InnoDB);
CREATE TABLE ShoppingCart (ShoppingCartID int(10) NOT NULL AUTO_INCREMENT, ExpirationDate date NOT NULL, CreationDate date NOT NULL, PRIMARY KEY (ShoppingCartID)) ENGINE=InnoDB;
CREATE TABLE Shoppingcart_Stockitems (ShopStockID int(10) NOT NULL AUTO_INCREMENT, ShoppingCartID int(10) NOT NULL, StockItemID int(11) NOT NULL, PRIMARY KEY (ShopStockID)) ENGINE=InnoDB;

ALTER TABLE `Order` ADD CONSTRAINT `Order deliverymethod` FOREIGN KEY (DeliveryMethodID) REFERENCES Deliverymethod (DeliveryMethodID);
ALTER TABLE `Order` ADD CONSTRAINT `Order paymentmethod` FOREIGN KEY (PaymentMethodID) REFERENCES PaymentMethod (PaymentMethodID);
ALTER TABLE Supplier ADD CONSTRAINT PersonLastEditedSupplier FOREIGN KEY (LastEditedBy) REFERENCES People (PersonID);
ALTER TABLE `Order` ADD CONSTRAINT PersonLastEditedOrder FOREIGN KEY (LastEditedBy) REFERENCES People (PersonID);
ALTER TABLE Order_StockItem ADD CONSTRAINT OrderOrderStockItem FOREIGN KEY (OrderID) REFERENCES `Order` (OrderID);
ALTER TABLE Order_StockItem ADD CONSTRAINT StockitemOrderStockitem FOREIGN KEY (StockItemID) REFERENCES StockItem (StockItemId);
ALTER TABLE Supplier ADD CONSTRAINT `PrimaryContact Person` FOREIGN KEY (PrimaryContactPersonID) REFERENCES People (PersonID);
ALTER TABLE Supplier ADD CONSTRAINT `SecondaryContact Person` FOREIGN KEY (AlternateContactPersonID) REFERENCES People (PersonID);
ALTER TABLE Attachments ADD CONSTRAINT PersonLastEditedAttachment FOREIGN KEY (LastEditedBy) REFERENCES People (PersonID);
ALTER TABLE SpecialDeals ADD CONSTRAINT PersonLastEditedSpecialDeal FOREIGN KEY (LastEditedBy) REFERENCES People (PersonID);
ALTER TABLE category ADD CONSTRAINT FKcategory218916 FOREIGN KEY (LastEditedBy) REFERENCES People (PersonID);
ALTER TABLE Address ADD CONSTRAINT PersonLastEditedAddress FOREIGN KEY (LastEditedBy) REFERENCES People (PersonID);
ALTER TABLE Address ADD CONSTRAINT `Person Address` FOREIGN KEY (PersonId) REFERENCES People (PersonID);
ALTER TABLE PaymentMethod ADD CONSTRAINT PersonLastEditedPayment FOREIGN KEY (LastEditedBy) REFERENCES People (PersonID);
ALTER TABLE Deliverymethod ADD CONSTRAINT PersonLastEditedDeliveryMethod FOREIGN KEY (LastEditedBy) REFERENCES People (PersonID);
ALTER TABLE `Order` ADD CONSTRAINT FKOrder835009 FOREIGN KEY (CustomerID) REFERENCES Customer (CustomerID);
ALTER TABLE Attachments ADD CONSTRAINT `Attachments stockitems` FOREIGN KEY (StockItemId) REFERENCES StockItem (StockItemId);
ALTER TABLE StockItem ADD CONSTRAINT `StockItem Supplier` FOREIGN KEY (SupplierID) REFERENCES Supplier (SupplierID);
ALTER TABLE Supplier ADD CONSTRAINT `Supplier Address` FOREIGN KEY (AddressID) REFERENCES Address (AddressId);
ALTER TABLE `Order` ADD CONSTRAINT FKOrder754218 FOREIGN KEY (SpecialDealID) REFERENCES SpecialDeals (SpecialDealID);
ALTER TABLE StockItem ADD CONSTRAINT `StockItem Category` FOREIGN KEY (CategoryID) REFERENCES category (CategoryID);
ALTER TABLE Customer ADD CONSTRAINT CustomerShoppingcart FOREIGN KEY (ShoppingCartID) REFERENCES ShoppingCart (ShoppingCartID);
ALTER TABLE Shoppingcart_Stockitems ADD CONSTRAINT Shoppingcart_StockitemsStockitem FOREIGN KEY (StockItemID) REFERENCES StockItem (StockItemId);
ALTER TABLE Shoppingcart_Stockitems ADD CONSTRAINT ShoppingCartShoppingCart_StockItems FOREIGN KEY (ShoppingCartID) REFERENCES ShoppingCart (ShoppingCartID);
ALTER TABLE attachments ADD COLUMN CategoryID int (11) NULL;
ALTER TABLE attachments ADD constraint Attachments_category FOREIGN KEY (CategoryID) references category(categoryid);

CREATE TABLE Content(    ContentID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,    Section varchar(50) NOT NULL,    HTML    LONGTEXT    NULL,    UpdDt  datetime    NOT NULL);
CREATE TABLE Content_category(    ContentCategoryID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,    ContentID int(11) NOT NULL,    CategoryID int(11) NOT NULL,    SeqNum int (4) NOT NULL);

ALTER TABLE Content_category ADD CONSTRAINT FK_Content FOREIGN KEY (ContentID) REFERENCES Content(ContentID);
ALTER TABLE Content_category ADD CONSTRAINT FK_CategoryID FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID);


INSERT INTO CONTENT (Section, HTML, UpdDt)
VALUES('TITLE', "<h2>Oma's beste</h2>", sysdate()),
( 'SUBTITLE', "<h4>Producten zoals oma ze vroeger maakte!</h4>", sysdate()),
( 'STORY', "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tristique bibendum condimentum. Duis sagittis mauris nisl, quis volutpat lacus tincidunt vitae. Pellentesque vel semper sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mollis enim eu risus condimentum, eget dapibus erat fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus nec ultrices ex, in egestas nunc. Morbi vitae odio venenatis, eleifend odio ac, finibus ex. Vivamus ac tincidunt purus, nec vehicula orci. Sed mauris lacus, mattis ullamcorper dui ac, placerat iaculis dolor. Sed sollicitudin luctus sem, eu lobortis sapien imperdiet nec. Nam nec erat ac nisi ornare cursus pulvinar vitae elit. Aliquam a porta leo. Nullam dictum luctus nulla ac porttitor. Nullam eu nulla commodo, hendrerit sem eget, consectetur risus. Nulla eu tincidunt ex, eget suscipit neque.", sysdate())
;