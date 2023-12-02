<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);

$sql = $pdo->prepare("update usuario set nome = :nome , cpf = :cpf where id = :id ");
$sql->bindValue(':id', $_GET['id']);
$sql->bindValue(':nome', $_POST['nome']);
$sql->bindValue(':cpf', $_POST['cpf']);
$sql->execute();

header("Location: ".$baseUrl.'/telas/conta.php?id='.$_GET['id']);
exit;
?>