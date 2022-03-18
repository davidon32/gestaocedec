<?php

include_once 'Classe.Transferencia.Material.php';

	class ControleSaldo {
		
		private $id_liberacao;
		
		private $id_deposito;
		
		private $id_produto;
		
		private $coluna; # variavel para armazenar as colunas geradas para a tabela temporaria
		
		private $id_dep; # array com id dos depositos
			
		#@checa se o produto tem saldo no estoque
		static function chSaldo($id_produto, $idDeposito, $qtd){ 
			
			try{

				$con = Conexao::getInstance();
				
				$sql = "SELECT e.id_produto, e.id_deposito, e.saldo FROM aju_estoque e
							WHERE e.id_produto = :id_produto
							AND e.id_deposito = :id_deposito
							AND e.saldo >= :saldo";
				
				$result = $con->prepare($sql);
				
				$result->bindParam(":id_produto", $id_produto);
				$result->bindParam(":id_deposito", $idDeposito);
				$result->bindParam(":saldo", $qtd);
				$result->execute();
				
				$qtdLinhas = $result->rowCount();

				if($qtdLinhas == 0){
					$saldo = false;
				}
				else{
					$saldo = true;
				}
				
				return $saldo;
			}catch (Exception $e){
				
				echo $e;
			}
		}
		
		#@debita o saldo do estoque
		static function DebitarSaldo($id_produto, $idDeposito, $qtd){
                
			
			$con = Conexao::getInstance();
			
			try {

				$sql = "UPDATE aju_estoque
				SET saldo = saldo - {$qtd} 
				WHERE id_produto = {$id_produto} 
				AND id_deposito = {$idDeposito}";
				
				$result = $con->query($sql);
				return true;

			
			}catch (Exception $e) {
				print $e;

			}
			
		}
			
		
		#@ creditar o saldo do estoque
		static function CreditarSaldo($id_produto, $idDeposito, $qtd){

			$con = Conexao::getInstance();
			
			try{
				$sql = "UPDATE aju_estoque 
				SET saldo = saldo + {$qtd}
				WHERE id_produto = {$id_produto}
				AND id_deposito = {$idDeposito}";
					
				$result = $con->query($sql);
				return true;

			}catch (Exception $e) {
				print $e;

			}
		}
		
		#@ testar se o prazo limite esta vencido e devolve-lo para o estoque
		function DevolvePedido(){
			
			try {
			
				$con = Conexao::getInstance();
			
				$sql =	"select i.id_item, i.id_liberacao, i.cod,  i.descricao, i.quantidade, l.depDestino ".
							"from aju_item i ".
							"inner join aju_liberacao l ".
							"on l.id_liberacao = i.id_liberacao ".
							"where l.id_liberacao = (select id_liberacao ".
							"from aju_liberacao ".
							"where situacao = 0 and dtlimite <= sysdate() limit 1)"; 
				
				$result = $con->query($sql);
				$result->execute();
				
				if ($result->rowCount() == 0){
					
				}
				else {
					# @atualiza os saldos com os itens da liberacao
					while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
						
							
							$this->id_liberacao = $linha[1];
							
							$sql2 = "UPDATE aju_estoque SET saldo = saldo + {$linha[4]} WHERE id_produto = {$linha[2]} AND id_deposito = {$linha[5]}";
							
							//echo $sql2;
							
							mysql_query($sql2) or die (mysql_errno()." Erro ao devolver produtos ");
				
					}
					
					//echo FuncaoBase::vd($linha[1]);
					//echo FuncaoBase::vd($this->id_liberacao);
				
				
					# @ atualiza a liberacao para codigo de devolvido  
					$sql1 = "UPDATE aju_liberacao SET situacao = '2' WHERE id_liberacao = {$this->id_liberacao}";
			
					mysql_query($sql1) or die (mysql_error()."Erro ao atualizar o o codigo situacao");
	
				}
				
				return true;
				
			}catch (Exception $e){
				
				
			}
			
	
			
		}

		#@ Gera saldo geral dos dos depositos para Transferencia
		function SaldoGeral(){

			$largColProd = 70; #@ largura da coluna dos produtos
			$largColDep	= 140;	#@ largura da coluna do nome dos Depositos
			
			#@ monta as colunas 
			$sqlLinha = "select distinct e.id_produto, u.nome
							from aju_estoque e
							inner join aju_unidade u
							on e.id_produto = u.id_unidade";
							
			$rLinha = mysql_query($sqlLinha);

				print '<table align="center" border="0" cellspacing="0">
						<tr>
						<td width="'.$largColDep.'">Deposito</td>';

			#@ gera as Colunas baseado nos produtos cadastrados
			while($linha = mysql_fetch_array($rLinha)){
				print '<td width="'.$largColProd.'">'.$linha[1].'</td>';
			}
			
			#@ select nome dos depositos
			$sqlNomeDep = "select distinct e.id_deposito, d.nome
				from aju_estoque e
				inner join aju_deposito d
				on e.id_deposito = d.id_deposito";
				
			$resultNome = mysql_query($sqlNomeDep);
			
			#@ gera a Coluna dos nomes dos depositos
			while($linhaNome = mysql_fetch_array($resultNome)){
	
				print '<tr><td align="left" width="'.$largColDep.'"><a href="#" title="Visualizar Todos os Materiais em Trânsito - em desenvolvimento">'.$linhaNome[1].'</a></td>';

				#@ faz select o saldo por deposito
				$sqlSaldo = "select e.id_deposito, e.id_produto, u.nome, e.saldo
							from aju_estoque e
							inner join aju_unidade u
							on e.id_produto = u.id_unidade
							where id_deposito = {$linhaNome[0]} order by e.id_produto, e.id_deposito";
				
				$query = mysql_query($sqlSaldo) or die (mysql_error());
				
				#@ saldo dos depositos individuais dos produtos
				while($rSaldo = mysql_fetch_array($query)){
					
						#@ travar a permissao para transferir // 
						if (true == true){ // acabar de desenvolver a protecao por isto que foi testado se true é igual a true ! sei que isto nao existe !
							print '<td width="'.$largColProd.'"><font size=2><a href="secao.php?secao=material&acao=transferir&idp='.$rSaldo[1].'&dep='.$rSaldo[0].'&sal='.$rSaldo[3].'" title="Transferencia de Material ">'.$rSaldo[3].' '.'</a><a href="#" title="Existe Material em Transito">'.GerTransito::MarcaTransito($rSaldo[1],$rSaldo[0]).'</a></td>';
						}
						else{
							print 'false';							
						}
					}
			}
				print '</td></tr></table>';

		}
		
		
		#@ Gera saldo geral dos dos depositos sem opcao de transferencia
		function VisualizarSaldoGeral(){
		
			$con = Conexao::getInstance();
			
			#@ monta as colunas
			$sqlLinha = "select aju_unidade.id_unidade, aju_unidade.nome
			from aju_unidade";

			/* $sqlLinha = "select distinct e.id_produto, u.nome
							from aju_estoque e
							inner join aju_unidade u
							on e.id_produto = u.id_unidade"; */
							
			$result = $con->query($sqlLinha);
			
			//$rLinha = mysql_query($sqlLinha);
		
					print '<table class="table table-condensed table-bordered table-striped table-responsive">
						<tr>
						<th width="16%" style="text-align:center;">Deposito</th>';

						
		
								#@ gera as Colunas baseado nos produtos cadastrados
								while($linha = $result->fetch(PDO::FETCH_BOTH)){
									print '<th style="text-align:center;">'.$linha[1].'</th>';
		}
			print "</tr>";
            
			#@ select nome dos depositos
			$sqlNomeDep = "select distinct e.id_deposito, d.nome
					from aju_estoque e
					inner join aju_deposito d
					on e.id_deposito = d.id_deposito";
					
			
							$resultNome = $con->query($sqlNomeDep);

							/*$cesta = 0; 		# "1"	"Cesta Basica"
							$lona  = 0;			# "2"	"Lona"
							$kit_limpeza = 0; 	# "3"	"Kit Limpeza"
							$kit_higiene = 0; 	# "4"	"Kit Higiene"
							$colchoes = 0; 		# "5"	"Colchoes"
							$telhas = 0; 		# "6"	"Telhas"
							$cobertor = 0; 		# "7"	"Cobertor"
							$roupa = 0; 		# "8"	"Roupa"
							$cisterna = 0; 		# "9"	"Cisterna"
							$agua = 0; 			# "10"	"Agua"
							$barraca = 0; 		# "11"	"Barraca"
							$kit_dormitorio = 0;# "12"	"kit Dormitorio"
							$total = 0;*/
								
							#@ gera a Coluna dos nomes dos depositos
							while($linhaNome = $resultNome->fetch(PDO::FETCH_BOTH)){
			
								print '<tr><td width="16%">'.htmlentities($linhaNome[1]).'</td>';
				
								#@ faz select o saldo por deposito
								$sqlSaldo = "select e.id_deposito, e.id_produto, u.nome, e.saldo, e.id_produto
								from aju_estoque e
								inner join aju_unidade u
								on e.id_produto = u.id_unidade
								where id_deposito = {$linhaNome[0]} order by e.id_produto, e.id_deposito";
				
								$resultSaldo = $con->query($sqlSaldo);
				
								#@ saldo dos depositos individuais dos produtos
								while($rSaldo = $resultSaldo->fetch(PDO::FETCH_BOTH)){

									/*$cesta += ($rSaldo[4] == 1) ? $rSaldo[3] : 0;
									$lona           += ($rSaldo[4] == 2) ? $rSaldo[3] : 0; 			
									$kit_limpeza    += ($rSaldo[4] == 3) ? $rSaldo[3] : 0;  	
									$kit_higiene    += ($rSaldo[4] == 4) ? $rSaldo[3] : 0;  	
									$colchoes       += ($rSaldo[4] == 5) ? $rSaldo[3] : 0;  		
									$telhas         += ($rSaldo[4] == 6) ? $rSaldo[3] : 0;  		
									$cobertor       += ($rSaldo[4] == 7) ? $rSaldo[3] : 0;  		
									$roupa          += ($rSaldo[4] == 8) ? $rSaldo[3] : 0;  		
									$cisterna       += ($rSaldo[4] == 9) ? $rSaldo[3] : 0;  		
									$agua           += ($rSaldo[4] == 10) ? $rSaldo[3] : 0;  			
									$barraca        += ($rSaldo[4] == 11) ? $rSaldo[3] : 0;  		
									$kit_dormitorio += ($rSaldo[4] == 12) ? $rSaldo[3] : 0;
									$total +=$rSaldo[3]; */
									    
									if($rSaldo[3] == 0){
										$saldoZero = '<font color="red">';
									}else {
										$saldoZero = '';
									}
									print '<td style="text-align:center;">'.$saldoZero.$rSaldo[3].'<a href="#" title="Existe Material em Transito">'.TransferenciaMaterial::MarcaTransitoTransferencia($rSaldo[1],$rSaldo[0]).'</a></td>';						
									
										
								}
							}
							/*print '</tr>
							     <tr>
							        <td style="font-weight:bold; color:blue;">Saldo Total</td>    
									<td style="font-weight:bold; color:blue;">'.$cesta.'</td>   
									<td style="font-weight:bold; color:blue;">'.$lona.'</td>
									<td style="font-weight:bold; color:blue;">'.$kit_limpeza.'</td>
									<td style="font-weight:bold; color:blue;">'.$kit_higiene.'</td>
									<td style="font-weight:bold; color:blue;">'.$colchoes.'</td>
									<td style="font-weight:bold; color:blue;">'.$telhas.'</td>
									<td style="font-weight:bold; color:blue;">'.$cobertor.'</td>
									<td style="font-weight:bold; color:blue;">'.$roupa.'</td>
									<td style="font-weight:bold; color:blue;">'.$cisterna.'</td>
									<td style="font-weight:bold; color:blue;">'.$agua.'</td>
									<td style="font-weight:bold; color:blue;">'.$barraca.'</td>
									<td style="font-weight:bold; color:blue;">'.$kit_dormitorio.'</td> 
								 </tr>
								 <tr>
								 <td colspan="13" align="center">Total de Materiais em Estoque : <b>'.$total.'</b></td></tr>
							</table>';*/
		
		}

		#@ resumo saldo de itens
		function VisualizarSaldoIds($ids){
		
			$con = Conexao::getInstance();

			$arrayId = explode(",", $ids);

			#@ monta as colunas
			$sqlLinha = "select distinct aju_estoque.id_produto, aju_unidade.nome
							from aju_estoque
							inner join aju_unidade
							on aju_estoque.id_produto = aju_unidade.id_unidade
							where aju_estoque.id_produto in (".$ids.")";
							
			$result = $con->query($sqlLinha);
				
					print '<tr>
						<th width="16%" style="text-align:center;">Deposito</th>';
		
								#@ gera as Colunas baseado nos produtos cadastrados
								while($linha = $result->fetch(PDO::FETCH_BOTH)){
									print '<th style="text-align:center;" class="col_'.$linha[1].'">'.$linha[1].'</th>';
		}
			print "</tr>";
            
			#@ select nome dos depositos
			$sqlNomeDep = "select distinct aju_estoque.id_deposito, aju_deposito.nome
					from aju_estoque
					inner join aju_deposito
					on aju_estoque.id_deposito = aju_deposito.id_deposito
					where aju_estoque.id_produto in (".$ids.")";
					
			
							$resultNome = $con->query($sqlNomeDep);

							/*$total['cesta'] 		= 0; # "1"	"Cesta Basica"
							$total['lona']  		= 0; # "2"	"Lona"
							$total['kit_limpeza'] 	= 0; # "3"	"Kit Limpeza"
							$total['kit_higiene'] 	= 0; # "4"	"Kit Higiene"
							$total['colchoes'] 		= 0; # "5"	"Colchoes"
							$total['telhas'] 		= 0; # "6"	"Telhas"
							$total['cobertor'] 		= 0; # "7"	"Cobertor"
							$total['roupa'] 		= 0; # "8"	"Roupa"
							$total['cisterna'] 		= 0; # "9"	"Cisterna"
							$total['agua'] 			= 0; # "10"	"Agua"
							$total['barraca'] 		= 0; # "11"	"Barraca"
							$total['kit_dormitorio']= 0; # "12"	"kit Dormitorio"*/

							$total = array();
							$totalGeral = 0;
								
							#@ gera a Coluna dos nomes dos depositos
							while($linhaNome = $resultNome->fetch(PDO::FETCH_BOTH)){
			
								print '<tr><td width="16%">'.htmlentities($linhaNome[1]).'</td>';
				
								#@ faz select o saldo por deposito
								$sqlSaldo = "select aju_estoque.id_deposito, 
													aju_estoque.id_produto,
													aju_unidade.nome, aju_estoque.saldo, aju_estoque.id_produto
								from aju_estoque
								inner join aju_unidade
								on aju_estoque.id_produto = aju_unidade.id_unidade
								where aju_estoque.id_deposito = {$linhaNome[0]}
								and aju_unidade.id_unidade in (".$ids.")
								order by aju_estoque.id_produto, aju_estoque.id_deposito";
				
								$resultSaldo = $con->query($sqlSaldo);
				
								#@ saldo dos depositos individuais dos produtos
								while($rSaldo = $resultSaldo->fetch(PDO::FETCH_BOTH)){

																	    
									if($rSaldo[3] == 0){
										$saldoZero = '<font color="red">';
									}else {
										$saldoZero = '';
									}

									
									
									print '<td style="text-align:center;" class="'.str_replace(" ", "_", $rSaldo['nome']).'">'.$saldoZero.$rSaldo[3].'<a href="#" title="Existe Material em Transito">'.TransferenciaMaterial::MarcaTransitoTransferencia($rSaldo[1],$rSaldo[0]).'</a></td>';						
									
										
								}
							}
							
		}

		/* saldo por produto */
		public function saldoProduto($id_produto){

			$con = Conexao::getInstance();

			$dados = array();

			$sql = "SELECT id_deposito, id_produto, saldo
				FROM aju_estoque
				WHERE id_produto in ('1', '11')
				ORDER BY id_deposito";

				$result = $con->query($sql);

				while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
					$dados[] = $linha;
				}

				$total = 0;

				var_dump($dados);
								
				foreach ($dados as $key => $value) {
					$total += $value['saldo'];
					print "<tr>
							<td>".Deposito::PegaNomeDeposito($value['id_deposito'])."</td><td>".Unidade::PegaNomeId($value['id_produto'])."</td><td>".$value['saldo']."</td>";
				}

				print "</tr><tr>
							<td colspan=\"2\"></td>
							<td><b>".$total."</b></td>
							</tr>";
		}


		/**
		 * Saldo de todos os materiais de um especifico deposito
		 */
		static public function saldoPorDeposito($id_deposito){

			$con = Conexao::getInstance();

			$dados = array();

			try {

				$sql = "SELECT aju_unidade.nome, aju_estoque.saldo,
                                        aju_unidade.descricao,
                                        aju_unidade.id_unidade
					FROM aju_estoque
					INNER JOIN aju_unidade
					ON aju_estoque.id_produto = aju_unidade.id_unidade
					WHERE aju_estoque.id_deposito = {$id_deposito}"
                                        . " and aju_estoque.saldo > 0";

					$result = $con->query($sql);

					while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
						$dados[] = $linha;
					}
				return $dados;
			}catch (Exception $e){
				print $e;
			}
		}

		/**
		 * Buscar saldo de um produto em um especifico deposito
		 */
		function buscaSaldoMaterialDeposito($id_deposito, $id_material){

			$dados = "";
			$con = Conexao::getInstance();
			$sql = "SELECT saldo FROM aju_estoque
							WHERE id_produto = ".$id_material."
							AND id_deposito = ".$id_deposito;

			$result = $con->query($sql);

			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados = $linha;
			}
			return $dados['saldo'];
		}


		/**
		 * Lanca Saldo zerado para todos os depositos
		 * 
		 */
		public static function lancaSaldoGeralZerado($ultimoId_produto){

			$con = Conexao::getInstance();

			/* select todos os depositos */
			$sql = "select id_deposito from aju_deposito";

			$id_deposito = array();

			$result = $con->query($sql);

			while ($linha_d = $result->fetch(PDO::FETCH_ASSOC)) {
				$id_deposito[] = $linha_d['id_deposito'];
			}

			foreach ($id_deposito as $key => $id_dep) {
				ControleSaldo::lancaSaldoZero($id_dep, $ultimoId_produto);
			}
			

		}

		/** lanca Material saldo zero de cada produto */

		public static function lancaSaldoZero($_id_deposito, $_id_produto){

			$con = Conexao::getInstance();

			try{

				$sql = "INSERT INTO aju_estoque (id_produto,
													id_deposito,
													saldo) 
													VALUES (".$_id_produto.",
															".$_id_deposito.",
															0)";
				
				$result = $con->query($sql);
			
			}catch (Exception $e){
				print $e->getMessage();
			}


		}

	/** Lancamento em C/C */
	static public function lancaCC($data_lanca,
							$id_unidade,
							$historico,
							$origem,
							$destino,
							$tipo,
							$qtd,
							$dc){

							try{

								$con = Conexao::getInstance();
								$sql = "INSERT INTO aju_cc
													(data_reg,
														id_unidade,
														historico,
														origem,
														destino,
														tipo,
														qtd,
														dc)
														VALUES
														(".$data_lanca.",
														 ".$id_unidade.",
														 ".$historico.",
														 ".$origem.",
														 ".$destino.",
														 ".$tipo.",
														 ".$qtd.",
														 ".$dc.")";

								$restul = $con->query($sql);
								return true;
							
							}catch (Exception $e){
								print $e->getMessage();
							}

							}
	
}?>