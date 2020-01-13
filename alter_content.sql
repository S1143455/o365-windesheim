-- ALs de tabellen Content of Content_category al bestaan dan eerst deze droppen mbv de onderste statements:
 DROP TABLE Content_category;
 DROP TABLE Content;

CREATE TABLE Content(    ContentID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,    Section varchar(50) NOT NULL,    HTML    LONGTEXT    NULL,    UpdDt  datetime    NOT NULL);
CREATE TABLE Content_category(    ContentCategoryID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,    ContentID int(11) NOT NULL,    CategoryID int(11) NOT NULL,    SeqNum int (4) NOT NULL);

ALTER TABLE Content_category ADD CONSTRAINT FK_Content FOREIGN KEY (ContentID) REFERENCES Content(ContentID);
ALTER TABLE Content_category ADD CONSTRAINT FK_CategoryID FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID);


INSERT INTO CONTENT (Section, HTML, UpdDt)
VALUES('TITLE', "<h2>Oma's beste</h2>", sysdate()),
( 'SUBTITLE', "<h4>Producten zoals oma ze vroeger maakte!</h4>", sysdate()),
( 'STORY', "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tristique bibendum condimentum. Duis sagittis mauris nisl, quis volutpat lacus tincidunt vitae. Pellentesque vel semper sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mollis enim eu risus condimentum, eget dapibus erat fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus nec ultrices ex, in egestas nunc. Morbi vitae odio venenatis, eleifend odio ac, finibus ex. Vivamus ac tincidunt purus, nec vehicula orci. Sed mauris lacus, mattis ullamcorper dui ac, placerat iaculis dolor. Sed sollicitudin luctus sem, eu lobortis sapien imperdiet nec. Nam nec erat ac nisi ornare cursus pulvinar vitae elit. Aliquam a porta leo. Nullam dictum luctus nulla ac porttitor. Nullam eu nulla commodo, hendrerit sem eget, consectetur risus. Nulla eu tincidunt ex, eget suscipit neque.", sysdate())
;