<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';


$pmda = new Pmda();

$opcao = isset($_POST['btnEnviar']) ? $_POST['btnEnviar'] : "";
$post = isset($_POST) ? $_POST : "";

//var_dump($post);

if($opcao == "gravar") {
	
	//var_dump($post);
	$pmda->atualizaStatus($post);
	
}elseif($opcao == 'verifica'){
	
	echo $pmda->verificaStatus($post);
}
?>