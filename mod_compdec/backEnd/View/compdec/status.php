<?php  $id_session = session_id();
    if(empty($id_session)) session_start();

	include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

	$envia = isset($_POST['btnEnviar']) ? $_POST['btnEnviar'] : "";
	$status = isset($_POST['status']) ? $_POST['status']: "";
	$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio']: "";
	
	//var_dump($_POST);
	
	if($envia == "gravar") {
		
		$compdec = new Compdec();
		
		return $compdec->existeCompdec($status, $id_municipio);

	}

?>