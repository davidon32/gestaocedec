<?php

class AnexoPref extends Anexo {

	/**
	 * Gravar registro anexo
	 * @param unknown $array
	 */
	public static function gravar($dados, $arquivo, $caminho) {


		try {

			/* 1.7mb = 1762762 */
			if(($arquivo['fileAnexoPref']['error'] == '0') && ($arquivo['fileAnexoPref']['size'] <= '2000000' )){

				$sql = "update cedec_prefeitura
						set fotoPref = :fotoPref
						where id_municipio = :id_municipio";
					
					
				$con = Conexao::getInstance();
					
				$result = $con->prepare($sql);
					
				$nomeArquivo = str_replace(" ", "_", $arquivo['fileAnexoPref']['name']);
					
				$nomeFoto = $dados['txtIdMunicipio']."_".$nomeArquivo;

				$result->bindParam(":id_municipio", $dados['txtIdMunicipio']);
				$result->bindParam(":fotoPref", $nomeFoto);
				$result->execute ();

				if(Anexo::upload($caminho, $arquivo, "fileAnexoPref", $dados['txtIdMunicipio'])){
						
					return true;
				}
			}else {

				print "<script>";
				print "alert('Tamanho do arquivo máximo permitido 2Mb !');";
				print "</script>";

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

			//$con = Conexao::getInstance();
				
			//$sql = "delete from pip_anexo where id = :id_anexo";
				
			//$result = $con->prepare($sql);
			///$result->bindParam("id_anexo", $id);
			//$result->execute();

			return true;

		}catch (Exception $e){
				
			$e." Erro ao deletar arquivo";
		}



	}


	/* busca imagem compdec*/

	public static function foto($id_municipio){

		$foto = "";

		try{

			$con = Conexao::getInstance();

			$sql = "select fotoPref from cedec_prefeitura where id_municipio = :id_municipio";

			$result = $con->prepare($sql);
			$result->bindParam("id_municipio", $id_municipio);
			$result->execute();
				
			while($linha = $result->fetch(PDO::FETCH_ASSOC)){

				$foto = $linha['fotoPref'];
				if($linha['fotoPref'] == ""){
						
					$foto = "padrao.png";
				}
			}

			return $foto;

		}catch (Exception $e){

			print $e."-";
		}

	}


	/* busca arquivo foto */
	public static function deletarFoto($id_municipio, $caminho){

		
		chdir(PATH.$caminho);

		$dirAnexo = getcwd();
		
		/* lista de arquivos do diretorio */
		$arquivos = scandir($dirAnexo);
		$foto = '';
		foreach ($arquivos as $value){
			
			if(substr($value, 0, strpos($value, "_")) == $id_municipio){
			$foto = $value;
			}
		}

		/* remove foto */	
		if($foto !=""){
			/* remover arquivo */
			chdir(PATH.'/anexo/prefeito');
			$dirAnexo = getcwd();
			unlink($dirAnexo.'/'.$foto);
		}

	}
}?>