<?php include_once(PATH.'/core/include.php');

class AcessoCce {

	#@ filtro de acesso ao menu principal do site
	static function acessoMenu($_login) {
	    
	    $con = Conexao::getInstance();
	    
	$sql ='SELECT
			login,
			cad_evento,
			cad_consulta,
			cad_rel,
			cad_diario,
			boletim
			FROM cce_permissao where login = "'.$_login.'"';
		
	//FuncaoBase::vd($sql);
	
	$result = $con->query($sql);
	
	while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {
	    $linha = $dados;
	}
	
	//$linha = mysql_fetch_array($result);
	
	//FuncaoBase::vd($linha);
	
	//var_dump($linha);
	
	#@ Cadastro de eventos adversos
	if($linha['cad_evento'] == 1){
		
	    
		print "<li>
				<a href=\"secao.php?secao=cadastro&acao=ocorrencia\" title=\"Cadastro de Ocorrência Eventos\">Ocorrência</a>
				<li>";
		
	}
    
    #@ Diário do Plantão
    if($linha['cad_diario'] == 1){
        
        
        print "<li>
                <a href=\"index.php?modulo=cce&secao=diario&acao=cadastro\" title=\"Diário do Plantão\">Diário</a>
                <li>";
        
    }
    #@ Diário do Plantão
    if($linha['boletim'] == 1){
    
    
    	print "<li>
                <a href=\"index.php?modulo=cce&secao=boletim&acao=index\" title=\"Lançamento Boletim\">Boletim</a>
                <li>";
    
    }
	
	#@ acesso a consultas de eventos
	if($linha['cad_consulta'] == 1){

			print "<li>
				<a href=\"secao.php?secao=consulta&acao=ocorrencia\" title=\"Consulta a Eventos Ocorridos\" title=\"Consulta de Eventos Ocorridos\">Consulta Evento</a>
				<li>";
		
	}
	
	#@ Relatorios
	if($linha['cad_rel'] == 1){
		
		print "<li>
				<a href=\"index.php?modulo=cce&secao=relatorio&acao=filtrodiario\" title=\" Impressão de Relatorios\">Relatórios</a>
				</li>";
		
	}

	
}


#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
#@ filtro de acesso ao relatório do sistema
function acessoRel($_login) {

	# item do relatórios do sistema

	#@ Tela de relatorio posicao geral dos depositos
	$item_rel_pos_geral = "<a href=\"javascript:NovaJanela('sc.consulta.SaldoEstoque.php')\">- Posi&ccedil;&atilde;o Geral do Estoque</a>";

	#@ tela de relatorio posicao geral filtrado por deposito
	$item_rel_pos_dep = "<a href=\"javascript:NovaJanela('sc.consulta.saldo.estoque.por.deposito.php')\">- Posi&ccedil;&atilde;o Saldo por Dep&oacute;sito</a>";
	
	#@ tela de tela de relatório de materiais pagos
	$item_rel_cons_mat_pago = "<a href=\"javascript:NovaJanela('menu.ajuda.php?&secao=cmatp')\">- Consulta Material Pago </a>";
	
	#@ tela de relatórios de recebimento de materiais
	$item_rel_recebimento = "<a href=\"javascript:NovaJanela('menu.ajuda.php?&secao=crmt')\">- Recebimento de Materiais</a>";
	
	#@ relatórios de materiais em trânsito
	$item_rel_mat_transito = "<a href=\"javascript:NovaJanela('menu.ajuda.php?secao=cmatt')\">- Consulta Material em Tr&acirc;nsito </a>";
	
	#@ relatórios de Transferencia de Materiais
	$item_rel_transferencia = "<a href=\"javascript:NovaJanela('menu.ajuda.php?&secao=ctrans')\">- Transferencia de Materiais</a>";
	
	#@ relatorio consulta de materiais liberados (liberacoes)
	$item_rel_cons_mat_lib = "<a href=\"javascript:NovaJanela('sc.consulta.liberacao.mat.php')\">- Consulta Material Liberado</a>";
	
	#@ tela de relatório consulta materia esperando pagamento
	$item_rel_cons_mat_espera = "<a href=\"core/sc.consulta.material.espera.pgto.php\">- Consulta Material Esperando Pagamento </a>";
	
	#@ relatorio de material em transito
	$item_rel_cons_mar_transito = "<a href=\"javascript:NovaJanela('menu.ajuda.php?&secao=cmatt')\">- Consulta Material em Tr&acirc;nsito </a>";
	
	#@ relatorio 2 via recibo pagamento
	$item_rel_2via_recibo = "<a href=\"core/sc.segunda.via.recibo.php\">- Segunda Via Recibo de Pagamento de Materiais </a>";
	
	$mostraRel = array($item_rel_pos_geral, $item_rel_pos_dep, $item_rel_cons_mat_pago, $item_rel_recebimento, $item_rel_mat_transito, $item_rel_transferencia, $item_rel_cons_mat_lib, $item_rel_cons_mat_espera,$item_rel_2via_recibo);
	
	
	#@ sql que filtra dos dados de permissao aos cadastros
	
	$sql = "SELECT rel_saldo_geral, rel_saldo_p_deposito, rel_pagmto, rel_transf_mat, rel_mat_transito, " . "rel_liberacao, rel_mat_liberado, rel_mat_espera_pgto, rel_2via_recibo " . "FROM aju_permissao " . "WHERE login = {$_login}";
	
	//print $sql;
	
	$result = mysql_query($sql) or die(mysql_error());
	
	$linha = mysql_fetch_row($result);
	
	# busca os campos de 2 a 9 na tabela do banco que refere-se ao cadastro
	for ($i = 0; $i < count($mostraRel); $i++) {
	
		if ($linha[$i] != 0) {
	
			echo $mostraRel[$i] . "<br />";
	
		}
	
	}
}

}?>