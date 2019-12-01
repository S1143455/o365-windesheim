DROP TABLE CONTENT;

CREATE TABLE Content
(
    Page_ID varchar(50) NOT NULL,
    Section varchar(50) NOT NULL,
    Seq_num int(2)   NULL,
    CategoryID int(11) NULL,
    HTML    LONGTEXT    NULL,
    Upd_dt  datetime    NOT NULL,
    CONSTRAINT Content PRIMARY KEY (Page_ID, Section)
);
ALTER TABLE Content ADD constraint Content_Category FOREIGN KEY (CategoryID) references category(categoryid);

INSERT INTO CONTENT (Page_ID, Section, HTML, Upd_dt)
VALUES('Home.php', 'TITLE', "<h2>Oma's beste</h2>", sysdate()),
('Home.php', 'SUBTITLE', "<h4>Producten zoals oma ze vroeger maakte!</h4>", sysdate()),
('Home.php', 'STORY', "<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tristique bibendum condimentum. Duis sagittis mauris nisl, quis volutpat lacus tincidunt vitae. Pellentesque vel semper sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mollis enim eu risus condimentum, eget dapibus erat fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus nec ultrices ex, in egestas nunc. Morbi vitae odio venenatis, eleifend odio ac, finibus ex. Vivamus ac tincidunt purus, nec vehicula orci. Sed mauris lacus, mattis ullamcorper dui ac, placerat iaculis dolor. Sed sollicitudin luctus sem, eu lobortis sapien imperdiet nec. Nam nec erat ac nisi ornare cursus pulvinar vitae elit. Aliquam a porta leo. Nullam dictum luctus nulla ac porttitor. Nullam eu nulla commodo, hendrerit sem eget, consectetur risus. Nulla eu tincidunt ex, eget suscipit neque.</h2>", sysdate())
;