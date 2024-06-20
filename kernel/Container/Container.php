<?php

namespace App\Kernel\Container;

use App\Kernel\Auth\Auth;
use App\Kernel\Config\Config;
use App\Kernel\Database\Database;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Router\Router;
use App\Kernel\Router\RouterInterface;
use App\Kernel\Session\Session;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class Container
{
    public readonly ViewInterface $view;
    public readonly RouterInterface $router;
    public readonly RequestInterface $request;
    public readonly Session $session;
    public readonly Redirect $redirect;
    public readonly Database $database;
    public readonly Config $config;
    public readonly Auth $auth;

    public function __construct()
    {
        $this->registerService();
    }

    private function registerService()
    {
        $this->request = Request::createGlobal();
        $this->session = new Session();
        $this->redirect = new Redirect();
        $this->config = new Config();
        $this->database = new Database($this->config, $this->session, $this->redirect);
        $this->auth = new Auth($this->database, $this->session);
        $this->view = new View($this->session, $this->auth);
        $this->router = new Router(
            $this->view,
            $this->request,
            $this->session,
            $this->redirect,
            $this->database,
            $this->auth
        );
    }
}
