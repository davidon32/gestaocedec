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

	$_dados = $_processo->BuscaProcessoMaterial($_alterar);
	
		$_mat_pub_saude_destr    = "value=\"".$_dados[0]['mat_pub_saude_destr']."\"";
		$_mat_pub_saude_danif    = "value=\"".$_dados[0]['mat_pub_saude_danif']."\"";
		$_val_mat_pub_saude      = "value=\"".$_dados[0]['val_mat_pub_saude']."\"";
		$_mat_pub_ensino_destr   = "value=\"".$_dados[0]['mat_pub_ensino_destr']."\"";
		$_mat_pub_ensino_danif   = "value=\"".$_dados[0]['mat_pub_ensino_danif']."\"";
		$_val_mat_pub_ensino     = "value=\"".$_dados[0]['val_mat_pub_ensino']."\"";
		$_mat_pub_outro_destr    = "value=\"".$_dados[0]['mat_pub_outro_destr']."\"";
		$_mat_pub_outro_danif    = "value=\"".$_dados[0]['mat_pub_outro_danif']."\"";
		$_val_mat_pub_outro      = "value=\"".$_dados[0]['val_mat_pub_outro']."\"";
		$_mat_pub_com_destr      = "value=\"".$_dados[0]['mat_pub_com_destr']."\"";
		$_mat_pub_com_danif      = "value=\"".$_dados[0]['mat_pub_com_danif']."\"";
		$_val_mat_pub_com        = "value=\"".$_dados[0]['val_mat_pub_com']."\"";
		$_mat_unid_hab_destr     = "value=\"".$_dados[0]['mat_unid_hab_destr']."\"";
		$_mat_unid_hab_danif     = "value=\"".$_dados[0]['mat_unid_hab_danif']."\"";
		$_val_mat_unid_hab       = "value=\"".$_dados[0]['val_mat_unid_hab']."\"";
		$_mat_obr_infr_pub_destr = "value=\"".$_dados[0]['mat_obr_infr_pub_destr']."\"";
		$_mat_obr_infr_pub_danif = "value=\"".$_dados[0]['mat_obr_infr_pub_danif']."\"";
		$_val_mat_obr_infr_pub   = "value=\"".$_dados[0]['val_mat_obr_infr_pub']."\"";
		
		$_parametro              = "&id=";
	
} else {
	
	$_mat_pub_saude_destr    = "";
	$_mat_pub_saude_danif    = "";
	$_val_mat_pub_saude      = "";
	$_mat_pub_ensino_destr   = "";
	$_mat_pub_ensino_danif   = "";
	$_val_mat_pub_ensino     = "";
	$_mat_pub_outro_destr    = "";
	$_mat_pub_outro_danif    = "";
	$_val_mat_pub_outro      = "";
	$_mat_pub_com_destr      = "";
	$_mat_pub_com_danif      = "";
	$_val_mat_pub_com        = "";
	$_mat_unid_hab_destr     = "";
	$_mat_unid_hab_danif     = "";
	$_val_mat_unid_hab       = "";
	$_mat_obr_infr_pub_destr = "";
	$_mat_obr_infr_pub_danif = "";
	$_val_mat_obr_infr_pub   = "";
	
	$_parametro              = "";
	
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


				<legend>Danos Materiais</legend>
				<br>
				
				<form action="processo.php?secao=ambiental<?php print $_parametro.$_alterar;?>" method="POST" name="frm_material">

				<table class="table table-bordered">
					<tr>
						<td colspan="3" style="text-align: center;">Públicas Saude</td>
					</tr>
					<tr>
						<td>
							<small>Destruídas (qtd)</small>
							<input type="text" name="txt_psaude_destruida" id="txt_psaude_destruida" class="span3" <?php print $_mat_pub_saude_destr;?>/>
						</td>
						<td>
							<small>Danificadas (qtd)</small>
							<input type="text" name="txt_psaude_danificada" id="txt_psaude_danificada" class="span3" <?php print $_mat_pub_saude_danif;?>/>
						</td>
						<td>
							<small>Valor (R$)</small>
							<input type="text" name="txt_psaude_valor" id="txt_psaude_valor" class="span5" <?php print $_val_mat_pub_saude;?>/>
						</td>
					
					
					<tr>
						<td colspan="3" style="text-align: center;">Pública de Ensino</td>
					</tr>
					<tr>
						<td>
							<small>Destruídas (qtd)</small>
							<input type="text" name="txt_pensino_destruida" id="txt_pensino_destruida" class="span3" <?php print $_mat_pub_ensino_destr;?>/>
						</td>
						<td>
							<small>Danificadas (qtd)</small>
							<input type="text" name="txt_pensino_danificada" id="txt_pensino_danificada" class="span3" <?php print $_mat_pub_ensino_danif;?>/>
						</td>
						<td>
							<small>Valor (R$)</small>
							<input type="text" name="txt_pensino_valor" id="txt_pensino_valor" class="span5" <?php print $_val_mat_pub_ensino;?>/>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: center;">Pública Outros Serviços</td>
					</tr>
					<tr>
						<td>
							<small>Destruídas (qtd)</small>
							<input type="text" name="txt_poutro_destruida" id="txt_poutro_destruida" class="span3" <?php print $_mat_pub_outro_destr;?>/>
						</td>
						<td>
							<small>Danificadas (qtd)</small>
							<input type="text" name="txt_poutro_danificada" id="txt_poutro_danificada" class="span3" <?php print $_mat_pub_outro_danif;?>/>
						</td>
						<td>
							<small>Valor (R$)</small>
							<input type="text" name="txt_poutro_valor" id="txt_poutro_valor" class="span5" <?php print $_val_mat_pub_outro;?>/>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: center;">Pública Comunitária</td>
					</tr>
					<tr>
						<td>
							<small>Destruídas (qtd)</small>
							<input type="text" name="txt_pcomuni_destruida" id="txt_pcomuni_destruida" class="span3" <?php print $_mat_pub_com_destr;?>/>
						</td>
						<td>
							<small>Danificadas (qtd)</small>
							<input type="text" name="txt_pcomuni_danificada" id="txt_pcomuni_danificada" class="span3" <?php print $_mat_pub_com_danif;?>/>
						</td>
						<td>
							<small>Valor (R$)</small>
							<input type="text" name="txt_pcomuni_valor" id="txt_pcomuni_valor" class="span5" <?php print $_val_mat_pub_com;?>/>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: center;">Unidades Habitacionais</td>
					</tr>
					<tr>
						<td>
							<small>Destruídas (qtd)</small>
							<input type="text" name="txt_uhabita_destruida" id="txt_uhabita_destruida" class="span3" <?php print $_mat_unid_hab_destr;?>/>
						</td>
						<td>
							<small>Danificadas (qtd)</small>
							<input type="text" name="txt_uhabita_danificada" id="txt_uhabita_danificada" class="span3" <?php print $_mat_unid_hab_danif;?>/>
						</td>
						<td>
							<small>Valor (R$)</small>
							<input type="text" name="txt_uhabita_valor" id="txt_uhabita_valor" class="span5" <?php print $_val_mat_unid_hab;?>/>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: center;">Óbras de Infraestrutura Públicas</td>
					</tr>
					<tr>
						<td>
							<small>Destruídas (qtd)</small>
							<input type="text" name="txt_oinfra_destruida" id="txt_oinfra_destruida" class="span3" <?php print $_mat_obr_infr_pub_destr;?>/>
						</td>
						<td>
							<small>Danificadas (qtd)</small>
							<input type="text" name="txt_oinfra_danificada" id="txt_oinfra_danificada" class="span3" <?php print $_mat_obr_infr_pub_danif;?>/>
						</td>
						<td>
							<small>Valor (R$)</small>
							<input type="text" name="txt_oinfra_valor" id="txt_oinfra_valor" class="span5" <?php print $_val_mat_obr_infr_pub;?>/>
						</td>
					</tr>
				</table>

			</div>
			<div class="span2"></div>
			<div class="span9 text-center">
				<br>
				<a class="btn btn-primary" href="processo.php?secao=humanos<?php print $_parametro.$_alterar;?>"">Voltar</a>
				<input class="btn btn-primary" type="submit" name="btn_material" id="btn_material" value="Prosseguir">
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
			$( "#aba_material" ).addClass( "active" );

		});
		/*
		$(document).ready(function(){
			
			var p_saude_destr  = 0;
			var p_saude_danif  = 0;
			
			var p_ensino_destr = 0;
			var p_ensino_danif = 0;
			
			var p_outro_destr  = 0;
			var p_outro_danif  = 0;
			
			var p_comuni_destr = 0;
			var p_comuni_danif = 0;
			
			var p_uhabita_destr = 0;
			var p_uhabita_danif = 0;
			
			var p_oinfra_destr  = 0;
			var p_oinfra_danif  = 0;
			

			
			/*=========================== saude =============================== 
			$("#txt_psaude_destruida").change(function(){

				p_saude_destr  = parseFloat($("#txt_psaude_destruida").val());
				$("#txt_psaude_valor").val(p_saude_destr+p_saude_danif);

			});
			
			$("#txt_psaude_danificada").change(function(){

				p_saude_danif  = parseFloat($("#txt_psaude_danificada").val());
				$("#txt_psaude_valor").val(p_saude_destr+p_saude_danif);

			});
			
			/*=========================== Ensino =============================== 
			$("#txt_pensino_destruida").change(function(){

				p_ensino_destr  = parseFloat($("#txt_pensino_destruida").val());
				$("#txt_pensino_valor").val(p_ensino_destr+p_ensino_danif);

			});
			
			$("#txt_pensino_danificada").change(function(){

				p_ensino_danif  = parseFloat($("#txt_pensino_danificada").val());
				$("#txt_pensino_valor").val(p_ensino_destr+p_ensino_danif);

			});
			
			/*=========================== Outros =============================== 
			$("#txt_poutro_destruida").change(function(){

				p_outro_destr  = parseFloat($("#txt_poutro_destruida").val());
				$("#txt_poutro_valor").val(p_outro_destr+p_outro_danif);

			});
			
			$("#txt_poutro_danificada").change(function(){

				p_outro_danif  = parseFloat($("#txt_poutro_danificada").val());
				$("#txt_poutro_valor").val(p_outro_destr+p_outro_danif);

			});
			
			
			/*=========================== Comunitaria =============================== 
			$("#txt_pcomuni_destruida").change(function(){

				p_comuni_destr  = parseFloat($("#txt_pcomuni_destruida").val());
				$("#txt_pcomuni_valor").val(p_comuni_destr+p_comuni_danif);

			});
			
			$("#txt_pcomuni_danificada").change(function(){

				p_comuni_danif  = parseFloat($("#txt_pcomuni_danificada").val());
				$("#txt_pcomuni_valor").val(p_comuni_destr+p_comuni_danif);

			});
			
			/*======================= Unidades Habitacionais ===========================
			$("#txt_uhabita_destruida").change(function(){

				p_uhabita_destr  = parseFloat($("#txt_uhabita_destruida").val());
				$("#txt_uhabita_valor").val(p_uhabita_destr+p_uhabita_danif);

			});
			
			$("#txt_uhabita_danificada").change(function(){

				p_uhabita_danif  = parseFloat($("#txt_uhabita_danificada").val());
				$("#txt_uhabita_valor").val(p_uhabita_destr+p_uhabita_danif);

			});


			/*===================== Obras Infraestrutura =======================
			$("#txt_oinfra_destruida").change(function(){

				p_oinfra_destr  = parseFloat($("#txt_oinfra_destruida").val());
				$("#txt_oinfra_valor").val(p_oinfra_destr+p_oinfra_danif);

			});
			
			$("#txt_oinfra_danificada").change(function(){

				p_oinfra_danif  = parseFloat($("#txt_oinfra_danificada").val());
				$("#txt_oinfra_valor").val(p_oinfra_destr+p_oinfra_danif);

			});

		});*/
		
    </script>
</body>
</html>
