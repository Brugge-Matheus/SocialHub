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
                $user = new User();
                $user->id = $data->id;
                $user->email = $data->email;
                $user->name = $data->name;
                $user->birthdate = $data->birthdate;
                $user->city = $data->city;
                $user->work = $data->work;
                $user->avatar = $data->avatar;
                $user->cover = $data->cover;
                $user->token = $data->token;

                return $user;
            }
        }

        return false;
    }

    public static function verifyLogin($email, $password): string|false
    {
        $data = User::select()->where('email', $email)->one();

        // Debug
        // dd($data);

        // $password = trim($password);

        if (!empty($data)) {
            if (password_verify($password, $data->password)) {
                // if ($password === $data->password) {
                $token = md5(time() . rand(1, 99999999));

                User::update()->set('token', $token)->where('email', $email)->execute();

                return $token;
            }
        }

        return false;
    }

    public static function emailExists(string $email): bool
    {
        $data = User::select()->where('email', $email)->get();

        return $data ? true : false;
    }

    public static function addUser(string $name, string $email, string $password, string $birthdate)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time() . rand(1, 99999999));

        $data = User::insert([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'birthdate' => $birthdate,
            'token' => $token
        ])->execute();

        return $token;
    }
}