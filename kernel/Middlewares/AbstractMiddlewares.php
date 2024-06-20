<?php

namespace App\Kernel\Middlewares;

use App\Kernel\Auth\Auth;
use App\Kernel\Http\Redirect;

abstract class AbstractMiddlewares
{
    public function __construct(
        protected Auth $auth,
        protected Redirect $redirect
    ) {
    }
    
    abstract public function handle();
}
