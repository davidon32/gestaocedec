
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
                <td class="col-md-3">Id Destinatario :</td><td><?=$view[0]['id_destinatario'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome do Destinatario :</td><td><?=$view[0]['nome'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">CNPJ :</td><td><?=$view[0]['cnpj'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Endereço :</td><td><?=$view[0]['endereco'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Municipio :</td><td><?=$view[0]['municipio'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Estado :</td><td><?=$view[0]['estado'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Cep :</td><td><?=$view[0]['cep'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "destinatario", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "destinatario", "edit", array('id'=>$view[0]['id_destinatario'])) ?>">Editar</a>
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
