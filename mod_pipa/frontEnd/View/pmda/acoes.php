<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$pmda = new Pmda();

if(isset($_GET['param'])) {
	$id_pmda = (int)$_GET['param'];
}else if(isset($_POST['id_pmda'])){
	$id_pmda = (int)$_POST['id_pmda']	;
}else {
	$id_pmda = "";
}

$btn = isset($_POST['btnAcoesSalvar']) ? $_POST['btnAcoesSalvar'] : "";
$dados = isset($_POST) ? $_POST : "";

$pmda->atualizaAcoes($dados);

?>