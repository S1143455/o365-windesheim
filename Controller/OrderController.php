<?php


namespace Controller;

use Model\Customer;
use Model\People;
use Model\Product;
use Model\Order;
use Model\OrderStockItem;

class OrderController
{
    private $admin = 'content/backend/';


    function __construct()
    {
        $this->order = new order();
    }

    public function retrieve($id)
    {
        $order = new order();
        $order = $order->retrieve($id);
        if (empty($order->getOrderID())) {
            header("Location: /404", true);
        }

        return $order;
    }
    public function retrievestockitem($id)
    {
        $product = new Product();
        $product = $product->retrieve($id);
        //var_dump($product);
        if (empty($product)) {
            header("Location: /404", true);
        }

        return $product;
    }
    /**
     * @param $prod Product
     * @param $orderstockitem OrderStockItem
     */
    public function displayproduct($prod, $orderstockitem){
        $result = '';
        $result .= '<tr style="height:40px;">
                            <td class="col-md-2">' . $prod->getBrand() .'</td>
                            <td class="col-md-3">' . $prod->getBrand() .'</td>
                            <td class="col-md-3">' . $prod->getUnitPrice() .'</td>
                            <td class="col-md-2">' . $prod->getUnitPrice() .'</td>
                            <td class="col-md-2">' . $orderstockitem->getAmount() .'</td>
                            
                            
                        </tr>';

        echo $result;
        return "iets";
    }
    public function retrievePeople($id)
    {
        $person = new People();
        $person = $person->retrieve($id);
        //var_dump($product);
        if (empty($person)) {
            header("Location: /404", true);
        }

        return $person;
    }
    public function retrieveCustomer($id)
    {
        $customer = new Customer();
        $customer = $customer->retrieve($id);
        //var_dump($product);
        if (empty($customer)) {
            header("Location: /404", true);
        }

        return $customer;
    }
    public function retrieveOrderstockitem($id)
    {
        $orderStockItems = new OrderStockItem();
        $orderStockItems = $orderStockItems->where("*", "OrderID", "=", $id);

        if (empty($orderStockItems)) {
            header("Location: /404", true);
        }

        return $orderStockItems;
    }


    function GetAllOrders()
    {
        $orders = $this->order->getAllOrders();
        foreach ($orders as $order) {
            $totaal = 0;

            $orderstockitems = $this->retrieveOrderstockitem($order->getOrderID());
           // var_dump($orderstockitems);
$customer = $this->retrieveCustomer($order->getCustomerID());
$person = $this->retrievePeople($customer->getPersonID());
            foreach ($orderstockitems as $orderstockitem) {
              //  var_dump($orderstockitem);
                $products = $this->retrievestockitem($orderstockitem->getStockitemID());
                foreach ($products as $prod){
                    $totaal = $totaal + $prod->getUnitPrice();
                }
            }
            $result = '';
            $result .= '<tr style="height:40px;">
                            <td class="col-md-1"><button type="submit" name="id" value="' . $order->getOrderID() .'">Details</button></td>
                            <td class="col-md-2">' . $order->getOrderID() . '</td>
                            <td class="col-md-3">' . $person->getFullName() . '</td>
                            <td class="col-md-3">' . $order->getOrderdate() . '</td>
                            <td class="col-md-3">' . $totaal . '</td>
                        </tr>';

            echo $result;
        }

    }
}