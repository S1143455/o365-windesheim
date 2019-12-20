
DELETE FROM order_stockitem WHERE orderStockItemId <> 0;
DELETE FROM `order` WHERE OrderID <> 0;
DELETE FROM paymentmethod WHERE PaymentMethodID <> 0;
DELETE FROM deliverymethod WHERE DeliveryMethodID <> 0;
DELETE FROM customer WHERE CustomerID <> 0;
DELETE FROM shoppingcart_stockitems WHERE ShopStockID <> 0;
DELETE FROM shoppingcart WHERE ShoppingCartID <> 0;
DELETE FROM stockitem WHERE StockItemId <> 0;
DELETE FROM specialdeals WHERE SpecialDealID <> 0;
DELETE FROM category WHERE CategoryID <> 0;
DELETE FROM supplier WHERE SupplierID <> 0;
DELETE FROM address WHERE AddressId <> 0;
DELETE FROM content_category WHERE ContentCategoryID <> 0;
DELETE FROM content WHERE ContentID <> 0;
DELETE FROM attachments WHERE AttachmentID <> 0;
DELETE FROM people WHERE PersonID <> 0;

DROP TABLE order_stockitem;
DROP TABLE `order`;
DROP TABLE paymentmethod;
DROP TABLE deliverymethod;
DROP TABLE customer;
DROP TABLE shoppingcart_stockitems;
DROP TABLE shoppingcart;
DROP TABLE stockitem;
DROP TABLE specialdeals;
DROP TABLE content_category;
DROP TABLE content;
DROP TABLE category;
DROP TABLE supplier;
DROP TABLE address;
DROP TABLE attachments;
DROP TABLE people;

create table people
(
    PersonID       int auto_increment
        primary key,
    FullName       varchar(50) not null,
    LogonName      varchar(50) not null,
    HashedPassword blob        not null,
    IsSystemUser   tinyint     not null,
    Role           varchar(50) not null,
    PhoneNumber    varchar(20) not null,
    EmailAddress   varchar(50) not null,
	DateOfBirth	   date		   null,
    Photo          blob        null,
    LastEditedBy   int         not null,
    constraint EmailAddress
        unique (EmailAddress),
    constraint LogonName
        unique (LogonName)
);

create table content
(
    ContentID int auto_increment
        primary key,
    Section   varchar(50) not null,
    HTML      longtext    null,
    UpdDt     datetime    not null,
    LastEditedBy  int          not null,
    constraint PersonLastEditedContent
        foreign key (LastEditedBy) references people (PersonID)
);

create table attachments
(
    AttachmentID  int auto_increment
        primary key,
    AlternateText varchar(250) null,
    FileLocation  varchar(250) not null,
    LastEditedBy  int          not null,
    constraint PersonLastEditedAttachment
        foreign key (LastEditedBy) references people (PersonID)
);

create table address
(
    AddressId    int auto_increment
        primary key,
    Address      varchar(250) not null,
    Zipcode      varchar(50)  not null,
	City		 varchar(50)  not null,
    PersonId     int          not null,
    LastEditedBy int          not null,
    constraint `Person Address`
        foreign key (PersonId) references people (PersonID),
    constraint PersonLastEditedAddress
        foreign key (LastEditedBy) references people (PersonID)
);

create table category
(
    CategoryID     int auto_increment
        primary key,
    CategoryName   varchar(50) not null,
    LastEditedBy   int         not null,
    ParentCategory int         null,
	AttachmentID int (11) not NULL,
    constraint FKcategory218916
        foreign key (LastEditedBy) references people (PersonID),
	constraint Attachments_category
		FOREIGN KEY (AttachmentID) references attachments(AttachmentID)
);

create table content_category
(
    ContentCategoryID int auto_increment
        primary key,
    ContentID         int    not null,
    CategoryID        int    not null,
    SeqNum            int(4) not null,
    constraint FK_CategoryID
        foreign key (CategoryID) references category (CategoryID),
    constraint FK_Content
        foreign key (ContentID) references content (ContentID)
);

create table deliverymethod
(
    DeliveryMethodID int(10) auto_increment
        primary key,
    `DeliveryMethodName` varchar(50) null,
    LastEditedBy     int     not null,
    constraint PersonLastEditedDeliveryMethod
        foreign key (LastEditedBy) references people (PersonID)
);

create table paymentmethod
(
    PaymentMethodID   int auto_increment
        primary key,
    PaymentMethodName varchar(50) not null,
    LastEditedBy      int         not null,
    constraint PersonLastEditedPayment
        foreign key (LastEditedBy) references people (PersonID)
);

create table shoppingcart
(
    ShoppingCartID int(10) auto_increment
        primary key,
    ExpirationDate date not null,
    CreationDate   date not null
);

create table customer
(
    CustomerID     int(10) auto_increment
        primary key,
    PersonID       int(10) not null,
    ShoppingCartID int(10) null,
    newsletter     tinyint null,
    constraint CustomerShoppingcart
        foreign key (ShoppingCartID) references shoppingcart (ShoppingCartID)
);

create table specialdeals
(
    SpecialDealID      int auto_increment
        primary key,
    DealDescription    varchar(250) null,
    StartDate          date         not null,
    EndDate            date         null,
    DiscountPercentage int          not null,
    DealCode           int          not null,
    LastEditedBy       int          not null,
    OneTime            tinyint      null,
    Active             tinyint      null,
    constraint PersonLastEditedSpeciialDeal
        foreign key (LastEditedBy) references people (PersonID)
);

create table `order`
(
    OrderID              int auto_increment
        primary key,
    CustomerID           int(10) not null,
    OrderDate             date    null,
    ExpectedDeliveryDate date    null,
    LastEditedBy         int     not null,
    DeliveryMethodID     int(10) not null,
    PaymentMethodID      int     not null,
    SpecialDealID        int     null,
    constraint FKOrder754218
        foreign key (SpecialDealID) references specialdeals (SpecialDealID),
    constraint FKOrder835009
        foreign key (CustomerID) references customer (CustomerID),
    constraint `Order deliverymethod`
        foreign key (DeliveryMethodID) references deliverymethod (DeliveryMethodID),
    constraint `Order paymentmethod`
        foreign key (PaymentMethodID) references paymentmethod (PaymentMethodID),
    constraint PersonLastEditedOrder
        foreign key (LastEditedBy) references people (PersonID)
);

create table supplier
(
    SupplierID               int auto_increment
        primary key,
    SupplierName             varchar(50)  not null,
    PrimaryContactPersonID   int          not null,
    AlternateContactPersonID int          not null,
    SupplierReference        varchar(50)  not null,
    InternalComments         blob         not null,
    WebsiteURL               varchar(250) not null,
    LastEditedBy             int          not null,
    AddressID                int          not null,
    constraint PersonLastEditedSupplier
        foreign key (LastEditedBy) references people (PersonID),
    constraint `PrimaryContact Person`
        foreign key (PrimaryContactPersonID) references people (PersonID),
    constraint `SecondaryContact Person`
        foreign key (AlternateContactPersonID) references people (PersonID),
    constraint `Supplier Address`
        foreign key (AddressID) references address (AddressId)
);

create table stockitem
(
    StockItemId       int auto_increment
        primary key,
    StockItemName     varchar(50) not null,
    SupplierID        int         not null,
    Brand             varchar(50) not null,
    Size              int(10)     null,
    LoadTimeDays      int         null,
    IsChillerStock    tinyint     null,
    BarCode           varchar(50) not null,
    TaxRate           int         not null,
    UnitPrice         int         not null,
    MarketingComments blob        null,
    CategoryID        int         not null,
	AttachmentID	int(11)		 not null,
    LastEditedBy      int         not null,
    constraint `StockItem Category`
        foreign key (CategoryID) references category (CategoryID),
    constraint `StockItem Supplier`
        foreign key (SupplierID) references supplier (SupplierID),
	constraint Attachments_stockitem
		FOREIGN KEY (AttachmentID) references attachments(AttachmentID)
);

create table order_stockitem
(
    orderStockItemId int(10) auto_increment
        primary key,
    OrderID          int not null,
    StockItemID      int not null,
    constraint OrderOrderStockItem
        foreign key (OrderID) references `order` (OrderID),
    constraint StockitemOrderStockitem
        foreign key (StockItemID) references stockitem (StockItemId)
);

create table shoppingcart_stockitems
(
    ShopStockID    int(10) auto_increment
        primary key,
    ShoppingCartID int(10) not null,
    StockItemID    int     not null,
    constraint ShoppingCartShoppingCart_StockItems
        foreign key (ShoppingCartID) references shoppingcart (ShoppingCartID),
    constraint Shoppingcart_StockitemsStockitem
        foreign key (StockItemID) references stockitem (StockItemId)
);

