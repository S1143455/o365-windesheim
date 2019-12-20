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
                'product' => 'Products',
                'contact' => 'Contact',
                'login' => 'Login',
            ],
            'nav_menu_side_fe' => [
                'onderhoudaccount' => 'Uw account',
                'onderhoudbestellingen' => 'Bestellingen',
                'bestellingoverzicht' => 'Bestellingoverzicht',

            ],
            'nav_menu_side' => [
                'onderhoud-hoofdpagina' => 'Onderhoud Hoofdpagina',
                'onderhoud-categorieen' => 'Onderhoud Categorieën',
                'onderhoud-producten' => 'Onderhoud Producten',
                'onderhoud-klanten' => 'Onderhoud Klanten',
                'onderhoud-korting' => 'Onderhoud Korting',
                'onderhoud-nieuwsbrief' => 'Onderhoud Nieuwsbrief',
                'bestellingoverzicht' => 'Bestellingoverzicht',

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
     *  Index pagina
     */
    function index(){
        $category = new category();
        $categories = $category->retrieve();

        $main = $this;
        include_once('views/index.php');
    }

    /**
     * Website navigation.
     */
    function nav_menu($sep = '')
    {
        $nav_menu = '';
        $nav_items = $this->getConfig('nav_menu');
        if(!isset($_SESSION['authenticated']))
        {
            $nav_items['login']='Login';
        }
        else
        {
            $nav_items['logout']='Logout'; unset($nav_items['login']);
        }
        foreach ($nav_items as $uri => $name) {
            $nav_menu .= '<li>';
            $class = str_replace('page=', '', $_SERVER['QUERY_STRING']) == $uri ? ' active' : '';
            $url = '/' . ($this->getConfig('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;
            $nav_menu .= '<a href=' . $url . ' title=' . $name . '>' . $name . '</a>' . $sep;
            $nav_menu .= '</li>';
        }
        return trim($nav_menu, $sep);
    }

    function nav_menu_side_fe($sep = '')
    {
        $nav_menu = '';
        $nav_items = $this->getConfig('nav_menu_side_fe');
        $i = 0;
        $max = count($nav_items);
        foreach ($nav_items as $uri => $name) {

            $class = str_replace('page=', '', $_SERVER['QUERY_STRING']) == $uri ? ' active' : '';
            $url = '/' . ($this->getConfig('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;

            if($i == 0){
                $class .= ' first ';
            }
            $i++;
            if($i == $max){
                $class .= ' last ';
            }
            $nav_menu .= '<a href="' . $url . '" title="' . $name . '" class="button padding10 ' . $class . '">' . $name . '</a>' . $sep;
        }

        return trim($nav_menu, $sep);
    }

    function nav_menu_side($sep = '')
    {
        $nav_menu = '';
        $nav_items = $this->getConfig('nav_menu_side');
        $i = 0;
        $max = count($nav_items);
        foreach ($nav_items as $uri => $name) {

            $class = str_replace('page=', '', $_SERVER['QUERY_STRING']) == $uri ? ' active' : '';
            $url = '/' . ($this->getConfig('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;

            if($i == 0){
                $class .= ' first ';
            }
            $i++;
            if($i == $max){
                $class .= ' last ';
            }
            $nav_menu .= '<a href="' . $url . '" title="' . $name . '" class="button padding10 ' . $class . '">' . $name . '</a>' . $sep;
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
    function getContent($section)
    {

        $result = $this->database->selectStmt("SELECT CON.HTML FROM CONTENT CON WHERE CON.SECTION = '" . $section . "' AND CON.UpdDt = (SELECT MAX(CONN.UpdDt) FROM CONTENT CONN WHERE CONN.SECTION = CON.SECTION);");
        if (empty($result))
        {
            return "De selectie resulteert in een lege waarde.";
        }else
            {
               // print_r($result);
            return $result[0]['HTML'];
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
    function showContent($section){
        echo $this->getContent($section);
    }
}
?>