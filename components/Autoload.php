<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 28.05.16
 * Time: 22:46
 */

function __autoload($class_name){

    $path_array = array(
        '/models/',
        '/components/'
    );

    foreach($path_array as $path){
        $path = ROOT.$path.$class_name.'.php';
        if(file_exists($path)){
            include_once $path;
        }
    }

}