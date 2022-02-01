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
*  	Org�o 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Função       : Tela para Transfer�ncia de Materiais entre Dep�sitos Avan�ados
*
*******************************************************************************************/

$dadosDeposito = Deposito::ListaDeposito();

?>
    <legend>Transfer&ecirc;ncia de Materiais</legend>
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
	<br>
        <div class="input-group">
            <!-- Adicionar Materiais na Liberacao -->
            <input type="text" class="form col-md-12" name="nome_deposito" id="nome_deposito" placeholder="Deposito Retirada">
            <input type="hidden" name="id_deposito" id="id_deposito"> 
            <span class="input-group-btn">
                <button type="button" class="btn btn-default" id='btnAddMaterial'>Adicionar Materiais</button>
            </span>
        </div><!-- /input-group -->
			
	<p class="text-center"><legend> Materiais da Transferencia</legend></p>

		<?php
				if(isset($_SESSION['cesta']) && (!empty($_SESSION['cesta']))){
					print Pedido::MostraPedido($_SESSION['cesta']);
				}else {
					print "<span class=\"alert alert-danger\">Não foi Adicionado Material para Liberar</span>";
				}
			?>
	</div>
        <div class="col-md-3"></div>
        </div>
	<div class="col-md-12">
		<form action="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=transfgravar" method="POST" name="frm_cesta">

		<div class="col-md-6">
			<label>Data</label>
                        <input class="form-control" name="txt_dt_transferencia" type="text" id="txt_dt_transferencia" data-mask="99/99/9999" value="<?php print date('d/m/Y');?>" maxlength="10"/>
			<input type="hidden" name="opcao" value="transferir">
		</div>
		<div class="col-md-6">	
			<label>Motorista</label>
                        <input class="form-control" type="text" name="txt_motorista" maxlength="70"/>
		</div>
		<div class="col-md-6">	
			<label>Ve&iacute;culo</label>
                        <input class="form-control" type="text" name="txt_veiculo" maxlength="45"/>
		</div>
		<div class="col-md-6">
			<label>Placa</label>
                        <input class="form-control" type="text" name="txt_placa" maxlength="10"/>
		</div>
		<div class="col-md-6">
			<label>Data Saida</label>
                        <input class="form-control" type="text" name="txt_saida" id="txt_saida" data-mask="99/99/9999" value="<?php print date('d/m/Y');?>" maxlength="10"/>
		</div>
		<div class="col-md-6">
			<label>Hora Saída</label>
                        <input class="form-control" type="text" name="txt_hora_saida" data-mask="99:99" maxlength="6"/>
		</div>
		<div class="col-md-6">
			<label>Previs&atilde;o Chegada Data</label>
                        <input class="form-control" type="text" name="txt_chegada" id="txt_chegada" data-mask="99/99/9999" maxlength="10"/>
		</div>
		<div class="col-md-6">
			<label>Previs&atilde;o Chegada Hora</label>
                        <input class="form-control" type="text" name="txt_hora_chegada" data-mask="99:99" maxlength="6"/>
		</div>
		<div class="col-md-12">
			<label>Transferir para Deposito :</label>
			<?php Deposito::PegaDeposito();?>
		</div>
		<div class="col-md-12 text-center">
			<br>
			<input class="btn btn-info" type="submit" onclick="return confirm('Deseja Realmente fazer a Transferencia de Materiais ?');" name="btn_enviar" value="Gravar Transferencia" /> 
			<br>
		</div>
	</div>

	<div class="col-md-12 text-center"><br>
		<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxtransf">Voltar</a>
	</div>		
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">
    
    $('#btnAddMaterial').click(function(){
            var id_deposito = $("#id_deposito").val();
            if(id_deposito.length > 0){
               window.location.href = '<?= FuncaoBase::geraLink("ajuda", "conestoque", "add_mat_transf")?>&id='+id_deposito; 
            }
        });

	$("#txt_dt_transferencia").datepicker({ 
            dateFormat: 'dd/mm/yy',
            maxDate:3,
            minDate:-5,
        }).attr('readonly', 'readonly');
	$("#txt_saida").datepicker({ dateFormat: 'dd/mm/yy' });
	$("#txt_chegada").datepicker({ dateFormat: 'dd/mm/yy' });
        
        /* auto complete deposito */
            var itemDeposito = {
            data:
                <?php print json_encode($dadosDeposito); ?>, // array com os dados
                getValue: "nome", /* alterar com nome do item BD */

                list: {
                    match: {
                    enabled: true
                    },
                onSelectItemEvent: function () {
                    var id = $("#nome_deposito").getSelectedItemData().id_deposito;
                    $("#id_deposito").val(id);
                },
            }
        };
        /*********** autocomplete origem ***********/
        $("#nome_deposito").easyAutocomplete(itemDeposito);
	
</script>
