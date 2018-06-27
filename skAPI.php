<?php

use sketch\SK;
use sketch\CommandObj;
use sketch\router\RouterAPI;

define("TYPE", "API");

include "config_sketch.php";

define('CONT', ROOT.'/api');
define("CONT_NAMESPACE", "api");

require_once(VENDOR.'/autoLoad.php');

SK::add(
    new CommandObj(
        new sign\SignMain(),
        [
            'router' => new RouterAPI(),
        ]
    )
);

SK::run(ROOT."/config_sk.json");

