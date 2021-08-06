<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";






	
?>
<div class="col-md-12 text-center">
	<a class='btn btn-info' href='?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_pag_mat'>Voltar</a>

</div>
<div class="col-md-12 text-center">

<?php 

	$arquivos = Pagamento::getReciboDigPgto($id);

		foreach ($arquivos as $key => $value) {
			print "<li class='glyphicon glyphicon-asterisk'><a href='#' id='".$id."'>". $value."</a></li><br>";
		}
?>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script type="text/javascript">

$(document).ready(function(){

   $("a").click(function(e){
		var nome = $(this).text();
	   	window.location.href = 'anexo/recibo_pgto/'+nome;
	   
   });

});

</script>