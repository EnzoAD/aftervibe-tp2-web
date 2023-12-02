<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);


$sql = $pdo->prepare("select * from ingresso where id_evento = :id");
$sql->bindValue(':id', $_GET['id_evento']);
$sql->execute();
$events = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach($events as $event){
    $sql2 = $pdo->prepare("delete from compras where id_ingresso = :id");
    $sql2->bindValue(':id', $event['id']);
    $sql2->execute();

    $sql3 = $pdo->prepare("delete from ingresso_programacao where id_ingresso = :id");
    $sql3->bindValue(':id', $event['id']);
    $sql3->execute();
}

$sql4 = $pdo->prepare("delete from programacao where id_evento = :id");
$sql4->bindValue(':id', $_GET['id_evento']);
$sql4->execute();

$sql5 = $pdo->prepare("delete from ingresso where id_evento = :id");
$sql5->bindValue(':id', $_GET['id_evento']);
$sql5->execute();

$sql6 = $pdo->prepare("delete from organizador where id_evento = :id");
$sql6->bindValue(':id', $_GET['id_evento']);
$sql6->execute();

$sql7 = $pdo->prepare("delete from evento where id = :id");
$sql7->bindValue(':id', $_GET['id_evento']);
$sql7->execute();

header("Location: ".$baseUrl.'/index.php?id='.$_GET['id']);
exit;
?>