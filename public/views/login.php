<?php
require '../../bootstrap.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
    <link rel="stylesheet" href="<?= BASE ?>assets/css/login.css" />
</head>

<body>
    <header>
        <div class="container">
            <a href=""><img src="<?= BASE ?>assets/images/socialhub_logo.png" /></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action="<?= BASE ?>login_action.php">
            <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />

            <input placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input class="button" type="submit" value="Acessar o sistema" />

            <a href="<?= BASE ?>signup.php">Ainda não tem conta? Cadastre-se</a>
        </form>
    </section>
</body>

</html>