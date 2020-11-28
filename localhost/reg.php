<?php
    
    $error = null;
    
    if(isset($_GET['reg'])&& isset($_GET['action'])){
        if(isset($_POST['email']) 
            && isset($_POST['name']) 
            && isset($_POST['surname']) 
            && isset($_POST['pass'])
            && (strlen($_POST['email']))
            && (strlen($_POST['name']))
            && (strlen($_POST['surname']))
            && (strlen($_POST['pass'])))
            
            {
            $user_email = $_POST['email'];
            $user_name = $_POST['name'];
            $user_surname = $_POST['surname'];
            $user_password = $_POST['pass'];
            $user_type = 'Пользователь';
            $user_block = 0;

            $query = $pdo->query("SELECT * FROM users WHERE user_email = '{$user_email}'");
            $user = $query ->fetch(PDO::FETCH_ASSOC);
            
            if($user){
                $error = 'Пользователь с такой почтой существует';
            }else{
                
                $prepare = $pdo ->prepare("INSERT INTO users(
                                                    user_email,
                                                    user_name,
                                                    user_surname,
                                                    user_password,
                                                    user_type,
                                                    user_block)
                                                    
                                                    values(
                                                        :user_email,
                                                        :user_name,
                                                        :user_surname,
                                                        :user_password,
                                                        :user_type,:user_block
                                                    )");
                

                $prepare ->bindValue(":user_email", $user_email);
                $prepare ->bindValue(":user_name" , $user_name);
                $prepare ->bindValue(":user_surname", $user_surname);
                $prepare ->bindValue(":user_password", $user_password);
                $prepare ->bindValue(":user_type", $user_type);
                $prepare ->bindValue(":user_block", $user_block);
                $execute = $prepare -> execute();
            
                if($execute){
                    header('Location: /index.php');
                }          
                else{
                    $error = "Не удалось зарегистрироваться";
                    };                                              
            };
        }else{
            $error = 'Нет всех обязательных данных';
        }

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
    <form method = "post" action = "/index.php?reg&action">
        <lable>Email</lable>
        <input name = "email"/>
        <lable>Имя</lable>
        <input name = "name"/>
        <lable>Фамилия</lable>
        <input name = "surname"/>
        <lable>Пароль</lable>
        <input name = "pass" type = "password"/>
        <input type = "submit" value = "Регистрация">
        
    </form>
    ';
    echo '
    <a href = "index.php">Войти</a>
    
    <div>
    ';
    echo $error;
    
    echo '</div>';
    echo '
    </body>
    </html>';}