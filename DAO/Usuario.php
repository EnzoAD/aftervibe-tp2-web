<?php


class Usuario {
    
    private $pdo;

    public function __construct(PDO $engine){
        $this->pdo = $engine;
    }
    public function encontraCPF($cpf){

        if(!empty($cpf)){
            $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE cpf = :cpf");
            $sql->bindValue(':cpf', $cpf);
            $sql->execute();

            if($sql->rowCount() > 0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);

                return $data;
            }
        }
        return false;
    }
}
