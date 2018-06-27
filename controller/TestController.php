<?php

namespace controller;

use sketch\controller\ControllerBase;

class TestController extends ControllerBase
{
    public function actionIndex()
    {
        echo "test is execute";
        return  "";
    }
}
