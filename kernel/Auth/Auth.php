<?php


namespace App\Kernel\Auth;

use App\Kernel\Database\Database;
use App\Kernel\Session\Session;
use App\Models\Users;
use PDO;

class Auth
{

    public function __construct(
        private Database $db,
        private Session $session,
    ) {
    }

    public function attemtp($username, $password)
    {

        $findUsername = '';

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $findUsername = "email";
        }else{
            $findUsername = "username";
        }

        $user = $this->db->first('users', [
            "$findUsername" => $username,
        ]);


        if (!$user){
            return false;
        }
        if (!password_verify($password, $user['password'])){
            return false;
        }
        
        if ($user){
            $this->session->set('user_id', $user['id']);
        }

        return true;
    }


    public function logout(){
        $this->session->remove('user_id');
    }

    public function check(){
        return $this->session->has('user_id');
    }

    public function users(){
        if (!$this->check()){
            return null;
        }
        $user = $this->db->first('users', [
            'id' => $this->session->get('user_id')
        ]);

        return new Users(
            id: $user['id'],
            firstName: $user['first_name'],
            surname: $user['surname'],
            username: $user['username'],
            email: $user['email'],
            password: $user['password']
        );
    }
}