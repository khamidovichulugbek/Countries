<?php

namespace App\Kernel\Controller;

use App\Kernel\Auth\Auth;
use App\Kernel\Container\Container;
use App\Kernel\Database\Database;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\Session;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

abstract class Controller
{
    private ViewInterface $view;
    private RequestInterface $request;
    private Session $session;
    public Redirect $redirect;
    public Database $db;
    public Auth $auth;

    public function __construct()
    {
    }
    public function view($path)
    {
        return $this->view->page($path);
    }

    public function setView(ViewInterface $view)
    {
        $this->view = $view;
    }

    public function request(){
        return $this->request;
    }

    public function setRequest(RequestInterface $request): void{
        $this->request = $request;
    }

    public function session(){
        return $this->session;
    }

    public function setSession(Session $session): void{
        $this->session = $session;
    }

    public function redirect($uri){
        return $this->redirect->to($uri);
    }

    public function setRedirect(Redirect $redirect){
        $this->redirect = $redirect;
    }

    public function db(){
        return $this->db;
    }

    public function setDb(Database $db){
        $this->db = $db;
    }

    public function auth(){
        return $this->auth;
    }

    public function setAuth(Auth $auth): void
    {
        $this->auth = $auth;
    }
}
