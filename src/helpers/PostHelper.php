<?php

namespace src\helpers;

use core\Model;
use \src\models\Post;
use \src\models\UserRelation;

class PostHelper
{
    public static function addPost(int $idUser, string $type, string $body): bool
    {
        $body = trim($body);

        if (!empty($idUser) and !empty($body)) {
            Post::insert([
                'id_user' => $idUser,
                'type' => $type,
                'created_at' =>  date('Y-m-d H:i:s'),
                'body' => $body
            ])->execute();

            return true;
        }

        return false;
    }

    public static function getHomeFeed(int $idUser): void
    {
        $userList = UserRelation::select()->where('user_from', $idUser)->get();
        $user = [];

        foreach ($userList as $userItem) {
            $user[] = $userItem->user_to;
        }

        $user[] = $idUser;
    }
}