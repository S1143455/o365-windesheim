<?php
// Let's see if there are items in the cart.
$handelData=new \Model\Database();
$cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];
$customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];

$anyItemsInCart=$handelData->selectStmt('select count(*) as amount from shoppingcart_stockitems');

if ($anyItemsInCart[0]['amount']==0) {
    echo display_message('info','Uw winkelwagen bevat nog geen producten.');
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
    die;
}

// if the $_POST isset we add the item to the cart.
if (isset($_POST['add'])){include 'content/frontend/shoppingcart/add_item.php';}
if (isset($_POST['remove'])){include 'content/frontend/shoppingcart/remove_item.php';}
?>
<div class="col-md-8">
       <div class="row">
        <form role="form" id="table" method="POST" action="">
            <table id="categoryTable" class="table table-fixed">
                <thead>
                    <tr>
                        <th class="col-md-7">Omschrijving</th>
                        <th class="col-md-1">Aantal</th>
                        <th class="col-md-1">Prijs</th>
                        <th class="col-md-1">Totaal</th>
                        <th class="col-md-1">Add</th>
                        <th class="col-md-1">Remove</th>
                    </tr>
                </thead>
                <tbody>
                <?php $getAllTheProducts=new \Model\Database();
                $totalCartPrice=0;
                $allTheProducts=$getAllTheProducts->selectStmt("select sti.StockItemID, sti.StockItemName, cit.StockItemAmmount, sti.RecommendedRetailPrice, (cit.StockItemAmmount*sti.RecommendedRetailPrice) as CartPrice 
                                                                     from shoppingcart_stockitems cit left join stockitem sti on sti.StockItemID = cit.StockItemID;");
                    foreach ($allTheProducts as $item)
                    {
                        $tablerow= '';
                        $tablerow .= '<tr style="height:40px;">
                        <td class="col-md-7">' . $item['StockItemName'] .'</td>
                        <td class="col-md-1">' . $item['StockItemAmmount'] .'</td>
                        <td class="col-md-1">' . $item['RecommendedRetailPrice'] .'</td>
                        <td class="col-md-1">' . $item['CartPrice'] .'</td>
                        <td class="col-md-1"><button type="submit" name="add" value="' . $item['StockItemID'].'">Add</button></td>
                        <td class="col-md-1"><button type="submit" name="remove" value="' . $item['StockItemID'].'">Remove</button></td>
                        </tr>';
                        $totalCartPrice=$totalCartPrice+$item['CartPrice'];
                        echo $tablerow;
                    }
                    $totalRow= '<td class="col-md-1">Totaal:</td>
                                <td class="col-md-1">' . $totalCartPrice .'</td>';
                    echo $totalRow;
                ?>
                </tbody>
            </table>
        </form>
    </div>
</div>