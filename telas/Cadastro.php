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
  <title>Tela de Cadastro</title>
  <link rel="stylesheet" href="../estilos/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body >
  <div class="container">
    <img src="../img/logo - copia.jpg" alt="">
    <form id="registerForm" method="POST" action="<?php echo $baseUrl?>/functions/Cadastrar.php">

      
      <h2>Cadastro</h2>
      <?php if($flash): ?>
      <p class="flash animate__animated animate__shakeX"><?=$flash;?></p>
      <?php endif; ?>

      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="cpf">CPF:</label>
      <input oninput="mascara(this)" type="text" id="cpf" name="cpf" required>
      
      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" required>
      
      <button>Cadastrar</button>
      <p id="register-message"></p>
    </form>
    
    <p>Já tem uma conta? <a href="../telas/login.php">Faça login aqui</a>.</p>
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