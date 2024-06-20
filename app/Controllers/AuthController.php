<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class AuthController extends Controller
{
    public function index()
    {

        $this->view('auth/login');
    }

    public function login()
    {

        $user = $this->auth()->attemtp($this->request()->input('username'), $this->request()->input('password'));

        if (!$user) {
            $this->session()->set('errors', [
                'errors' => 'Email yoki parrol notogti'
            ]);
            $this->redirect('/login');
        }

        $this->redirect('/');
    }

    public function logout()
    {
        $this->auth()->logout();
        $this->redirect('/');
    }
}
