<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$muncipio = new Municipio();

//$municipio->alterarComunidade($_POST);

$dados = isset($_POST) ? $_POST : "";

if($dados['btnInfoMunicipio'] == "gravar"){

	$erro = false;

	foreach ($dados as $value) {
		if($value == ""){
			$erro = true;
			continue;
		}
	}
	
	if(!$erro) {
		if($muncipio->alterarMunPmda($dados)){
			print 'sucesso';
		}else {
			print 'erro';
		}
	//}else {
	//	return false;
	}
	
}else {
	print "erro";
}

				 
?>