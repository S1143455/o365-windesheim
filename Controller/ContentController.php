<?php

namespace Controller;

use Model\Content;

class ContentController
{
    private $viewPath = 'views/content/';

    function __construct()
    {
        $content = new Content();
        $content->retrieve();

        return include $this->viewPath . 'index.php';
    }

    /**
     * Get PageID based on section
     * @param $section
     */
    public function getPageID($section){
        $pageID = "";
        return $pageID;
    }

    public function show($pageID)
    {
        return include_once $this->viewPath . 'show.php';
    }

    /**
     * Generate richTextEditor
     * @param $section
     */
    function getRichTextEditor($section)
    {
        $content = "";
        if(isset($section)){
           $content = $this->show($this->getPageID($section));
        };

        echo '<div id="toolbar">
                <button id="bold">B</button>
                <button id="italic"><i>I</i></button>
                <button id="underline"><u>U</u></button>
                <button id="decreasefont">A-</button>
                <button id="increasefont">A+</button>
                <button id="indent">-&gt;</button>
                <button id="outdent">&lt;-</button>
                <button id="justifyCenter">C</button>
                <button id="justifyFull">J</button>
                <button id="justifyLeft">L</button>
                <button id="justifyRight">R</button>
                <button id="subscript">x<sub>2</sub></button>
                <button id="superscript">x<sup>2</sup></button>
            </div>
            <div id="clip">
                    <defs id="defs4">

                    </defs>
            </div>
            <div id="export-content">
                <div id="editor-content" contenteditable="true">' . $content . '</div>
            </div>
           <div id="export">
               <button id="damehtml">Opslaan</button>
           </div>';
    }
}