<?php

namespace object\DBMain;

use database\DBMain;
use sketch\object\ObjectBase;

class UserObj extends ObjectBase
{
    public $username = "";
    public $auth_key = "";
    public $password_hash = "";
    public $password_reset_token = "";
    public $email = "";
    public $status = "";
    public $created_at = "";
    public $updated_at = "";

    public function __construct($id = null)
    {
        $this->table = "user";
        $this->db = DBMain::getInstance();
        $res = $this->db->select("SELECT * FROM users");
        var_dump($res);
        exit;
        parent::__construct($id);
    }
}