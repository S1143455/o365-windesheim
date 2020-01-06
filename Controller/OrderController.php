<?php


namespace Controller;

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
        if (empty($product->getStockItemID())) {
            header("Location: /404", true);
        }

        return $product;
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
            var_dump($orderstockitems);

            foreach ($orderstockitems as $orderstockitem) {
                var_dump($orderstockitem);
                $product = $this->retrievestockitem($orderstockitem->getStockitemID());
                $totaal = $totaal + $product->getUnitPrice();
            }
            $result = '';
            $result .= '<tr style="height:40px;">
                            <td class="col-md-1"><button type="submit" name="id" value="' . $order->getOrderID() .'">Edit</button></td>
                            <td class="col-md-2">' . $order->getOrderID() . '</td>
                            <td class="col-md-3">' . $order->getCustomerID() . '</td>
                            <td class="col-md-3">' . $order->getOrderdate() . '</td>
                            <td class="col-md-3">' . $totaal . '</td>
                        </tr>';

            echo $result;
        }

    }
}