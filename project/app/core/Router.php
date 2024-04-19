<?php

class Router
{
    protected $routes = [];

    /**
     * Add new route
     * 
     * @param string $route
     * @param string $controller
     * @param string $action
     * @param string $method
     * 
     */
    private function addRoute(string $route, string $controler, string $action, string $method){
        $this->routes[$method][$route] = ['controller' => $controler, 'action'=> $action];
    }

    /**
     * Add route for GET http method
     * 
     * @param string $route
     * @param string $controller
     * @param string $action
     */
    public function get(string $route, string $controler, string $action){
        $this->addRoute($route, $controler, $action, 'GET');
    }

    /**
     * Add route for POST http method
     * 
     * @param string $route
     * @param string $controller
     * @param string $action
     */
    public function post(string $route, string $controler, string $action){
        $this->addRoute($route, $controler, $action, 'POST');
    }

    /**
     * Add route for DELETE http method
     * 
     * @param string $route
     * @param string $controller
     * @param string $action
     */
    public function delete(string $route, string $controler, string $action){
        $this->addRoute($route, $controler, $action, 'DELETE');
    }

    /**
     * Run uri script
     * 
     * @throws Exception
     */
    public function dispatch(){
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        
        if(empty($uri[0])){
            unset($uri[0]);
            $uri = array_values($uri);
        }
        
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        
        // validate http method
        if(!in_array($method, ['POST', 'GET', 'DELETE'])){
            throw new Exception('Route not found', 404);
        }

        // validate uri
        if(!$this->isUriValid($uri)){
            throw new Exception('Route not found', 404);
        }
        
        $is_api = $uri[1] == 'api'; 
        $param = null;
        
        // get param for front and delete it from uri
        if(!$is_api && count($uri) == 3){
            $param = $uri[2];
            unset($uri[2]);
        }

        // get param for api and delete it from uri
        if($is_api && count($uri) == 4){
            $param = $uri[3];
            unset($uri[3]);
        }

        // rebuild uri for route look up
        $uri = implode('/', $uri);

        if(array_key_exists($uri, $this->routes[$method])){
            
            // set controller
            $controller = $this->routes[$method][$uri]['controller'];
            $controller_path = Config::get('app_path', '.')
                .'controllers/'.$controller.'.php'; 
  
            if(file_exists($controller_path)){
                require_once $controller_path;
            } else {
                throw new Exception('Controller not found',404);
            }

            $controller = explode('/', $controller);
            $controller = end($controller);
            $action = $this->routes[$method][$uri]['action'];
            $controller = new $controller();

            // check action
            if(!method_exists($controller, $action)){
                throw new Exception('Action not found',404);
            }

            $param ? $controller->$action($param) : $controller->$action();
        } else {
            throw new Exception('Route not found', 404);
        }
    }

    /**
     * validate uri array
     * 
     * @param array $uri
     * @return bool
     */
    private function isUriValid(array $uri = []): bool{
        // not our root
        if($uri[0] != 'public'){
            return false;
        }

        // uri too long
        if(($uri[1] == 'api' && count($uri) > 4) || (($uri[1] != 'api' && count($uri) > 3)) ){
            var_dump($uri, count($uri));
            return false;
        }
        return true;
    }
}
