<?php

namespace rest;


use sketchExt\rest\ControllerREST;

class UserController extends ControllerREST
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