<?php

namespace sign;

use sketch\sign\SignBase;

/* USE SIGN FROM CONFIG FILE */
use sketch\sign\model\SignConfigModel;

/* USE SIGN FROM DATABASE */
use sketch\sign\model\SignDBModel;
use database\DBMain;

class SignMain extends SignBase
{

    public function options()
    {
        /* USE STANDARD SIGN */
        // return parent::options();

        /* USE SIGN FROM CONFIG FILE */
        /*
        return [
            'class' => SignConfigModel::class,
            'path' => SIGN.'/SignConfig.php'
         ];
        */

        /* USE SIGN FROM ATTRIBUTES */
        return [
            'class' => new SignConfigModel,
            'id' => 2,
            'username' => 'manager'
        ];


        /* USE SIGN FROM DATABASE */
        /* return [
            'class' => new SignDBModel,
            'db' => new DBMain
         ];
        */
    }

}
