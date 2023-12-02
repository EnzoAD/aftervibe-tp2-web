<?php

class Verifica{
    private $pdo;
    private $url;
    public function __construct(PDO $pdo, $url){
        $this->pdo = $pdo;
        $this->url = $url;
        
    }
    public function checkIfLoggedIn($redirect){
        
        if(!empty($_SESSION['cpf'])){
            $cpf = $_SESSION['cpf'];

            $userDao = new Usuario($this->pdo);

            $user = $userDao->encontraCPF($cpf);

            if($user){
                return $user;
            }

        }

        if($redirect){
            header('location: '.$this->url.'/telas/login.php');
            exit;
        }
    }
    
}
