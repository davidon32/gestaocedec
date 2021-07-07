<?php 

class Compdec{
	
	function Cadastrar($_id_municipio,
						$_regiao,
						$_associacao,
						$_num_lei,
						$_dt_lei,
						$_num_decreto,
						$_dt_decreto,
						$_num_portaria,
						$_dt_portaria,
						$_endereco,
						$_comp_fone1,
						$_comp_fone2,
						$_efetivo, 
						$_email,    
						$_nudec,
                        $_sel_territorio_desenv,
						$_sel_CompdecExist,
						$_sel_Ativo){

	   $con = Conexao::getInstance();
                            
		$sql = "INSERT INTO com_comdec (id_municipio,
										regiao,
										associacao,
										num_lei,
										dt_lei,
										num_decreto,
										dt_decreto,
										num_portaria,
										dt_portaria,
										endereco,
										fone_com1,
										fone_com2,
										efetivo,
										email,
										nudec,
										id_territorio,
										com_const,
										com_ativa)
										VALUES ('".$_id_municipio."',
												'".$_associacao."',
												'".$_regiao."',
												'".$_num_lei."',
												'".$_dt_lei."',
												'".$_num_decreto."',
												'".$_dt_decreto."',
												'".$_num_portaria."',
												'".$_dt_portaria."',
												'".$_endereco."',
												'".$_comp_fone1."',
												'".$_comp_fone2."',
												'".$_efetivo."', 
												'".$_email."',
												'".$_nudec."',
                                                '".$_sel_territorio_desenv."',
                                                '".$_sel_CompdecExist."',
                                                '".$_sel_Ativo."')";
		
