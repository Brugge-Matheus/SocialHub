<?php

namespace src\controllers;

use \core\Controller;
use src\helpers\LoginHelper;
use src\helpers\PostHelper;
use src\models\Post;

class PostController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = LoginHelper::checkLogin();

        if (!$this->loggedUser) {
            $this->redirect('/login');
        }
    }
    public function newPost()
    {
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($body) {
            PostHelper::addPost(
                $this->loggedUser->id,
                'text',
                $body
            );
        }

        $this->redirect('/');
    }
}