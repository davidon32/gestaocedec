<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';
	
	$boletim = new Boletim();
  
  $opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";

  $post  = isset($_POST)  ? $_POST  : "";

if($opcao == "delete"){
	
		//deletar
		$boletim->deletar($post['id']);
		chdir(PATH.'/anexo/boletim');
		$dirAnexo = getcwd();
                if(file_exists($dirAnexo.'/'.$post['arquivo'])){
                    unlink($dirAnexo.'/'.$post['arquivo']);
                }

}?>