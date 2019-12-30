<?php
include 'content/frontend/display_message.php';
$cart=new \Model\ShoppingCart();
// if the $_POST isset we add the item to the cart.
if (isset($_POST['add']))
{
    $updateCart=$cart->AddItem($_POST['add'],1);
    if ($updateCart==1){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;\">";}
    else {echo display_message('info','Helaas is dit product niet meer op voorraad.'). "<META HTTP-EQUIV=Refresh CONTENT=\"3;\">";}
}

if (isset($_POST['remove'])){
    $updateCart=$cart->RemoveItem($_POST['remove'],1);
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;\">";
}

?>
<html lang="nl">
    <head>
        <body>
            <div class="col-md-8">
                   <div class="row">
                    <form role="form" id="table" method="POST" action="">
                        <table id="categoryTable" class="table table-fixed">
                            <thead>
                                <tr>
                                    <th class="col-md-6">Omschrijving</th>
                                    <th class="col-md-2">Prijs</th>
                                    <th class="col-md-2">Aanwezig</th>
                                    <th class="col-md-2">Toevoegen</th>
                                    <th class="col-md-2">Verwijderen</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $getAllTheProducts=new \Model\Database();
                            $allTheProducts=$getAllTheProducts->selectStmt("select sti.*, sth.QuantityOnHand from stockitem sti left join stockitemholdings sth on sth.StockItemID = sti.StockItemID;");
                                foreach ($allTheProducts as $item)
                                {
                                    $tablerow= '';
                                    $tablerow .= '<tr style="height:40px;">
                                    <td class="col-md-6">' . $item['StockItemName'] .'</td>
                                    <td class="col-md-2">' . $item['RecommendedRetailPrice'] .'</td>
                                    <td class="col-md-2">' . $item['QuantityOnHand'] .'</td>
                                    <td class="col-md-2"><button type="submit" name="add" value="' . $item['StockItemID'].'">Add</button></td>
                                    <td class="col-md-2"><button type="submit" name="remove" value="' . $item['StockItemID'].'">Remove</button></td>
                                    </tr>';
                                    echo $tablerow;
                                }
                            ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="col-md-8"><?php // echo "<pre>"; print_r($allTheProducts); echo "</pre><br>"; ?></div>
        </body>
    </head>
</html>