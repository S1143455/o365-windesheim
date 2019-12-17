<?php


namespace Controller;


use Model\Discount;

class DiscountController
{
    private $admin = 'content/backend/';

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


    public function create()
    {
        print_r($_POST);
        $this->discount = new discount();
        $this->discount->initialize();

        //$this->category->setCategoryID();
        $this->discount->setLastEditedBy(1);
        $this->store($this->discount);

        // return "true";
        // include $this->contentpath
        include $this->admin . 'onderhoudkorting.php';
    }

    /**
     * Stores the product in the database.
     *
     * @param $discount discount
     * @return string
     */
    public function store($discount)
    {
        var_dump($discount);

        if (!$discount->initialize())
        {
            print_r($_GET);
            return false;
        };

        $this->discount = $discount;

        if (!$this->discount->save())
        {
            return "Something went wrong.";
        }
    }
}