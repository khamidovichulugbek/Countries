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

    public function profile()
    {
        $this->view('auth/profile');
    }


    public function update_profile()
    {
        $validation = [
            'first_name' => ['min:3'],
            'email' => ['email'],
        ];
        $validate = $this->request()->validate($validation);
        if (!$validate) {
            foreach ($this->request()->errors() as $key => $error) {
                $this->session()->set($key, $error);
            }

            $this->redirect('/profile');
        }

        try {
            $this->db()->update('users', [
                'id' => $this->request()->input('id')
            ], [
                'first_name' => $this->request()->input('first_name'),
                'surname' => $this->request()->input('surname'),
                'username' => $this->request()->input('username'),
                'email' => $this->request()->input('email')
            ]);
        } catch (\PDOException $e) {
            if ($e->getCode() == '23000') {
                $errror = explode(':', $e->getMessage());
                $message = explode("key ", $errror[2]);
                switch ($message[1]) {
                    case "'users.username'":
                        $this->session()->set('username', ['username' => 'Ushbu username avval ham royxatdan otgan']);
                    case "'users.email'":
                        $this->session()->set('email', ['email' => 'Ushbu email avval ham royxatdan otgan']);
                }
            }
        }


        $this->redirect('/profile');
    }
}
