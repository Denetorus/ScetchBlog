<?php

namespace api;


use sketch\controller\ControllerAPI;

class UserController extends ControllerAPI
{
    public function actionList(){
        return "User-List";
    }

    public function actionPut($id){
        return "User-Add-{$id}";
    }

    public function actionGet($id){
        return "User-Add-{$id}";
    }

}