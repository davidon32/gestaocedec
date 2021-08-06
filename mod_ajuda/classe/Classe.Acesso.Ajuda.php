<?php

class AcessoAjuda {

	
    #@ filtro de acesso ao menu principal do site
	static function acessoMenu($_login) {
	    
	$linha = array();

	$sql ='SELECT login, nivel, cad_material, cad_deposito, cad_transferencia, cad_liberacao, cad_ajuda_suporte,
	cad_usuario, cad_conf_ger, relatorio, rel_saldo_geral, rel_saldo_p_deposito, liberacao, rel_comp_liberacao,
	rel_mat_liberado, rel_mat_pago, rel_comp_mat_pago, transferencia, rel_mat_transferido, rel_mat_transito,
	lembrete_libera, lembrete_transito, inicial, cad_deposito, rel_cad_mat, rel_resumo_liberacao
	       FROM aju_permissao where login = "'.$_login.'"';
	
	$result = Conexao::getInstance()->prepare($sql);
	$result->bindValue(":login", $_login);
	$result->execute();
	
    while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {
        
        $linha = $dados;
    }


	#@ liberacao de materiais
	if($linha['cad_liberacao'] == 1){


		print "<li>
		<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=liberacao&acao=liberar\" title=\"Fazer a Liberação de Materiais\">Liberacao</a>
		</li>";

	}

	#@ deposito
	if($linha['cad_deposito'] == 1){

		print "<li class=\"dropdown-submenu\">
				<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" title=\"Pagar e Receber Materiais Liberados e Transferidos\">Depósito</a>
				<ul class=\"dropdown-menu\">
					<li><a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=pagamento&acao=pagamento\" title=\"Pagamento de Materiais Liberados\">Pagamento</a></li>
					<li><a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=recebimento&acao=recebimento\" title=\"Recebimento de Materiais Trânsferidos\">Receb. Material Transf.</a></li>
				</ul>
				</li>";

	}

	#@ cad material
	if($linha['cad_material'] == 1){

		print "<li>
		<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=material&acao=cadastro\" title=\"Cadastro de Materiais\">Cadastro Material</a>
		</li>";

	}

	#@ transferencia de material
	if($linha['cad_transferencia'] == 1){

		print "<li>
		<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=transferencia&acao=transferencia\" title=\"Trânsferência de Material entre Depósitos\">Transf. Material Depósitos</a>
		</li>";
	}

	#@ consultas relatorios
	if($linha['relatorio'] == 1){

		print "<li class=\"dropdown-submenu\">
				<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">Relatórios/ Consultas</a>
			<ul class=\"dropdown-menu\">";
		
	#########################################################################################################
	#																										#
	#										RelatorioS do Sistema   										#
	#																										#
	#########################################################################################################

		#@ acesso ao menu relatorio do sistema
		if($linha['liberacao'] == 1){

			print "	<li class=\"dropdown dropdown-submenu\">
						<a href=\"#\">Liberação</a>
						<ul class=\"dropdown-menu\">
							";
							#@ saldo geral dos depósitos
							if($linha['rel_saldo_geral'] == 1){
									
								print "<li class=\"dropdown\">
										<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=relatorio&acao=rel_saldo_geral\" title=\"Saldo Geral dos Depósitos Avançados\">Posi&ccedil;&atilde;o Geral do Estoque</a>
										</li>";
							}
							#@ relatorio de	saldo por depósito
							if($linha['rel_saldo_p_deposito'] == 1){
								 
								print "<li class=\"dropdown\">
										<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=relatorio&acao=rel_saldo_deposito\" title=\"Saldo por Depósito Avançado\">Posi&ccedil;&atilde;o Saldo por Dep&oacute;sito</a>
										</li>";
							}
							#@ 2ª via do comprovante de liberacao
							if($linha['rel_comp_liberacao'] == 1){
								 
								print "<li class=\"dropdown\">
										<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=relatorio&acao=rel_segunda_via_liberacao\" title=\"Reimpressão do Comprovante de Liberação\">2ª Via Liberação</a>
										</li>";
							}
							#@ relatorio materiais liberados (liberacoes)
							if($linha['rel_mat_liberado'] == 1){
				
								print "<li>
										<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=liberacao&acao=busca_rel_mat_liberado\" title=\"Histórico de Liberações Efetuadas\">Material Liberado</a>
										</li>";
							}
							#@ relatório materiais pago
							if($linha['rel_mat_pago'] == 1){
								
								print "	<li>
										<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=pagamento&acao=list_pgto_busca\" title=\"Histórico de Pagamento de Materiais \">Material Pago </a>
										</li>";
							
							}
							#@ 2 via recibo pagamento
							if($linha['rel_comp_mat_pago'] == 1){
				
								print "<li>
										<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=pagamento&acao=recibo_pgto_busca\" title=\"2ª Via do Recibo de Pagamento de Materiais\">2º Via Recibo Pgto Material </a>
										</li>";
							}
                            
                            #@ resumo de liberacoes
                            if($linha['rel_resumo_liberacao'] == 1){
                
                                print "<li>
                                        <a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=liberacao&acao=rel_busca_resumo\" title=\"Resumo de Liberações\">Resumo de Liberações </a>
                                        </li>";
                            }
						
			print "		</ul>
					</li>";
			}
			#@ acesso ao menu relatorio do sistema
			if($linha['transferencia'] == 1){

				print "	<li class=\"dropdown dropdown-submenu\">
						<a href=\"#\">Transferencia</a>
						<ul class=\"dropdown-menu\">";


				#@ relatorio transferencia
				if($linha['rel_mat_transferido'] == 1){
				
					print "<li>
							<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=transferencia&acao=busca_rel_mat_transferido\" title=\"Transferência de Materiais entre Depósitos\">Material Transferido</a>
							</li>";
				}
				#@ relatórios de materiais em trânsito
				if($linha['rel_mat_transito'] == 1){
	
					print "<li>
							<a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=relatorio&acao=rel_material_transito\" title=\"\">Relatório de Materiais em Tr&acirc;nsito </a>
							</li>";
				}

			print "		</ul>
					</li>";
			}
            #@ relatórios Cadastro de Materiais
                if($linha['rel_cad_mat'] == 1){
    
                    print "<li>
                            <a href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&secao=material&acao=busca_cadastro\" title=\"Relatorio de Cadastro de Materiais\">Cadastro de Material </a>
                            </li>";
                }
            
				
								
				
		print "</ul></li>";
		}
	}

	
}?>