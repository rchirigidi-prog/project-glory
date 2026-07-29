<?php

namespace App\Config;

class Languages
{
    public static function all(): array
    {
        return [
            'English'       => 'English',
            'Hindi'         => 'Hindi',
            'Telugu'        => 'Telugu',
            'Tamil'         => 'Tamil',
            'Malayalam'     => 'Malayalam',
            'Kannada'       => 'Kannada',
            'Instrumental'  => 'Instrumental',
            'Multi-language'=> 'Multi-language',
        ];
    }
}