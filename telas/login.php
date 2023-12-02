<?php
require ("../banco/conexao.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
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
  <title>Tela de Login</title>
  <link rel="stylesheet" href="../estilos/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>
  <div class="container">
    <img src="../img/logo - copia.jpg" alt="">
    <form id="loginForm" method="POST" action="<?php echo $baseUrl?>/functions/LoginAcao.php">

      
      <h2>Login</h2>
      <?php if($flash): ?>
      <p class="flash animate__animated animate__shakeX"><?=$flash;?></p>
      <?php endif; ?>
      
      <label for="username">Usuário:</label>
      <input oninput="mascara(this)" type="text" id="username" name="username" required>
      
      <label for="password">Senha:</label>
      <input type="password" id="password" name="password" required>
      
      <button>Entrar</button>
      <p id="error-message"></p>
    </form>
    
    <p>Não tem uma conta? <a href="../telas/cadastro.php">Cadastre-se aqui</a>.</p>
  </div>

  
</body>
</html>
<script>
  function mascara(i){
   
   var v = i.value;
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
   }
   
   i.setAttribute("maxlength", "14");
   if (v.length == 3 || v.length == 7) i.value += ".";
   if (v.length == 11) i.value += "-";

}
</script>