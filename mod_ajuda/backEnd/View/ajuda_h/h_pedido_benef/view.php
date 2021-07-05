
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
                <td class="col-md-3">Identificador Prestação de Contas :</td><td><?=$view[0]['id'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome Beneficiário :</td><td><?=$view[0]['nome_beneficiario'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identidade do Beneficiário :</td><td><?=$view[0]['rg'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Comunidade do Beneficiário :</td><td><?=$view[0]['comunidade'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade de Material :</td><td><?=$view[0]['qtd'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data de Entrega do Material :</td><td><?=$view[0]['data_entrega'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_benef", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_benef", "edit", array('id'=>$view[0]['id'])) ?>">Editar</a>
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
