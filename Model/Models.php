<?php


namespace Model;

/**
 * This class contains all the database attributes.
 * Template $column = array("AttributeKey" => ["AttributeType", "SpecialType(AKA primarykey or relationship)"])
 *
 * Class Models
 * @package Model
 */
class Models
{
    protected $table;
    private $column;

    protected function getColumns()
    {
        $this->column;
        switch ($this->table) {
            case 'StockItem':
                $this->getProduct();
    }

        return $this->column;
    }
    /**
     * Define array of the product
     */
    private function getProduct()
    {

        $column = array(
            "StockItemID" => ['Integer','PrimaryKey'],
            "StockItemName" => ['Varchar','Attribute'],
            "SupplierID" => ['Integer', 'HasOne']

        );
    }
}