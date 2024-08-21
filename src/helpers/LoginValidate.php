<?php

namespace src\helpers;

use core\Model;
use \src\models\User;

class LoginValidate
{
    public static function checkLogin()
    {
        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $data = User::select()->where('token', $token)->one();

            if (!empty($data)) {
                return $data;
            }
        }

        return false;
    }
}