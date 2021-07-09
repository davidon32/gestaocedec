<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';
	

	include_once 'mod_'.$_GET['modulo'].'\Classe\Dec_processoCrud.php';
	include_once 'mod_decreto/modelo/Dec_processoModel.php';

$_login = new Login ();

$_login->logado ();

$_municipio = new Municipio ();

$_processo = new Decretacao ();

$_SESSION['processo'] = array();

$param = isset($_GET['id']) ? $_GET['id'] :"";

//$dados = array();

if(!empty($_POST)){
	//$dados = $_POST;

}elseif(!empty($param)){
	
	//$dados = $_processo->BuscaProcessoDados($param);
	
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
	

	
	//var_dump($dados);
}

	$dadosMun = $_municipio->dadosSelectMunicipio();
	$dadoCobrade = $_processo->dadosCobrade();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" >     
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
                
                <?php


     $_post = isset($_GET['id']) ? $_GET['id'] : "";
     $dec_processo = new dec_processoController();
     $popular = $dec_processo->listagemId($_post);
     $model = new dec_processoModel();
     $dados = $model->popular($popular);
     
     //var_dump($popular);
?>
<div class='span12'>
<?php
     if(empty($_post)){
          print "<input style='text-align:center;' class='btn btn-success' type='button' name='btnSalvar' id='btnSalvar' value='Salvar' title='Clique para Salvar !'>&nbsp;&nbsp;&nbsp;";
     }else{
          print "<input style='text-align:center;' class='btn btn-danger' type='button' name='btnUpdate' id='btnUpdate' value='Atualizar' title='Clique para Atualiar os Dados !'>&nbsp;&nbsp;&nbsp;";
     }
          print "<a href='#myModal' role='button' class='btn btn-primary' data-toggle='modal'>Pesquisar</a>";
          print "&nbsp;&nbsp;&nbsp;<input style='text-align:center;' class='btn btn-primary' type='button' name='btnListagem' id='btnListagem' value='Listagem' title='Clique para listagem de dados !'>";
?>
</div>
<div class='span12 text-center'>
<h3>Processos de decretacao</h3>
</div>
<div class='span12'>
<form action='#' method='post' name='frmDec_processo' id='frmDec_processo'>
     <?php
          if(!empty($_post)){
               print "<input class='span6' type='hidden' name='txtId_processo' id='txtId_processo' value='$_post' >";
          }
     ?>
<div class='row'>
          <div class='span6'>
          <label>Ano da Entrada do Registro<span class='obrigatorio'>&nbsp;&nbsp;&nbsp;&nbsp;* campo Obrigatório</span></label>
          <input class='span6' type='text' name='txtAno_processo' id='txtAno_processo' value='<?=$dados['ano_processo'];?>' >
     </div>
          <div class='span6'>
          <label>Data de Entrada do Registro<span class='obrigatorio'>&nbsp;&nbsp;&nbsp;&nbsp;* campo Obrigatório</span></label>
          <input class='span6' type='text' name='txtData_entrada' id='txtData_entrada' data-mask='99/99/9999' value='<?=DataMysql::dataVisual($dados['data_entrada']);?>' >
     </div>
     </div>
<div class='row'>
          <div class='span6'>
          <label>Numero do Processo</label>
          <input class='span6' type='text' name='txtNum_processo' id='txtNum_processo' value='<?=$dados['num_processo'];?>' >
     </div>
          <div class='span6'>
          <label>Identificador do Municipio<span class='obrigatorio'>&nbsp;&nbsp;&nbsp;&nbsp;* campo Obrigatório</span></label>
          <select class='span6' name='txtId_municipio' id='txtId_municipio'>
          	<option value='<?=$dados['id_municipio'];?>' ><?=$dados['id_municipio'];?></option>
          	
          	<?php 
          	
          		
          		foreach ($dadosMun as $value) {
          			print "<option value=\"".$value['id_municipio']."\">".$value['nome']."</option>";
          		}
          	
          	?>
          	</select>
          
     </div>
     </div>
