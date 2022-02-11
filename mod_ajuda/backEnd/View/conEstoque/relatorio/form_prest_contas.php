<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php
include_once "template/page/corpoHeader.php";
?>

<div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-4">
        <p>
            <a href="<?= FuncaoBase::geraLink("ajuda", "relatorio", "form_busca_pos_prest_contas") ?>" class="btn btn-info">Posição Prestação Contas</a><br>
        </p>
    </div>
        <div class="col-md-4">
        <p>
            <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=form_busca_prest_contas" class="btn btn-info">Relatorio Prestaçao de Contas</a><br>
        </p>
    </div>
    <div class="col-md-3"></div>
</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">

    $("#txtDtInicial").datepicker({dateFormat: 'dd/mm/yy'});
    $("#txtDtFinal").datepicker({dateFormat: 'dd/mm/yy'});


    $("#ckListMat").attr("checked", false);
    $("#lista").hide();

    $("#ckListMat").click(function () {

        if ($("#ckListMat").is(":checked")) {

            if ($("#lista").is(":visible")) {

            } else {
                $("#lista").show(700);
            }
            $("#ckListMat").attr("checked", true);
        } else {
            $("#lista").hide(700);
            $("#ckListMat").attr("checked", false);
        }
    });

    var itemMaterial = {
        data:
<?php print json_encode($unidade); ?>, // array com os dados
        getValue: "nome", /* alterar com nome do item BD */

        list: {
            match: {
                enabled: true,
            },
            onSelectItemEvent: function () {
                var nome = $("#nome_material").getSelectedItemData().nome;
                var id = $("#nome_material").getSelectedItemData().id_unidade;
                $("#id_material").val(id);


            }
        },
        template: {
            type: "custom",
            method: function (value, item) {
                return  item.id_unidade + " - " + value;
            }
        },
    };
    /*********** autocomplete origem ***********/
    $("#nome_material").easyAutocomplete(itemMaterial);

</script>