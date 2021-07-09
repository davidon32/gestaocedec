<?php 

	if ((isset($_GET['secao'])) && ($_GET['secao'] == "decreto") && (isset($_GET['acao'])) && ($_GET['acao'] == "novo")) {
	    
	    include 'visao/sc.processo.cadastrar.php';
	    exit();

	}
	
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "decreto") && (isset($_GET['acao'])) && ($_GET['acao'] == "buscaAlterar")) {
		 
		include 'visao/sc.processo.busca.php';
		exit();
	
	}
    
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "decreto") && (isset($_GET['acao'])) && ($_GET['acao'] == "consulta")) {
         
        include 'visao/sc.processo.consulta.php';
        exit();
    
    }
    
    
    ################################################ Relatório #######################################################
    
     if ((isset($_GET['secao'])) && ($_GET['secao'] == "decreto") && (isset($_GET['acao'])) && ($_GET['acao'] == "resumo")) {
         
        include 'rel/rel.resumo.processo.php';
        exit();
    
    }
?>
