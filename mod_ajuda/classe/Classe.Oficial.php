<?php

	/**
	 * 
	 */
class Oficial{

		#@ Monta um selec na tabela oficial
		function Oficiais() {

			$con = Conexao::getInstance();

			try{
			
				$sql = 'SELECT nome FROM cedec_funcionario';
				
				$result = $con->query($sql);
				
					print '<select name="oficial">';
					print '<option></option>';
					
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					print '<option>'.utf8_encode($linha['nome']).'</option>';
				}
				print '</select>';
			}catch (Exception $e) {
				
				print $e->getMessage();
			}
			
		}
	
		#@ retorna o nome do oficial com base no id do funcionario
		static function PegaNomeOficial($_id_funcionario){

				$con = Conexao::getInstance();

				$dados = "";

				try{
			
					$sql = 'SELECT nome 
							FROM cedec_funcionario 
							WHERE id_funcionario ='.$_id_funcionario;

					$result = $con->query($sql);
					
					while ($linha = $result->fetch((PDO::FETCH_ASSOC))){
						$dados = $linha;
					}
					
					return utf8_encode($dados['nome']); 

				}catch (Exception $e) {

					print $e->getMessage();
				}
			
		}


		#@ retorna o id do oficial com base no nome
		function PegaIdOficial($_nome){

			$con = Conexao::getInstance();

			$dados = "";

			try {
			
				$sql = 'SELECT id_oficial
						FROM cedec_funcionario
						WHERE nome ='.$_nome;
					
				$result = $con->query($sql);

				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dados = $linha;
				}
					
				return utf8_encode($dados['id_oficial']); 
			}catch (Exception $e){
				print $e->getMessage();
			}
			
		}
		
		#@ retorna o Cargo do oficial com base no nome
		static function PegaCargoNomeOficial($_nome){

			$con = Conexao::getInstance();

			$dados = "";

			try{
			
				$sql = 'SELECT cargo FROM cedec_funcionario WHERE nome ="'.$_nome.'"';

				$result = $con->query($sql);

				while ($linha = $result->fetch(PDO::FETCH_ASSOC))	{
					$dados = $linha;
				}
				
				return utf8_encode($dados['cargo']); 
			}catch (Exception $e){
				print $e->getMessage();
			}
			
		}
		
		#@ retorna o Cargo do oficial com base no id
		static function PegaCargoIdOficial($_id_funcionario){

			$con = Conexao::getInstance();

			$dados = "";

			try{
			
				$sql = 'SELECT desc_funcao FROM cedec_funcionario WHERE id_funcionario ="'.$_id_funcionario.'"';
					
				$result = $con->query($sql);

				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dados = $linha;
				}
					
				return utf8_encode($dados['desc_funcao']); 

			}catch (Exception $e){
				print $e->getMessage();
			}
			
		}
	
}?>