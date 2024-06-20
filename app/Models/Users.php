<?php


namespace App\Models;


class Users
{
    public function __construct(
        private $id,
        private $firstName,
        private $surname,
        private $username,
        private $email,
        private $password,
    ) {
    }


    public function id(){
        return $this->id;
    }

    
    public function firstName(){
        return $this->firstName;
    }

    
    public function surname(){
        return $this->surname;
    }

    
    public function username(){
        return $this->username;
    }

    
    public function email(){
        return $this->email;
    }

    
    public function password(){
        return $this->password;
    }

    

}
