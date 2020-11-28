<?php

if(isset($_GET['action'])){
    $query=$pdo->("SELECT * FROM users WHERE user_email= '{$user_email} ' ") 
}else{

echo '
<!DOCTYPE html>
<html>
<head>
    <title>Мини-Форум</title>
</head>
<body>
';

echo '
    <form method="post" action = "/index.php?login&action">
        <lable>Email</lable>
        <input name = "email" type = "text"/>
        <lable>Пароль</lable>
        <input name = "password" type = "passwpd"/>
        <input type="submit">Авторизация</input>
        <a href = "index.php?reg">Регистрация</a>

    </form>';

echo '
    </body>
    </html>
';

};
