<?php  $id_session = session_id();
    if(empty($id_session)) session_start();

	include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

	$envia = isset($_POST['btnEnviar']) ? $_POST['btnEnviar'] : "";
	$status = isset($_POST['status']) ? $_POST['status']: "";
	$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio']: "";
	
	
	$compdec = new Compdec();
	if($envia == "gravar") {
		$compdec->existeCompdec($status, $id_municipio);
	}else if($envia == 'pmda'){
            $compdec->permissao($_POST);
        }else if($envia == 'ajuda'){
            $compdec->permissao($_POST);
        }else if($envia == 'rpm'){
            $compdec->alteraRPM($_POST);
        }

?>