INSERT INTO `people` VALUES ('1','ADMIN','ADMIN','1d89f8671a326456df5e5e0ec59fb3f7c4d2302b','1','ADMIN','267.061.5879x188','zemlak.weston@example.net','2004-02-11','/0eaa737605e66326caa25c6eb494f304.jpg','0'),
('2','Sebastiaan Leeflang','sleeflang','bededa2a1f731d4a03f80d43ec02e4a62b57a254','1','','584.964.6466x641','reichert.hobart@example.org','2004-02-11','/7291ed71b86670fd0b4bb752b1640283.jpg','0'),
('3','Dennis van t Hul','dhul','41fc06c88034d355baedbff2c7a028aae901c7fb','1','','09390707474','melvina.cremin@example.net','2004-02-11','/273c1b6f9a97e33e88424d35a4659d66.jpg','0'),
('4','Raymon Knol','rknol','56d2945f0fb7ffa17dcc43f7a141e5e6632fdfb1','1','','503-071-8642x88669','skunze@example.com','2004-02-11','/741bf75d44f221964118e594192de402.jpg','0'),
('5','Niels Meijer','nmeijer','3c27065a775b9a1775a9c8e3dc87cfd0e01d3d52','1','','(218)999-9595','bbogisich@example.net','2004-02-11','/79b07fc56af48a99fb3f8d8269342ab3.jpg','0'),
('6','Sven Kats','skats','26c79145e59e3dc422bc27c7bce090eabfb22ea2','1','','(711)663-7751','carmel30@example.net','2004-02-11','/b0b6ea848eba7fc28a5268135568db2c.jpg','0'),
('7','Jaimee-Lee Kleeman','jkleeman','73cb81e127f571c9bbb86ebcbd604a5d0f21ee61','1','','841.418.6879x0830','htromp@example.net','2004-02-11','/417fb16ca3f63126a57abb34ec94f6cf.jpg','0'),
('8','Clovis Rutherford','Maryjane','a662d6e1ae865079f0f7837a50ee14a2bafb4083','0','','371-356-0603x11441','myah44@example.org','2004-02-11',NULL,'0'),
('9','Katheryn VonRueden','Kaylee','08c41561e25a4042511c397c674c8b1339ad0c1d','0','','1-393-587-8660','wolff.garrett@example.net','2013-07-22',NULL,'0'),
('10','Millie Powlowski','Austin','eebd0e29c9c3f4b5b2b0b563e62a396e691d1703','0','','208.534.2112x735','jeramie79@example.net','2014-10-20',NULL,'0'),
('11','Prof. Unique Cartwright','Tyler','4e19d4bb86bb855e459036ca549272cd5bd68f23','0','','1-950-130-4292','lpouros@example.com','1992-02-05',NULL,'0'),
('12','Kacie Maggio','Frederique','f0cecb8ea16329c93fbd15ac307aa7e26ff3d6c5','0','','218-684-3182','laurine.kiehn@example.net','1997-06-16',NULL,'0'),
('13','Dr. Dayton Leuschke II','Chauncey','aa8b655e5c8385d305571b36b25fd449c91d7b68','0','','09388256789','emitchell@example.com','1979-06-11',NULL,'0'),
('14','Mr. Santos Anderson IV','Sandra','159202ef7d4b41d99982158253dccadd10214ce1','0','','(987)774-3532x1917','dach.juston@example.com','2009-11-27',NULL,'0'),
('15','Grace Kerluke','Bertrand','4f91903cecec1397128370dd12948ad5a0a9672b','0','','05156347989','mshanahan@example.org','2016-12-12',NULL,'0'),
('16','Orval Stracke','Jeramie','115353fef29ca2c428e1d7ef5fa745aa88eaecea','0','','831-365-9560x3798','huel.eliane@example.org','2015-02-19',NULL,'0'),
('17','Luciano Schuppe','Edwardo','463d39c11d773cc344b0fa58070943a8391bb120','0','','(381)216-7977','brau@example.org','1982-07-25',NULL,'0'),
('18','Kirk Altenwerth Jr.','Juanita','1e31b599fb9fceb557dc39a19d3eacafd3039049','0','','+57(9)4137837291','rowe.cameron@example.org','1991-04-18',NULL,'0'),
('19','Muriel Hahn','Griffin','179ec77f34017a970e995dbb784d9fd5ec91e935','0','','1-841-575-9531x9631','witting.wendell@example.org','2010-12-05',NULL,'0'),
('20','Dana Zemlak','Keenan','24c150657eaa7e0af29bd9976816c4c89d480697','0','','1-646-703-4153','igibson@example.com','2003-01-09',NULL,'0'),
('21','Cesar O\Conner','Jarred','1b5d17062c83586522f2310dde643aab34c52584','0','','999.059.9134x893','ysmitham@example.org','2010-08-04',NULL,'0'),
('22','Prof. Crawford Simonis V','Neva','e166019b2596f8e249dd3018f382e8af5a1ec6ba','0','','(245)584-0430x196','beau.braun@example.org','1993-07-30',NULL,'0'),
('23','Jakayla Ledner','Ofelia','07deb5a086c448b3bfa804edc63d85c45eb9585f','0','','1-102-316-4166','ecollins@example.org','2015-01-09',NULL,'0'),
('24','Miss Greta Wiegand DDS','Nova','57f8348ea4d6f8ffa7404653fe65fe41e929c2b8','0','','190.399.7269','herta.harris@example.net','1975-10-04',NULL,'0'),
('25','Aracely Schaefer','Dannie','ffd78933ea19b3f0e9e034e1297a9ab26711a4e9','0','','629.199.7041x70581','jerrell77@example.org','2002-07-19',NULL,'0'),
('26','Bria Lebsack','Winona','c93d8ee968d13f4ee313f4620bfa3ff71b9465be','0','','1-697-895-8821x757','tiffany78@example.net','2013-08-29',NULL,'0'),
('27','Marielle Rau','Brandy','ef6f941e096641543aad5a89b033e66769a2df1f','0','','996-189-9618','xrolfson@example.com','1999-12-10',NULL,'0'),
('28','Prof. Adolph Wunsch','Millie','a5e2adad9c2379269b13d4e019ffc91e465bfe01','0','','06741028693','thaddeus.green@example.org','2001-09-08',NULL,'0'),
('29','Mauricio Mayert IV','Lucinda','59f7c75eeea49ab303ea8f761aaf60cd6431af1e','0','','(683)914-3854x54736','hrolfson@example.com','1991-02-01',NULL,'0'),
('30','Sammie Corkery','Rose','41d3b4c16787258c5b443718ff2de655b45b8e61','0','','01552031339','ubecker@example.org','1996-08-31',NULL,'0'),
('31','Mrs. Dana Gaylord Jr.','Janice','55a06fc1253317235b062182d8776a903537824d','0','','024-622-9221x413','abigail.nader@example.com','1996-08-13',NULL,'0'),
('32','Dr. Omari Predovic PhD','Vincenza','64424dad639fa7a074e2f545cc4bdd94735cb3ec','0','','(140)407-5484x57408','zieme.luigi@example.org','1987-09-17',NULL,'0'),
('33','Verdie Quigley','Gregorio','c9a5c32f3a2c6c780e94329435e3e4d212639b64','0','','1-822-214-3714x51562','celestine52@example.net','1979-08-29',NULL,'0'),
('34','Herminio Dietrich Sr.','Nina','d08a95aeecc111f99cd88f601e4a11de563a7532','0','','08335047496','mckenna02@example.net','1990-04-08',NULL,'0'),
('35','Yesenia Casper','Justine','d5ff506f3b63b17c99a71ee6d24adc4652fd199c','0','','1-694-127-1541','nreichel@example.org','2017-03-17',NULL,'0'),
('36','Lane Nicolas I','Maggie','82dd7cf71408f8212a60eb36dc310cbdb0ca2503','0','','1-731-118-2531','merlin44@example.com','2012-10-25',NULL,'0'),
('37','Monroe Trantow','Alexzander','73e1025daf1b40b64993be6ab3ebcbc59680d7f8','0','','05174747256','adolphus.wolff@example.net','1991-01-06',NULL,'0'),
('38','Oswald Lebsack Sr.','Ashlynn','8c8bf37be26144131398eafb50734274f6557c3c','0','','911.613.2785x548','kmcclure@example.net','2006-02-01',NULL,'0'),
('39','Mrs. Audra Windler MD','Eulah','7ff0606b32c2b03b0d7cc72b47c086fc0b89801e','0','','091-026-3136','charlie44@example.org','2001-01-23',NULL,'0'),
('40','Darion Nikolaus','Malachi','3becaad5317d3a24ba2aa885f4a0897fb1d50487','0','','083-006-5533x89113','tierra.bins@example.com','2018-04-11',NULL,'0'),
('41','Mr. Darius Orn V','Eriberto','a6752649df2edc833dc96a94033273ebf6ade366','0','','499.148.2695x8154','wehner.mya@example.com','1998-09-27',NULL,'0'),
('42','Brando Braun','Dante','ea4680d28bc662a83861f5d2950df4cdb0893dcb','0','','488-556-9397','cgaylord@example.net','1994-11-12',NULL,'0'),
('43','Madilyn Lebsack Jr.','Arnulfo','23b51b5847b4b81a9327e458e781fffd7c007bea','0','','1-776-879-9087','weissnat.herbert@example.net','2003-11-19',NULL,'0'),
('44','Griffin Rohan','Carlos','5d6d408706429e74f198edecf47e2da46f50accf','0','','522.730.1599','cfay@example.com','1992-08-18',NULL,'0'),
('45','Prof. Morgan Thiel','Sonny','8aa1d85c7a39ad3b00ea2730af4dcb4d51659783','0','','(940)961-3032x86454','gutmann.zack@example.org','2007-08-12',NULL,'0'),
('46','Joanie Little','Emmitt','5588925bf57ac700b0fcc141b3703142b20bb255','0','','+06(3)0833806971','shanahan.art@example.com','2000-04-18',NULL,'0'),
('47','Austin Jakubowski','Layne','e97b06bdd5aeddbe3db2fb3116899e7f8a498e90','0','','518.991.1705','neil.jacobson@example.com','2005-08-20',NULL,'0'),
('48','Kacie Bahringer','Aaliyah','fa39304afaef1d2fa59d51d5690c375802f0bb4d','0','','833.839.5205x102','tatum96@example.org','1985-08-08',NULL,'0'),
('49','Teagan Batz','Bobby','f463cb6a418176e031522592642d7bdcef770c3a','0','','08124251246','bahringer.glen@example.net','2008-12-17',NULL,'0'),
('50','Nicola Berge','Shanny','b265663ec8f5b48d3b26e6bda1658fc6040e8a38','0','','1-493-917-5716x756','kling.cornelius@example.net','2006-05-15',NULL,'0'),
('51','Dr. Virgie Hodkiewicz PhD','Lorine','c52caaf73beaf5abe8441afd074b47b304f8e737','0','','1-148-892-4056x062','ygrimes@example.com','2010-08-22',NULL,'0'),
('52','Grady Ritchie','Fred','9fdd1ae24867d0daeb80e50c18cf7f7166958934','0','','685-648-5312x535','akeem.ferry@example.com','1971-07-03',NULL,'0'),
('53','Genesis Wilderman','Bria','fe629fccd5d4f671efed878769b51b237e382384','0','','356.354.0661x67296','mikayla30@example.net','1973-10-04',NULL,'0'),
('54','Josephine Padberg','Demarco','42124357c2e0f3f48280e8abf6bca499fcb18f41','0','','+83(3)0369070985','violet.terry@example.net','1980-12-14',NULL,'0'),
('55','Anibal Streich','Sterling','2a3a0b099aa08e8755d17b148105d17197e2b4f6','0','','(183)234-9065','emma.dibbert@example.com','1987-08-06',NULL,'0'),
('56','Aric Sanford','Skyla','e854b03f5d9d2dcf8b98154833664c02496b1d1e','0','','(975)471-2086x88177','lambert.zemlak@example.com','1979-06-24',NULL,'0'),
('57','Prof. Carmine Hahn MD','Eda','258512931bd3e3aec39d76e5ae90da75e7aa46fa','0','','07940268433','kiehn.chelsea@example.com','1983-10-29',NULL,'0'),
('58','Halie Carter','Mabelle','4c7e3197532ec4f625e7ce1c333f5c6cceb319f4','0','','002.030.3344x5094','srunolfsson@example.net','2001-02-06',NULL,'0'),
('59','Shayna Tillman','Layla','ed91e7ebe313eb8d0c740d0e385676a894402ce8','0','','589-133-1660x995','deontae.pfeffer@example.com','2013-12-30',NULL,'0'),
('60','Dr. Jessie Zulauf II','Carleton','9e7bb1ebb52a6fb98620ac9ad8729f3115c23728','0','','+42(1)2374117344','bauch.kaelyn@example.net','2015-11-18',NULL,'0'),
('61','Mrs. Mercedes Spinka','Eldon','a07e3101577e1ea7f9823c4a2bd88814f7414478','0','','945.166.9344x551','rohan.marley@example.org','1996-08-06',NULL,'0'),
('62','Elbert Schumm Sr.','Graham','cb6a96030e967ccf17e94079b1f36c06758721af','0','','(491)782-8001x26046','dariana.lockman@example.com','1991-11-20',NULL,'0'),
('63','Dayna Dietrich','Carole','6580f3ecae3ef334fc8c45018813f701b605a878','0','','+15(9)5600797082','demarco90@example.net','2004-08-03',NULL,'0'),
('64','Cleveland Ziemann','Shana','9ab9cb260c97f66a4cc6d9a3a94610b777ff8c00','0','','1-591-746-7455x4787','ebba.kozey@example.org','1976-10-18',NULL,'0'),
('65','Adolph Ondricka','Eliane','5bfba5eb648741ebddd690274d5c127871400e49','0','','01037500326','steuber.liana@example.net','1972-03-15',NULL,'0'),
('66','Ursula Bartoletti','Camryn','33371b8c74df79b94318d168efcd0501e00c53ae','0','','678-719-7852','dereck.legros@example.net','1993-10-21',NULL,'0'),
('67','Marisol Powlowski','Darien','91e90e1baa38193a02e85c565a8625ddf6c329a8','0','','242-205-1202x595','makayla42@example.com','1999-10-22',NULL,'0'),
('68','Dr. Nelda Streich I','Julianne','547239ec87bf1c748bce257656c741fedb63b307','0','','04937012274','johanna10@example.net','2018-06-13',NULL,'0'),
('69','Jacquelyn Luettgen','Philip','e525921a6f1376c3252786fc0206f19220c17d4a','0','','(585)739-7634','zstiedemann@example.com','2017-08-08',NULL,'0'),
('70','Amir McCullough','Megane','d5a53eab8ef914dd8afad33350ec9a626ffde7e4','0','','063-894-4809x86558','davion.stiedemann@example.org','1982-03-13',NULL,'0'),
('71','Maude Bechtelar','Jazmin','86449f20037607bf0246c03f40d05f6baf36c558','0','','216-824-1205','jarod81@example.org','1987-12-29',NULL,'0'),
('72','Jovani Larson','Domenica','5b2ab224c42eb0fa0f0a221507b3ce668d997eb2','0','','1-740-319-3253','angus.wunsch@example.org','1973-11-01',NULL,'0'),
('73','Ms. Audreanne Wilderman','Jovanny','d4ffb312dabc8a8b6065598202c4c9eb24d081ba','0','','06700423168','thaddeus.eichmann@example.com','1975-06-20',NULL,'0'),
('74','Carmela Hackett','Shanel','5e2fab85515614c80427f0102f40f35c022310e1','0','','948-322-4543x78658','ohagenes@example.com','1989-03-14',NULL,'0'),
('75','Miss Gabriella Lemke','Gabrielle','3d39ad93cfb165cab3ffe9a2144f679642e21a49','0','','000.202.8502x85712','erika.o\'keefe@example.com','1981-07-06',NULL,'0'),
('76','Clarabelle Bahringer','Amparo','f1e8cbba1c3adada4967f8e945c1e36a473f9419','0','','1-268-650-5858','gerhold.lawrence@example.com','1976-09-11',NULL,'0'),
('77','Russel Schoen','Mabel','9e936988c5d0cc4bfa1c4c07bbedccb67c22bc77','0','','234-121-7675x37187','ellen80@example.com','2013-11-03',NULL,'0'),
('78','Reina Ritchie V','Ima','6ef8543deb88ba2d5a8eb93189cd4b685f5917ea','0','','127-040-6453','mekhi62@example.net','1977-10-05',NULL,'0'),
('79','Imogene Schuppe Jr.','Darlene','2bdbe7cea57c7dee32daea9a7488192da9841b56','0','','(901)836-9211x523','bernier.boris@example.net','1970-01-03',NULL,'0'),
('80','Dr. Hans Durgan V','Karelle','b0690e144741b6d33d651966e8d5b5ee3d5d355b','0','','(055)775-8648x922','runolfsdottir.javon@example.org','2001-10-08',NULL,'0'),
('81','Lenore Gleichner','Dee','8e62ed4424ee655695c4b4f28d660dd7f0f2841b','0','','(523)333-0590x774','leuschke.malcolm@example.net','2008-07-14',NULL,'0'),
('82','Peggie Ritchie DDS','Issac','37f5d049e9a1e41c2af2653beb88f71654530ae5','0','','03010517932','estefania.quigley@example.net','1990-07-25',NULL,'0'),
('83','Alexandrine Rowe PhD','Tristin','fa84b085d141b049d0f674378f33cc6f81b40aba','0','','1-843-306-7152x6672','bzboncak@example.org','1980-01-07',NULL,'0'),
('84','Ms. Antonette Hodkiewicz','Luella','65c8bce534e7a986c9322891bfdbebf9bd108631','0','','734.478.9991x776','erolfson@example.org','1974-06-27',NULL,'0'),
('85','Raphael Gulgowski','Meggie','5e3be5c80d424e7606750f3451e39f6cdcf04a28','0','','(567)771-2869x4387','adela80@example.com','1988-04-20',NULL,'0'),
('86','Odell Stiedemann V','Chance','2399b465f7fa071eebea347b30cac27a1ba6f3e2','0','','1-426-295-5154x51014','vrau@example.org','2019-01-29',NULL,'0'),
('87','Eulah King','Ceasar','c4d6534b4d7ead15132adbced866fdea5220df40','0','','+25(9)2353804523','bertha.kuvalis@example.com','2004-03-09',NULL,'0'),
('88','Dr. Alexis Torphy','Brannon','848a6a1f7bc838e54637af38180a79f757b9ec44','0','','(405)591-5044x45064','ocarter@example.org','2010-05-23',NULL,'0'),
('89','Shyann O\'Reilly','Lenore','fbdf06c32c8ea30c50d49b3672cae653316f142b','0','','+69(2)2032389341','xferry@example.org','2008-12-14',NULL,'0'),
('90','Prof. Sophia Hartmann','Leatha','dc88adc7e92449f4bfbcebfe12a01a71f9d4aa75','0','','(996)597-4068x11730','favian36@example.net','1981-08-18',NULL,'0'),
('91','Shayna Erdman','Savion','24d04fbe2501b308311da231affdf6d875a7f303','0','','136.036.7719x419','mya07@example.org','1998-04-15',NULL,'0'),
('92','Calista Russel','Alfonzo','b592183d95ce067fd3dddec65b92a3c7cc45e3ea','0','','+74(8)0852520060','mauricio.reinger@example.net','1972-12-14',NULL,'0'),
('93','Dr. Cory Keebler','Korbin','055cea9c346523ce01a61ffcd272eded10a588bf','0','','(824)773-5038x3179','nader.delta@example.com','2005-06-05',NULL,'0'),
('94','Mr. Dameon Fisher I','Skye','fe2c6ef964837cf91f361dceab2e415d33627d5e','0','','476-133-5126x3613','smith.maxwell@example.com','1983-07-21',NULL,'0'),
('95','Pat Wiza DDS','Celestine','ef9702b44587541e0f9762bd086e5d3717469482','0','','355.250.6350x641','ushields@example.org','1980-09-19',NULL,'0'),
('96','Meda Satterfield V','Emilio','c7ddfaf08b572a194af8dee806e62b53a4e47328','0','','209.810.9885x87607','colleen.rath@example.net','2011-09-10',NULL,'0'),
('97','Danyka Erdman','Edd','cfa35452ea85da4505b260c7c967823914be2af3','0','','1-763-135-9689x44571','lizzie.weissnat@example.net','1974-12-03',NULL,'0'),
('98','Kay Von','Destinee','edfdf59efee0ed03924edc6dc8462f1c28646078','0','','+61(8)4082554025','nhills@example.com','1977-06-29',NULL,'0'),
('99','Rosalind McClure','Marie','cfa59ed56aa7d6a1d3ffd57b96e0abf1a1a84a0d','0','','00818836333','howell.nikki@example.net','1986-01-04',NULL,'0'),
('100','Neil Bins','Trey','13158bafc3151b05547093ba5755cfc2413359b4','0','','(507)503-4627x85497','brown.hardy@example.com','1999-09-26',NULL,'0');

