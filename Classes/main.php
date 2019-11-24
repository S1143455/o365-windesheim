<?php

namespace Classes;

class Main
{

    private $config;

    function __construct()
    {
        $this->config = [
            'name' => 'Simple PHP Website',
            'site_url' => '',
            'pretty_uri' => true,
            'nav_menu' => [
                '' => 'Home',
                'about-us' => 'About Us',
                'products' => 'Products',
                'contact' => 'Contact',
            ],
            'template_path' => 'template',
            'content_path' => 'content',
            'version' => 'v3.0',
        ];
    }

    /**
     * Displays site name.
     */
    function site_name()
    {
        echo $this->getConfig('name');
    }

    /**
     * Displays site url provided in conig.
     */
    function site_url()
    {
        echo $this->getConfig('site_url');
    }

    /**
     * Displays site version.
     */
    function site_version()
    {
        echo $this->getConfig('version');
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
            $url = $this->getConfig('site_url') . '/' . ($this->getConfig('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;

            $nav_menu .= '<a href="' . $url . '" title="' . $name . '" class="item ' . $class . '">' . $name . '</a>' . $sep;
        }

        echo trim($nav_menu, $sep);
    }

    /**
     * Displays page title. It takes the data from
     * URL, it replaces the hyphens with spaces and
     * it capitalizes the words.
     */
    function page_title()
    {
        $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'Home';

        echo ucwords(str_replace('-', ' ', $page));
    }

    /**
     * Displays page content. It takes the data from
     * the static pages inside the pages/ directory.
     * When not found, display the 404 error page.
     */
    function page_content()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        $path = getcwd() . '/' . $this->getConfig('content_path') . '/' . $page . '.phtml';

        if (!file_exists($path)) {
            $path = getcwd() . '/' . $this->getConfig('content_path') . '/404.phtml';
        }
        $this->page_title();
        include_once $path;
    }

    /**
     * Starts everything and displays the template.
     */
    function init()
    {
        $this->page_title();
        include_once $this->getConfig('template_path') . '/template.php';
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