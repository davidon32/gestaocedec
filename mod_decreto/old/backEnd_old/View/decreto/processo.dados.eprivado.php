<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';
$_login = new Login();

$_login->logado();

$_municipio = new Municipio();

$_processo = new Decretacao();

/* ****************************************************************************************
*   Orgão Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*   Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*   Autor        :  Demetrio Silva Passos
*   Fun��o   :
*
*******************************************************************************************/

$_SESSION['processo'] = array_merge($_SESSION['processo'], $_POST);

//var_dump($_SESSION['processo']);

/* Arranjo para alimentar os campos com dados para alteração de processo */
$_alterar = isset($_GET['id']) ? $_GET['id'] : "";

if($_alterar != "") {

	$_dados = $_processo->BuscaProcessoEPrivado($_alterar);
	
	//var_dump($_dados);
	
	$_eco_priv_agricultura = "value=\"".$_dados[0]['eco_priv_agricul']."\"";
	$_eco_priv_pecuaria    = "value=\"".$_dados[0]['eco_priv_pecuaria']."\"";
	$_eco_priv_industria   = "value=\"".$_dados[0]['eco_priv_industria']."\"";
	$_eco_priv_servico     = "value=\"".$_dados[0]['eco_priv_servico']."\"";
	$_val_eco_priv         = "value=\"".$_dados[0]['val_eco_priv']."\"";
	
	$_parametro            = "&id=";
	
}else {
	
	$_eco_priv_agricultura = "value=\"0\"";
	$_eco_priv_pecuaria    = "value=\"0\"";
	$_eco_priv_industria   = "value=\"0\"";
	$_eco_priv_servico     = "value=\"0\"";
	$_val_eco_priv         = "value=\"0\"";
	
	$_parametro            = "";
	
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<style>
#txt_total_eprivado {
	background-color: #F9B0B0;
	font-weight: bold;
}
</style>
</head>
<body>
	<!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
    <div class="container">

        <!-- MENU -->
        <div class="row-fluid fdo_corpo">
            <div class="span2">
                 <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
                
            </div>
                <div class="span10 fdo_corpo">
                    <?php require_once PATH."/mod_decreto/app/decreto/processo.menu.php";?>

				<legend>Prejuizo Econômico Privado</legend>
				<br>

				<form action="processo.php?secao=pfechar<?php print $_parametro.$_alterar;?>" method="POST" name="frm_eprivado">
				<table>
					<tr>
						<td>Agricultura</td>
						<td>Pecuária</td>
						<td>Indústria</td>
						<td>Serviços</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="txt_agricultura_prej_privado" id="txt_agricultura_prej_privado" class="span8" <?php print $_eco_priv_agricultura;?>/>
						</td>
						<td>
							<input type="text" name="txt_pecuaria_prej_privado" id="txt_pecuaria_prej_privado" class="span8" <?php print $_eco_priv_pecuaria;?>/>
						</td>
						<td>
							<input type="text" name="txt_industria_prej_privado" id="txt_industria_prej_privado" class="span8" <?php print $_eco_priv_industria;?>/>
						</td>
						<td>
							<input type="text" name="txt_servico_prej_privado" id="txt_servico_prej_privado" class="span8" <?php print $_eco_priv_servico;?>/>
						</td>
					</tr>
					<tr>
						<td>Total</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="txt_total_eprivado" id="txt_total_eprivado" class="span8" <?php print $_val_eco_priv;?> readonly="readonly"/>
						</td>
					</tr>
				</table>
			</div>
			<div class="span2"></div>
			<div class="span9 text-center">
				<br>
				<a class="btn btn-primary" href="processo.php?secao=epublico<?php print $_parametro.$_alterar;?>"">Voltar</a>
				<input class="btn btn-primary" type="submit" name="btn_pfechar" id="btn_pfechar" value="Prosseguir">
			</div>

			</form>

		</div>
		<br />
		<br />
		<br />
		<div class="row">
			<div class="span3"></div>
			<div class="span9 text-center">
				<small><?php print RODAPE;?> </small>
			</div>
		</div>
	</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			$( "#aba_eprivado" ).addClass( "active" );

		});

		$(document).ready(function(){

			var agricultura = 0;
			var pecuaria    = 0;
			var industria   = 0;
			var servico     = 0;

			$("input[type=text]").change(function(){

				agricultura = parseFloat($("#txt_agricultura_prej_privado").val());
				pecuaria    = parseFloat($("#txt_pecuaria_prej_privado").val());
				industria   = parseFloat($("#txt_industria_prej_privado").val());
				servico     = parseFloat($("#txt_servico_prej_privado").val());
				
				$("#txt_total_eprivado").val(agricultura+pecuaria+industria+servico);

			});

			
		});
		
    </script>
</body>
</html>
