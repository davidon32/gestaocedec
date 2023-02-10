<?php include_once PATH."/core/classe/Classe.Anexo.php"; 

class AnexoPmda extends Anexo {
	
	static function listaAnexo($id_pmda = null) {
		
		$dados = array();
		$con = Conexao::getInstance();
		
			$sql = "SELECT id, id_pmda, arquivo, dt_anexo, descricao
						FROM pip_anexo
						WHERE id_pmda = :pmda";
			$result = $con->prepare($sql);
			
			$result->bindValue(":pmda", $id_pmda);
			$result->execute();
		
		
		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			$dados[] = $linha;
		}
		
		return $dados;
	}
	
	
	/**
	 * Gravar registro anexo
	 * @param $dados do form gravar banco
	 * @param $arquivo - $_FILES
	 * @param $caminho - caminho padrão
	 */
	public static function gravarAnexoPmda($dados, $arquivo, $caminho) {
	
		try {
				
			/* 1.7mb = 1762762 */
			if(($arquivo['fileAnexo']['error'] == '0') && ($arquivo['fileAnexo']['size'] <= '2082357' )){
				
			$sql = "insert into pip_anexo (id_pmda, arquivo, dt_anexo, descricao)
							values (:id_pmda,
									:arquivo,
									:dt_anexo,
									:descricao)";
			
			/* falta tratar os nome do arquivo para upload remover espacos*/
			
			$con = Conexao::getInstance();
			
			$result = $con->prepare($sql);
			
				$nomeArquivo = str_replace(" ", "_", $arquivo['fileAnexo']['name']);
				$nomeArquivo = FuncaoBase::tirarAcentos($nomeArquivo);
				$nomeArquivo = strtoupper($nomeArquivo);

			
				$result->bindParam(":id_pmda", $dados['txtIdPmda']);
				$result->bindParam(":arquivo", $nomeArquivo);
				$result->bindParam(":dt_anexo", $dados['txtAnexoDt']);
				$result->bindValue(":descricao", strtoupper(FuncaoBase::tirarAcentos($dados['txtAnexoDesc'])));
				$result->execute ();
				
				$id_anexo = $con->lastInsertID();

				if(Anexo::uploadNovo($arquivo, $_SERVER['DOCUMENT_ROOT']."/".$caminho, $id_anexo."_".$nomeArquivo)){
					return true;
                                        exit();
				}
			}else {
				
				/*print "<script>";
				print "alert('Tamanho do arquivo máximo permitido 2Mb !');";
				print "</script>";*/
                            return false;
				
			}
			
		} catch ( PDOException $e ) {
				
			$e . "Erro ao Inserir Registro";
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
			
			$sql = "delete from pip_anexo where id = :id_anexo";
			
			$result = $con->prepare($sql);
			$result->bindParam("id_anexo", $id);
			$result->execute();
				
			return true;
		
		}catch (Exception $e){
			
			$e." Erro ao deletar arquivo";
		}
	
	}
	
}?>