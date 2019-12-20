<?php


namespace Model;


class Category extends Database
{
    private $categoryID;
    private $categoryName;
    private $lastEditedBy;
    private $parentCategory;
    private $AttachmentID;
    function __construct()
    {
        $this->table = "category";
        parent::__construct();

    }
    /**
     * @return mixed
     */
    public function getCategoryID()
    {
        return $this->categoryID;
    }

    /**
     * @param mixed $categoryID
     */
    public function setCategoryID($categoryID)
    {
        $this->categoryID = $categoryID;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param mixed $categoryName
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    /**
     * @return mixed
     */
    public function getLastEditedBy()
    {
        return $this->lastEditedBy;
    }

    /**
     * @param mixed $lastEditedBy
     */
    public function setLastEditedBy($lastEditedBy)
    {
        $this->lastEditedBy = $lastEditedBy;
    }

    /**
     * @return mixed
     */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }

    /**
     * @param mixed $parentcategory
     */
    public function setParentCategory($parentCategory)
    {
        $this->parentCategory = $parentCategory;
    }

    public function SpecialGetcategories()
    {
       $result = '';
       $result = $this->selectStmt("SELECT a.FileLocation FROM content CON INNER JOIN content_category cc on CON.ContentID = cc.ContentID INNER JOIN category c on cc.CategoryID = c.CategoryID INNER JOIN attachments a on c.CategoryID = a.CategoryID WHERE CON.Section = 'Categories' AND CON.Upddt = (SELECT MAX(CONN.Upddt) FROM content CONN WHERE CONN.Section = CON.Section);");
       return $result;
    }

    public function getAllActiveCategories()
    {
        $result = '';
        /**
         * $result = $this->selectStmt('SELECT * FROM category where CategoryActive = 1;');
         */
        $result = $this->selectStmt('SELECT * FROM category;');

        return $result;
    }


}