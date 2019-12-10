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
    protected $column;

    protected function getColumns($column = null)
    {
        if ($column != null)
        {
            $modelColumn = $this->column;
            $this->column = null;
        }

        if ($this->column == null)
        {
            switch ($column)
            {
                case "stockitem":
                    $this->getStockItem();
                    break;
                case 'category':
                    $this->getCategory();
                    break;
                case 'attachment':
                    $this->getAttachments();
                    break;
                case 'supplier':
                    $this->getSupplier();
                    break;
                case  'people':
                    $this->getPeople();
                default:

            }
            if($column != null)
            {
                $retrievedRelation = $this->column;
                $this->column = $modelColumn;
                return $retrievedRelation;
            }
            return $this->column;
        }
    }

    /**
     * Define array of the product
     */
    private function getStockItem()
    {
        $this->column = array(
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
            "CategoryID" => ['Category', 'HasOne', 'Required'],
            "LastEditedBy" => ['People', 'HasOne', 'Required'],
        );
    }


    private function getCategory()
    {
        $this->column = array(
            "CategoryID" => ['Integer', 'PrimaryKey', 'Required'],
            "CategoryName" => ['Varchar', 'Attribute', 'Required'],
            "ParentCategory" => ['Category', 'HasMany', 'Nullable'],
            "LastEditedBy" => ['People', 'HasOne', 'Required'],
        );
    }

    private function getAttachments()
    {
        $this->column = array(
            "AttachmentID" => ['Integer', 'PrimaryKey', 'Required'],
            "AlternateText" => ['Varchar', 'Attribute', 'Nullable'],
            "FileLocation" => ['Varchar', 'Attribute', 'Required'],
            "LastEditedBy" => ['People', 'HasOne', 'Required'],
            "StockItemID" => ['StockItem', 'HasOne', 'Nullable'],
        );
    }


    private function getPeople()
    {
        $this->column = array(
            "PeopleID" => ['Integer', 'PrimaryKey', 'Required'],
            "FullName" => ['Varchar', 'Attribute', 'Unique'],
            "LogonName" => ['Supplier', 'HasOne', 'Required'],
            "HashedPassword" => ['Varchar', 'Attribute', 'Required'],
            "IsSystemUser" => ['Integer', 'Attribute', 'Required'],
            "Role" => ['Integer', 'Attribute', 'Required'],
            "PhoneNumber" => ['Boolean', 'Attribute', 'Required'],
            "EmailAddress" => ['Varchar', 'Attribute', 'Unique'],
            "Photo" => ['Blob', 'Attribute', 'Nullable'],
            "LastEditedBy" => ['People', 'HasOne', 'Nullable'],
        );
    }

    private function getSupplier()
    {
        $this->column = array(
            "SupplierID" => ['Integer', 'PrimaryKey', 'Required'],
            "SupplierName" => ['Varchar', 'Attribute', 'Required'],
            "PrimaryContactPersonID" => ['People', 'HasOne', 'Required'],
            "AlternateContactPersonID" => ['People', 'HasOne', 'Required'],
            "SupplierReference" => ['Varchar', 'Attribute', 'Required'],
            "InternalComments" => ['LongText', 'Attribute', 'Required'],
            "WebsiteURL" => ['Boolean', 'Attribute', 'Required'],
            "LastEditedBy" => ['Varchar', 'Attribute', 'Required'],
            "AddressID" => ['Address', 'HasOne', 'Required'],

        );
    }

    /**
     * Gets the type of the $key
     * @param $key
     * @return mixed
     */
    protected function getType($key)
    {
        if (array_key_exists($key, $this->column))
        {
            return $this->column[$key][0];
        }
    }

}