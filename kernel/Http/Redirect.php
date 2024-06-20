<?php

namespace App\Kernel\Http;


class Redirect{
    public function to($uri){
        header("Location: $uri");
        exit;
    }
}