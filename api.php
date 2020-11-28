<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
    header('Access-Control-Allow-Headers:Origin,Authorization, Content-Type, X-Requested-With, Accept');
    header('Access-Control-Allow-Credentials:false');
    header('Access-Control-Max-Age: -1');
    header('Content-type: text/html; charset=utf-8');

    $response = [];
    $time = time();

    $localhost = 'localhost';
    $dbname = 'ads_dbase';
    $name = 'root';
    $password = 'root';

    try{
        $pdo = new PDO('mysql:host=' . $localhost . ';dbname=' . $dbname, $name, $password);
    }catch(PDOEXception $e){
        'Error!:' . $e ->getmessage();
        die();
    }

    if (isset($_GET['api'])){
        if(isset($_GET['ad'])){
            include_once 'ad.php';
        }
        else if(isset($_GET['ads'])){
            include_once 'ads.php';
        }
    }else{

    };

    function apiResponse($array){
        $pdo = 0;
        header('Content-Type:aplication/json; charset=utf-8');
        echo json_encode($array);
    }