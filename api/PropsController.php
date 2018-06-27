<?php

namespace api;

use sketch\SK;
use sketch\controller\ControllerBase;


class PropsController extends ControllerBase
{
    public function actionIndex()
    {
        return  SK::getProps();
    }
}
