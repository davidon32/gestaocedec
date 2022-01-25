<?php
/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
* 																					*
* 	Classe manipular produtos do estoque										*
* 																					*
* 	Autor: Demetrio da Silva Passos													*
* 																					*
* 	Criacao : 01/02/2012															*
************************************************************************************/

class Produto {
		
		//private $idProd;
		private $nomeProd;
			
		static function pegaProduto($attr = null) {
			
			$con = Conexao::getInstance();
		
		/* faz um select na base e monta um <select> html com a tabela produto */
		
			//$sql = ('SELECT DISTINCT p.id_produto, p.nome, p.dtEntradaSaida, p.origem, p.obs, p.quantidade FROM produto p');
			$sql = "SELECT u.id_Unidade, u.nome, u.descricao FROM aju_unidade u ORDER BY u.nome";
			
			
			$result = $con->query($sql);
						
			echo "<select class=\"form-control\" name=\"id_produto\" id=\"id_produto\" ".$attr.">";
				
			echo "<option value=''>Escolha o Material</option>";
			
			while($row = $result->fetch(PDO::FETCH_BOTH))

				{
					echo "<option value='".$row[0]."'>".$row[1]." ".$row[2]." - ".$row[0]."</option>";
				}
				echo "</select>";

		}
                
                static function pegaProdutoEntradaMat() {
			
			$con = Conexao::getInstance();
		
			$sql = "SELECT aju_unidade.id_unidade, aju_unidade.nome, aju_unidade.descricao
                                FROM aju_unidade 
                                WHERE aju_unidade.complnota = 1
                                or aju_unidade.id_unidade NOT IN (SELECT codProd FROM aju_produto)
                                ORDER BY aju_unidade.nome";
			
			$result = $con->query($sql);
                        
                        echo "<select class=\"form-control\" name=\"id_produto\" id=\"id_produto\" >";
				
			echo "<option value=''>Escolha o Material</option>";
						
			while($row = $result->fetch(PDO::FETCH_BOTH)){
                            
				echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]." ".$row[2]."</option>";
                            }
				echo "</select>";		
                        

		}

		
				
		# obtem-se o id do produto baseado no nome 
		static function PegaIdProduto($a){

			$con = Conexao::getInstance();
			
			$sql = "SELECT u.id_Unidade, u.nome FROM aju_unidade u WHERE u.nome = '{$a}'";
			
			$result = $con->query($sql);

			while($row = $result->fetch(PDO::FETCH_BOTH)){
				$dados = $row[0];
			}
			
			return $dados;
		}
		
		#@ resgata o nome do produto baseado no id
		static function PegaNomeProduto($idProd){

			$con = Conexao::getInstance();

			
			$sql ='SELECT u.nome FROM aju_unidade u WHERE u.id_Unidade = '.$idProd.'';
			
			$result = $con->query($sql);
			
			while($row = $result->fetch(PDO::FETCH_BOTH)){
				$dados = $row[0];
			}

			return $dados;
		}

	}

?>