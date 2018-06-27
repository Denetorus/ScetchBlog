<?php

namespace sketch\sign\model;

use sketch\sign\SignModelInterface;

class SignConfigModel implements SignModelInterface
{
    public $path = '';
    public $id;
    public $username;

    public function signIn()
    {
        if ($this->path !== '') {
            include $this->path;
        }

        return[
            'id' => $this->id,
            'username' => $this->username
        ];
    }

    public function register()
    {
        return true;
    }
}
