<?php

use sketch\SK;
use sketch\CommandObj;

define("TYPE", "WEB");

include "config_sketch.php";

define('CONT', ROOT.'/controller');
define("CONT_NAMESPACE", "controller");

require_once(VENDOR.'/autoLoad.php');

SK::add(
    new CommandObj(
        new sign\SignMain(),
        [
            'router' => new router\RouterMain(),
        ]
    )
);

SK::run(ROOT."/config_sk.json");
