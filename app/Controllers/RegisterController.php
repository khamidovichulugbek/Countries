<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller{
    public function index(){
        $this->view('auth/register');
    }

    public function register() {
        $validation = [
            'first_name' => ['required', 'min:3'],
            'password' => ['required', 'min:3', 'confirm'],
            'password_confirmation' => ['required', 'min:3'],
        ];
        $validate = $this->request()->validate($validation);
        if (!$validate){
            foreach ($this->request()->errors() as $key => $error){
                $this->session()->set($key, $error);
            }

            $this->redirect('/register');
        }

        $this->db()->insert('users', [
            'first_name' => $this->request()->input('first_name'),
            'surname' => $this->request()->input('surname'),
            'username' => $this->request()->input('username'),
            'email' => $this->request()->input('email'),
            'password' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
        ]);

        dd('Saved');



    }
}