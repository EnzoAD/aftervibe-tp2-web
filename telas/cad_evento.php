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
  <title>Tela de New Evento</title>
  <link rel="stylesheet" href="../estilos/estilo.css">
</head>
<body >
  <div class="container">
    <img src="../img/logo - copia.jpg" alt="">
    <form id="registerForm" method="POST" action ="<?php echo $baseUrl ?>/functions/salva_evento.php?id=<?php echo $_GET['id'] ?>" >

      
    <h2>Organizar Novo Evento</h2>
    
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="img">Caminho da Imagem:</label>
    <input type="text" id="img" name="img" required>
    
    <label for="datei">Data de Início:</label>
    <input type="date" id="datei" name="datei" required>

    <label for="timei">Hora de Início:</label>
    <input type="time" id="timei" name="timei" required>

    <label for="datef">Data de Fim:</label>
    <input type="date" id="datef" name="datef" required>

    <label for="timef">Hora de Fim:</label>
    <input type="time" id="timef" name="timef" required>

    <label for="situacao">Compra de Ingrssos:</label>
    <select name="situacao">
        <option value="0">Aberto</option>
        <option value="1" selected>Fechado</option>
    </select>

    <label for="descricao">Descrição do Evento:</label>
    <input type="text" id="descricao" name="descricao" >

    <button>Salvar</button><br>
      
    </form>
    <a class="form2" href= "<?php echo $baseUrl ?>/telas/meu_evento.php?id= <?php echo $_GET['id']?>" ><button class="bt2" >Cancelar</button></a>
 
  </div>

  
</body>
</html>