<?php

namespace sketch\sign\model;

use sketch\sign\SignModelInterface;

class SignDBModel implements SignModelInterface
{

    public $dns = '';
    public $user = '';
    public $password = '';

    public function signIn()
    {
        return [
            'id' => 3,
            'username' => 'db',
        ];
    }

    public function getRegisterOptions()
    {
        return [];
    }
    public function register()
    {
        return true;
    }
}
