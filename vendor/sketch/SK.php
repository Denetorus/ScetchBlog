<?php

namespace sketch;

use router\RouterMain;

class SK
{
    private static $props = [];
    private static $listCommands = [];
    private static $isRun = false;
    private static $router = "";
    private static $sign = "";
    public static $controllers_path = "";

    public static $settings_default = [
        "router" => "sketch/router/RouterBase",
        "controllers_path" => "controller",
        "sign" => "sketch/sign/SignBase",
    ];

    public static function setProps($props)
    {
        foreach ($props as $key => $value) {
            self::addProp($key, $value);
        }
    }
    public static function addProp($key, $value)
    {
        self::$props[$key] = $value;
    }
    public static function getProps()
    {
        return self::$props;
    }

    private static function setSettingsDefault($settings){
        foreach ($settings as $key => $value) {
            self::$settings_default[$key] = $value;
        }
    }
    private static function setRouters($routers)
    {
        foreach ($routers as $router) {

            if (! isset($router->path))
                continue;

            $path = "/{$router->path}/";
            $len = strlen($path);

            if (substr($_SERVER['REQUEST_URI'],0,$len) !== $path)
                continue;

            $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'],$len-1);
            self::$controllers_path = $router->path;

            if (isset($router->router)) {
                self::$router = new $router->router;
            }
            if (isset($router->sign)) {
                self::$sign = new $router->sign;
            }
            if (isset($router->config_local)) {
                self::loadConfig($router->config_local);
            }

            return true;
        }
        return false;
    }
    private static function checkSettings()
    {
        if (self::$controllers_path === "") {
            self::$controllers_path = self::$settings_default["controllers_path"];
        }
        if (self::$router === "") {
            self::$router = new self::$settings_default["router"];
        }
        if (self::$sign === "") {
            self::$sign = new self::$settings_default["sign"];
        }
    }
    public static function loadConfig($fileName)
    {
        if (! is_file($fileName))
            return false;

        $ext = json_decode(file_get_contents($fileName));
        if (isset($ext->default)) {
            self::setSettingsDefault($ext->default);
        }
        if (isset($ext->routers)) {
            self::setRouters($ext->routers);
        }
        if (isset($ext->props)) {
            self::setProps($ext->props);
        }

        self::checkSettings();
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

        self::$sign->run(['router' => self::$router]);

        while (self::runNext()) {}

        self::$isRun = false;
    }
}
