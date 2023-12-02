<?php
require '../banco/conexao.php';
require '../models/Verifica.php';
require_once("../DAO/Usuario.php");
require_once('../models/Verifica.php');

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_EMAIL);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');

if($nome && $cpf && $senha){

    $sql = $pdo->prepare("select * from usuario where cpf = :cpf");
    $sql->bindValue(':cpf', $cpf);
    $sql->execute();

    if($sql->rowCount() > 0){
        header("Location: ".$baseUrl.'/telas/Cadastro.php');
        $_SESSION['flash'] = 'CPF já utilizado.';
        exit;
    }

    $sql = $pdo->prepare("insert into usuario(nome, cpf, credito) values (:nome, :cpf, 0)");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':cpf', $cpf);
    $sql->execute();

    $sql = $pdo->prepare("select * from usuario where cpf = :cpf");
    $sql->bindValue(':cpf', $cpf);
    $sql->execute();

    $user = $sql->fetch(PDO::FETCH_ASSOC);

    $sql = $pdo->prepare("insert into login(senha, id_usuario) values (:senha, :idusuario)");
    $sql->bindValue(':senha', $senha);
    $sql->bindValue(':idusuario', $user["id"]);
    $sql->execute();

    $sql = $pdo->prepare("select * from usuario where cpf = :cpf");
    $sql->bindValue(':cpf', $cpf);
    $sql->execute();

    if($sql->rowCount() > 0){
        
        $sql2 = $pdo->prepare("select * from login where id_usuario = :usuarioid and senha = :senha");
        $sql2->bindValue(':usuarioid', $user["id"]);
        $sql2->bindValue(':senha', $senha);
        $sql2->execute();
        if($sql2->rowCount() > 0){
            header("Location: ".$baseUrl.'/telas/login.php');
            exit;
        }
    }
        $_SESSION['flash'] = 'Erro ao criar Usuário.';
    

}else{
    $_SESSION['flash'] = 'Não envie campos vazios.';
}

header("Location: ".$baseUrl.'/telas/Cadastro.php');
exit;