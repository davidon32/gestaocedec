<?php

/**
 * 
 * Duplicar pmda
 * 
 */

$pmda = new Pmda();

$_id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : "";

$_pmda = isset($_POST['id_pmda']) ? $_POST['id_pmda'] : "";

$_opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";

if($_opcao == 'duplicar'){
	
	$pmda->duplicarPmda($id_municipio, $id_pmda);
	
}

?>
