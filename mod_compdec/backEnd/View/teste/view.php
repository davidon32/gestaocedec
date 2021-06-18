
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
                <td class="col-md-3">Id :</td><td><?=$view[0]['id_teste'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data :</td><td><?=$view[0]['data_reg'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Uf :</td><td><?=$view[0]['CodUf'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Cod Mun DV :</td><td><?=$view[0]['Codmundv'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Cod Mun :</td><td><?=$view[0]['Codmun'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome Mun :</td><td><?=$view[0]['NomeMunic'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("compdec", "teste", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("compdec", "teste", "edit", array('id'=>$view[0]['id_teste'])) ?>">Editar</a>
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
