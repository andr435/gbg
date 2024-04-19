<?php
/**
 * Class to manage config data
 */
class Config
{
    /**
     * Get data from config file
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null){
        include '/var/www/html/app/config/config.php';
        return $config[$key] ?? $default;
    }
}