<?php

    $localhost = 'localhost';
    $dbname = 'forum_dbase';
    $name = 'root';
    $password = 'root';
    try{
        $pdo = new PDO('mysql:host=' . $localhost . ';dbname=' . $dbname, $name, $password);
    }catch(PDOException $e){
        print "Error!:" . $e->getMessage() . "<br/>";
        die();
    };

    $auth = False;
    if ($auth){
        if($_GET != null){
            
            //Другие темы

        }else{
            
            include_once 'themes.php';
            
        }

    }else{

        if($_GET != null){

            if (isset($_GET['reg'])){
            
                include_once 'reg.php';
            
            }else{
                
                include_once 'login.php';

            }
        
        }else{

            include_once 'login.php';

        }
    }
