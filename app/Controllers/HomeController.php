<?php

namespace App\Controllers;

use App\Kernel\Auth\Auth;
use App\Kernel\Controller\Controller;
use App\Kernel\View\View;
use App\Models\Users;

class HomeController extends Controller{
    public function index(){
        $this->view("home");
    }


    
}