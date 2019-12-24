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
                    <td class="col-md-2">' . $discount->getDealCode() . '</td>
                    <td class="col-md-1">' . $discount->getDiscountPercentage() .'</td>
                    <td class="col-md-1">' . $discount->getOneTime() .'</td>
                    <td class="col-md-1">' . $discount->getActive() .'</td>
                    <td class="col-md-3">' . $discount->getDealDescription() .'</td>
                    <td class="col-md-2">'.  $this->discount->getProductBasedOnID($discount->getSpecialDealID()) .'</td>
                    <td class="col-md-1">' . $discount->getStartDate() .'</td>
                    <td class="col-md-1">' . $discount->getEndDate() .'</td>
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