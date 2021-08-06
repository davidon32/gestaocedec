<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$post = isset($_POST) ? $_POST : "";

$id_msg = isset($_POST['id_msg']) ? $_POST['id_msg']:"";

//var_dump($post);
$pmda = new Pmda();

$opcao = $post['opcao'];

if($opcao == "gravar"){
	if($post['status'] == "4"){
		$pmda->atualizaStatus($post);
	}else {
		$post['resp'] = "";		
		$pmda->atualizaStatus($post);
	}
}elseif ($opcao == "comentario"){
	$pmda->gravarNota($post);
}elseif($opcao == "mensagem"){
	$pmda->gravarMensagem($post);
}elseif($opcao == 'marcar_lida'){
	print $pmda->ler_mensagem($id_msg);

}

print  "retorno";
?>