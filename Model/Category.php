<?php


namespace Model;


class Category extends Database
{
    private $categoryID;
    private $categoryName;
    private $lastEditedBy;
    private $parentcategory;

    /**
     * @return mixed
     */
    public function getcategoryID()
    {
        return $this->categoryID;
    }

    /**
     * @param mixed $categoryID
     */
    public function setcategoryID($categoryID)
    {
        $this->categoryID = $categoryID;
    }

    /**
     * @return mixed
     */
    public function getcategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param mixed $categoryName
     */
    public function setcategoryName($categoryName)
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
    public function getParentcategory()
    {
        return $this->parentcategory;
    }

    /**
     * @param mixed $parentcategory
     */
    public function setParentcategory($parentcategory)
    {
        $this->parentcategory = $parentcategory;
    }

    public function Getcategories(){
        $result = '';
       //$result = $this->select("SELECT a.FileLocation FROM content CON INNER JOIN content_category cc on CON.PageID = cc.PageID and CON.Section = cc.Section INNER JOIN category c on cc.CategoryID = c.CategoryID INNER JOIN attachments a on c.CategoryID = a.CategoryID WHERE CON.PageID = 'Home.PHP' AND CON.Section = 'Categories' AND CON.Upd_dt = (SELECT MAX(CONN.Upd_dt) FROM content CONN WHERE CONN.PageID = CON.PageID AND CONN.Section = CON.Section);");
       return $result;
    }
}