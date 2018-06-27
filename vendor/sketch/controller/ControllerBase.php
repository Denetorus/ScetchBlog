<?php

namespace sketch\controller;

use sketch\view\ViewBase;

abstract class ControllerBase
{
    public function render($fileName, $params = [])
    {
        $fileName = VIEW.'/'.$fileName;

        if (is_file($fileName)){
            $view = new ViewBase();
            return $view->render($fileName, $params);
        } else {
            return "This site made with use SKETCH framework ";
        }
    }
}
