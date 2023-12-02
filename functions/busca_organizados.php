<?php
$sql = $pdo->prepare("select * from organizador where id_usuario = :id");
$sql->bindValue(':id', $_GET['id']);
$sql->execute();
echo '<a class="pos" href="'.$baseUrl.'/telas/cad_evento.php?id='.$_GET['id'].'"><button style="background-color: blue; font-size: 13px; width: 150px;">Organizar Novo Evento</button></a><br><br>';

if ($sql->rowCount() > 0) {
    $events = $sql->fetchAll(PDO::FETCH_ASSOC);
    echo '<ul id="product-list">';
    foreach ($events as $event) {
        
        $sql2 = $pdo->prepare("select * from evento where id = :id");
        $sql2->bindValue(':id', $event['id_evento']);
        $sql2->execute();
        if ($sql2->rowCount() > 0) {
            $event2s = $sql2->fetchAll(PDO::FETCH_ASSOC);
            foreach ($event2s as $event2) {
                echo '<a class="list" href="'.$baseUrl.'/telas/evento.php?id='.$_GET['id'].'&id_evento='.$event2["id"].'">';
                echo '<li>';
                echo '<div class="product-name">Evento: '.$event2['nome'].'</div>
                <div class="product-date">Data: '. date('d/m/Y H:i',  strtotime($event2['data_inicio'])). ' - '.  date('d/m/Y H:i',  strtotime($event2['data_fim'])). '</div>';
                echo '</li>';
            }
        }
        
    }
    echo '</ul>';
} else {
    echo 'Nenhuma evento organizado.';
}
?>