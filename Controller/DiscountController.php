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
                    <td class="col-md-2">' . $discount['DealCode'] .'</td>
                    <td class="col-md-1">' . $discount['DiscountPercentage'] .'</td>
                    <td class="col-md-1">' . $discount['OneTime'] .'</td>
                    <td class="col-md-1">' . $discount['Active'] .'</td>
                    <td class="col-md-3">' . $discount['DealDescription'] .'</td>
                    <td class="col-md-2">'. $this->discount->getProductBasedOnID($discount['SpecialDealID']) .'</td>
                    <td class="col-md-1">' . $discount['StartDate'] .'</td>
                    <td class="col-md-1">' . $discount['EndDate'] .'</td>
                </tr>';
            echo $result;
        }

    }
}