INSERT INTO `attachments` VALUES ('1','harum','/b7b76dd70cd99ee026a8813e086be949.jpg','1'),
('2','rerum','/3cc5f4031968a1a3e77ec879bbd31ce5.jpg','2'),
('3','beatae','/026cca3cc20bb8165b33b55f004c212a.jpg','3'),
('4','et','/9ae63f5b672fb0bb3b9e06996c9b62d9.jpg','4'),
('5','similique','/29b3d49c60a2924cd8ace7f3c2013f6e.jpg','5'),
('6','dolorem','/b0f46f43a64de775ecb21566f854476b.jpg','6'),
('7','est','/b6d0cc0f3b9f7d6cb8b2456409f0a71b.jpg','7'),
('8','quasi','/9b0f8366d1b1c390900725ff102b709f.jpg','1'),
('9','et','/5e74dc509da722ac7b13187a9720facd.jpg','2'),
('10','id','/791dc8285186c4718faa670716fab210.jpg','3'),
('11','possimus','/4f4a62f4295c712369812599825636aa.jpg','4'),
('12','et','/2e58ba9420cd4ea0e40c5ee695e0e349.jpg','5'),
('13','accusamus','/0b0d2ce835f9e0004f054ca3e1f2247f.jpg','6'),
('14','sed','/d9cc1f357aa57379e7ded7460681ea8f.jpg','7'),
('15','et','/9a46ddf486702f27395e5db99dee71d9.jpg','1'),
('16','fuga','/25928837013aab7dd4494a5147be96dd.jpg','2'),
('17','fugiat','/d07b68d79579f68be709b71ef04e93e8.jpg','3'),
('18','recusandae','/c42c49e5158adb7a916787ee61f1a3a5.jpg','4'),
('19','deleniti','/cda301775f57e23d8e2df513fca62be2.jpg','5'),
('20','vel','/23f322a137dc658e762c18c8162c5ad7.jpg','6');


