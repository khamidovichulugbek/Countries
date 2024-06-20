<?php


namespace App\Middlewares;

use App\Kernel\Middlewares\AbstractMiddlewares;

class AuthMiddlewares extends AbstractMiddlewares{
    public function handle()
    {
        if($this->auth->check()){
            $this->redirect->to('/');
        }
    }
}