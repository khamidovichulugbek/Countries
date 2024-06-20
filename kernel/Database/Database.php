<?php

namespace App\Kernel\Database;

use App\Kernel\Config\Config;
use App\Kernel\Http\Redirect;
use App\Kernel\Session\Session;
use mysqli;
use \PDO;

class Database
{
    private \PDO $pdo;

    public function __construct(
        private Config $config,
        private Session $session,
        private Redirect $redirect

    ) {
        $this->connect();
    }


    
    public function first (string $table, array $conditions = []){
        $where = '';
        
        if (count($conditions) > 0){
            $where = 'WHERE ' . implode(', ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute($conditions);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ?: null;
    }


    public function insert(string $table, array $data)
    {
        // $data = ['name' => 'salom',
        //  'id' => ]
        $fields = array_keys($data);
        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($value) => ":$value", $fields));
        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";
        $stmt = $this->pdo->prepare($sql);


        $sqlTable = '';
        try {
            $stmt->execute($data);
        } catch (\PDOException $e) {

            if ($e->getCode() == "42S02") {
                switch ($table) {
                    case "users":
                        $sqlTable = "CREATE TABLE IF NOT EXISTS $table (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            first_name varchar(255) NOT NULL,
                            surname varchar(255) NOT NULL,
                            username varchar(255) NOT NULL UNIQUE,
                            email varchar(255) NOT NULL UNIQUE,
                            password varchar(255) NOT NULL,
                            CONSTRAINT uc_username_email UNIQUE (username, email)
                        )";
                        $this->pdo->exec($sqlTable);
                        $stmt->execute($data);
                        break;
                    case "country":

                        $sqlTable = "CREATE TABLE IF NOT EXISTS $table (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            name varchar(255) NOT NULL
                        )";
                        $this->pdo->exec($sqlTable);
                        $stmt->execute($data);

                        break;
                    case "regions":

                        $sqlTable = "CREATE TABLE IF NOT EXISTS $table (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            name varchar(255) NOT NULL,
                            country_id INT NOT NULL,
                            FOREIGN KEY(country_id) references country(id)
                        )";
                        $this->pdo->exec($sqlTable);
                        $stmt->execute($data);

                        break;
                    default:

                        exit("Table not access: {$e->getMessage()}");
                }
            }

            if ($e->getCode() == '23000') {
                $errror = explode(':', $e->getMessage());
                $message = explode("key ", $errror[2]);
                if ($message[1] == "'$table.username'") {
                    $this->session->set('username', ['username' => 'Ushbu username avval ham royxatdan otgan']);
                }

                if ($message[1] == "'$table.email'") {
                    $this->session->set('email', ['email' => 'Ushbu email avval ham royxatdan otgan']);
                }

                $this->redirect->to('/register');
            }
        }
    }


    

    private function connect()
    {
        $driver = $this->config->get('database.driver');
        // $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');
        $host = $this->config->get('database.host');



        try {
            $this->pdo = new \PDO(
                "$driver:host=$host;dbname=$database;charset=$charset",
                $username,
                $password
            );
        } catch (\PDOException $exception) {
            if ($exception->getCode() === 1049) {
                $conn = mysqli_connect($host, $username, $password);

                $sql = "CREATE DATABASE $database";
                mysqli_query($conn, $sql);

                mysqli_close($conn);
            }

            try {
                $this->pdo = new \PDO(
                    "$driver:host=$host;dbname=$database;charset=$charset",
                    $username,
                    $password
                );
            } catch (\PDOException $exception) {
                exit("Database connection failed: {$exception->getMessage()}");
            }
        }
    }
}
