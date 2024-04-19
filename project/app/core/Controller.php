<?php

/**
 * Base Controller
*/
class Controller
{
    /**
     * Init model
     * 
     * @param string $model
     */
    public function model(string $model){
        require_once Config::get('app_path')."models/{$model}.php";
        return new $model();
    }

    /**
     * Get View
     * 
     * @param string $view
     * @param array $data  Data to use inside view
     */
    public function view(string $view, array $data=[]){
        if(file_exists(Config::get('app_path')."views/{$view}.php")){
            require_once Config::get('app_path')."views/{$view}.php";
        } else {
            throw new Exception("View not found");
        }
    }
}