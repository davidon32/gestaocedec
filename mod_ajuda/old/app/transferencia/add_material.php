<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

$_deposito = new Deposito();

$_controleSaldo = new ControleSaldo();

$_pedido = new Pedido();

/*****************************************************************************************
 *   Org�o 		: Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        : Demetrio Silva Passos
*	Fun��o       : Adiciona material na cesta para transferencia
*
*******************************************************************************************/


$saldo = new Relatorio();

if(!isset($_SESSION['cesta'])){

	$_SESSION['cesta'] = array();
}



$nProd = new Produto();	
//FuncaoBase::vd($_SESSION);

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/js/funcaobase.js"></script>
</head>

<body style="background-color: #C4E3F3;">
	<div class="container">
		<div class="row">
			<div class="span12 text-center"><legend>Transferência de Materiais entre Depósitos</legend></div>
		</div>
		
		<div class="row-fluid">

			<div class="span6">
				<legend>Adicionar Material</legend>
				<form method="POST" action="#" name="adItem">
		
					<label>Dep&oacute;sito Origem :</label>
					<?php $_deposito->pegaDeposito();?>

					<label>Produto :</label>
					<?php $nProd -> PegaProduto();

					?>
					<input type="hidden" name="la" value="0">
								
					<label>Descrição :</label>
					<input type="text" name="descricao" size="25" value="-">
					
					<label>Quantidade :</label>
					<input type="text" name="qtd" size="25" maxlength="4">
					<br />	
					<input class="btn btn-primary" type="submit" name="acao" value="Adicionar">
				</form>
			</div>
			<div class="span6">
				<legend>Materiais da Transferência</legend>

					<?php $pedido = new Pedido();
						//FuncaoBase::vd($_SESSION);
						#@ mostra os materiais que estao no pedido
						$pedido -> MostraPedido($_SESSION['cesta']);
                        
                        $acao = isset($_POST['acao']) ? $_POST['acao'] : '';
                        $material = isset($_POST['id_produto']) ? $_POST['id_produto'] : '';
                        $qtd = isset($_POST['qtd']) ? $_POST['qtd'] : '';
                        $id_deposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : '';
                        $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
            
            
                        if($acao == 'Adicionar'){
            
                            $campos = array('Acao'=>$acao,
                                            'Material'=>$material,
                                            'Quantidade'=>$qtd,
                                            'Deposito'=>$id_deposito,
                                            'Descrição'=>$descricao);
                            
                            if(FuncaoBase::CampoBranco($campos)){
                
                                #@ Monta o item 
                                $item = $_pedido->Item($id_deposito, $material, $descricao, $qtd);
                            
                                #@ adiciona na cesta 
                                $_pedido->AdicionaItem($item);
                
                            }
                                
                        }
					?>

			</div>
			<div class="row-fluid">
				<legend>Saldo Geral dos Materiais</legend>
				<?php
				 	$_controleSaldo->VisualizarSaldoGeral();?>
			</div>		
		</div>
	</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
</body>
</html>
