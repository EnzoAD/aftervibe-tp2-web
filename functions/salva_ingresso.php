<?php
require("../banco/conexao.php");
require("../models/Verifica.php");
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');
$auth = new Verifica($pdo, $baseUrl);
$userInfo = $auth->checkIfLoggedIn(true);
$sql = $pdo->prepare("insert into ingresso (nome, preco, id_evento, descricao) values (:nome, :preco, :id_event, :descricao)");
$sql->bindValue(':nome', $_POST['nome']);
$sql->bindValue(':preco', $stringCorrigida = str_replace(',', '.', $_POST['preco']));;
$sql->bindValue(':id_event', $_POST['idevento']);
$sql->bindValue(':descricao', $_POST['descricao']);
$sql->execute();

$sql3 = $pdo->prepare("select max(id) as id from ingresso");
$sql3->execute();
if ($sql3->rowCount() > 0){
    $event3s = $sql3->fetchAll(PDO::FETCH_ASSOC);
    foreach ($event3s as $event3) {
        $sql2 = $pdo->prepare("select * from programacao where id_evento = :id");
        $sql2->bindValue(':id', $_POST['idevento']);
        $sql2->execute();
        if ($sql2->rowCount() > 0){
            $events = $sql2->fetchAll(PDO::FETCH_ASSOC);
            $i=1;
            foreach ($events as $event) {
                if (!empty($_POST['op'.$i])){
                    $sql3 = $pdo->prepare("insert into ingresso_programacao (id_ingresso, id_programacao) values (:id_ingresso, :id_programacao)");
                    $sql3->bindValue(':id_programacao', $event['id']);
                    $sql3->bindValue(':id_ingresso', $event3['id']);
                    $sql3->execute();
                }
                $i++;
            }
        }
    }
}



header("Location: ".$baseUrl.'/telas/evento.php?id='.$_GET['id'].'&id_evento='.$_POST['idevento']);
exit;

?>