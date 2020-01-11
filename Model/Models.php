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

    protected function getColumns()
    {
        switch ($this->table) {
            case 'stockitem':
                $this->getStockItem();
                break;
            case 'orders':
                $this->getOrder();
                break;
            case 'Orderlines':
                $this->getOrderLines();
                break;
            case 'category':
                $this->getCategory();
                break;
            case 'attachments':
                $this->getAttachments();
                break;
            case 'content':
                $this->getContent();
                break;
            case 'supplier':
                $this->getSupplier();
                break;
            case  'people':
                $this->getPeople();
                break;
            case  'customer':
                $this->getCustomer();
                break;
            case  'Shoppingcart':
                $this->getShoppingcart();
                break;
            case  'address':
                $this->getAddress();
                break;
            case  'specialdeals':
                $this->getSpecialdeals();
                break;
            default:
                echo $this->table;
                die('Table not implemented');
        }

        if ($this->column == null) {
            switch ($this->table) {
                case 'stockitem':
                    $this->getStockItem();
                    break;
                case 'order':
                    $this->getOrder();
                    break;
                case 'Orderlines':
                    $this->getOrderLines();
                    break;
                case 'category':
                    $this->getCategory();
                    break;
                case 'attachments':
                    $this->getAttachments();
                    break;
                case 'content':
                    $this->getContent();
                    break;
                case 'supplier':
                    $this->getSupplier();
                    break;
                case  'people':
                    $this->getPeople();
                    break;
                case  'address':
                    $this->getAddress();
                    break;
                case  'customer':
                    $this->getCustomer();
                    break;
                case  'Shoppingcart':
                    $this->getShoppingcart();
                    break;
                case  'specialdeals':
                    $this->getSpecialdeals();
                    break;
                case  'orders':
                    $this->getOrder();
                    break;
                default:
                    echo $this->table;
                    die('Table not implemented');
            }

        }

//        if ($column != null) {
//            $retrievedRelation = $this->column;
//            $this->column = $modelColumn;
//            return $retrievedRelation;
//        }
//        return $this->column;

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
            "LeadTimeDays" => ['Integer', 'Attribute', 'Nullable'],
            "IsChillerStock" => ['Boolean', 'Attribute', 'Nullable'],
            "BarCode" => ['Varchar', 'Attribute', 'Required'],
            "TaxRate" => ['Integer', 'Attribute', 'Required'],
            "UnitPrice" => ['Integer', 'Attribute', 'Required'],
            "MarketingComments" => ['LongText', 'Attribute', 'Nullable'],
            "CategoryID" => ['Category', 'HasOne', 'Required'],
            "LastEditedBy" => ['People', 'HasOne', 'Required'],
            "SpecialDealID" => ['Discount', 'HasOne', 'Nullable'],
        );
    }

    private function getSpecialdeals()
    {
        $this->column = array(
            "SpecialDealID" => ['Integer', 'PrimaryKey', 'Required'],
            "DealDescription" => ['Varchar', 'Attribute', 'Nullable'],
            "StartDate" => ['Date', 'Attribute', 'Required'],
            "EndDate" => ['Date', 'Attribute', 'Nullable'],
            "DiscountPercentage" => ['Integer', 'Attribute', 'Required'],
            "DealCode" => ['Integer', 'Attribute', 'Required'],
            "LastEditedBy" => ['People', 'HasOne', 'Required'],
            "OneTime" => ['Tinyint', 'Attribute', 'Nullable'],
            "Active" => ['Tinyint', 'Attribute', 'Nullable'],
        );
    }

    private function getCategory()
    {
        $this->column = array(
            "CategoryID" => ['Integer', 'PrimaryKey', 'Required'],
            "CategoryName" => ['Varchar', 'Attribute', 'Required'],
            "ParentCategory" => ['Category', 'HasMany', 'Nullable'],
            "LastEditedBy" => ['People', 'HasOne', 'Required'],
            "AttachmentID" => ['Attachment', 'HasOne', 'Required'],
            "SpecialDealID" => ['Discount', 'HasOne', 'Nullable'],
        );
    }


    private function getAddress()
    {
        $this->column = array(
            "AddressId" => ['Integer', 'PrimaryKey', 'Required'],
            "Address" => ['Varchar', 'Attribute', 'Required'],
            "Zipcode" => ['Varchar', 'HasMany', 'Nullable'],
            "City" => ['Varchar', 'HasOne', 'Required'],
            "PersonId" => ['People', 'HasOne', 'Required'],
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
        );
    }

    private function getShoppingcart()
    {
        $this->column = array(
            "ShoppingCartID" => ['Integer', 'PrimaryKey', 'Required'],
            "ExpirationDate" => ['Datetime', 'Attribute', 'Required'],
            "CreationDate" => ['Datetime', 'Attribute', 'Required'],
        );
    }
    private function getContent()
    {
        $this->column = array(
            "PageID" => ['Varchar', 'PrimaryKey', 'Required'],
            "Section" => ['Varchar', 'PrimaryKey', 'Required'],
            "HTML" => ['Longtext', 'Attribute', 'Required'],
            "Upd_dt" => ['Datetime', 'Attribute', 'Required'],
        );
    }

    private function getPeople()
    {
        $this->column = array(
            "PersonID" => ['Integer', 'PrimaryKey', 'Required'],
            "FullName" => ['Varchar', 'Attribute', 'Required'],
            "LogonName" => ['Varchar', 'HasOne', 'Required'],
            "HashedPassword" => ['Blob', 'Attribute', 'Required'],
            "IsSystemUser" => ['Tinyint', 'Attribute', 'Required'],
            "Role" => ['Varchar', 'Attribute', 'Required'],
            "PhoneNumber" => ['Varchar', 'Attribute', 'Required'],
            "EmailAddress" => ['Varchar', 'Attribute', 'Unique'],
            "DateOfBirth" => ['Date', 'Attribute', 'Nullable',],
            "Photo" => ['Blob', 'Attribute', 'Nullable'],
            "LastEditedBy" => ['People', 'HasOne', 'Required'],
//            "LastEditedBy" => ['People', 'HasOne', 'Nullable'],
            "PassWordRecoveryString" => ['Varchar', 'Attribute', 'Nullable'],
            "RecoveryStringTTL" => ['Integer', 'Attribute', 'Nullable'],
        );
    }

