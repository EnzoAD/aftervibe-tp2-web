<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
$di = $_POST['datei'].' '.$_POST['timei'].':00';
$df = $_POST['datef'].' '.$_POST['timef'].':00';

$sql = $pdo->prepare("update evento set nome = :nome , caminho_imagem = :img , data_inicio = :di , data_fim = :df , situacao = :situacao , descricao = :descricao where id = :id ");
$sql->bindValue(':id', $_GET['id_evento']);
$sql->bindValue(':nome', $_POST['nome']);
$sql->bindValue(':img', $_POST['img']);
$sql->bindValue(':di', $di);
$sql->bindValue(':df', $df);
$sql->bindValue(':situacao', $_POST['situacao']);
$sql->bindValue(':descricao', $_POST['descricao']);
$sql->execute();

header("Location: ".$baseUrl.'/telas/evento.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento']);
exit;
?>