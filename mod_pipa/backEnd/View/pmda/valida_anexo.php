<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$anexoPmda = new AnexoPmda();
$pmda = new Pmda();

$files = isset($_FILES) ? $_FILES : "";
$post  = isset($_POST)  ? $_POST  : "";

$opcao = isset($post['opcao']) ? $post['opcao'] : "";


if($opcao == 'gravar'){
	
    if($anexoPmda->gravarAnexoPmda($post, $files, "anexo/pmda")){
        print "sucesso";
    }else {
        print "erro";
    }

}else if($opcao == "delete"){
	
	//deletar
	$anexoPmda->deletar($post['id_anexo']);
	chdir(PATH.'/anexo/pmda');
	$dirAnexo = getcwd();
	
	if(unlink($dirAnexo.'/'.$post['id_anexo'].'_'.$post['arquivo'])){

	}
}