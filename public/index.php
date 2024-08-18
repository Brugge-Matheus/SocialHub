<?php

require '../bootstrap.php';

$auth = new Auth(connect(), BASE);
dd($userInfo = $auth->checkToken());

// echo 'Index';