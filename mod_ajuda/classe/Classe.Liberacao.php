<?php //require_once(PATH.'/core/classe/Classe.Data.php');
/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
* 																					*
* 	Classe para manipulacao de liberacoes 											*
* 																					*
* 	Autor: Demetrio da Silva Passos													*
* 																					*
* 	Criacao : 01/02/2012															*
************************************************************************************/

class Liberacao extends DataMysql{

	private $idMunicipio;
	private $id_usuario;
	private $depDestino;
	private $beneficiario;
	private $evento;
	private $observacoes;
	public $idLibera;
	private $descicao;
	private $qtd;
	private $dtLimite;
	private $situacao;
	private $idDepDestino;
	private $id_user_pgto;
	private $resp;
	private $entrega;
	private $id_deposito;
	private $dataRecibo;

	private static $dados;
	
	# @ adiciona a liberacao na tabela 'liberacao' do banco.
	function libera($nDatalibera, $nIdMunicipio, $nid_usuario, $nDepDestino, $nBeneficiario, $nEvento, $nObservacoes, $nDtLimite, $nSituacao, $nid_user_pgto, $_resp, $_entrega, $_dataRecibo) {
		
		$this -> datalibera = $nDatalibera;
		$this -> idMunicipio = $nIdMunicipio;
		$this -> id_usuario = $nid_usuario;
		$this -> depDestino = $nDepDestino;
		$this -> beneficiario = $nBeneficiario;
		$this -> evento = $nEvento;
		$this -> observacoes = $nObservacoes;
		$this -> dtLimite = $nDtLimite;
		$this -> situacao = $nSituacao;
		$this -> id_user_pgto = $nid_usuario;
		$this -> resp = $_resp;
		$this -> entrega = $_entrega;
                $this -> dataRecibo = $_dataRecibo;
		
		$id = array();

		$sql = "INSERT INTO aju_liberacao (dataLibera,
                                    		id_municipio,
                                    		id_usuario,
                                    		depDestino,
                                    		beneficiario,
                                    		evento,
                                    		observacao,
                                    		dtLimite,
                                    		situacao,
                                    		id_user_pgto,
                                    		responsavel,
                                    		entrega,
                                                dt_recibo,
                                                hora_libera)
                                    		      VALUES (:nDatalibera,
                                                    	  :nIdMunicipio,
                                                    	  :nid_usuario,
                                                    	  :nDepDestino,
                                                    	  :nBeneficiario,
                                                    	  :nEvento,
                                                    	  :nObservacoes,
                                                    	  :nDtLimite,
                                                    	  :nSituacao,
                                                    	  :nid_user_pgto,
                                                    	  :resp,
                                                    	  :entrega,
                                                          :dt_recibo,
                                                          :hora_libera)";