<div class='row'>
          <div class='span6'>
          <label>Número Decreto Municipal<span class='obrigatorio'>&nbsp;&nbsp;&nbsp;&nbsp;* campo Obrigatório</span></label>
          <input class='span6' type='text' name='txtNum_dec_munic' id='txtNum_dec_munic' value='<?=$dados['num_dec_munic'];?>' >
     </div>
          <div class='span6'>
          <label>Data Decreto Municipal<span class='obrigatorio'>&nbsp;&nbsp;&nbsp;&nbsp;* campo Obrigatório</span></label>
          <input class='span6' type='text' name='txtData_dec_munic' id='txtData_dec_munic' data-mask='99/99/9999' value='<?=DataMysql::dataVisual($dados['data_dec_munic']);?>' >
     </div>
     </div>
<div class='row'>
          <div class='span6'>
          <label>Vigencia do Decreto (dias)<span class='obrigatorio'>&nbsp;&nbsp;&nbsp;&nbsp;* campo Obrigatório</span></label>
          <input class='span6' type='text' name='txtDec_vigencia_proc' id='txtDec_vigencia_proc' value='<?=$dados['dec_vigencia_proc'];?>' >
     </div>
          <div class='span6'>
          <label>Codigo Tipo Desastre<span class='obrigatorio'>&nbsp;&nbsp;&nbsp;&nbsp;* campo Obrigatório</span></label>
          <select class='span6' name='txtCod_desastre_cobr' id='txtCod_desastre_cobr'>
          	<option value='<?=$dados['cod_desastre_cobr'];?>' ><?=$dec_processo->getCobradeId($dados['cod_desastre_cobr']);?></option>
          	<?php 
				foreach ($dadoCobrade as $value) {
          			print "<option value=\"".$value['id_cobrade']."\">".$value['codigo']."- ".$value['descricao']."</option>";
          		}
          	
          	?>
          </select>
     </div>
     </div>
<div class='row'>
          <div class='span6'>
          <label>Data de Vencimento do Decreto</label>
          <input class='span6' type='text' name='txtData_venc_process' id='txtData_venc_process' data-mask='99/99/9999' value='<?=DataMysql::dataVisual($dados['data_venc_process']);?>' >
     </div>
          <div class='span6'>
          <label>Identificador do Funcionário (Analista do Processo)<span class='obrigatorio'>&nbsp;&nbsp;&nbsp;&nbsp;* campo Obrigatório</span></label>
          <input class='span6' type='text' name='txtId_funcionario' id='txtId_funcionario' value='<?=$dados['id_funcionario'];?>' >
     </div>
     </div>
<div class='row'>
          <div class='span6'>
          <label>Número do Decreto Homologação Uniao</label>
          <input class='span6' type='text' name='txtHomo_num_dec' id='txtHomo_num_dec' value='<?=$dados['homo_num_dec'];?>' >
     </div>
          <div class='span6'>
          <label>Data Publicação Decreto Homologação União</label>
          <input class='span6' type='text' name='txtHomo_dt_pub_dec' id='txtHomo_dt_pub_dec' data-mask='99/99/9999' value='<?=DataMysql::dataVisual($dados['homo_dt_pub_dec']);?>' >
     </div>
     </div>
<div class='row'>
          <div class='span6'>
          <label>Numero e Data de Portaria de Reconhecimento União</label>
          <input class='span6' type='text' name='txtHomo_num_dt_port_dec_rec' id='txtHomo_num_dt_port_dec_rec' value='<?=$dados['homo_num_dt_port_dec_rec'];?>' >
     </div>
          <div class='span6'>
          <label>Número do D.O.U</label>
          <input class='span6' type='text' name='txtHomo_num_dt_dou' id='txtHomo_num_dt_dou' value='<?=$dados['homo_num_dt_dou'];?>' >
     </div>
     </div>
