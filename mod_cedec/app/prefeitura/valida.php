<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 

	include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';
	
	$anexoFoto = new AnexoPref();

	$alteraImagem = isset($_POST['imagem']) ? true : false;

	$files = isset($_FILES) ? $_FILES : "";
	$post  = isset($_POST)  ? $_POST  : "";

        # imagem existe
        if(true) {
        $anexoFoto->deletarFoto($post['txtIdMunicipio'], '/anexo/prefeito');
        }
        #grava imagem
	print $anexoFoto->gravar($post, $files, PATH.'/anexo/prefeito');

        
?>