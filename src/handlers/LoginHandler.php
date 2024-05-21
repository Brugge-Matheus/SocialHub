<?php
namespace src\handlers;
use \src\models\User;

class LoginHandler {
    public static function checkLogin() {
        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['tpken'];

            $data = User::select()->where('token', $token)->one();
            if(count($data) > 0) {
                
                $loggedUser = new User();
                
                $loggedUser->setId($data['id']);
                $loggedUser->setEmail($data['email']);
                $loggedUser->setName($data['name']);

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
}