INSERT INTO `address` VALUES ('1','4806 Landen Knolls Suite 565\nWest Holliehaven, KS 31995','81337','New Liam','1','1'),
('2','025 Lincoln Inlet Apt. 677\nHarrisfort, AR 63201','71628-2526','Adolfoborough','2','2'),
('3','65841 Tamia Loaf\nTroyburgh, MS 17918','42339','New Leatha','3','3'),
('4','080 Kunde Fall Suite 053\nNew Marisaborough, NJ 82731','04121','West Alfonso','4','4'),
('5','7734 Annamae Shore\nBatzton, NE 02074','42674','Lake Cletafurt','5','5'),
('6','6628 Homenick Spurs\nHerzogside, WV 32578-3851','32160-2099','East Adalinemouth','6','6'),
('7','975 Hills Court\nJettview, WY 79323','16224','West Wilfredo','7','7'),
('8','49839 Manuel Cove Apt. 380\nVonRuedentown, OK 82856','10468','Port Eulahtown','8','8'),
('9','3975 Trevion Mountain Suite 423\nOtisbury, NE 79731','57405','Alexville','9','9'),
('10','30600 Geovanni Common Apt. 729\nNew Venastad, CT 91544','87371-4878','South Katelin','10','10'),
('11','73328 Eduardo Parkway\nWest Keely, OH 52391','05682-7253','Schoenchester','11','11'),
('12','8833 Boyer Shoals Apt. 870\nConcepcionshire, VA 01027-8633','67057-4930','New Marilie','12','12'),
('13','27185 Brant Overpass Suite 666\nLake Carmen, VT 31760-3293','63696-5798','Stromanburgh','13','13'),
('14','9619 Gorczany Station Apt. 014\nGonzalobury, OH 00340-1096','84697-0446','Corneliusstad','14','14'),
('15','84119 Bradtke Route Apt. 974\nKingberg, NC 14121','85203-4107','Port Berylberg','15','15'),
('16','721 Maymie Ridge\nParisianland, RI 50543-4315','27484','West Tito','16','16'),
('17','856 Sandrine Light Apt. 777\nSouth Marleemouth, UT 59508','79335','Cathryntown','17','17'),
('18','747 Ruth Flats\nLake Michael, FL 86251','13630','Tavaresborough','18','18'),
('19','261 Loma Station\nNorth Molliebury, IA 81257-0648','36354','Port Kirsten','19','19'),
('20','885 Leatha Run\nNorth Margarete, NJ 15332-7900','07878','Kautzerbury','20','20'),
('21','932 Heller Well Apt. 235\nLake Bettye, ME 54630','93604','Hilllberg','21','21'),
('22','87675 Edward Wells Apt. 318\nBernhardside, NC 53693-5578','55977-9980','Lake Cletustown','22','22'),
('23','6450 Shawn Street\nEast Rebeca, DE 64387','71164-9417','Port Amirashire','23','23'),
('24','049 Bethel Plaza\nNew Lexiside, SD 37204-4013','80008-4129','Andersonfurt','24','24'),
('25','30301 Huels Ridges Suite 699\nSouth Joy, NY 44554-4658','45729','Port Alekshire','25','25'),
('26','634 Augustine Cliffs Suite 245\nMacyland, MS 25305','38532-3991','South Malcolm','26','26'),
('27','41113 Fay Isle Apt. 816\nEast Sven, VA 65225-6729','05225','Lake Alisha','27','27'),
('28','147 Bartell Canyon\nElliestad, SC 62135-6473','97601','Brownfort','28','28'),
('29','1781 Alvena Course Apt. 916\nVolkmantown, NC 40933-4334','10663','Ernserhaven','29','29'),
('30','696 Yasmine Squares\nNorth Clair, IA 42416-6408','89678','New Abagailmouth','30','30'),
('31','336 Claudine Plains\nNew Sanfordchester, CA 95067-8838','49145','Harmonyton','31','31'),
('32','2893 Onie Extensions\nPort Sadyefort, LA 56284','17062-5899','West Charleneton','32','32'),
('33','822 Schmidt Stravenue Apt. 862\nMerlemouth, TN 20740-6052','78605','Robertland','33','33'),
('34','123 Barrows Lock Apt. 642\nSouth Jamelstad, PA 40194','01190-2295','Rubymouth','34','34'),
('35','5479 Lockman Mall Apt. 569\nLake Hector, UT 08894','00226','West Jonathan','35','35'),
('36','52040 Kovacek Courts Suite 468\nNew Moises, AL 50211-5546','80529-8288','Heloisemouth','36','36'),
('37','62019 Marquardt Unions\nNorth Cathyland, DC 19407-6556','40108','Wisokystad','37','37'),
('38','732 Lakin Track Apt. 499\nMarjolaineton, WA 70505','93382-3320','Goyetteside','38','38'),
('39','202 Curt Divide Suite 907\nWest Arvilla, MO 21802-7065','89764','Sabrynaton','39','39'),
('40','003 Santino Turnpike\nBeatricetown, KS 00242','96498','East Nels','40','40'),
('41','13051 Duncan Ways Suite 520\nSavionberg, AL 81003','82683','East Stefanie','41','41'),
('42','575 Theresa Brooks Apt. 728\nNew Josephmouth, WI 47553-7539','31388','Adamshaven','42','42'),
('43','35764 Turner Ports\nNew Isabellaton, SC 61771-2942','92363','South Riley','43','43'),
('44','7905 Glover Oval Suite 644\nStehrtown, DC 58884-3194','17440-6615','Heathcotebury','44','44'),
('45','38013 Kathleen Streets\nEast Zenastad, NC 88784-1354','24037-2138','North Maeberg','45','45'),
('46','30496 Chadrick Port Suite 347\nMoriahchester, NY 69430-2064','63955','Wymanhaven','46','46'),
('47','84118 Metz Lights Apt. 603\nNew Oscarchester, IN 23838-1483','93981','Toyburgh','47','47'),
('48','64963 Gislason Fords Suite 134\nWest Uliseschester, PA 67579-6897','35811-4373','New Malcolm','48','48'),
('49','747 Annamarie Street\nLake Berniestad, UT 90171','52370-8218','North Camron','49','49'),
('50','7567 Roger Throughway Suite 458\nHellenchester, ID 66687-6231','53950-5070','Volkmanberg','50','50'),
('51','956 McKenzie Junction Apt. 405\nEast Darianchester, DC 42797-2175','37160-1571','West Bellmouth','51','51'),
('52','75541 Lynch Island\nLarkinton, MT 53283','67668','Balistrerimouth','52','52'),
('53','447 Darien Track Suite 453\nJerroldburgh, NE 75137-9235','07249','Okeybury','53','53'),
('54','121 Gladyce Prairie Apt. 167\nTremblayborough, NE 33245','84482-7063','Lake Katherynshire','54','54'),
('55','7226 Johns Course Suite 486\nMuhammadchester, NM 73274','62396-7683','Wisokychester','55','55'),
('56','7751 Grant Ports Suite 596\nFritzchester, CO 97227-5110','82546-8937','West Marinachester','56','56'),
('57','86775 Stoltenberg Grove\nSouth Jettie, IL 36207-3691','22311','Otiliachester','57','57'),
('58','144 Whitney Creek Suite 224\nWest Caryside, KS 39409','55119','South Delfina','58','58'),
('59','77895 Tillman Causeway Apt. 730\nNew Enochside, VT 10105-7180','56443','New Urban','59','59'),
('60','65326 Nyasia Union\nWest Donmouth, PA 44664','69821','Opheliaburgh','60','60'),
('61','0331 Zulauf Lights Apt. 091\nNew Winifredfort, MN 88852','65680','Towneview','61','61'),
('62','99726 Collier Ranch\nDedricmouth, IN 39943-5073','24919','Okeyfort','62','62'),
('63','424 Maybelle Squares\nEast Marcelinoshire, KY 14482','20838-0844','Hillsshire','63','63'),
('64','08368 Gust Island\nLarkinshire, MA 49738','17981','North Josephport','64','64'),
('65','7836 Bergnaum Fields Suite 482\nNew Jake, MD 35606','33816','West Freeman','65','65'),
('66','02468 Schmeler Extensions\nHarveyport, TX 38252-9410','57748','Kassulkeshire','66','66'),
('67','033 Jacobi Mill Suite 700\nPort Dantestad, NJ 89152-2584','01426-8576','Schmidtland','67','67'),
('68','365 Schoen Street Suite 201\nNorth Laverna, VT 45467','01814','Schoenbury','68','68'),
('69','562 Natalie Crossroad\nElijahberg, RI 57675-4317','06423','Deckowmouth','69','69'),
('70','1326 Curt Port\nEast Kayceechester, IL 86613','56154-0201','West Braeden','70','70'),
('71','911 Funk Extensions\nNew Elenastad, AR 10946-3443','41331-0824','Langstad','71','71'),
('72','259 Daryl Island\nNorth Ardithside, OR 42241-0729','32106-5139','Lubowitzchester','72','72'),
('73','508 Nayeli Mews\nClemmieborough, AK 68063-5210','75449-3432','Dietrichton','73','73'),
('74','812 Hills Knolls\nColetown, MS 01317-0876','49344','Sporerstad','74','74'),
('75','8627 Altenwerth Village Suite 584\nNorth Carmelafort, VT 92057','87500-9031','Oletafurt','75','75'),
('76','20956 Toy Parks\nPort Alexandrea, SC 45307','59439','Kriston','76','76'),
('77','48654 Brenda Lights\nCollinsberg, WA 26584','42431','North Lizzie','77','77'),
('78','922 Lauretta Lodge Apt. 742\nNorth Llewellynport, SD 45185','02620-1844','North Prudenceview','78','78'),
('79','42130 Daniel Harbors Apt. 187\nFeilmouth, OH 90952','79147-0125','Leanntown','79','79'),
('80','437 Alejandrin Land\nMaggiostad, KY 69917','58317','Hesselside','80','80'),
('81','9104 Spencer Street\nSouth Monty, NJ 27730','99018','Ratkeshire','81','81'),
('82','5803 Green Drive Suite 750\nHoegermouth, WV 90728-7008','10388-1940','New Milesberg','82','82'),
('83','4894 Grace Lights Suite 729\nLake Lawson, AR 44632','72517-6144','South Lauryn','83','83'),
('84','52815 Stoltenberg Lights\nCalistaton, NH 28031','12587-8323','Nataliemouth','84','84'),
('85','12096 Romaguera Canyon\nPort Nealside, ID 07495','49109','Kennabury','85','85'),
('86','252 Adell Ville\nChetside, TN 78974','02108-1213','Sandrineport','86','86'),
('87','723 Rahsaan Prairie Suite 232\nNorth Maximillia, CT 33730','25690-3995','North Edgardohaven','87','87'),
('88','8369 Emmitt Key\nEast Harryburgh, MT 83039-4632','34032-9021','Rennermouth','88','88'),
('89','660 Nienow Street\nKenyaberg, RI 93975-1979','08356','East Stefanie','89','89'),
('90','0784 Minnie Islands Apt. 859\nHicklestad, SC 16816-0156','93038-2455','West Ernesto','90','90'),
('91','165 Ryan Avenue Apt. 427\nLisettestad, NC 16312-0430','72657','East Calefort','91','91'),
('92','024 Malika Groves Suite 646\nWest Mariettafurt, MN 52336','87834','Saraihaven','92','92'),
('93','8251 Franco Forest Suite 699\nMazieport, UT 22241-4023','49953-9954','North Darion','93','93'),
('94','730 Wilma Squares\nNorth Lisette, OH 88183-5023','40323-6896','North Daniellaland','94','94'),
('95','56216 Tremblay Spur Suite 880\nNorth Victorhaven, NJ 20169-2657','01471-8766','Estrellashire','95','95'),
('96','132 Collins Shoal Apt. 768\nPort Earnestine, VA 10243-5189','08419','Ankundingland','96','96'),
('97','6653 Leffler Flat\nBayerland, KY 47419','66812-8552','O\'Haraside','97','97'),
('98','06433 Spencer Circle Apt. 984\nTannertown, AZ 49250-0952','79801','West Electa','98','98'),
('99','370 Parker Extensions\nHilllport, FL 00365','38739','Lurlineview','99','99'),
('100','35596 Kihn Fords Apt. 590\nNorth Gailton, OH 34551','15967','East Maxwellbury','100','100');


INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `PrimaryContactPersonID`, `AlternateContactPersonID`, `SupplierReference`, `InternalComments`, `WebsiteURL`, `LastEditedBy`, `AddressID`) VALUES (1, 'Public-key zerotolerance methodology', 1, 1, '(666)804-4258x05685', '', 'http://heathcote.com/', 1, 9);
INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `PrimaryContactPersonID`, `AlternateContactPersonID`, `SupplierReference`, `InternalComments`, `WebsiteURL`, `LastEditedBy`, `AddressID`) VALUES (2, 'Automated context-sensitive help-desk', 2, 2, '321.074.1092', '', 'http://www.bauch.com/', 2, 10);
INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `PrimaryContactPersonID`, `AlternateContactPersonID`, `SupplierReference`, `InternalComments`, `WebsiteURL`, `LastEditedBy`, `AddressID`) VALUES (3, 'Seamless upward-trending instructionset', 3, 3, '157-376-8100', '', 'http://www.millerraynor.com/', 3, 11);
INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `PrimaryContactPersonID`, `AlternateContactPersonID`, `SupplierReference`, `InternalComments`, `WebsiteURL`, `LastEditedBy`, `AddressID`) VALUES (4, 'Cloned responsive implementation', 4, 4, '+78(6)8892046588', '', 'http://www.murphysauer.com/', 4, 12);
INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `PrimaryContactPersonID`, `AlternateContactPersonID`, `SupplierReference`, `InternalComments`, `WebsiteURL`, `LastEditedBy`, `AddressID`) VALUES (5, 'Programmable impactful customerloyalty', 5, 5, '1-749-158-2929x3091', '', 'http://www.gaylord.net/', 5, 13);
INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `PrimaryContactPersonID`, `AlternateContactPersonID`, `SupplierReference`, `InternalComments`, `WebsiteURL`, `LastEditedBy`, `AddressID`) VALUES (6, 'De-engineered responsive website', 6, 6, '(618)420-2578', '', 'http://howell.com/', 6, 14);
INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `PrimaryContactPersonID`, `AlternateContactPersonID`, `SupplierReference`, `InternalComments`, `WebsiteURL`, `LastEditedBy`, `AddressID`) VALUES (7, 'Progressive multimedia encryption', 7, 7, '(770)632-7384x04577', '', 'http://www.balistreri.com/', 7, 15);



