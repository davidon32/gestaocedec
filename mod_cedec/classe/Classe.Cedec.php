<?php


class Cedec extends DataMysql {
	
	public static function getVersao() {
		
		$dados = "";
		
		$con = Conexao::getInstance();
		
		$sql = "select dt_versao,versao from cedec_versao order by id DESC limit 1";
		
		$result = $con->query($sql);
		$result->execute();
		
		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			 
			$dados = $linha;
		}
		
		return $dados['versao']." - ".DataMysql::dataCompletaVisual($dados['dt_versao']);
		
	}


	
}