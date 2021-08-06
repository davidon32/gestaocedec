
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
                <td class="col-md-3"> :</td><td><?=$view[0]['id_permissao'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3"> :</td><td><?=$view[0]['login'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3"> :</td><td><?=$view[0]['nivel'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3"> :</td><td><?=$view[0]['cad_decreto'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Acesso aos Relatórios :</td><td><?=$view[0]['relatorio'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Acesso ao Resumo dos Processos :</td><td><?=$view[0]['rel_resumo'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador do Usuario :</td><td><?=$permissaoModel->getNomeIdFk('cedec_usuario','id_usuario', $view[0]['id_usuario'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Permissao Editar analisar Decreto :</td><td><?=$view[0]['edit_decreto'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("cce", "permissao", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("cce", "permissao", "edit", array('id'=>$view[0]['id_permissao'])) ?>">Editar</a>
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
