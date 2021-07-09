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
*   Sistema       : Sistema de Gest�o de Ajuda Humanit�ria
*
*   Autor         :  Demetrio Silva Passos
*   Fun��o        :
*
******************************************************************************************/

$_SESSION['processo'] = array_merge($_SESSION['processo'], $_POST);

//var_dump($_SESSION['processo']);

/* Arranjo para alimentar os campos com dados para alteração de processo */
$_alterar = isset($_GET['id']) ? $_GET['id'] : "";

if($_alterar != "") {

	$_dados = $_processo->BuscaProcessoHumano($_alterar);
    
    $_val_total = ($_dados[0]['morto']      +
                   $_dados[0]['ferido']     +
                   $_dados[0]['enfermo']    +
                   $_dados[0]['desabrigado']+
                   $_dados[0]['desalojado'] +
                   $_dados[0]['outro']      +
                   $_dados[0]['afetado']);

	$_morto       = "value=\"".$_dados[0]['morto']."\""      ;
	$_ferido      = "value=\"".$_dados[0]['ferido']."\""     ;
	$_enfermo     = "value=\"".$_dados[0]['enfermo']."\""    ;
	$_desabrigado = "value=\"".$_dados[0]['desabrigado']."\"";
	$_desalojado  = "value=\"".$_dados[0]['desalojado']."\"" ;
	$_outro       = "value=\"".$_dados[0]['outro']."\""      ;
	$_afetado     = "value=\"".$_dados[0]['afetado']."\""    ;
	$_total_humano= "value=\"".$_val_total."\""    ;
	
	$_parametro   = "&id=";
	

}else {
	
	$_morto       = "value=\"0\"";
	$_ferido      = "value=\"0\"";
	$_enfermo     = "value=\"0\"";
	$_desabrigado = "value=\"0\"";
	$_desalojado  = "value=\"0\"";
	$_outro       = "value=\"0\"";
	$_afetado     = "value=\"0\"";
	$_total_humano= "value=\"0\"";
	
	$_parametro   = "";
	
	
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

				<legend>Danos Humanos</legend>

				<form action="processo.php?secao=material<?php print $_parametro.$_alterar;?>" method="POST" name="frm_humano">

				<table>

					<tr>
						<td width="200px">Mortos</td>
						<td>
							<input type="text" name="txt_morto" id="txt_morto" class="span5" <?php print $_morto;?> />
						</td>
					</tr>
					<tr>
						<td>Feridos</td>
						<td>
							<input type="text" name="txt_ferido" id="txt_ferido" class="span5" <?php print $_ferido;?> />
						</td>
					</tr>

					<tr>
						<td>Enfermos</td>
						<td>
							<input type="text" name="txt_enfermo" id="txt_enfermo" class="span5" <?php print $_enfermo;?>/>
						</td>
					</tr>
					<tr>
						<td>Desabrigados</td>
						<td>
							<input type="text" name="txt_desabrigado" id="txt_desabrigado" class="span5" <?php print $_desabrigado;?>/>
						</td>
					</tr>
					<tr>
						<td>Desalojados</td>
						<td>
							<input type="text" name="txt_desalojado" id="txt_desalojado" class="span5" <?php print $_desalojado;?>/>
						</td>
					</tr>
					<tr>
						<td>Outros</td>
						<td>
							<input type="text" name="txt_outro" id="txt_outro" class="span5" <?php print $_outro;?>/>
						</td>
					</tr>
					<tr>
						<td>Afetados</td>
						<td>
							<input type="text" name="txt_afetado" id="txt_afetado" class="span5" <?php print $_afetado;?>/>
						</td>
						
					</tr>
					<tr>
						<td><b>Total de Pessoas</b></td>
						<td>
							<input type="text" name="txt_total_humano" id="txt_total_humano" class="span5" <?php print $_total_humano;?> readonly="readonly"/>
						</td>
						
					</tr>
				</table>

			</div>
			<div class="span2"></div>
			<div class="span9 text-center">
				<br>
				<a class="btn btn-primary" href="processo.php?secao=municipio<?php print $_parametro.$_alterar;?>">Voltar</a>
				<input class="btn btn-primary" type="submit" name="btn_humano" id="btn_humano" value="Prosseguir">
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
			$( "#aba_humanos" ).addClass( "active" );

		});

		/* fazer o somatorio de pessoas */
		$(document).ready(function(){

			var mortos      = 0;
			var feridos     = 0;
			var enfermos    = 0;
			var desabrigado = 0;
			var desalojado  = 0;
			var outro       = 0;
			var afetado     = 0;

			$("input[type=text]").change(function(){

				var mortos      = parseFloat($("#txt_morto").val());
				var feridos     = parseFloat($("#txt_ferido").val());
				var enfermos    = parseFloat($("#txt_enfermo").val());
				var desabrigado = parseFloat($("#txt_desabrigado").val());
				var desalojado  = parseFloat($("#txt_desalojado").val());
				var outro       = parseFloat($("#txt_outro").val());
				var afetado     = parseFloat($("#txt_afetado").val());
				
				$("#txt_total_humano").val(mortos+
											 feridos+
											 enfermos+
											 desabrigado+
											 desalojado+
											 outro+
											 afetado);

			});

			
		});
		
    </script>
</body>
</html>
