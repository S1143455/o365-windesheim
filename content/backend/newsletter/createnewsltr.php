<?php
// The user wants to return to the main page.
if (isset($_POST['MainTitle']))
{
    if (!$_POST['MainTitle']){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/admin/onderhoud-nieuwsbrief\">";die;}
}
?>

<link href="/content/backend/newsletter/editor.css" type="text/css" rel="stylesheet"/>
<script src="/content/backend/newsletter/editor.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<script type="text/javascript">
    $(document).ready(function()
    {
        var editor=$("#txtEditor").Editor();
    });

    function savethetext(){
        var MyDiv1 = document.getElementById('texteditor');
        document.getElementById("LetterContent").value=MyDiv1.innerHTML;
    }
</script>

<script type="text/javascript">
    function NotRequired(){
        document.getElementById("MainTitle").required = false;
        return true;
    }

</script>


<div class="container" style="width:100%">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <form role="form" id="thisone" name="thisone" method="POST" action="">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <h4>Aanmaken van een nieuwsbrief</h4>
                                                </div>
                                                <div class="col-xs-2">
                                                </div>
                                                <div class="col-xs-4">
                                                    <button type="submit" class="btn btn-success btn-block" name="CreateNewsletter" onclick="return NotRequired()">
                                                        Terug naar hoofdpagina
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="MainTitle"><h4>Titel van de nieuwsbrief</h4></label>
                                                <input type="text" class="form-control" name="MainTitle" id="MainTitle" placeholder="Titel van de nieuwsbrief" required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <textarea id="txtEditor" name="txtEditor" rows="50"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <button type="submit" onclick="myFunction()" name="sendNewNewsletter" class="btn btn-success btn-block">
                                                    Versturen
                                                </button>
                                            </div>
                                            <div class="col-xs-4">
                                            </div>
                                            <div class="col-xs-4">
                                                <button type="submit" onclick="myFunction()" name="saveNewNewsletter" class="btn btn-success btn-block">
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>