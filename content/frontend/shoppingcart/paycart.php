<?php
echo "paycart";
echo "<pre>";print_r($_SESSION['USER']['SHOPPING_CART']);echo "<br></pre>";
?>



<div class="container">
    <div class="row">
        <form role="form" id="table" method="POST" action="">
            <div class="col-xs-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4><span class="glyphicon glyphicon-euro"></span> Afrekenen</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="product-name"><strong>Uw factuurbedrag is € <?php echo $_SESSION['USER']['SHOPPING_CART']['AMOUNT_TO_PAY']; ?></strong></h4>
                                    <h4><small>Also some text</small></h4>
                                </div>
                                <div class="col-xs-6">
                                    <div class="col-xs-2 text-right">
                                        <h6><strong></strong></h6>
                                    </div>
                                    <div class="col-xs-3">
                                        <span>
                                            <button type="submit" class="btn-sm btn-danger btn-block" name="remove" value=""><span class="glyphicon glyphicon-minus"></button>
                                        </span>
                                     </div>
                                     <div class="col-xs-4">
                                        <input type="text" class="form-control input-sm" value="">
                                     </div>
                                     <div class="col-xs-3">
                                        <span>
                                            <button type="submit" class="btn-sm btn-success btn-block input-group-prepend" name="add" value=""><span class="glyphicon glyphicon-plus"></span></button>
                                        </span>
                                     </div>
                                </div>
                            </div>
                            <hr>
                        <div class="row">
                            <div class="text-center">
                                <div class="col-xs-12">
                                    <h4 class="text-right">Totaal <strong></strong></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-3">
                                <button type="submit" class="btn btn-danger btn-block" name="emptycart">
                                    <span class="glyphicon glyphicon-trash"></span> Leegmaken
                                </button>
                            </div>
                            <div class="col-xs-6">
                            </div>
                            <div class="col-xs-3">
                                <button type="submit" class="btn btn-success btn-block" name="paycart">
                                    <span class="glyphicon glyphicon-euro"></span> Afrekenen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
