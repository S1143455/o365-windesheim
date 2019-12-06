<?php


namespace Model;


class Content extends Database
{
    private $pageID;
    private $section;
    private $HTML;
    private $updDT;

    function __construct()
    {
        $this->table = "content";
        parent::__construct();
    }

    /**
     * @return mixed
     */
    function getPageID()
    {
        return $this->pageID;
    }

    /**
     * @param $pageID
     */
    function setPageID($pageID)
    {
        $this->pageID = $pageID;
    }

    /**
     * @return mixed
     */
    function getSection()
    {
        return $this->section;
    }

    /**
     * @param $section
     */
    function setSection($section)
    {
        $this->section = $section;
    }

    /**
     * @return mixed
     */
    function getHTML()
    {
        return $this->HTML;
    }

    /**
     * @param $HTML
     */
    function setHTML($HTML)
    {
        $this->HTML = $HTML;
    }

    /**
     * @return mixed
     */
    function getUpdDT()
    {
        return $this->updDT;
    }

    /**
     * @param $updDT
     */
    function setUpdDT($updDT)
    {
        $this->updDT = $updDT;
    }
}