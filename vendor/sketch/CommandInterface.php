<?php

namespace sketch;

interface CommandInterface
{
    public function run($params=[]);
}
