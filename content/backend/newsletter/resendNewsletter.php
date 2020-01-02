<?php
// Resend news letter.
// For now we just update the date in the table.
$dataHandle=new \Model\Database();

$resend=$dataHandle->UpdateStmt("UPDATE newsletters set NewsletterSend='". date('Y-m-d',time()) . "' where NewsletterID = " . $_POST['reSendNewNewsletter']);
