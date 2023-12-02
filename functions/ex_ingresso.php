<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);


$sql = $pdo->prepare("delete from compras where id_ingresso = :id");
$sql->bindValue(':id', $_GET['id_ingresso']);
$sql->execute();

$sql2 = $pdo->prepare("delete from ingresso_programacao where id_ingresso = :id");
$sql2->bindValue(':id', $_GET['id_ingresso']);
$sql2->execute();

$sql = $pdo->prepare("delete from ingresso where id = :id");
$sql->bindValue(':id', $_GET['id_ingresso']);
$sql->execute();


header('Location: '.$baseUrl.'/telas/evento.php?id='.$_GET["id"].'&id_evento='.$_GET["id_evento"]);
exit;
?>