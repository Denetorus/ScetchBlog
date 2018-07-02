<?php

namespace controller;

use sketch\controller\ControllerBase;

class TestController extends ControllerBase
{
    public function actionIndex()
    {
        return "test web is execute";
    }
}
