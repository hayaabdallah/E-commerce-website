<?php


$server="localhost";
$user="root";
$password="";
$db="animals";

try{

$pdo=new PDO("mysql:host=$server;dbname=mobile",$user,$password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "connected success";
}

catch (PDOException $e){

    echo "Connection failed: " . $e->getMessage();
}

?>