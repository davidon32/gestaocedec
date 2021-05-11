<?php session_start ();
include_once '../include.php';
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";

$_conexao = new ConexaoMysql ();

$_login = new Login ();

$_login->logado ();

$_municipio = new Municipio ();

$_processo = new Decretacao ();

$_SESSION['processo'] = array();


/*
 * *************************************************************************************** 
 * Orgão Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais 
 * Sistema : Sistema de Gest�o de Ajuda Humanit�ria Autor : Demetrio Silva Passos 
 * Fun��o : 
 * 
 * *****************************************************************************************
 */

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<style>
    #txt_val_total {
	   background-color: #F9B0B0;
	   font-weight: bold;
    }
</style>

</head>
<body>
	<div class="container">
		<!-- TOPO-->
		<div class="row-fluid text-center">
			<img src="../imagem/topo_decreto.png" />
			<hr>
		</div>

		<!-- BARRA -->
		<div class="row-fluid">
			<div class="span6 text-left">
				<small><?php print "Data :".date("d/m/Y");?> </small>
			</div>
			<div class="span6 text-right">
				<small><?php print "Hora :".date("H:i:s");?> </small>
			</div>
		</div>

		<!-- LOGOUT -->
		<div class="row-fluid text-right">
			<a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Fazer logout do sistema">Logout</a>
			<p>
			
			
			<hr>
		</div>

		<!-- MENU -->
		<div class="row-fluid">
			<div class="span2">
				<?php include_once 'visao/sc.decreto.menu.php';?>
			</div>
			<div class="span10">
				<?php include_once 'sc.processo.menu.php';?>

				<form action="processo.php?secao=pfechar&acao=novo" method="POST" name="frm_dados">

					<legend>Dados Gerais</legend>

					<div class="span3">
					   <div class="control-group error">
						  <label class="control-label"><b>Data Entrada</b></label>
						  <input type="text" name="txt_dt_entrada" id="txt_dt_entrada" class="" data-mask="99/99/9999" value="<?php print date('d/m/Y');?>" />
						</div>

						<label><b>Ano</b></label>
						<input type="text" name="txt_ano" id="txt_ano" class="" value="<?php print date('Y');?>" readonly="readonly"/>

						<div class="control-group error">
						  <label class="control-label"><b>Município</b></label>
						  <?php $_municipio->PegaMunicipio();?>   
						</div>
						<hr>

						<div class="control-group error">
							<label><b>Decreto Municipal</b></label>
						  	<br>
						  	<br>
    						<label class="control-label">
    						Número
    						<input type="text" name="txt_num_dec_mun" id="txt_num_dec_mun" class="span8" />
    						</label>
    						<br />
    						<label class="control-label">
    						Data:
    						<input type="text" name="txt_dt_dec_mun" id="txt_dt_dec_mun" class="span8" data-mask="99/99/9999"/>
    						</label>
    						<br />
    						<label class="control-label">
    						Vigência:
    						<input type="text" name="txt_dec_vigencia" id="txt_dec_vigencia" class="span8" />
    						</label>
    						<br />
    						
    						<label class="control-label">Vencimento
                                <input type="text" name="txt_dt_vencimento" id="txt_dt_vencimento" class="" data-mask="99/99/9999" readonly="readonly" /></label>
						
						<label class="control-label">Desastre
						<?php print Decretacao::getCobrade();?></label>
						</div>

						
					</div>
					<div class="span3">
						<label>Status</label>
						<table>
						    <tr>
                                <td>Siga</td>
                                <td>
                                    <input type="radio" name="rdb_status" value="0" />
                                </td>
                            </tr>
                            <tr>
                                <td>Homologação</td>
                                <td>
                                    <input type="radio" name="rdb_status"  value="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>Arquivo</td>
                                <td>
                                    <input type="radio" name="rdb_status" value="2"/>
                                </td>
                            </tr>
							<tr>
								<td>Análise</td>
								<td>
									<input type="radio" name="rdb_status" value="3" />
								</td>
							</tr>

							<tr>
								<td>Reconhecido</td>
								<td>
									<input type="checkbox" name="ck_reconhecido" value="1" />
								</td>
							</tr>
							<tr>
						
						</table>
						<br />
						<label>Analista</label>
						<select name="txt_analista" id="txt_analista">
							<option value="23">Gilliard</option>
							<option value="25">Fellipe</option>
							<option value="38">Vivi</option>
							<option value="39">Miguel</option>
						</select>
						<!-- <input type="text" name="txt_analista" id="txt_analista" class="" />-->
						<br />

						<hr>
						Decreto Homologação
						<br />

						Número&nbsp;&nbsp;:
						<input type="text" name="txt_num_decreto" id="txt_num_decreto" class="span8" />
						<br />
						Dt Publicação :
						<input type="text" name="txt_dt_pub_decreto" id="txt_pub_decreto" class="span7" data-mask="99/99/9999" />

						<br />
						<hr>
						Portaria Reconhecimento
						<br />
						<label>Número/Data</label>
						<input type="text" name="txt_num_dt_portaria" id="txt_num_dt_portaria" class="" />
						<br />

						<label>Número/Data/D.O.U</label>
						<input type="text" name="txt_num_dou" id="txt_num_dou" class="" />
						<br />

					</div>
					<div class="span3">
						
						<label>Valor Total</label>
						<input type="text" name="txt_val_total" id="txt_val_total" class="" readonly="readonly" />
						<br />
						<br>

					</div>
			
			</div>
			<div class="span2"></div>
			<div class="span9 text-center">
				<br>
				<input class="btn btn-primary" type="submit" name="btn_dados" id="btn_dados" value="Gravar">
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
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			$( "#aba_dados" ).addClass( "active" );
			 


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
