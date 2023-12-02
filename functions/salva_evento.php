<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
$datei =($_POST['datei'] .' '.$_POST['timei'].':00');
$datef =($_POST['datef'] .' '.$_POST['timef'].':00');
$sql = $pdo->prepare("insert into evento (nome, caminho_imagem, data_inicio, data_fim, situacao, descricao) values (:nome, :caminho_imagem, :data_inicio, :data_fim, :situacao, :descricao)");
$sql->bindValue(':nome', $_POST['nome']);
$sql->bindValue(':caminho_imagem', $_POST['img']);
$sql->bindValue(':data_inicio', $datei);
$sql->bindValue(':data_fim', $datef);
$sql->bindValue(':situacao', $_POST['situacao']);
$sql->bindValue(':descricao', $_POST['descricao']);
$sql->execute();

$sql2 = $pdo->prepare("select max(id) as id from evento");
$sql2->execute();
$events = $sql2->fetchAll(PDO::FETCH_ASSOC);
foreach($events as $event){
    $sql3 = $pdo->prepare("insert into organizador (id_usuario, id_evento) values (:id_usuario, :id_evento)");
    $sql3->bindValue(':id_usuario', $_GET['id']);
    $sql3->bindValue(':id_evento', $event['id']);
    $sql3->execute();
    header("Location: ".$baseUrl.'/telas/evento.php?id='.$_GET['id'].'&id_evento='.$event['id']);
    exit;
}
?>