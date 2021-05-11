<?php 

	include_once '../../include.php';
	
	$_conexao = new ConexaoMysql();
	
	//Login::logado();
	
	
	#@ identificador do transito
	$idTransito = isset($_GET['id']) ? $_GET['id'] : null;
	
	#@ identificador do deposito origem
	$idDeposito = isset($_GET['idD']) ? $_GET['idD'] : null;
	
	#@ identificador do produto
	$idProduto = isset($_GET['idP']) ? $_GET['idP'] : null;
	
	#@ quantidade de produtos
	$qtd = isset($_GET['qtd']) ? $_GET['qtd'] : null;
	
	if(is_numeric($idTransito) && (is_numeric($idDeposito)) && (is_numeric($qtd)) && (is_numeric($idProduto))) {
		
		#@ cancelamento de transito colocando a data de chegada e a situacao como "cancelado" na tabela "aju_transito"
		$cancela = GerTransito::cancelaTransito($idTransito);
	
		
		
		#@ credita o saldo para o dep destino 
		$creditaSaldo = ControleSaldo::CreditarSaldo($idProduto, $idDeposito, $qtd);
		
		
		if($cancela && $creditaSaldo) {
			
			LogAjuda::GravaLog('Cancelamento de Material em transito id_transito :'.$idTransito.' Saldo Retorna origem'.$idDeposito.' Produto :'.$idProduto.' Qtd :'.$qtd);
			
			FuncaoBase::alert('Cancelamento realizado com Sucesso');	
			
		}else {
			
			
			FuncaoBase::alert("Erro !");
		}
		
		
	}else {
		
		FuncaoBase::alert("Erro !-");
		
	}

?>