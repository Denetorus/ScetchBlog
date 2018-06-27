<?php

namespace sketch\database;

use sketch\database\DBSQL;

abstract class DBBase
{
    public static function getInstance()
    {
        if (static::$DB === null) {
            static::$DB = new DBSQL();
            static::$DB->Connect(static::GetAttributes());
        };
        return static::$DB;
    }

    public static function getAttributes()
    {
        return [
            'dsn' => '',
            'user' => '',
            'password' => ''
        ];
    }
}
