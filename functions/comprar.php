<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);

$sql = $pdo->prepare("select * from compras where id_usuario = :idu and id_ingresso = :idi");
$sql->bindValue(':idu', $_GET['id']);
$sql->bindValue(':idi', $_GET['id_ingresso']);
$sql->execute();

$sql4 = $pdo->prepare("select * from usuario where id = :idu");
$sql4->bindValue(':idu', $_GET['id']);
$sql4->execute();


if ($sql->rowCount() > 0) {
    $events = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($events as $event) {
        $quant = $event['quantidade'] + 1;
        $sql2 = $pdo->prepare("update compras set quantidade = :quantidade where id_usuario = :idu and id_ingresso = :idi ");
        $sql2->bindValue(':quantidade', $quant);
        $sql2->bindValue(':idu', $_GET['id']);
        $sql2->bindValue(':idi', $_GET['id_ingresso']);
        $sql2->execute();
        if ($sql4->rowCount() > 0) {
            
            $event4s = $sql4->fetchAll(PDO::FETCH_ASSOC);
            foreach ($event4s as $event4) {
                $cred = $event4['credito'] + 1;
                $sql5 = $pdo->prepare("update usuario set credito = :credito where id = :idu");
                $sql5->bindValue(':credito', $cred);
                $sql5->bindValue(':idu', $_GET['id']);
                $sql5->execute();
            }
        }
    }
}else {
    $sql3 = $pdo->prepare("insert into compras (id_usuario, id_ingresso, quantidade) values (:id_us, :id_in, :quantidade)");
    $sql3->bindValue(':id_us', $_GET['id']);
    $sql3->bindValue(':id_in', $_GET['id_ingresso']);
    $sql3->bindValue(':quantidade', 1);
    $sql3->execute();
    if ($sql4->rowCount() > 0) {
        $event4s = $sql4->fetchAll(PDO::FETCH_ASSOC);
        foreach ($event4s as $event4) {
            $sql5 = $pdo->prepare("update usuario set credito = :credito where id = :idu");
            $sql5->bindValue(':credito', $event4['credito']++);
            $sql5->bindValue(':idu', $_GET['id']);
            $sql5->execute();
        }
    }
}

header("Location: ".$baseUrl.'/telas/meu_evento.php?id='.$_GET['id'].'&id_evento='.$_POST['idevento']);
exit;

?>