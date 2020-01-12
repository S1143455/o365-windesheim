<?php


namespace Controller;

use Model\Customer;
use Model\People;
use Model\Product;
use Model\Order;
use Model\Orderline;

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
    public function retrievestockitemwhere($id)
    {
        $products = new Product();
        $products = $products->where("*", "StockItemID", "=", $id);
        if (empty($products)) {
            header("Location: /404", true);
        }

        return $products;
    }
    /**
     * @param $prod Product
     * @param $orderLine Orderline
     */
    public function displayproduct($prod, $orderLine){
        $result = '';
        $result .= '<tr style="height:40px;">
                            <td class="col-md-1">' . $orderLine->getDescription() .'</td>
                            <td class="col-md-2">' . $orderLine->getQuantity() .'</td>
                            <td class="col-md-3">' . $orderLine->getTaxRate() .'</td>
                            <td class="col-md-3">' . $orderLine->getUnitPrice()  .'</td>
                            <td class="col-md-3">' . $this->Calculate($orderLine) .'</td>                          
                        </tr>';

        echo $result;
    }
    public function Calculate($orderLine)
    {
        $test = $this->retrieveOrderLine($orderLine->getOrderLineID());
        var_dump($test);
        var_dump($orderLine->getStockItemID());
        var_dump($orderLine->getUnitPrice());
        var_dump($orderLine->getQuantity());
        var_dump($orderLine->getTaxRate());
        return $orderLine->getUnitPrice() * $orderLine->getQuantity() * $orderLine->getTaxRate() ;
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
    public function retrieveOrderLine($id)
    {
        $orderlines = new Orderline();
        $orderlines = $orderlines->where("*", "OrderID", "=", $id);

        if (empty($orderlines)) {
            header("Location: /404", true);
        }

        return $orderlines;
    }


    function GetAllOrders()
    {
        $orders = $this->order->getAllOrders();
        foreach ($orders as $order) {
            $totaal = 0;

            $orderLines = $this->retrieveOrderLine($order->getOrderID());
            $customer = $this->retrieveCustomer($order->getCustomerID());
            $person = $this->retrievePeople($customer->getPersonID());
            foreach ($orderLines as $orderLine) {
                $products = $this->retrievestockitem($orderLine->getStockitemID());
                foreach ($products as $prod){
                    $totaal = $totaal + $prod->getUnitPrice();
                }
            }
            $result = '';
            $result .= '<tr style="height:40px;">
                            <td class="col-md-1"><button type="submit" class="btn btn-outline-secondary" name="id" value="' . $order->getOrderID() .'">Details</button></td>
                            <td class="col-md-2">' . $order->getOrderID() . '</td>
                            <td class="col-md-3">' . $person->getFullName() . '</td>
                            <td class="col-md-3">' . $order->getOrderdate() . '</td>
                            <td class="col-md-3">' . $totaal . '</td>
                        </tr>';

            echo $result;
        }

    }

    function getCustomerOrders()
    {
        $orders = $this->order->getAllOrders();
        foreach ($orders as $order) {
            $totaal = 0;

            $orderLines = $this->retrieveOrderLine($order->getOrderID());
            $customer = $this->retrieveCustomer($order->getCustomerID());
            $person = $this->retrievePeople($customer->getPersonID());
            foreach ($orderLines as $orderLine) {
                $products = $this->retrievestockitem($orderLine->getStockitemID());
                foreach ($products as $prod){
                    $totaal = $totaal + $prod->getUnitPrice();
                }
            }
            $result = '';
            $result .= '<tr style="height:40px;">
                            <td class="col-md-1"><button type="submit" class="btn btn-outline-secondary" name="id" value="' . $order->getOrderID() .'">Details</button></td>
                            <td class="col-md-2">' . $order->getOrderID() . '</td>
                            <td class="col-md-3">' . $person->getFullName() . '</td>
                            <td class="col-md-3">' . $order->getOrderdate() . '</td>
                            <td class="col-md-3">' . $totaal . '</td>
                        </tr>';

            echo $result;
        }
    }
}