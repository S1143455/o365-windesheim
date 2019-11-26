<?php

namespace Classes;

class Main
{


    private $templatePath;
    private $contentPath;
    function __construct()
    {
        $this->templatePath = getenv('TEMPLATEPATH');
        $this->contentPath  = getenv('CONTENTPATH');
        $this->config = [
            'pretty_uri' => true,
            'nav_menu' => [
                '' => 'Home',
                'about-us' => 'About Us',
                'products' => 'Products',
                'contact' => 'Contact',
            ],
        ];
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
        return getenv('SITEURL');
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
    function nav_menu($sep = ' | ')
    {
        $nav_menu = '';
        $nav_items = $this->getConfig('nav_menu');
        foreach ($nav_items as $uri => $name) {
            $class = str_replace('page=', '', $_SERVER['QUERY_STRING']) == $uri ? ' active' : '';
            $url = $this->site_url() . '/' . ($this->getConfig('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;

            $nav_menu .= '<a href="' . $url . '" title="' . $name . '" class="item ' . $class . '">' . $name . '</a>' . $sep;
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
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        $path = getcwd() . '/' . $this->contentPath . '/' . $page . '.phtml';

        if (!file_exists($path)) {
            $path = getcwd() . '/' . $this->contentPath . '/404.php';
        }
        $this->page_title();
        return include_once $path;
    }

    /**
     * Starts everything and displays the template.
     */
    function init()
    {
       $this->page_title();
        return  include_once $this->templatePath . '/template.php';
    }

    function OpenCon()
    {
        $dbhost = "db01";
        $dbuser = "Wwi_Db_User_Read";
        $dbpass = "Welkom#2019!";
        $db = "test";
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
        if (!$connection) die("Unable to connect to MySQL: " . mysqli_error($connection));
        return $connection;
    }

    function CloseCon($connection)
    {
        mysqli_close($connection);
    }

    function Select($sql)
    {
        $connection = $this->OpenCon();
        $result = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
        $this->CloseCon($connection);
        return $result;
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


}