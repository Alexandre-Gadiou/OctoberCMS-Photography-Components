<?php

namespace Algad\Photography\Helpers;

class StringUtils
{

    private static $_instance = null;

    private function __construct()
    {
        
    }

    public static function getInstance()
    {

        if (is_null(self::$_instance))
        {
            self::$_instance = new StringUtils();
        }

        return self::$_instance;
    }

    public function startsWith($haystack, $needle)
    {
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }

    public function endsWith($haystack, $needle)
    {
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }

}
