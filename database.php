<?php

$localhost = 'localhost';
$dbname = 'ads_dbase';
$name = 'root';
$password = 'root';

// PDO
try{

    $pdo = new PDO('mysql:host=' . $localhost . ';dbname=' . $dbname, $name, $password); 

}catch(PDOException $e){

    print 'Error!:' . $e->getMessage() . "<br/>";
    die();

};
// DBASE
if (isset($_GET['create'])){
    
    $pdo -> exec("CREATE TABLE ads(
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Индивидуалный номер записи',
        time INT UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Время создания записи',
        tytle_ad TINYTEXT NOT NULL COMMENT 'Заголовок объявления',
        info_ad TINYTEXT NOT NULL COMMENT 'Информация об объявлении',
        contact_name TINYTEXT NOT NULL COMMENT 'Контактное имя',
        contact_phone TINYTEXT NOT NULL COMMENT 'Контактный телефон',
        date_end INT UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Время завершения объявления',
        file TINYTEXT NOT NULL COMMENT 'Название файла',
        PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
    );
    
    
}    

else if(isset($_GET['delete'])){
    
    $pdo -> exec('SET foreign_key_checks = 0;');

    $pdo -> exec('DROP TABLE ads;');
    
    $pdo -> exec('SET foreign_key_checks = 1;');
    
}else{
    http_response_code(404);
    exit();
}

