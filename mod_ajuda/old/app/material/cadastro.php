<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

/* ****************************************************************************************
 *   Orgão 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanitária
*
*	Autor        :  Demetrio Silva Passos
*	Função       :  Tela para Pagamento de Materiais Liberados
*
*******************************************************************************************/

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->Logado();

$_login->Sessao();

//FuncaoBase::vd($_SESSION);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/js/funcaobase.js"></script>
</head>

<body>
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
	<div class="container">
		
		<!-- MENU -->
		<div class="row-fluid">
			<div class="span3">
			    <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
				<div class="span9">

					<legend> Cadastro de Materiais </legend>

					<form method="POST" name="frm_cadastro_material" action="index.php?modulo=ajuda&secao=material&acao=valida">
						
						<label>Nome</label>
						<?php Produto::PegaProduto();?>

						<label>Data Entrada</label>
						<input name="txtDtEntrada" type="text" data-mask="99/99/9999" value="<?php echo date('d/m/Y'); ?>" />
						
						<label>Origem</label>
						<select name="txtOrigem" id="txtOrigem">
							<option></option>
							<option>CEDEC</option>
							<option>Conab</option>
							<option>Ministério da Integração</option>
							<option>Servas</option>
							<option>Outros</option>
						</select>

						<label>Validade</label>
						<input name="txtValidade" type="text" id="txtValidade" data-mask="99/99/9999"/>

						<label>Quantidade</label>
						<input name="txtQtd" type="text" id="txtQtd" />
						
						<label>Dep&oacute;sito Avan&ccedil;ado:</label>
						<?php Deposito::pegaDeposito();?>

						<label>Observa&ccedil;&otilde;es:</label>
						<textarea name="txarObs" id="txarObs" cols="30" rows="4"></textarea>
						<br />

						<input class="btn btn-primary" type="submit" onclick="return confirm('Confirmar Cadastro Material?')"  name="btnCadMaterial" id="btnCadMaterial" value="Cadastrar"/>
					</form>


				</div>
		<div class="row-fluid">
			<div class="span12 text-center"><?php print RODAPE;?></div>
		</div>
		<script src="/js/jquery.js"></script>
		<script src="/js/bootstrap.js"></script>
		<script src="/js/jasny-bootstrap.js"></script>

</body>
</html>