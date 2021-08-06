<?php

/*******************************************************************************************
 * 	Classe Para Manupular Transferencia de Materiais
 * 
 * 
 * 
 * ******************************************************************************************/

class Transito {
	
	
	/*private static $sql_transito;
	
	#@ insere na tabela transito os materiais que est�o em transito
	function Transito($_id_produto, $_id_dep_origem, $_id_dep_destino, $_quantidade, $_veiculo, $_motorista, $_placa, $_saida){
		
			$sql = 'INSERT INTO aju_transito (id_produto, id_dep_origem, id_dep_destino, quantidade, veiculo, motorista,
					placa, saida) VALUES ('.$_id_produto.', '.$_id_dep_origem.', '.$_id_dep_destino.', '.$_quantidade.', "'.$_veiculo.'", "'.$_motorista.'", "'.$_placa.'", "'.$_saida.'")';
			//print $sql;
			
		
			$result = mysql_query($sql) or die (mysql_error());
			
			return true;
	}
	
	#@ exibe no saldo geral um icone de material em transito
	static function MarcaTransito($_id_produto, $_id_dep_destino){
		
	
		# @ marca no saldo geral para transito que existe material em transito
		$sql = 'SELECT id_produto, id_dep_destino, id_dep_origem, quantidade, veiculo, motorista, placa, saida, chegada
				from aju_transito where id_produto = '.$_id_produto.' and id_dep_destino = '.$_id_dep_destino.' and chegada is null';
		
	
		$result = mysql_query($sql) or die (mysql_error());
		
		$linha = mysql_fetch_array($result);
		#@ teste o numero de linhas obtidas 
		$nlinha = mysql_num_rows($result);
		
			if($nlinha > 0){
				#@ monta o link com o icone de transferencia no item do saldo de materiais				
				return "<a href=\"javascript:abrir('rel/rel.consulta.material.transferido.php?dDest=".$linha[1]."&prod=".$linha[0]."', 700, 300, 50, 200)\"><img src='images/transito.png' title='Existe Material em Transito '></a>";

			}
	}
	
	#@ receber material transferido entre depositos
	function ReceberMaterial($id_deposito_destino){
		
		$sql ='SELECT id_transito, id_produto, id_dep_origem, id_dep_destino, quantidade, veiculo, motorista, placa, saida, chegada
				FROM
				aju_transito
				WHERE id_dep_destino = '.$id_deposito_destino.' and chegada is null';
		
		//print $sql;
		
	
		$result = mysql_query($sql) or die (mysql_error());
		
		while($linha = mysql_fetch_assoc($result)){
			
			print '<li>
					<a href="secao.php?secao=material&acao=receberEfetivar&id='.$linha['id_transito'].'"><img src="images/user-available.png"> '.$linha['veiculo'].' / '.Produto::PegaNomeProduto($linha['id_produto']).'</a>
					</li>';
		}
				
			
		//	print "<script>alert('N�o existe material Transferido para o Deposito !')</script>";
		//}
		
		
	}
	
	#@ preenche o formulario para efetivar o recebimento do material em transito
	function MaterialEfetRece($id_transito){
		
		$sql = 'SELECT id_produto, id_dep_origem, id_dep_destino, quantidade, veiculo, motorista, placa, saida, chegada
				FROM
				aju_transito
				WHERE id_transito = '.$id_transito;
		

		$result = mysql_query($sql) or die (mysql_error());
		
		while($linha = mysql_fetch_array($result)){
			
			return $linha;
		}

	}
	
	#@ Efetivar Recebimento Material
	function EfetReceb($dataHoraReceb, $responsavel, $identificacao, $observacao, $baixa, $id_transito){
			
			$sql = 'UPDATE aju_transito
					SET chegada="'.$dataHoraReceb.'", responsavel = "'.$responsavel.'", identificacao = "'.$identificacao.'", observacao="'.$observacao.'", baixa ='.$baixa.'
					WHERE id_transito= '.$id_transito;
			//print $sql;
			
		
			$result = mysql_query($sql) or die (mysql_error().alert("Erro no recebimento de Materiais "));
			
			return true;
		}
		
	#@ Controle Baixa de Materiais
	function ControleBaixa($_id_produto, $_id_deposito, $_data, $_quantidade, $_motivo){
			
			$sql = 'INSERT INTO aju_baixa (id_produto, id_deposito, data, quantidade, motivo)
					VALUES ('.$_id_produto.', '.$_id_deposito.', "'.$_data.'", '.$_quantidade.', "'.$_motivo.'")';
			
			//print $sql;
			
		
			$result = mysql_query($sql) or die (mysql_error().'- Erro Código 85');

			return true;
		}
	
	#@ informacoes sobre o material em transito
	function MaterialTransito($_id_dep_destino, $_nivel){
			
			if($_nivel != 3){
				
				self::$sql_transito = 'SELECT id_transito, id_produto, id_dep_origem, id_dep_destino, quantidade, veiculo, motorista, placa
						FROM  aju_transito
						WHERE chegada is null and id_dep_destino ='.$_id_dep_destino;
			}
			else {
				
				self::$sql_transito = 'SELECT id_transito, id_produto, id_dep_origem, id_dep_destino, quantidade, veiculo, motorista, placa
						FROM  aju_transito
						WHERE chegada is null';
			}
				
						
			//print self::$sql_transito;
				
			
				$result = mysql_query(self::$sql_transito) or die (mysql_error().'Erro buscando material em transito ');
				
					while($linha = mysql_fetch_assoc($result)){
						
						print '<table align="center" 	width="500" border="0" cellspacing="0" cellpadding="0">
							  <tr>
							    <td colspan="4"><!--ID-->Número Transferência : '.$linha['id_transito'].'</td>
							  </tr>
							  <tr>
							    <td colspan="2"><span style="font-weight: bold;">De</span> : '.Deposito::PegaNomeDeposito($linha['id_dep_origem']).' </td>
							    <td colspan="2"><span style="font-weight: bold;">Para</span> :'.Deposito::PegaNomeDeposito($linha['id_dep_destino']).'</td>
							  </tr>
							  
							  <tr>
							    <td width="150" rowspan="2"></td>
							    
							    <td>Nome</td>
							    <td>Quantidade</td>
							    <td width="150" rowspan="2">&nbsp;</td>
							  </tr>
							  <tr>
							    <td>'.Produto::PegaNomeProduto($linha['id_produto']).'</td>
							    <td>'.$linha['quantidade'].'</td>
		  					</tr>
							  <tr>
							    <td colspan="2">Mororista:</td>
							    <td colspan="2">'.$linha['motorista'].' </td>
							  </tr>
							  <tr>
							    <td colspan="2">Veículo:</td>
							    <td colspan="2">'.$linha['veiculo'].'</td>
							  </tr>
							  <tr>
							    <td colspan="2">Placa:</td>
							    <td colspan="2">'.$linha['placa'].'</td>
							  </tr>
							   <hr>
							</table>';
					}
			
			
			
		}
		
		#@ Cancelamento de material em Trânsito
		function cancelaTransito($id_transito) {
			
			$sql = "UPDATE aju_transito SET chegada='".date('Y-m-d h:i:s')."', situacao='Cancelado' WHERE id_transito = ".$id_transito;
			
			print $sql;
			
			$result = mysql_query($sql) or die (mysql_error()."- Código 56");
			
			return true;
			
		} 
*/

static function MaterialTransito($dep_destino, $_nivel){

	$con = Conexao::getInstance();

	$dados = array();
	$sql ="";

	if($_nivel < 8 ) {
		$sql = "SELECT id_transferencia,
			dt_transferencia,
			motorista,
			placa,
			dt_saida,
			id_dep_origem,
			id_dep_destino
			FROM aju_transferencia
			WHERE situacao = 0 
			ORDER BY dt_transferencia";

	}else {
		$sql = "SELECT id_transferencia,
						dt_transferencia,
						motorista,
						placa,
						dt_saida,
						id_dep_origem,
						id_dep_destino
						FROM aju_transferencia
						WHERE situacao = 0
						And id_dep_destino = ".$dep_destino."
						ORDER BY dt_transferencia";
	}

		$result = $con->query($sql);

		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			$dados[] = $linha;
		}

		return $dados;

}
		
		
		
}?>