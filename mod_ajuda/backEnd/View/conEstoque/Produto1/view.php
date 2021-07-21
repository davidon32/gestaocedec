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


<table class="table table-striped">
    
    <tr>
        <td colspan="2" class="text-center"><legend>Fornecedores</legend></td>
    </tr>
    
    <tr>
        <td class="col-md-3">Código :</td><td><?=$view['id_unidade'];?></td>
    </tr>
    <tr>
        <td>Nome :</td><td><?=$view['nome'];?></td>
    </tr>
    <tr>
        <td>Descrição:</td><td><?=$view['descricao'];?></td>
    </tr>
    <tr>
        <td>Valor :</td><td><?=$view['valor'];?></td>
    </tr>
    <tr>
        <td>Validade :</td><td><?=$view['validade'];?></td>
    </tr>
    <tr>
        <td>Validade :</td><td><?=$view['validade'];?></td>
    </tr>
    <tr>
        <td>Marca :</td><td><?=$view['id_marca'];?></td>
    </tr>
    <tr>
        <td>Categoria :</td><td><?=$view['id_categoria'];?></td>
    </tr>
    <tr>
        <td>Almoxarifado :</td><td><?=$view['id_almoxarifado'];?></td>
    </tr>
    <tr>
        <td>Fornecedor :</td><td><?=$view['id_fornecedor'];?></td>
    </tr>
    <tr>
        <td>Unidade Medida :</td><td><?=$view['id_unidade_med'];?></td>
    </tr>
    

</table>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "produto", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "produto", "edit", array('id'=>$view['id_unidade'])) ?>">Editar</a>
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


