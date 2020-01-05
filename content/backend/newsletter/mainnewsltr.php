<?php
$dataHandler=new \Model\Database();
// get all the existing newsletters
$newsletters=$dataHandler->selectStmt("SELECT nws.*, con.NewsletterTitle FROM newsletters nws inner join newslettercontent con on con.NewsletterID = nws.NewsletterID order by nws.NewsletterID desc");
?>
<div class="container" style="width:100%">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <form role="form" id="table" method="POST" action="">
                    <div class="container">
                        <div class="row">
                            <form role="form" id="table" method="POST" action="">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <h4>Overzicht Nieuwsbrieven</h4>
                                                    </div>
                                                    <div class="col-xs-2">
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <button type="submit" class="btn btn-success btn-block" name="CreateNewsletter">
                                                            Aanmaken Nieuwsbrief
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <h4><strong>Gemaakt </strong></h4>
                                                </div>
                                                <div class="col-xs-2">
                                                    <h4><strong>Verzonden</strong></h4>
                                                </div>
                                                <div class="col-xs-4">
                                                    <h4><strong>Titel</strong></h4>
                                                </div>
                                                <div class="col-xs-2">
                                                    <h4><strong></strong></h4>
                                                </div>
                                                <div class="col-xs-2">
                                                    <h4><strong></strong></h4>
                                                </div>
                                            </div>
<!--                                            Array ( [NewsletterID] => 1 [0] => 1 [NewsletterCreated] => 2020-01-02 [1] => 2020-01-02 [NewsletterSend] => 0000-00-00 [2] => 0000-00-00 [NewsletterCreatedBy] => 6 [3] => 6 [NewsletterLasteditedBy] => 6 [4] => 6 [NewsletterTitle] => newsletter no1 [5] => newsletter no1 ) -->
                                                <?php
                                                foreach ($newsletters as $value){
                                                    echo '
                                                    <div class="row">
                                                        <div class="col-xs-2">
                                                           <h4>' . date('d-m-Y',strtotime($value['NewsletterCreated'] )). '</h4>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <h4>';
                                                                if($value['NewsletterSend']=='0000-00-00'){$dateSend='';}else {$dateSend=date('d-m-Y',strtotime($value['NewsletterSend'] ));}
                                                                echo $dateSend . '</h4>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <h4>' . $value['NewsletterTitle'] . '</h4>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <button type="submit" name="ChangeNewsletter" class="btn btn-success btn-block" value="'. $value['NewsletterID'] .'">
                                                                Aanpassen
                                                            </button>
                                                        </div>
                                                        <div class="col-xs-2">
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
