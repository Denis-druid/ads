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
        ad_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Индивидуалный номер записи',
        ad_key TINYTEXT NOT NULL COMMENT 'Уникальный ключ',
        tytle_ad TINYTEXT NOT NULL COMMENT 'Заголовок объявления',
        info_ad TINYTEXT NOT NULL COMMENT 'Информация об объявлении',
        contact_name TINYTEXT NOT NULL COMMENT 'Контактное имя',
        contact_phone TINYTEXT NOT NULL COMMENT 'Контактный телефон',
        date_end INT UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Время завершения объявления',
        file TINYTEXT NOT NULL COMMENT 'Название файла',
        time INT UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Время создания записи',
        del INT UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Время удаления записи',
        PRIMARY KEY (ad_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
    );
    print_r ($pdo-> errorInfo());
    
    
}    

else if(isset($_GET['delete'])){
    
    $pdo -> exec('SET foreign_key_checks = 0;');

    $pdo -> exec('DROP TABLE ads;');
    
    $pdo -> exec('SET foreign_key_checks = 1;');
    
}else{
    http_response_code(404);
    exit();
}

