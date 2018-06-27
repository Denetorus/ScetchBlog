<?php

namespace sketch\sign\model;

use sketch\sign\SignModelInterface;

class SignWithoutModel implements SignModelInterface
{
    public function signIn()
    {
        return [
            'id' => 0,
            'username' => 'guest',
        ];
    }

    public function register()
    {
        return true;
    }
}
