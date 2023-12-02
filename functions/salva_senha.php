<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);

$sql = $pdo->prepare("select * from login where id_usuario = :id and senha = :senha");
$sql->bindValue(':id', $_GET['id']);
$sql->bindValue(':senha', $_POST['senha']);
$sql->execute();

if($sql->rowCount() == 1){
    $events = $sql->fetch(PDO::FETCH_ASSOC);
    foreach($events as $event){
        $sql2 = $pdo->prepare("update login set senha = :senha where id_usuario = :id ");
        $sql2->bindValue(':id', $_GET['id']);
        $sql2->bindValue(':senha', $_POST['novasenha']);
        $sql2->execute();
        header("Location: ".$baseUrl.'/telas/conta.php?id='.$_GET['id']);
        exit;
    }
}else{
    $_SESSION['flash'] = 'Senha atual incorreta.';
}

header("Location: ".$baseUrl.'/telas/altera_senha.php?id='.$_GET['id']);
exit;