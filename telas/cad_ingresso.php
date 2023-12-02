<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
$sql = $pdo->prepare("select * from programacao where id_evento = :id");
$sql->bindValue(':id', $_GET['id_evento']);
$sql->execute();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de New Ingresso</title>
  <link rel="stylesheet" href="../estilos/estilo.css">
</head>
<body >
  <div class="container">
    <img src="../img/logo - copia.jpg" alt="">
    <form id="registerForm" method="POST" action ="<?php echo $baseUrl ?>/functions/salva_ingresso.php?id=<?php echo $_GET['id'] ?>" >

      
    <h2>Organizar Novo Evento (Ingresso)</h2>

    <input type="text" id="idevento" name="idevento" value=<?php echo $_GET['id_evento'] ?>>
    
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>
    
    <label for="preco">Preço:</label>
    <input type="Text" size="12" onKeyUp="mascaraMoeda(this, event)" id="preco" name="preco" value="">

    <label for="descricao">Descrição do Ingresso:</label>
    <input type="text" id="descricao" name="descricao" >

    <label for="checkboxes">Programação:</label>    
    <div id="checkboxes">
        <?php
            if ($sql->rowCount() > 0){
                $i=1;
                $events = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach ($events as $event) {
                    echo '<label for="op'.$i.'">
                    <input type="checkbox" id="op'.$i.'" name="op'.$i.'" />'.$event['nome'].'</label>';
                    $i++;
                }
            }
        ?>
    </div>

    <input type="text" id="idevento" name="quantidade" value=<?php echo $i-- ?>>

    <button>Salvar Programa</button><br>
      
    </form>
    <a class="form2" href= "<?php echo $baseUrl ?>/telas/evento.php?id= <?php echo $_GET['id'].'&id_evento='.$_GET['id_evento']?>" ><button class="bt2" >Cancelar</button></a>
 
  </div>

  
</body>
</html>
<script>
String.prototype.reverse = function(){
  return this.split('').reverse().join(''); 
};

function mascaraMoeda(campo,evento){
  var tecla = (!evento) ? window.event.keyCode : evento.which;
  var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
  var resultado  = "";
  var mascara = "##.###.###,##".reverse();
  for (var x=0, y=0; x<mascara.length && y<valor.length;) {
    if (mascara.charAt(x) != '#') {
      resultado += mascara.charAt(x);
      x++;
    } else {
      resultado += valor.charAt(y);
      y++;
      x++;
    }
  }
  campo.value = resultado.reverse();
}
</script>