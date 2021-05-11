<?php

class GeradorRelatorio {

	private $nomeBanco;
	private $nomeTabela;

	#@ pega o nome do banco de dados
	public function pegaBanco($nomeBanco) {
			
		$this->nomeBanco = $nomeBanco;
			
	}

	#@ retorna o nome do banco de dados
	public function retornaBanco() {
			
		return $this->nomeBanco;
			
	}

	#@ pega o nome da tabela
	public function pegaTabela($nomeTabela){
			
		$this->nomeTabela = $nomeTabela;
			
	}

	#@ retorna o nome da tabela
	public function retornaTabela() {
			
		return $this->nomeTabela;
			
	}



	#@ /* seleciona os nomes das tabelas */
	public function PegaNomeTabela($nomeBanco) {

		$sql = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$nomeBanco'";

		//print $sql;

		$result = mysql_query($sql) or die (mysql_error().'Código: 08');
		
		print "<select name=\"nTabela\" id=\"nTabela\" onchange=\"mostra();\">
					<option></option>";

		while($linha = mysql_fetch_array($result)){
				
			print "<option>".$linha[0]."</option>";
				
		}
		
		print "</select>";

	}

	/**
     * Seleciona os nomes dos campos da tabela (gera combo)
     * @param $nomeBanco String
     * @param $nomeTabela
     * @return elemento HTML (SELECT)
     */
	public function CampoTabela($nomeBanco, $nomeTabela) {

		$sql = "SELECT COLUMN_NAME
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_SCHEMA = '$nomeBanco'
		AND TABLE_NAME ='$nomeTabela'";

		//print $sql;

		$result = mysql_query($sql) or die (mysql_error().'Código: 09');
		
		print "<select name=\"nCampo\" id=\"nCampo\">
					<option></option>";

		while($linha = mysql_fetch_array($result)){

			print "<option>".$linha[0]."</option>";
		}

		print "</select>";

	}

}



?>