//    private function getPeople()
//    {
//        $this->column = array(
//            "PeopleID" => ['Integer', 'PrimaryKey', 'Required'],
//            "FullName" => ['Varchar', 'Attribute', 'Unique'],
//            "LogonName" => ['Supplier', 'HasOne', 'Required'],
//            "HashedPassword" => ['Varchar', 'Attribute', 'Required'],
//            "IsSystemUser" => ['Integer', 'Attribute', 'Required'],
//            "Role" => ['Integer', 'Attribute', 'Required'],
//            "PhoneNumber" => ['Boolean', 'Attribute', 'Required'],
//            "EmailAddress" => ['Varchar', 'Attribute', 'Unique'],
//            "DateOfBirth" => ['Date', 'Attribute', 'Nullable',],
//            "Photo" => ['Blob', 'Attribute', 'Nullable'],
//            "LastEditedBy" => ['People', 'HasOne', 'Nullable'],
//        );

    private function getSupplier()
    {
        $this->column = array(
            "SupplierID" => ['Integer', 'PrimaryKey', 'Required'],
            "SupplierName" => ['Varchar', 'Attribute', 'Required'],
            "PrimaryContactPersonID" => ['People', 'HasOne', 'Required'],
            "AlternateContactPersonID" => ['People', 'HasOne', 'Required'],
            "SupplierReference" => ['Varchar', 'Attribute', 'Required'],
            "InternalComments" => ['LongText', 'Attribute', 'Required'],
            "WebsiteURL" => ['Varchar', 'Attribute', 'Required'],
            "LastEditedBy" => ['Varchar', 'Attribute', 'Required'],
            "AddressID" => ['Address', 'HasOne', 'Required'],

        );
    }

    private function getShoppingcartStockitems()
    {
        $this->column = array(
            "ShopStockID" => ['Integer', 'PrimaryKey', 'Required'],
            "ShoppingCartID" => ['Integer', 'Attribute', 'Required'],
            "StockItemID" => ['Integer', 'Attribute', 'Required'],
            "StockItemAmount" => ['Integer', 'Attribute', 'Required'],
        );
    }


    private function getCustomer()
    {
        $this->column = array(
            "CustomerID" => ['Integer', 'PrimaryKey', 'Required' ],
            "PersonID" => ['Integer', 'HasOne', 'Required'],
            "ShoppingCartID" => ['Integer', 'Attribute', 'Required'],
            "Gender" => ['Varchar', 'Attribute', 'Required'],
            "newsletter" => ['Boolean', 'Attribute', 'Not Required'],
            "TermsAndConditions" => ['Boolean', 'Attribute', 'Required'],
        );
    }

    private function getOrder()
    {
        $this->column = array(
            "OrderID" => ['Integer', 'PrimaryKey', 'Required' ],
            "CustomerID" => ['customer', 'HasOne', 'Required'],
            "OrderDate" => ['Date', 'Attribute', 'Not Required'],
            "ExpectedDeliveryDate" => ['Date', 'Attribute', 'Not Required'],
            "LastEditedBy" => ['People', 'HasOne', 'Nullable'],
            "DeliveryMethodID" => ['Integer', 'Attribute', 'Nullable'],
            "PaymentMethodID" => ['Integer', 'Attribute', 'Not Nullable'],
            "SpecialDealID" => ['Integer', 'foreign key', 'Not Required'],
        );
    }

    private function getOrderLines()
    {
        $this->column = array(
            "OrderLineID" => ['Integer', 'PrimaryKey', 'Required' ],
            "OrderID" => ['Order', 'HasOne', 'Required'],
            "StockItemID" => ['StockItem', 'HasOne', 'Required'],
            "Description" => ['varchar',  'Attribute', 'Not Required'],
            "PackageTypeIDIndex" => ['Integer',  'Attribute', 'Not Required'],
            "UnitPriceIndex" => ['Integer',  'Attribute', 'Required'],
            "TaxRate" => ['Integer',  'Attribute', 'Required'],
            "PickedQuantityIndex" => ['Integer',  'Attribute', 'Required'],
            "PickingCompletedWhenIndex" => ['Date', 'Attribute', 'Not Required'],
            "PickedQuantityIndex" => ['Integer',  'Attribute', 'Required'],
            "LastEditedByIndex" => ['People',  'Attribute', 'Required'],
            "LastEditedWhen" => ['Date',  'Attribute', 'Required'],

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