<?php
    require '../banco/conexao.php';
    require '../models/Verifica.php';
    require_once("../DAO/Usuario.php");
    require_once('../models/Verifica.php');

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    if($username && $password){

        $sql = $pdo->prepare("select * from usuario where cpf = :cpf");
        $sql->bindValue(':cpf', $username);
        $sql->execute();

        if($sql->rowCount() > 0){
            $user = $sql->fetch(PDO::FETCH_ASSOC);
            $sql2 = $pdo->prepare("select * from login where id_usuario = :usuarioid and senha = :senha");
            $sql2->bindValue(':usuarioid', $user["id"]);
            $sql2->bindValue(':senha', $password);
            $sql2->execute();
            if($sql2->rowCount() > 0){
                $_SESSION['cpf'] = $user["cpf"];
                header("Location: ".$baseUrl."?id=".$user["id"]);
                exit;
            }
        }
            $_SESSION['flash'] = 'CPF ou senha incorretos.';
        

    }else{
        $_SESSION['flash'] = 'Não envie campos vazios.';
    }

    header("Location: ".$baseUrl.'/telas/login.php');
    exit;
?>