<?php

class AnexoCce {
		

/**
 * Grava Anexo Leis e Decretos Compdec
 * @param unknown $array
 */
public static function AnexoBoletim($dados, $arquivo, $caminho) {


	try {

		/* 1.7mb = 1762762 */
		/*2.5  tamanho atual */
		if(
				($arquivo['fileAnexo']['error'] == '0') &&
				(strlen($arquivo['fileAnexo']['name']) <="60") &&
				($arquivo['fileAnexo']['size'] > '10') &&
				($arquivo['fileAnexo']['size'] <= '2621440' )
					
				){

					$sql = "insert into cce_boletim (nome,
												data,
												plantonista,
												caminho,
												descricao,
												tamanho,
												complemento)
													values (:nome,
															:data,
															:plantonista,
															:caminho,
															:descricao,
															:tamanho,
															:complemento)";
						
					$con = Conexao::getInstance();
						
					$result = $con->prepare($sql);
						
					$nomeArquivo = str_replace(" ", "_", $arquivo['fileAnexo']['name']);
					
					$horaDt = date("Hs");
						
					$nomeFile = $dados['txtIdUser']."-".$horaDt."_".substr($nomeArquivo, 0, 20).".".substr($nomeArquivo, -3);

					$dataUpload = DataMysql::dataForm($dados['txtData']).' '.date('H:i:s');
					
					$arquivoSize = round((int)$arquivo['fileAnexo']['size'] / 1024, 2);
					
					$result->bindParam(":plantonista", $dados['txtIdUser']);
					$result->bindParam(":nome", $nomeFile);
					$result->bindParam(":data", $dataUpload);
					$result->bindParam(":caminho", $caminho);
					$result->bindParam(":descricao", $dados['txtDescricao']);
					$result->bindParam(":complemento", $dados['txtComplemento']);
					$result->bindParam(":tamanho", $arquivoSize);

					$result->execute ();

					if(Anexo::upload($_SERVER['DOCUMENT_ROOT']."/".$caminho, $arquivo, "fileAnexo", $dados['txtIdUser']."-".$horaDt)){

						return true;
					}
		}else {
			return false;
		}

	} catch ( PDOException $e ) {

		print $e . "Erro ao Inserir Registro";
		return false;
	}
}

/**
 *
 *
 *
 */
public function deletar($id) {

	try{

		$con = Conexao::getInstance();
			
		$sql = "delete from com_anexo where id = :id_anexo";
			
		$result = $con->prepare($sql);
		$result->bindParam("id_anexo", $id);
		$result->execute();

		return true;

	}catch (Exception $e){
			
		$e." Erro ao deletar arquivo";
	}
}

/* $opcao == "delete"){

	//deletar
	$anexoFoto->deletar($post['id_anexo']);
	chdir(PATH.'/anexo/anexoLeis');
	$dirAnexo = getcwd();
	unlink($dirAnexo.'/'.$post['arquivo']);

	include_once $_SERVER['DOCUMENT_ROOT'].'/mod_compdec/app/compdec/anexo.php';



} */

}
