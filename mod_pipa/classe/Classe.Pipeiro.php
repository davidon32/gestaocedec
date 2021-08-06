<?php

	/******************************************************************
	 *		Coordenadoria Estadual de Defesa Civil de Minas Gerais
	 *      Classe Manipulacao de Cadastro de Pipeiro
	 *
	 * 		Date: 23.07.2012
	 * 		Autor : Demetrio Silva Passos 
	 */
	
	
	class Pipeiro extends Log {
		
		private static $dados_busca;
		
	
		#@ cadastro de pipeiro
		function CadastroPipeiro($_nome, $_endereco, $_bairro, $_cidade, $_email, $_cep, $_uf, $_tel, $_cel, $_cpf_cnpj, $_rg, $_orgao, $_inscr_est, $_pis_pasep, $_cnh, $_inss, $_inscr_mun, $_nit, $_banco, $_agencia, $_conta, $_tipo, $_cpf_cnpj_banco, $_mbanco, $_pessoa,
								 $_nome_rep, $_cpf_rep, $_rg_rep, $_orgao_rep, $_est_civil_rep, $_natural_rep) {
			
			$sql = "INSERT INTO pip_pipeiro (nome, endereco, bairro, cidade, email, cep, uf, tel, cel, cpf_cnpj, rg, orgao, inscr_est, pis_pasep, cnh, inss, inscr_mun, nit, banco, agencia, conta, tipo, cpf_cnpj_banco, mbanco, pessoa, nome_rep, cpf_rep, rg_rep, orgao_rep, est_civil_rep, natural_rep) VALUES (
					'".$_nome."',
					'".$_endereco."',
					'".$_bairro."',
					'".$_cidade."',
					'".$_email."',
					'".$_cep."',
					'".$_uf."',
					'".$_tel."',
					'".$_cel."',
					'".$_cpf_cnpj."',
					'".$_rg."',
					'".$_orgao."',
					'".$_inscr_est."',
					'".$_pis_pasep."',
					'".$_cnh."',
					'".$_inss."',
					'".$_inscr_mun."',
					'".$_nit."',
					'".$_banco."',
					'".$_agencia."',
					'".$_conta."',
					'".$_tipo."',
					'".$_cpf_cnpj_banco."',
					'".$_mbanco."',
					'".$_pessoa."',
					'".$_nome_rep."',
					'".$_cpf_rep."',
					'".$_rg_rep."',
					'".$_orgao_rep."',
					'".$_est_civil_rep."',
					'".$_natural_rep."')";
						
			FuncaoBase::vd($sql);
			
			$result = mysql_query($sql) or die (mysql_error()."erro");
			
			#@ grava Log
			LogPipa::GravaLog($sql);
	
			return true;
			
		}
		
		
		#@ Altera��o de cadastro de pipeiro
		function AlteraCadastroPipeiro($_nome, $_endereco, $_bairro, $_cidade, $_email, $_cep, $_uf, $_tel, $_cel, $_cpf_cnpj, $_rg, $_orgao, $_inscr_est, $_pis_pasep, $_cnh,
				 $_inss, $_inscr_mun, $_nit, $_mot, $_nome_mot, $_nac_mot, $_est_mot, $_prof_mot, $_rg_mot, $_cpf_mot, $_placa, $_modelo,
				 $_marca, $_fabric, $_chassi, $_renavam, $_capacidade, $_rota, $_municipio_rota, $_banco, $_agencia, $_conta, $_tipo, $_cpf_cnpj_banco, $_id_pipeiro, $_cnhp,  $_mbanco, $_pessoa, $_orgao_mot, $_n_contrato) {
	
			$sql = "UPDATE pipeiro SET  nome	=	'".$_nome."',
										endereco=	'".$_endereco."',
										bairro	=	'".$_bairro."',
										cidade	=	'".$_cidade."',
										email	=	'".$_email."',
										cep		=	'".$_cep."',
										uf		=	'".$_uf."',
			  							tel		=	'".$_tel."',
			  							cel		=	'".$_cel."',
			  							cpf_cnpj=	'".$_cpf_cnpj."',
			  							rg		=	'".$_rg."',
			  							orgao	=	'".$_orgao."',
			  							inscr_est=	'".$_inscr_est."',
			  							pis_pasep=	'".$_pis_pasep."',
			  							cnh		=	'".$_cnh."',
										inss	=	'".$_inss."',
										inscr_mun=	'".$_inscr_mun."',
										nit		=	'".$_nit."',
										mot		= '$_mot',
										nome_mot = '".$_nome_mot."',
										nac_mot = '".$_nac_mot."',
										est_mot = '".$_est_mot."',
										prof_mot = '".$_prof_mot."',
										rg_mot = '".$_rg_mot."',
										cpf_mot = '".$_cpf_mot."',
										placa = '".$_placa."',
										modelo	=	'".$_modelo."',
			  							marca	=	'".$_marca."',
			  							fabric	=   '".$_fabric."',
			  							chassi = '".$_chassi."',
			  							renavam	=	'".$_renavam."',
			  							capacidade = '".$_capacidade."',
			  							rota	= '".$_rota."',
			  							municipio_rota = '".$_municipio_rota."',
			  							banco	=	'".$_banco."',
			  							agencia	=	'".$_agencia."',
			  							conta	=	'".$_conta."',
			  							tipo	=	'".$_tipo."',
			  							cpf_cnpj_banco ='".$_cpf_cnpj_banco."',
										cnh_p		= '".$_cnhp."',
										mbanco		= '".$_mbanco."',
										pessoa		= '".$_pessoa."',
										orgao_mot	= '".$_orgao_mot."',
										n_contrato  = '$_n_contrato' WHERE id_pipeiro=".$_id_pipeiro."";

						
			//print $sql;
			
			$result = mysql_query($sql) or die (mysql_error()."erro");
			
			#@ grava Log
			LogPipa::GravaLog($sql);
			
			return true;
				
		}
		
		#@ busca pipeiro com base no cpf, retorna um array de resultados
		function BuscaPipeiro($_id = false, $_cpf = false){
				
			if($_id == false && $_cpf != false){
				
				$filtro = 'WHERE cpf_cnpj = "'.$_cpf.'" ';
				
			}elseif($_id != false && $_cpf == false){
					
				$filtro = 'WHERE id_pipeiro = '.$_id;
				
			}
			
			$sql = "SELECT * FROM pip_pipeiro ".$filtro;
						
			FuncaoBase::vd($sql);
			
	
			$result = mysql_query($sql) or die (mysql_error()."1");
	
				if(!$_linha = mysql_num_rows($result)){
						
					print '	<script>
								alert("Pesquisa sem Resultados");
								history.back();
							</script>';
					
				}
				
				
				while ($linha = mysql_fetch_array($result))  {
					
					self::$dados_busca[] = $linha;
			
				}
				
			return self::$dados_busca;
	
		}
		
		
		#@ busca pipeiro com base no cpf, retorna um array de resultados, para alterar os dados
		function BuscaPipeiroAltera($_cpf){
				
			$sql = "SELECT * FROM pipeiro WHERE cpf_cnpj = '".$_cpf."'";
				
			//FuncaoBase::vd($sql);

			
			$result = mysql_query($sql) or die (mysql_error()."1");
		
			if(!$_linha = mysql_num_rows($result)){
		
				print '	<script>
				alert("Pesquisa sem Resultados");
				history.back();
				</script>';
					
			}
		
		
			while ($linha = mysql_fetch_array($result))  {
					
				self::$dados_busca[] = $linha;
					
			}
		
			return self::$dados_busca;
		
		}
		
		#@ busca pipeiro com base no n contrato, retorna um array de resultados, para alterar os dados
		function BuscaPipeiroAlteraNumeroContrato($_n_contrato){
		
			$sql = "SELECT * FROM pipeiro WHERE n_contrato = '".$_n_contrato."'";
		
			//FuncaoBase::vd($sql);
			
			$result = mysql_query($sql) or die (mysql_error()."1");
		
			if(!$_linha = mysql_num_rows($result)){
		
				print '	<script>
				alert("Pesquisa sem Resultados");
				history.back();
				</script>';
					
			}
		
		
			while ($linha = mysql_fetch_array($result))  {
					
				self::$dados_busca[] = $linha;
					
			}
		
			return self::$dados_busca;
		
		}
		
		
		#@ gera um select com todos os nomes do pipeiro
		function nomePipeiro(){
			
			$sql = "SELECT nome FROM pip_pipeiro ORDER BY nome";
			
		
			$result = mysql_query($sql) or die (mysql_error());
			
			print '<select name="pipeiro">
					<option></option>';
			while ($linha = mysql_fetch_assoc($result)) {				
				print '<option>'.$linha['nome'].'</option>';
			}
			print '</select>';
			
			
		}
		
		#@ busca o id do pipeiro com base no nome
		function pegaIdPipeiro($_nome){
			
			$sql = 'SELECT id_pipeiro FROM pip_pipeiro
					WHERE nome = "'.$_nome.'"';
					
			print $sql;
			
			$result = mysql_query($sql) or die (mysql_error());
			
			$linha = mysql_fetch_assoc($result);
			
			return $linha['id_pipeiro'];
			
		}
		
		

		
		
	
	
	

	
}?>