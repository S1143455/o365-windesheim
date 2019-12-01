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