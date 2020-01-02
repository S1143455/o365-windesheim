<?php
// If the newsletter should be send we need to know.
$sendDate='';
if (isset($_POST['sendNewNewsletter'])){$sendDate=date('Y-m-d',time());}

// Let's save the newsletter
$dataHandler=new \Model\Database();

// Create the first part of the newsletter.
$createNewsletter=$dataHandler->UpdateStmt( 'INSERT INTO newsletters(NewsletterCreated,NewsletterSend,NewsletterCreatedBy,NewsletterLasteditedBy) VALUES (
"'. date('Y-m-d',time()) . '",
"'. $sendDate . '",
'. $_SESSION['USER']['DATA'][0]['PersonID'] . ',
'. $_SESSION['USER']['DATA'][0]['PersonID'] . ')');

// Retrieve the newsletterID (the last one created by the user today.
$newsletterID=$dataHandler->selectStmt('select NewsletterID from newsletters where NewsletterCreated = "'. date('Y-m-d',time()) .
    '" and  NewsletterCreatedBy = '. $_SESSION['USER']['DATA'][0]['PersonID'] . ' order by NewsletterID desc limit 1');

// Save the content of the newsletter
$createContent=$dataHandler->UpdateStmt("INSERT INTO newslettercontent (NewsletterID,NewsletterTitle,NewsletterContent,NewsletterContentCreatedBy,NewsletterContentLastEditedBy) VALUES (
". $newsletterID[0]['NewsletterID'] . ",
\"" . $_POST['MainTitle'] .  "\", 
'" . html_entity_decode($_POST['LetterContent']) .  "',
\"" . $_SESSION['USER']['DATA'][0]['PersonID'] .  "\",
\"" . $_SESSION['USER']['DATA'][0]['PersonID'] .  "\")");
