<?php

namespace sketch\router;

use sketch\SK;
use sketch\CommandInterface;

class RouterBase implements CommandInterface
{
    public function routes()
    {
        return [
            '([a-z]+)/([a-z]+)' => '$1/$2',
            '([a-z]+)' => '$1',
            '' => 'home/index',
        ];
    }

    public function getUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }
        return '';
    }

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

                $actionName = ucfirst(array_shift($parameters));
                if ($actionName === '') {
                    $actionName='index';
                }
                $actionName = 'action'.$actionName;

                include_once($controllerFile);

                $className = $controller_path.'\\'.$controllerName;
                $controllerObject = new $className;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result === null) {
                    break;
                }

                echo $result;

                break;
            }
        }
    }
}
