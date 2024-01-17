<?php
session_start();
spl_autoload_register('myAutoLoader');

function myAutoLoader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    if(strpos($url, 'core') !== false){
        $path = "../core/";
    }else{
        $path = "../core/";
    }
    
    $extension = ".core.php";
    $fullPath = $path . $className . $extension;

    if(!file_exists($fullPath)){
        return false;
    }
    include_once $fullPath;
}

?>