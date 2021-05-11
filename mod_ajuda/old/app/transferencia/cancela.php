<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

$_deposito = new Deposito();

$_controleSaldo = new ControleSaldo();

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
<!--<link rel="stylesheet" type="text/css" href="../../css/estilo.css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="../../js/mascara.js"></script>-->
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</head>

<body>
	<div class="container">
		
		<div class="row-fluid">

			<div class="span6">
				<legend>Cancelar Transferencia de Materiais</legend>
				<form method="POST" action="index.php?modulo=ajuda&secao=transferencia&acao=valida&opcao=cancelar" name="frm_cancela">
		
					<label>Nº Transferência</label>
					<input type="text" name="txt_id_transferencia" id="txt_id_transferencia" title="Número da Transferencia" placeholder="Código Transferência">

					<!--<label>Data</label>
					<input type="text" name="txt_dt_cancela" id="txt_dt_cancela" title="Data do Cancelamento" data-mask="99/99/9999" placeholder="Data de Cancelamento">-->
					
					
					<label>Observação</label>
					<textarea name="txt_observacao" id="txt_observacao" placeholder="Observação"></textarea>
					<br />	
					<input class="btn btn-primary" type="submit" name="btn_enviar" value="Cancelar">
				</form>
			</div>	
		</div>
	</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
</body>
</html>
