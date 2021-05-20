<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<style>
    table, tr, th, td {
        text-align: center;
    }
</style>
<br>
<div class="col-md-12 text-center">
  <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=index">Voltar</a>
  <br>
  <br>
</div>

<?php 
  if($_COOKIE['seguranca']['id_deposito'] == '1'){?>

    <div class="col-md-2 text-center">
      <a class="btn btn-info" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=transf">Transferir Material</a>
      <br>
      <br>
      <!--<a class="btn btn-info" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=transfcancela" class="btn window" title="">Cancelar Transferência</a>-->
      
    </div>
    
    <?php } ?>

<div class="col-md-10">
    <p class="text-center"><legend> Materiais em Transito</legend></p>
    <?php 
        $dados = Transito::materialTransito($_COOKIE['seguranca']['id_deposito'], $_COOKIE['seguranca']['nivel']);
        ?>

        <table class="table table-bordered table-striped table-condensed">
            <tr>
                <th>Nº Trans.</th>
                <th>Data Transf.</th>
                <th>Motorisa</th>
                <th>Placa</th>
                <th>Data Saida</th>
                <th>Dep. Origem</th>
                <th>Dep. Destino</th>
                <th>Vis.Mat.</th>
                <th>Opções</th>
            </tr>

            <?php
            
            $permissaoAjudaH = Usuario::getPermissaoAjudaH($_COOKIE['seguranca']['login']);
                foreach ($dados as $key => $value) {
                    print "<tr>";
                    print "<td>".$value['id_transferencia']."</td>";
                    print "<td>".DataMysql::dataVisual($value['dt_transferencia'])."</td>";
                    print "<td>".$value['motorista']."</td>";
                    print "<td>".$value['placa']."</td>";
                    print "<td>".DataMysql::dataCompletaVisual($value['dt_saida'])."</td>";
                    print "<td>".Deposito::PegaNomeDeposito($value['id_dep_origem'])."</td>";
                    print "<td>".Deposito::PegaNomeDeposito($value['id_dep_destino'])."</td>";
                    print "<td><button id=\"".$value['id_transferencia']."\" name=\"txtmattransf\" data-toggle=\"modal\" data-target=\"#myModal\" data-whatever=\"".$value['id_transferencia']."\"><img src='core/imagem/view.png' width='25px' title='Visualizar Materiais'></button></td>";
                    print "<td><a href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=receber&n=".$value['id_transferencia']."\" ><img src='core/imagem/cadastro.png' width='30px' title='Receber Materiais'></a>&nbsp;&nbsp;";
                    
                    print ($permissaoAjudaH['cancela_transf']) ? "<a href=\"".FuncaoBase::geraLink("ajuda", "conestoque", "transfcancela", array('n'=>$value['id_transferencia']))."\"><img src='core/imagem/remove.png' width='25px' title='Cancelar Transferencia'></a>&nbsp;&nbsp;" : "";
                    print "<a href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=relatorio&action=rec_transf_mat&id=".$value['id_transferencia']."&idx=uiuiu\"><img src='core/imagem/recibo.png' width='25px' title='Recibo de Transferencia'></a></td>";
                    print "</tr>";
                }
            ?>
        </table>
</div>
<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Lista de Materiais da Transferencia</h4>
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
				url: 'mod_ajuda/backEnd/View/conEstoque/transferencia/visual_mat_transf.php',
				data: dados,
				success: function(response) {
					$("#material_liberado").html(response);
				}
		});
	})


})

</script>