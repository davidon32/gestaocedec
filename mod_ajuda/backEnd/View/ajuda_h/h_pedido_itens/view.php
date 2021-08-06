
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
<?php include_once "template/page/corpoHeader.php"; ?>

<legend><?=$view[1]['tabela']->TABLE_COMMENT?></legend>
<table class="table table-bordered table-striped">

    <tr>
                <td class="col-md-3">Identificador Item Pedido :</td><td><?=$view[0]['id'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Código Material :</td><td><?=$view[0]['codigo'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome Descricao Material :</td><td><?=$view[0]['descricao_item'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade :</td><td><?=$view[0]['qtd'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade de Familias Atendidas :</td><td><?=$view[0]['qtd_familia_atendida'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_itens", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_itens", "edit", array('id'=>$view[0]['id'])) ?>">Editar</a>
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
