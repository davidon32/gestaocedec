<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';


$comunidade = new Comunidade();
$login = new LoginExterno();

	$id_comunidade = isset($_POST['id_comunidade']) ? $_POST['id_comunidade'] : "";
	$id_municipio  = isset($_POST['id_municipio'])  ? $_POST['id_municipio']  : "";
	$nomComunidade = isset($_POST['txtComunidade']) ? $_POST['txtComunidade'] : "";
	$idUser        = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : "";
	
	$opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";
	
	if($opcao == "delete"){
	
		if($comunidade->buscaComunidadeDelete($id_comunidade)){
			
			//$comunidade->deleteRelPmdaCom()
			
			print "sim";
		}else {
			
			print "nao";
			$comunidade->delete($id_comunidade);
		}
		
	
	}elseif ($opcao == "cadastro"){
				 
			$dados = array('txtComunidade'=>$nomComunidade, 'id_municipio'=>$id_municipio);
		 	$comunidade->cadComunidade($dados);
	
	/* Efetivar Comunidade */
	}elseif ($opcao == "efetiva"){

		$comunidade->efetivaCom($id_comunidade, $idUser);
		
	}elseif($opcao == "alterar"){
		
		//print var_dump($_POST);
		
		$comunidade->AlteraComunidade($nomComunidade, "0", $id_comunidade);
		
	}

?>