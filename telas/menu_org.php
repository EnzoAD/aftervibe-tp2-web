

<?php
echo '<div class="container3">';
echo '<a class="pos" href="'.$baseUrl.'/telas/cad_programacao.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento'].'"><button>Adicionar Programação</button></a><br>';
echo '<a class="pos" href="'.$baseUrl.'/telas/cad_ingresso.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento'].'"><button>Adicionar Novo Ingresso</button></a><br>';
echo '<a class="pos" href="#openModal3"><button>Excluir Evento</button></a><br>

<div id="openModal3" class="modalDialog">
  <div>
    <h2>Confirmar Exclusão</h2>
    <p>Tem certeza que deseja excluir o evento?</p>
    <a class="pos" href="'.$baseUrl.'/functions/ex_evento.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento'].'"><button style="background-color: green;">Sim</button></a>
    <a class="pos" href="#close"><button>Não</button></a><br>
    </div>
</div>';
echo '</div>';
?>