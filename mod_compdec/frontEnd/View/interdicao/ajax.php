<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';


$opcao = isset($_POST['opcao']) ? $_POST['opcao'] :"";

/* opcao publicar termo de interdicao */
if($opcao == 'publicar'){
    
    $interdicao = new Vistoria();
    
    if( $interdicao->pubTermo($_POST) ){
        print "sucesso";
    }    
}

