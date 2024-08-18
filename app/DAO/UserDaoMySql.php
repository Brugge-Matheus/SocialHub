<?php

require BASE_DIR . '/app/Models/User.php';

class UserDaoMySql implements UserDao
{
    private PDO $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function findByToken($token)
    {
        if (!empty($token)) {
            $connect = $this->pdo;

            $bindValues = [
                'token' => $token
            ];

            $query = $connect->prepare("SELECT * FROM users WHERE token = :token");
            $query->execute($bindValues);

            if ($query->rowCount() > 0) {
                $data = $query->fetch();
                return $data;
            }
        }
    }
}
