<?php

namespace Controller;
use Model\Admin;

class AdminController
{


    private $templatePath;
    private $contentPath;
    private $root;

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
        $this->root=getenv("ROOTAdmin");
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
     * Displays site url provided in conig.
     */
    function site_urlAdmin()
    {
        return getenv('ROOTAdmin');
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
            $nav_menu .= '<a href=/'. $this->site_urlAdmin() . $url . ' title=' . $name . ' class="button padding10 ' . $class . '">' . $name . '</a>' . $sep;
        }

        return trim($nav_menu, $sep);
    }

    function nav_menu($sep = '')
    {
        $nav_menu = '';
        $nav_items = $this->getConfig('nav_menu');
        foreach ($nav_items as $uri => $name) {
            $nav_menu .= '<li class="nav-item">';
            $class = str_replace('page=', '', $_SERVER['QUERY_STRING']) == $uri ? ' active' : '';
            $url = '/' . ($this->getConfig('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;
<<<<<<< HEAD
<<<<<<< HEAD
            $nav_menu .= '<a href=/' . $this->templatePath .'' . $url . ' title=' . $name . '>' . $name . '</a>' . $sep;
=======
            $nav_menu .= '<a class="nav-link" href=/' . $this->site_urlAdmin() . $url . ' title=' . $name . '>' . $name . '</a>' . $sep;
>>>>>>> 30e993e85d6bf3250c551600a75f0c7332055670
=======
            $nav_menu .= '<a class="nav-link" href=/'. $this->site_url() . $url . ' title=' . $name . '>' . $name . '</a>' . $sep;
>>>>>>> f1f6b944236c547d5cab0a63767506bcb9061079
            $nav_menu .= '</li>';
        }
        return trim($nav_menu, $sep);
    }
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
        if($this->root != ""){

            $templatepath = "/" . $this->root ;
        }
        return   $templatepath. '/theme/css/';
    }

    public function navigationalmenu(){
        $result = '';
        $result .= '
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    ' . $this->nav_menu() .'
                </ul>
            </div>';
        echo $result;
    }

}