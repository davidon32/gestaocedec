<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';


$pmda = new Pmda();

$opcao = isset($_POST['btnEnviar']) ? $_POST['btnEnviar'] : "";
$post = isset($_POST) ? $_POST : "";

if($opcao == "gravar") {
    $pmda->atualizaStatus($post);
    $pmda->atualizaEstado($post);

}elseif($opcao == 'verifica'){
	
	echo $pmda->verificaStatus($post);
}
?>