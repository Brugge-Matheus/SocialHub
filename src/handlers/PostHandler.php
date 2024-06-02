<?php
namespace src\handlers;

use \src\models\Post;
use \src\models\User;
use \src\models\UserRelation;

class PostHandler {

    public static function addPost($idUser, $type, $body) {
        $body = trim($body);
        date_default_timezone_set('America/Sao_Paulo');

        if(!empty($idUser) && !empty($body)) {
            Post::insert([
                'id_user' => $idUser,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'body' => $body
            ])
            ->execute();
        }
        
    }


    public static function getHomeFeed($idUser, $page) {
        $perPage = 2;

        // 1. Pegar lista de usúarios que eu sigo
        $userList = UserRelation::select()->where('user_from', $idUser)->get();
        $users = [];
        foreach($userList as $userItem) {
            $users[] = $userItem['user_to'];
        }

        $users[] = $idUser;

        // 2. Pegar os posts dessa galera ordenado pela data
        $postList = Post::select()
            ->where('id_user', 'in', $users)
            ->orderBy('created_at', 'desc')
            ->page($page, $perPage)
        ->get();
        
        // 2.1 Pega os posts por página
        $total = Post::select()
            ->where('id_user', 'in', $users)
        ->count();
        $pageCount = ceil($total/$perPage);
        

        // 3. Transformar o resultado em objetos dos models
        $posts = [];

        foreach($postList as $postItem) {
            $newPost = new Post();

            $newPost->id = $postItem['id'];
            $newPost->type = $postItem['type'];
            $newPost->date = $postItem['created_at'];
            $newPost->body = $postItem['body'];
            $newPost->mine = false;

            if($postItem['id_user'] == $idUser) {
                $newPost->mine = true;
            }

            // 4. Preecher as informações adicionais no post
            $newUser = User::select()->where('id', $postItem['id_user'])->one();

            $newPost->user = new User();
            $newPost->user->id = $newUser['id'];
            $newPost->user->name = $newUser['name'];
            $newPost->user->avatar = $newUser['avatar'];


            //TODO: Pegar as informações de likes
            $newPost->likeCount = 0;
            $newPost->liked = true;

            //TODO: Pegar as informações de comentários
            $newPost->comments = [];


            $posts[] = $newPost;
        }
        // 5. Retornar o resultado
        return [
            'posts' => $posts,
            'pageCount' => $pageCount
        ];
    }
}