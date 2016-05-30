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
        $result = null;
        foreach($this->routes as $uriPattern => $path){
            if (preg_match("~$uriPattern~",$uri)) { // посмотреть preg_match, есть баги с uri (dsfjshdjhomesdjhf - работает, home/ - не работает)
                $segments = explode('/', $path);

                $controllerName = ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                // Создаем объект, вызвать метод

                $controllerObject = new $controllerName;

                $result = call_user_func(array($controllerObject, $actionName), $parameters);

                if ($result) {
                    break;
                }
            }
        }
        if ($result == null){
            include_once (ROOT .'/views/errors/404.php');
        }


        // Подключение файла класса-контроллера
    }
}