<?php
require("banco/conexao.php");
require("models/Verifica.php");
require_once('models/Verifica.php');
require_once('DAO/Usuario.php');

$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Eventos - AfterVibe</title>
  <link rel="stylesheet" href="estilos/estilolist.css">
</head>
<body>
  <div class="container">
    <img src="img/logo - copia.jpg" alt="">
    <h2>Eventos</h2>
    <ul id="product-list">
        <?php include 'functions/lista.php' ?>
    </ul>
  </div>
  <div class="container2">
  <?php include 'telas/menu.php' ?>
  </div>
</body>
</html>
