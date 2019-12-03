<?php


namespace Model;


class category extends Database
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

    }
}