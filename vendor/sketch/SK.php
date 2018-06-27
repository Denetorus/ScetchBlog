<?php

namespace sketch;

class SK
{
    private static $props = [];
    private static $listCommands = [];
    private static $isRun = false;

    private static function loadConfig($fileName)
    {
        $JSON = file_get_contents($fileName);
        $obj=json_decode($JSON);
        foreach ($obj as $keyObj=>$valueObj) {
            if ($keyObj === 'Props') {
                foreach ($valueObj as $key=>$value) {
                    self::$props[$key] = $value;
                }
            }
        }
    }

    public static function getProps()
    {
        return self::$props;
    }

    public static function addProps($key, $value)
    {
        self::$props[$key] = $value;
    }

    public static function add(CommandObj $obj)
    {
        self::$listCommands[] = $obj;
    }

    private static function removeCurrent()
    {
        if (count(self::$listCommands)===0){
            return false;
        }
        unset(self::$listCommands[0]);
        array_values(self::$listCommands);
        return true;
    }

    public static function runNext()
    {
        if (count(self::$listCommands)===0){
            return false;
        }
        $obj = array_shift(self::$listCommands);
        $obj->run();
        return true;
    }

    public static function run($fileName="")
    {
        if (self::$isRun) {
            return false;
        };

        self::$isRun = true;
        if ($fileName !== "") {
            self::loadConfig($fileName);
        }

        while (self::runNext()) {}

        self::$isRun = false;
    }
}
