<?php

class Router
{

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    // Метод возвращает строку
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        // Получить строку запроса
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            
            
            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {
                
                // Определить контроллер, action, параметры

                $segments = explode('/', $path);
               
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                
                $actionName = 'action' . ucfirst(array_shift($segments));
            
                // Подключить файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Создать объект, вызвать метод (т.е. action)
                 $controllerObject = new $controllerName;
                 $result = $controllerObject->$actionName();
        
                 if ($result != null) {
                     break;
                 }




            }
        }
    }
}
