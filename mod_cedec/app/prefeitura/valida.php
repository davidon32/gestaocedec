<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";

	include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';
	
	$anexoFoto = new AnexoPref();

	$alteraImagem = isset($_POST['imagem']) ? true : false;

	$files = isset($_FILES) ? $_FILES : "";
	$post  = isset($_POST)  ? $_POST  : "";

	$anexoFoto->deletarFoto($post['txtIdMunicipio'], '/anexo/prefeito');
	$anexoFoto->gravar($post, $files, PATH.'/anexo/prefeito');	
?>