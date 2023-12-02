<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
$datei =($_POST['datei'] .' '.$_POST['timei'].':00');
$datef =($_POST['datef'] .' '.$_POST['timef'].':00');
$sql = $pdo->prepare("insert into programacao (nome, id_evento, data_inicio, data_fim, descricao) values (:nome, :id_event, :data_inicio, :data_fim, :descricao)");
$sql->bindValue(':nome', $_POST['nome']);
$sql->bindValue(':id_event', $_POST['idevento']);
$sql->bindValue(':data_inicio', $datei);
$sql->bindValue(':data_fim', $datef);
$sql->bindValue(':descricao', $_POST['descricao']);
$sql->execute();


header("Location: ".$baseUrl.'/telas/evento.php?id='.$_GET['id'].'&id_evento='.$_POST['idevento']);
exit;

?>