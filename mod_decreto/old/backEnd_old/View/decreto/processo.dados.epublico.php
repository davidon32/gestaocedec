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

	$_dados = $_processo->BuscaProcessoEPublico($_alterar);
	
	//var_dump($_dados);
	
	$_eco_pub_saude  = "value=\"".$_dados[0]['eco_pub_saude']."\"";
	$_eco_pub_agua   = "value=\"".$_dados[0]['eco_pub_agua']."\"";
	$_eco_pub_esgoto = "value=\"".$_dados[0]['eco_pub_esgoto']."\"";
	$_eco_pub_lixo   = "value=\"".$_dados[0]['eco_pub_lixo']."\"";
	$_eco_pub_praga  = "value=\"".$_dados[0]['eco_pub_praga']."\"";
	$_eco_pub_energia= "value=\"".$_dados[0]['eco_pub_energia']."\"";
	$_eco_pub_telec  = "value=\"".$_dados[0]['eco_pub_telec']."\"";
	$_eco_pub_transp = "value=\"".$_dados[0]['eco_pub_transp']."\"";
	$_eco_pub_comb   = "value=\"".$_dados[0]['eco_pub_comb']."\"";
	$_eco_pub_segur  = "value=\"".$_dados[0]['eco_pub_segur']."\"";
	$_eco_pub_ensino = "value=\"".$_dados[0]['eco_pub_ensino']."\"";
	$_val_eco_pub    = "value=\"".$_dados[0]['val_eco_pub']."\"";
	
	$_parametro      = "&id=";

}else {
	
	$_eco_pub_saude  = "value=\"0\"";
	$_eco_pub_agua   = "value=\"0\"";
	$_eco_pub_esgoto = "value=\"0\"";
	$_eco_pub_lixo   = "value=\"0\"";
	$_eco_pub_praga  = "value=\"0\"";
	$_eco_pub_energia= "value=\"0\"";
	$_eco_pub_telec  = "value=\"0\"";
	$_eco_pub_transp = "value=\"0\"";
	$_eco_pub_comb   = "value=\"0\"";
	$_eco_pub_segur  = "value=\"0\"";
	$_eco_pub_ensino = "value=\"0\"";
	$_val_eco_pub    = "value=\"0\"";
	
	$_parametro      = "";
	
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

	#txt_total_prej_publico {
	
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

				<legend>Prejuízo Econômico Público</legend>
				
				<form action="processo.php?secao=eprivado<?php print $_parametro.$_alterar;?>" method="POST" name="frm_epublico">
				
				<table>
					<tr>
						<td>Saúde</td>
						<td>Água</td>
						<td>Esgoto</td>
						<td>Lixo</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="txt_saude_prej_publico" id="txt_saude_prej_publico" class="span8" <?php print $_eco_pub_saude;?>/>
						</td>
						<td>
							<input type="text" name="txt_agua_prej_publico" id="txt_agua_prej_publico" class="span8" <?php print $_eco_pub_agua;?>/>
						</td>
						<td>
							<input type="text" name="txt_esgoto_prej_publico" id="txt_esgoto_prej_publico" class="span8" <?php print $_eco_pub_esgoto;?>/>
						</td>
						<td>
							<input type="text" name="txt_lixo_prej_publico" id="txt_lixo_prej_publico" class="span8" <?php print $_eco_pub_lixo;?>/>
						</td>
					</tr>
					<tr>
						<td>Controle Pragas</td>
						<td>Energia</td>
						<td>Telecomunicação</td>
						<td>Transportes</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="txt_praga_prej_publico" id="txt_praga_prej_publico" class="span8" <?php print $_eco_pub_praga;?>/>
						</td>
						<td>
							<input type="text" name="txt_energia_prej_publico" id="txt_energia_prej_publico" class="span8" <?php print $_eco_pub_energia;?>/>
						</td>
						<td>
							<input type="text" name="txt_tele_prej_publico" id="txt_tele_prej_publico" class="span8" <?php print $_eco_pub_telec;?>/>
						</td>
						<td>
							<input type="text" name="txt_trans_prej_publico" id="txt_trans_prej_publico" class="span8" <?php print $_eco_pub_transp;?>/>
						</td>
					</tr>
					<tr>
						<td>Combustível Doméstico</td>
						<td>Segurança</td>
						<td>Ensino</td>	
						<td>Total</td>									
					</tr>
					<tr>
					<td>
							<input type="text" name="txt_comb_prej_publico" id="txt_comb_prej_publico" class="span8" <?php print $_eco_pub_comb;?>/>
						</td>
						<td>
							<input type="text" name="txt_seg_prej_publico" id="txt_seg_prej_publico" class="span8" <?php print $_eco_pub_segur;?>/>
						</td>
						<td>
							<input type="text" name="txt_ensino_prej_publico" id="txt_ensino_prej_publico" class="span8" <?php print $_eco_pub_ensino;?>/>
						</td>
						<td>
							<input type="text" name="txt_total_prej_publico" id="txt_total_prej_publico" class="span8" <?php print $_val_eco_pub;?> readonly="readonly"/>
						</td>
					</tr>
					</div>
				</table>
			</div>
			<div class="span2"></div>
			<div class="span9 text-center">
				<br>
				<a class="btn btn-primary" href="processo.php?secao=ambiental<?php print $_parametro.$_alterar;?>"">Voltar</a>
				<input class="btn btn-primary" type="submit" name="btn_epublico" id="btn_epublico" value="Prosseguir">
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
			$( "#aba_epublico" ).addClass( "active" );

		});
		
		$(document).ready(function(){

			var saude     = 0;
			var agua      = 0;
			var estogo    = 0;
			var lixo      = 0;
			
			var praga     = 0;
			var energia   = 0;
			var tele      = 0;
			var trans     = 0;
			
			var comb      = 0;
			var seg       = 0;
			var ensino    = 0;


			$("input[type=text]").change(function(){

				saude    = parseFloat($("#txt_saude_prej_publico").val());
				agua     = parseFloat($("#txt_agua_prej_publico").val());
				esgoto   = parseFloat($("#txt_esgoto_prej_publico").val());
				lixo     = parseFloat($("#txt_lixo_prej_publico").val());
				
				praga    = parseFloat($("#txt_praga_prej_publico").val());
				energia  = parseFloat($("#txt_energia_prej_publico").val());
				tele     = parseFloat($("#txt_tele_prej_publico").val());
				trans    = parseFloat($("#txt_trans_prej_publico").val());
				
				comb     = parseFloat($("#txt_comb_prej_publico").val());
				seg      = parseFloat($("#txt_seg_prej_publico").val());
				ensino   = parseFloat($("#txt_ensino_prej_publico").val());
				
				$("#txt_total_prej_publico").val(saude + agua + esgoto + lixo + praga + energia + tele + trans + comb + seg + ensino);

			});	
			
		});
		
		
		
    </script>
</body>
</html>
