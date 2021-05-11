<?php 

	################################################# DECRETO ##########################################

	$_parte = isset($_GET['secao']) ? $_GET['secao'] : "";

	//var_dump($_parte);
	
	// acesso a aba dados gerais do processo
    if ($_parte == 'novo') {
         
        include 'visao/sc.processo.parte.dados.novo.php';
        exit();
    
    }
	
	// acesso a aba dados gerais do processo
	if ($_parte == 'dados') {
	     
	    include 'visao/sc.processo.parte.dados.php';
	    exit();
	
	}
	
	// acesso a aba dados municipio
	if ($_parte == 'municipio') {
	
		include 'visao/sc.processo.parte.dado.mun.php';
		exit();
	
	}

	// acesso a aba Danos Humanos 
	if ($_parte == 'humanos') {
	     
	    include 'visao/sc.processo.parte.humano.php';
	    exit();
	
	}
	
	// acesso a Danos Materiais
	if ($_parte == 'material') {
	
		include 'visao/sc.processo.parte.material.php';
		exit();
	
	}
	
	// acesso a prejuizo ambiental
	if ($_parte == 'ambiental') {
	
		include 'visao/sc.processo.parte.ambiental.php';
		exit();
	
	}
	
	// acesso a prejuizo economivos públicos
	if ($_parte == 'epublico') {
	
		include 'visao/sc.processo.parte.epublico.php';
		exit();
	
	}
	
	// acesso a prejuizo economivos privado
	if ($_parte == 'eprivado') {
	
		include 'visao/sc.processo.parte.eprivado.php';
		exit();
	
	}
	
	// acesso a prejuizo economivos privado
	if ($_parte == 'pfechar') {
	
		include 'controle/valida.processo.fechar.php';
		exit();
	
	}
	
	
	
	

 ?>