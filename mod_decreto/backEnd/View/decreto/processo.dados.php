<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';

$_login = new Login ();

$_login->logado ();

$_municipio = new Municipio ();

$_processo = new Decretacao ();

$_SESSION['processo'] = array();

$param = isset($_GET['id']) ? $_GET['id'] :"";

$_dados = array();

if(!empty($_POST)){
	$_dados = $_POST;

}elseif(!empty($param)){
	
	$_dados = $_processo->BuscaProcessoDados($param);
	
	//var_dump($_dados);
	
}else {

	$_dados['dt_entrada'] 	     = "value=\"" . date ( "d/m/Y" ) . "\"";
	$_dados[0]['num_processo']   = "";
	$_dados[0]['ano'] 			 = "value=\"" . date ( "Y" ) . "\"";
	$_dados[0]['id_municipio']   = "";
	$_dados[0]['num_dec_munic']  = "";
	$_dados[0]['dt_dec_munic'] 	 = "";
	$_dados[0]['dec_vigencia']	 = "";
	$_dados[0]['desastre']       = "";
	$_dados[0]['dt_vencimento']  = "";
	$_dados[0]['analista']       = "";
	
	$_dados[0]['stat_estado_analise']  = "";
	$_dados[0]['stat_estado_homologado']= "";
	$_dados[0]['stat_estado_arquivado']= "";
	
	$_dados[0]['stat_uniao_reconhecido']= "";
	$_dados[0]['stat_uniao_n_reconhecido']= "";
	
	$_dados[0]['stat_pmda_aprovado'] = "";
	$_dados[0]['stat_pmda_analise']  = "";
	
	$_dados[0]['num_dec_homologacao']    = "";
	$_dados[0]['dt_pub_dec_homologacao'] = "";
	$_dados[0]['num_dt_portaria_dec_homologacao']= "";
	$_dados[0]['num_dou_dec_homologacao'] 		 = "";
	
	$_dados[0]['vl_total'] 	     = "";
	
	
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
        	<div class="row">
            	<div class="span2">
                 <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
            	</div>
                <div class="span10 fdo_corpo">
                <!-- ?modulo=decreto&secao=valida&acao="<?=$param;?> -->
					<form action="?modulo=decreto&secao=valida&acao="<?=$param;?>" method="POST" name="frm_dados">
						<p style="text-align: right; font-weight: bold;">Processo Nº:<span><?php print $_dados[0]['num_processo'];?></span></p>
	                    <?php require_once PATH."/mod_decreto/app/decreto/processo.menu.php";?>

							<p style="text-align: right; color:red; font-weight: bold;">Valor Total: <span><?php print $_dados[0]['vl_total'];?></span></p>

						<legend>Dados Gerais</legend>
						
					
							<input type="hidden" name="txt_num_processo" id="txt_num_processo" class="" <?php print $_dados[0]['num_processo'];?> readonly="readonly" title="O número do processo será gerado quando gravar o processo." />
							<input type="hidden" name="txt_val_total" id="txt_val_total" class="" <?php print $_dados[0]['vl_total'];?> readonly="readonly" />
							<div class="row">
									<div class="span4">
										  <label>Município</label>
										  <?php $_municipio->PegaMunicipio($_dados[0]['id_municipio']);?> 
									</div> 
									<div class="span4">
										<label class="">Data Entrada</label>
										<input type="text" name="txt_dt_entrada" id="txt_dt_entrada" class="" data-mask="99/99/9999" value="<?php print (!empty($_dados[0]['dt_entrada'])) ? DataMysql::dataVisual($_dados[0]['dt_entrada']) : "";?>" />	
									</div>					
									<div class="span4">
										<label>Ano</label>
										<input type="text" name="txt_ano" id="txt_ano" class="" value="<?php print $_dados[0]['ano'];?>" />
									</div>
							</div>
							
							<div class="row">
								<div class="span4">					
    								<label>Decreto Municipal</label>
    								<input type="text" name="txt_num_dec_mun" id="txt_num_dec_mun" class="span8" value="<?php print $_dados[0]['num_dec_mun'];?>" />
    							</div>
    							<div class="span4">
									<label>Data</label>
    								<input type="text" name="txt_dt_dec_mun" id="txt_dt_dec_mun" class="span8" data-mask="99/99/9999"
    								value="<?php print (!empty($_dados[0]['dt_dec_mun'])) ? DataMysql::dataVisual($_dados[0]['dt_dec_mun']):"";?>" />
    							</div>
    							<div class="span4">
    								<label>Vigência</label>
    								<input type="text" name="txt_dec_vigencia" id="txt_dec_vigencia" class="span8" value="<?php print $_dados[0]['dec_vigencia'];?>" />
    							</div>
    						</div>
    						<div class="row">
    							<div class="span4">
    								<label>Vencimento</label>
                                	<input type="text" name="txt_dt_vencimento" id="txt_dt_vencimento" class="error" data-mask="99/99/9999" value="<?php print (!empty($_dados[0]['dt_vencimento'])) ? DataMysql::dataVisual($_dados[0]['dt_vencimento']) : "";?>" readonly="readonly" />
                                </div>
	                            <div class="span4">
									<label>Desastre</label>
									<?php print Decretacao::comboCobrade($_dados[0]['desastre']); ?>
								</div>
								
								<div class="span4">
									<label>Analista</label>
									<select name="txt_analista" id="txt_analista">
										<option value="<?=$_SESSION['seguranca']['id_funcionario'];?>"><?=EquipeFuncionario::getFuncionarioId($_SESSION['seguranca']['id_funcionario'])?></option>
									</select>
<!-- 									<label>Analista</label> -->
<!-- 									<select name="txt_analista" id="txt_analista">
										<option value='<?php print $_dados[0]['analista'];?>'><?php print (!empty($_dados[0]['analista'])) ? EquipeFuncionario::getFuncionarioId($_dados[0]['analista']) : "EScolha o Analista";?></option>-->
										<?php 
										
										
// 											$dadosFunc = EquipeFuncionario::dadosCombo();
											
// 											foreach ($dadosFunc as $value) {
// 												print "<option value='".$value['id_funcionario']."'>".$value['nome']."</option>";
// 											}
										
// 										?>
<!-- 									</select> -->
									<!-- <input type="text" name="txt_analista" id="txt_analista" class="" />-->
								</div>
							</div>
								<div class="row">
								<hr>
									<div class="span1"></div>
									<div class="span3">
										<label><h5>Status Estado</h5></label>
										<table>
											<tr>
												<td>Análise</td>
												<td>
													<input type="checkbox" name="rdb_stat_analis_estado" id="rdb_stat_analis_estado" value="1" 
														<?php print ($_dados[0]['stat_estado_analise'] == "1") ? " checked=\"checked\"" : ""; ?> />
												</td>
											</tr>
											<tr>
												<td>Homologação</td>
												<td>
													<input type="checkbox" name="rdb_stat_hom_estado" id="rdb_stat_hom_estado" value="1" 
														<?php print ($_dados[0]['stat_estado_homologacao'] == "1") ? " checked=\"checked\"" : "";?> />
												</td>
											</tr>
											<tr>
												<td>Arquivado</td>
												<td>
													<input type="checkbox" name="rdb_stat_arq_estado" id="rdb_stat_arq_estado" value="1" 
														<?php print ($_dados[0]['stat_estado_arquivado'] == "1") ? " checked=\"checked\"" : "";?> />
												</td>
											</tr>
										</table>
									</div>
									<div class="span1"></div>
									<div class="span3">
										<label><h5>Status União</h5></label>
										<table>
											<tr>
												<td>Reconhecido</td>
												<td>
													<input type="checkbox" name="rdb_stat_rec_uniao" id="rdb_stat_rec_uniao" value="1" 
														<?php //print ($_rdb_reconhecido == "1") ? " checked=\"checked\"" : "";?> />
												</td>
											</tr>
											<tr>
												<td>Não Reconhecido</td>
												<td>
													<input type="checkbox" name="rdb_stat_nrec_uniao" id="rdb_stat_nrec_uniao" value="1" 
														<?php //print ($_rdb_reconhecido == "1") ? " checked=\"checked\"" : "";?> />
												</td>
											</tr>
										</table>
									</div>
									<div class="span3">
										<label><h5>Status PMDA</h5></label>
											<table>
												<tr>
													<td>Aprovado</td>
													<td>
														<input type="checkbox" name="rdb_aprovado_pmda" id="rdb_aprovado_pmda" value="1" 
														<?php //print ($_rdb_reconhecido == "1") ? " checked=\"checked\"" : "";?> />
													</td>
												</tr>
												<tr>
													<td>Em Análise</td>
													<td>
														<input type="checkbox" name="rdb_em_analise_pmda" id="rdb_em_analise_pmda" value="1" 
														<?php //print ($_rdb_reconhecido == "1") ? " checked=\"checked\"" : "";?> />
													</td>
												</tr>
											</table>
									</div>
								
								</div>
									<br>
									<legend>Decreto Homologação </legend>
								<div class="row">
									<div class="span4">
										<label>Número</label>
										<input type="text" name="txt_num_decreto_homo" id="txt_num_decreto_homo" class="span8" />
									</div>
									<div class="span4">
										<label>Dt Publicação</label>
										<input type="text" name="txt_dt_pub_decreto_homo" id="txt_dt_pub_decreto_homo" class="span7" data-mask="99/99/9999" />
									</div>
									<div class="span4">
										<label>Port. Reconhecimento - Número/Data</label>
										<input type="text" name="txt_num_dt_portaria_homo" id="txt_num_dt_portaria_homo" class="" />
									</div>
								</div>
								<div class="row">
									<div class="span4">
										<label>Número/Data/D.O.U</label>
										<input type="text" name="txt_num_dou_homo" id="txt_num_dou_homo" class=""  />
									</div>
									<div class="span4">
									</div>
									<div class="span4">
									</div>
									
								</div>
					</div>
					<div class="span2"></div>
					<div class="span9 text-center">
						<br>
						<input type="button"  class="btn btn-primary" name="btn_dados" id="btn_dados" <?=($param == "") ? "value=\"Salvar\"" : "value=\"Alterar\"";?> />
					</div>
			</form>

		</div>
		<br />
		<br />
		<br />
<?php var_dump($_POST);?>
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
			$( "#aba_dados" ).addClass( "active" );

				$("#btn_dados").click(function(event){

					if(
							($("#id_municipio").val() == 0) ||
							($("#txt_dt_entrada").val() == "") ||
							($("#txt_ano").val() == "") ||
							($("#txt_num_dec_mun").val() == "") ||
							($("#txt_dt_dec_mun").val() ==  "") ||
							($("#txt_dec_vigencia").val() == "") ||
							($("#txt_dt_vencimento").val() == "") ||
							($("#sel_desastre").val() == "") ||
							($("#txt_analista").val() == "")
					){
						alert("Gentileza preencher os campos obrigatórios !");

					}else {
							
		
						var dados = {
								"pagina"			 	   : "dados.processo",
								"txt_num_processo"         : $("#txt_num_processo").val(),
								"txt_val_total"            : $("#txt_val_total").val(),
								"id_municipio"             : $("#id_municipio").val(),
								"txt_dt_entrada"           : $("#txt_dt_entrada").val(),
								"txt_ano"                  : $("#txt_ano").val(),
								"txt_num_dec_mun"          : $("#txt_num_dec_mun").val(),
								"txt_dt_dec_mun"           : $("#txt_dt_dec_mun").val(),
								"txt_dec_vigencia"         : $("#txt_dec_vigencia").val(),
								"txt_dt_vencimento"        : $("#txt_dt_vencimento").val(),
								"sel_desastre"             : $("#sel_desastre").val(),
								"txt_analista"             : $("#txt_analista").val(),
								"rdb_stat_analis_estado"   : $("#rdb_stat_analis_estado").val(),
								"rdb_stat_hom_estado"      : $("#rdb_stat_hom_estado").val(),
								"rdb_stat_arq_estado"      : $("#rdb_stat_arq_estado").val(),
								"rdb_stat_rec_uniao"       : $("#rdb_stat_rec_uniao").val(),
								"rdb_stat_nrec_uniao"      : $("#rdb_stat_nrec_uniao").val(),
								"rdb_aprovado_pmda"        : $("#rdb_aprovado_pmda").val(),
								"rdb_em_analise_pmda"      : $("#rdb_em_analise_pmda").val(),
								"txt_num_decreto_homo"     : $("#txt_num_decreto_homo").val(),
								"txt_dt_pub_decreto_homo"  : $("#txt_dt_pub_decreto_homo").val(),
								"txt_num_dt_portaria_homo" : $("#txt_num_dt_portaria_homo").val(),
								"txt_num_dou_homo"         : $("#txt_num_dou_homo").val(),
								"opcao"                    : $("#btn_dados").val()
			            };
						
						event.preventDefault();
			
						var resp = confirm("Desesa gravar os dados do Processo ?");
			
							if(resp == true){
								$.ajax({
				                    type: 'POST',
				                    url: 'mod_decreto/app/decreto/valida.php',
				                    data: dados,
				                    //dataType: 'json',
				                    success: function(response) {
				                        console.log(response);
				                        alert("Registro adicionado com sucesso !");
				                        //window.location.href = '?modulo=decreto&secao=decreto&acao=processo.dados&id='+dados[1];
				                        //$("#tblMembroEquipe").html(response);
				                    },
				                    error: function(e){
				    					console.log(JSON.stringify(e));
				                    }
				                });
							}else {
								alert('Acão cancelada !');
							}
			
						}
				});

		/* soma data */
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
