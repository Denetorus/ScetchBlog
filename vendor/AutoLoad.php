<?php

spl_autoload_register("autoLoad");

function autoLoad($className)
{
    $path = $className;
    $dirs = [
        '',
        '/vendor',
    ];

    $found = false;
    foreach ($dirs as $dir) {
        $fileName = ROOT . $dir. '/'. $path . '.php';
        if (is_file($fileName)) {
            require_once($fileName);
            $found = true;
            break;
        }
    }
    if (!$found) {
        throw new Exception('Нет файла класса для загрузки: ' . $path );
    }
    return true;
}

