<?php

namespace Controller;

use Model\Database;
use Model\Category;
use Model\Attachments;
use Model\Product;

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
            'nav_menu_side' => [
                'onderhoud-hoofdpagina' => 'Onderhoud Hoofdpagina',
                'onderhoud-categorieen' => 'Onderhoud Categorieën',
                'onderhoud-producten' => 'Onderhoud Producten',
                'onderhoud-klanten' => 'Onderhoud Klanten',
                'onderhoud-korting' => 'Onderhoud Korting',
                'onderhoud-nieuwsbrief' => 'Onderhoud Nieuwsbrief',
                'bestellingoverzicht' => 'Bestellingoverzicht',

            ],
            'user_menu_item' => [
                'onderhoudaccount' => 'Uw account',
                'onderhoudbestellingen' => 'Bestellingen',
                'logout' =>'Uitloggen',
            ],
            'shoppingcart' => [
                'winkelwagen' => 'Winkelwagen',
            ],
        ];
        $this->root=getenv("ROOT");
        $this->database=new Database();
        $this->category = new category();
        $this->product = new product();
        $this->attachment = new Attachments();
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

        $product = new product();

        $attachment = new Attachments();

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
            unset($nav_items['login']);
        }
        foreach ($nav_items as $uri => $name) {
            $nav_menu .= '<li class="nav-item mr-4 mt-2">';
            $class = str_replace('page=', '', $_SERVER['QUERY_STRING']) == $uri ? ' active' : '';
            $url = '/' . ($this->getConfig('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;
            $nav_menu .= '<a class="navbarFE" href='. $url . ' title=' . $name . '>' . $name . '</a>' . $sep;
            $nav_menu .= '</li>';
        }
        return trim($nav_menu, $sep);
    }

    function nav_menu_side_fe()
    {
        // empty.
    }

    function user_menu_items($sep = '')
    {
        $nav_menu = '';
        $nav_items = $this->getConfig('user_menu_item');

        foreach ($nav_items as $uri => $name) {
            $nav_menu .= '<li class="nav-item mr-2">';
            $class = str_replace('page=', '', $_SERVER['QUERY_STRING']) == $uri ? ' active' : '';
            $url = '/' . ($this->getConfig('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;
            $nav_menu .= '<a class="navbarFE" href=' . $url . ' title=' . $name . '>' . $name . '</a>' . $sep;
            $nav_menu .= '</li>';
        }
        return trim($nav_menu, $sep);
    }

    function CartMenuItems($sep = '')
    {
        $nav_menu = '';
        $nav_items = $this->getConfig('shoppingcart');
        $amountInCart=getAmountOfItemsInCart();
        if ($amountInCart>0){
            $nav_items['winkelwagen']="Winkelwagen <span class=\"badge badge-light\">". $amountInCart ."</span>";
        } else  $nav_items['winkelwagen']='Winkelwagen';

        foreach ($nav_items as $uri => $name) {
             $nav_menu .= '<li class="nav-item mt-2">';
            $class = str_replace('page=', '', $_SERVER['QUERY_STRING']) == $uri ? ' active' : '';
            $url = '/' . ($this->getConfig('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;
            $nav_menu .= '<a class="navbarFE" href=winkelwagen title=Winkelwagen>' . $nav_items['winkelwagen']  . '</a>' . $sep;
            $nav_menu .= '</li>';
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
            $nav_menu .= '<a href="'. $this->site_url() . $url . '" title="' . $name . '" class="button padding10 ' . $class . '">' . $name . '</a>' . $sep;
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

    function usermenu()
    {
        $showusermenu='';
        $showusermenu='
        <li class="dropdown nav-item mr-4 mt-2">
            <a href="#" class="dropdown-toggle navbarFE" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Uw gegevens<span class="caret"></span></a>
            <ul class="dropdown-menu">
                ' . $this->user_menu_items() .'
            </ul>
        </li>';
        if(isset($_SESSION['authenticated'])){return $showusermenu;}
    }

    public function navigationalmenu()
    {
       $result = '';
       $result = '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        ' . $this->nav_menu() .' 
                        ' . $this->usermenu() .'
                        <li class="dropdown nav-item mt-2">
                            <a href="#" class="dropdown-toggle navbarFE" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PRODUCTS <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                ' . $this->nav_menu() .'   
                                ' . $this->usermenu() .'                        
                            </ul>
                        </li>                      
                    </ul>
                 </div> ';
       echo $result;

    }

    public function ShoppingCartMenu()
    {
        $resultcart = '';
        $resultcart = '<div class="collapse navbar-collapse" id="bas-navbar">
                    <ul class="nav navbar-nav navbar-left">' . $this->CartMenuItems() . '</ul>
                 </div> ';
        echo $resultcart;
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

    function showAttachment($attachmentID, $productDetail, $styleClass){
        if($attachmentID == '' || $attachmentID == 0){
            echo '<img class="' . $styleClass . '" src="/' . getenv('ROOT') . '/uploads/dummyImage.png">';
        }else{
            $att = $this->attachment->retrieve($attachmentID);
            if(substr($att->getFileLocation(),0,4) == 'http'){
                if(!$productDetail) {
                    echo '<img class="' . $styleClass . '" src="/' . getenv('ROOT') . '/uploads/dummyImage.png">';
                }else{
                    echo '<iframe height="100%" width="100%" src="' . $att->getFileLocation() . '"></iframe>';
                }
            }else {
                echo '<img class="' . $styleClass . '" src="/' . getenv('ROOT') . '/' . $att->getFileLocation() . '">';
            }
        }
    }
}
?>