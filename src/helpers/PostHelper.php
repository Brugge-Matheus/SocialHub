<?php

namespace src\helpers;

use core\Model;
use \src\models\Post;
use \src\models\User;
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

        $postList = Post::select()->where('id_user', 'in', $user)->orderBy('created_at', 'desc')->get();

        // Debug
        // dd($posts);

        $posts = [];
        foreach ($postList as $postItem) {
            $newPost = new Post();
            $newPost->type = $postItem->type;
            $newPost->created_at = $postItem->created_at;
            $newPost->body = $postItem->body;

            $newUser = User::select()->where('id', $postItem->id_user)->one();
            $newPost->userId = $newUser->id;
            $newPost->userName = $newUser->name;
            $newPost->userAvatar = $newUser->avatar;

            $posts[] = $newPost;

            // Debug
            // echo "<pre>";
            // print_r($postItem);
            // echo "</pre>";
        }


        dd($posts);
    }
}