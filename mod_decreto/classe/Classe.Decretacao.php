<?php


class Decretacao {

	private $d_proc;
    
    private $id;
	
	/**
	 *  Cadastro de Decreto 
	 * 
	 */
 
	function Cadastro($txt_ano,
                      $txt_dt_entrada,
                      $num_processo,
                      $id_municipio,
                      $txt_num_dec_mun,
                      $txt_dt_dec_mun,
                      $txt_dec_vigencia,
                      $sel_desastre,
                      $txt_dt_vencimento,
                      $rdb_status,
                      $txt_analista,
                      $txt_num_decreto,
                      $txt_dt_pub_decreto,
                      $txt_num_dt_portaria,
                      $txt_num_dou,
                      $ck_reconhecido){
	
        $sql = "INSERT INTO dec_processo (ano,
                                                         dt_entrada,
                                                         num_processo,
                                                         id_municipio,
                                                         num_dec_mun,
                                                         dt_dec_mun,
                                                         dec_vigencia,
                                                         desastre,
                                                         dt_vencimento,
                                                         status,
                                                         id_funcionario,
                                                         num_dec_homo,
                                                         dt_pub_dec_homo,
                                                         num_dt_port_dec_rec,
                                                         num_dt_dou,
                                                         stat_reconhecido)
                                                         VALUES('".$txt_ano."',
                                                                '".$txt_dt_entrada."',
                                                                '".$num_processo."',
                                                                '".$id_municipio."',
                                                                '".$txt_num_dec_mun."',
                                                                '".$txt_dt_dec_mun."',
                                                                '".$txt_dec_vigencia."',
                                                                '".$sel_desastre."',
                                                                '".$txt_dt_vencimento."',
                                                                '".$rdb_status."',
                                                                '".$txt_analista."',
                                                                '".$txt_num_decreto."',
                                                                '".$txt_dt_pub_decreto."',
                                                                '".$txt_num_dt_portaria."',
                                                                '".$txt_num_dou."',
                                                                '".$ck_reconhecido."')";
    
        //print $sql;
        
        $result = mysql_query($sql)  or die (mysql_error());
                                                              
