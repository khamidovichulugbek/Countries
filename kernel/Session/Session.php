<?php 

namespace App\Kernel\Session;


class Session {
    public function __construct()
    {
        session_start();
    }


    public function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public function get($key){
        return $_SESSION[$key];
    }


    public function getFlash($key){
        $value = $this->get($key);
        $this->remove($key);

        return $value;
    }


    public function has($key){
        return isset($_SESSION[$key]);
    }

    public function remove($key) {
        unset($_SESSION[$key]);
    }

    public function destroy(){
        session_destroy();
    }
}