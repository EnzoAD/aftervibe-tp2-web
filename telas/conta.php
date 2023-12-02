<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
$sql = $pdo->prepare("select * from usuario where id = :id");
$sql->bindValue(':id', $_GET['id']);
$sql->execute();
if ($sql->rowCount() > 0) {
    $events = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($events as $event) {
        
        $cpf =$event['cpf'];
        $nome = $event['nome'];
        $credito = $event['credito'];
        $id = $event['id'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Eventos - AfterVibe</title>
  <link rel="stylesheet" href="../estilos/estilolist.css">
</head>
<body>
  <div class="container">
    <img src="img/logo - copia.jpg" alt="">
    <h2>Dados Pessoais</h2>
    <div>Nome: <?php echo $nome ?></div><br>
    <div>Usuário/Cpf:<?php echo $cpf ?></div><br>
    <div>Senha: <a href="<?php echo $baseUrl ?>/telas/altera_senha.php?id=<?php echo $_GET['id'] ?>"><button style="background-color: blue" >Alterar Senha</button></a></div><br>
    <div>Crédito: <?php echo $credito ?> AfterPoints</div>
    <div style="font-size: 8px;">Cada AfterPoint equiva à R$0,50 de <br>desconto na sua próxima compra.</div>
    <br><a href="<?php echo $baseUrl ?>/telas/altera_dados.php?id=<?php echo $_GET['id'] ?>"><button style="background-color: blue" >Editar Dados</button></a>
  </div>
  <div class="container2">
    <?php include '../telas/menu.php' ?>
  </div>
</body>
</html>
