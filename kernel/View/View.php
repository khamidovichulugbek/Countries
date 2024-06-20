<?php


namespace App\Kernel\View;

use App\Kernel\Auth\Auth;
use App\Kernel\Session\Session;
use Exception;

class View implements ViewInterface
{
    public function __construct(
        private Session $session,
        private Auth $auth,
    )
    {
        
    }

    public function page($path)
    {
        $filePath = APP_PATH . "/view/$path.php";

        if (!file_exists($filePath)) {
            throw new Exception("View $path not found");
        }

        extract($this->defaultData());

        include_once $filePath;
    }

    public function components($path)
    {
        $filePath = APP_PATH . "/view/components/$path.php";

        if (!file_exists($filePath)) {
            throw new Exception("Component $path not found");
        }

        extract($this->defaultData());


        include_once $filePath;
    }

    private function defaultData()
    {
        return [
            'view' => $this,
            'session' => $this->session,
            'auth' => $this->auth,

        ];
    }
}
