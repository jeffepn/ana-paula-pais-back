<?php

namespace App\Utility;

class MessageUtil
{
    public static function message($string)
    {
        $json = json_decode(file_get_contents(app_path() . '/filesutils/message.json'));

        return $json->{$string};
    }

    public static function success($string)
    {
        $json = json_decode(file_get_contents(app_path() . '/filesutils/success.json'));

        return $json->{$string};
    }

    public static function error($string)
    {
        $json = json_decode(file_get_contents(app_path() . '/filesutils/error.json'));

        return $json->{$string};
    }
}
