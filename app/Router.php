<?php

use app\Middleware\RedirectIfAuthenticated;

class Router{



    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    /**
     * Returns request string
     * */
    private function getURI(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        return false;
    }

    public function run()
    {
        //get string request
        $uri =  $this->getURI();

        foreach ($this->routes as $uriPattern => $path_middleware) {
//            dd($path_middleware);
            //compare $uriPattern and $uri


            if(preg_match("~$uriPattern~", $uri)){

                $path = $path_middleware[0];
                $middleware = isset($path_middleware[1]) ? $path_middleware[1] : '' ;

                if(empty($middleware) ||
                    RedirectIfAuthenticated::handle($middleware)) {
//                    dd($middleware);
                    //get inner path
                    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                    $segments = explode('/', $internalRoute);

                    //get Controller name
                    $controllerName = array_shift($segments) . 'Controller';
                    $controllerName = ucfirst($controllerName);

                    //get action name
                    $actionName = 'action' . ucfirst(array_shift($segments));
                    $parameters = $segments;

                    //include file class-controller
                    $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                    if (file_exists($controllerFile)) {
                        include_once($controllerFile);
                    }

                    //create object, call method(action)
                    $controllerObject = new $controllerName;

                    call_user_func_array([$controllerObject, $actionName], $parameters);

                    break;
                }
            }
        }
    }
}