<?php


namespace Controller;


use Model\Orderline;

class OrderlineController
{


    function __construct()
    {
        $this->orderline = new Orderline();
    }

    public function retrieve($id)
    {
        $orderline = new Orderline();
        $orderline = $orderline->retrieve($id);
        if (empty($orderline->get())) {
            header("Location: /404", true);
        }

        return $orderline;
    }

}