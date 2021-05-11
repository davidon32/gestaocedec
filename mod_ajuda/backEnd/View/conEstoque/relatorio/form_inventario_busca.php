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

<?php

$aju_tp_pedido = new PedidoConEstoqueModel();
$dadosTp_pedido = $aju_tp_pedido->listaid_tp_pedidoAutocomplete();

$aju_almoxarifado = new PedidoConEstoqueModel();
$dadosAlmoxarifado = $aju_almoxarifado->listaid_almoxarifadoAutocomplete();


?>

    <legend>Filtro Relatorio Inventario</legend>
    <form action="<?= FuncaoBase::geraLink("ajuda", "relatoriocon", "rel_inventario")?>" method="POST">

                <!--<div class="col-md-4">
                    <label>Data Inicial de Entrada no Sistema</label>
                    <input class="form-control" type="text" id="data_inicio" name="data_inicio" data-mask="99/99/9999"/>
                    <label>Data Final de Entrada no Sistema</label>
                    <input class="form-control" type="text" id="data_final" name="data_final" data-mask="99/99/9999"/>
                </div>-->
                <div class="col-md-4">
                    <label>Almoxatifado</label>
                    <input class="form form-control" type="text" name="nomeTp_pedido_fk" id="nomeTp_pedido_fk">
                    <input type="hidden" name="id_tp_pedido" id="id_tp_pedido">
                    
                    <label>Armazém</label>
                    <input class="form form-control" type="text" name="nomeAlmoxarifado_fk" id="nomeAlmoxarifado_fk">
                    <input type="hidden" name="id_almoxarifado" id="id_almoxarifado">

                </div>
                <div class="col-md-2">
                        <label>Saldo</label><br>
                            <input type="radio" id="rbSaldo0" name="rbSaldo" value="0" checked="checked"/>&nbsp; Todos<br>
                            <!--<input type="radio" id="rbSaldo1" name="rbSaldo" value="1" />&nbsp; Negativo<br>-->
                            <input type="radio" id="rbSaldo2" name="rbSaldo" value="2" />&nbsp; Com saldo Zerado<br>
                </div>
                    <div class="col-md-2">
                        <label>Inventário Mat. Reserva</label><br>
                            <input type="checkbox" id="ck_reserva" name="ck_reserva" value="0" /><br>
                </div>
                    <div class="col-md-12">
                        <br>
                            <input class="btn btn-info" type="submit" class="btn" id="" name="" value="Pesquisar"/>
                            <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&controller=conestoque&action=relgeral">Voltar</a>
                    </div>
                </form>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">
    
    $(document).ready(function(){
        
        
        /* ###################  fk_aju_tp_pedido ( almoxarifado) ####################*/
       
        var itens = {
            data:
<?php print json_encode($dadosTp_pedido); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#nomeTp_pedido_fk").getSelectedItemData().id_tp_pedido;
                    var nome = $("#nomeTp_pedido_fk").getSelectedItemData().nome;

                    $("#id_tp_pedido").val(id);
                                    }
            }
        };
        /*********** autocomplete ***********/
        $("#nomeTp_pedido_fk").easyAutocomplete(itens);

        /*###########################  final aju_tp_pedido #####################*/
        
        
        /* ###################  fk_aju_almoxarifado () ####################*/
       
        var itens = {
            data:
<?php print json_encode($dadosAlmoxarifado); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#nomeAlmoxarifado_fk").getSelectedItemData().id_almoxarifado;
                    $("#id_almoxarifado").val(id);
                },
            }
        };
        /*********** autocomplete ***********/
        $("#nomeAlmoxarifado_fk").easyAutocomplete(itens);

        /*###########################  final aju_almoxarifado #####################*/
        
        


    });	
</script>