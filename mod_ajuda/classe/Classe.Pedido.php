<?php
	/***********************************************************************************
	 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
	* 																					*
	* 	Classe manipular materiais das liberacoes										*
	* 																					*
	* 	Autor: Demetrio da Silva Passos													*
	* 																					*
	* 	Criacao : 01/02/2012															*
	************************************************************************************/
	class Pedido extends FuncaoBase {
		
		private static $achou;	
		#@ monta um item de pedido
		function Item($_id_deposito, $_id_produto, $_descricao, $_quantidade, $evento){
			$_item = array($_id_deposito, $_id_produto, $_descricao, $_quantidade, $evento);
			return $_item;
		}
		
		#@ busca item Duplicado
		public function BuscaDuplicado($_item){
			for($i =0; $i < count($_SESSION['cesta']); $i++){
				if($_item[1] == $_SESSION['cesta'][$i][1]){
					self::$achou = true;
				}
			}
			self::$achou; 	
		}
		
		#@ adiciona o item no pedido
		function AdicionaItem($_item) {
			if($saldo = ControleSaldo::chSaldo($_item[1], $_item[0], $_item[3])){ #@ verifica se o material tem saldo
					if(!isset($_SESSION['cesta']) && ($_SESSION['cesta'][0] == null)){ #@ verifica se a sessao esta iniciada
						$_SESSION['cesta'] = array();
					}
						$key = count($_SESSION['cesta']);
							if ($key <= 0) {
								$_SESSION['cesta'][] = $_item;
								print "<script type='text/javascript'>";
        						print "alert('Material Adicionado com Sucesso !');";
        						print "history.back();";
								print "</script>";
							}else{
								
								if($_item[0] == $_SESSION['cesta'][0][0]){
									for($i =0; $i < $key; $i++){
										if($_item[1] == $_SESSION['cesta'][$i][1])
											self::$achou = true ;
									}
										if(self::$achou == false){
											$_SESSION['cesta'][] = $_item;
											print "<script type='text/javascript'>";
							        		print "alert('Material Adicionado Com Sucesso !');";
							        		print "history.back();";
											print "</script>";									
										}else{
											print "<script type='text/javascript'>";
							        		print "alert('Material Duplicado !');";
							        		print "history.back();";
											print "</script>";		
										}
								}else{
									print "<script type='text/javascript'>";
					        		print "alert('Você está Adicionando material de outro deposito \\n \\nGentileza Confira o DEPOSITO de Origem !');";
									print "</script>";
								}
							}
				
			}else{
				print "<script type='text/javascript'>";
        		print "alert('Saldo Insuficiente !');";
        		//print "history.back();";
				print "</script>";
			}					
		}		
					
		#@ mostra os materiais no pedido
		static function MostraPedido($a){
			if((!isset($a)) || ($a == null)){
			}
			else {
				
				echo '<table class="table table-bordered table-striped">';
				echo '<tr>
						<th style="text-align:center">Deposito</th>
						<th style="text-align:center">Produto</th>
						<th style="text-align:center">Evento</th>
						<th style="text-align:center">Descri&ccedil;&atilde;o</th>
						<th style="text-align:center">Quantidade</th>
						<th style="text-align:center">Op&ccedil;&atilde;o</th>
						</tr>';
				for ($i = 0; $i < count($a); $i++) {
					print "<tr>
							<td>".Deposito::PegaNomeDeposito($a[$i][0])."</td>
							<td align='center'>".Produto::PegaNomeProduto($a[$i][1])."</td>
							<td align='center'>{$a[$i][4]}</td>
							<td align='center'>{$a[$i][2]}</td>
							<td align='center'>{$a[$i][3]}</td>
							<td align='center'><a class=\"btn btn-info\" href=\"?token=".hash('sha256', md5(VERSAO))."&ac=itn&modulo=ajuda&controller=conEstoque&action=remove_item&item=".$i."&r=1\" title=\"Remove Item da Liberação\">Remover</a></td>
							</tr>";
				}
				print "</table>";
			}
		}
		
 public function dadosPedidoId($id_pedido, $_id_municipio = false){
 	
 	$con = Conexao::getInstance();
 	 
 	$dados = array();
 	
 	try{
 	
 		$sql = "SELECT com_comdec.id_comdec,
    						com_comdec.id_municipio,
    						com_comdec.regiao,
    						com_comdec.associacao,
    						com_comdec.num_lei,
    						com_comdec.dt_lei,
    						com_comdec.num_decreto,
    						com_comdec.dt_decreto,
    						com_comdec.num_portaria,
    						com_comdec.dt_portaria,
    						com_comdec.endereco,
    						com_comdec.fone_com1,
    						com_comdec.fone_com2,
    						com_comdec.efetivo,
    						com_comdec.qtd_efetivo,
    						com_comdec.email,
    						com_comdec.nudec,
    						com_comdec.qtd_nudec,
    						com_comdec.capacitacao_nupdec,
    						com_comdec.id_territorio,
    						com_comdec.plano_cont,
    						com_comdec.capacitacao,
    						com_comdec.dt_curso_capac,
    						com_comdec.cartao_pdc,
    						com_comdec.sede_propria,
    						com_comdec.viatura,
    						com_comdec.computador,
    						com_comdec.simulado,
    						com_comdec.mapeamento,
    						com_comdec.curso_gestao,
    						com_comdec.dt_curso_gestao,
    						com_comdec.curso_sco,
    						com_comdec.dt_curso_sco,
    						com_comdec.particip_workshop,
    						com_comdec.dt_partic_workshop,
    						com_comdec.exp_dc,
    						com_comdec.tp_ex_dc,
    						com_comdec.com_const,
    						com_comdec.com_ativa,
    						cedec_user_ex.situacao,
    						com_comdec.sem_decreto,
    						com_comdec.sem_portaria
    						FROM com_comdec
    						INNER JOIN cedec_municipio
    						ON com_comdec.id_municipio = cedec_municipio.id_municipio
    						INNER JOIN cedec_user_ex
    						ON com_comdec.id_municipio = cedec_user_ex.id_municipio";
 	
 		if($_id_municipio) {
 	
 			$sql .= " WHERE com_comdec.id_municipio =:id_municipio";
 		}
 			
 		$sql .= " ORDER BY cedec_municipio.nome";
 	
 		$result = $con->prepare($sql);
 	
 		$result->bindValue(':id_municipio', $_id_municipio);
 	
 		$result->execute();
 	
 	
 		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
 	
 			$dados[] = $linha;
 			 
 		}
 	
 		return $dados;
 	
 	}catch (Exception $e) {
 	
 		print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
 	
 	} 	
 	
 }
 
 public static function existePedido($id_entrada){
     
     $sql = "";
     
 }
		
		
}?>