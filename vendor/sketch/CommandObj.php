<?php

namespace sketch;

class CommandObj implements CommandInterface
{
    public $class;
    public $params = [];

    public function __construct(CommandInterface $class, $params = [])
    {
        $this->class = $class;
        $this->params = $params;
    }

    public function setParams($params = [])
    {
        $this->params = $params;
    }

    public function getParams(){
        return $this->params;
    }

    public function addParam($param){
        $this->params[] = $param;
    }

    public function removeParam($paramName){
        $this->params =
            array_filter($this->params, function($key) use($paramName){
                return $key != $paramName;
            });
    }

    public function run($params = [])
    {
        if ($params = []){
            $this->setParams($params);
        }
        $this->class->run($this->params);
    }
}