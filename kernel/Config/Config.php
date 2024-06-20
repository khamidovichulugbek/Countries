<?php

namespace App\Kernel\Config;

use Exception;

class Config
{

    public function get(string $value, $default = null)
    {

        [$files, $key] = explode('.', $value);
        $filePath =  APP_PATH . "/config/$files.php";

        if (!file_exists($filePath)) {
            throw new Exception("Config $value not found");
        }
        $file = require $filePath;
        
        return  $file[$key] ?? $default;
    }
}
