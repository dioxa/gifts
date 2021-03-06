<?php
class Route {

    static function start() {
        $controllerName = 'Main';
        $action = 'Index';

        if (!empty($_SERVER["QUERY_STRING"])) {
            $valuesArray = array_values($_GET);
            $paramName = $valuesArray[0];
            $uri = explode('?', $_SERVER['REQUEST_URI']);
            $request = $uri[0];
        } else {
            $request = $_SERVER['REQUEST_URI'];
        }

        $routes = explode('/', $request);

        if ( !empty($routes[1]) ) {
            $controllerName = $routes[1];
        }
        if ( !empty($routes[2]) ) {
            $action = $routes[2];
        }
        if ( !empty($routes[3]) ) {
            $paramName = $routes[3];
        }


        $modelName = 'Model'.ucfirst($controllerName);
        $controllerName = 'Controller'.ucfirst($controllerName);
        $actionName = 'action'.ucfirst($action);

        $modelFile = $modelName.'.php';
        $modelPath = "application/models/".$modelFile;
        if(file_exists($modelPath)) {
            include "application/models/".$modelFile;
        }

        $controllerFile = $controllerName.'.php';
        $controllerPath = "application/controllers/".$controllerFile;
        if(file_exists($controllerPath)) {
            include "application/controllers/".$controllerFile;
        } else {
            Route::ErrorPage404();
        }

        $controller = new $controllerName();

        if(!method_exists($controller, $actionName)) {
            $paramName = $action;
            $actionName = 'actionIndex';
            $controller->$actionName($paramName);
        } else
        if(method_exists($controller, $actionName)) {
            if (isset($paramName)) {
                $controller->$actionName($paramName);
            } else {
                $controller->$actionName();
            }

        } else {
            Route::ErrorPage404();
        }
    }

    function ErrorPage404() {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}
?>