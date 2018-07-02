<?php

namespace rest;


use object\DBMain\UsersObj;
use sketchExt\rest\ControllerRest;

class UserController extends ControllerRest
{
    public function actionList(){
        return "User-List";
    }

    public function actionPut($id){
        return "User-Add-{$id}";
    }

    public function actionGet($id){
        $User = new UsersObj();
        if ($User->props === null) {
            return [];
        }

        var_dump($User->props);
        return $User->email;
    }

}