<?php 
    require_once(PATH.'/mod_ajuda/Model/TransferenciaMaterialModel.php');

	class TransferenciaMaterial	{

		
		#@ Lanca transferencia de materiais
		function CadastraTransferencia($_dt_transferencia,
										$_motorista,
										$_veiculo,
										$_placa,
										$_dt_saida,
										$_dt_chegada,
										$_id_dep_destino,
										$_situacao,
										$_id_dep_origem) {
			
			try{								

				$con = Conexao::getInstance();
				
				$sql = "INSERT INTO aju_transferencia (dt_transferencia,
														motorista,
														veiculo,
														placa,
														dt_saida,
														dt_chegada,
														id_dep_destino,
														situacao,
														id_dep_origem) VALUES ('".$_dt_transferencia."',
																						'".$_motorista."',
																						'".$_veiculo."',
																						'".$_placa."',
																						'".$_dt_saida."',
																						'".$_dt_chegada."',
																						'".$_id_dep_destino."',
																						'".$_situacao."',
																						'".$_id_dep_origem."')";
				
				$result = $con->query($sql);
			
				return true;
			}catch (Exception $e){

			}

		}

		#@ debita saldo dos depositos origem
		function DebitarOrigem($_id_dep_origem, $_id_produto, $_quantidade){

			$con = Conexao::getInstance();

			try{

				$sql = "UPDATE aju_estoque 
						SET saldo = saldo -".$_quantidade." 
						WHERE id_produto=".$_id_produto." and
						id_deposito = ".$_id_dep_origem."";
                                
				$result = $con->query($sql);

				return true;
			}catch (Exception $e) {

			}

		}

		#@ lanca materiais no aju_item_tranferencia
		function LancaItemTransferencia($_id_transferencia, $_id_produto, $_descricao, $_quantidade){

			$con = Conexao::getInstance();

			try{

				$sql = "INSERT INTO aju_item_transf (id_transferencia,
													id_produto,
													descricao,
													quantidade)
													VALUES ('".$_id_transferencia."',
															'".$_id_produto."',
															'".$_descricao."',
															'".$_quantidade."')";

				$result = $con->query($sql);


				return true;
			}catch (Exception $e){

			}
		}

		#@ pega o ultimo id da transferencia
		function getUltimoId(){

			$con = Conexao::getInstance();

			$dado = "";

			try{

				$sql = "select id_transferencia 
						from aju_transferencia
						order by id_transferencia
						desc limit 1";

				$result = $con->query($sql);

				while($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dado = $linha['id_transferencia'];
				}
				return $dado;

			}catch (Exception $e){

			}

		}


		#@ insere produto na tabela aju_produto para controle de material que entrou como transferencia entre depositos
		function RegistraMaterial($_id_produto,
								  $_descricao,
								  $_dt_transferencia,
								  $_origem,
								  $_obs,
								  $_quantidade,
								  $_id_dep_destino,
                                                                  $_id_dep_origem){

			$con = Conexao::getInstance();

			try{
			
				$sql = "INSERT INTO aju_produto (codProd,
												nome,
												dtEntradaSaida,
												origem,
												obs,
												quantidade,
												depDestino,
                                                                                                id_dep_origem)
												VALUES (".$_id_produto.",
														'".$_descricao."',
														'".$_dt_transferencia."',
														'".$_origem."',
														'".$_obs."',
														".$_quantidade.",
														".$_id_dep_destino.","
                                        . "                                                                     ".$_id_dep_origem.")";
				
					$result = $con->query($sql);
					return true;
			}catch (Exception $e){
                            //print $sql;
                            print $e->getMessage();
                                    

			}
		}

		/*function Transferencia($id_produto, $descricao, $data_transf, $depOrigem, $quantidade, $_id_dep_destino, $saldo){
			
			if($saldo >= $quantidade) {

		
				#@ insere produto na tabela aju_produto para controle de material que entrou como transferencia entre depositos
				$sql = "insert into aju_produto (codProd, nome, dtEntradaSaida, origem, obs, quantidade, depDestino) VALUES (".$id_produto.", \"$descricao\", \"$data_transf\", '$depOrigem', \"Transferencia\", $quantidade, '$_id_dep_destino')";
			
				//print $sql;
				
				mysql_query($sql) or die (mysql_error().'Erro ao registrar entrada de produto no sistema !');
				
				
				//print $sqlUp;
				
				mysql_query($sqlUp) or die (mysql_error().'Erro ao atualizar o saldo da Origem !');
				
				#@ atualiza o saldo destino acrescentando o novo saldo
				$sqlTrans = "UPDATE aju_estoque SET saldo = saldo +".$quantidade." WHERE id_produto=".$id_produto." and id_deposito =".$_id_dep_destino."";
				
				//print $sqlTrans;
				
				mysql_query($sqlTrans) or die (mysql_error()."erro 14");
				
				return true;
				
			}
		
		}*/
		
	#@ function lista itens Transferencia
	static function ListaItensTransferencia($_id_transferencia){

		$dados = array();

		$con = Conexao::getInstance();

		try{

			$sql = "SELECT i.id_produto as id_produto,
							i.descricao as descricao,
							i.quantidade as quantidade,
							u.nome as nome
							FROM aju_item_transf i
							INNER JOIN aju_unidade u
							ON i.id_produto = u.id_unidade
							WHERE id_transferencia = ".$_id_transferencia;

			$result = $con->query($sql);
					
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
				$dados[] = $linha;		
			}

			return $dados;
		}catch (Exception $e){
			
		}
	}

	#@ Lista item para Cancelar
	function ListaItemTransferenciaCancela($_id_transferencia){

		$_dados = array();

		$con = Conexao::getInstance();

		try{

		$sql = "select t.id_transferencia,
		        i.id_produto as id_produto,
		        t.id_dep_destino as id_dep_destino,
		        i.quantidade as quantidade,
		        t.id_dep_origem
		        from aju_transferencia t
		        inner join aju_item_transf i
		        on t.id_transferencia = i.id_transferencia
		        where t.id_transferencia = ".$_id_transferencia;

			$result = $con->query($sql);

			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$_dados[] = $linha;
			}
			return $_dados;
		}catch(Exception $e){

		}

	}


	#@ receber material transferido entre depositos
	function receberMaterial($id_deposito_destino, $_nivel){

		$con = Conexao::getInstance();
	    
        if($_nivel == "3") {
            
            $sql ='SELECT id_transferencia,
                      veiculo,
                      motorista,
                      dt_saida
                      FROM aju_transferencia
                      WHERE situacao = 0';
            
        }else {
		
		$sql ='SELECT id_transferencia,
					  veiculo,
					  motorista,
					  dt_saida
					  FROM aju_transferencia
					  WHERE id_dep_destino = '.$id_deposito_destino.' AND situacao = 0';
		}

		$result = $con->query($sql);

		print '<table class="table">
					<tr>
						<td>Código</td>
						<td>Veículo</td>
						<td>Motorista</td>
						<td>Data Saida</td>
						<td>Ação</td>
					</tr>';
		
		while($linha = $result->fetch(PDO::FETCH_ASSOC)){
			
			print "<tr>
						<td>".$linha['id_transferencia']."</td>
						<td>".$linha['veiculo']."</td>
						<td>".$linha['motorista']."</td>
						<td>".DataMysql::extraiData($linha['dt_saida'])."</td>
						<td><a class=\"btn btn-primary\" href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=recebimento&acao=receber&id=".$linha['id_transferencia']."\"><i class=\"\">Receber</i></a></td>
					</tr>";
		}

		print '</table>';
				
	}

	/**
	 * Dados Transferencia para Comprovante de Recebimento de Materiais
	 * 
	 */

	 function CompRecebMateriais($id_transferencia){

		$con = Conexao::getInstance();

		$dados = "";

		$sql = "SELECT id_transferencia,
						dt_transferencia,
						motorista,
						veiculo,
						placa,
						dt_saida,
						dt_chegada,
						id_dep_destino,
						situacao,
						responsavel,
						doc_res,
						obs,
						baixa,
						motivo,
						id_dep_origem
						FROM aju_transferencia
						WHERE id_transferencia = ".$id_transferencia;

		$result = $con->query($sql);

		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			$dados = $linha;
		}

		return $dados;
	 }

	#@ Controle Baixa de Materiais
	function ControleBaixa($_id_produto, $_id_deposito, $_data, $_quantidade, $_motivo){

		$con = Conexao::getInstance();

		try{
			
			$sql = 'INSERT INTO aju_baixa (id_produto, id_deposito, data, quantidade, motivo)
					VALUES ('.$_id_produto.', '.$_id_deposito.', "'.$_data.'", '.$_quantidade.', "'.$_motivo.'")';
			
			$result = $con->query($sql);

			return true;
		}catch (Exception $e) {

		}
	}


		#@ Cancelamento de material em Trânsito
		function CancelaTransferencia($id_transferencia,
									  $_txt_dt_cancela,
									  $_txt_observacao) {

			$con = Conexao::getInstance();
			
			$sql = "UPDATE aju_transferencia
					 SET situacao = 2,
					 	 obs ='Cancelado por : ".$_COOKIE['seguranca']['login']." em :".$_txt_dt_cancela."',
					 	 motivo = '".$_txt_observacao."'
					 	 WHERE id_transferencia = ".$id_transferencia. "
					 	 AND situacao = 0";
			
		
			$result = $con->query($sql);

			$_linha = $result->rowCount();

			if($_linha == 0) {

				print "<script type='text/javascript'>";
				print utf8_decode("alert('Transferência não disponível para Cancelamento !');");
				print "window.close();";
				print "</script>";

				return false;
			}else {
				return true;
			}
		}

		#@ Cancela Item de Transferencia
		function CancelaItemTransferencia($_id_transferencia){

			$con = Conexao::getInstance();

			try{

				$sql = "UPDATE aju_item_transf
						SET situacao = 2
						WHERE id_transferencia = ".$_id_transferencia;

				$result = $con->query($sql);

				return true;
			}catch (Exception $e){

			}
		} 


		#@ informacoes sobre o material em transito
	function materialTransito($_id_dep_destino = false, $_nivel, $_id_transferencia){

		$con = Conexao::getInstance();
			
			if($_nivel != 3){

				$dados = array();
				
				$sql_transito = 'SELECT aju_transferencia.id_transferencia,
                                aju_item_transf.id_produto,
                                aju_transferencia.id_dep_origem,
                                aju_transferencia.id_dep_destino,
                                aju_item_transf.quantidade,
                                aju_transferencia.veiculo,
                                aju_transferencia.motorista,
                                aju_transferencia.placa
                                    FROM  aju_transferencia
                                    inner join aju_item_transf
                                    on aju_transferencia.id_transferencia = aju_item_transf.id_transferencia
                                        WHERE aju_transferencia.situacao = 0
                                        and aju_transferencia.id_dep_destino = '.$_id_dep_destino.'
                                        and aju_transferencia.id_transferencia ='. $_id_transferencia;
			}
			else {
				
				$sql_transito = 'SELECT aju_transferencia.id_transferencia,
                                i.id_produto,
                                aju_transferencia.id_dep_origem,
                                aju_transferencia.id_dep_destino,
                                i.quantidade,
                                aju_transferencia.veiculo,
                                aju_transferencia.motorista,
                                aju_transferencia.placa
                                    FROM aju_transferencia
                                    inner join aju_item_transf i
                                    on aju_transferencia.id_transferencia = i.id_transferencia
                                        WHERE aju_transferencia.situacao = 0
                                        and aju_transferencia.id_transferencia = '.$_id_transferencia;
			}

				$result = $con->query($sql_transito);
				
					while($linha = $result->fetch(PDO::FETCH_ASSOC)){
						$dados[] = $linha;
						
					}

					print '<table class="table table-bordered table-condensed">
							<tr>
								<td colspan="4"><!--ID--><b>Transferencia Nº</b> : '.$dados[0]['id_transferencia'].'</td>
							</tr>
							<tr>
								<td colspan="2"><span style="font-weight: bold;">OrigemDe</span> : '.Deposito::PegaNomeDeposito($dados[0]['id_dep_origem']).' </td>
								<td colspan="2"><span style="font-weight: bold;">Destino</span> :'.Deposito::PegaNomeDeposito($dados[0]['id_dep_destino']).'</td>
							</tr>
							<tr>
								<td colspan="2">Mororista:</td>
								<td colspan="2">'.$dados[0]['motorista'].' </td>
							</tr>
							<tr>
								<td colspan="2">Veículo:</td>
								<td colspan="2">'.$dados[0]['veiculo'].'</td>
								</tr>
								<tr>
									<td colspan="2">Placa:</td>
									<td colspan="2">'.$dados[0]['placa'].'</td>
								</tr>
						  </table>';

					print '<table class="table table-bordered table-condensed">
							<tr>
								<th>Nome</th>
								<th>Quantidade</th>
							</tr>';
						
						  foreach ($dados as $key => $value) {
							 
							print '<tr>
								<td>'.Produto::PegaNomeProduto($value['id_produto']).'</td>
								<td>'.$value['quantidade'].'</td>
							</tr>';
							
						  }
							print '</table>';
				
		}

	#@ marca o saldo com icone 
	static function MarcaTransitoTransferencia($_id_produto, $_id_dep_destino){

		try{
			
			$dados = array();
		
			$con = Conexao::getInstance();
			 
			$sql = "select i.id_produto, t.id_transferencia, t.id_dep_destino
					from aju_item_transf i
					inner join aju_transferencia t
					on i.id_transferencia = t.id_transferencia
					where i.id_produto = ".$_id_produto." and t.id_dep_destino = ".$_id_dep_destino." and t.situacao = 0";
		
			$result = $con->prepare($sql);
			$result->bindParam(":id_produto", $_id_produto);
			$result->bindParam(":id_dep_destino", $_id_dep_destino);
			$result->execute();
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
				$dados = $linha;
			}

			#@ teste o numero de linhas obtidas 
			$nlinha = $result->rowCount();
			
				if($nlinha > 0){
					#@ monta o link com o icone de transferencia no item do saldo de materiais				
					//return "<a href=\"javascript:NovaJanela('index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=&modulo=ajuda&secao=transferencia&acao=visualiza_mat_transferido&dest=".$linha[2]."&mat=".$linha[0]."&id=".$linha[1]."', 700, 300)\"><img src='mod_ajuda/imagem/transito.png' title='Existe Material em Transito '></a>";
	                return "<a href=\"javascript:NovaJanela('index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=lembrete_transito&id=".$dados['id_transferencia']."', 700, 300)\"><img src='mod_ajuda/imagem/transito.png' title='Existe Material em Transito '></a>";
				}
		}catch (Exception $e){
			
			print $e->getMessage();
		}
	}

	#@ preenche o formulario para efetivar o recebimento do material em transito
	function MaterialReceber($id_transferencia){

		$con = Conexao::getInstance();

		$dados = "";

		try{
		
			$sql = 'SELECT id_transferencia,
						id_dep_destino,
						veiculo,
						motorista,
						placa,
						dt_saida,
						dt_chegada,
						id_dep_origem
						FROM aju_transferencia
						WHERE id_transferencia = '.$id_transferencia;
			

			$result = $con->query($sql);
			
			while($linha = $result->fetch(PDO::FETCH_ASSOC)){
				$dados = $linha;
			}

			return $dados;
		}catch (Exception $e) {
			print $e->getMessage();
		}

	}

	#@ efetivar recebimento de materiais
	function MaterialEfetivarReceber($_id_transferencia,
									 $_responsavel,
									 $_doc_responsavel,
									 $_observacao,
									 $_baixa,
									 $_motivo,
									 $_dt_chegada){

		$con = Conexao::getInstance();

		try{

			$sql = "UPDATE aju_transferencia
					SET situacao = 1,
					responsavel = '".$_responsavel."',
					doc_res = '".$_doc_responsavel."',
					obs = '".$_observacao."',
					baixa = ".$_baixa.",
					motivo = '".$_motivo."',
					dt_chegada = '".$_dt_chegada."'
					WHERE id_transferencia=".$_id_transferencia;

			$result = $con->query($sql);

			return true;
		}catch (Exception $e){

		}

	}
	
	function guiaTransferencia($id_transferencia) {
		
		$sql = '';
        
        $dados = 0;
        return $dados;        
	} 
		
    #@ posicao da situacao do pedido
    static function situacaoPgto($a){

        if($a == 0) {
            return "Em Aberto";
        }
        elseif ($a == 1){
            return "Recebido";
        }
        else{
            return "Cancelado";
        }

	}

	/**
	 * Materiais Itens da Transferencia
	 */
	public function getItensTranferecia($_id_transferencia){

		$con = Conexao::getInstance();

		$dados = array();
		
		$sql = "SELECT id_transferencia, id_produto, descricao, quantidade
		FROM aju_item_transf
		WHERE id_transferencia = ".$_id_transferencia;

		$result = $con->query($sql);

		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			$dados[] = $linha;
		}

		return $dados;

	}


		/** Total Material Transferido */
		public static function totMaterialTransferencia($material, $post){
		
			$con = Conexao::getInstance();
				
				/* Data inicial e  data final em branco */
				if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal']))){
					$where = "AND aju_transferencia.dt_transferencia >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND aju_transferencia.dt_transferencia <= '".DataMysql::dataForm($post['txtDtFinal'])."'";
				
				
				}else if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal'])) && (!empty($post['id_municipio']))) {
					$where = "AND aju_pagamento.dtPagto >= '".DataMysql::dataForm($post['txtDtInicial'])."'
					 AND aju_pagamento.dtPagto <= '".DataMysql::dataForm($post['txtDtFinal'])."'
					 AND aju_liberacao.id_municipio = ".$post['id_municipio']."
					 group by aju_liberacao.id_municipio";
				}else {
					$where = "";
				}
				
				$dados = array();
	
				$sql = "SELECT sum(aju_item_transf.quantidade) as qtd FROM aju_item_transf
								inner join aju_transferencia
								on aju_transferencia.id_transferencia = aju_item_transf.id_transferencia
								WHERE aju_item_transf.id_produto = ".$material." ".$where;
				
				/*$sql = "SELECT sum(aju_item_transf.quantidade) as qtd FROM aju_item_transf
								inner join aju_transferencia
								on aju_transferencia.id_transferencia = aju_item_transf.id_transferencia
								WHERE aju_item_transf.situacao <= '1'
								and aju_item_transf.id_produto = ".$material." ".$where;*/
	
						$result = $con->query($sql);

						while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
							$dados = $linha['qtd'];
	
						}
						return $dados ;
		}
	
}?>