<?php
/**
 * Created by PhpStorm.
 * User: gfc-c
 * Date: 27.06.2018
 * Time: 21:00
 */

namespace sketchExt\rest;


abstract class ControllerREST
{
    public function actionGet($id)
    {
        return "GET";
    }

    public function actionPost($id)
    {
        return "POST";
    }

    public function actionPut($id)
    {
        return "PUT";
    }

    public function actionDelete($id)
    {
        return "DELETE";
    }

    public function actionView($id)
    {
        return "VIEW";
    }

    public function actionCopy($id)
    {
        return "COPY";
    }
}