<div class='row'>
          <div class='span6'>
          <label>Status reconhecido União</label>
          <input class='span6' type='checkbox' name='rdbStat_rec_uniao' id='rdbStat_rec_uniao' value='<?=$dados['stat_rec_uniao'];?>' >
     </div>
          <div class='span6'>
          <label>Status não Reconhecido União</label>
          <input class='span6' type='checkbox' name='rdbStat_n_rec_uniao' id='rdbStat_n_rec_uniao' value='<?=$dados['stat_n_rec_uniao'];?>' >
     </div>
     </div>
<div class='row'>
          <div class='span6'>
          <label>Status Arquivado Estado</label>
          <input class='span6' type='checkbox' name='rdbStat_arq_estado' id='rdbStat_arq_estado' value='<?=$dados['stat_arq_estado'];?>' >
     </div>
          <div class='span6'>
          <label>Status Homologado Estado</label>
          <input class='span6' type='checkbox' name='rdbStat_hom_estado' id='rdbStat_hom_estado' value='<?=$dados['stat_hom_estado'];?>' >
     </div>
     </div>
<div class='row'>
          <div class='span6'>
          <label>Status Analise Estado</label>
          <input class='span6' type='checkbox' name='rdbStat_analis_estado' id='rdbStat_analis_estado' value='<?=$dados['stat_analis_estado'];?>' >
     </div>
          <div class='span6'>
          <label>Status Aprovado PMDA</label>
          <input class='span6' type='checkbox' name='rdbStat_aprov_pmda' id='rdbStat_aprov_pmda' value='<?=$dados['stat_aprov_pmda'];?>' >
     </div>
     </div>
<div class='row'>
          <div class='span6'>
          <label>Status em Analise PMDA</label>
          <input class='span6' type='checkbox' name='rdbStat_em_analis_pmda' id='rdbStat_em_analis_pmda' value='<?=$dados['stat_em_analis_pmda'];?>' >
     </div>
          <div class='span6'>
     </div>
     </div>
<div class='span12 text-center'>
</div>
</form>
<!-- Modal -->
<div id='myModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-header'>
<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
<h3 id='myModalLabel'>Pesquisa</h3>
</div>
<div class='modal-body'>
<label>Municipio</label>
<input type='text' name='txtPesquisa' id='txtPesquisa'>
<input type='button' class='btn btn-primary' name='btnLista' id='btnLista' value='Pesquisar'>
<div id='list'>
<?php
include_once 'valida.php';
?>
</div>
</div>
</div><!-- modal -->

<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jasny-bootstrap.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/datepicker-pt-BR.js"></script>
<script type="text/javascript">

/*################### ajax #################*/

