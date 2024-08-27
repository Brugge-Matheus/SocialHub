<?php

namespace src\models;

use \core\Model;

class User extends Model
{
    public $id;
    public $email;
    public $name;
    public $birthdate;
    public $city;
    public $work;
    public $avatar;
    public $cover;
    public $token;
}