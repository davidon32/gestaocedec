<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';

$_login = new Login();

$_login->logado();

$_municipio = new Municipio();

$_processo = new Decretacao();

$_SESSION['processo'] = array_merge($_SESSION['processo'], $_POST);

//var_dump($_SESSION['processo']);

    //var_dump($_POST);
    
    /* Arranjo para alimentar os campos com dados para alteração de processo */
    $_alterar = isset($_GET['id']) ? $_GET['id'] : "";
    
    if($_alterar != "") {
    	
    	$_dados = $_processo->BuscaProcessoDMunin($_alterar);
    	
    	//var_dump($_dados);
    	
    	$_txt_populacao      = "value='".$_dados[0]['populacao']."'";"";
    	$_txt_pib            = "value='".$_dados[0]['pib']."'";"";
    	$_txt_orcamento      = "value='".$_dados[0]['orcamento']."'";"";
    	$_txt_arrecadacao    = "value='".$_dados[0]['arrecadacao']."'";"";
    	$_txt_receita_anual  = "value='".$_dados[0]['rec_anual']."'";"";
    	$_txt_receita_mensal = "value='".$_dados[0]['rec_mensal']."'";"";
    	$_txt_telefone       = "value='".$_dados[0]['telefone']."'";"";
    	$_txt_email          = "value='".$_dados[0]['email']."'";"";
    	
    	$_parametro          = "&id=";
    	
    }else {
    	
    	
    	$_txt_populacao      = "";
    	$_txt_pib            = "";
    	$_txt_orcamento      = "";
    	$_txt_arrecadacao    = "";
    	$_txt_receita_anual  = "";
    	$_txt_receita_mensal = "";
    	$_txt_telefone       = "";
    	$_txt_email          = "";
    	
    	$_parametro          = "";
        
        
        
        
        
        
    	
    }


/* ****************************************************************************************
 *   Orgão Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*   Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*   Autor        :  Demetrio Silva Passos
*   Fun��o   :
*
*******************************************************************************************/

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<style>
#txt_val_total {
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

				<form action="processo.php?secao=humanos<?php print $_parametro.$_alterar;?>" method="POST" name="frm_dados">

					<legend>Dados Gerais</legend>
					
					<label>PIB (R$)</label>
						<input type="text" name="txt_pib" id="txt_pib" class="" <?php print $_txt_pib;?> />
						<br />

						<label>Orçamento (R$)</label>
						<input type="text" name="txt_orcamento" id="txt_orcamento" class="" <?php print $_txt_orcamento;?> />
						<br />

						<label>Arrecadação (R$)</label>
						<input type="text" name="txt_arrecadacao" id="txt_arrecadacao" class="" <?php print $_txt_arrecadacao;?> />
						<br />

						<hr>
						Receita Corrente Líquida
						<label>Anual</label>
						<input type="text" name="txt_receita_anual" id="txt_receita_anual" class="" <?php print $_txt_receita_anual;?> />
						<br />
						<label>Mensal</label>
						<input type="text" name="txt_receita_mensal" id="txt_receita_mensal" class="" <?php print $_txt_receita_mensal;?> />
						<br />
							<label>Telefone</label>
						<input type="text" name="txt_telefone" id="txt_telefone" class="" data-mask="(99)9999-9999" <?php print $_txt_telefone;?> />
						<br />

						<label>email</label>
						<input type="text" name="txt_email" id="txt_email" class="" <?php print $_txt_email;?> />
						<br />
						<label>População</label>
						<input type="text" name="txt_populacao" id="txt_populacao" class="" <?php print $_txt_populacao;?> />
						<br />

					
			
			</div>
			<div class="span2"></div>
			<div class="span9 text-center"><br>
			
				<a class="btn btn-primary" href="processo.php?secao=dados<?php print $_parametro.$_alterar;?>">Voltar</a>	
				<input class="btn btn-primary" type="submit" name="btn_dados" id="btn_dados" value="Prosseguir">
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
			$( "#aba_dmunicipio" ).addClass( "active" );
			 


		});

		/* soma data */
		$(document).ready(function(){

			$("#txt_dec_vigencia").change(function(){

				var dt_decreto = $("#txt_dt_dec_mun").val();
				var vigencia   = parseInt($("#txt_dec_vigencia").val(), 10);

				/* faz a quebra da data pelo separador */
				var dmy = dt_decreto.split("/");  

				var joindate = new Date(
				    parseInt(dmy[2], 10),
				    parseInt(dmy[1], 10) - 1,
				    parseInt(dmy[0], 10)
				);

				/* faz o somatorio de dias na data */
				joindate.setDate(joindate.getDate()+ vigencia);

				/* normaliza a questão das duas casa para data menor que 10*/
				var dia = joindate.getDate();
				if(dia < 10){
					dia = ("0" + dia);
				}

				/* normaliza a questão das duas casa para data menor que 10*/
				var mes = (joindate.getMonth()+1);
				if(mes < 10){
					mes = "0" + mes;
				} 

				
				$("#txt_dt_vencimento").val(dia + "/" + mes + "/" + joindate.getFullYear()); 

			});


		});


		
		
    </script>

</body>
</html>
