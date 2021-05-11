

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
$aju_unidade = new Itens_notaConEstoqueModel();

$dadosUnidade = $aju_unidade->listaid_unidadeAutocomplete();
?>

<legend>Cadastro de Itens_nota</legend>
<form action="<?= FuncaoBase::geraLink("ajuda", "itens_nota", "gravar"); ?>" method="post" accept-charset="utf-8" name="frmItens_nota" id="frmItens_nota">

    <div class='col-md-6'>
        <label>Identificador Produto</label>
        <div class="input-group">
            <input type="text" class='form form-control' name='nomeUnidade_fk' id='nomeUnidade_fk' required readonly='readonly'>
            <span onclick="" class="input-group-addon" id="btnBuscaid_unidade">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> 
        </div><input type="hidden" name='id_unidade' id='id_unidade'>
    </div>
    <div class='col-md-6'>
        <label>Quantidade Itens</label>
        <input type="text" class='form form-control' name='qtd' id='qtd' required >
    </div>
    <div class='col-md-6'>
        <label>Valor Unidade</label>
        <input type="text" class='form form-control' name='val_unid' id='val_unid' required >
    </div>
    <div class='col-md-6'>
        <label>Valor Total</label>
        <input type="text" class='form form-control' name='val_total' id='val_total'  required >
    </div>
    <div class='col-md-6'>
        <label>Data Validade</label>
        <input type="text" class='form form-control' name='validade' id='validade' required >
    </div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "conestoque", "index") ?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    </div>
</form>


<!--######################  MODAL aju_unidade ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_unidade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro aju_unidade</h4>
            </div>
            <div class="modal-body">
                <label>Pesquisa</label>
                <input type="text" class="form form-control" name="searcid_unidade" id="searcid_unidade">
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <div class="col-md-6 text-left">
                    <a href="<?= FuncaoBase::geraLink("ajuda", "unidade", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL aju_unidade ####################-->

<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
        $("#frmItens_nota").trigger("reset");






        /* ###################  fk_aju_unidade ####################*/
        $('#btnBuscaid_unidade').click(function () {
            $('#modal_id_unidade').modal('show');
        });

        var itens = {
            data:
<?php print json_encode($dadosUnidade); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_unidade").getSelectedItemData().id_unidade;
                    var nome = $("#searcid_unidade").getSelectedItemData().nome;

                    $("#nomeUnidade_fk").val(nome); // Mudar
                    $("#id_unidade").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_unidade").easyAutocomplete(itens);

        /*###########################  final aju_unidade #####################*/


    });
</script>
