<?php
$sql = $pdo->prepare("select * from evento");
$sql->execute();
if ($sql->rowCount() > 0) {
    $events = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($events as $event) {
        echo '<a class="list" href="'.$baseUrl.'/telas/evento.php?id='.$_GET["id"].'&id_evento='.$event["id"].'">';
        echo '<li>';
        echo '<img style="height:300px" src="' . $event['caminho_imagem'] . '" alt="' . $event['nome'] . '" class="product-image">';
        echo '<div class="product-name">' . $event['nome'] . '</div>';
        echo '<div class="product-date">'. date('d/m/Y H:i',  strtotime($event['data_inicio'])). ' - '.  date('d/m/Y H:i',  strtotime($event['data_fim'])). '</div>';
        if($event['situacao']==0){
            echo '<div class="product-status">Aberto</div>';
        }else{
            echo '<div class="product-status">Fechado</div>';
        }
        echo '</li>';
        echo '</a>';
    }
} else {
    echo 'Nenhum evento encontrado.';
}
?>
