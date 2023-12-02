<?php
echo '<div class="container2">';
echo '<a class="pos" href="'.$baseUrl.'/index.php?id='.$_GET['id'].'"><button>Home</button></a><br>';
echo '<a class="pos" href="'.$baseUrl.'/telas/meu_evento.php?id='.$_GET['id'].'"><button>Meus Eventos</button></a><br>';
echo '<a class="pos" href="'.$baseUrl.'/telas/conta.php?id='.$_GET['id'].'"><button>Conta</button></a><br>';
echo '<a class="pos" href="'.$baseUrl.'/functions/Deslogar.php"><button>Logout</button></a>';
echo '</div>';
?>