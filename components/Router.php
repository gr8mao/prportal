<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.05.16
 * Time: 19:41
 */
class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include ($routesPath);
    }

    // Возвращает строку запроса
    // Тип: string
    private function getUri(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }

    }

    public function run(){
        // Получаем строку запроса
        $uri = $this->getUri();
        // Проверяем наличие запроса

        foreach($this->routes as $uriPattern => $path){
            if (preg_match("~$uriPattern~",$uri)){
                $segments = explode('/',$path);

                $controllerName = ucfirst(array_shift($segments).'Controller');
                $actionName = 'action'.ucfirst(array_shift($segments));

                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                // Саоздаем объект, вызвать метод

                $controllerObject = new $controllerName;

                if($controllerObject->$actionName() != null){
                    break;
                }
            }
        }

        // Подключение файла класса-контроллера
    }
}