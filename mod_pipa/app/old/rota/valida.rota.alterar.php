<?php session_start();

include_once '../include.php';

$_conexao = new ConexaoMysql();

$_rota = new Rota();

$_momento = isset($_POST['momento']) ? $_POST['momento'] : null;

$_num_rota = isset($_POST['nrota']) ? $_POST['nrota'] : null;

$_id_rota = isset($_POST['id']) ? $_POST['id'] : null;

$_enviar = isset($_POST['alterar']) ? true : false;



if($_enviar) {
    
    if($_rota->alterarRota($_id_rota, $_num_rota, $_momento)){
    	        
        print "<script type='text/javascript'>";

        print "alert('Cadastro Alterado com Sucesso !');";
        
        print "location.href='secao.php?secao=rota&acao=buscar';";
        
        print "</script>";
        
    }else {
        
        print "erro";
    }

}
?>



