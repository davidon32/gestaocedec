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

	$_dados = $_processo->BuscaProcessoAmbiental($_alterar);
	
	//var_dump($_dados);
	
	$_agua_pop_atingida     = "value=\"".$_dados[0]['agua_pop_atingida']."\"";
	$_solo_pop_atingida     = "value=\"".$_dados[0]['solo_pop_atingida']."\"";
	$_ar_pop_atingida       = "value=\"".$_dados[0]['ar_pop_atingida']."\"";
	$_incendio_pop_atingida = "value=\"".$_dados[0]['incendio_pop_atingida']."\"";
	
	$_parametro             = "&id=";
	
} else {
	
	$_agua_pop_atingida     = "";
	$_solo_pop_atingida     = "";
	$_ar_pop_atingida       = "";
	$_incendio_pop_atingida = "";
	
	$_parametro             = "";
	
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

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


				<legend>Danos Ambientais</legend>
				<br>
				
				<form action="processo.php?secao=epublico<?php print $_parametro.$_alterar;?>" method="POST" name="frm_ambiental">
				<table align="center">
					<tr>
						<td align="center">Água</td>
						<td align="center">Solo</td>
						<td align="center">Ar</td>
						<td align="center">Incêncio APA - APP</td>
					</tr>
					<tr>
						<td align="center">População Atingida %</td>
						<td align="center">População Atingida %</td>
						<td align="center">População Atingida %</td>
						<td align="center">População Atingida %</td>
					</tr>
					<tr>
						<td align="center">
							<input type="text" name="txt_agua_pop_atingida" id="txt_agua_pop_atingida" class="span4" <?php print $_agua_pop_atingida;?>/>
						</td>
						<td align="center">
							<input type="text" name="txt_solo_pop_atingida" id="txt_solo_pop_atingida" class="span4" <?php print $_solo_pop_atingida;?>/>
						</td>
						<td align="center">
							<input type="text" name="txt_ar_pop_atingida" id="txt_ar_pop_atingida" class="span4" <?php print $_ar_pop_atingida;?>/>
						</td>
						<td align="center">
							<input type="text" name="txt_incendio_pop_atingida" id="txt_incendio_pop_atingida" class="span4" <?php print $_incendio_pop_atingida;?>/>
						</td>
					</tr>
				</table>
			</div>
			<div class="span2"></div>
			<div class="span9 text-center">
				<br>
				<a class="btn btn-primary" href="processo.php?secao=material<?php print $_parametro.$_alterar;?>"">Voltar</a>
				<input class="btn btn-primary" type="submit" name="btn_ambiental" id="btn_ambiental" value="Prosseguir">
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
			$( "#aba_ambiental" ).addClass( "active" );

		});
		
    </script>
</body>
</html>
