<?php
include_once 'content/backend/header-admin.php';
// Who's calling?
echo "<pre>"; print_r($_SESSION); echo "</pre>";
echo "<pre>"; print_r($_POST); echo "</pre>";
if (isset($_POST['ChangeNewsletter']))      // The users wants to change the news letter.
{
    $dataHandler=new \Model\Database();
    $_SESSION['NEWSLETTER']=$dataHandler->selectStmt("SELECT * FROM newsletters  where NewsletterID = ". $_POST['ChangeNewsletter']);
    $_SESSION['NEWSLETTER_CONTENT']=$dataHandler->selectStmt("SELECT * FROM newslettercontent  where NewsletterID = ". $_POST['ChangeNewsletter']);
    $formTitle='Aanpassen van een nieuwsbrief';
    $newsletterTitle='value="' . $_SESSION['NEWSLETTER_CONTENT'][0]['NewsletterTitle'].'"';
    $newsletterContents=$_SESSION['NEWSLETTER_CONTENT'][0]['NewsletterContent'];
    $buttonValue='ChangeNewsletter';

}
else                                        // The user wants to create a new newsletter.
{
    $formTitle='Aanmaken van een nieuwsbrief';
    $newsletterTitle='';
    $newsletterContents='';
    $buttonValue='CreateNewsletter';
}

?>

<link href="/content/backend/newsletter/editor.css" type="text/css" rel="stylesheet"/>
<script src="/content/backend/newsletter/editor.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<script type="text/javascript">
    $(document).ready(function()
    {
        var editor=$("#txtEditor").Editor();
       // $("#txtEditor").Editor("setText", "<?php //echo $newsletterContents;?>");
        document.getElementById('texteditor').innerHTML='<?php echo $newsletterContents;?>';

    });

    function savethetext(){
        var MyDiv1 = document.getElementById('texteditor');
        var MyString=MyDiv1.innerHTML;
        var ShowString=MyString.replace(/'/g, "\\'");
        document.getElementById("LetterContent").value=ShowString;
    }

    function NotRequired(){
        document.getElementById("MainTitle").required = false;
        return true;
    }

</script>

<div class="container-fluid" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <?php include_once 'content/backend/sidebar-admin.php';?>
        <div class="col-12 col-lg-10">
            <div class="container-fluid" xmlns="http://www.w3.org/1999/html">
                <div class="row">
                    <form role="form" id="thisone" name="thisone" method="POST" action="" style="width: 100%">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4><?php echo $formTitle; ?></h4>
                                            </div>
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-success btn-block" name="BackToMainPage" onclick="return NotRequired()">
                                                    Terug naar hoofdpagina
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="MainTitle"><h4>Titel van de nieuwsbrief</h4></label>
                                            <input type="text" class="form-control" name="MainTitle" id="MainTitle" style="width: 100%" placeholder="Titel van de nieuwsbrief" <?php echo $newsletterTitle;?> required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea id="txtEditor" name="txtEditor" rows="50"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit" onclick="myFunction()" name="sendNewsletter" class="btn btn-success btn-block" value="<?php echo $buttonValue; ?>">
                                                Versturen
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" onclick="myFunction()" name="saveNewsletter" class="btn btn-success btn-block" value="<?php echo $buttonValue; ?>">
                                                Opslaan
                                            </button>
                                        </div>
                                        <div>
                                            <input type="hidden" name="LetterContent" id="LetterContent">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
