<?php

namespace object\DBMain;

use database\DBMain;
use sketch\object\ObjectBase;

class UsersObj extends ObjectBase
{

    public function __construct($id = 0)
    {
        $this->table = "users";
        $this->db = DBMain::getInstance();
        parent::__construct($id);
    }
}