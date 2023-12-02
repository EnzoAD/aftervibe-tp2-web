<?php
$sql = $pdo->prepare("select * from compras where id_usuario = :id");
$sql->bindValue(':id', $_GET['id']);
$sql->execute();

if ($sql->rowCount() > 0) {
    $events = $sql->fetchAll(PDO::FETCH_ASSOC);
    echo '<ul id="product-list">';
    foreach ($events as $event) {
        
        $sql2 = $pdo->prepare("select * from ingresso where id = :id");
        $sql2->bindValue(':id', $event['id_ingresso']);
        $sql2->execute();
        if ($sql2->rowCount() > 0) {
            $event2s = $sql2->fetchAll(PDO::FETCH_ASSOC);
            foreach ($event2s as $event2) {
                $sql3 = $pdo->prepare("select * from evento where id = :id");
                $sql3->bindValue(':id', $event2['id_evento']);
                $sql3->execute();
                if ($sql3->rowCount() > 0) {
                    $event3s = $sql3->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($event3s as $event3) {
                        echo '<a class="list" href="'.$baseUrl.'/telas/evento.php?id='.$_GET['id'].'&id_evento='.$event3["id"].'">';
                        echo '<li>';
                        echo '<div class="product-name">Evento: '.$event3['nome'].'</div>
                        <div>Ingresso: '.$event2['nome'].'</div>
                        <div class="product-date">Data: '. date('d/m/Y H:i',  strtotime($event3['data_inicio'])). ' - '.  date('d/m/Y H:i',  strtotime($event3['data_fim'])). '</div>
                        <div>Quantidade:'.$event['quantidade'].'</div>
                        <div>Preço Unitário: R$'.$event2['preco'].'  |  Preço Total: R$ '.  number_format(($event2['preco'] * $event['quantidade']), 2, '.', '').'</div>';
                        
                        echo '</li>';
                        echo '</a>';
                    }
                }
            }
        }
        
    }
    echo '</ul>';
} else {
    echo 'Nenhuma compra encontrada.';
}
?>