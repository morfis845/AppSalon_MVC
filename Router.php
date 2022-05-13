<?php

namespace MVC;

class Router
{
    public $routeGET =  [];
    public $routePOST =  [];

    public function get($url, $fn)
    {
        $this->routeGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->routePOST[$url] = $fn;
    }

    public function checkRoutes()
    {
        session_start();
        //Routes Privates
        $private_routes = ['/admin', '/estate/create', '/estate/update', '/seller/create', 'seller/update','/estate/delete','/seller/delete', '/sellers'];
        $auth = $_SESSION['login'] ?? null;

        $currentURL = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'] ;
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->routeGET[$currentURL] ?? null;
        } else {
            $fn = $this->routePOST[$currentURL] ?? null;
        }
        if (in_array($currentURL, $private_routes) && !$auth ) {
            header('Location: /');
        }
        if ($fn) {
            //URL exits and have a function
            call_user_func($fn, $this);
        } else {
            echo "ERROR 404. Not Found";
        }
    }
    //Show view
    public function render($view, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        ob_start(); //storage in memory for a moment
        include __DIR__ . "/views/$view.php";
        $content = ob_get_clean(); //clean buffer
        include __DIR__ . "/views/layout.php";
    }
}
