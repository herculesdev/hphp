<?php
/**
 * User: Hércules
 * Date: 16/01/2019
 * Time: 18:19
 */

namespace Core;

class Config
{
    private static $conf = null;

    public static function get($key)
    {
        if(!self::$conf) {
            require "../app/config/config.php";
            self::$conf = $config;
        }

        return self::$conf[$key];
    }

    public static function add($key, $value)
    {
        self::$conf[$key] = $value;
    }
}