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
                    <td class="col-xs-1">' . $discount['DealCode'] .'</td>
                    <td class="col-xs-1">' . $discount['DiscountPercentage'] .'</td>
                    <td class="col-xs-1"></td>
                    <td class="col-xs-1"></td>
                    <td class="col-xs-2">' . $discount['DealDescription'] .'</td>
                    <td class="col-xs-2"></td>
                    <td class="col-xs-2"></td>
                    <td class="col-xs-1">' . $discount['StartDate'] .'</td>
                    <td class="col-xs-1">' . $discount['EndDate'] .'</td>
                    
                </tr>';
            echo $result;
        }

    }
}