        return true;
 

	}
	
	
	/**
	 *  Alterar Cadastro de Decreto
	 *
	 */
	function AlteraCadastro($_ano, 				   $txt_dt_entrada,           $txt_num_processo,         $id_municipio,              $txt_num_dec_mun,
						    $txt_dt_dec_mun,           $txt_dec_vigencia,         $sel_desastre,              $txt_dt_vencimento,
						    $rdb_status,               $txt_analista,             $txt_num_decreto,           $txt_dt_pub_decreto,
						    $txt_num_dt_portaria,      $txt_num_dou,              $txt_populacao,             $txt_pib,
						    $txt_orcamento,            $txt_arrecadacao,          $txt_receita_anual,         $txt_receita_mensal,
						    $txt_telefone,             $txt_email,                $txt_val_total,             $txt_morto,
						    $txt_ferido,               $txt_enfermo,              $txt_desabrigado,           $txt_desalojado,
						    $txt_outro,                $txt_afetado,              $txt_psaude_destruida,      $txt_psaude_danificada,
						    $txt_psaude_valor,         $txt_pensino_destruida,    $txt_pensino_danificada,    $txt_pensino_valor,
						    $txt_poutro_destruida,     $txt_poutro_danificada,    $txt_poutro_valor,          $txt_pcomuni_destruida,
						    $txt_pcomuni_danificada,   $txt_pcomuni_valor,        $txt_uhabita_destruida,     $txt_uhabita_danificada,
						    $txt_uhabita_valor,        $txt_oinfra_destruida,     $txt_oinfra_danificada,     $txt_oinfra_valor,
						    $txt_agua_pop_atingida,    $txt_solo_pop_atingida,    $txt_ar_pop_atingida,       $txt_incendio_pop_atingida,
						    $txt_saude_prej_publico,   $txt_agua_prej_publico,    $txt_esgoto_prej_publico,   $txt_lixo_prej_publico,
						    $txt_praga_prej_publico,   $txt_energia_prej_publico, $txt_tele_prej_publico,     $txt_trans_prej_publico,
						    $txt_comb_prej_publico,    $txt_seg_prej_publico,     $txt_ensino_prej_publico,   $txt_total_prej_publico,
						    $txt_saude_prej_privado,   $txt_agua_prej_privado,    $txt_esgoto_prej_privado,   $txt_lixo_prej_privado,
						    $txt_total_eprivado, 	   $ck_reconhecido, $_id_processo){
	
				$sql = "UPDATE dec_processo SET ano                    = '".$_ano."',
												dt_entrada             = '".$txt_dt_entrada."',
												num_processo           = '".$txt_num_processo."',
												id_municipio           = '".$id_municipio."',
												num_dec_mun            = '".$txt_num_dec_mun."',
												dt_dec_mun             = '".$txt_dt_dec_mun."',
												dec_vigencia           = '".$txt_dec_vigencia."',
												desastre               = '".$sel_desastre."',
												dt_vencimento          = '".$txt_dt_vencimento."', 
												status                 = '".$rdb_status."',
												id_funcionario         = '".$txt_analista."',
												num_dec_homo           = '".$txt_num_decreto."',
												dt_pub_dec_homo        = '".$txt_dt_pub_decreto."',
												num_dt_port_dec_rec    = '".$txt_num_dt_portaria."',
												num_dt_dou             = '".$txt_num_dou."',
												populacao              = '".$txt_populacao."',
												pib                    = '".$txt_pib."', 
												orcamento              = '".$txt_orcamento."',
												arrecadacao            = '".$txt_arrecadacao."',
												rec_anual              = '".$txt_receita_anual."',
												rec_mensal             = '".$txt_receita_mensal."',
												telefone               = '".$txt_telefone."',
												email                  = '".$txt_email."',
												vl_total               = '".$txt_val_total."',
												morto                  = '".$txt_morto."',
												ferido                 = '".$txt_ferido."',
												enfermo                = '".$txt_enfermo."',
												desabrigado            = '".$txt_desabrigado."',
												desalojado             = '".$txt_desalojado."',
												outro                  = '".$txt_outro."',
												afetado                = '".$txt_afetado."',
												mat_pub_saude_destr    = '".$txt_psaude_destruida."', 
												mat_pub_saude_danif    = '".$txt_psaude_danificada."',
												val_mat_pub_saude      = '".$txt_psaude_valor."',
												mat_pub_ensino_destr   = '".$txt_pensino_destruida."', 
												mat_pub_ensino_danif   = '".$txt_pensino_danificada."',
												val_mat_pub_ensino     = '".$txt_pensino_valor."',
												mat_pub_outro_destr    = '".$txt_poutro_destruida."',
												mat_pub_outro_danif    = '".$txt_poutro_danificada."',
												val_mat_pub_outro      = '".$txt_poutro_valor."',
												mat_pub_com_destr      = '".$txt_pcomuni_destruida."',
												mat_pub_com_danif      = '".$txt_pcomuni_danificada."',
												val_mat_pub_com        = '".$txt_pcomuni_valor."',
												mat_unid_hab_destr     = '".$txt_uhabita_destruida."',
												mat_unid_hab_danif     = '".$txt_uhabita_danificada."',
												val_mat_unid_hab       = '".$txt_uhabita_valor."',
												mat_obr_infr_pub_destr = '".$txt_oinfra_destruida."',
												mat_obr_infr_pub_danif = '".$txt_oinfra_danificada."',
												val_mat_obr_infr_pub   = '".$txt_oinfra_valor."',
												agua_pop_atingida      = '".$txt_agua_pop_atingida."',
												solo_pop_atingida      = '".$txt_solo_pop_atingida."',
												ar_pop_atingida        = '".$txt_ar_pop_atingida."',
												incendio_pop_atingida  = '".$txt_incendio_pop_atingida."',
												eco_pub_saude          = '".$txt_saude_prej_publico."',
												eco_pub_agua           = '".$txt_agua_prej_publico."',
												eco_pub_esgoto         = '".$txt_esgoto_prej_publico."',
												eco_pub_lixo           = '".$txt_lixo_prej_publico."',
												eco_pub_praga          = '".$txt_praga_prej_publico."',
												eco_pub_energia        = '".$txt_energia_prej_publico."',
												eco_pub_telec          = '".$txt_tele_prej_publico."',
												eco_pub_transp         = '".$txt_trans_prej_publico."',
												eco_pub_comb           = '".$txt_comb_prej_publico."',
												eco_pub_segur          = '".$txt_seg_prej_publico."',
												eco_pub_ensino         = '".$txt_ensino_prej_publico."',
												val_eco_pub            = '".$txt_total_prej_publico."',
												eco_priv_agricul       = '".$txt_saude_prej_privado."',
												eco_priv_pecuaria      = '".$txt_agua_prej_privado."',
												eco_priv_industria     = '".$txt_esgoto_prej_privado."',
												eco_priv_servico       = '".$txt_lixo_prej_privado."',
												val_eco_priv		   = '".$txt_total_eprivado."',
												stat_reconhecido	   = '".$ck_reconhecido."'
												WHERE id_processo      = '".$_id_processo."'";
	
				//print $sql;
				mysql_query($sql) or die (mysql_error());
					
				return true;
	
			}

	#@ mostra o processo no setor que está
	function MostraProcesso($_setor) {

		$sql = 'select * from dec_processo where setor = '.$_setor.'';
			
		//print $sql;
			
			
		$result = mysql_query($sql) or die (mysql_error());
			
			
		while ($linha = mysql_fetch_array($result)) {

			$dados = $linha;

			self::$d_proc = $dados;

		}
			
		return self::$d_proc;

			
	}

	#@ busca o setor do usuario
	function getSetor($_login){
			
		$sql ='select setor from dec_usuario where id_user_cedec = (select id_usuario from cedec_usuario where login = '.$_login.')';
			
		$result = mysql_query($sql) or die (mysql_error());
			
			
		$linha = mysql_fetch_array($result);

		return $linha[0];
			
	}



	/**
	 * Busca Processo para Alteração/ Consulta / Relatorio
	 * @param id_municipio
	 * @return as informacoes da aba DADOS GERAIS para relatorio alteracao
	 *  
	 **/
	function BuscaProcessoDados($_id_processo = false){
		
		$con = conexao::getInstance(); 
		
		$dados = array();
		
		$filtro = (!$_id_processo) ? "limit 10" : "WHERE id_processo = ".$_id_processo ;  
		
		//var_dump($filtro);
		
		try{
			
			$sql ="SELECT ano,
						id_processo,
						dt_entrada,
						num_processo,
						id_municipio,
						num_dec_mun,
						dt_dec_mun,
						dec_vigencia,
						desastre,
						dt_vencimento,
						id_funcionario,
						num_dec_homo,
						dt_pub_dec_homo,
						num_dt_port_dec_rec,
						num_dt_dou,
						stat_reconhecido,
						stat_arquivo,	
						stat_homologa,
						stat_analise
							FROM dec_processo ".$filtro;
			
			$result = $con->query($sql);
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					
					$dados[] = $linha; 
				}
				
			return $dados;
		
		}catch (Exception $e){
			
			print $e->getMessage();
		}
						
	}
	
	/**
	 * resumo processo
	 * 
	 */
	function resumoDecreto($ano){
		
		$dados = array();
		
		try {
		
			$con = conexao::getInstance();
			
			$sql = "select count(desastre) as totDesastre, desastre from dec_processo
						where ano = '".$ano."'
						group by desastre
						order by count(desastre) desc";
			
			$result = $con->query($sql);
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
						
					$dados[] = $linha;
				}
			
			return $dados;
		
		}catch(Exception $e){
			
			print $e->getMessage();
			
		}
		
		
		
		
	}
	
	/**
	 * Busca Processo para Alteração/ Consulta / Relatorio
	 * @param id_municipio
	 * @return as informacoes da aba DADOS MUNICIPIO para relatorio alteracao
	 *
	 **/
	function BuscaProcessoDMunin($_id_processo){
	
		$dados = array();
	
		$sql ="SELECT pib,       orcamento,    arrecadacao, 
				      rec_anual, rec_mensal,   telefone,
				      email,     populacao
				      FROM dec_processo
					  WHERE id_processo = ".$_id_processo;
	
		//print $sql;
	
		$result = mysql_query($sql) or die (mysql_error());
	
		while($linha = mysql_fetch_assoc($result)){
				
			$dados[] = $linha;
				
		}
	
		return $dados;
	
	}
	
	
	/**
     * 
     * Busca Processo para Alteração/ Consulta / Relatorio
	 * @param id_municipio
	 * @return as informações da aba DANOS HUMANOS para relatorio alteracao
	 *  
	 * */
	function BuscaProcessoHumano($_id_processo){
		
		$dados = array();
		
		$sql ="SELECT morto,      ferido, enfermo, desabrigado,
					  desalojado, outro,  afetado
					  FROM dec_processo
					  WHERE id_processo = ".$_id_processo;
		
		//print $sql;
		
		$result = mysql_query($sql) or die (mysql_error());
		
		while($linha = mysql_fetch_assoc($result)){
			
			$dados[] = $linha;
			
		}
		
		return $dados;
						
	}
	
	/**
	 * Busca Processo para Alteração/ Consulta / Relatorio
	 * @param id_municipio
	 * @return as informações da aba DANOS MATERIAIS para relatorio alteracao
	 *
	 **/
	function BuscaProcessoMaterial($_id_processo){
	
		$dados = array();
	
		$sql ="SELECT mat_pub_saude_destr,    mat_pub_saude_danif,    val_mat_pub_saude,
					  mat_pub_ensino_destr,   mat_pub_ensino_danif,   val_mat_pub_ensino,
					  mat_pub_outro_destr,    mat_pub_outro_danif,    val_mat_pub_outro,
					  mat_pub_com_destr,      mat_pub_com_danif,      val_mat_pub_com,
		   			  mat_unid_hab_destr,     mat_unid_hab_danif,     val_mat_unid_hab,
		   			  mat_obr_infr_pub_destr, mat_obr_infr_pub_danif, val_mat_obr_infr_pub
					  FROM dec_processo
					  WHERE id_processo = ".$_id_processo;
	
		//print $sql;
	
		$result = mysql_query($sql) or die (mysql_error());
	
		while($linha = mysql_fetch_assoc($result)){
				
			$dados[] = $linha;
				
		}
	
		return $dados;
	
	}
	
	/**
	 * Busca Processo para Alteração/ Consulta / Relatorio
	 * @param id_municipio
	 * @return as informações da aba DANOS AMBIENTAL para relatorio alteracao
	 *
	 **/
	function BuscaProcessoAmbiental($_id_processo){
	
		$dados = array();
	
		$sql ="SELECT agua_pop_atingida,
					  solo_pop_atingida,
					  ar_pop_atingida,
					  incendio_pop_atingida
					  FROM dec_processo
					  WHERE id_processo = ".$_id_processo;
	
		//print $sql;
	
		$result = mysql_query($sql) or die (mysql_error());
	
		while($linha = mysql_fetch_assoc($result)){
	
			$dados[] = $linha;
	
		}
	
		return $dados;
	
	}
	
	/**
	 * @todo Busca Processo para Alteração/ Consulta / Relatorio, as informações da aba PREJUIZO ECONÔMICOS PÚBLICOS para relatorio alteracao
	 * @param id_municipio
	 * @return 
	 *
	 **/
	function BuscaProcessoEPublico($_id_processo){
	
		$dados = array();
	
		$sql ="SELECT eco_pub_saude,
				      eco_pub_agua,
				      eco_pub_esgoto,
				      eco_pub_lixo, 
				      eco_pub_praga,
				      eco_pub_energia,
				      eco_pub_telec,
				      eco_pub_transp,
				      eco_pub_comb,
				      eco_pub_segur,
				      eco_pub_ensino,
				      val_eco_pub				                
					  FROM dec_processo
					  WHERE id_processo = ".$_id_processo;
	
		//print $sql;
	
		$result = mysql_query($sql) or die (mysql_error());
	
		while($linha = mysql_fetch_assoc($result)){
	
			$dados[] = $linha;
	
		}
	
		return $dados;
	
	}
	
	/**
	 * Busca Processo para Alteração/ Consulta / Relatorio
	* @param id_municipio
	* @return as informações da aba PREJUIZO ECONÔMICOS PRIVADO para relatorio alteracao
	*
	* */
	function BuscaProcessoEPrivado($_id_processo){
	
		$dados = array();
	
		$sql ="SELECT eco_priv_agricul,
				      eco_priv_pecuaria,
				      eco_priv_industria,
					  eco_priv_servico,
					  val_eco_priv
					  FROM dec_processo
					  WHERE id_processo = ".$_id_processo;
	
		//print $sql;
	
		$result = mysql_query($sql) or die (mysql_error());
	
		while($linha = mysql_fetch_assoc($result)){
	
			$dados[] = $linha;
	
		}
	
		return $dados;
	
	}

	/*
	 * Pesquisa Processo para Consulta/ alteracao
	* @param id_municipio
	* @param ano
	* @param desastre
	* @return ano, dt_entrada, id_municipio, desastre, id_processo
	*
	* */
	function pesquisaProcesso($_id_municipio, $_ano, $_cobrade){
	
		$dados = array();
		
		try{
			
			$con = conexao::getInstance();
		
			$id_municipio = (!empty($_id_municipio)) ? " and id_municipio = ".$_id_municipio : "";
			$ano = (!empty($_ano)) ? " and ano_processo = ".$_ano : "";
			$cobrade = (!empty($_cobrade)) ? " and id_municipio = ".$_cobrade : "";

		
	
			$sql ="SELECT id_processo, ano_processo, data_entrada,
						 id_municipio, cod_desastre_cobr, 
						 dec_vigencia_proc, data_venc_process 
				   FROM dec_processo where id_processo >0 ".$id_municipio.$ano.$cobrade;
					
			$result = $con->query($sql);
				
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
			
				$dados[] = $linha;
			}
			return $dados;
			
		}catch (Exception $e){
			
			print $e->getMessage();
			
		}
	
	}
	
	#@ recebe o status do processo
	function PegaStatus($_rdb_status){
	
		/* 0 - siga
		   1 - Homologacao
		   2 - Arquivo
		   3 - Análise
		*/
		
		$_status = array("", "", "", "");
		
		
			if($_rdb_status == 0){
					
				$_status[0] = "checked=\"checked\"";
				
			}
			
			if($_rdb_status == 1){
					
				$_status[1] = "checked=\"checked\"";

			}
			
			if($_rdb_status == 2){
					
				$_status[2] = "checked=\"checked\"";

			}
			
			if($_rdb_status == 3){
					
				$_status[3] = "checked=\"checked\"";
			}
			
			
			return $_status;
	
	}
    
    #@ Gera o ultimo numero do processo
    function numProcesso(){
        
        $sql = "SELECT MAX(num_processo +1) FROM dec_processo";
        
        $result = mysql_query($sql) or die (mysql_error());
        
        $dado = mysql_fetch_array($result);
        
        return ($dado[0] == null) ? 1 : $dado[0];
        
    }
    
    /**
     * <p> Consulta processo </p>
	 * @param identificador do Processo
     * @author Demetrio S. Passos
     * @return Array
     */
     function ConsultaProcesso($_id){
     	
     	$dados = array();
     	
     	$con = conexao::getInstance();
         
         $sql ="SELECT id_processo,            ano,                    dt_entrada,             num_processo,
                       id_municipio,           num_dec_mun,            dt_dec_mun,             dec_vigencia,
                       desastre,               dt_vencimento,          status,           id_funcionario,
                       homo_num_dec,           homo_dt_pub_dec,        homo_num_dt_port_dec_rec,    homo_num_dt_dou,
                       populacao,              pib,                    orcamento,              arrecadacao,
                       rec_anual,              rec_mensal,             telefone,               email,
                       vl_total,               morto, ferido,          enfermo,                desabrigado,
                       desalojado,             outro,                  afetado,                mat_pub_saude_destr,
                       mat_pub_saude_danif,    val_mat_pub_saude,      mat_pub_ensino_destr,   mat_pub_ensino_danif,
                       val_mat_pub_ensino,     mat_pub_outro_destr,    mat_pub_outro_danif,    val_mat_pub_outro,
                       mat_pub_com_destr,      mat_pub_com_danif,      val_mat_pub_com,        mat_unid_hab_destr,
                       mat_unid_hab_danif,     val_mat_unid_hab,       mat_obr_infr_pub_destr, mat_obr_infr_pub_danif,
                       val_mat_obr_infr_pub,   agua_pop_atingida,      solo_pop_atingida,      ar_pop_atingida,
                       incendio_pop_atingida,  eco_pub_saude,          eco_pub_agua,           eco_pub_esgoto,
                       eco_pub_lixo,           eco_pub_praga,          eco_pub_energia,        eco_pub_telec,
                       eco_pub_transp,         eco_pub_comb,           eco_pub_segur,          eco_pub_ensino,
                       val_eco_pub,            eco_priv_agricul,       eco_priv_pecuaria,      eco_priv_industria,
                       eco_priv_servico,       val_eco_priv,           stat_rec_uniao,         stat_n_rec_uniao,
                       stat_arq_estado,        stat_hom_estado,        stat_analis_estado,     stat_aprov_pmda 
                       FROM dec_processo
                       WHERE id_processo = ".$_id;
         
         $result = $con->query($sql);
         
         while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
         	$dados = $linha;
         }
         
         return $dados;
         
         
     }
     
     /**
      * 
      * @param 
      * @author
      * @return dias restante para o fim do decreto municipal
      * 
      */
      static function RestanteDecreto($_id_processo){
      	
      		$dados = array();
      	
      		$con = conexao::getInstance();
                 
            $hoje = date('d/m/Y');  
          
            $sql = "SELECT data_venc_process
                    FROM dec_processo 
                    WHERE id_processo = ".$_id_processo;
                    
            $result = $con->query($sql);
                       
		      while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
		         	$dados = $linha;
		         }
         
            
            $_inicio = strtotime(DataMysql::dataForm($hoje));
            $_fim    = strtotime($dados['data_venc_process']);
            
            $_restante = ($_fim - $_inicio) / 86400;
            
            return ($_restante > 0) ? $_restante : "Vencido"; 
              
          
      }
      
      
      /**
       * Get nome Cobrade
       * @param string $id_cobrade
       */
      public function getCobradeId($id_cobrade){
      
      	try {
      
      		$dados = array();
      		 
      		$con = Conexao::getInstance();
      			
      		$sql = "SELECT codigo, descricao FROM dec_cobrade where id_cobrade = ".$id_cobrade;
      		 
      		$result = $con->query($sql);
      		 
      		$result->execute();
      
      		while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
      
      			$dados = $linha;
      		}
      		 
      		return $dados['codigo']."-".$dados['descricao'];
      		 
      		 
      	}catch (Exception $e){
      
      	}
      }
      
      
      /**
       * Dados select cobrade
       *
       */
      public function dadosCobrade(){
      
      	try {
      
      		$dados = array();
      		 
      		$con = Conexao::getInstance();
      		 
      		$sql = "SELECT codigo, descricao FROM dec_cobrade";
      		 
      		$result = $con->query($sql);
      		 
      		$result->execute();
      
      		while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
      
      			$dados[] = $linha;
      		}
      		 
      		return $dados;
      		 
      		 
      	}catch (Exception $e){
      
      	}
      }
      
      public static function comboCobrade($id_cobrade = false){
          
        try {
        	
        	$con = Conexao::getInstance();

        	
	      	$sql = "SELECT id_cobrade, codigo, descricao
	                    FROM dec_cobrade ORDER BY descricao";
	          
	          $result = $con->query($sql);
      	
	          //$result->execute();
	          	
	          print "<select class=\"form-control\" name=\"sel_desastre\" id=\"sel_desastre\">";
	          print (empty($id_cobrade)) ? "<option value=\"0\">Código Cobrade</option>" : "<option value=\"".$id_cobrade."\">".Decretacao::getCobradeId($id_cobrade)."</option>";
	          
	          while ($linha = $result->fetch(PDO::FETCH_ASSOC)){

	          		echo $linha['id_cobrade'];
 	             print "<option value=\"".$linha['id_cobrade']."\">".$linha["codigo"]." - ".utf8_encode($linha["descricao"])."</option>";
	          }
	          
		          print "</select>";
	          
	          
	          
	          
		          
				//var_dump($dados);
	      }catch (Exception $e){

	      }
      }
      

      
      /**
       * Grava novos dados do processo
       * 
       * 
       */
        public function dadosProcesso($dados){
        	
        	try {
        		 
        		$con = Conexao::getInstance();
        		$sql = "insert into dec_processo (num_processo,
        											ano,                     
													dt_entrada,              
													id_municipio,            
													num_dec_mun,            
													dt_dec_mun,              
													dec_vigencia,            
													desastre,                
													dt_vencimento,           
													analista,              
													stat_rec_uniao,          
													stat_n_rec_uniao,        
													stat_arq_estado,         
													stat_hom_estado,         
													stat_analis_estado,      
													stat_aprov_pmda,         
													stat_em_analis_pmda,     
													homo_num_dec,            
													homo_dt_pub_dec,         
													homo_num_dt_port_dec_rec,
													homo_num_dt_dou) value (:num_processo,
        																	:txt_ano,            
																			:txt_dt_entrada,          
																			:id_municipio,             
																			:txt_num_dec_mun,         
																			:txt_dt_dec_mun,          
																			:txt_dec_vigencia,        
																			:sel_desastre,       
																			:txt_dt_vencimento,        
																			:txt_analista,           
																			:rdb_stat_rec_uniao,  
																			:rdb_stat_nrec_uniao,     
																			:rdb_stat_arq_estado,     
																			:rdb_stat_hom_estado,      
																			:rdb_stat_analis_estado,   
																			:rdb_aprovado_pmda,       
																			:rdb_em_analise_pmda,     
																			:txt_num_decreto_homo,    
																			:txt_dt_pub_decreto_homo, 
																			:txt_num_dt_portaria_homo,
																			:txt_num_dou_homo)";
        		

        		$result = $con->prepare($sql);
        		
        		$result->bindValue(":num_processo",      $dados['num_processo']);
        		$result->bindValue(":txt_ano",           $dados['txt_ano']);
        		$result->bindValue(":txt_dt_entrada",    $dados['txt_dt_entrada']);
        		$result->bindValue(":id_municipio",      $dados['id_municipio']);
        		$result->bindValue(":txt_num_dec_mun",   $dados['txt_num_dec_mun']);
        		$result->bindValue(":txt_dt_dec_mun",    $dados['txt_dt_dec_mun']);
        		$result->bindValue(":txt_dec_vigencia",  $dados['txt_dec_vigencia']);
        		$result->bindValue(":sel_desastre",      $dados['sel_desastre']);
        		$result->bindValue(":txt_dt_vencimento", $dados['txt_dt_vencimento']);
        		$result->bindValue(":txt_analista",      $dados['txt_analista']);
        		$result->bindValue(":rdb_stat_rec_uniao", $dados['rdb_stat_rec_uniao']);
        		$result->bindValue(":rdb_stat_nrec_uniao", $dados['rdb_stat_nrec_uniao']);
        		$result->bindValue(":rdb_stat_arq_estado", $dados['rdb_stat_arq_estado']);
        		$result->bindValue(":rdb_stat_hom_estado", $dados['rdb_stat_hom_estado' ]);
        		$result->bindValue(":rdb_stat_analis_estado", $dados['rdb_stat_analis_estado']);
        		$result->bindValue(":rdb_aprovado_pmda", $dados['rdb_aprovado_pmda']);
        		$result->bindValue(":rdb_em_analise_pmda", $dados['rdb_em_analise_pmda']);
        		$result->bindValue(":txt_num_decreto_homo", $dados['txt_num_decreto_homo']);
        		$result->bindValue(":txt_dt_pub_decreto_homo", $dados['txt_dt_pub_decreto_homo']);
        		$result->bindValue(":txt_num_dt_portaria_homo", $dados['txt_num_dt_portaria_homo']);
        		$result->bindValue(":txt_num_dou_homo", $dados['txt_num_dou_homo']);
				
				$result->execute();
				        		
				return $con->lastInsertId();
        		
        	}catch (Exception $e){
        		print $e->getMessage();
        		
        	}
        	
        	
        }
        
        /**
         * Altera dados do processo
         *
         *
         */
        public function updateDadosProcesso($dados){
        	
        	$con = Conexao::getInstance();
        	
        	try{
        				$sql = "update dec_processo set ano =:ano,
											        	dt_entrada =:dt_entrada,
											        	id_municipio =:id_municipio,
											        	num_dec_mun =:num_dec_mun,
											        	dt_dec_mun =:dt_dec_mun,
											        	dec_vigencia =:dec_vigencia,
											        	desastre =:desastre,
											        	dt_vencimento =:dt_vencimento,
											        	analista =:analista,
											        	stat_rec_uniao =:stat_rec_uniao,
											        	stat_n_rec_uniao =:stat_n_rec_uniao,
											        	stat_arq_estado =:stat_arq_estado,
											        	stat_hom_estado =:stat_hom_estado,
											        	stat_analis_estado =:stat_analis_estado,
											        	stat_aprov_pmda =:stat_aprov_pmda,
											        	stat_em_analis_pmda =:stat_em_analis_pmda,
											        	homo_num_dec =:homo_num_dec,
											        	homo_dt_pub_dec =:homo_dt_pub_dec,
											        	homo_num_dt_port_dec_rec =:homo_num_dt_port_dec_rec,
											        	homo_num_dt_dou =:homo_num_dt_dou
											        	where id_municipio =:id_municipio";
        				
        		$result = $con->prepare($sql);
        		
        		$result->bindValue(":num_processo",      $dados['num_processo']);
        		$result->bindValue(":ano",           $dados['txt_ano']);
        		$result->bindValue(":dt_entrada",    $dados['txt_dt_entrada']);
        		$result->bindValue(":id_municipio",      $dados['id_municipio']);
        		$result->bindValue(":num_dec_mun",   $dados['txt_num_dec_mun']);
        		$result->bindValue(":dt_dec_mun",    $dados['txt_dt_dec_mun']);
        		$result->bindValue(":dec_vigencia",  $dados['txt_dec_vigencia']);
        		$result->bindValue(":sel_desastre",      $dados['sel_desastre']);
        		$result->bindValue(":dt_vencimento", $dados['txt_dt_vencimento']);
        		$result->bindValue(":analista",      $dados['txt_analista']);
        		$result->bindValue(":stat_rec_uniao", $dados['rdb_stat_rec_uniao']);
        		$result->bindValue(":stat_nrec_uniao", $dados['rdb_stat_nrec_uniao']);
        		$result->bindValue(":stat_arq_estado", $dados['rdb_stat_arq_estado']);
        		$result->bindValue(":stat_hom_estado", $dados['rdb_stat_hom_estado' ]);
        		$result->bindValue(":stat_analis_estado", $dados['rdb_stat_analis_estado']);
        		$result->bindValue(":aprovado_pmda", $dados['rdb_aprovado_pmda']);
        		$result->bindValue(":em_analise_pmda", $dados['rdb_em_analise_pmda']);
        		$result->bindValue(":num_decreto_homo", $dados['txt_num_decreto_homo']);
        		$result->bindValue(":dt_pub_decreto_homo", $dados['txt_dt_pub_decreto_homo']);
        		$result->bindValue(":num_dt_portaria_homo", $dados['txt_num_dt_portaria_homo']);
        		$result->bindValue(":num_dou_homo", $dados['txt_num_dou_homo']);
        		
        		$result->execute();
        			
        	}catch (Exception $e){
        		
        		
        	}
        	 
        	 
        	 
        	 
        }
        
        
        /**
         * 
         * 
         */
        public function listaDec_processo(){
        	return;	
        }
        
        
        /**
         * 
         * 
         */
        public function getNumProcesso(){
        	
        	$dados = "";
        	
        	$con = Conexao::getInstance();
        	
        	$sql = "SELECT num_processo 
        				from dec_processo
        				order by num_processo desc
        				limit 1";
        	
        	$result = $con->query($sql);
        	
        	while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
        	
        		$dados = $linha["num_processo"]+1;
        	
        	}
        	
        	return $dados;
        	
        	
        	
        	
        	
       }
        

               
	}?>