<?php
    require '../banco/conexao.php';
    require_once("../DAO/Usuario.php");
    require_once('../models/Verifica.php');

    $_SESSION['cpf'] = '';
    header("Location: ".$baseUrl);
    exit;