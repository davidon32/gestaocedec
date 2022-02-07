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


$_deposito = new Deposito();

$_municipio = new Municipio();

//$unidade = RelatorioAju::itensUnidade();

$unidade = Unidade::ListUnidade();

$eventoModel = new EventoConEstoqueModel;
$eventos = $eventoModel->listaEvento();
?>

<div class="col-md-3"></div>
<div class="col-md-6">   
    <p class="text-center"><legend>Relat&oacute;rio de Prestação de Contas</legend></p>

<form method="POST" action="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=rel_prest_conta" name="frm_rel_prest_conta" >
    <div class="col-md-12">
        <br>
        <label for="ckListMat">Material</label>
        <input class="form form-control" type="text" name="nome_material" id="nome_material" required>
        <input type="hidden" name="id_material" id="id_material" >
        <br><br>
    </div>

    <div class="col-md-12">
        <label>Dep&oacute;sito Destino:</label>
        <?php $_deposito->pegaDeposito(); ?>
    </div>
    <div class="col-md-12">
        <br>
        <label>Data Inicial:</label>
        <input class="form-control" type="text" name="txtDtInicial" id="txtDtInicial" data-mask="99/99/9999" title="Periodo Inicial de Liberações " />
    </div>
    <div class="col-md-12">
        <br>
        <label>Data Final:</label>
        <input class="form-control" type="text" name="txtDtFinal" id="txtDtFinal" data-mask="99/99/9999" title="Periodo Final de Liberações" />
    </div>
    <div class="col-md-12">
        <br>
        <label>Munic&iacute;pio:</label>
        <?php $_municipio->PegaMunicipio(); ?>
    </div>

    <div class="col-md-12">
        <br>
        <label for="listEvento">Evento</label>
        <select name="selEvento" id="selEvento" class="form form-control">
            <option value="">Todos</option>
            <?php
            foreach ($eventos as $evento) {
                print "<option id='" . $evento['id_evento'] . "'>" . $evento['nome'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-12 text-center">
        <input class="btn btn-primary" type="submit" name="pesquisar" value="Pesquisar" />
        &nbsp;&nbsp;<a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex">Voltar</a>				 
    </div>

</form>
</div>
<div class="col-md-3"></div>
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