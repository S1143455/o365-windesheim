ALTER TABLE attachments ADD COLUMN CategoryID int (11) NULL;
ALTER TABLE attachments ADD constraint Attachments_category FOREIGN KEY (CategoryID) references category(categoryid);