INSERT INTO `category` VALUES ('1','Hazelnoot','1',NULL, 1),
('2','Melk','2',NULL, 2),
('3','Wit','3',NULL, 3),
('4','Puur','4',NULL, 4),
('5','Brownie','5','2', 5),
('6','Chocoladekruidnoten','6','2', 6),
('7','Chocoladekruidnoten','6','3', 7),
('8','Chocoladekruidnoten','6','4', 8),
('9','Letters','6','2', 9),
('10','Letters','6','3', 10),
('11','Letters','6','4', 11);

INSERT INTO `specialdeals` VALUES ('1','Kerst','2019-11-10','2019-12-25','10','4322','1'),
('2','Valentijn','2020-01-20','2020-02-14','5','2259','2'),
('3','Verjaardag','2020-01-01','2020-12-31','10','1640','3'),
('4','Actie 25','2020-01-01','2020-01-01','25','11','4'),
('5','Moederdag','2020-04-01','2020-05-20','10','6577','5'),
('6','Pasen','2020-01-01','2020-05-01','10','4719','6'),
('7','Vaderdag','2020-05-01','2020-07-01','15','5109','7'),
('8','25 jaar getrouwd','2020-01-01','2020-01-01','0','1683','8');



INSERT INTO `stockitem` VALUES ('1','expedita','1','','5','7',NULL,'3131986986938','0','4',NULL,'1','1','1'),
('2','veritatis','2','','2','29',NULL,'0772583654542','0','9',NULL,'2','2','2'),
('3','quidem','3','','5','24',NULL,'5278453134893','0','2',NULL,'3','3','3'),
('4','sunt','4','','2','22',NULL,'9049250877193','0','7',NULL,'4','4','4'),
('5','aut','5','','5','22',NULL,'9680458434056','0','1',NULL,'5','5','5'),
('6','aut','6','','5','24',NULL,'8601549783359','0','8',NULL,'6','6','6'),
('7','necessitatibus','7','','3','27',NULL,'1103712267231','0','1',NULL,'7','7','7'),
('8','natus','1','','4','3',NULL,'9700977222924','0','1',NULL,'8','8','8'),
('9','fugiat','2','','4','10',NULL,'7998859004573','0','8',NULL,'9','9','9'),
('10','tempore','3','','2','24',NULL,'8983232131167','0','9',NULL,'10','10','10'),
('11','eos','4','','3','19',NULL,'1322005314371','0','7',NULL,'11','11','11'),
('12','adipisci','5','','2','17',NULL,'9301266761126','0','8',NULL,'1','12','12'),
('13','qui','6','','2','10',NULL,'6900123302989','0','3',NULL,'2','13','13'),
('14','rerum','7','','2','19',NULL,'7932693176621','0','2',NULL,'3','14','14'),
('15','tempore','1','','2','2',NULL,'6532218991329','0','1',NULL,'4','15','15'),
('16','qui','2','','5','5',NULL,'8746112391613','0','2',NULL,'5','16','16'),
('17','ipsam','3','','2','15',NULL,'8867734790834','0','9',NULL,'6','17','17'),
('18','eius','4','','2','3',NULL,'9226021985442','0','3',NULL,'7','18','18'),
('19','odit','5','','2','22',NULL,'1044791166308','0','9',NULL,'8','19','19'),
('20','tempora','6','','1','26',NULL,'5432305894100','0','9',NULL,'9','20','20'),
('21','illo','7','','2','17',NULL,'9578883315753','0','4',NULL,'10','1','21'),
('22','deserunt','1','','2','2',NULL,'1697404920905','0','6',NULL,'11','2','22'),
('23','provident','2','','5','19',NULL,'3109949843147','0','5',NULL,'1','3','23'),
('24','velit','3','','1','12',NULL,'4356496603437','0','7',NULL,'2','4','24'),
('25','at','4','','5','27',NULL,'0132142127533','0','4',NULL,'3','5','25'),
('26','vero','5','','2','28',NULL,'8070023077718','0','4',NULL,'4','6','26'),
('27','repellat','6','','5','14',NULL,'5313873567279','0','9',NULL,'5','7','27'),
('28','in','7','','5','26',NULL,'1534336241435','0','8',NULL,'6','8','28'),
('29','quas','1','','3','30',NULL,'6012999409607','0','4',NULL,'7','9','29'),
('30','vel','2','','3','21',NULL,'4358125862970','0','2',NULL,'8','10','30'),
('31','molestiae','3','','1','10',NULL,'2073584138139','0','9',NULL,'9','11','31'),
('32','excepturi','4','','5','8',NULL,'8365403694778','0','6',NULL,'10','12','32'),
('33','numquam','5','','1','21',NULL,'9099374186411','0','7',NULL,'11','13','33'),
('34','molestias','6','','1','27',NULL,'7213968445254','0','2',NULL,'1','14','34'),
('35','nobis','7','','1','9',NULL,'7198162510253','0','6',NULL,'2','15','35'),
('36','ut','1','','1','3',NULL,'7456092334586','0','5',NULL,'3','16','36'),
('37','voluptas','2','','5','17',NULL,'0730521852597','0','4',NULL,'4','17','37'),
('38','aspernatur','3','','3','7',NULL,'1726773567753','0','7',NULL,'5','18','38'),
('39','optio','4','','2','15',NULL,'7738175310855','0','1',NULL,'6','19','39'),
('40','quidem','5','','2','13',NULL,'8857337006852','0','7',NULL,'7','20','40'),
('41','ducimus','6','','4','7',NULL,'2023527858211','0','6',NULL,'8','1','41'),
('42','harum','7','','2','25',NULL,'7753172244552','0','9',NULL,'9','2','42'),
('43','harum','1','','4','20',NULL,'4965494012549','0','3',NULL,'10','3','43'),
('44','aspernatur','2','','2','8',NULL,'6275369529293','0','3',NULL,'11','4','44'),
('45','ut','3','','2','7',NULL,'9540915743483','0','8',NULL,'1','5','45'),
('46','praesentium','4','','1','5',NULL,'0000523326595','0','2',NULL,'2','6','46'),
('47','rem','5','','4','20',NULL,'7199368073887','0','6',NULL,'3','7','47'),
('48','earum','6','','4','17',NULL,'6915781890174','0','4',NULL,'4','8','48'),
('49','cumque','7','','1','27',NULL,'3895328650726','0','2',NULL,'5','9','49'),
('50','qui','1','','2','27',NULL,'6125554204323','0','3',NULL,'6','10','50'),
('51','dolor','2','','5','5',NULL,'1196094102337','0','8',NULL,'7','11','51'),
('52','ut','3','','2','11',NULL,'8102076115731','0','9',NULL,'8','12','52'),
('53','laudantium','4','','2','22',NULL,'2934601494389','0','2',NULL,'9','13','53'),
('54','unde','5','','5','13',NULL,'6251187558912','0','1',NULL,'10','14','54'),
('55','totam','6','','3','7',NULL,'4599707061149','0','4',NULL,'11','15','55'),
('56','nesciunt','7','','5','24',NULL,'7105650816735','0','4',NULL,'1','16','56'),
('57','autem','1','','4','5',NULL,'9046380495693','0','3',NULL,'2','17','57'),
('58','a','2','','3','14',NULL,'5733520189621','0','2',NULL,'3','18','58'),
('59','ducimus','3','','2','17',NULL,'8523620893507','0','7',NULL,'4','19','59'),
('60','quia','4','','4','1',NULL,'8930338895424','0','5',NULL,'5','20','60'),
('61','esse','5','','2','21',NULL,'6144063743932','0','4',NULL,'6','1','61'),
('62','exercitationem','6','','1','8',NULL,'2033561030894','0','3',NULL,'7','2','62'),
('63','reiciendis','7','','3','29',NULL,'7863009990535','0','5',NULL,'8','3','63'),
('64','quia','1','','4','7',NULL,'4701568518612','0','9',NULL,'9','4','64'),
('65','suscipit','2','','3','30',NULL,'6261142940713','0','2',NULL,'10','5','65'),
('66','omnis','3','','4','20',NULL,'0531781416716','0','8',NULL,'11','6','66'),
('67','laudantium','4','','5','22',NULL,'5545344112040','0','9',NULL,'1','7','67'),
('68','sapiente','5','','1','10',NULL,'2134844193067','0','9',NULL,'2','8','68'),
('69','maiores','6','','2','10',NULL,'7985679998779','0','6',NULL,'3','9','69'),
('70','voluptates','7','','4','20',NULL,'5550139481898','0','2',NULL,'4','10','70'),
('71','vel','1','','3','26',NULL,'1517010159417','0','10',NULL,'5','11','71'),
('72','et','2','','1','9',NULL,'9294661268690','0','7',NULL,'6','12','72'),
('73','ducimus','3','','5','15',NULL,'3276264170767','0','3',NULL,'7','13','73'),
('74','magnam','4','','4','8',NULL,'4592996299323','0','4',NULL,'8','14','74'),
('75','commodi','5','','3','5',NULL,'2451675518051','0','7',NULL,'9','15','75'),
('76','est','6','','1','25',NULL,'8909167086976','0','6',NULL,'10','16','76'),
('77','sunt','7','','4','8',NULL,'0753218395832','0','9',NULL,'11','17','77'),
('78','consequatur','1','','3','10',NULL,'2241047931072','0','8',NULL,'1','18','78'),
('79','sequi','2','','1','4',NULL,'9961178950713','0','6',NULL,'2','19','79'),
('80','nihil','3','','4','6',NULL,'3021718819934','0','9',NULL,'3','20','80'),
('81','aperiam','4','','5','10',NULL,'6457367267135','0','4',NULL,'4','1','81'),
('82','deserunt','5','','2','4',NULL,'9171297595584','0','5',NULL,'5','2','82'),
('83','ea','6','','3','5',NULL,'9353326562501','0','7',NULL,'6','3','83'),
('84','laborum','7','','2','20',NULL,'6250213780600','0','1',NULL,'7','4','84'),
('85','deserunt','1','','4','2',NULL,'7145488520329','0','7',NULL,'8','5','85'),
('86','rerum','2','','1','2',NULL,'9192835968424','0','1',NULL,'9','6','86'),
('87','eum','3','','3','3',NULL,'3184807881769','0','9',NULL,'10','7','87'),
('88','dolore','4','','1','28',NULL,'3340410962046','0','6',NULL,'11','8','88'),
('89','et','5','','5','21',NULL,'0977174399813','0','3',NULL,'1','9','89'),
('90','commodi','6','','3','8',NULL,'8253701135676','0','3',NULL,'2','10','90'),
('91','libero','7','','3','29',NULL,'9608634899499','0','3',NULL,'3','11','91'),
('92','labore','1','','4','26',NULL,'6996212881473','0','9',NULL,'4','12','92'),
('93','dolorum','2','','4','25',NULL,'8761920527221','0','6',NULL,'5','13','93'),
('94','autem','3','','4','29',NULL,'0642772118806','0','4',NULL,'6','14','94'),
('95','dignissimos','4','','3','28',NULL,'3979453348564','0','5',NULL,'7','15','95'),
('96','ea','5','','1','17',NULL,'3623308706701','0','9',NULL,'8','16','96'),
('97','consequatur','6','','2','3',NULL,'9051091710805','0','6',NULL,'9','17','97'),
('98','deserunt','7','','3','6',NULL,'1119024083346','0','7',NULL,'10','18','98'),
('99','exercitationem','1','','3','26',NULL,'5986451330215','0','3',NULL,'11','19','99'),
('100','rem','2','','5','6',NULL,'0614957716664','0','8',NULL,'1','20','100');

