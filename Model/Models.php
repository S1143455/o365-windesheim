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
        print_r($this->table);
        $this->column;
        switch ($this->table) {
            case 'stockitem':
                $this->getStockItem();
                break;
            case 'category':
                $this->getCategory();
                break;
            case 'attachment':
                $this->getAttachments();
            default:
                die('Table not implemented');
        }

        return $this->column;
    }

    /**
     * Define array of the product
     */
    private function getStockItem()
    {

        $column = array(
            "StockItemID" => ['Integer', 'PrimaryKey', 'Required'],
            "StockItemName" => ['Varchar', 'Attribute', 'Required'],
            "SupplierID" => ['Supplier', 'HasOne', 'Required'],
            "Brand" => ['Varchar', 'Attribute', 'Required'],
            "Size" => ['Integer', 'Attribute', 'Nullable'],
            "LoadTimeDays" => ['Integer', 'Attribute', 'Nullable'],
            "IsChillerStock" => ['Boolean', 'Attribute', 'Nullable'],
            "BarCode" => ['Varchar', 'Attribute', 'Required'],
            "TaxRate" => ['Integer', 'Attribute', 'Required'],
            "UnitPrice" => ['Integer', 'Attribute', 'Required'],
            "MarketingComments" => ['LongText', 'Attribute', 'Nullable'],
            "CategoryID" => ['Category', 'HasMany', 'Required'],
            "LastEditedBy" => ['People', 'HasOne', 'Required'],
        );
        return $column;
    }


    private function getCategory()
    {
        $column = array(
            "CategoryID" => ['Integer', 'PrimaryKey', 'Required'],
            "CategoryName" => ['Varchar', 'Attribute', 'Required'],
            "ParentCategory" => ['Category', 'HasMany', 'Nullable'],
            "LastEditedBy" => ['People', 'HasOne', 'Required'],
        );
        return $column;
    }
    private function getAttachments()
    {
        $column = array(
            "AttachmentID" => ['Integer', 'PrimaryKey', 'Required'],
            "AlternateText" => ['Varchar', 'Attribute', 'Nullable'],
            "FileLocation" => ['Varchar', 'Attribute', 'Required'],
            "LastEditedBy" => ['People', 'HasOne', 'Required'],
            "StockItemID" => ['StockItem', 'HasOne', 'Nullable'],
        );
        return $column;
    }
}