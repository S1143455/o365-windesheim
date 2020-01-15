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
                            <td class="col-md-3">' . (int)$orderLine->getTaxRate() .'%</td>
                            <td class="col-md-3">€' . $orderLine->getUnitPrice()  .'</td>
                            <td class="col-md-3">€' . $this->Calculate($orderLine) .'</td>                          
                        </tr>';

        echo $result;
    }
    public function Calculate($orderLine)
    {
        return $orderLine->getUnitPrice() * $orderLine->getQuantity() * 1.15 ;
    }

    public function totaltotalprice($orderlines){
        $prijs = 0;
        foreach($orderlines as $orderline){
            $prijs = $prijs + $this->calculateTotalPrice($orderline);
        }
        return $prijs;
    }
    public function calculateTotalPrice($orderLine)
    {
        $unitPrice = $orderLine->getUnitPrice();
        $amount = $orderLine->getQuantity();
        $taxRate = round($orderLine->getTaxRate());


        $base = 100;
        $tax = $base + $taxRate;

        $price = ($unitPrice / 100) * $tax;
        $total = $amount * $price;

        return $total;

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
              $totaal = $totaal + $this->Calculate($orderLine);
            }
            $result = '';
            $result .= '<tr style="height:40px;">
                            <td class="col-md-1"><button type="submit" class="btn btn-outline-secondary" name="id" value="' . $order->getOrderID() .'">Details</button></td>
                            <td class="col-md-1">' . $order->getOrderID() . '</td>
                            <td class="col-md-2">' . $customer->getCustomerID() . '</td>
                            <td class="col-md-2">' . $person->getFullName() . '</td>
                            <td class="col-md-2">' . $person->getEmailAddress() . '</td>
                            <td class="col-md-2">' . $order->getOrderdate() . '</td>
                            <td class="col-md-2">€' . $totaal . '</td>
                        </tr>';

            echo $result;
        }

    }
}

