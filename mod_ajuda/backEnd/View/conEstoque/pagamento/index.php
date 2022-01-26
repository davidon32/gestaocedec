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
<?php include_once "template/page/corpoHeader.php";?>
<?php
/* ****************************************************************************************
 *   Orgão 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanitária
*
*	Autor        :  Demetrio Silva Passos
*	Função       :  Tela para Pagamento de Materiais Liberados
*
*******************************************************************************************/


	$_pagamento = new Pagamento();
	$dados =$_pagamento->mostraMaterialPagto($_COOKIE['seguranca']['id_deposito'], $_COOKIE['seguranca']['nivel']);

	print "<legend> Pagamento de Materiais Liberados</legend>";

	?>

	<div class="col-md-12">
		<a class="btn btn-info" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=conestoque&action=uprecpgto" title=\"Clique aqui para Pagar o Material\">Upload Recibo Pagamento</a>
		<br>
		<br>
	</div>
	<?php

	echo "<table class=\"table table-bordered table-striped\">
				<tr>
					<td>N&#186;</td>
					<td>Liberado para Munic&iacute;pio</td>
					<td>Data Libera&ccedil;&atilde;o</td>
					<td>Data Limite</td>
					<td>Op&ccedil;&atilde;o</td>
					<td>Material</td>
				</tr>";
			foreach ($dados as $key => $value) {
			
				print "<tr>";
				print "<td>".$value['id_liberacao']."</td>";;
				print "<td>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</td>";
				print "<td>".DataMysql::dataVisual($value['dataLibera'])."</td>";
				print "<td>".DataMysql::dataVisual($value['dtLimite'])."</td>";
				print "<td>";
                                
                                if($_COOKIE['seguranca']['idUser'] != $value['id_usuario'] ) {
                                    print "<a class=\"btn btn-info\" href='index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=pagar&id=".$value['id_liberacao']."' title=\"Clique aqui para Pagar o Material\">Pagar</a></td>";
                                }else {
                                    print "<a class=\"btn btn-default\" title='este pagamento não está disponível para este usuario pois o mesmo quem fez a liberação !'>não disponível</a>";
                                }
				print "<td><button class=\"btn btn-info\" id=\"".$value['id_liberacao']."\" name=\"txtmatlib\" data-toggle=\"modal\" data-target=\"#myModal\" data-whatever=\"".$value['id_liberacao']."\" title=\"Visualizar Material para Pagamento\">Visualizar</button></td>";
				print "</tr>";
			}
			print "</table>";
?>
<div class="col-md-12 text-center">
	<br>
	<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=conestoque&action=index" class="btn btn-success">Voltar</a>
</div>
<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Lista de Materiais da Libera&ccedil;&atilde;o</h4>
      </div>
      <div class="modal-body">
			<div id="material_liberado"></div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div><!--fim modal -->
	<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script type="text/javascript">

  $(document).ready(function(){

	$('#myModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var id = button.data('whatever') // Extract info from data-* attributes

		var dados ={
					"id" : id,
				};
		
		$.ajax({
				type: 'POST',
				url: 'mod_ajuda/backEnd/View/conEstoque/pagamento/item_pgto_visualizar.php?v=<?=md5(VERSAO)?>',
				data: dados,
				success: function(response) {
					$("#material_liberado").html(response);
				}
		});
	})


})

</script>
