<?php

namespace src\models;

use \core\Model;

class Post extends Model
{
    public $type;
    public $created_at;
    public $body;
    public $userId;
    public $userAvatar;
    public $userName;
}
