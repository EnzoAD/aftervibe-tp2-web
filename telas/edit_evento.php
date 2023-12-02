<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
$sql = $pdo->prepare("select * from evento where id = :id");
$sql->bindValue(':id', $_GET['id_evento']);
$sql->execute();

if ($sql->rowCount() > 0) {
    $events = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($events as $event) {
        $nome = $event['nome'];
        $img = $event['caminho_imagem'];
        $datei = date('Y-m-d',  strtotime($event['data_inicio']));
        $datef = date('Y-m-d',  strtotime($event['data_fim']));
        $timei = date('H:i', strtotime($event['data_inicio']));
        $timef = date('H:i', strtotime($event['data_fim']));
        $situacao = $event['situacao'];
        $descricao = $event['descricao'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de New Evento</title>
  <link rel="stylesheet" href="../estilos/estilo.css">
</head>
<body >
  <div class="container">
    <img src="img/logo - copia.jpg" alt="">
    <form id="registerForm" method="POST" action ="<?php echo $baseUrl ?>/functions/atualiza_evento.php?id=<?php echo $_GET['id'].'&id_evento='.$_GET['id_evento'] ?>" >

      
    <h2>Editar Evento</h2>
    
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $nome ?>" required>

    <label for="img">Caminho da Imagem:</label>
    <input type="text" id="img" name="img" value="<?php echo $img ?>" required>
    
    <label for="datei">Data de Início:</label>
    <input type="date" id="datei" name="datei" value="<?php echo $datei ?>" required>

    <label for="timei">Hora de Início:</label>
    <input type="time" id="timei" name="timei" value="<?php echo $timei ?>" required>

    <label for="datef">Data de Fim:</label>
    <input type="date" id="datef" name="datef" value="<?php echo $datef ?>" required>

    <label for="timef">Hora de Fim:</label>
    <input type="time" id="timef" name="timef" value="<?php echo $timef ?>" required>

    <label for="situacao">Compra de Ingrssos:</label>
    <select name="situacao">
        <option value="0" <?php if($situacao==0){echo 'selected';}?>>Aberto</option>
        <option value="1" <?php if($situacao==1){echo 'selected';}?>>Fechado</option>
    </select>

    <label for="descricao">Descrição do Evento:</label>
    <input type="text" id="descricao" name="descricao" value="<?php echo $descricao ?>" >

    <button>Salvar</button><br>
      
    </form>
    <a class="form2" href= "<?php echo $baseUrl ?>/telas/evento.php?id= <?php echo $_GET['id'].'&id_evento='.$_GET['id_evento']?>" ><button class="bt2" >Cancelar</button></a>
 
  </div>
