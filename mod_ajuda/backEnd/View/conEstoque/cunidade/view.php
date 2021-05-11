
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

<legend><?=$view[1]['tabela']->TABLE_COMMENT?></legend>
<table class="table table-bordered table-striped">

    <tr>
                <td class="col-md-3">Código :</td><td><?=$view[0]['id_unidade'];?></td>
            </tr>

<tr>
                <td class="col-md-3">Nome do Material :</td><td><?=$view[0]['nome'];?></td>
            </tr>

<tr>
                <td class="col-md-3">Descrição Material :</td><td><?=$view[0]['descricao'];?></td>
            </tr>

<tr>
    <td class="col-md-3">Valor Unitário Material :</td><td>R$ <?= FuncaoBase::real($view[0]['valor']);?></td>
            </tr>

<tr>
    <td class="col-md-3">Validade Material :</td><td><?= DataMysql::dataVisual($view[0]['data_validade']);?></td>
            </tr>

<tr>
                <td class="col-md-3">Marca :</td><td><?=$unidadeModel->getNomeIdFk('aju_cmarca','id_marca', $view[0]['id_marca'])->nome;?></td>
            </tr>

<tr>
                <td class="col-md-3">Categoria :</td><td><?=$unidadeModel->getNomeIdFk('aju_ccategoria','id_categoria', $view[0]['id_categoria'])->nome;?></td>
            </tr>

<tr>
                <!--<td class="col-md-3">Armazém :</td><td><?=$unidadeModel->getNomeIdFk('aju_calmoxarifado','id_almoxarifado', $view[0]['id_almoxarifado'])->nome;?></td>
            </tr>

<tr>
                <td class="col-md-3">Fornecedor :</td><td><?=$unidadeModel->getNomeIdFk('aju_cfornecedor','id_fornecedor', $view[0]['id_fornecedor'])->nome;?></td>
            </tr>-->

<tr>
                <td class="col-md-3">Unidade de Medida :</td><td><?=$unidadeModel->getNomeIdFk('aju_cunidade_med','id_unidade_med', $view[0]['id_unidade_med'])->nome;?></td>
            </tr>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "cunidade", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "cunidade", "edit", array('id'=>$view[0]['id_unidade'])) ?>">Editar</a>
<br>
<br>

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

    });
</script>
