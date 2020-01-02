<?php
// If the newsletter should be send too we need to know.
$sendDate='';
if (isset($_POST['sendNewsletter'])){$sendDate=date('Y-m-d',time());}

$dataHandler=new \Model\Database();

// Check if the newsletter has to be updated or has to be saved.
if (isset($_POST['saveNewsletter']))
{
    $whatToDo=$_POST['saveNewsletter'];
}
else
{
    $whatToDo=$_POST['sendNewsletter'];
}

if ($whatToDo=='ChangeNewsletter')           // The update part.
{
    // The news letter needs to be updated.
    // If the contents of the element $_POST['LetterContent'] is empty,
    // it could mean that the user didn't change the contents of the newsletter.
    // If this is the case the contents will be retrieved from the
    // $_SESSION['NEWSLETTER_CONTENT'][0]['NewsletterContent'] element.
    if (!$_POST['LetterContent']) {
        $_POST['LetterContent'] = $_SESSION['NEWSLETTER_CONTENT'][0]['NewsletterContent'];
    }

    // Update the newsletters table
    $updateNewsletter=$dataHandler->UpdateStmt('update newsletters set NewsletterSend="'. $sendDate .
        '",NewsletterLasteditedBy='. $_SESSION['USER']['DATA'][0]['PersonID'] .
        ' where NewsletterID='. $_SESSION['NEWSLETTER_CONTENT'][0]['NewsletterID']);

    $mystring='update newslettercontent set
            NewsletterTitle = "' . $_POST['MainTitle'] . '",
            NewsletterContent = \'' . $_POST['LetterContent'] . '\',
            NewsletterContentLastEditedBy='. $_SESSION['USER']['DATA'][0]['PersonID'] .'
             where NewsletterContentID = '. $_SESSION['NEWSLETTER_CONTENT'][0]['NewsletterContentID'];

    // Update the newslettercontent
    $updateContent=-$dataHandler->UpdateStmt('update newslettercontent set
            NewsletterTitle = \'' .addslashes($_POST['MainTitle']). '\',
            NewsletterContent = \'' . addslashes($_POST['LetterContent']). '\',
            NewsletterContentLastEditedBy='. $_SESSION['USER']['DATA'][0]['PersonID'] .'
             where NewsletterContentID = '. $_SESSION['NEWSLETTER_CONTENT'][0]['NewsletterContentID']);
}
else    // Create a new newsletter
{
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
        $createContent=$dataHandler->UpdateStmt('INSERT INTO newslettercontent (NewsletterID,NewsletterTitle,NewsletterContent,NewsletterContentCreatedBy,NewsletterContentLastEditedBy) VALUES (
     '. $newsletterID[0]['NewsletterID'] . ',
    \'' . addslashes($_POST['MainTitle']) .  '\', 
    \'' . addslashes($_POST['LetterContent']) .  '\',
    "' . $_SESSION['USER']['DATA'][0]['PersonID'] .  '",
    "' . $_SESSION['USER']['DATA'][0]['PersonID'] .  '")');

}