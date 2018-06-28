<?php

namespace sketchExt\rest;

use sketch\SK;
use sketch\router\RouterBase;


class RouterREST extends RouterBase
{

    public function run($signParams=[])
    {
        $uri = $this->getUri();
        $controller_path = SK::$controllers_path;

        foreach ($this->routes() as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $parameters = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($parameters)).'Controller';

                $controllerFile = ROOT ."/". $controller_path ."/". $controllerName . '.php';
                if (! file_exists($controllerFile)) {
                    break;
                }

                include_once($controllerFile);

                $actionName = "action".$_SERVER["REQUEST_METHOD"];

                $className = $controller_path ."\\". $controllerName;
                $controllerObject = new $className;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result === null) {
                    break;
                }

                echo json_encode($result);

                break;
            }
        }

    }
}