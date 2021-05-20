<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php
$pedidoModel = new PedidoConEstoqueModel();
$unidadeModel = new UnidadeConEstoqueModel();
$fornecedorModel = new Entrada_notaConEstoqueModel();
$dadosTp_pedido = $pedidoModel->listaid_tp_pedidoAutocomplete();

$dadosAlmoxarifado = $pedidoModel->listaid_almoxarifadoAutocomplete();

$dadosDestinatario = $pedidoModel->listaid_destinatarioAutocomplete();

$dadosDestinatarioFinal = $pedidoModel->listaid_destinatario_finalAutocomplete();

$dadosMaterial = $unidadeModel->listaid_unidadeAutocomplete();

$dadosFornecedor = $fornecedorModel->listaid_fornecedorAutocomplete();
?>

<legend>Filtro Relatorio Pedidos</legend>
<form action="<?= FuncaoBase::geraLink("ajuda", "relatoriocon", "rel_pedido") ?>" method="POST">

    <div class="col-md-3">

        <label>Data Inicial</label>
        <input class="form-control" type="text" id="data_inicio" name="data_inicio" data-mask="99/99/9999"/>
        <label>Data Final</label>
        <input class="form-control" type="text" id="data_final" name="data_final" data-mask="99/99/9999"/>

    </div>

    <div class="col-md-3">

        <label>Municipio (Destinatario)</label>
        <input class="form form-control" type="text" name="nomeDestinatario_fk" id="nomeDestinatario_fk">
        <input type="hidden" name="id_destinatario" id="id_destinatario">

        <label>Material</label>
        <input class="form form-control" type="text" name="nomeIdUnidade_fk" id="nomeIdUnidade_fk">
        <input type="hidden" name="id_unidade" id="id_unidade">

    </div>

    <div class="col-md-3">

        <label>Almoxatifado</label>
        <input class="form form-control" type="text" name="nomeTp_pedido_fk" id="nomeTp_pedido_fk">
        <input type="hidden" name="id_tp_pedido" id="id_tp_pedido">

        <label>Armazém</label>
        <input class="form form-control" type="text" name="nomeAlmoxarifado_fk" id="nomeAlmoxarifado_fk">
        <input type="hidden" name="id_almoxarifado" id="id_almoxarifado">

    </div>

    <div class="col-md-3">
        <label>Nr. Nota</label>
        <input class="form form-control" type="text" name="id_nota" id="id_nota">  

        <label>Fornecedor</label>
        <input class="form form-control" type="text" name="nomeFornecedor_fk" id="nomeFornecedor_fk"> 
        <input type="hidden" name="id_fornecedor" id="id_fornecedor">
    </div>
    <div class="col-md-3">
        <label>Destinatario Final</label>
        <input class="form form-control" type="text" name="nomeDestinatarioFinal_fk" id="nomeDestinatarioFinal_fk"> 
        <input type="hidden" name="id_destinatario_final" id="id_destinatario_final">

    </div>

    <div class="col-md-12">
        <br>
        <input class="btn btn-info" type="submit" class="btn" id="" name="" value="Pesquisar"/>
        <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=relgeral">Voltar</a>
    </div>
</form>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">

    $(document).ready(function () {


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


        /* ###################  fk_aju_almoxarifado ( armazem ) ####################*/

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


        /* ###################  fk_material ####################*/

        var itens = {
            data:
<?php print json_encode($dadosMaterial); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#nomeIdUnidade_fk").getSelectedItemData().id_unidade;
                    $("#id_unidade").val(id);
                },
            }
        };
        /*********** autocomplete ***********/
        $("#nomeIdUnidade_fk").easyAutocomplete(itens);

        /*###########################  final material #####################*/


        /* ###################  fk_aju_fornecedor ####################*/

        var itens = {
            data:
<?php print json_encode($dadosFornecedor); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#nomeFornecedor_fk").getSelectedItemData().id_fornecedor;
                    var nome = $("#nomeFornecedor_fk").getSelectedItemData().nome;

                    $("#id_fornecedor").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#nomeFornecedor_fk").easyAutocomplete(itens);

        /*###########################  final fk_aju_fornecedor #####################*/

        /* ###################  fk_destinatario ####################*/

        var itens = {
            data:
<?php print json_encode($dadosDestinatario); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#nomeDestinatario_fk").getSelectedItemData().id_destinatario;
                    var nome = $("#nomeDestinatario_fk").getSelectedItemData().nome;
                    
                    $("#id_destinatario").val(id);
                },
            }
        };
        /*********** autocomplete ***********/
        $("#nomeDestinatario_fk").easyAutocomplete(itens);

        /*###########################  fk_destinatario #####################*/

        /* ###################  fk_aju_destinatario final ####################*/

        var itens = {
            data:
<?php print json_encode($dadosDestinatarioFinal); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#nomeDestinatarioFinal_fk").getSelectedItemData().id_destinatario_final;
                    var nome = $("#nomeDestinatarioFinal_fk").getSelectedItemData().nome;

                    $("#id_destinatario_final").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#nomeDestinatarioFinal_fk").easyAutocomplete(itens);

        /*###########################  fk_aju_destinatario final #####################*/


    });
</script>