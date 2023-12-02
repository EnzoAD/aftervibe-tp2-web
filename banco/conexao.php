<?php
$servername = "localhost"; //nome do servidor
$username = "root"; //nome do usuário do banco de dados
$password = ""; //senha do usuário do banco de dados
$dbname = "aftervibe"; //nome do banco de dados
$baseUrl = "http://localhost/TP2-Web";
session_start();
try{
    $pdo = new PDO("mysql:dbname=".$dbname.";host=".$servername, $username, $password);
    //echo "Connection established successfully.";
}catch(PDOException $e){
    echo "It was not possible to connect to the database. Erro: " . $e->getMessage();
}
?>