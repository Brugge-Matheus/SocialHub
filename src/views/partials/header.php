<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Home - SocialHub</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="<?= $base ?>/"><img src="<?= $base ?>/assets/images/socialhub_logo.png" /></a>
            </div>
            <div class="head-side">
                <div class="head-side-left">
                    <div class="search-area">
                        <form method="GET" action="<?= $base ?>/search">
                            <input type="search" placeholder="Pesquisar" name="s" />
                        </form>
                    </div>
                </div>
                <div class="head-side-right">
                    <a href="" class="user-area">
                        <div class="user-area-text"><?= $user->name ?></div>
                        <div class="user-area-icon">
                            <img src="<?= $base ?>/media/avatars/<?= $user->avatar ?>" />
                        </div>
                    </a>
                    <a href="" class="user-logout">
                        <img src="<?= $base ?>/assets/images/power_white.png" />
                    </a>
                </div>
            </div>
        </div>
    </header>