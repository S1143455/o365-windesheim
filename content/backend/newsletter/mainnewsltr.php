<?php
include_once 'content/backend/header-admin.php';
$dataHandler=new \Model\Database();
// get all the existing newsletters
$newsletters=$dataHandler->selectStmt("SELECT nws.*, con.NewsletterTitle FROM newsletters nws inner join newslettercontent con on con.NewsletterID = nws.NewsletterID order by nws.NewsletterID desc");
?>

<div class="container-fluid" xmlns="http://www.w3.org/1999/html">
    <div class="row">

        <?php
        include_once 'content/backend/sidebar-admin.php';
        ?>

        <div class="col-12 col-lg-10">
            <div class="container-fluid" xmlns="http://www.w3.org/1999/html">
                <div class="row">
                    <?php
                    include_once 'content/backend/sidebar-admin.php';
                    ?>
                    <form role="form" id="table" method="POST" action="">
                        <div class="row">
                            <form role="form" id="table" method="POST" action="">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <h4>Overzicht Nieuwsbrieven</h4>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <button type="submit" class="btn btn-success btn-block" name="CreateNewsletter">
                                                            Aanmaken Nieuwsbrief
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4><strong>Gemaakt </strong></h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <h4><strong>Verzonden</strong></h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4><strong>Titel</strong></h4>
                                                </div>

                                            </div>
                                            <!--                                            Array ( [NewsletterID] => 1 [0] => 1 [NewsletterCreated] => 2020-01-02 [1] => 2020-01-02 [NewsletterSend] => 0000-00-00 [2] => 0000-00-00 [NewsletterCreatedBy] => 6 [3] => 6 [NewsletterLasteditedBy] => 6 [4] => 6 [NewsletterTitle] => newsletter no1 [5] => newsletter no1 ) -->
                                            <?php
                                            foreach ($newsletters as $value){
                                                echo '
                                        <div class="row">
                                            <div class="col-md-3">
                                               ' . date('d-m-Y',strtotime($value['NewsletterCreated'] )). '
                                            </div>
                                            <div class="col-md-3">
                                                ';
                                                if($value['NewsletterSend']=='0000-00-00'){$dateSend='';}else {$dateSend=date('d-m-Y',strtotime($value['NewsletterSend'] ));}
                                                echo $dateSend . '
                                            </div>
                                            <div class="col-md-6">
                                                <h4>' . $value['NewsletterTitle'] . '</h4>
                                            </div>
                                            <div class="col-xs-1">
                                                <button type="submit" name="ChangeNewsletter" class="btn btn-success btn-block" value="'. $value['NewsletterID'] .'">
                                                    Aanpassen
                                                </button>
                                            </div>
                                            <div class="col-xs-1">
                                                <button type="submit" name="reSendNewsletter" class="btn btn-success btn-block';if($value['NewsletterSend']=='0000-00-00'){echo ' disabled';} echo '" value="'. $value['NewsletterID'] .'">Opnieuw versturen</button>
                                            </div>
                                        </div>
                                        ';
                                            }
                                            ?>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="row text-center">
                                                Footer...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>