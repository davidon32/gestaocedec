<?php 

class Relatorio {

	private static $d_relbb;
	
	private static $d_relgeral;
	
	private static $d_relCont;
	
	private static $d_resumo;
	
	#@ dados do relatorio de conferencia 
	private static $_d_rel_conf; 
	
	private static $_d_cons;
	
	private static $rel_pgto;
	
	#@ relatorio do banco do brasil baseado no mes 
	function RelatorioBB($_mes) {
			
		$sql ="select m.nome as 'motorista', m.cpf_cnpj, m.conta, m.agencia, co.liquido, m.mae
			from pip_motorista m
			inner join pip_conta co
			on co.id_motorista = m.id_motorista
			where co.mes = {$_mes}";
			
		$result = mysql_query($sql) or die (mysql_error());

		while ($linha = mysql_fetch_array($result)) {
				
			self::$d_relbb[] = $linha;
				
		}

		return self::$d_relbb;

	}

	#@ relatorio geral de impostos
	function RelatorioGeralImpostos($_mes = false, $_lote = false, $_dt_acerto = false, $_ano = false) {
		
		$con = Conexao::getInstance();
		
		$_filtro = '';
		
		#@ opcao 2 normal, mes, ano
		if(($_mes != false) && ($_ano != false)){
		
			$_filtro = ' where co.mes = "'.$_mes.'" and co.ano = "'.$_ano.'"';
		
		}
		
		#@  opcao 1 normal, mes, ano, lote 
		if(($_mes != false) && ($_lote != false) && ($_ano != false)){
			
			$_filtro = ' where co.mes = "'.$_mes.'" and co.ano = "'.$_ano.'" and co.lote = "'.$_lote.'"';
			
		}

		// $sql ="select m.nome, m.cpf_cnpj, co.mes, co.valor, co.irrf, co.inss, co.sestsenat, co.gfip, co.liquido, m.pis_pasep, co.placa, co.km  
				// from pip_conta co
				// inner join pip_motorista m
				// on m.id_motorista = co.id_motorista
				// ".$_filtro." order by m.nome";
                
        $sql ="select m.nome, m.cpf_cnpj, co.mes, co.valor,
                co.irrf, co.inss, co.sestsenat, co.gfip,
                co.liquido, m.pis_pasep, co.placa, co.km,
                ca.capacidade, ro.nome as nrota,
                co.capacidade as capacidadeconta,
                co.momento as momentoconta   
                from pip_conta co
                inner join pip_motorista m
                on m.id_motorista = co.id_motorista
                inner join pip_contrato c
                on co.id_contrato = c.id_contrato
                inner join pip_caminhao ca
                on c.id_caminhao = ca.id_caminhao
                inner join pip_rota ro
                on c.id_rota = ro.id_rota
                ".$_filtro." order by m.nome";

		//print $sql;
		
        		$result = $con->query($sql);
	
					while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
	
						self::$d_relgeral[] = $linha;
	
					}
	
