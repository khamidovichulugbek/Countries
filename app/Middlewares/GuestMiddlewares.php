<?php


namespace App\Middlewares;

use App\Kernel\Middlewares\AbstractMiddlewares;

class GuestMiddlewares extends AbstractMiddlewares{
    public function handle()
    {
        if(!$this->auth->check()){
            $this->redirect->to('/login');
        }
    }
}