
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

<legend><?=$view[1]['tabela']->table_comment?></legend>
<table class="table table-bordered table-striped">

    <tr>
                <td class="col-md-3">Identificador Itens Nota :</td><td><?=$view[0]['id_itens_nota'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador Produto :</td><td><?=$itens_notaModel->getNomeIdFk('aju_unidade','id_unidade', $view[0]['id_unidade'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade Itens :</td><td><?=$view[0]['qtd'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor Unidade :</td><td><?=$view[0]['val_unid'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor Total :</td><td><?=$view[0]['val_total'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data Validade :</td><td><?=$view[0]['validade'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "itens_nota", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "itens_nota", "edit", array('id'=>$view[0]['id_itens_nota'])) ?>">Editar</a>
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
