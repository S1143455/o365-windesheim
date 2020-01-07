DROP TABLE customer;

CREATE TABLE customer;
(
	CustomerID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    AddressID int(10) NOT NULL,
    PersonID int(10) NOT NULL,
    ShoppingCartID int(10),
    Gender varchar(10) NOT NULL,
    newsletter boolean NULL,
    TermsAndConditions boolean NULL
);