        try {
            
            $result = Conexao::getInstance()->prepare($sql);
            
            $result->bindValue(":nDatalibera",  $nDatalibera);
            $result->bindValue(":nIdMunicipio", $nIdMunicipio);
            $result->bindValue(":nid_usuario",  $nid_usuario);
            $result->bindValue(":nDepDestino",  $nDepDestino);
            $result->bindValue(":nBeneficiario",$nBeneficiario);
            $result->bindValue(":nEvento",      $nEvento);
            $result->bindValue(":nObservacoes", $nObservacoes);
            $result->bindValue(":nDtLimite",    $nDtLimite);
            $result->bindValue(":nSituacao",    $nSituacao);
            $result->bindValue(":nid_user_pgto",$nid_user_pgto);
            $result->bindValue(":resp",         $_resp);
            $result->bindValue(":entrega",      $_entrega);
            $result->bindValue(":dt_recibo",    $_dataRecibo);
            $result->bindValue(":hora_libera",  date('H:i:s'));
            $result->execute();
            
    
    		# pega o ultimo id que foi adicionado
    		$sqlCodLib = "SELECT id_liberacao, depDestino FROM aju_liberacao ORDER BY id_liberacao DESC LIMIT 1";
    		
    		$result = Conexao::getInstance()->query($sqlCodLib);
    
    		
    		while ($linha = $result->fetch(PDO::FETCH_NUM)) {

				$id = $linha;

			}
			
            Log::GravaLog("Feita Liberacao Nr: ".$id[0], "aju_log");
            
    		return $id;
    		
        } catch (Exception $e) {
        
            return $e->getMessage()."Erro ao inserir Liberacao";
        
        }                                            		


	}

	# @ adiciona item na tabela 'item'
	function adItem($_dt_liberacao,
        			$_id_liberacao,
        			$_descricao,
        			$_quantidade,
        			$_id_produto,
        			$_tipo,
					$_id_dep_origem,
					$_evento) {

		$sql = "INSERT INTO aju_item (dataLibera,
                                		id_liberacao,
                                		descricao,
                                		quantidade,
                                		cod,
                                		tipo,
                                		id_dep_origem,
										evento)
		                                VALUES ( :dt_liberacao,
                                                 :id_liberacao,
                                                 :descricao   ,
                                                 :quantidade  ,
                                                 :id_produto  ,
                                                 :tipo 		  ,
                                                 :id_dep_origem,
												 :evento)";
		
		try {
		    
    		$result = Conexao::getInstance()->prepare($sql);
    		
    		$result->bindValue(":dt_liberacao", $_dt_liberacao);
    		$result->bindValue(":id_liberacao", $_id_liberacao);
    		$result->bindValue(":descricao",    $_descricao);
    		$result->bindValue(":quantidade",   $_quantidade);
    		$result->bindValue(":id_produto",   $_id_produto);
    		$result->bindValue(":tipo", 		   $_tipo);
    		$result->bindValue(":id_dep_origem",$_id_dep_origem);
    		$result->bindValue(":evento",$_evento);
    		$result->execute();
    
    		return true;
    		
		} catch (Exception $e) {
		
		    return $e->getMessage()."Erro ao inserir produtos na liberacao !";
		
		}
		

	}

	
	/* function getIdLibera() {

		$sqlCodLib = "SELECT id_liberacao FROM aju_liberacao ORDER BY id_liberacao DESC LIMIT 1";

		$id = mysql_fetch_row(mysql_query($sqlCodLib));
		$this -> idLibera = $id[0];

		return $this -> idLibera;
	} */


	#@ Lista os produtos da liberacao
	static function listaProdutos($_id_liberacao) {

		$con = Conexao::getInstance();

		$dados = array();
		
	    $sql = "SELECT aju_item.id_item,
							aju_item.dataLibera, 
							aju_item.id_liberacao, 
							aju_item.descricao, 
							aju_item.quantidade, 
							aju_item.cod, aju_item.evento,
							aju_unidade.nome
									FROM aju_item
									inner join aju_unidade
									on aju_item.cod = aju_unidade.id_unidade 
									WHERE aju_item.id_liberacao = :id_liberacao";
				
	    try { 
    	    $result = $con->prepare($sql);
    	    $result->bindValue(":id_liberacao", $_id_liberacao);
    	    $result->execute(); 
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados[] = $linha;
			}
			
			return $dados;
			
	    } catch (Exception $e) {    
	        return $e->getMessage()."Erro ao Listar os Produtos";  
	    }
	}


	#@ Lista os produtos da liberacao sem print
	static function listaProdutosSemPrint($_id_liberacao) {

		$con = Conexao::getInstance();

		$sql = "SELECT aju_item.id_item, aju_item.dataLibera, aju_item.id_liberacao, aju_item.descricao, aju_item.quantidade, aju_item.cod, aju_item.evento
        		FROM aju_item
				WHERE aju_item.id_liberacao = {$_id_liberacao};";
				
		try {
			$result = $con->query($sql);

			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$res = array('0'=>Produto::PegaNomeProduto($linha['cod']), '1'=>$linha['descricao'],'2'=>$linha['quantidade'],'3'=>$linha['evento']);
				self::$dados[] = $res;
			}
	
			return self::$dados;
		} catch (Exception $e) {
		
			print $e->getMessage();
		
		}	}


		/**
		 *  relatorio de liberacao 2020 ?
		 * 
		 */
	function RelLibera($nLibera) {

		$con = Conexao::getInstance();

		$sql = "SELECT l.id_liberacao,
				 l.dataLibera,
				 l.id_municipio,
				 l.id_usuario,
				 l.depDestino,
				 l.beneficiario,
				 l.evento,
				 l.observacao
				 	 FROM aju_liberacao l
					 WHERE l.id_liberacao = {$nLibera};";

		try {
			$result = $con->query($sql);

			while ($rLibera = $linha = $result->fetch(PDO::FETCH_BOTH)) {
				$_SESSION['rLibera']['idLibera'] = $rLibera[0];
				$_SESSION['rLibera']['dtLibera'] = $rLibera[1];
				$_SESSION['rLibera']['municipio'] = $rLibera[2];
				$_SESSION['rLibera']['usuario'] = $rLibera[3];
				$_SESSION['rLibera']['depDestino'] = $rLibera[4];
				$_SESSION['rLibera']['beneficiario'] = $rLibera[5];
				$_SESSION['rLibera']['evento'] = $rLibera[6];
				$_SESSION['rLibera']['obs'] = $rLibera[7];
			}
		}catch (Exception $e) {
			print $e->getMessage();
		}

	}

	function cesta() {

		$chave = isset($_SESSION['carro']) ? count($_SESSION['carro']) : 0;
		//echo $chave;
		echo "<table border=\"0\">
		<tr><td>Codigo</td><td>Descricao</td><td>Quantidade</td></tr>";

		for ($i = 0; $i < $chave; $i++) {

			echo "<tr><td>" . $_SESSION['carro'][$i][0] . "</td><td>" . $_SESSION['carro'][$i][1] . "</td><td>" . $_SESSION['carro'][$i][2] . "</td></tr>";
		}
		echo "</table>";

	}

	function mostraCcesta() {

		echo "<table border=\"0\">
		<tr><td>Descri��o</td><td>Quantidade</td></tr>";

		for ($i = 0; $i <= $_SESSION['chave']; $i++) {

			echo "<tr><td>" . $_SESSION['carro'][$i][0] . "</td><td>" . $_SESSION['carro'][$i][1] . "</td><td>" . $_SESSION['carro'][$i][2] . "</td><td><a href=\"valida.remove.item.php?item={$i}&r=1\">Remover</a></td></tr>";
		}
		echo "</table>";
	}


	#@ posicao da situacao do pedido
	static function situacaoLib($situacao){

		switch ($situacao) {
			case '0':
				return "Aberto";
				break;
			case '1':
				return "Pago";
				break;
			case '2':
				return "Cancelado";
				break;
	
			default:
				return "Código inexistente !";
				break;
		}
	}



	#@ Comprovante de Liberacao de Materiais
	static function comprovanteLiberacao($_id_liberacao){

		$con = Conexao::getInstance();

		$sql = 'SELECT id_liberacao,
		dataLibera,
		id_municipio,
		id_usuario,
		depDestino,
		beneficiario,
		evento,
		observacao,
		dtLimite,
		situacao,
		id_user_pgto,
		responsavel,
		entrega
		FROM aju_liberacao
		WHERE id_liberacao = '.$_id_liberacao;

		try {

			$result = $con->query($sql);
			
			while($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				return $linha;
			}
		}catch (Exception $e) {
			print $e->getMessage();
		}

	}

	/**
	 * Cancela liberacao 
	* @param id_liberacao
	* @param motivo
	* @param permissao cancelar liberacao paga (opcional)
	*/
	function cancelaLiberacao($_id_liberacao, $_motivo, $permissao = false){

		$con = Conexao::getInstance();

			# permite cancelar liberacao já paga
				if($permissao) {

					$sql1 = "update aju_liberacao 
							set dt_cancela = '".date('Y-m-d H:i:s')."',
							m_cancela = '$_motivo',
							situacao = 2
							where id_liberacao = ".$_id_liberacao;

				/* Cancelamento de liberacao normal em aberto */
				}else {
					$sql1 = "update aju_liberacao 
							set dt_cancela = '".date('Y-m-d H:i:s')."',
							m_cancela = '$_motivo',
							situacao = 2
							where id_liberacao = ".$_id_liberacao."
							and situacao = 0";
				}
					

				$result1 = $con->query($sql1);
				
				# atualiacao foi realizada
				if($result1->rowCount() > 0) {

					
					$_sql_prod = 'SELECT cod, id_dep_origem, quantidade
									FROM aju_item
									WHERE id_liberacao = '.$_id_liberacao;

					$result2 = $con->query($_sql_prod);
							
						while ($_linha_prod = $result2->fetch(PDO::FETCH_ASSOC)){

							Unidade::AlteraStatusItem($_id_liberacao, "2");
							ControleSaldo::CreditarSaldo($_linha_prod['cod'], $_linha_prod['id_dep_origem'], $_linha_prod['quantidade']);
						}

						if($permissao){
							# cancelamento de pagamento
							Pagamento::cancelaPagamento($_id_liberacao, $_motivo);
						}

						return true;

				}else {
					return false;	
				}
	}

	#@ dados liberacao 
	function buscaLiberacao($_id_liberacao){

		$con = Conexao::getInstance();
		
		$dados = array();
		
		$sql = "SELECT id_liberacao,
						dataLibera,
						id_municipio,
						depDestino,
						beneficiario,
						evento,
						observacao,
						dtLimite,
						responsavel,
						entrega
						FROM aju_liberacao
						WHERE situacao = 0
						and id_liberacao = ".$_id_liberacao;

		$result = $con->query($sql);
				
		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			
			$dados[] = $linha;
			
		}
		
		return $dados;
		
	}


	#@ Busca Liberacao id
	function buscaLiberacaoId($_id_liberacao){

		$con = Conexao::getInstance();
		
		$dados = array();
		
		$sql = "SELECT id_liberacao,
						dataLibera,
						id_municipio,
						depDestino,
						beneficiario,
						evento,
						observacao,
						dtLimite,
						responsavel,
						entrega,
						situacao
						FROM aju_liberacao
						WHERE id_liberacao = ".$_id_liberacao;

		$result = $con->query($sql);
				
		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			
			$dados = $linha;
			
		}
		
		return $dados;
		
	}


	#@ Mostra liberações pendentes (pagina inicial liberação) 
	function listLiberacao(){

		$con = Conexao::getInstance();

		try{
		
			$dados = array();
			
			$sql = "SELECT id_liberacao,
							dataLibera,
							id_municipio,
							depDestino,
							beneficiario,
							evento,
							observacao,
							dtLimite,
							responsavel,
							entrega
							FROM aju_liberacao
							WHERE situacao = 0
							ORDER BY dataLibera";
									
			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados[] = $linha;
			}
			
			return $dados;

		}catch (Exception $e) {
			print $e->getMessage();
		}
		
	}



	/**
	 * 
	 * 
	 */
	function enumSitLiberacao($_tipo){
		
		switch ($_tipo) {
			case '0':
				return "Espera";
				break;
			case '1':
				return "Pagamento";
				break;
			case '2':
				return "Cancelado";
				break;         
			default:
				return "Opção Inválida !";            
				break;
		}   
		
	}
 
 
	static function marcaDagua($_situacao) {
		
		switch ($_situacao) {
			case '1':
				return "<img src=\"mod_ajuda/imagem/marca_pgto.png\" />";
				break;
			case '2':
				return "<img src=\"mod_ajuda/imagem/marca_cancelado.png\" />";
				break;
			default:
				
				break;
		}
		
		
	}
 
 
	static function iconLembrete($_id_liberacao, $dt_limite){
		
		if(date('d/m/Y') <= DataMysql::subtrairDias($dt_limite, "5")) {
			$icon = "user-available.png";
		}else { 
			$icon = "alerta-prazo.png";  
		}
		return $icon;
	}


	/**
	 * Lista de Materias
	 * 
	 */


	/** Total Material Liberado */
	public static function totMaterialLiberado($material, $post){

		$_campoData = "";
		$_campoDeposito = "";
		$_campoMunicipio = "";

		/* filtro por Data */
		if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal']))) {
			$_campoData = " AND aju_item.dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND aju_item.dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."' ";
		}

		/* filtro por deposito */
		if(!empty($post['id_deposito'])) {
			$_campoDeposito = " AND aju_liberacao.depDestino = ".$post['id_deposito']." ";
		}

		/* filtro por municipio */
		if(!empty($post['id_municipio'])) {
			$_campoMunicipio = " AND aju_liberacao.id_municipio = ".$post['id_municipio']." ";
		}

		$con = Conexao::getInstance();
			
		$dados = "";

			$sql = "SELECT sum(aju_item.quantidade) as qtd FROM aju_item
							inner join aju_liberacao
							on aju_liberacao.id_liberacao = aju_item.id_liberacao
							WHERE aju_item.situacao <= '1'
							and aju_item.cod = '".$material."' ".$_campoData.$_campoDeposito.$_campoMunicipio;

					$result = $con->query($sql);

					while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
						$dados = $linha['qtd'];

					}
					return $dados ;
	}
	/** Total Material Liberado */
	public static function totMaterialLiberadoMapa($_id_municipio, $post){
		
		$_campoData = "";
		$_campoDeposito = "";

		/* filtro por Data */
		if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal']))) {
			$_campoData = " AND aju_liberacao.dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND aju_liberacao.dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."' ";
		}

		/* filtro por deposito */
		if(!empty($post['id_deposito'])) {
			$_campoDeposito = " AND aju_liberacao.depDestino = ".$post['id_deposito']." ";
		}

		
		$dados = array();
		$con = Conexao::getInstance();


			$sql = "select aju_liberacao.id_municipio, 
					sum(aju_item.quantidade) as qtd,
					aju_unidade.nome,
					aju_item.evento
					from aju_liberacao
					inner join aju_item
					on aju_liberacao.id_liberacao = aju_item.id_liberacao
					inner join aju_unidade
					on aju_item.cod = aju_unidade.id_unidade
					where aju_liberacao.situacao <='1' 
					and aju_item.situacao <= '1'
					".$_campoData.$_campoDeposito."
					AND aju_liberacao.id_municipio = ".$_id_municipio." 
					 group by aju_item.cod
					order by aju_item.cod";

					$result = $con->query($sql);

					while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
						$dados[] = $linha;

					}
					return $dados ;
	}


	/** Total Material Liberado */
	public static function totMaterialLiberadoPorEvento($material, $post, $evento){

		$_campoData = "";
		$_campoDeposito = "";
		$_campoMunicipio = "";
		$_campoEvento = "";

		/* filtro por Data */
		if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal']))) {
			$_campoData = " AND aju_item.dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND aju_item.dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."' ";
		}

		/* filtro por deposito */
		if(!empty($post['id_deposito'])) {
			$_campoDeposito = " AND aju_liberacao.depDestino = ".$post['id_deposito']." ";
		}

		/* filtro por municipio */
		if(!empty($post['id_municipio'])) {
			$_campoMunicipio = " AND aju_liberacao.id_municipio = ".$post['id_municipio']." ";
		}
		
		$con = Conexao::getInstance();

			if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal']))){
				$where = "AND dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."'";
			}else if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal'])) && (!empty($post['id_municipio']))) {
				$where = "AND aju_item.dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."'
				 AND aju_item.dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."'
				 AND aju_liberacao.id_municipio = ".$post['id_municipio']."
				 group by aju_liberacao.id_municipio";
			}else {
				$where = "";
			}

			$dados = array();
				$sql = "SELECT sum(aju_item.quantidade) as qtd FROM aju_item
					INNER JOIN aju_liberacao 
					ON aju_item.id_liberacao = aju_liberacao.id_liberacao
					WHERE aju_item.situacao <= '1' and aju_item.cod = ".$material."
					AND aju_item.evento = '".$evento."' ".$_campoData.$_campoDeposito.$_campoMunicipio;

					$result = $con->query($sql);

					while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
						$dados = $linha['qtd'];

					}
					return $dados ;
	}


	/** Quantidade de Liberações por municipios */
	public static function liberacaoPorMunicipio($post){
		
		$con = Conexao::getInstance();

		$_campoData = "";
		$_campoDeposito = "";
		$_campoMunicipio = "";


		/* filtro por Data */
		if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal']))) {
			$_campoData = " AND aju_liberacao.dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND aju_liberacao.dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."' ";
		}

		/* filtro por deposito */
		if(!empty($post['id_deposito'])) {
			$_campoDeposito = " AND aju_liberacao.depDestino = ".$post['id_deposito']." ";
		}

		/* filtro por municipio */
		if(!empty($post['id_municipio'])) {
			$_campoMunicipio = " AND aju_liberacao.id_municipio = ".$post['id_municipio']." ";
		}

		/* filtro por evento */
		/* if((!empty($post['sel_evento'])) && ($post['sel_evento'] != "Selecione o Evento")) {
			$_campoEvento = " AND aju_item.evento = ".$post['sel_evento']." ";
		} */

		$dados = array();

			$sql = "SELECT aju_liberacao.id_municipio, count(aju_liberacao.id_municipio) AS qtd FROM aju_liberacao
							WHERE aju_liberacao.situacao <= 1 ".$_campoData.$_campoDeposito.$_campoMunicipio."
							GROUP BY aju_liberacao.id_municipio";

					$result = $con->query($sql);

					while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
						$dados[] = $linha;

					}
					return $dados ;
	}


	/** Quantidade de Liberações por municipios e por eventos */
	public static function liberacaoPorMunicipioPorEvento($evento, $post){
		
		
		$con = Conexao::getInstance();
			if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal'])) && (empty($post['id_municipio']))){
				$where = "AND aju_liberacao.dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND aju_liberacao.dataLibera <= '".dataMysql::dataForm($post['txtDtFinal'])."'";
			}else if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal'])) && (!empty($post['id_municipio']))) {
				$where = "AND aju_liberacao.dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."'
				 AND aju_liberacao.dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."'
				 AND aju_liberacao.id_municipio = ".$post['id_municipio'];
			}else {
				$where = "";
			}

			$dados = array();


			$sql = "select cedec_municipio.nome, aju_unidade.nome, aju_item.cod,
					 aju_item.quantidade as qtd from aju_item
					inner join aju_liberacao
					on aju_item.id_liberacao = aju_liberacao.id_liberacao
					inner join cedec_municipio
					on aju_liberacao.id_municipio = cedec_municipio.id_municipio
					inner join aju_unidade
					on aju_item.cod = aju_unidade.id_unidade
						where aju_liberacao.dataLibera >= '2020/04/07' 
						AND aju_liberacao.dataLibera <= '2020/04/07'
						group by aju_item.cod, aju_liberacao.id_municipio";
				
				

					$result = $con->query($sql);

					while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
						$dados[] = $linha;

					}
					return $dados ;
	}

	/** Busca municipios com liberacao em aberto ou paga */
	public static function buscaMunicipioLiberacao(){

		$con = Conexao::getInstance();

		$dados = array();

		$sql = "select distinct(id_municipio) as id_municipio
					from aju_liberacao 
					where situacao <=1";

		$result = $con->query($sql);

			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados[] = $linha;

			}
		return $dados ;
	}

	/** Busca municipios com liberacao em aberto ou paga */
	public static function buscaMunicipioLiberacaoMapa($post){
	
		$_campoData = "";
		$_campoDeposito = "";
		$_campoMunicipio = "";
		$_campoEvento = "";

		/* filtro por Data */
		if((strlen($post['txtDtInicial']) > 0) && (strlen($post['txtDtFinal'])>0)) {
			$_campoData = " AND aju_liberacao.dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND aju_liberacao.dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."' ";
		}

		/* filtro por deposito */
		if(strlen($post['id_deposito']) > 0) {
			$_campoDeposito = " AND aju_liberacao.depDestino = ".$post['id_deposito']." ";
		}

		/* filtro por municipio */
		if(strlen($post['id_municipio']) >0) {
			$_campoMunicipio = " AND aju_liberacao.id_municipio = ".$post['id_municipio']." ";
		}

		/* filtro por evento */
		if(($post['sel_evento'] != "Selecione o Evento")) {
			$_campoEvento = " AND aju_item.evento = '".$post['sel_evento']."' ";
		}


		$con = Conexao::getInstance();

		$dados = array();

			$sql = "select aju_liberacao.id_municipio, cedec_municipio.nome,
				cedec_municipio_ibge.LATITUDE, cedec_municipio_ibge.LONGITUDE, 
						count(aju_liberacao.id_municipio) as qtd_lib
						from aju_liberacao
						inner join cedec_municipio
						on cedec_municipio.id_municipio = aju_liberacao.id_municipio
						inner join cedec_municipio_ibge
						on cedec_municipio.Codmundv = cedec_municipio_ibge.GEOCODIGO_MUNICIPIO 
						inner join aju_item
						on aju_item.id_liberacao = aju_liberacao.id_liberacao
						where aju_liberacao.situacao < 2 ".$_campoData.$_campoDeposito.$_campoMunicipio.$_campoEvento."
						 group by aju_liberacao.id_municipio";
		

		if(!empty($sql)){
		$result = $con->query($sql);

			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados[] = $linha;

			}
		return $dados ;
		}else {
			return 0;
		}
	}


	/**
	 * Busca status da liberacao
	 */
	public static function buscaStatusLiberacao($id_liberacao) {

		$con = Conexao::getInstance();

		$dados = array();

		$sql = "SELECT status FROM aju_liberacao WHERE id_liberacao = ".$id_liberacao;

		$result = $con->query($sql);

		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			$dados = $linha['status'];
		}
		return $dados;
	}
        
        /* conta liberacao baseada na entrada de materiais */
        public static function CountLibera($id_entrada){
            
            $con = Conexao::getInstance();

		$dados = 0;
            
                $sql = "SELECT COUNT(aju_liberacao.id_liberacao) as totLibera
                            FROM aju_liberacao
                            WHERE id_entrada = {$id_entrada}";

                $result = $con->query($sql);

                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados += $linha['totLibera'];
                }
                return $dados;
        }
        /* conta liberacao baseada na entrada de materiais */
        public static function CountTransferencia($id_entrada){
            
            $con = Conexao::getInstance();

		$dados = 0;
            
                $sql = "SELECT COUNT(aju_transferencia.id_transferencia) as totTransf
                            FROM aju_transferencia
                            WHERE id_entrada = {$id_entrada}";

                $result = $con->query($sql);

                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados += $linha['totTransf'];
                }
                return $dados;
        }



 
 

}?>