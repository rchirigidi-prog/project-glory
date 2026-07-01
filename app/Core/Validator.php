<?php

namespace App\Core;

class Validator
{
    public static function required($value)
    {
        return trim($value)!=='';
    }

    public static function email($email)
    {
        return filter_var($email,FILTER_VALIDATE_EMAIL);
    }
}