<?php


namespace Model;


class ShoppingCart
{
    public function CreateCart(){
        $handelData=new \Model\Database();
        $customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];

        // Let's create a cart.
        $creationDate=date('Y-m-d' ,time());
        $expirationDate=date('Y-m-d', time() + (14 * 86400)); // A cart is valid for 14 days.
        $createCart=$handelData->UpdateStmt("INSERT INTO shoppingcart(CustomerID, ExpirationDate, CreationDate) VALUES (" . $customerId . ",'" . $expirationDate . "','" . $creationDate  . "')");

        // Now the cart is made we need to update the customertable.
        // First we need the cartid.
        $getCartId=$handelData->selectStmt("select ShoppingCartID from shoppingcart where CustomerID=" . $customerId .";");

        // Now we can place the cartId in the table.
        $updateCustomer=$handelData->UpdateStmt("update customer set ShoppingCartID=" . $getCartId[0]['ShoppingCartID'] . " where CustomerID=" . $customerId .";");

        // We also need to update the array.
        $_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']=$getCartId[0]['ShoppingCartID'];
    }

    public function RemoveCart($cartId, $customerId){
        $handelData=new \Model\Database();
        // First the customer table will be updated.
        $updateCustomer=$handelData->UpdateStmt("update customer set ShoppingCartID= null where CustomerID=" . $customerId .";");

        // Remove all rows..
        $removeCartItems=$handelData->UpdateStmt("Delete from shoppingcart_stockitems where ShoppingCartID=".$cartId);

        //Than we need to remove the cart itself.
        $removeCart=$handelData->UpdateStmt("Delete from shoppingcart where ShoppingCartID=".$cartId);

        // And last we need to update the array.
        $_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']='';
        unset($_SESSION['USER']['SHOPPING_CART']);
        return 1;
    }

    public function EmptyCart(){
        // Check if there's something to remove.
        if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'])
        {
            $handelData=new \Model\Database();
            $cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];
            $customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];

                        // We also need to remove all the items in the cart.
            $getCartContense=$handelData->selectStmt('select * from shoppingcart_stockitems where ShoppingCartID=' . $cartId . ";");
            foreach ($getCartContense as $item)
            {
                $this->addToStock($item['StockItemID'],$item['StockItemAmount']);
            }

            // Remove the Cart
            $this->RemoveCart($cartId,$customerId);
            return 1;

        }
        // If there's nothing the remove we're done.
        return 0;
    }

    function LowerStock($stockItem, $amount){
        $handelData=new \Model\Database();
        // if an item is in a cart. We need to lower the stockqty with one.
        $qtyInStock = $handelData->selectStmt("select QuantityOnHand  from stockitemholdings where StockItemID=" . $stockItem);
        $newQty = $qtyInStock[0]['QuantityOnHand'] - $amount;
        $updateStock=$handelData->UpdateStmt("UPDATE stockitemholdings set QuantityOnHand=" . $newQty . " where StockItemID=" . $stockItem);
        return;
    }

    // A function to add to the stock.
    function addToStock($stockItem, $amount)
    {
        $handelData=new \Model\Database();
        // if an item is removed from the cart. We need to add the stockqty with one.
        $qtyInStock = $handelData->selectStmt("select QuantityOnHand  from stockitemholdings where StockItemID=" . $stockItem);
        $newQty = $qtyInStock[0]['QuantityOnHand'] + $amount;
        $updateStock=$handelData->UpdateStmt("UPDATE stockitemholdings set QuantityOnHand=" . $newQty . " where StockItemID=" . $stockItem);
        return;
    }

    public function AddItem($stockItem,$amount){
        $returnCode=1;
        if (!isset($_SESSION['authenticated']))
        {
            echo display_message('info','Om bestellingen te kunnen bewerken moet u ingelogd zijn.<br>U wordt door gestuurd naar de inlogpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/login\">";
            die;
        }

        // If the user is logged in, we need to check if the user has a cart.
        if (!$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']) {
            // No cart is present. So we need to create one.
            $this->CreateCart();
        }
        // There's a cart present. Let's put the the item in the cart.
        $cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];
        $handelData=new \Model\Database();

        // Check if the selected item is still in stock
        $isInStock=$handelData->selectStmt("select QuantityOnHand  from stockitemholdings where StockItemID=" . $stockItem);
        //If the  quantity of the item is zero (or less) then we let the user know.
        if ($isInStock[0]['QuantityOnHand']<=0){
            return 0;
        }

        // Check if the requested amount is still in stock
        // If not the last of the stock wil be added to the cart.
        if ($amount > $isInStock[0]['QuantityOnHand']){
            $amount=$isInStock[0]['QuantityOnHand'];
            $returnCode=9999;
        }

        $itemAlreadyPresent=$handelData->selectStmt("select count(*) as present from shoppingcart_stockitems where StockItemID=". $stockItem );
        if ($itemAlreadyPresent[0]['present']==0) // The selected item is not present in the cart.
        {
            $insertItem=$handelData->UpdateStmt("INSERT INTO shoppingcart_stockitems(ShoppingCartID, StockItemID, StockItemAmount) VALUES (" . $cartId . "," . $stockItem . ",".$amount.")");
            $this->LowerStock($stockItem,$amount);
        }
        else // If the item is already in the cart we need to add one more.
        {
            $amountOfItemsPresent=$handelData->selectStmt("select *  from shoppingcart_stockitems where StockItemID=". $stockItem );
            $newAmount=$amountOfItemsPresent[0]['StockItemAmount']+$amount;
            $updateItem=$handelData->UpdateStmt("UPDATE shoppingcart_stockitems SET StockItemAmount=" . $newAmount . " where  ShopStockID= " . $amountOfItemsPresent[0]['ShopStockID']);
            $this->LowerStock($stockItem,$amount);
        }

        // The cart is updated.
        if ($returnCode !=1){
            return $returnCode;
        }
        else{
            return 1;
        }
    }

    public function RemoveItem($stockItem,$amount){

        if (!isset($_SESSION['authenticated']))
        {
            echo display_message('info','Om bestellingen te kunnen bewerken moet u ingelogd zijn.<br>U wordt door gestuurd naar de inlogpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/login\">";
            die;
        }

        //check if there's a cart present.
        if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID']=='')
        {
            // No cart so there's nothing to remove.
            return 0;
        }

        $cartId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['ShoppingCartID'];
        $customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];
        $handelData=new \Model\Database();

        // Lower the number of items in the cart.
        $amountOfItemsPresent=$handelData->selectStmt("select *  from shoppingcart_stockitems where StockItemID=". $stockItem . " and ShoppingCartID=".$cartId);
        if ($amountOfItemsPresent)
        {
            $newAmount = $amountOfItemsPresent[0]['StockItemAmount'] - 1;

            $updateItem = $handelData->UpdateStmt("UPDATE shoppingcart_stockitems SET StockItemAmount=" . $newAmount . " where  ShopStockID= " . $amountOfItemsPresent[0]['ShopStockID'] . " and ShoppingCartID=" . $cartId);
            $this->addToStock($stockItem,$amount);

            // If the amount reaches 0, the row needs to be deleted for the cart.
            if ($newAmount == 0)
            {
               // $removeCartItem = $handelData->UpdateStmt("Delete from shoppingcart_stockitems where StockItemID=" . $stockItem . " and ShoppingCartID=" . $cartId);
                $this->RemoveCart($cartId,$customerId);
            }
        }
        return 1;
    }

    public function ReOrder($orderId){
        $notAllPresent=1;
        // We need to loop thru all the ordered items and put them in  the cart
        foreach ($orderId as $item){
            $result=$this->AddItem($item['StockItemID'],$item['ItemAmount']);
            if ($result==9999)$notAllPresent=0;
        }
        return $notAllPresent;
    }
}