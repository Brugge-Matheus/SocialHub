<?php

namespace src\helpers;

use core\Model;
use \src\models\User;

class LoginHelper
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

    public static function verifyLogin($email, $password)
    {
        $data = User::select()->where('email', $email)->one();

        // Debug
        // dd($data);

        $password = trim($password);

        if (!empty($data)) {
            // if (password_verify($password, $data->password)) {
            if ($password === $data->password) {
                $token = md5(time() . rand(1, 99999999));

                User::update()->set('token', $token)->where('email', $email)->execute();

                return $token;
            }
        }

        return false;
    }
}