INSERT INTO `shoppingcart` VALUES ('1','2019-12-31','2019-12-01'),
('2','2019-12-31','2019-11-10'),
('3','2019-12-31','2019-12-02'),
('4','2019-12-31','2019-12-02'),
('5','2019-12-31','2019-11-01');

INSERT INTO `shoppingcart_stockitems` VALUES ('1','1','1'),
('2','2','2'),
('3','3','3'),
('4','4','4'),
('5','5','5'),
('6','1','6'),
('7','2','7'),
('8','3','8'),
('9','4','9'),
('10','5','10'),
('11','1','11'),
('12','2','12'),
('13','3','13'),
('14','4','14'),
('15','5','15'),
('16','1','16'),
('17','2','17'),
('18','3','18'),
('19','4','19'),
('20','5','20'),
('21','1','21'),
('22','2','22'),
('23','3','23'),
('24','4','24'),
('25','5','25'),
('26','1','1'),
('27','2','2'),
('28','3','3'),
('29','4','4'),
('30','5','5'),
('31','1','6'),
('32','2','7'),
('33','3','8'),
('34','4','9'),
('35','5','10'),
('36','1','11'),
('37','2','12'),
('38','3','13'),
('39','4','14'),
('40','5','15');

INSERT INTO `customer` VALUES ('1','1','1',NULL),
('2','2','2',NULL),
('3','3','3',NULL),
('4','4','4',NULL),
('5','5','5',NULL);

