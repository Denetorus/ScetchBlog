<?php

namespace object\DBMain\migration;

use database\DBMain;
use sketch\database\MigrateBase;

class Migrate extends MigrateBase
{
    public function __construct()
    {
        $this->db = DBMain::getInstance();
    }
}
