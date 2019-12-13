<?php


namespace Controller;


use Model\Discount;

class DiscountController
{
    function __construct()
    {
        $this->discount = new Discount();
    }

    function GetAllDiscount()
    {
        $discounts = $this->discount->getAllSpecialDeals();

        foreach($discounts as $discount){
            $result = '';
            $result .= '<tr>
                    <td class="col-xs-2">' . $discount['DealCode'] .'</td>
                    <td class="col-xs-1">' . $discount['DiscountPercentage'] .'</td>
                    <td class="col-xs-1">' . $discount['OneTime'] .'</td>
                    <td class="col-xs-1">' . $discount['Active'] .'</td>
                    <td class="col-xs-3">' . $discount['DealDescription'] .'</td>
                    <td class="col-xs-2">' . $this->discount->getProductBasedOnID($discount['SpecialDealID']) .'</td>
                    <td class="col-xs-1">' . $discount['StartDate'] .'</td>
                    <td class="col-xs-1">' . $discount['EndDate'] .'</td>
                </tr>';
            echo $result;
        }

    }


    /**
     * Stores the product in the database.
     *
     * @param $discount Discount
     * @return string
     */
    public function store($discount)
    {
        if (!$discount->initialize())
        {
            print_r($_GET);
            return false;
        };

        $this->discount = $discount;

        if ($this->discount->save())
        {
            return "Something went right.";
        }
            return "Something went wrong.";
    }
}