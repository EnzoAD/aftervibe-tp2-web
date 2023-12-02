<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
$flash = '';
    if(!empty($_SESSION['flash'])){
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de Alterar Senha</title>
  <link rel="stylesheet" href="../estilos/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body >
  <div class="container">
    <img src="../img/logo - copia.jpg" alt="">
    <form id="registerForm" method="POST" action="<?php echo $baseUrl ?>/functions/salva_senha.php?id=<?php echo $_GET['id'] ?>">

      
      <h2>Alterar Senha</h2>
      <?php if($flash): ?>
      <p class="flash animate__animated animate__shakeX"><?=$flash;?></p>
      <?php endif; ?>
      
      <label for="senha">Senha Atual:</label>
      <input type="password" id="senha" name="senha" required>

      <label for="senha">Senha Nova:</label>
      <input type="password" id="novasenha" name="novasenha" required>
      
      <button>Salvar</button><br>
      
    </form>
    <a class="form2" href= "<?php echo $baseUrl ?>/telas/conta.php?id= <?php echo $_GET['id']?>" ><button class="bt2" >Cancelar</button></a>
 
  </div>

  
</body>
</html>