<?php

namespace App;
/**
 * Class Autoloader
 * @package App
 * Permet de générer automatiquement les class
 */

class Autoloader {

    /**
     * enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * @param $class
     */
    static function autoload($class){
        $class = str_replace('App\\', '', $class);
        $class = str_replace('\\', '/', $class);
        require '../app/' . $class . '.php';
    }
}