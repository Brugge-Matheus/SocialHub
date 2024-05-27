<?php
namespace src\models;
use \core\Model;

class Post extends Model {
    public $user;

    public $mine;
    public $id;
    public $type;
    public $date;
    public $body;

    public $likeCount;
    public $liked;
    public $comments;
}