		try {

		  $result = $con->query($sql);

		  $result->execute();
		  
		  return true;
		    
		}catch (Exception $e){
		
		    print FuncaoBase::getError($e->getMessage());
    
		}
	}

	#@ Alterar Cadastro Compdec
	function Alterar($dados){

		try {

		$con = Conexao::getInstance();
		
		$sql = "UPDATE com_comdec 
                    SET regiao            =:regiao,
						associacao        =:associacao,
						num_lei           =:num_lei,
						dt_lei            =:dt_lei,
						num_decreto       =:num_decreto,
						dt_decreto        =:dt_decreto,
						num_portaria      =:num_portaria,
						dt_portaria       =:dt_portaria,
						endereco          =:endereco,
						fone_com1         =:fone_com1,
						fone_com2         =:fone_com2,
						efetivo           =:efetivo,
						qtd_efetivo	      =:qtd_efetivo,
						email             =:email,
						nudec             =:nudec,
						qtd_nudec		  =:qtd_nudec,
						capacitacao_nupdec=:capacitacao_nupdec,
						org_rep           =:org_rep,
						id_territorio     =:id_territorio,
						plano_cont        =:plano_cont,
						capacitacao       =:capacitacao,
						dt_curso_capac    =:dt_curso_capac,
						cartao_pdc        =:cartao_pdc,
						sede_propria      =:sede_propria,
						viatura           =:viatura,
						simulado          =:simulado,
						mapeamento        =:mapeamento,
						curso_gestao      =:curso_gestao,
						dt_curso_gestao   =:dt_curso_gestao,
						curso_sco         =:curso_sco,
						dt_curso_sco      =:dt_curso_sco,
						exp_dc            =:exp_dc,
						tp_ex_dc          =:tp_ex_dc,
						computador        =:computador,
						particip_workshop =:particip_workshop,
						dt_partic_workshop=:dt_partic_workshop,
						com_const		  =:com_const,
						com_ativa         =:com_ativa,
						sem_decreto       =:ckSemDecreto,
						sem_portaria      =:ckSemPortaria,
                                                email2            =:email2,
                                                email3            =:email3
                        WHERE id_municipio=:id_municipio";
	
		$result = $con->prepare($sql);
		
		$result->bindValue(":regiao"            , $dados['sel_regiao']);
		$result->bindValue(":associacao"        , $dados['sel_associacao']);
		$result->bindValue(":num_lei"           , $dados['txt_num_lei']);
		$result->bindValue(":dt_lei"            , DataMysql::dataForm($dados['txt_dt_lei']));
		$result->bindValue(":num_decreto"       , $dados['txt_num_decreto']);
		$result->bindValue(":dt_decreto"        , DataMysql::dataForm($dados['txt_dt_decreto']));
		$result->bindValue(":num_portaria"      , $dados['txt_num_portaria']);
		$result->bindValue(":dt_portaria"       , DataMysql::dataForm($dados['txt_dt_portaria']));
		$result->bindValue(":endereco"          , $dados['txt_endereco']);
		$result->bindValue(":fone_com1"         , $dados['txt_comp_fone1']);
		$result->bindValue(":fone_com2"         , $dados['txt_comp_fone2']);
		$result->bindValue(":efetivo"           , $dados['rdb_efetivo']);
		$result->bindValue(":qtd_efetivo"       , $dados['txt_qtd_efetivo'], PDO::PARAM_INT);
		$result->bindValue(":capacitacao_nupdec", $dados['txt_cap_nupdec']);
		$result->bindValue(":email"             , $dados['txt_email']);
		$result->bindValue(":nudec"             , $dados['rdb_nudec']);
		$result->bindValue(":qtd_nudec"         , $dados['txt_efetivo_nupdec'], PDO::PARAM_INT);
		$result->bindValue(":org_rep"           , $dados['txt_org_rep']);
		$result->bindValue(":id_territorio"     , $dados['selTerritorioDesenv']);
		$result->bindValue(":plano_cont"        , $dados['rdb_plano']);
		$result->bindValue(":capacitacao"       , $dados['rdb_capacitacao']);
		$result->bindValue(":dt_curso_capac"    , DataMysql::dataForm($dados['txt_dt_curso']));
		$result->bindValue(":cartao_pdc"        , $dados['rdb_cartao']);
		$result->bindValue(":sede_propria"      , $dados['ck_sede'], PDO::PARAM_INT);
		$result->bindValue(":viatura"           , $dados['ck_viatura'], PDO::PARAM_INT);
		$result->bindValue(":simulado"          , $dados['rdb_simulado'], PDO::PARAM_INT);
		$result->bindValue(":mapeamento"        , $dados['rdb_mapeamento']);
		$result->bindValue(":curso_gestao"      , $dados['ck_curso_gestao']);
		$result->bindValue(":dt_curso_gestao"   , DataMysql::dataForm($dados['dt_curso_gestao']));
		$result->bindValue(":curso_sco"         , $dados['ck_curso_sco']);
		$result->bindValue(":dt_curso_sco"      , DataMysql::dataForm($dados['dt_curso_sco']));
		$result->bindValue(":exp_dc"            , $dados['ck_exp_dc']);
		$result->bindValue(":tp_ex_dc"          , $dados['tp_ex_dc']);
		$result->bindValue(":computador"        , $dados['ck_computador']);
		$result->bindValue(":particip_workshop" , $dados['ck_particip_workshop']);
		$result->bindValue(":dt_partic_workshop", DataMysql::dataForm($dados['dt_partic_workshop']));
		$result->bindValue(":com_const"			, $dados['selCompdec']);
		$result->bindValue(":com_ativa"		    , $dados['selAtivo']);
		$result->bindValue(":id_municipio"      , $dados['id_municipio']);
		$result->bindValue(":ckSemDecreto"      , $dados['ckSemDecreto']);
		$result->bindValue(":ckSemPortaria"      , $dados['ckSemPortaria']);
                $result->bindValue(":email2",            $dados['txt_email2']);
                $result->bindValue(":email3",            $dados['txt_email3']);

		$result->execute();
			  
		  return true;
			  
		}catch (Exception $e){
		    
		    print FuncaoBase::getError($e->getMessage(), 'Mensagem');

		}
	}

	#@ Alterar Cadastro Compdec parte 1
	function AtualizacaoParte1($dados){

		try {

			$con = Conexao::getInstance();
			
			$sql = "UPDATE com_comdec 
						SET com_const		  =:com_const,
							com_ativa         =:com_ativa,
							regiao            =:regiao,
							id_territorio     =:id_territorio,
							associacao        =:associacao,
							num_lei           =:num_lei,
							dt_lei            =:dt_lei,
							num_decreto       =:num_decreto,
							dt_decreto        =:dt_decreto,
							num_portaria      =:num_portaria,
							dt_portaria       =:dt_portaria,
							endereco          =:endereco,
							fone_com1         =:fone_com1,
							fone_com2         =:fone_com2,
							efetivo           =:efetivo,
							qtd_efetivo	      =:qtd_efetivo,
							nudec             =:nudec,
							qtd_nudec		  =:qtd_nudec,
							capacitacao_nupdec=:capacitacao_nupdec
						WHERE id_municipio=:id_municipio";
						
						$result = $con->prepare($sql);
						
						$result->bindValue(":com_const"			, $dados['selCompdec']);
						$result->bindValue(":com_ativa"		    , $dados['selAtivo']);
						$result->bindValue(":regiao"            , $dados['sel_regiao']);
						$result->bindValue(":id_territorio"     , $dados['selTerritorioDesenv']);
						$result->bindValue(":associacao"        , $dados['sel_associacao']);
						$result->bindValue(":num_lei"           , $dados['txt_num_lei']);
						$result->bindValue(":dt_lei"            , DataMysql::dataForm($dados['txt_dt_lei']));
						$result->bindValue(":num_decreto"       , $dados['txt_num_decreto']);
						$result->bindValue(":dt_decreto"        , DataMysql::dataForm($dados['txt_dt_decreto']));
						$result->bindValue(":num_portaria"      , $dados['txt_num_portaria']);
						$result->bindValue(":dt_portaria"       , DataMysql::dataForm($dados['txt_dt_portaria']));
						$result->bindValue(":endereco"          , $dados['txt_endereco']);
						$result->bindValue(":fone_com1"         , $dados['txt_comp_fone1']);
						$result->bindValue(":fone_com2"         , $dados['txt_comp_fone2']);
						$result->bindValue(":efetivo"           , $dados['selEfetivo']);
						$result->bindValue(":qtd_efetivo"       , $dados['txt_qtd_efetivo'], PDO::PARAM_INT);
						$result->bindValue(":nudec"             , $dados['selNudec']);
						$result->bindValue(":qtd_nudec"         , $dados['txt_qtd_nudec'], PDO::PARAM_INT);
						$result->bindValue(":capacitacao_nupdec", $dados['txt_cap_nupdec']);
						$result->bindValue(":id_municipio"      , $dados['id_municipio']);

			$result->execute();
			return true;
					
		}catch (Exception $e){
					
					print FuncaoBase::getError($e->getMessage(), 'Mensagem');

				}

	}
	
	#@ Alterar Cadastro Compdec parte 2
	function AtualizacaoParte2($dados){

		
		try {

			$con = Conexao::getInstance();
			
			$sql = "UPDATE com_comdec 
						SET email             =:email,
							plano_cont        =:plano_cont,
							capacitacao       =:capacitacao,
							dt_curso_capac    =:dt_curso_capac,
							cartao_pdc        =:cartao_pdc,
							sede_propria      =:sede_propria,
							viatura           =:viatura,
							computador        =:computador,
							simulado          =:simulado,
							mapeamento        =:mapeamento,
							curso_gestao      =:curso_gestao,
							dt_curso_gestao   =:dt_curso_gestao,
							curso_sco         =:curso_sco,
							dt_curso_sco      =:dt_curso_sco,
							particip_workshop =:particip_workshop,
							dt_partic_workshop=:dt_partic_workshop,
							exp_dc            =:exp_dc,
							tp_ex_dc          =:tp_ex_dc,
                                                        email2            =:email2,
                                                        email3            =:email3
						WHERE id_municipio=:id_municipio";
						
						$result = $con->prepare($sql);
						
			
				$result->bindValue(":email"             , strtolower($dados['txt_email']));
				$result->bindValue(":plano_cont"        , $dados['rdb_plano']);
				$result->bindValue(":capacitacao"       , $dados['rdb_capacitacao']);
				$result->bindValue(":dt_curso_capac"    , DataMysql::dataForm($dados['txt_dt_curso']));
				$result->bindValue(":cartao_pdc"        , $dados['rdb_cartao']);
				$result->bindValue(":sede_propria"      , $dados['ck_sede'], PDO::PARAM_INT);
				$result->bindValue(":viatura"           , $dados['ck_viatura'], PDO::PARAM_INT);
				$result->bindValue(":computador"        , $dados['ck_computador']);
				$result->bindValue(":simulado"          , $dados['rdb_simulado'], PDO::PARAM_INT);
				$result->bindValue(":mapeamento"        , $dados['rdb_mapeamento']);
				$result->bindValue(":curso_gestao"      , $dados['ck_curso_gestao']);
				$result->bindValue(":dt_curso_gestao"   , DataMysql::dataForm($dados['dt_curso_gestao']));
				$result->bindValue(":curso_sco"         , $dados['ck_curso_sco']);
				$result->bindValue(":dt_curso_sco"      , DataMysql::dataForm($dados['dt_curso_sco']));
				$result->bindValue(":exp_dc"            , $dados['ck_exp_dc']);
				$result->bindValue(":tp_ex_dc"          , $dados['tp_ex_dc']);
				$result->bindValue(":particip_workshop" , $dados['ck_particip_workshop']);
				$result->bindValue(":dt_partic_workshop", DataMysql::dataForm($dados['dt_partic_workshop']));
				$result->bindValue(":id_municipio"      , $dados['id_municipio']);
                                $result->bindValue(":email2",            $dados['txt_email2']);
                                $result->bindValue(":email3",            $dados['txt_email3']);

				$result->execute();
					
				return true;
				
		}catch (Exception $e){
				
				print FuncaoBase::getError($e->getMessage(), 'Mensagem');

		}
	}


	#@ atualizar email rec senha
	function AtualizEmailRec($dados){

		try {
			$con = Conexao::getInstance();
			
			$sql = "UPDATE cedec_user_ex SET email_rec =:email_rec
					WHERE id_municipio=:id_municipio";
						
				$result = $con->prepare($sql);		
				$result->bindValue(":email_rec", strtolower($dados['txt_email']));
				$result->bindValue(":id_municipio", $dados['id_municipio']);
				$result->execute();
					
				return true;
				
		}catch (Exception $e){
				print FuncaoBase::getError($e->getMessage(), 'Mensagem');
		}
	}

	#@ atualizar email telefone Prefeitura
	function AtualizPreDadPref($dados){
            
 
		try {
			$con = Conexao::getInstance();
			
			$sql = "UPDATE cedec_municipio 
					SET email =:email,
					tel_pref =:tel_pref,
					cel_pref =:cel_pref,
                                        prefeito =:prefeito,
                                        endereco =:endereco,
                                        bairro =:bairro,
                                        cep =:cep
					WHERE id_municipio=:id_municipio";
						
				$result = $con->prepare($sql);		
				$result->bindValue(":email", strtolower($dados['email_pref']));
				$result->bindValue(":tel_pref", $dados['tel_pref']);
				$result->bindValue(":cel_pref", $dados['cel_pref']);
				$result->bindValue(":id_municipio", $dados['id_municipio']);
                                $result->bindValue(":prefeito", $dados['prefeito']);
                                $result->bindValue(":endereco", $dados['pref_endereco']);
                                $result->bindValue(":bairro", $dados['pref_bairro']);
                                $result->bindValue(":cep", $dados['pref_cep']);
				$result->execute();
					
				return true;
				
		}catch (Exception $e){
				print FuncaoBase::getError($e->getMessage(), 'Mensagem');
		}
	}

	#@ aba anexo opcao nao possui decreto e portaria
	function GravaSemDecreto($dados){
		try {

			$con = Conexao::getInstance();
			
			$sql = "UPDATE com_comdec 
						SET sem_decreto       =:ckSemDecreto
						WHERE id_municipio	  =:id_municipio";
						
						$result = $con->prepare($sql);
						
				$result->bindValue(":ckSemDecreto"      , $dados['ckSemDecreto']);
				$result->bindValue(":id_municipio"      , $dados['id_municipio']);

				$result->execute();
					
				return true;
				
		}catch (Exception $e){
				
				print FuncaoBase::getError($e->getMessage(), 'Mensagem');

		}
	}

	#@ aba anexo opcao nao possui decreto e portaria
	function GravaSemPortaria($dados){
		try {

			$con = Conexao::getInstance();
			
			$sql = "UPDATE com_comdec 
						SET sem_portaria      =:ckSemPortaria
						WHERE id_municipio	  =:id_municipio";
						
						$result = $con->prepare($sql);
						
				$result->bindValue(":ckSemPortaria"      , $dados['ckSemPortaria']);
				$result->bindValue(":id_municipio"      , $dados['id_municipio']);

				$result->execute();
					
				return true;
				
		}catch (Exception $e){
				
				print FuncaoBase::getError($e->getMessage(), 'Mensagem');

		}
	}


	/**
	 *  #@ busca Compdec todos dados 
	 *  @param id_municipio 
	 */
	static function  buscaCompdec($_id_municipio = false){

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
    						com_comdec.sem_portaria,
                                                com_comdec.email2 as email2,
                                                com_comdec.email3 as email3
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

	/**
	 *  #@ busca Plano de contingencia
	 *  @param id_municipio 
	 */
	function buscaPlano($_id_municipio){

	    $con = Conexao::getInstance();
	    
		$dados = array();
		
		try{

    		$sql = "select *from com_plano where id_municipio = :id_municipio";			
			
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
	
	#@  
	function buscaDadosCompdec($_id_municipio = false){
	
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
    						com_comdec.com_ativa
    						FROM com_comdec
    						INNER JOIN cedec_municipio
    						ON com_comdec.id_municipio = cedec_municipio.id_municipio";
	
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
	
	
	/**
     * Resumo compdec existentes true para existente e false para não existentes
     * @param true
     * @param false
     * @return lista total compdec existente
     */
     function qtdCompdecExitente($_situacao = true){
     	
     	$con = Conexao::getInstance();
     	
     	$dados = array();
         
         $_filtro = ($_situacao) ? "=1" : "= 0";
             
         $sql = "SELECT count(id_comdec) as id_comdec
                FROM com_comdec
                WHERE com_const ".$_filtro." 
                AND id_comdec <> '854'"; 

         $result = $con->query($sql);

         while ($linha = $result->fetch(PDO::FETCH_ASSOC)){ 
         
         	$dados = $linha;	
         
         }
         
         return $dados['id_comdec'];
     }
     
     
     /**
      * Listagem de Compdec para hospedagem Site
      * @author Demetrio Silva Passos
      * @return void
      * 
      * 
      */
        function listaCompdecSite(){
            
            $dados = array();
            
            $sql = "SELECT cedec_municipio.nome as Municipio,
                           com_regiao.nome as Regiao,
                           com_comdec.fone_com1 as Telefone1,
                           com_comdec.fone_com2 as Telefone2
                           FROM com_comdec
                           INNER JOIN cedec_municipio
                           ON com_comdec.id_municipio = cedec_municipio.id_municipio
                           INNER JOIN com_regiao
                           ON com_comdec.regiao = com_regiao.id_regiao
                           WHERE num_lei <> 0
                           ORDER BY cedec_municipio.nome";
                           
             $result = mysql_query($sql) or die(mysql_error);
             
             while ($linha = mysql_fetch_array($result)) {
                 
                 $dados[] = $linha;
                 
             }
             
             return $dados;
		}
		

	/* lista compdec ativa */
	public function listaCompdecAtiva(){

		$dados = array();
    	
			$con = Conexao::getInstance();
			
	    	try {
					$sql = "select cedec_municipio.nome,
							cedec_municipio.id_municipio,
							cedec_municipio.tel as tel_prefeitura,
                                                        cedec_prefeitura.tel1 as tel_prefeitura1,
                                                        cedec_prefeitura.tel2 as tel_prefeitura2,
							com_comdec.fone_com1 as tel_compdec1,
							com_comdec.fone_com2 as tel_compdec2
							from cedec_municipio
							inner join com_comdec
							on cedec_municipio.id_municipio = com_comdec.id_municipio
							inner join cedec_user_ex
							on cedec_municipio.id_municipio = cedec_user_ex.id_municipio
                                                        inner join cedec_prefeitura
                                                        on cedec_municipio.id_municipio = cedec_prefeitura.id_municipio
							where com_comdec.com_const = 1
							and cedec_municipio.id_municipio <> 7221
							order by cedec_municipio.nome";
			    	
			    	$result = $con->query($sql);
			    	
			    	$result->execute();
			    	    	
			    	while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			    		
			    		$dados[] = $linha;
			    		
			    	}
			    	
			    	return $dados;
			    	
		    }catch (Exception $e) {
		    	print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');	
		    }
	}

	/** Pega os telefones dos coordenadores */
	public function getTelCoordenador($id_municipio){

		$dados = array();
		$con = Conexao::getInstance();
			
	    	try {
				$sql = "select telefone, celular, funcao
						from com_eq_comdec
						where id_municipio = :id_municipio";
						
				$result = $con->prepare($sql);
				$result->bindValue(':id_municipio', $id_municipio);
				$result->execute();			

				while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
					if(isset($linha['funcao']) && strtolower($linha['funcao']) == "coordenador") {
						$dados = $linha['telefone']."/".$linha['celular'];
						return $dados;
					}
				}

				

			}catch (Exception $e) {
				print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');	
			}

	}


    public static function listaCompdecWebService() {
            
        /*select id_comdec,
                cedec_municipio.nome,
                com_comdec.endereco,
                com_comdec.fone_com1,
                com_comdec.fone_com2
                from com_comdec
                inner join cedec_municipio
                on com_comdec.id_municipio = cedec_municipio.id_municipio
                where com_comdec.num_lei <> 0
                order by cedec_municipio.nome        */
    
    return "relatorio Gerado !";
    
    }
    
    
    /**
     * 
     * 
     * 
     */
    public static function dadosCompdec($id_municipio){
    	
    	
    	$dados = array();
    	
    	
	    	$con = Conexao::getInstance();
	    	
	    	try {
	    	
			    	$sql = "SELECT com_comdec.id_comdec,
								com_comdec.endereco
									FROM com_comdec
										INNER JOIN pip_pmda
											ON pip_pmda.id_municipio = com_comdec.id_municipio
												WHERE pip_pmda.id_municipio = :id_municipio limit 1";
			    	
			    	$result = $con->prepare($sql);
			    	$result->bindValue(":id_municipio", $id_municipio);
			    	$result->execute();
			    	
			    	    	
			    	while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
			    		
			    		$dados = $linha;
			    		
			    	}
			    	
			    	return $dados;
			    	
		    }catch (Exception $e) {
    	
		    	print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
		    	
		    }
		    
    }
    
    
    /**
     * Altera existencia e compdec
     */
    public function existeCompdec($existente, $id_municipio){
    	 
    	$dados = array();
 
    	$con = Conexao::getInstance();
    
    	try {
    
    		$sql = "update com_comdec set com_const = :existente
    					where id_municipio = :id_municipio";
    
    		$result = $con->prepare($sql);
    		$result->bindValue(":existente", $existente);
    		$result->bindValue(":id_municipio", $id_municipio);
    		$result->execute();
   
    		print true;
    
    	}catch (Exception $e) {
    		 
    		print FuncaoBase::getError($e->getMessage(), 'Erro Mudar situacao compdec');
    		 
    	}
    
	}
	

	# busca quem esta com compdec ativo
	
/*	select cedec_municipio.nome, com_comdec.com_const, com_comdec.sem_portaria, com_comdec.sem_decreto
from com_comdec
inner join cedec_municipio 
on cedec_municipio.id_municipio = com_comdec.id_municipio
where com_comdec.com_const = 1
or com_comdec.sem_decreto = 0
or com_comdec.sem_portaria = 0*/
    
    
    /**
     * 
     * 
     * 
     */
    public static function DadosResumoCompdec(){
    
    	$dados = array();
    	
    	$con = Conexao::getInstance();
    	
    	try {
    	
    		$sql = "select com_const, com_ativa, nudec, cartao_pdc, plano_cont, mapeamento, capacitacao from com_comdec where id_municipio <> '7221'";
    		
    		$result = $con->query($sql);
   	
    		 
    		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    			 
    			$dados[] = $linha;
    			 
    		}
    	
    		return $dados;
    	
    	}catch (Exception $e) {
    		 
    		print FuncaoBase::getError($e->getMessage(), 'Erro ao buscar Registro');
    		 
    	}

    }
    
}?>