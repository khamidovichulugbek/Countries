<?php

namespace App\Kernel\Http;


interface RequestInterface
{
    public static function createGlobal();

    public function uri();
    public function method();
    public function input($key);
    public function validate($rules);
    public function errors();
}