$(document).ready(function() {


$("#txtData_entrada").datepicker($.datepicker.regional['pt-Br']);
$("#txtData_entrada").datepicker('option','dateFormat','dd/mm/yy');

$("#txtData_dec_munic").datepicker($.datepicker.regional['pt-Br']);
$("#txtData_dec_munic").datepicker('option','dateFormat','dd/mm/yy');

$("#txtData_venc_process").datepicker($.datepicker.regional['pt-Br']);
$("#txtData_venc_process").datepicker('option','dateFormat','dd/mm/yy');

$("#txtHomo_dt_pub_dec").datepicker($.datepicker.regional['pt-Br']);
$("#txtHomo_dt_pub_dec").datepicker('option','dateFormat','dd/mm/yy');

$("#btnSalvar").click(function( event){
     var dados = {
               "id_processo" :$("#txtId_processo").val(),
               "ano_processo" :$("#txtAno_processo").val(),
               "data_entrada" :$("#txtData_entrada").val(),
               "num_processo" :$("#txtNum_processo").val(),
               "id_municipio" :$("#txtId_municipio").val(),
               "num_dec_munic" :$("#txtNum_dec_munic").val(),
               "data_dec_munic" :$("#txtData_dec_munic").val(),
               "dec_vigencia_proc" :$("#txtDec_vigencia_proc").val(),
               "cod_desastre_cobr" :$("#txtCod_desastre_cobr").val(),
               "data_venc_process" :$("#txtData_venc_process").val(),
               "id_funcionario" :$("#txtId_funcionario").val(),
               "homo_num_dec" :$("#txtHomo_num_dec").val(),
               "homo_dt_pub_dec" :$("#txtHomo_dt_pub_dec").val(),
               "homo_num_dt_port_dec_rec" :$("#txtHomo_num_dt_port_dec_rec").val(),
               "homo_num_dt_dou" :$("#txtHomo_num_dt_dou").val(),
               "stat_rec_uniao" :$("#rdbStat_rec_uniao").val(),
               "stat_n_rec_uniao" :$("#rdbStat_n_rec_uniao").val(),
               "stat_arq_estado" :$("#rdbStat_arq_estado").val(),
               "stat_hom_estado" :$("#rdbStat_hom_estado").val(),
               "stat_analis_estado" :$("#rdbStat_analis_estado").val(),
               "stat_aprov_pmda" :$("#rdbStat_aprov_pmda").val(),
               "stat_em_analis_pmda" :$("#rdbStat_em_analis_pmda").val(),
               "opcao" : "Salvar",
     };

     if(
          ($('#ano_processoTxt').val() == "") || 
          ($('#data_entradaTxt').val() == "") || 
          ($('#id_municipioTxt').val() == "") || 
          ($('#num_dec_municTxt').val() == "") || 
          ($('#data_dec_municTxt').val() == "") || 
          ($('#dec_vigencia_procTxt').val() == "") || 
          ($('#cod_desastre_cobrTxt').val() == "") || 
          ($('#id_funcionarioTxt').val() == "") )
     {
          alert('Favor preencher os campos Obrigatórios !');
     }else{

     event.preventDefault();
     var resp = confirm("Deseja gravar os dados do Processos de decretacao ?");
          if(resp == true){
               $.ajax({
                    type: 'POST',
                    url: 'mod_decreto/app/decreto/valida.php',
                    data: dados,
                    //dataType: 'json',
                    success: function(response) {
                         console.log(response);
                              if(response == "sucesso"){
                                   alert("Registro adicionado com sucesso !");
                                   $('#frmDec_processo').trigger("reset");
                              }
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

$("#btnUpdate").click(function( event){
     var dados = {
               "id_processo" :$("#txtId_processo").val(),
               "ano_processo" :$("#txtAno_processo").val(),
               "data_entrada" :$("#txtData_entrada").val(),
               "num_processo" :$("#txtNum_processo").val(),
               "id_municipio" :$("#txtId_municipio").val(),
               "num_dec_munic" :$("#txtNum_dec_munic").val(),
               "data_dec_munic" :$("#txtData_dec_munic").val(),
               "dec_vigencia_proc" :$("#txtDec_vigencia_proc").val(),
               "cod_desastre_cobr" :$("#txtCod_desastre_cobr").val(),
               "data_venc_process" :$("#txtData_venc_process").val(),
               "id_funcionario" :$("#txtId_funcionario").val(),
               "homo_num_dec" :$("#txtHomo_num_dec").val(),
               "homo_dt_pub_dec" :$("#txtHomo_dt_pub_dec").val(),
               "homo_num_dt_port_dec_rec" :$("#txtHomo_num_dt_port_dec_rec").val(),
               "homo_num_dt_dou" :$("#txtHomo_num_dt_dou").val(),
               "stat_rec_uniao" :$("#rdbStat_rec_uniao").val(),
               "stat_n_rec_uniao" :$("#rdbStat_n_rec_uniao").val(),
               "stat_arq_estado" :$("#rdbStat_arq_estado").val(),
               "stat_hom_estado" :$("#rdbStat_hom_estado").val(),
               "stat_analis_estado" :$("#rdbStat_analis_estado").val(),
               "stat_aprov_pmda" :$("#rdbStat_aprov_pmda").val(),
               "stat_em_analis_pmda" :$("#rdbStat_em_analis_pmda").val(),
               "opcao" : "Update",
     };

     if(
          ($('#ano_processoTxt').val() == "") || 
          ($('#data_entradaTxt').val() == "") || 
          ($('#id_municipioTxt').val() == "") || 
          ($('#num_dec_municTxt').val() == "") || 
          ($('#data_dec_municTxt').val() == "") || 
          ($('#dec_vigencia_procTxt').val() == "") || 
          ($('#cod_desastre_cobrTxt').val() == "") || 
          ($('#id_funcionarioTxt').val() == "") )
     {
          alert('Favor preencher os campos Obrigatórios !');
     }else{

     event.preventDefault();
     var resp = confirm("Confirma gravar Alterações dos dados do Processos de decretacao ?");
          if(resp == true){
               $.ajax({
                    type: 'POST',
                    url: 'mod_decreto/app/decreto/valida.php',
                    data: dados,
                    //dataType: 'json',
                    success: function(response) {
                         console.log(response);
                              if(response == "sucesso"){
                                   alert("Registro Alterado com sucesso !");
                                   var result = confirm("Deseja Visualizar o Registro ?");
                                   if(result){;
                                        window.location.href = $(location).attr('origin')+ $(location).attr('pathname') + "id=" + id_processo;
                                   }else{
                                        window.location.href = $(location).attr('origin')+ $(location).attr('pathname');
                                   };
                              }
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

$("#btnLista").click(function( event){
     var dados = {
          "municipio" :$("#txtPesquisa").val(),
          "opcao" : "Pesquisa",
     };

     $.ajax({
          type: 'POST',
          url: 'mod_decreto/app/decreto/valida.php',
          data: dados,
          //dataType: 'json',
          success: function(response) {
               console.log(response);
               $("#list").html(response);
          },
               error: function(e){
               console.log(JSON.stringify(e));
          }
     });
});
$("#btnListagem").click(function( event){
     var dados = {
          "opcao" : "Listagem",
     };

     $.ajax({
          type: 'POST',
          url: 'mod_decreto/app/decreto/valida.php',
          data: dados,
          //dataType: 'json',
          success: function(response) {
               console.log(response);
               window.location.href = 'listagem.php';
          },
               error: function(e){
               console.log(JSON.stringify(e));
          }
     });
});
});

function edit(id){
     window.location.href = "index.php?modulo=decreto&secao=decreto&acao=processodec&id="+id;
     var dados = {
     "id_processo" : id,
     "opcao" : "Edit",
     };
     $.ajax({
          type: 'POST',
          url: 'mod_decreto/app/decreto/valida.php',
          data: dados,
          //dataType: 'json',
          success: function(response) {
               console.log(response);
          },
          error: function(e){
               console.log(JSON.stringify(e));
          }
     });
};
function deletar(id){
var delet = confirm('Deseja realmente deletar o registro ?');
if(delet){
     var dados = {
     "id_processo" : id,
     "opcao" : "Delete",
     };
     $.ajax({
          type: 'POST',
          url: 'od_decreto/app/decreto/valida.php',
          data: dados,
          //dataType: 'json',
          success: function(response) {
               /*console.log(response);
*/               if(response == 'sucesso'){
                    alert('Registro Deletado com Sucesso !');
                    }
          },
          error: function(e){
               console.log(JSON.stringify(e));
          }
     });
}
}
                
/* soma data */
$("#txtDec_vigencia_proc").change(function(){

	var dt_decreto = $("#txtData_dec_munic").val();
	var vigencia   = parseInt($("#txtDec_vigencia_proc").val(), 10);

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
	$("#txtData_venc_process").val(dia + "/" + mes + "/" + joindate.getFullYear()); 

});

</script>               
		</div>
		<br />
		<br />
		<br />
<?php //var_dump($_POST);?>
		<div class="row">
			<div class="span3"></div>
			<div class="span9 text-center">
				<small><?php print RODAPE;?> </small>
			</div>
		</div>
	</div>
	
</body>
</html>
