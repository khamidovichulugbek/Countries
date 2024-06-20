<?php

namespace App\Kernel\Router;

use App\Kernel\Auth\Auth;
use App\Kernel\Database\Database;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\Session;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    private array $routers = [
        'GET' => [],
        'POST' => []
    ];


    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private Session $session,
        private Redirect $redirect,
        private Database $database,
        private Auth $auth,
    )
    {
        $this->initRoutes();
    }
    public function dispatch(string $uri, string $method)
    {
        $route = $this->findRoutes($uri, $method);
        if (!$route) {
            $this->notFound();
        }

        if ($route->hasMiddlewares()){
            foreach ($route->getMiddlewares() as $middleware){
                $middleware = new $middleware($this->auth, $this->redirect);

                $middleware->handle();
            }
        }

        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();

            $controller = new $controller();
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setDb'], $this->database);
            call_user_func([$controller, 'setAuth'], $this->auth);

            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }

    private function notFound()
    {
        http_response_code(404);
        echo "404 Not found";
        exit;
    }

    private function findRoutes(string $uri, string $method)
    {

        if (!isset($this->routers[$method][$uri])) {
            return false;
        }

        return $this->routers[$method][$uri];
    }

    private function initRoutes(): void
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $this->routers[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    private function getRoutes()
    {
        return require_once APP_PATH . "/config/routes.php";
    }
}
