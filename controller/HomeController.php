<?php

namespace controller;

use sketch\SK;
use sketch\controller\ControllerBase;


class HomeController extends ControllerBase
{
    public function actionIndex()
    {
        return  $this->render("home/index.php", [ "SK_props" => SK::getProps() ]);
    }
}
