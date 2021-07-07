
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
                <td class="col-md-3">Idenfiticador Tabela :</td><td><?=$view[0]['id_teste'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data Registro :</td><td><?=$view[0]['data_reg'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Codigo UF :</td><td><?=$view[0]['CodUf'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Codigo Municpio DV :</td><td><?=$view[0]['Codmundv'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Checkebox 1 :</td><td><?=$view[0]['ck_check'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Cod Municipio :</td><td><?=$view[0]['Codmun'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome Municipio :</td><td><?=$view[0]['NomeMunic'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Radio 2 :</td><td><?=$view[0]['rb_radio'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("teste", "teste", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("teste", "teste", "edit", array('id'=>$view[0]['id_teste'])) ?>">Editar</a>
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
