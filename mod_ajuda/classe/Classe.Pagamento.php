<?php
/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
* 																					*
* 	Classe para manipular pagamento de materiais										*
* 																					*
* 	Autor: Demetrio da Silva Passos													*
* 																					*
* 	Criacao : 01/02/2012															*
************************************************************************************/

/*
 * 
 *			
 * 
 * 
 * 
 * */

	class Pagamento extends Municipio{
		
		private static $dtLibera;
		private $idLibera;
		private $dtLimite;
		
		#@ mostra os materiais para o pagamento 
		function mostraMaterialPagto($n_dep_destino, $_nivel){

			$con = Conexao::getInstance();

				$dados = array();
		
			self::$dtLibera = date('d/m/Y');
			
            if($_nivel < 3) { # mostra todos os pagamentos 
            
			$sql = "SELECT l.id_liberacao, l.dataLibera, l.id_municipio, l.id_usuario, l.depDestino, l.beneficiario, l.evento, l.observacao, l.dtLimite, l.situacao, dt_recibo ".
					"FROM aju_liberacao l ".
					"WHERE l.dtLimite >=".DataMysql::dataForm(self::$dtLibera)." and l.situacao = 0";
            }else{
                
                $sql = "SELECT l.id_liberacao, l.dataLibera, l.id_municipio, l.id_usuario, l.depDestino, l.beneficiario, l.evento, l.observacao, l.dtLimite, l.situacao ".
                    "FROM aju_liberacao l ".
                    "WHERE l.dtLimite >=".DataMysql::dataForm(self::$dtLibera)." and l.depDestino = {$n_dep_destino} and l.situacao = 0";
                
			}
			
			$result = $con->query($sql);

			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados[] = $linha;
			
			}

			return $dados;
		}
		
		#@ mostra a liberacao que foi clicada para pagamento
		function MosLibInd($nid_usuario, $nIdLibera){ 

			$con = Conexao::getInstance();
		
			$this->dtLibera = date('d/m/Y');
			$this->id_usuario = $nid_usuario;
			
			$sql = "SELECT l.id_liberacao,
							l.dataLibera,
							l.id_municipio,
							l.id_usuario,
							l.depDestino,
							l.beneficiario,
							l.evento,
							l.observacao,
							l.dtLimite,
							l.situacao ".
							"FROM aju_liberacao l ".
							"WHERE l.dtLimite >= '{dataForm($this->dtLibera)}' 
							and l.id_usuario = {$this->id_usuario} 
							and l.situacao = 0 
							and l.id_liberacao = {$nIdLibera}" ;
			
			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
				$_SESSION['pgto'] = array('id_liberacao'=>$linha['id_liberacao'], 'municipio'=>$linha['id_municipio'], 'dtLibera'=>DataMysql::dataVisual($linha['dtLibera']), 'dtPagto'=>DataMysql::dataVisual($linha['dtLimite']), 'beneficiario'=>$linha['beneficiario'], 'dtLimite'=>DataMysql::SomarData(DataMysql::dataVisual($linha['dataLibera']),15,0,0));
			}
		}

		function EfetPgto($_id_liberacao){
			
			$con = Conexao::getInstance();

			$dados =array();

			$sql = "SELECT l.id_liberacao,
							 l.id_municipio,
							 l.datalibera,
							 l.beneficiario,
							 l.dtLimite 
							 FROM aju_liberacao l ".
							"WHERE l.id_liberacao = $_id_liberacao 
							and l.situacao = 0";
			
			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados = $linha;
			}
			return $dados;			
		}
		
		#@ realiza o pagamento de materiais
		function Pagar($_dt_libera,
						 $_id_libera,
						 $_dt_limite,
						 $_dt_pagto,
						 $_beneficiario,
						 $_responsavel,
						 $_n_documento,
						 $_n_recibo,
						 $_endereco,
						 $_bairro,
						 $_cpf_benef,
						 $_veiculo,
						 $_obs,
						 $_n_ende_resp,
						 $_municipio,
						 $_cpf_resp,
						 $_placa,
						 $_tel_dest,
						 $_cel_dest){

			$con = Conexao::getInstance();
			
			$sql = "INSERT INTO aju_pagamento (dataLibera, id_liberacao, dtLimite, dtPagto, beneficiario, responsavel, nDocumento, n_recibo, endereco, bairro, cpf_benef, veiculo, obs, n_end_resp, municipio, cpf_resp, placa, tel_dest, cel_dest) VALUES (
								'".DataMysql::dataForm($_dt_libera)."',
								$_id_libera,
								'".DataMysql::dataForm($_dt_limite)."',
								'".DataMysql::dataForm($_dt_pagto)."',
								'".$_beneficiario."',
								'".$_responsavel."',
								'{$_n_documento}',
								{$_n_recibo},
								'".$_endereco."',
								'".$_bairro."',
								'{$_cpf_benef}',
								'".$_veiculo."',
								'{$_obs}',
								'{$_n_ende_resp}',
								'{$_municipio}',
								'{$_cpf_resp}',
								'{$_placa}',
								'{$_tel_dest}',
								'{$_cel_dest}')";

			
				$result = $con->query($sql);
			
			
				$sql1 = "UPDATE aju_liberacao 
							SET situacao='1' 
							WHERE id_liberacao= {$_id_libera}";

				$result1 = $con->query($sql1);

				return true;
			
		}


		/**
		 *  Marcar aju_item como material pago 
		 */
		public function marcarPagoAjuItem($_id_liberacao){

			
			$con = Conexao::getInstance();
			
			try{
				
				$sql = "UPDATE aju_item SET situacao = '1' WHERE id_liberacao = ".$_id_liberacao;
				$result = $con->query($sql);
				
				return true;
			}catch (Exception $e){

			}

		}



		#@ relatorio de pagamento de materiais
		static function relPgto($nLibera){

			$con = Conexao::getInstance();

			$dados = "";

			try {
			
				$sql = "SELECT id_pagamento,
								dataLibera,
								id_liberacao,
								dtLimite,
								dtPagto,
								beneficiario,
								responsavel,
								nDocumento,
								n_recibo,
								endereco,
								bairro,
								cpf_benef,
								veiculo,
								obs,
								n_end_resp,
								municipio,
								cpf_resp,
								placa,
								tel_dest,
								cel_dest
								FROM aju_pagamento
								WHERE id_liberacao = {$nLibera}";
				
				$result = $con->query($sql);

				while($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dados = $linha;
				}

				return $dados;
			}catch (Exception $e) {
				return null;
				print $e->getMessage();

			}
			
				
		}
		
		#@ obten-se o id da liberacao baseado no id do usuario que está liberado
		function pegarIdLiberaPgto($idUser){

			$con = Conexao::getInstance();

			$dados = "";
			
			$sql = "SELECT l.id_liberacao
						FROM aju_liberacao l ". 
						"WHERE l.id_user_pgto = {$idUser}
						 AND l.situacao = '0'
						 AND l.dtlimite >= sysdate()";
			
			$result = $con->query($sql);
			
			if($result->rowCount() > 0){
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
					$dados = $linha['id_liberacao'];
				}

				return $dados;
			}
		}
                
                
                # select pgto pelo ID
		function pagamentoId($id_pagamento){

			$con = Conexao::getInstance();

			$dados = "";
			
			$sql = "SELECT id_pagamento, 
                                id_liberacao, 
                                municipio
                                FROM aju_pagamento
                                WHERE id_pagamento = {$id_pagamento}";
			
			$result = $con->query($sql);
			
			if($result->rowCount() > 0){
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
					$dados[] = $linha;
				}

				return $dados;
			}
		}
		
		#@ relatorio de materia pago 
		function relMatPago(){
				
			$con = Conexao::getInstance();

			$dados = "";
			
			$sql = "";
			
			$result = $con->query($sql);
			
			if($result->rowCount() > 0){
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
					$dados = "";
				}

				return $dados;
			}
		}
	
		#@ pega o ultimo id dp pagamento para montar o recibo do pagamento do material
		function PegaUltimoIdPagamento(){
			$con = Conexao::getInstance();
			$dados = "";	
			$sql = 'SELECT id_pagamento 
					FROM aju_pagamento 
					ORDER BY id_pagamento 
					DESC LIMIT 1 ';
			

			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				return $linha['id_pagamento'];
			}

			return $dados;
									
		}	
		
		
		public static function getReciboDigPgto($id_pgto){

			#ler diretorio
			$path = "anexo/recibo_pgto/";
			$diretorio = dir($path);

			$lista = array();
			
			while($arquivo = $diretorio -> read()){
				if(substr($arquivo, 0, 2) == $id_pgto){
					$lista[] = $arquivo;
				}
			}
			$diretorio -> close();
			
			return $lista;

		}


		/** Total Material Pago */
	public static function totMaterialPago($material, $post){
		
		$con = Conexao::getInstance();
			
			/* Data inicial e  data final em branco */
			if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal']))){
				$where = "AND aju_pagamento.dtPagto >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND aju_pagamento.dtPagto <= '".DataMysql::dataForm($post['txtDtFinal'])."'";
			
			
			}else if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal'])) && (!empty($post['id_municipio']))) {
				$where = "AND aju_pagamento.dtPagto >= '".DataMysql::dataForm($post['txtDtInicial'])."'
				 AND aju_pagamento.dtPagto <= '".DataMysql::dataForm($post['txtDtFinal'])."'
				 AND aju_liberacao.id_municipio = ".$post['id_municipio']."
				 group by aju_liberacao.id_municipio";
			}else {
				$where = "";
			}
			
			$dados = array();

			$sql = "SELECT sum(aju_item.quantidade) as qtd FROM aju_item
							inner join aju_pagamento
							on aju_pagamento.id_liberacao = aju_item.id_liberacao
							WHERE aju_item.situacao <= '1'
							and aju_item.evento IS NOT NULL
							and aju_item.cod = ".$material." ".$where;

					$result = $con->query($sql);

					

					while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
						$dados = $linha['qtd'];

					}
					return $dados ;
	}


	/**
	 * Cancelamento de Pagamento de Materiais
	 * 
	 */
	public static function cancelaPagamento($id_liberacao, $_motivo) {

		$con = Conexao::getInstance();
			
			try{
				
				$sql = "UPDATE aju_pagamento 
						SET situacao = 2,
						motivo = '".$_motivo."'
						WHERE id_liberacao = ".$id_liberacao;
				
				$result = $con->query($sql);
				
				return true;
			}catch (Exception $e){

			}




	}
}?>