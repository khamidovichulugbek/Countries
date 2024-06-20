<?php

namespace App\Kernel\Http;

use App\Kernel\Validation\Validation;

class Request implements RequestInterface
{

    private Validation $validation;

    public function __construct(
        private array $get,
        private array $post,
        private array $files,
        private array $cookie,
        private array $server,
    ) {
        $this->validation = new Validation();
    }


    public static function createGlobal()
    {
        return new static(
            $_GET,
            $_POST,
            $_FILES,
            $_COOKIE,
            $_SERVER
        );
    }

    public function uri()
    {
        return $this->server['REQUEST_URI'];
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function input($key)
    {
        return $this->post[$key] ?? $this->get[$key] ?? null;
    }

    public function validate($rules)
    {
        // name => []
        $data = [];
        foreach ($rules as $key => $rule) {
            $data[$key] = $this->input($key);
        }

        return $this->validation->validate($data, $rules);
    }

    public function errors()
    {
        return $this->validation->errors();
    }
}
