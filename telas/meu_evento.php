<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Evento - AfterVibe</title>
  <link rel="stylesheet" href="../estilos/estilolist.css">
</head>
<body>
  <div class="container">
    <img src="../img/logo - copia.jpg" alt="">
    
    <ul>
      <li>
        <h2>Eventos Comprados</h2>
        <?php include '../functions/busca_compras.php' ?>
      </li>
      <li>
        <h2>Eventos Oganizados</h2>
        <?php include '../functions/busca_organizados.php' ?>
      </li>
    </ul>
    
  </div>
  <div class="container2">
    <?php include '../telas/menu.php' ?>
  </div>
</body>
</html>