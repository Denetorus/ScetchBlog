<?php

namespace console;

use sketch\CommandObj;
use sketch\SK;

class MigrateController
{
    public function actionIndex()
    {
        SK::add(
            new CommandObj(
                new \object\DBMain\migration\Migrate(),
                $_SERVER['argv']
            )
        );
    }

}