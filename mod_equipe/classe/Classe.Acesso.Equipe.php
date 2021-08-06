<?php
/*	Classe para Controle de Acesso de Usuários do Modulo Equipe de Apoio
 * 
 * 
 * 
 * 
 * 
 * 
 * */
class AcessoEquipe {
				
		static function acessoMenu($_login) {
			
			$sql = 'SELECT login,
			               cad_funcionario,
			               relatorio,
			               dsp,
			               cad_banco,
                           usuario
			               FROM equ_permissao where login ="'.$_login.'"';
			
			//print $sql;
			try{
			
    			$con = Conexao::getInstance();
    			
    			$result = $con->prepare($sql);
    			
    			$result->bindValue(':login', $_login, PDO::PARAM_STR);
    			
    			$result->execute();
    			
    			while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
                        			
                        #@ cadastro de funcionario
                        if($linha['cad_funcionario'] == 1){
                        
                        	print  "<li class='dropdown-submenu'>
                        				<a href='#'>Cadastro</a>
                        				<ul class='dropdown-menu'>
                        					<li class='dropdown-submenu'>
                        						<a href='#'>Funcionario</a>
                        					    <ul class='dropdown-menu'>
                        					    	<li><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=funcionario&acao=cadastro'>Cadastrar Funcionario</a></li>
                        					        <li><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=funcionario&acao=buscar'>Alterar</a></li>
                        					    </ul>
                        				    </li>";
                                            if($linha['cad_banco'] == 1){
                                                
                                                print "<li class='dropdown-submenu'>
                                                            <a href='#'>Cadastro Banco</a>
                                                            <ul class='dropdown-menu'>
                                                            <li><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=banco&acao=cadastro'>Cadastrar</a></li>
                                                            <li><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=banco&acao=buscar'>Alterar</a></li>
                                                        </ul>
                                                        </li>";
                        				    }				
                        }
                        
                        #@ cadastro DSP
                        if($linha['dsp'] == 1){
                        
                        	print "<li class='dropdown-submenu'>
                        	<a href='#'>DSP</a>
                        	<ul class='dropdown-menu'>
                        	<li><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=dsp&acao=cadastro' title='Lançamento de DSP'>Cadastro DSP</a></li>
                        	<li><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=dsp&acao=buscar' title='Consulta / Alteração de DSP'>Consulta / Alteração DSP</a></li>
                        	</ul>
                        	</li> ";
                        
                        }
                        				
                        #@ relatorio
                        if($linha['relatorio'] == 1){
                        				
                        	print "<li class='dropdown-submenu'>
                        				<a href='#'>Relatório</a>
                        				<ul class='dropdown-menu'>";
                        				
                        	if((isset($_GET['up'])) && ($_GET['up'] == "u") && (isset($_GET['id']))) {
                        	        
                        	    print "<li><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=relatorio&acao=cadastro&id={$_GET['id']}' title='Visualizar Dados de Funcionario    '>Dados do Funcionario </a></li>";
                        	    
                        	}else {
                        	        
                        	    print "<li><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=relatorio&acao=cadastro' title='Relatorio de Cadastro Geral de Funcionarios    '>Relatorio Geral Funcionários</a></li>";
                        	        
                        	    
                        	}
                            print "
                        					<li><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=relatorio&acao=email' title='Gera um listagem para Enviar email'>Gerar Lista Email (enviar)</a></li>
                        					<li><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=relatorio&acao=listaemail' title='Listagem de Email para Impressão'>Listagem Email (impressão)</a></li>
                        				</ul>
                        			</li> ";
                        						
                        }
                        		
                        	print '</li>';
                        
    			}
			
			
			} catch (Exception $e){
			    
			    return $e->getMessage(). " ";
			}
		}

	
}?>