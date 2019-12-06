<?php

namespace Controller;

use Model\Database;
use Model\Category;
class MainController

{


    private $templatePath;
    private $contentPath;
    private $root;
    private $database;

    function __construct()
    {
        $this->templatePath = getenv('TEMPLATEPATH');
        $this->contentPath = getenv('CONTENTPATH');
        $this->config = [
            'pretty_uri' => true,
            'nav_menu' => [
                '' => 'Home',
                'about-us' => 'About Us',
                'products' => 'Products',
                'contact' => 'Contact',
            ],
        ];
        $this->root=getenv("ROOT");
        $this->database=new Database();
        $this->category = new category();
    }

    /**
     * Displays site name.
     */
    function site_name()
    {
        return getenv('SITENAME');
    }

    /**
     * Displays site url provided in conig.
     */
    function site_url()
    {
        return getenv('ROOT');
    }

    /**
     * Displays site version.
     */
    function site_version()
    {
        return getenv('VERSION');
    }

    /**
     * Website navigation.
     */
    function nav_menu($sep = '')
    {
        $nav_menu = '';
        $nav_items = $this->getConfig('nav_menu');
        foreach ($nav_items as $uri => $name) {
            $nav_menu .= '<li>';
            $class = str_replace('page=', '', $_SERVER['QUERY_STRING']) == $uri ? ' active' : '';
            $url = $this->site_url() . '/' . ($this->getConfig('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;
            $nav_menu .= '<a href="' . $url . '" title="' . $name . '" >' . $name . '</a>' . $sep;
            $nav_menu .= '</li>';
        }
        return trim($nav_menu, $sep);
    }
//class="item ' . $class . '"
    /**
     * Displays page title. It takes the data from
     * URL, it replaces the hyphens with spaces and
     * it capitalizes the words.
     */
    function page_title()
    {
        $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'Home';

        return ucwords(str_replace('-', ' ', $page));
    }

    /**
     * Displays page content. It takes the data from
     * the static pages inside the pages/ directory.
     * When not found, display the 404 error page.
     */
    function page_content()
    {
        //This needs to deliver page data that is requested by the ROUTE.
    }

    /**
     * Used to store website configuration information.
     *
     * @var string or null
     */
    function getConfig($key = '')
    {
        return isset($this->config[$key]) ? $this->config[$key] : null;
    }
    public function template_path()
    {
        $templatepath = '';
        if($this->root != "")
        {
            $templatepath = "/" . $this->root ;
        }
        return   $templatepath. '/theme/css/';
    }

    /**
     * Get HTML based on page_id and section from Database
     *
     * @param $page_id
     * @param $section
     * @return string
     */
    function getContent($page_id,$section)
    {

        $result = $this->database->Select("SELECT CON.HTML FROM CONTENT CON WHERE CON.PAGEID = '" . $page_id . "' AND CON.SECTION = '" . $section . "' AND CON.Upd_dt = (SELECT MAX(CONN.Upd_Dt) FROM CONTENT CONN WHERE CONN.PAGEID = CON.PAGEID AND CONN.SECTION = CON.SECTION);");
        if (empty($result))
        {
            return "De selectie resulteert in een lege waarde.";
        }else
            {
                print_r($result);
//            return $result[0]['HTML'];
        }
    }

    public function navigationalmenu()
    {
       $result = '';
       $result = '<div class="collapse navbar-collapse" id="bas-navbar">
                    <ul class="nav navbar-nav navbar-left">
                        ' . $this->nav_menu() .'
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                PRODUCTS <span class="caret"></span>
                            </a>
                        <ul class="dropdown-menu">
                            ' . $this->nav_menu() .'
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                    </ul>
                 </div> ';
       echo $result;

    }

    /**
     * echo HTML. It uses function getContent.
     *
     * @param $page_id
     * @param $section
     */
    function showContent($page_id, $section){
        echo $this->getContent($page_id,$section);
    }

    /**
     * Display grid based on given array and class
     * For example class: col-12 col-sm-6 col-md-4
     * col-12 will show 1 column for the smallest screen
     * col-sm-6 will show 2 columns for small screen
     * col-md-4 will show 3 columns for medium screen
     *
     * @param $arr
     * @param $class
     */
    function generateGrid($arr, $class)
    {
        if(empty($arr) or $class==''){
            echo "Use valid values.";
        }else{
            echo '<div class="container"><div class="row">';
            for($i=1;$i<count($arr);$i++) {
                echo '<div class="' . $class . '"></div>';
            }
            echo '</div></div>';
        }
    }

    /**
     * Generates grid based on categories
     */
    function getGridCategories()
    {
        $categories = $this->category->SpecialGetcategories();
        $this->generateGrid($categories,"col-12 col-sm-6 col-md-4");
    }


}
?>