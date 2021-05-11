<?php session_start();

include_once PATH.'/include.php';

//var_dump($_POST);

$_nome_rota = '';

$_num_rota = '';

$_momento = isset($_POST['momento']) ? $_POST['momento'] : null;

$_id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : null;

$_num_rota = isset($_POST['nrota']) ? $_POST['nrota'] : null;

$_ano = isset($_POST['txtAno']) ? $_POST['txtAno'] : null;


if($_id_municipio != null) {
    
    $_nome_rota = Municipio::PegaNomeMunicipio($_id_municipio);

}

#@ perquisa rotas dublicadas
$buscaRota = Rota::buscaRotaDuplicada($_nome_rota, $_num_rota, $_ano);
die();

if(!$buscaRota) {
    
    if(Rota::cadastroRota($_nome_rota, $_momento, $_id_municipio, $_situacao = 'R', $_num_rota, $_ano)){
    	        
        print "<script type='text/javascript'>";

        print "alert('Cadastro Realizado com Sucesso !');";
        
        print "location.href='secao.php?secao=rota&acao=cadastrar';";
        
        print "</script>";
        
    }

}else {

	print "<script type='text/javascript'>";

	print "alert('Rota ja Cadastrada !' );";

	print "location.href='secao.php?secao=rota&acao=cadastrar';";
	
	print "</script>";
	
    }


?>



