<?php
namespace src\models;
use \core\Model;

class Post extends Model {
    public $user;

    public  int $id;
    public  $type;
    public  $date;
    public  $body;
}