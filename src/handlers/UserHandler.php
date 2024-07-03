<?php
namespace src\handlers;
use \src\models\User;

class UserHandler {
    public static function checkLogin() {
        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $data = User::select()->where('token', $token)->one();
            if(count($data) > 0) {
                
                $loggedUser = new User();
                
                $loggedUser->id = $data['id'];
                $loggedUser->name = $data['name'];
                $loggedUser->avatar = $data['avatar'];

                return $loggedUser;
            } 

        } 

        return false;
    }


    public static function verifyLogin($email, $passwd) {
        $user =  User::select()->where('email', $email)->one();

        if($user) {
            if(password_verify($passwd, $user['password'])) {

                $token = md5(time().rand(0,9999).time());

                User::update()
                    ->set('token', $token)
                    ->where('id', $user['id'])
                ->execute();

                return $token;
            }
        }

        return false;
    }


    public static function emailExists($email) {
        $user = User::select()->where('email', $email)->one();
        return $user ? true : false;
    }


    public static function idExists($id) {
        $user = User::select()->where('id', $id)->one();
        return $user ? true : false;
    }


    public static function getUser($id) {
        $data = User::select()->where('id', $id)->one();

        if($data) {
            $user = new User();

            $user->name = $data['name'];
            $user->avatar = $data['avatar'];
            $user->birthdate = $data['birthdate'];
            $user->city = $data['city'];
            $user->work = $data['work'];
            $user->avatar = $data['avatar'];
            $user->cover = $data['cover'];

            return $user;
        }

        return false;
    }


    public static function addUser($name, $email, $passwd, $birthdate) {
        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        $token = md5(time().rand(0,9999).time());

        User::insert([
            'email' => $email,
            'password' => $hash,
            'name' => $name,
            'birthdate' => $birthdate,
            'avatar' => 'default.jpg',
            'cover' => 'cover.jpg',
            'token' => $token
        ])
        ->execute();

        return $token;
    }
}