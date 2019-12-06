<?php


namespace Model;


class Category extends Database
{
    private $categoryID;
    private $categoryName;
    private $lastEditedBy;
    private $parentCategory;

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
       $result = $this->select("SELECT a.FileLocation FROM content CON INNER JOIN content_category cc on CON.PageID = cc.PageID and CON.Section = cc.Section INNER JOIN category c on cc.CategoryID = c.CategoryID INNER JOIN attachments a on c.CategoryID = a.CategoryID WHERE CON.PageID = 'Home.PHP' AND CON.Section = 'Categories' AND CON.Upd_dt = (SELECT MAX(CONN.Upd_dt) FROM content CONN WHERE CONN.PageID = CON.PageID AND CONN.Section = CON.Section);");
       return $result;
    }

    public function getAllActiveCategories()
    {
        $result = '';
        $result = $this->select('SELECT * FROM omasbeste.category where CategoryActive = 1;');
        return $result;
    }
}