-- ALs de tabellen Content of Content_category al bestaan dan eerst deze droppen mbv de onderste statements:
-- DROP TABLE Content;
-- DROP TABLE Content_category;

CREATE TABLE Content
(
    PageID varchar(50) NOT NULL,
    Section varchar(50) NOT NULL,
    HTML    LONGTEXT    NULL,
    Upd_dt  datetime    NOT NULL
);
ALTER TABLE Content ADD CONSTRAINT PK_PageID PRIMARY KEY (PageID, Section);

CREATE TABLE Content_category
(
    ContentCategoryID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    PageID varchar(50) NOT NULL,
    Section varchar(50) NOT NULL,
    CategoryID int(11) NOT NULL,
    SeqNum int (4) NOT NULL
);

ALTER TABLE Content_category ADD CONSTRAINT FK_Content FOREIGN KEY (PageID, Section) REFERENCES Content(PageID, Section);
ALTER TABLE Content_category ADD CONSTRAINT FK_CategoryID FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID);


INSERT INTO CONTENT (Page_ID, Section, HTML, Upd_dt)
VALUES('Home.php', 'TITLE', "<h2>Oma's beste</h2>", sysdate()),
('Home.php', 'SUBTITLE', "<h4>Producten zoals oma ze vroeger maakte!</h4>", sysdate()),
('Home.php', 'STORY', "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tristique bibendum condimentum. Duis sagittis mauris nisl, quis volutpat lacus tincidunt vitae. Pellentesque vel semper sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mollis enim eu risus condimentum, eget dapibus erat fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus nec ultrices ex, in egestas nunc. Morbi vitae odio venenatis, eleifend odio ac, finibus ex. Vivamus ac tincidunt purus, nec vehicula orci. Sed mauris lacus, mattis ullamcorper dui ac, placerat iaculis dolor. Sed sollicitudin luctus sem, eu lobortis sapien imperdiet nec. Nam nec erat ac nisi ornare cursus pulvinar vitae elit. Aliquam a porta leo. Nullam dictum luctus nulla ac porttitor. Nullam eu nulla commodo, hendrerit sem eget, consectetur risus. Nulla eu tincidunt ex, eget suscipit neque.", sysdate())
;

INSERT INTO content values ('Klantenservice.php', 'TITLE', '<h2>Klantenservice</h2>', sysdate());
INSERT INTO content values ('Klantenservice.php', 'SUBTITLE', '<h4>Heeft u vragen of opmerkingen? Neem gerust contact met ons op. U kunt dat doen op een van de onderstaande manieren.</h4>', sysdate());
INSERT INTO content values ('Klantenservice.php', 'STORY1', '<p>Wij zijn telefonisch bereikbaar op nummer <b>012 - 34 567 89</b>.<br>Ons callcenter is op <b>werkdagen</b> geopend van 8.00uur tot 18.00uur en op <b>zaterdag</b> van 9.00uur tot 17.00uur.</p>', sysdate());
INSERT INTO content values ('Klantenservice.php', 'STORY2', '<p>Liever via de mail uw vraag estellen? Via <A HREF="mailto:vragen@omasbeste.nl">vragen@omasbeste.nl</A> kunt u uw vraag stellen.<br>Wij proberen uw vraag binnen twee werkdagen te beantwoorden.</p>', sysdate());