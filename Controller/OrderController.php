<?php


namespace Controller;


use Model\Order;

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


    function GetAllCategories()
    {
        $result = '';

        $orders = $this->order->getAllActiveOrders();

        foreach ($orders as $order) {
            $orderstockitems = $this->orderstock->getallorderstockitems($order->getOrderID());
            $i = 0;
            foreach ($orderstockitems as $order_stockitem) {
                $aantal = $order_stockitem->getAantla();
                $prijs = $order_stockitem->getPrijs();
                $totaal = $aantal * $prijs; //todo zoek uit hoe bereken
               $i = $i + $totaal;
            }


            // $category = $product->getRelation('Category');

            $result .= '<tr style="height:40px;">
                            <td class="col-md-1"><button type="submit" name="id" value="' . $category->getCategoryID() . '">Edit</button></td>
                            <td class="col-md-2">' . $category->getCategoryID() . '</td>
                            <td class="col-md-5">' . $category->getCategoryName() . '</td>
                            <td class="col-md-2">' . $i . '</td>
                            <td class="col-md-2">iets</td>
                        </tr>';

        }

        echo $result;



    }


    function GetAllOrders()
    {
        $orders = $this->order->getAllActiveOrders();

        foreach ($orders as $order) {
            $result = '';
            $result .= '<tr style="height:40px;">
                            <td class="col-md-3">' . $order['OrderID'] . '</td>
                            <td class="col-md-3">' . $order['CustomerID'] . '</td>
                            <td class="col-md-3">' . $order['OrderDate'] . '</td>
                            <td class="col-md-3">' . $order['OrderAmmount'] . '</td>
                        </tr>';

            echo $result;
        }

    }
}