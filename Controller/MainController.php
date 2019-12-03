<?php

namespace Controller;

class MainController
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
        ];
        $this->root=getenv("ROOT");
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
        if($this->root != ""){

            $templatepath = "/" . $this->root ;
        }
        return   $templatepath. '/theme/css/';
    }
    public function navigationalmenu(){
       $result = '';
       $result .=  '<div class="collapse navbar-collapse" id="bas-navbar">
                            <ul class="nav navbar-nav navbar-left">
                                ' . $this->nav_menu() .'
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PRODUCTS <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        ' . $this->nav_menu() .'
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    ';
        echo $result;
    }

}