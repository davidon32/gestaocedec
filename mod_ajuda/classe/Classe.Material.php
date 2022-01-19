<?php

/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
* 																					*
* 	Classe cadastro de material no sistema											*
* 																					*
* 	Autor: Demetrio da Silva Passos													*
* 																					*
* 	Criacao : 01/02/2012															*
************************************************************************************/

class Material {

	
	static function cadastrar($_id_produto,
							$_nome_produto,
							$_dataEntrada,
							$_origem,
							$_obs,
							$_qtd,
							$_nome_deposito,
							$_validade = null,
							$_nota) {
								
		$con = Conexao::getInstance();
				$sql = "insert into aju_produto (codProd,
												nome,
												dtEntradaSaida,
												origem,
												obs,
												quantidade,
												depDestino,
												validade,
												nota_fiscal)
												VALUES (:id_produto,
														:nome_produto,
														:dt_entrada,
														:dep_origem,
														:obs,
														:qtd,
														:dep_destino,
														:validade,
														:nota_fiscal)";
		try {
			$result = $con->prepare($sql);

			$result->bindValue(":id_produto"  , $_id_produto);
			$result->bindValue(":nome_produto", $_nome_produto);
			$result->bindValue(":dt_entrada"  , $_dataEntrada);
			$result->bindValue(":dep_origem"   , $_origem);
			$result->bindValue(":obs"         , $_obs);
			$result->bindValue(":qtd"         , $_qtd);
			$result->bindValue(":dep_destino" , $_nome_deposito);
			$result->bindValue(":validade"    , $_validade);
			$result->bindValue(":nota_fiscal" , $_nota);

			$result->execute();
			return true;
		}catch (Exception $e){
			print FuncaoBase::getError($e->getMessage());
		}
	}

	static function CadProd($_nome,
							$_descricao) {
								
		$con = Conexao::getInstance();
				$sql = "insert into aju_unidade (nome,
												descricao)
												VALUES (:nome,
														:descricao)";
		try {
			$result = $con->prepare($sql);

			$result->bindValue(":nome"  , $_nome);
			$result->bindValue(":descricao", $_descricao);
			

			$result->execute();
			$ultimo_id = $con->lastInsertId();
			return $ultimo_id;
		}catch (Exception $e){
			print FuncaoBase::getError($e->getMessage());
		}
	}


	static function CadFonte($_nome) {
								
		$con = Conexao::getInstance();
				$sql = "insert into aju_fonte (nome)
												VALUES (:nome)";
		try {
			$result = $con->prepare($sql);

			$result->bindValue(":nome"  , $_nome);

			$result->execute();
			return true;
		}catch (Exception $e){
			print FuncaoBase::getError($e->getMessage());
		}
	}

	/**
        *  @return nome e id material 
        */
        static function getFonteIdNome() {

            $con = Conexao::getInstance();

            $sql = "select id, nome from aju_fonte";

            $dados = array();

            try {

                $result = $con->query($sql);
                $result->execute();

                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados[] = $linha;
                }
                return $dados; 
                
            }catch (Exception $e){
                print FuncaoBase::getError($e->getMessage());
            }
        }
	
	
		/**
        *  @return nome Evento
        */
        static function getNomeEvento($id_evento) {

            $con = Conexao::getInstance();

            $sql = "select nome from aju_evento where id_evento = ".$id_evento;

            try {

				$dados = "";

                $result = $con->query($sql);

                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados = $linha['nome'];
                }
                return $dados; 
                
            }catch (Exception $e){
                print FuncaoBase::getError($e->getMessage());
            }
        }


	public function Alterar() {

		return;
	}

	/**
	 *  Verifica saldo material
	 * 
	 */
	static function VerificaSaldo($_id_produto, $_id_deposito){

		try{

			$dados = "";
			$sql = "SELECT e.id_produto
					FROM aju_estoque e 
					WHERE e.id_produto = {$_id_produto} 
					and id_deposito = {$_id_deposito}";
			
			$con = Conexao::getInstance();

			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados = $linha['id_produto'];
			}

			return $dados;
			
		}catch (Exception $e) {
			print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
		}
	}

	# @ verifica se tem produto na tabela estoque, se true, atualiza o saldo sen�o cria um saldo com valor 0 para o produto 
	static function atualizarSaldo($_id_produto, $_id_deposito, $_quantidade){ 
		$saldo = self::VerificaSaldo($_id_produto, $_id_deposito);
		
		# @ verifica se existe o item no saldo geral em algum deposito
		if($saldo == 0){
			# @ se não existir insere-o no saldo do estoque
			$sql1 = "INSERT INTO aju_estoque (id_produto,
											 id_deposito,
											 saldo) 
											VALUES ({$_id_produto},
											{$_id_deposito},
											{$_quantidade})";
		}
		else{
			# @ se existir atualiza a quantidade de produto no estoque
			$sql1 = "UPDATE aju_estoque
			 SET saldo = saldo+{$_quantidade}
			 WHERE id_produto= '{$_id_produto}'
			 and id_deposito = {$_id_deposito}";
		}
			
		try {
			$con = Conexao::getInstance();
			$result = $con->query($sql1);
			return true;
		}catch (Exception $e){
			print FuncaoBase::getError($e->getMessage());
		}	
	}
	
	function getUltimoid_produto(){ # pega o ultimo produto cadastrado na base
		
		$dados = "";
		$sql = "SELECT p.id_produto
						 FROM aju_produto p
						 ORDER BY id_produto
						 DESC LIMIT 1";
			
			$con = Conexao::getInstance();

		try{

			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados = $linha['id_produto'];
			}

			return $dados;
			
		}catch (Exception $e) {
			print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
		}
	}
	
	function getUltimoIdDep(){
		
		# pega o ultimo produto cadastrado na base
	
		$sql = "SELECT p.depDestino
				 FROM aju_produto p
				 ORDER BY id_produto
				 DESC LIMIT 1";
		
	
		$con = Conexao::getInstance();

		try{

			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados = $linha['depDestino'];
			}

			return $dados;
			
		}catch (Exception $e) {
			print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
		}
	}


	#@ retorna o nome no Material com Base no Identificador
	static function PegaNomeId($_id_material) {

		$sql = "select nome from aju_produto where id_produto = ".$_id_material;

		$con = Conexao::getInstance();

		$dados = "";

		try{

			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados = $linha['nome'];
			}
			return $dados;
			
		}catch (Exception $e) {
			print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
		}
	}
	#@ retorna o nome no Material com Base no Identificador
	static function ListFonte($liberacao = true) {
            
                $dados = array();

		try{    if($liberacao){
                            $estoque = "";
                        }else {
                            $estoque = " where nome <> 'ESTOQUE'";
                        }

			$sql = "SELECT nome from aju_fonte".$estoque;
			
			$con = Conexao::getInstance();

			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                            $dados[] = $linha;
			}
			
                        return $dados;
		}catch (Exception $e) {
			print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
		}
	}


	/**
	 *  Fonte de Material select html
	 * 
	 */
	static function Fonte($liberacao = true){

		try{    if($liberacao){
                            $estoque = "";
                        }else {
                            $estoque = " where nome <> 'ESTOQUE'";
                        }
                

			$sql = "SELECT * from aju_fonte".$estoque;
			
			$con = Conexao::getInstance();

			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				print "<option>".$linha['nome']."</option>";
			}
			
		}catch (Exception $e) {
			print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
		}
	}
	/**
	 *  Evento lista select html
	 * 
	 */
	static function Evento(){

		try{

			$sql = "SELECT * from aju_evento";
			
			$con = Conexao::getInstance();

			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				print "<option value='".$linha['id_evento']."'>".$linha['nome']."</option>";
			}
			
		}catch (Exception $e) {
			print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
		}
	}

	/**
	 *  array evento
	 * 
	 */
	static function EventoList(){

		try{

			$dados = array();

			$sql = "SELECT id_evento, nome from aju_evento";
			
			$con = Conexao::getInstance();

			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
				$dados[] = $linha;
			}

			return $dados;
			
		}catch (Exception $e) {
			print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
		}
	}

	/**
	 *  Fonte de Material
	 * 
	 */
	static function CadEvento($_nome){

			$con = Conexao::getInstance();
				$sql = "insert into aju_evento (nome)
												VALUES (:nome)";
		try {
			$result = $con->prepare($sql);

			$result->bindValue(":nome"  , $_nome);

			$result->execute();
			return true;
		}catch (Exception $e){
			print FuncaoBase::getError($e->getMessage());
		}
	}
	
	/**
	 * Lista de Eventos que tem liberacao
	 */
	public static function materiaisLiberadosEvento(){

		$con = Conexao::getInstance();

		$dados = array();

		$sql = "SELECT COUNT(quantidade) as qtd, evento FROM aju_item
				WHERE situacao <= '1' and evento IS NOT NULL 
				GROUP BY evento
				ORDER By evento";

		$result = $con->query($sql);

		while($linha = $result->fetch(PDO::FETCH_ASSOC)){
			$dados[] = $linha;
		}

		return $dados;



	}
	/**
	 * Lista Materiais entrada de material
	 */
	public static function listaEntradaMaterial($qtd = 0){

		$con = Conexao::getInstance();

		$dados = array();
                
                $filtro = ($qtd > 0) ? ' limit '.$qtd : "";

		$sql = "SELECT aju_produto.id_produto,
						aju_produto.codProd,
						aju_produto.nome,
						aju_produto.dtEntradaSaida,
						aju_produto.origem,
						aju_produto.obs,
						aju_produto.quantidade,
						aju_produto.depDestino,
						aju_produto.validade,
						aju_produto.nota_fiscal,
                                                aju_unidade.descricao
					FROM gestaocedec.aju_produto
                                        inner join aju_unidade
                                        on aju_produto.codProd = aju_unidade.id_unidade
                                        order by dtEntradaSaida desc ".$filtro;

		$result = $con->query($sql);

		while($linha = $result->fetch(PDO::FETCH_ASSOC)){
			$dados[] = $linha;
		}

		return $dados;



	}


	
	
}?>