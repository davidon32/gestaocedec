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

<?php

$materiais = H_pedido_pedidajuda_hModel::MaterialPedido();

if (isset($_GET['id'])) {
    $id_pedido = (int) $_GET['id'];
} else {
    print "erro de acesso a pagina !";
    die();
}

?>

<legend>Lancamento de Item de Pedido</legend>
<form action="<?= FuncaoBase::geraLink("ajuda", "h_pedido_itens", "gravar", array('voltar'=>'idx_recente')); ?>" method="post" accept-charset="utf-8" name="frmH_pedido_itens" id="frmH_pedido_itens">

<div class='row'>
        <div class="col-md-6">
            <label>Material de Ajuda Humanitária</label>
            <select class="form form-control" name="descricao_item" id="descricao_item">
                <option>Selecione o Material</option>
                <?php
                foreach ($materiais as $material) {
                    print "<option id='" . $material['id_unidade'] . "'>" . $material['nome'] . $material['descricao'] . "</option>";
                }
                ?>
                <input type="hidden" name="id_pedido" id="id_pedido" value="<?= $id_pedido; ?>">

                <!-- id itens_pedido -->
                <input type="hidden" name="id" id="id" value="<?= $id_pedido; ?>">

            </select>
        </div>
    </div>    
    <div class='row'>
        <div class='col-md-2'>
            <input type="hidden" class='form form-control' name='codigo' id='codigo' maxlength='' required readonly="readonly">
        </div>
    </div>

    <div class='row'>
        <div class='col-md-2'>
            <label>Quantidade</label>
            <input type="text" class='form form-control' name='qtd' id='qtd' maxlength='' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-2'>
            <label>Quantidade de Familias Atendidas</label>
            <input type="text" class='form form-control' name='qtd_familia_atendida' id='qtd_familia_atendida' maxlength='' required >
        </div>
    </div>
<div class='row'>
    <div class="col-md-6 text-left">
        <br>
        <button type="submit" class="btn btn-info glyphicon glyphicon-floppy-save" name="btnGravar" id="btnGravar" > Adicionar</button>
    </div>
    <div class="col-md-6 text-right">
        <br>
        <?php
        if(isset($_GET['voltar']) and $_GET['voltar'] == 'idx_recente'){
            print "<a class='btn btn-success' href='".FuncaoBase::geraLink("ajuda", "h_pedido_index", "index")."'>Voltar</a>";
        }else {
            print "<a class='btn btn-success' href='".FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "index")."'>Voltar</a>";
        }
        ?>
    </div>
</div>
</form>
<?php 
    $materiais = H_pedido_pedidajuda_hModel::item_pedido($id_pedido);
    var_dump($materiais);
?>

<!- tabela de materiais do pedido -->
    <div class='row table-responsive'>
        <div class='col-md-1'>
        </div>
        <div class='col-md-10'><br>
            <legend>Materiais</legend>

            <table class="table table-bordered table-striped">
                <tr>
                    <td>Cod. Item</td>
                    <td>Cod. Material</td>
                    <td>Descrição</td>
                    <td>Qtd</td>
                    <td>Qtd Familias At.</td>
                    <td>Opções</td>
                </tr>
<?php
if(count($materiais) > 0){

foreach ($materiais as $key => $material) {

    print "<tr>";
    print "<td class='col-md-1'>" . $material['id'] . "</td>";
    print "<td class='col-md-2'>" . $material['codigo'] . "</td>";
    print "<td class='col-md-5'>" . $material['descricao_item'] . "</td>";
    print "<td class='col-md-1'>" . $material['qtd'] . "</td>";
    print "<td class='col-md-2'>" . $material['qtd_familia_atendida'] . "</td>";
    print "<td class='col-md-1'>";
    print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_itens', 'edit', array('id' => $material['id'])) . "'><img src='/core/imagem/editar.png'></a>";
    print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_itens', 'delete', array('id' => $material['id'], 'id_pedido' => $id_pedido)) . "'><img src='/core/imagem/delete.png'></a>";
    print "</td>";
    print "</tr>";
}
}
?>

            </table>
        </div>
        <div class='col-md-1'>
            &nbsp;
        </div>
    </div>




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

        /* close focus pesquisa */
        $("#frmH_pedido_itens").trigger("reset");
        
        $("#descricao_item").change(function () {
            var selected = $(this).children(":selected").attr("id");

            $("#codigo").val(selected);
        });







    });
</script>
