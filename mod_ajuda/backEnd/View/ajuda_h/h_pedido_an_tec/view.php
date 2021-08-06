
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

<legend>Visualização <?=$view[1]['tabela']->TABLE_COMMENT?></legend>
<table class="table table-bordered table-striped">

    <tr>
                <td class="col-md-3">Identificador Analise :</td><td><?=$view[0]['id_analise'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">identificador do Usuário :</td><td><?=$view[0]['id_usuario'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador do Pedido :</td><td><?=$view[0]['id_pedido'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data envio :</td><td><?=$view[0]['data_parecer'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Parecer Técnico :</td><td><?=$view[0]['parecer'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Seção do Parecer :</td><td><?=$view[0]['tramit_parecer'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "edit", array('id'=>$view[0]['id_analise'])) ?>">Editar</a>
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
