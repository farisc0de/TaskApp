<?php

namespace App\Libraries;

class Token
{

    private $token;

    public function __construct($token = null)
    {
        if ($token == null) {
            $this->token = bin2hex(random_bytes(16));
        } else {
            $this->token = $token;
        }
    }

    public function getValue()
    {
        return $this->token;
    }

    public function getHash()
    {
        return sha1($this->token);
    }
}
