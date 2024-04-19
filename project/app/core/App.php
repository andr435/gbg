<?php

class App 
{
    /**
     * Basic router from URI
     */
    public function __construct(){
        $router = new Router();

        $router->get("public/", 'User', 'index');
        $router->get("public/index.php", 'User', 'index');
        $router->get('public/user', 'User','showAllUsers');
        $router->get('public/api/user','api/User','get');
        $router->post('public/api/user','api/User','addUser');
        $router->delete('public/api/user','api/User','delete');

        $router->dispatch();
    }

    /**
     * Parse Url
     * @return array
     */
    public function geturl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }

        return [];
    }
}