					return self::$d_relgeral;
	
	}
	
    #@ relatorio geral contas pj 
    function RelatorioContasPj($_mes = false, $_lote = false, $_ano = false, $_individual = false) {
        
        $_filtro = '';

        #@ opcao 2 normal, mes, ano
        if(($_mes != false) && ($_ano != false) && (!$_individual )){
        
            $_filtro = ' where pip_conta_pj.mes = "'.$_mes.'" and pip_conta_pj.ano = "'.$_ano.'"';
        
        }
        
        #@  opcao 1 normal, mes, ano, lote 
        if(($_mes != false) && ($_lote != false) && ($_ano != false)){
            
            $_filtro = ' where pip_conta_pj.mes = "'.$_mes.'" and pip_conta_pj.ano = "'.$_ano.'" and pip_conta_pj.lote = "'.$_lote.'"';
            
        }
      
        $sql = "select pip_conta_pj.id_conta as id_conta,
                pip_motorista.nome as nome,
                pip_motorista.cpf_cnpj as cpf_cnpj,
                pip_conta_pj.placa as placa, 
                pip_conta_pj.mes as mes, 
                pip_conta_pj.ano as ano, 
                pip_conta_pj.capacidade as capacidade, 
                pip_conta_pj.momento as momento,
                pip_rota.nome as nomerota,
                pip_rota.num_rota as num_rota,
                pip_conta_pj.km as km,  
                pip_conta_pj.valor as valor,
                pip_conta_pj.lote as lote
                from pip_conta_pj
                inner join pip_motorista
                on pip_conta_pj.id_motorista = pip_motorista.id_motorista
                inner join pip_contrato
                on pip_contrato.id_contrato = pip_conta_pj.id_contrato
                inner join pip_rota
                on pip_contrato.id_rota = pip_rota.id_rota
                ".$_filtro." order by pip_motorista.nome";
                
       
        //print $sql;

                    $result = mysql_query($sql) or die (mysql_error());
    
                    while ($linha = mysql_fetch_array($result)) {
    
                    self::$d_relgeral[] = $linha;
    
                    }
    
                    return self::$d_relgeral;
    
    }

    
	#@ relatorio geral de contrato
	function listaContratoGeral($_tipo = false){
		
		if($_tipo == false) {
			
			$filtro = '';
			
		}else {
			
			$filtro = 'where c.situacao = "'.$_tipo.'"';
		}
				
			$sql = 'select c.num_contrato, m.nome, m.cpf_cnpj, m.placa, c.data_contrato, c.situacao
					from pip_contrato c
					inner join pip_motorista m
					on c.id_motorista = m.id_motorista
					'.$filtro.'
					order by m.nome';
					
			//print $sql;
					
			$result = mysql_query($sql) or die (mysql_error());
			
			while ($linha = mysql_fetch_array($result)) {
				
				self::$d_relCont[] = $linha;
				
			}
			
			return self::$d_relCont;			
					
	}
	
	#@ relatorio de contrato por número de contrato
	function RelatorioContratoPorNumContrato($num_contrato) {
	    
	    $dados = array();
	    
	    $sql = 'select m.nome as "nome_motorista", m.cpf_cnpj, m.pis_pasep, c.num_contrato, c.data_contrato, c.situacao, c.obs,
                ca.placa, ca.modelo, ca.marca, ca.ano, ca.chassi, ca.renavam, ca.capacidade, r.nome as "Nome Rota", r.momento,
                r.id_municipio, r.num_rota, mu.nome as nome_municipio
                from pip_contrato c
                inner join pip_motorista m
                on c.id_motorista = m.id_motorista
                inner join pip_caminhao ca
                on c.id_caminhao = ca.id_caminhao
                inner join pip_rota r
                on c.id_rota = r.id_rota
                inner join cedec_municipio mu
                on r.id_municipio = mu.id_municipio 
                where c.num_contrato = '.$num_contrato;
	    
	    //print $sql;
	        
	    $result = mysql_query($sql) or die (mysql_error());
	    
	    $linha = mysql_fetch_assoc($result);
	    
	    $dados = $linha;
	    
	    return $dados;
	}

	function RelatorioConferencia($_mes = false, $_ano = false, $_dt_acerto = false){
		    
  
		#@ todas as Contas
		if(($_mes == false) && ($_dt_acerto == false)){
			
			$_filtro = ' ORDER BY pip_motorista.nome';
		}
		
		#@ filtro mes e data acerto
		if(($_mes != false) && ($_dt_acerto != false)){
				
			$_filtro = ' WHERE pip_conta.mes = '.$_mes.' AND pip_conta.data = "'.$_dt_acerto.'" ORDER BY pip_motorista.nome';
		}

		#@ filtro mes
		if(($_mes != false) && ($_dt_acerto == false)) {
			
			$_filtro = ' WHERE pip_conta.mes = '.$_mes.' ORDER BY pip_motorista.nome';
			
		}

		#@ data acerto
		if(($_mes == false) && ($_dt_acerto != false)){
			
			$_filtro = ' WHERE pip_conta.data = "'.$_dt_acerto.'" ORDER BY pip_motorista.nome'; 
			
		}

		#@ mes e ano
		if(($_mes != false) && ($_ano != false)){

			$_filtro = ' WHERE pip_conta.mes = "'.$_mes.'" AND pip_conta.ano = "'.$_ano.'" AND pip_contrato.situacao = "A" ORDER BY pip_conta.lote, pip_motorista.nome'; 

		} 
		
		$sql ='SELECT pip_motorista.nome,
                pip_motorista.cpf_cnpj,
                pip_conta.placa,
                pip_conta.capacidade,
                pip_conta.km,
                pip_rota.nome as nomeRota,
                pip_rota.num_rota,
                pip_conta.valor,
                pip_conta.inss,
                pip_conta.sestsenat,
                pip_conta.gfip,
                pip_conta.liquido
                FROM pip_contrato
                INNER JOIN pip_motorista
                on pip_contrato.id_motorista = pip_motorista.id_motorista
                INNER JOIN pip_conta
                ON pip_contrato.id_motorista = pip_conta.id_motorista
                INNER JOIN pip_rota
                ON pip_contrato.id_rota = pip_rota.id_rota '.$_filtro;
		
		//print $sql;
		
		$result = mysql_query($sql) or die (mysql_error());
		
		while ($linha = mysql_fetch_array($result)) {
			
			self::$_d_rel_conf[] = $linha;
		}
			
		return self::$_d_rel_conf;
	
	}
	
	
	/*function function_name($_placa) {
		$sql = 'select c.placa, m.nome, c.mes
				from pip_conta c
				inner join pip_motorista m
				on c.id_motorista = m.id_motorista
				where c.placa = '.$_placa;
		
		print $sql;*/
		
		#@ consulta de calculos lancados 
		
	function consultaConta($_placa) {
	
		$sql = 'select c.placa, m.nome, c.mes
				from pip_conta c
				inner join pip_motorista m
				on c.id_motorista = m.id_motorista
				where c.placa = "'.$_placa.'"';
			
		//print $sql;
		
		$result = mysql_query($sql) or die (mysql_error());
		
		while ($linha = mysql_fetch_array($result)){
		
			self::$_d_cons[] = $linha;
		
		}
		
		return self::$_d_cons;
		
	}
	
	#@ resumo de Contas para pagamento
	function resumoContas($_dt_inicial = false, $_dt_final = false) {
	
		$sql = 'select sum(valor), sum(irrf), sum(sestsenat), sum(gfip), sum(liquido), sum(inss)
				from pip_conta where data between "'.$_dt_inicial.'" and "'.$_dt_final.'"';
			
		//print $sql;
		
		$result = mysql_query($sql) or die (mysql_error());
		
		while ($linha = mysql_fetch_array($result)){
		
			self::$d_resumo[] = $linha;
		
		}
		
		return self::$d_resumo;
		
	}
	
	
	#@ procura registro que nao está dentro outra tabela 
	/*
	 * filtro PF, 
	 * 
	 * 	*/
	function buscaFaltaPagamento($mes = false) {
		
		$ano = getdate();
		
		var_dump(FuncaoBase::UltimoDiaMes($mes));
		
		$dia = FuncaoBase::UltimoDiaMes($mes);
		
		$mes < 10 ? $mes = '0'.$mes : $mes;
		
		$dados = array();
		
		$sql = 'select m.nome, m.placa, m.cpf_cnpj, c.situacao, c.dt_rescisao
				from pip_motorista m
		        inner join pip_contrato c
		        on c.id_motorista = m.id_motorista
				where m.placa not in (select placa from pip_conta where mes = '.$mes.')
				and m.pessoa = "pf" 
				and data_contrato <= "'.$ano['year'].'-'.$mes.'-'.$dia.'"           
				order by m.nome;' ;
			
		print $sql;
		
		$result = mysql_query($sql) or die (mysql_error());
		
		while ($linha = mysql_fetch_array($result)){
		
			$dados[] = $linha;
		
		}
		
		return $dados;
		
	}

	
	#@ relatorio de cadastro de motorista 
	function RelatorioCadastroMotorista($cpf = false, $nome = false){

		$dRelMotorista = array();
		
		if($cpf == false && $nome == false) {
			
			$filtro = "'";
			
		}elseif($cpf != false && $nome == false){ 
			$filtro = 'where cpf_cnpj = "'.$cpf.'"';
		
		
		}elseif ($nome != false && $cpf == false) {
			
			$filtro = 'where nome like "%'.$nome.'%"';
			
		}

		$sql = 'SELECT id_motorista, nome, endereco, bairro, cidade, email, cep, uf, tel, cel, cpf_cnpj,
		rg, orgao, inscr_est, pis_pasep, cnh, inss, inscr_mun, nit, banco, agencia, conta, tipo,
		mbanco, pessoa, nome_rep, cpf_rep, rg_rep, orgao_rep, est_civil_rep, natural_rep, pai, mae,
		placa, dt_nasc
		FROM pip_motorista '.$filtro;

		//print $sql;
		
		$result = mysql_query($sql) or die(mysql_error());
		
		while ($linha = mysql_fetch_array($result)) {
			
			$dRelMotorist[] = $linha;
		}
		
		return $dRelMotorist;
	}
		
	
	#@ relatorio consulta pagamento pipeiro individual
	function RelPagto($placa = false, $nome = false) {
		
		try {
		
			$con = Conexao::getInstance();
		
			$filtro = '';
				
			if($placa) {
		
					$filtro = 'c.placa = "'.$placa.'"';
				}
			
				if($nome){
			
					$filtro = 'm.nome like "%'.$nome.'%"';
			
				}
		
				
				$sql = 'select m.nome, c.inss, c.data, c.mes, c.km, c.irrf, c.sestsenat, c.gfip, c.liquido, c.valor, c.placa
					from pip_conta c
					inner join pip_motorista m
					on c.id_motorista = m.id_motorista
					where '.$filtro;
				
				//print $sql;
		
				$result = $con->query($sql);
				
				while($linha = $result->fetch(PDO::FETCH_ASSOC)){
					
					self::$rel_pgto[] = $linha;
					
				}
				
				return self::$rel_pgto;
		
		}catch (Exception $e){
			
			print $e->getMessage();
			
		}

		}
	
		
		#@ relatorio para dirf ( DPCA )
		function relDirf($_ano){
			
			try {
			
				$con = Conexao::getInstance();
					
				$dados = array();
					
				$sql = "select distinct m.cpf_cnpj, m.nome
						from pip_conta c
						inner join pip_motorista m
						on c.id_motorista = m.id_motorista
						where ano = :ano
						order by m.nome";
				
					
				//print $sql;
					
				$result = $con->prepare($sql);
				$result->bindParam(":ano", $_ano);
				$result->execute();
					
				while($linha = $result->fetch(PDO::FETCH_ASSOC)){
			
					$dados[] = $linha;
			
				}
					
				return $dados;
				
			}catch (Exception $e){
				
				print $e->getMessage();
			}
				
				
		}
        
        #@ relatorio para dirf DADM prestacao de conta
        function relDirfPrestConta($_ano){
        	
        	try{
        		
        		$con = conexao::getInstance();
                
	            $dados = array();
	                
	            $sql = "select distinct m.cpf_cnpj, m.nome,
	                    m.pis_pasep
	                    from pip_conta c
	                    inner join pip_motorista m
	                    on c.id_motorista = m.id_motorista
	                    where ano = :ano
	                    order by m.nome";
	            
	            $result = $con->prepare($sql);
	            $result->bindParam(":ano", $_ano);
	            $result->execute();
	            
	            while($linha = $result->fetch(PDO::FETCH_ASSOC)){
	        
	                $dados[] = $linha;
	        
	            }
	                
	            return $dados;
	            
        	}catch (Exception $e){
        		
        		print $e->getMessage();
        	}
                
                
        }
		
	#@ retorna as contas para relatorio do dirf
		function contasDirf($_cpf, $_ano){
			
			try{
				$con = Conexao::getInstance();
				
				$dados = array();
				
				$sql = "select conta.valor,
				               round(conta.valor *0.4,2) as s_contr,
				               conta.inss,
				               conta.irrf,
				               conta.liquido,
				               conta.pgto,
				               conta.mes,
				               conta.sestsenat,
				               conta.gfip,
				               motorista.cpf_cnpj,
				               conta.id_conta,
				               rota.nome as nrota
						           from pip_conta conta
						               inner join pip_motorista motorista
						               on conta.id_motorista = motorista.id_motorista
						               inner join pip_contrato contrato
	                                   on conta.id_contrato = contrato.id_contrato
	                                   inner join pip_rota rota
	                                   on contrato.id_rota = rota.id_rota
						               where conta.ano = :ano
						               and motorista.cpf_cnpj = :cpf";
				
				$result = $con->prepare($sql);
				$result->bindParam(":ano", $_ano);
				$result->bindParam(":cpf", $_cpf);
				$result->execute();
					
				while($linha = $result->fetch(PDO::FETCH_ASSOC)){
				
					$dados[] = $linha;
				
				}
					
				return $dados;
				
			}catch (Exception $e){
				
				print $e->getMessage();
			}
			
		}

		
		#@ retorna as contas para relatorio DPCA modelo 2
		static function contasDPCA2($_cpf, $mes = 0){
				
			$filtro = '';
				
			if($mes > 0) {
		
				$filtro = ' and c.mes = '.$mes;
		
			}
				
			$dados = array();
				
			$sql = 'select c.valor, c.inss, c.irrf, c.liquido, c.pgto, c.mes, c.sestsenat, c.gfip, c.id_conta
			from pip_motorista m
			inner join pip_conta c
			on m.id_motorista = c.id_motorista
			where m.cpf_cnpj = "'.$_cpf.'"'.$filtro;
				
			//print $sql;
				
			$result = mysql_query($sql) or die(mysql_error());
		
			while($linha = mysql_fetch_assoc($result)){
					
				$dados[] = $linha;
					
			}
		
			return $dados;
				
		}
		
	#@ relatorio total pagamento anual pipeiro
	function totalPagoAnual($ano = false, $opcao = 1) {
		    
		    $dados = array();
		    
		    $sql = "";
		    
		if($opcao == 1) {
		    
		    $sql = "select c.id_motorista,m.nome, sum(c.valor) as Pagamento, c.ano
		    from pip_conta c
		    inner join pip_motorista m
		    on c.id_motorista = m.id_motorista
		    group by c.id_motorista, c.ano
		    having c.ano = \"".$ano.
		    "\" order by m.nome";
		    
		    //print $sql;
		    
		} elseif ($opcao == 2) {
		    
		    
		    
		}  
		
		$result = mysql_query($sql) or die (mysql_error());
		
		while ($linha = mysql_fetch_array($result)) {
		
		    $dados[] = $linha;
		}
		
		return $dados;
		
		    
	}
    
    
    #@ RELATORIO DE CONFERENCIA DE LANCAMENTO DE VALORES NO SISTEMA DE PIPEIRO
    function RelConfLancamento($mes, $ano){
    
        $sql = 'select r.nome as Rota, r.num_rota, ca.placa, ca.capacidade, co.km
                from pip_contrato c
                inner join pip_rota r
                on c.id_rota = r.id_rota
                inner join pip_caminhao ca
                on c.id_caminhao = ca.id_caminhao
                inner join pip_conta co
                on c.id_contrato = co.id_contrato
                where co.mes = "'.$mes.'" and co.ano = "'.$ano.'"
                order by co.id_conta'; 
    
    
    }

    #@ Relatorio de Considerações de Despesas
    function ConsideracaoDespesa($_mes, $_ano, $cpf = false) {

    		$dados = array();
            
            $filtro = ($cpf) ? " and pip_motorista.cpf_cnpj =\"".$cpf." \" " : ""; 

		    $sql = "select pip_conta.id_conta as 'num_rpa',
		                   pip_conta.inss,
		                   pip_conta.sestsenat,
		                   pip_conta.irrf,
		                   pip_conta.liquido,
		                   pip_conta.valor,
		                   pip_contrato.num_empenho,
		                   pip_contrato.dt_empenho,
		                   pip_motorista.nome,
		                   pip_motorista.cpf_cnpj,
		                   pip_contrato.num_contrato,
		                   pip_contrato.ano
			from pip_contrato
			inner join pip_conta
			on pip_contrato.id_contrato = pip_conta.id_contrato
			inner join pip_motorista
			on pip_contrato.id_motorista = pip_motorista.id_motorista
			where pip_conta.mes = ".$_mes." and pip_conta.ano ='".$_ano."'
			".$filtro."
			order by pip_motorista.nome";

		$result = mysql_query($sql) or die(mysql_error());

		while ($linha = mysql_fetch_array($result)) {
			
			$dados[] = $linha;
		}

		return $dados;

    }


    #@ relatorio DADM
    function RelatorioDadm($_mes = false, $_ano = false){
    	
    	try{
    		
    	
	    	$con = Conexao::getInstance();
	
	    	$_filtro = '';
	
	    	if(($_mes != false) && ($_ano != false)){
	
	    		$_filtro = "where c.mes = ".$_mes." and c.ano = ".$_ano." ";
	
	    	}elseif (($_mes == false ) && ($_ano != false)){
	    		
	    		$_filtro = "where c.ano = ".$_ano." ";
	    	}
	
	    	$_dados = array();
	
	    	$sql = "select c.id_conta,
	    				   co.num_empenho,
	    				   m.nome,
	    				   c.km,
	    				   m.cpf_cnpj,
	    				   c.placa,
	    				   c.inss,
	    				   c.irrf,
	    				   c.sestsenat,
	    				   c.gfip,
	    				   c.liquido,
	    				   c.valor
						   from pip_conta c
						   inner join pip_contrato co
						   on c.id_contrato = co.id_contrato
						   inner join pip_motorista m
						   on c.id_motorista = m.id_motorista ".$_filtro." 
						   order by m.nome";
	
			$result = $con->query($sql);
			
	
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
	
				$_dados[] = $linha;
				
			}
	
			return $_dados;

    	}catch (Exception $e){
    		
    		print $e->getMessage();
    		
    	}
    }


    #@ relatorio de contratos
    function RelatorioGeralContratoResumido($_situacao, $_ano, $_ordem){
        
        switch ($_ordem) {
            
            case 0:
                $_ordem = 'm.nome';
            break;
            case 1:
                $_ordem = 'ca.placa';
            break;
            case 2:
                $_ordem = 'r.nome, r.num_rota';
            break;
           
        }

        $dados = array();
        $filtro = "";

        if(strlen($_situacao) > 0){

            $filtro = "WHERE c.situacao = '".$_situacao."' AND c.ano = '".$_ano."' ORDER BY ".$_ordem."";

        }else {

            $filtro = "WHERE c.ano = '".$_ano."' ORDER BY ".$_ordem."";
        }

        $sql = "SELECT c.num_contrato as num_contrato,
                        c.num_empenho as num_empenho,
                        m.nome as nome,
                        m.cpf_cnpj as cpf_cnpj,
                        c.data_contrato as data_contrato,
                        c.situacao as situacao,
                        ca.placa as placa,
                        r.nome as rota,
                        c.ano as ano,
                        r.num_rota as numRota,
                        ca.capacidade as capacidade,
                        m.pessoa as pessoa 
                        FROM pip_contrato c
                        inner join pip_motorista m
                        on c.id_motorista = m.id_motorista
                        inner join pip_caminhao ca
                        on c.id_caminhao = ca.id_caminhao
                        inner join pip_rota r
                        on c.id_rota = r.id_rota
                        ".$filtro."";

                        //print $sql;

        $result = mysql_query($sql) or die (mysql_error());

        while ($linha = mysql_fetch_array($result)) {

            $dados[] = $linha;
        }

        return $dados;

    }
		
		
		
}?>