<?php
// dd("BASE: " . BASE, "BASE_DIR: " . BASE_DIR);
require BASE_DIR . '/app/DAO/UserDaoMySql.php';

class Auth
{

    private PDO $pdo;
    private string $base;

    public function __construct(PDO $driver, string $base)
    {
        $this->pdo = $driver;
        $this->base = $base;
    }

    public function checkToken()
    {
        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $userDao = new UserDaoMySql($this->pdo);
            $user = $userDao->findByToken($token);

            if (!empty($user)) {
                return $user;
            }
        }

        // dd($this->base . "views/login.php");
        header("Location: " . $this->base . "views/login.php");
        exit;
    }
}
