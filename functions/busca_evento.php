<?php
$sql = $pdo->prepare("select * from evento where id = :id");
$sql->bindValue(':id', $_GET['id_evento']);
$sql->execute();

$sql6 = $pdo->prepare("select * from usuario where id = :id");
$sql6->bindValue(':id', $_GET['id']);
$sql6->execute();
if ($sql6->rowCount() > 0) {
    $event6s = $sql6->fetchAll(PDO::FETCH_ASSOC);
    foreach ($event6s as $event6) {
        $point =$event6['credito'];
    }
}
if ($sql->rowCount() > 0) {
    $events = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($events as $event) {
        echo '<h2>'.$event['nome'].'</h2>';
        echo '<img style="height:300px" src="' . $event['caminho_imagem'] . '" alt="' . $event['nome'] . '" class="product-image">';
        echo '<div class="product-date">'. date('d/m/Y H:i',  strtotime($event['data_inicio'])). ' - '.  date('d/m/Y H:i',  strtotime($event['data_fim'])). '</div>';
        if($event['situacao']==0){
            echo '<div class="product-status">Aberto</div>';
        }else{
            echo '<div class="product-status">Fechado</div>';
        }
        echo '<div class="product-descricao">'.$event['descricao'].'</div>';
        if($_GET['id'] == $id_org){
            echo '<a class="pos" href="'.$baseUrl.'/telas/edit_evento.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento'].'"><button style="background-color: blue" class="edt">Editar</button></a>';
        }
        $sql2 = $pdo->prepare("select * from programacao where id_evento = :id");
        $sql2->bindValue(':id', $_GET['id_evento']);
        $sql2->execute();
        if ($sql2->rowCount() > 0) {
            $programs = $sql2->fetchAll(PDO::FETCH_ASSOC);
            echo '<ul id="product-list">';
            echo '<h3>Programação</h3>';
            foreach ($programs as $program) {
                echo '<li>';
                echo '<h4>'.$program['nome'].'</h4>';
                echo '<div>'.date('d/m/Y H:i',  strtotime($program['data_inicio'])). ' - '.  date('d/m/Y H:i',  strtotime($program['data_fim'])). '</div>';
                echo '<div class="product-descricao">'.$program['descricao'].'</div>';
                if($_GET['id'] == $id_org){
                    echo '<a class="pos" href="'.$baseUrl.'/telas/edit_programa.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento'].'&id_programa='.$program['id'].'"><button style="background-color: blue" class="edt">Editar</button></a> 
                    <a class="pos" href="#openModal"><button class="edt">Excluir</button></a><br>

                    <div id="openModal" class="modalDialog">
                    <div>
                        <h2>Confirmar Exclusão</h2>
                        <p>Tem certeza que deseja excluir o programa?</p>
                        <a class="pos" href="'.$baseUrl.'/functions/ex_programa.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento'].'&id_programa='.$program['id'].'"><button style="background-color: green;">Sim</button></a>
                        <a class="pos" href="#close"><button>Não</button></a><br>
                        </div>
                    </div>';
                }
                echo '</li>';
            }
        }else{
            echo '<div class="product-programacao">Sem Programação</div>';
        }
        echo '</ul>';
        echo '<h3>Ingressos</h3>';
        $sql3 = $pdo->prepare("select * from ingresso where id_evento = :id");
        $sql3->bindValue(':id', $_GET['id_evento']);
        $sql3->execute();
        if ($sql3->rowCount() > 0) {
            $program2s = $sql3->fetchAll(PDO::FETCH_ASSOC);
            echo '<ul id="product-list">';
            foreach ($program2s as $program2) {
                $prec =$program2['preco'];
                echo '<li>';
                echo '<h4>'.$program2['nome'].'</h4>';
                echo '<div>R$ '.$program2['preco'].'</div>';
                echo '<div class="product-descricao">'.$program2['descricao'].'</div>';
                $sql4 = $pdo->prepare("select * from ingresso_programacao where id_ingresso = :id");
                $sql4->bindValue(':id', $program2['id']);
                $sql4->execute();

                if($sql4->rowCount() > 0){
                    
                    $program4s = $sql4->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($program4s as $program4){

                        $sql5 = $pdo->prepare("select * from programacao where id_evento = :id");
                        $sql5->bindValue(':id', $_GET['id_evento']);
                        $sql5->execute();

                        if($sql5->rowCount() > 0){
                            $program5s = $sql5->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($program5s as $program5){
                                if($program5['id'] == $program4['id_programacao']){
                                    echo '<div class="product-descricao">'.$program5['nome'].'</div>';;

                                }
                            }
                        }else{
                            echo '<br><div>Sem Programação</div>';
                        }
                    }    
                }else{
                    echo '<br><div>Sem Programação Especificada</div>';
                }
                
                if($_GET['id'] == $id_org){
                    echo '<a class="pos" href="'.$baseUrl.'/telas/edit_ingresso.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento'].'&id_ingresso='.$program2['id'].'"><button style="background-color: blue" class="edt">Editar</button></a>
                    <a class="pos" href="#openModal2"><button class="edt">Excluir</button></a><br>

                    <div id="openModal2" class="modalDialog">
                    <div>
                        <h2>Confirmar Exclusão</h2>
                        <p>Tem certeza que deseja excluir o ingresso?</p>
                        <a class="pos" href="'.$baseUrl.'/functions/ex_ingresso.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento'].'&id_ingresso='.$program2['id'].'"><button style="background-color: green;">Sim</button></a>
                        <a class="pos" href="#close"><button>Não</button></a><br>
                        </div>
                    </div>';
                }else if($event['situacao']==0){
                    
                    echo '<a class="pos" href="'.$baseUrl.'/functions/comprar.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento'].'&id_ingresso='.$program2['id'].'"><button style="background-color: green">Comprar</button></a>';
                    echo '<br><a class="pos" href="#openModal"><button style="background-color: green">Comprar com AfterPoints</button></a><br>

                    <div id="openModal" class="modalDialog">
                    <div>
                        <h2>Compra com AfterPoints</h2>';
                        echo '<p>Você tem '.$point.' AfterPoints(R$'.number_format(($point * 0.5), 2, '.', '').')</p>';
                        if($point > $prec){
                            $point = $prec;
                            echo '<p>Maximo possivel a ser utilizado nesta compra é '.$point.' AfterPoints(R$'.number_format(($point * 0.5), 2, '.', '').')';
                        }
                        echo '<p>R$'.$prec.' - R$'.number_format(($point * 0.5), 2, '.', '').' () = R$'.number_format(($prec - ($point * 0.5)), 2, '.', '').'</p>
                        <a class="pos" href="'.$baseUrl.'/functions/comprar2.php?id='.$_GET['id'].'&id_evento='.$_GET['id_evento'].'&id_ingresso='.$program2['id'].'&quantt='.$point.'"><button style="background-color: green;">Comprar</button></a>
                        <a class="pos" href="#close"><button>Cancelar</button></a><br>
                    </div>
                    </div>';
                }else{
                    echo '<br><div>Sem Ingressos</div>';
                }
                echo '</li>';
            }
            echo '</ul>';
        }else{
            echo '<div class="product-programacao">Sem Ingressos</div>';
        }
        
    }
} else {
    echo 'Nenhum evento encontrado.';
}
?>
