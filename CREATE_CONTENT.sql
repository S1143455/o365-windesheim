CREATE TABLE Content
(
    Page_ID varchar(50) NOT NULL,
    Section varchar(50) NOT NULL,
    Upd_dt  datetime    NOT NULL,
    HTML    LONGTEXT    NULL,
    CONSTRAINT Content PRIMARY KEY (Page_ID, Section)
)