<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
$sql = $pdo->prepare("select * from organizador where id_evento = :id");
$sql->bindValue(':id',$_GET['id_evento']);
$sql->execute();
$id_org =-1;
$events = $sql->fetchAll(PDO::FETCH_ASSOC);
if ($sql->rowCount() > 0) {
  foreach($events as $event){
    $id_org = $event['id_usuario'];
  }
}
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
    <?php include '../functions/busca_evento.php' ?>
  </div>
  <div class="container2">
    <?php include '../telas/menu.php' ?>
  </div>
  <?php
    if($_GET['id'] == $id_org){
      include '../telas/menu_org.php';
    }
  ?>
</body>
</html>