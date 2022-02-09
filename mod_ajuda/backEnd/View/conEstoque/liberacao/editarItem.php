<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php
include_once "template/page/corpoHeader.php";

$_deposito = new Deposito();

$_controleSaldo = new ControleSaldo();

$_pedido = new Pedido();

/* * ***************************************************************************************
 *   Org�o 		: Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
 * 	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
 *
 * 	Autor        : Demetrio Silva Passos
 * 	Fun��o       : editar item de liberacao
 *
 * ***************************************************************************************** */

$id_temLib = isset($_GET['id']) ? $_GET['id'] : "";

if (empty($id_temLib)) {
    print "Item não encontrado para edição !";
    die();
}


$dadosItemLib = Liberacao::DadosItemLiberacao($id_temLib);

var_dump($dadosItemLib);
?>

<div class="row-fluid">
    <legend>Dados Item Liberação nº <?= $dadosItemLib['id_liberacao'] ?></legend>
    <form method="POST" action="#" name="frmEditarItemLib" id="frmEditarItemLib">
        <div class='row'>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <label>Descrição</label>
                <input type="text" class="form form-control" value="<?= $dadosItemLib['descricao'] ?>">
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class='row'>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <label>Cod Entrada</label>
                <input type="text" class="form form-control" value="<?= $dadosItemLib['id_entrada'] ?>">
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class='row'>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <label>Evento</label>
                <select name="evento" class="form-control" required>
                    <option></option>
                    <?php
                    Material::Evento();
                    ?>

                </select>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            <label>Quantidade :</label>
            <input type="text" name="qtd" id="txtQtd" size="25" maxlength="6" class="form-control" readonly value="<?=$dadosItemLib['quantidade'];?>">
            </div>
        </div>	

        <div class="col-md-12 text-center">
            <br>
            <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "conestoque", "correcao")?>">Voltar</a>
            <input class="btn btn-primary" type="submit" name="btnGravar" value="Gravar">
            <br><br>
        </div>
    </form>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">
    $(document).ready(function () {

        $("a[name='lk_material']").click(function () {

            alert($(this).data('id_material'));
        });



        var id = $("#id_deposito").val();

        if (typeof id !== 'undefined') {
            $("#id").load('mod_ajuda/backEnd/View/conEstoque/liberacao/saldo_por_deposito.php?id=' + id);
        }

        $("#id_deposito").change(function () {
            var id = $("#id_deposito").val();
            $("#id").load('mod_ajuda/backEnd/View/conEstoque/liberacao/saldo_por_deposito.php?id=' + id);


        });

        $("#txtQtd").blur(function () {
            var num = $("#txtQtd").val();

            numInt = parseInt(num);
            $("#txtQtd").val(numInt);
        });
    });

    var itensProduto = {
        data:
<?php print json_encode($itensProduto); ?>, // array com os dados
        getValue: "nome",
        template: {
            type: "custom",
            method: function (value, item) {
                return value + " | " + item.descricao + " | Saldo :  " + item.saldo;
            }
        },
        list: {
            match: {
                enabled: true
            },
            onSelectItemEvent: function () {
                var id = $("#nome_produto").getSelectedItemData().id_unidade;
                $("#id_produto").val(id);

                //$("#txtIdComunidadeSearch").val(value).trigger("change");
            }

        }

    };
    $("#nome_produto").easyAutocomplete(itensProduto);
</script>