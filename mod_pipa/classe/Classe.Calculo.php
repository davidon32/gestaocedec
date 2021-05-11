<?php

	include_once PATH.'/core/classe/Classe.Log.php';

	class Calculo extends Log {
	    
        //private static $_teto;
		
		#@ dados busca conta
		private static $d_b_conta;
		
		#@ dados correcao conta
		private static $d_correcao;
		
		/*# 2012
		private static $faixa1 = array(1, 0,       1637.11,     0,      0);
		private static $faixa2 = array(2, 1637.12, 2453.50, 0.075, 122.78);
		private static $faixa3 = array(3, 2453.51, 3271.38,  0.15, 306.80);
		private static $faixa4 = array(4, 3271.39, 4087.65, 0.225, 552.15);
		private static $faixa5 = array(5, 4087.66, 9999999, 0.275, 756.53);*/
	
		/*
		 * #@ Calculo IR 2012
		 * 2012 - aliquota de 40% - lei 7713 artigo 9, inciso I (revogado em 2013)
		 * Para calculo de Ir deve-se descontar o inss
		 * Lei 7713, artigo 12-A, par. 3, inciso 2
		 */
 
		/*# 2013
		private static $faixa1 = array(1, 0,       1710.78,     0,      0);
		private static $faixa2 = array(2, 1710.79, 2563.91, 0.075, 128.31);
		private static $faixa3 = array(3, 2563.92, 3418.59, 0.15 , 320.60);
		private static $faixa4 = array(4, 3418.60, 4271.59, 0.225, 577.00);
		private static $faixa5 = array(5, 4271.60, 9999999, 0.275, 790.58);
        */
        
         
         /* 2013 - aliquota de 10% - lei 7713 artigo 9, inciso I
         */
        /* Para calculo de Ir deve-se descontar o inss
         * Lei 7713, artigo 12-A, par. 3, inciso 2
         */
         
        # 2014
        /*private static $faixa1 = array(1, 0,       1787.77,     0,      0);
        private static $faixa2 = array(2, 1787.78, 2679.29, 0.075, 134.08);
        private static $faixa3 = array(3, 2679.30, 3572.43, 0.15 , 335.03);
        private static $faixa4 = array(4, 3572.44, 4463.81, 0.225, 602.96);
        private static $faixa5 = array(5, 4463.82, 9999999, 0.275, 826.15);*/
        
        # 2015
        private static $faixa1 = array(1, 0,       1903.98,     0,      0);
        private static $faixa2 = array(2, 1903.99, 2826.65, 0.075, 142.80);
        private static $faixa3 = array(3, 2826.66, 3751.05, 0.15 , 354.80);
        private static $faixa4 = array(4, 3751.06, 4664.68, 0.225, 636.13);
        private static $faixa5 = array(5, 4664.69, 9999999, 0.275, 869.36);
						
		/**
         * Calculo do IRRF
         * @param $_valor - valor para o calculo
         * @param $_inss - valor do inss para abatimento
         * @return valor Imposto
         * @return faixa de IR
         * @return valor de base de calculo
         */

		function irrf($_valor, $_inss = 0){
			
			$base = ($_valor * 0.1) - $_inss;
					
			if($base <= self::$faixa1[2]){
				
				$irrf = 0;
				$fx = self::$faixa1;				
			}
			elseif ($base <= self::$faixa2[2]) {
				
				$irrf = ($base * self::$faixa2[3]) - self::$faixa2[4];
				$fx = self::$faixa2;
			}
			elseif($base <= self::$faixa3[2]) {
					
				$irrf = ($base * self::$faixa3[3]) - self::$faixa3[4];
				$fx = self::$faixa3;
				
			}
			elseif($base <= self::$faixa4[2]){
				
				$irrf = ($base * self::$faixa4[3]) - self::$faixa4[4];
				$fx = self::$faixa4;
			}
			elseif($base > self::$faixa5[1]){
				
				$irrf = ($base * self::$faixa5[3]) - self::$faixa5[4];
				$fx = self::$faixa5;
			}
			
			return array($irrf, $fx, $base);
		}
				
		/** calculo de inss ( parametros, base de calculo e valor que já tenha pago)
		*
		* OBS : o calculo da inss é feito conforme o programa GFIP - SEFIP versao 8.40
		* que despreza os numeros apartir da 3 casa decimal.
		* ex: 10,57958 informa 10,57 para o valor do imposto
         * @param $baseCalculo - valor de base de calculo
         * @return valorInss
		**/
		function inss($baseCalculo) {
			
			if($baseCalculo > 0){ 
			
				// valor limite para base de calculo de inss até 31/12/2012.
				//$_teto = 3916.2;
				
				// valor limite para base de calculo de inss apartir de 01/01/2013. valor máximo do imposto é R$ R$ 457,49
				//$_teto = 4159.00;
				
				// valor limite para base de calculo de inss apartir de 01/01/2014. valor máximo do imposto é R$ R$ 482,92
				//$_teto = 4390.24;
                
                // valor limite para base de calculo de inss apartir de 01/01/2015. valor máximo do imposto é R$ R$ 513,01
                $_teto = 4663.75;
				
				$base = $baseCalculo * 0.2;
				
				if($base > $_teto) {
					
					$base = $_teto;
				}
				
				$_imposto = round($base, 2) * 0.11;
						
				/* acerto desprezo de casa decimais */
				$posi = strpos($_imposto, '.');
				$despreza_decimal = substr($_imposto, $posi+1,2);
				$despreza_inteiro = substr($_imposto, 0, $posi);
				$imposto_despreza = $despreza_inteiro.'.'.$despreza_decimal;

				//var_dump($imposto_despreza);

					return array($imposto_despreza, round($base, 2));
			}
						
		}
		 
		
        /**
         * Calculo Imposto SEST/SENAT
         * @param $_valor - valor para calculo
         * @return array($_imposto, $base) - array com o valor do imposto e a base de calculo
         * 
         **/
		function sestSenat($_valor){
			
			if($_valor > 0) {
				#@ 20 % do valor recebido
				$base = $_valor * 0.2;
				
				#@ 2,5% da base de calculo
				$_imposto = $base * 0.025;
			
			}else {
				
				print '<script> alert("Valor errado !")</script>';
			}
				
			return array($_imposto, $base);
			
					
		}
        
        /**
         * calculo pagamento servico
         *   V = L x C x Km x N
         *   V = valor do pagamento
         *   L = capacidade de agua do caminhao
         *   C = valor da Carrada
         *   Km = distancia Percorrida
         *   N = numero de viagens          
         * @param $_capacidade - capacidade em M3
         * @param $_carrada - valor da carrada
         * @param $_distancia - Km percorrido
         * @param $_nViagem - numero de viagem
         * @return $_pagamento - valor bruto a receber
         */ 
        function pagamento($_capacidade, $_carrada, $_distancia, $_n_viagen){

            
        switch ($_carrada) {
            case 0:
                #@ estrada pavimentada
                $_vl_carrada = 0.43;
                break;
            case 1:
                #@ estrada mista (mais pavimentda que terra)
                $_vl_carrada = 0.45;
                break;
            case 2:
                #@ estrada mista (mais terra que pavimentada)
                $_vl_carrada = 0.47;
                break;
            case 3:
                #@ estrada nao pavimentada
                $_vl_carrada = 0.49;
                break;
            case 4:
                #@ caso necessita de trator/ reboque
                $_vl_carrada = 0.93;
                break;
            default:
                                
                break;
        }
        
            $_pagamento = $_capacidade * $_vl_carrada * $_distancia * $_n_viagen;
            
            return $_pagamento;     
            
        }
		
		/**
         * Lancamento de acerto de conta no BD
         * @param $_id_pipeiro - Identificador do Pipeiro
         * @param $_inss - Inss
         * @param $_data_pgto - Data de pagamento
         * @param $_mes - mes da conta
         * @param $_km - km percorrido
         * @param $_id_motorista - Identificador do Motorista
         * @param $_irrf - Irrf
         * @param $_sestsenat - sestsenat
         * @param $_gfip - gfip
         * @param $_placa - placa
         * @param $_situacao -situacao da conta 
         * @param $_liquido - valor liquido
         * @param $_valor - valor bruto
         * @param $lote - numero do lote
         * @param $obs - observação
         * @param $ano - ano da conta
         * @param $id_contrato - identificador do contrato
         * @param $capacidade - capacidade do caminhao
         * @param $momento - momento de transporte
         * @return boolean
         */ 
		function lancaImposto($_id_pipeiro,
								$_inss,
								$_data_pgto,
								$_mes,
								$_km,
								$_id_motorista,
								$_irrf,
								$_sestsenat,
								$_gfip,
								$_placa,
								$_situacao,
								$_liquido,
								$_valor,
								$lote,
								$obs,
								$ano,
								$id_contrato,
                                $capacidade,
                                $momento){
			
			$sql ='INSERT INTO pip_conta (id_pipeiro,
			                              inss,
			                              data,
			                              mes,
			                              km,
			                              id_motorista, 
			                              irrf,
			                              sestsenat,
			                              gfip,
			                              placa,
			                              situacao,
			                              liquido,
			                              valor,
			                              lote,
			                              obs,
			                              ano,
			                              id_contrato,
                                          capacidade,
                                          momento) VALUES (0,
			 									   '.$_inss.',
			 									  "'.$_data_pgto.'",
			 									  "'.$_mes.'",
			 									   '.$_km.',
			 									   '.$_id_motorista.',
			 									   "'.$_irrf.'",
			 									   '.$_sestsenat.',
			 									   '.$_gfip.',
			 									  "'.$_placa.'",
												   '.$_situacao.',
												   '.$_liquido.',
												   '.$_valor.',
												   '.$lote.',
												 "'.$obs.'",
												 '.$ano.',
												 '.$id_contrato.',
                                                 '.$capacidade.',
                                                 '.$momento.')';
												  
			//print $sql;
			
			mysql_query($sql) or die (mysql_error());
			
			#@ grava Log
			Log::GravaLog($sql, "pip_log");
			
			return true;
					
		}


         /**
         * Lancamento de acerto de conta no BD de PJ
         * @param $_data_pgto - Data de pagamento
         * @param $_mes - mes da conta
         * @param $_km - km percorrido
         * @param $_id_motorista - Identificador do Motorista
         * @param $_placa - placa
         * @param $_situacao -situacao da conta 
         * @param $_valor - valor bruto
         * @param $lote - numero do lote
         * @param $obs - observação
         * @param $ano - ano da conta
         * @param $id_contrato - identificador do contrato
         * @param $capacidade - capacidade do caminhao
         * @param $momento - momento de transporte
         * @return boolean
         */ 
        function lancaImpostoPj($valor,
                                $_data_pgto,
                                $_placa,
                                $_mes,
                                $ano,
                                $id_contrato,
                                $_km,
                                $_id_motorista,
                                $_situacao,
                                $lote,
                                $obs,
                                $capacidade,
                                $momento){
            
            $sql ='INSERT INTO pip_conta_pj (valor,
                                          data,
                                          placa,
                                          mes,
                                          ano,
                                          id_contrato,
                                          km,
                                          id_motorista,
                                          situacao,
                                          lote,
                                          obs,
                                          capacidade,
                                          momento) VALUES ("'.$valor.'",
                                                           "'.$_data_pgto.'",
                                                           "'.$_placa.'",
                                                           "'.$_mes.'",
                                                           '.$ano.',
                                                           '.$id_contrato.',
                                                           '.$_km.',
                                                           '.$_id_motorista.',
                                                           '.$_situacao.',
                                                           '.$lote.',
                                                           "'.$obs.'",
                                                           '.$capacidade.',
                                                           "'.$momento.'")';
                                                  
            //print $sql;
            
            mysql_query($sql) or die (mysql_error());
            
            #@ grava Log
            Log::GravaLog($sql, "pip_log");
            
            return true;
                    
        }
						
		#@ faz busca de lancamento e impostos para correcao						
		function buscaImposto(array $dados){
		    
            //var_dump($dados);
            
             $filtro = "";
             
             $sql = "";
            
            // pessoa juridica
            if($dados['pessoa'] == "PJ"){
                
                if($dados['mes'] != "Mes")  {
            
                    if($dados['placa'] != ""){
                        
                        $filtro = ' AND pip_conta_pj.placa = "'.$dados['placa'].'"';
                        
                    }elseif($dados['cpf'] != false){
                            
                        $filtro = ' AND pip_motorista.cpf_cnpj = "'.$_cpf_cnpj.'"';
                    }
                    
                    $sql = "SELECT pip_conta_pj.id_contrato,
                                   pip_conta_pj.id_conta,
                                   pip_conta_pj.data,
                                   pip_conta_pj.mes,
                                   pip_conta_pj.km,
                                   pip_conta_pj.id_motorista,
                                   pip_conta_pj.placa,
                                   pip_conta_pj.valor,
                                   pip_conta_pj.ano,
                                   pip_motorista.nome,
                                   pip_motorista.cpf_cnpj,
                                   pip_caminhao.capacidade,
                                   pip_rota.momento,
                                   pip_motorista.pessoa
                                   FROM pip_contrato
                                   INNER JOIN pip_conta_pj
                                   ON pip_contrato.id_contrato = pip_conta_pj.id_contrato
                                   INNER JOIN pip_motorista
                                   ON pip_conta_pj.id_motorista = pip_motorista.id_motorista
                                   INNER JOIN pip_caminhao
                                   ON pip_conta_pj.placa = pip_caminhao.placa
                                   INNER JOIN pip_rota
                                   ON pip_contrato.id_rota = pip_rota.id_rota
                                   WHERE pip_conta_pj.ano = '".$dados['ano']."'
                                   AND pip_conta_pj.mes =".FuncaoBase::mesTonum($dados['mes']).$filtro;
                
               }
            }else {
                
                if($dados['mes'] != "Mes")  {
            
                    if($dados['placa'] != ""){
                        
                        $filtro = ' and pip_conta.placa = "'.$dados['placa'].'"';
                        
                    }elseif($dados['cpf'] != false){
                            
                        $filtro = ' and pip_motorista.cpf_cnpj = "'.$_cpf_cnpj.'"';
                    }
                
                    $sql = "select pip_conta.id_contrato, pip_conta.id_conta, pip_conta.inss,
                            pip_conta.data, pip_conta.mes, pip_conta.km, pip_conta.id_motorista,
                            pip_conta.irrf, pip_conta.sestsenat, pip_conta.gfip, pip_conta.placa,
                            pip_conta.liquido, pip_conta.valor, pip_conta.ano, pip_motorista.nome,
                            pip_motorista.cpf_cnpj, pip_caminhao.capacidade, pip_rota.momento,
                            pip_motorista.pessoa
                            from pip_contrato
                            inner join pip_conta
                            on pip_contrato.id_contrato = pip_conta.id_contrato
                            inner join pip_motorista
                            on pip_conta.id_motorista = pip_motorista.id_motorista
                            inner join pip_caminhao
                            on pip_conta.placa = pip_caminhao.placa
                            inner join pip_rota 
                            on pip_contrato.id_rota = pip_rota.id_rota
                            where pip_conta.ano = '".$dados['ano']."' and pip_conta.mes =".FuncaoBase::mesTonum($dados['mes']).$filtro;

                
                }
         
            }
    			//print $sql;		
    
    			
    			$result = mysql_query($sql) or die (mysql_error());
    			
    			while ($linha = mysql_fetch_array($result)){
    				
    					self::$d_b_conta[] = $linha; 
    			}
    			
    			return 	self::$d_b_conta;
    				
			

		}
		
		#@ faz busca de lancamento e impostos para correcao						
		function CorrecaoImposto($_id_conta,
								$_id_pipeiro,
								$_inss,
								$_data,
								$_mes,
								$_km,
								$id_motorista,
								$irrf,
								$sestsenat,
								$gfip,
								$placa,
								$situacao,
								$liquido,
								$valor,
								$ano,
								$id_contrato,
								$capacidade,
								$momento){
			
			$sql = 'UPDATE pip_conta SET id_pipeiro='.$_id_pipeiro.',
			                             inss='.$_inss.',
			                             data="'.$_data.'",
			                             mes="'.$_mes.'",
					                     km='.$_km.',
					                     id_motorista='.$id_motorista.',
					                     irrf='.$irrf.',
					                     sestsenat='.$sestsenat.',
					                     gfip='.$gfip.',
					                     placa="'.$placa.'",
					                     situacao="'.$situacao.'",
					                     liquido='.$liquido.',
					                     valor="'.$valor.'",
					                     ano ="'.$ano.'",
					                     id_contrato = "'.$id_contrato.'",
					                     capacidade = "'.$capacidade.'",
					                     momento = "'.$momento.'" 
					                     WHERE id_conta="'.$_id_conta.'"';

            print $sql;

			$result = mysql_query($sql) or die (mysql_error());
			
            #@ grava Log
            Log::GravaLog($sql, "pip_log");
            
			return true;
	
		}

        /**
         * Busca de lancamento para correcao
         * @param id_conta
         * @param data
         * @param mes
         * @param km
         * @param id_motorista
         * @param placa
         * @param valor
         * @param capacidade
         * @param momento
         *  
         */                      
        function CorrecaoContaPj($_id_conta,
                                $_data,
                                $_mes,
                                $_km,
                                $id_motorista,
                                $placa,
                                $valor,
                                $capacidade,
                                $momento){
            
            $sql = 'UPDATE pip_conta_pj SET data="'.$_data.'",
                                         mes="'.$_mes.'",
                                         km='.$_km.',
                                         id_motorista='.$id_motorista.',
                                         placa="'.$placa.'",
                                         valor="'.$valor.'",
                                         capacidade = '.$capacidade.',
                                         momento = '.$momento.' 
                                         WHERE id_conta="'.$_id_conta.'"';

            //print $sql;

            $result = mysql_query($sql) or die (mysql_error());
            
            #@ grava Log
            Log::GravaLog($sql, "pip_log");
            
            return true;
    
        }
						
		/**
         * Calculo da gefip (patronal)
         * É retirado 20% do valor a receber como Base de Calculo e posteriormente retirado 20%, no qual é o valor da GFIP
         * @param $_baseCalculo, Double - Valor a receber
         * @return array(baseCalculo, valorGefip)
         */  
		
		function gfip($valor) {
			
			$_baseGfip = $valor * 0.2;
			
			$gfip = $_baseGfip * 0.2;
			
			return array($_baseGfip, $gfip);
		
			
		}
			
		#@ geracao de RPA
		function rpa($_id_motorista = false, $placa = 'false', $mes = false, $num_rpa = false){
			    
			$dados = array();
            
			$sql ='SELECT co.id_conta,
			              co.id_pipeiro,
			              co.inss,
			              co.data,
			              co.mes,
			              co.km,
			              co.id_motorista, 
			              co.irrf,
			              co.sestsenat,
					      co.gfip,
					      co.placa,
					      co.valor,
					      m.nome as "motorista",
					      m.cpf_cnpj,
					      m.rg, m.orgao,
					      co.situacao,
					      m.id_motorista,
					      m.pis_pasep
					           FROM pip_conta co
            			         INNER JOIN pip_caminhao c
            					 ON co.placa = c.placa
            					 INNER JOIN pip_motorista m
            					 ON m.placa = c.placa
            					 WHERE m.id_motorista = "'.$_id_motorista.'"
            					 AND c.placa = "'.$placa.'"
            					 AND co.situacao = 0
            					 AND co.mes = '.$mes.'';
			
			//FuncaoBase::vd($sql);
			
			$result = mysql_query($sql) or die (mysql_error());
			
			while ($linha = mysql_fetch_array($result)) {
				
				$dados = $linha;
				
			}
			
			return $dados;			
					
		}
		
		
		#@ geracao de RPA individual
		function rpaIndividual($num_rpa = false){
			
			$con = Conexao::getInstance();
			
			try{
			    
				$dados = array();
	            	
				$sql ='SELECT co.id_conta,
							  co.id_pipeiro,
							  co.inss,
							  co.data,
							  co.mes,
							  co.km,
							  co.id_motorista,
							  co.irrf,
							  co.sestsenat,
							  co.gfip,
							  co.placa,
							  co.valor,
							  m.nome as "motorista",
							  m.cpf_cnpj,
							  m.rg, m.orgao,
							  co.situacao,
							  m.id_motorista,
							  m.pis_pasep,
							  co.ano
							  FROM pip_conta co
							  INNER JOIN pip_motorista m
							  ON m.id_motorista = co.id_motorista
							  WHERE co.id_conta = :num_rpa';
					

					
				$result = $con->prepare($sql);
				$result->bindParam(":num_rpa", $num_rpa);
				$result->execute();
					
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			
					$dados[] = $linha;
			
				}
					
				return $dados;
			}catch (Exception $e){
				
				print $e->getMessage();
			}
				
		}
		
		
		/**
		 * Gera de Relatório de RPA Individual por cpf e Placa
		 * Tipo - 0 filtra por cpf, mes, ano,  1 filtra por mes, ano (em lote);
         * @param CPF
		 * @param Mes
		 * @param Tipo
         * @param Placa
		 */
		function relRpa($_cpf = false, $_mes = false, $_tipo, $_ano = false, $_placa = false){
			    
			$dados = array();
			
			$con = Conexao::getInstance();
			
			try {
            			
				if($_tipo == 0) {
					    
					if($_cpf !="") {
	    			
	                	$filtro = 'm.cpf_cnpj = "'.$_cpf.'" and co.mes = "'.$_mes.'" and co.ano = "'.$_ano.'"';
					
	                }else if($_placa != "") {
					        
					    $filtro = 'co.placa = "'.$_placa.'" and co.mes = "'.$_mes.'" and co.ano = "'.$_ano.'"';
	                    
					}
					
				}elseif ($_tipo == 1){
					
					$filtro = 'co.id_conta > 0 and co.mes = "'.$_mes.'" and co.ano = "'.$_ano.'" order by m.nome';
				}
				
				$sql ='select co.id_conta, co.id_pipeiro, co.inss, co.data,
				       co.mes, co.km, co.id_motorista, co.irrf, co.sestsenat,
				       co.gfip, co.placa, co.valor, m.nome as "motorista",
				       m.cpf_cnpj, m.rg, m.orgao, co.situacao, m.id_motorista,
				       m.pis_pasep, co.ano
				from pip_conta co
				inner join pip_motorista m
				on m.id_motorista = co.id_motorista
				where '.$filtro;
	
	
				$result = $con->query($sql);
					
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			
					$dados[] = $linha;
			
				}
					
				return $dados;
				
			}catch (Exception $e){
				
				
			}
				
		}
		
		
		function extenso($valor=0, $maiusculas=false)
		{
			// verifica se tem virgula decimal
			if (strpos($valor,",") > 0)
			{
				// retira o ponto de milhar, se tiver
				$valor = str_replace(".","",$valor);
		
				// troca a virgula decimal por ponto decimal
				$valor = str_replace(",",".",$valor);
			}
			$singular = array("centavo", "real", "mil", "milhÃ£o", "bilhÃ£o", "trilhÃ£o", "quatrilhÃ£o");
			$plural = array("centavos", "reais", "mil", "milhÃµes", "bilhÃµes", "trilhÃµes",
					"quatrilhÃµes");
		
			$c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
					"quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
			$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
					"sessenta", "setenta", "oitenta", "noventa");
			$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
					"dezesseis", "dezesete", "dezoito", "dezenove");
			$u = array("", "um", "dois", "trÃªs", "quatro", "cinco", "seis",
					"sete", "oito", "nove");
		
			$z=0;
		
			$valor = number_format($valor, 2, ".", ".");
			$inteiro = explode(".", $valor);
			$cont=count($inteiro);
			for($i=0;$i<$cont;$i++)
				for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
				$inteiro[$i] = "0".$inteiro[$i];
		
				$fim = $cont - ($inteiro[$cont-1] > 0 ? 1 : 2);
				for ($i=0;$i<$cont;$i++) {
				$valor = $inteiro[$i];
				$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
				$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
				$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
		
				$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
						$ru) ? " e " : "").$ru;
						$t = $cont-1-$i;
						$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
						if ($valor == "000")$z++; elseif ($z > 0) $z--;
						if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
						if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) &&
						($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
				}
		
						if(!$maiusculas)
						{
						return($rt ? $rt : "zero");
				} elseif($maiusculas == "2") {
				return (strtoupper($rt) ? strtoupper($rt) : "Zero");
				} else {
				return (ucwords($rt) ? ucwords($rt) : "Zero");
				}
		
		}
		
		#@ acerto Contas MEs
		function AcertoPipeiro($cpf = false, $placa = false) {

		    if(($placa == false) && (strlen($cpf) == 14)) {
		        
		        
		        $filtro = "where m.cpf_cnpj = '".$cpf."'
		        and c.situacao = 'A' and m.pessoa = 'PF'";
		        
		        
		       
		    }elseif($cpf == false) {
		        
		        $filtro = "where ca.placa = '".$placa."'
		        and c.situacao = 'A'";
		        
		        
		    }
		    
		    $sql = "select c.num_contrato, 
		                   m.nome,
		                   ca.placa, 
		                   ca.capacidade, 
		                   r.momento, 
		                   r.num_rota, 
		                   ca.id_caminhao, 
		                   m.id_motorista, 
		                   m.pessoa,
		                   m.cpf_cnpj,
		                   r.nome as municipio
		    from pip_contrato c
		    inner join pip_motorista m
		    on c.id_motorista = m.id_motorista
		    inner join pip_caminhao ca
		    on c.id_caminhao = ca.id_caminhao
		    inner join pip_rota r
		    on c.id_rota = r.id_rota ".$filtro;
		    
		   	//print $sql;

		   	 $result = mysql_query($sql) or die (mysql_error());
		   	 
		   	 $linha = mysql_fetch_array($result);
             
                         
                return $linha;
                
        }
		    		
		#@ busca acerto realizado no mes
		function buscaAcerto($_mes, $placa, $id_motorista, $_ano, $_pessoa){
			
			$dados = array();
			
			$sql = "";
			
			if($_pessoa == 'PF') {
			
    			$sql = 'select  pip_conta.placa, pip_conta.mes, pip_conta.valor,
    			         pip_motorista.nome, pip_motorista.cpf_cnpj,
    			         pip_conta.km
    					from pip_conta
    		            inner join pip_motorista
    		            on pip_conta.id_motorista = pip_motorista.id_motorista
    					where pip_conta.mes = '.$_mes.' and pip_conta.placa = "'.$placa.'" and pip_conta.ano = "'.$_ano.'"';
    		
    		}elseif ($_pessoa == 'PJ') {
    		          
    		      $sql = 'select pip_conta_pj.placa, pip_conta_pj.mes, pip_conta_pj.valor,
                         pip_motorista.nome, pip_motorista.cpf_cnpj
                        from pip_conta_pj
                        inner join pip_motorista
                        on pip_conta_pj.id_motorista = pip_motorista.id_motorista
                        where pip_conta_pj.mes = '.$_mes.' 
                        and pip_conta_pj.placa = "'.$placa.'" 
                        and pip_conta_pj.ano = "'.$_ano.'"';   
    		}
			
			//var_dump($sql);
			
			
			$result = mysql_query($sql) or die (mysql_error());
			
			while($linha = mysql_fetch_array($result)) {
				
				$dados[] = $linha;
				
			}
			
			return $dados;	
		}
		
		
		
		/**
         * Número do último lote ja criado no sistema
         * @return numero do ultimo lote
         **/ 
		static function getUltimoLote($pessoa){
		   
           $tabela = "";
            
           if($pessoa == "PJ") {
           
                $tabela = "pip_conta_pj";    
               
           } else {
               
               $tabela = "pip_conta";
   
           }
		       
		   $sql = 'SELECT MAX(lote)
		          FROM '.$tabela;
           
           $result = mysql_query($sql) or die (mysql_error());
            
            $linha = mysql_fetch_array($result); 

            return $linha[0];
		        
		    
		}
		

		/**
         * Contador de lote
         * @return Número de itens do ultimo lote
         *
         **/
		static function getQtdItem($pessoa) {
		    
            $tabela = "";
		    
            if($pessoa == "PJ") {
                
                $tabela = "pip_conta_pj";
                
            }else {
                
                $tabela = "pip_conta";
            }
				
			$sql = 'SELECT COUNT(lote)
			FROM '.$tabela.' WHERE lote = '.Calculo::getUltimoLote($pessoa);
			
			//print $sql;
				
			$result = mysql_query($sql) or die (mysql_error());
				
			$linha = mysql_fetch_array($result);
		
			return $linha[0];
				
				
		}
        
        /**
         * Contador de lote
         * @return Número de itens de Lote
         * @param $numLote
         *
         **/
        static function getQtdItemLote($numLote) {
                
            $sql = 'SELECT COUNT(lote)
            FROM pip_conta WHERE lote = '.$numLote;
            
            //print $sql;
                
            $result = mysql_query($sql) or die (mysql_error());
                
            $linha = mysql_fetch_array($result);
        
            return $linha[0];
                
                
        }
        
        /**
         * Buscar mes do ultimo lote
         * @param numeroLote
         * @return mes do ultimo lote
         * 
         */
         static function getMesUltimoLote($pessoa){
                
            $tabela = "";
            
            if($pessoa == "PJ") {
                
                $tabela = "pip_conta_pj";
            }else {
                
                $tabela = "pip_conta";
            }
             
            $sql = 'SELECT mes
                    FROM '.$tabela.' 
                    WHERE lote = '.Calculo::getUltimoLote($pessoa).'
                    LIMIT 1';
            $result = mysql_query($sql) or die (mysql_error());
            
            $linha = mysql_fetch_array($result);
            
            return $linha['mes'];
             
             
         }
         
         
        /*
         * Gera os lotes para impressão  
         * 
         **/
        function geraLote($mes, $ano, $pessoa = false){
                
            /* pega o ultimo lote */
            $ultimoLote = Calculo::getUltimoLote($pessoa);
            
              
            /* quantidade de itens do lote */
            $qtdItem = Calculo::getQtdItem($pessoa);
            
            $dados = array();
            
            /* */
            if($qtdItem < 10) {
                
                if(Calculo::getMesUltimoLote($pessoa) == $mes){
                 
                    $dados[] = $ultimoLote; /* lote para gravar no banco */
                    $dados[] = $qtdItem;  /*quantidade de itens (limitador de lote) */
                    
                    return $dados;
                    
                }else {
                    /* Mes diferente inicia um lote novo*/    
                    
                    $dados[] = $ultimoLote + 1; // lote para gravar no banco
                    $dados[] = 0; /* quantidade de itens (limitador de lote) */
                    
                    return $dados;
                }
                
            }else {
                /* Lote cheio inicia um lote novo */
                
                $dados[] = $ultimoLote +1; /* lote para gravar no banco */
                $dados[] = 0; /* quantidade de itens (limitador de lote) */
                
                return $dados;
            
            }
            
        }

		/**
         * Busca conta para recalculo de impostos
         * @param $num_rpa - numero do RPA
         * @return array dados conta 
         * 
         */
		function buscaConta($num_rpa){

			$sql = 'select con.id_conta, con.inss, con.data, con.mes, con.km, con.id_motorista,
					con.irrf, con.sestsenat, con.gfip, con.placa, con.liquido,	con.valor, con.ano, 
					m.nome, m.cpf_cnpj, c.capacidade, r.momento, con.lote
					from pip_contrato co
					inner join pip_conta con
					on co.id_contrato = con.id_contrato
					inner join pip_motorista m
					on co.id_motorista = m.id_motorista
					inner join pip_caminhao c
					on con.placa = c.placa
					inner join pip_rota r
					on co.id_rota = r.id_rota
					where con.id_conta = '.$num_rpa;

			$result = mysql_query($sql) or die (mysql_error());
			
			$linha = mysql_fetch_array($result);

			return $linha;

		}
        
        
        /**
         * Busca conta para recalculo de impostos
         * @param $id_conta
         * @return array dados conta 
         * 
         */
        function buscaContaPj($id_conta){

            $sql = 'SELECT pip_conta_pj.id_conta,
                           pip_conta_pj.data,
                           pip_conta_pj.mes,
                           pip_conta_pj.km,
                           pip_conta_pj.id_motorista,
                           pip_conta_pj.placa,
                           pip_conta_pj.valor,
                           pip_conta_pj.ano, 
                           pip_motorista.nome,
                           pip_motorista.cpf_cnpj,
                           pip_motorista.pessoa,
                           pip_caminhao.capacidade,
                           pip_rota.momento,
                           pip_conta_pj.lote
                           FROM pip_contrato
                           INNER JOIN pip_conta_pj
                           ON pip_contrato.id_contrato = pip_conta_pj.id_contrato
                           INNER JOIN pip_motorista
                           ON pip_contrato.id_motorista = pip_motorista.id_motorista
                           INNER JOIN pip_caminhao
                           ON pip_conta_pj.placa = pip_caminhao.placa
                           INNER JOIN pip_rota
                           ON pip_contrato.id_rota = pip_rota.id_rota
                           WHERE pip_conta_pj.id_conta = '.$id_conta;
                           
            //print $sql;
                           

            $result = mysql_query($sql) or die (mysql_error());
            
            $linha = mysql_fetch_array($result);

            return $linha;

        }


       /**
         * Busca conta para correção Manual de impostos
         * @param $mes - mes da conta
         * @param $placa - placa da conta 
         * @return array dados conta 
         * 
         */
        function buscaContaAlterar($mes, $placa){

            $sql = "SELECT pip_conta.inss,
                    pip_conta.km,
                    pip_conta.irrf,
                    pip_conta.sestsenat, 
                    pip_conta.gfip,
                    pip_conta.lote,
                    pip_conta.obs,
                    pip_motorista.nome, 
                    pip_caminhao.placa,
                    pip_conta.mes,
                    pip_conta.ano,
                    pip_motorista.cpf_cnpj, 
                    pip_conta.id_conta,
                    pip_conta.id_motorista
                    FROM pip_conta 
                    INNER JOIN pip_motorista 
                    ON pip_conta.id_motorista = pip_motorista.id_motorista 
                    INNER JOIN pip_contrato
                    ON pip_conta.id_contrato = pip_contrato.id_contrato
                    INNER JOIN pip_caminhao 
                    ON pip_contrato.id_caminhao = pip_caminhao.id_caminhao  
                    WHERE pip_conta.ano = \"".date('Y')."\"
                    AND pip_conta.mes = ".$mes."
                    AND pip_caminhao.placa = \"".$placa."\"";	
                    
            //print $sql;
                    
            $result = mysql_query($sql) or die (mysql_error());
            
            $linha = mysql_fetch_array($result);

            return $linha;
        
        }

    /**
     * Atualiza os valores da conta (acerto Gfip)
     * @param $inss
     * @param $sestSenat
     * @param $gfip
     * @param $lote
     * @param $obs
     * @return boolean
     * 
     */
    function AlterarConta($inss, $sestSenat, $gfip, $lote, $obs, $id_conta){
        
        $sql = 'UPDATE pip_conta
                SET inss = "'.$inss.'",
                    sestsenat = "'.$sestSenat.'",
                    gfip = "'.$gfip.'",
                    lote = "'.$lote.'",
                    obs = "'.$obs.'"
                WHERE id_conta = '.$id_conta;
        
        //print $sql;            
        $result = mysql_query($sql) or die (mysql_error());
        
        #@ grava Log
        Log::GravaLog($sql, "pip_log");
        
        return true;
    }

    /**
     * Separa a parte inteira dos centavos
     * @param $valor
     * @return array($real,$centavo)
     * 
     * 
     */
     function separaValor($valor) {
             
         $posPonto = strpos($valor, '.');    
         
         
         $dados['real']    = substr($valor, 0, $posPonto);
         $dados['centavo'] = substr($valor, $posPonto +1);
         
         return $dados;
         
     }
     
     
     /**
      * Resumo das contas de pessoa fisica
      * @param $ano string
      * 
      */
      function resumoContasPf($ano) {
          
          $dados = array();
          
          $sql = "SELECT mes,
                         ano,
                         sum(valor) as Valor,
                         sum(inss) as Inss,
                         sum(irrf) as Irrf ,
                         sum(sestsenat) as SestSenat,
                         sum(gfip) as Gfip,
                         sum(liquido) as Liquido
                         FROM pip_conta 
                         WHERE ano ='".$ano."'
                         GROUP BY mes";
                         
          $result = mysql_query($sql) or die(mysql_error());
          
          while ($linha = mysql_fetch_assoc($result)){
              
              $dados[] = $linha;
          }
          
          return $dados;
          
          
      }
      
      /**
      * Resumo das contas de pessoa fisica
      * @param $ano string
      * 
      */
      function resumoContasPj($ano) {
          
          $dados = array();
          
          $sql = "SELECT mes,
                         ano,
                         sum(valor) as Valor
                         FROM pip_conta_pj 
                         WHERE ano ='".$ano."'
                         GROUP BY mes";
                         
          $result = mysql_query($sql) or die(mysql_error());
          
          while ($linha = mysql_fetch_assoc($result)){
              
              $dados[] = $linha;
          }
          
          return $dados;
          
          
      }
      
     /**
      * Busca Conta para realizar acerto Automatico
      * 
      * 
      */
      function buscaContaAcertoAutomatico($_cpf, $_placa, $_km, $_mes, $_ano){
          
          $sql = "";
          
      } 
      
      
     
}?>