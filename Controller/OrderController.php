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

    function GetAllOrders()
    {
        $order = $this->order->getAllActiveOrders();
        foreach ($order as $order) {
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