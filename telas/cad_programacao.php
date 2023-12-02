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
  <title>Tela de New Programa</title>
  <link rel="stylesheet" href="../estilos/estilo.css">
</head>
<body >
  <div class="container">
    <img src="../img/logo - copia.jpg" alt="">
    <form id="registerForm" method="POST" action ="<?php echo $baseUrl ?>/functions/salva_programa.php?id=<?php echo $_GET['id'] ?>" >

      
    <h2>Organizar Novo Evento (Programação)</h2>
    
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>
    
    <label for="datei">Data de Início:</label>
    <input type="date" id="datei" name="datei" required>

    <label for="timei">Hora de Início:</label>
    <input type="time" id="timei" name="timei" required>

    <label for="datef">Data de Fim:</label>
    <input type="date" id="datef" name="datef" required>

    <label for="timef">Hora de Fim:</label>
    <input type="time" id="timef" name="timef" required>

    <label for="descricao">Descrição do Programa:</label>
    <input type="text" id="descricao" name="descricao" >

    <input type="text" id="idevento" name="idevento" value=<?php echo $_GET['id_evento'] ?>>

    <button>Salvar Programa</button><br>
      
    </form>
    <a class="form2" href= "<?php echo $baseUrl ?>/telas/evento.php?id= <?php echo $_GET['id'].'&id_evento='.$_GET['id_evento']?>" ><button class="bt2" >Cancelar</button></a>
 
  </div>

  
</body>
</html>