INSERT INTO `deliverymethod` VALUES ('1','DHL','1'),
('2','UPC','2');

INSERT INTO `paymentmethod` VALUES ('1','Afterpay','1'),
('2','iDEAL','2'),
('3','CreditCard','3');

INSERT INTO `order` VALUES ('1','1','1984-10-18','2016-01-09','1','1','1',NULL),
('2','2','2006-02-21','2014-08-27','2','2','2',NULL),
('3','3','2018-10-23','1980-08-04','3','1','3',NULL),
('4','4','1970-10-14','1989-11-13','4','2','1',NULL),
('5','5','1982-08-23','2000-10-04','5','1','2',NULL),
('6','1','1991-03-31','2012-05-08','6','2','3',NULL),
('7','2','1983-07-09','2005-08-04','7','1','1',NULL),
('8','3','1981-08-26','1980-12-01','8','2','2',NULL),
('9','4','1970-06-09','2019-09-28','9','1','3',NULL),
('10','5','2014-02-17','1977-02-14','10','2','1',NULL),
('11','1','2006-11-27','1984-09-01','11','1','2',NULL),
('12','2','1995-04-26','2009-08-18','12','2','3',NULL),
('13','3','2008-05-08','1994-07-16','13','1','1',NULL),
('14','4','2011-06-13','1995-11-30','14','2','2',NULL),
('15','5','2019-02-21','1988-11-07','15','1','3',NULL),
('16','1','1981-02-21','2013-04-13','16','2','1',NULL),
('17','2','1981-01-19','2009-08-25','17','1','2',NULL),
('18','3','1990-04-28','2015-11-28','18','2','3',NULL),
('19','4','2001-05-11','1999-02-03','19','1','1',NULL),
('20','5','1971-12-18','2019-07-21','20','2','2',NULL),
('21','1','2018-02-09','2018-09-21','21','1','3',NULL),
('22','2','2016-04-19','1972-10-02','22','2','1',NULL),
('23','3','2018-07-02','2012-05-10','23','1','2',NULL),
('24','4','2004-02-13','1975-02-12','24','2','3',NULL),
('25','5','1970-01-04','1991-09-08','25','1','1',NULL),
('26','1','2014-12-17','2013-03-08','26','2','2',NULL),
('27','2','1974-03-05','1993-03-05','27','1','3',NULL),
('28','3','1975-03-01','2003-08-08','28','2','1',NULL),
('29','4','1999-06-12','1993-01-02','29','1','2',NULL),
('30','5','2000-12-09','2004-01-26','30','2','3',NULL),
('31','1','2016-08-25','1977-06-11','31','1','1',NULL),
('32','2','1990-08-07','2015-02-25','32','2','2',NULL),
('33','3','1978-04-09','2017-12-31','33','1','3',NULL),
('34','4','1989-06-03','1998-03-08','34','2','1',NULL),
('35','5','2006-02-12','2007-01-18','35','1','2',NULL),
('36','1','1976-07-27','1985-01-07','36','2','3',NULL),
('37','2','1986-05-18','1978-07-18','37','1','1',NULL),
('38','3','2004-02-16','1978-12-09','38','2','2',NULL),
('39','4','2014-09-07','1971-05-30','39','1','3',NULL),
('40','5','2017-01-11','2019-04-04','40','2','1',NULL),
('41','1','1989-02-13','2008-11-03','41','1','2',NULL),
('42','2','2000-02-02','1988-05-20','42','2','3',NULL),
('43','3','1989-01-22','1990-07-03','43','1','1',NULL),
('44','4','1996-02-18','1972-01-29','44','2','2',NULL),
('45','5','1998-03-21','1984-12-25','45','1','3',NULL),
('46','1','2017-07-28','2006-07-22','46','2','1',NULL),
('47','2','1994-03-04','1978-03-05','47','1','2',NULL),
('48','3','2000-02-14','2010-04-16','48','2','3',NULL),
('49','4','2017-05-28','1985-11-30','49','1','1',NULL),
('50','5','2017-02-04','2014-05-15','50','2','2',NULL);


INSERT INTO `order_stockitem` VALUES ('1','1','1'),
('2','2','2'),
('3','3','3'),
('4','4','4'),
('5','5','5'),
('6','6','6'),
('7','7','7'),
('8','8','8'),
('9','9','9'),
('10','10','10'),
('11','11','11'),
('12','12','12'),
('13','13','13'),
('14','14','14'),
('15','15','15'),
('16','16','16'),
('17','17','17'),
('18','18','18'),
('19','19','19'),
('20','20','20'),
('21','21','21'),
('22','22','22'),
('23','23','23'),
('24','24','24'),
('25','25','25'),
('26','26','1'),
('27','27','2'),
('28','28','3'),
('29','29','4'),
('30','30','5'),
('31','31','6'),
('32','32','7'),
('33','33','8'),
('34','34','9'),
('35','35','10'),
('36','36','11'),
('37','37','12'),
('38','38','13'),
('39','39','14'),
('40','40','15'),
('41','41','16'),
('42','42','17'),
('43','43','18'),
('44','44','19'),
('45','45','20'),
('46','46','21'),
('47','47','22'),
('48','48','23'),
('49','49','24'),
('50','50','25'),
('51','1','1'),
('52','2','2'),
('53','3','3'),
('54','4','4'),
('55','5','5'),
('56','6','6'),
('57','7','7'),
('58','8','8'),
('59','9','9'),
('60','10','10'),
('61','11','11'),
('62','12','12'),
('63','13','13'),
('64','14','14'),
('65','15','15'),
('66','16','16'),
('67','17','17'),
('68','18','18'),
('69','19','19'),
('70','20','20'),
('71','21','21'),
('72','22','22'),
('73','23','23'),
('74','24','24'),
('75','25','25'),
('76','26','1'),
('77','27','2'),
('78','28','3'),
('79','29','4'),
('80','30','5'),
('81','31','6'),
('82','32','7'),
('83','33','8'),
('84','34','9'),
('85','35','10'),
('86','36','11'),
('87','37','12'),
('88','38','13'),
('89','39','14'),
('90','40','15'),
('91','41','16'),
('92','42','17'),
('93','43','18'),
('94','44','19'),
('95','45','20'),
('96','46','21'),
('97','47','22'),
('98','48','23'),
('99','49','24'),
('100','50','25'),
('101','1','1'),
('102','2','2'),
('103','3','3'),
('104','4','4'),
('105','5','5'),
('106','6','6'),
('107','7','7'),
('108','8','8'),
('109','9','9'),
('110','10','10'),
('111','11','11'),
('112','12','12'),
('113','13','13'),
('114','14','14'),
('115','15','15'),
('116','16','16'),
('117','17','17'),
('118','18','18'),
('119','19','19'),
('120','20','20'),
('121','21','21'),
('122','22','22'),
('123','23','23'),
('124','24','24'),
('125','25','25'),
('126','26','1'),
('127','27','2'),
('128','28','3'),
('129','29','4'),
('130','30','5'),
('131','31','6'),
('132','32','7'),
('133','33','8'),
('134','34','9'),
('135','35','10'),
('136','36','11'),
('137','37','12'),
('138','38','13'),
('139','39','14'),
('140','40','15'),
('141','41','16'),
('142','42','17'),
('143','43','18'),
('144','44','19'),
('145','45','20'),
('146','46','21'),
('147','47','22'),
('148','48','23'),
('149','49','24'),
('150','50','25');

INSERT INTO CONTENT (Section, HTML, UpdDt, LastEditedBy)
VALUES('TITLE', "<h2>Oma's beste</h2>", sysdate(), 1),
( 'SUBTITLE', "<h4>Producten zoals oma ze vroeger maakte!</h4>", sysdate(), 1),
( 'STORY', "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tristique bibendum condimentum. Duis sagittis mauris nisl, quis volutpat lacus tincidunt vitae. Pellentesque vel semper sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mollis enim eu risus condimentum, eget dapibus erat fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus nec ultrices ex, in egestas nunc. Morbi vitae odio venenatis, eleifend odio ac, finibus ex. Vivamus ac tincidunt purus, nec vehicula orci. Sed mauris lacus, mattis ullamcorper dui ac, placerat iaculis dolor. Sed sollicitudin luctus sem, eu lobortis sapien imperdiet nec. Nam nec erat ac nisi ornare cursus pulvinar vitae elit. Aliquam a porta leo. Nullam dictum luctus nulla ac porttitor. Nullam eu nulla commodo, hendrerit sem eget, consectetur risus. Nulla eu tincidunt ex, eget suscipit neque.", sysdate(), 1)
;