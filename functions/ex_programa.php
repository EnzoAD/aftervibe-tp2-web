<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);

$sql = $pdo->prepare("delete from ingresso_programacao where id_programacao = :id");
$sql->bindValue(':id', $_GET['id_programa']);
$sql->execute();

$sql2 = $pdo->prepare("delete from programacao where id = :id");
$sql2->bindValue(':id', $_GET['id_programa']);
$sql2->execute();

header('Location: '.$baseUrl.'/telas/evento.php?id='.$_GET["id"].'&id_evento='.$_GET["id_evento"]);
exit;
?>