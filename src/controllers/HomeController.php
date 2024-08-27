<?php

namespace src\controllers;

use \core\Controller;
use src\helpers\LoginHelper;
use src\helpers\PostHelper;

class HomeController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = LoginHelper::checkLogin();

        if (!$this->loggedUser) {
            $this->redirect('/login');
        }
    }

    public function index()
    {
        $feed = PostHelper::getHomeFeed($this->loggedUser->id);

        $this->render(
            'home',
            [
                'user' => $this->loggedUser,
                'feed' => $feed
            ]
        );
    }
}