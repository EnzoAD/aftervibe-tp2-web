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
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de Alterar Dados</title>
  <link rel="stylesheet" href="../estilos/estilo.css">
</head>
<body >
  <div class="container">
    <img src="../img/logo - copia.jpg" alt="">
    <form id="registerForm" method="POST" action ="<?php echo $baseUrl ?>/functions/salva_dados.php?id=<?php echo $_GET['id'] ?>" >

      
      <h2>Alterar Dados</h2>
      
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" value ="<?php  echo $nome ?>" required>

      <label for="cpf">CPF:</label>
      <input oninput="mascara(this)" type="text" id="cpf" name="cpf" value ="<?php echo $cpf ?>" required>
      
      <button>Salvar</button><br>
      
    </form>
    <a class="form2" href= "<?php echo $baseUrl ?>/telas/conta.php?id= <?php echo $_GET['id']?>" ><button class="bt2" >Cancelar</button></a>
 
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