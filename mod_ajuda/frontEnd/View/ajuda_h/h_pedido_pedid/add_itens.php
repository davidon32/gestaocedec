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

$id = isset($_GET['id']) ? $_GET['id'] : "";

$dados_editar = array();
$id_material = "";

if(isset($_GET['id_material'])){
    $dados_editar = H_pedido_itensajuda_hModel::view($_GET['id_material']);
    $id_material = "edit";
}


if (isset($id)) {
    $id_pedido = (int) $_GET['id_pedido'];
} else {
    print "erro de acesso a pagina !";
    die();
}
?>    
<div class="container-fluid">
    <form action="<?= FuncaoBase::geraLink("ajuda", "h_pedido_itens", "gravar", array('id'=>$id, 'voltar'=> $_GET['voltar'])) ?>" method="POST" name="frmAdd" id="frmAdd">
        <!-- material -->
        <div class='row'>

            <div class="col-md-6">
                <label>Material de Ajuda Humanitária</label>
                <select class="form form-control" name="descricao_item" id="descricao_item">
                    <option <?=isset($dados_editar[0]['codigo']) ? "id='".$dados_editar[0]['codigo']."'> ".$dados_editar[0]['descricao_item']  : "Selecione o Material";?> </option>
<?php
foreach ($materiais as $material) {
    print "<option id='" . $material['id_unidade'] . "'>" . $material['nome'] . $material['descricao'] . "</option>";
}
?>
                    <input type="hidden" name="codigo" id="codigo" value="<?= isset($dados_editar[0]['codigo']) ? $dados_editar[0]['codigo'] : "" ?>">
                    <input type="hidden" name="id_pedido" id="id_pedido" value="<?= $id_pedido; ?>">
                    
                    <!-- id itens_pedido -->
                    <input type="hidden" name="id" id="id" value="<?= isset($dados_editar[0]['id']) ? $dados_editar[0]['id'] :"" ?>">

                    <input type="hidden" name="add_pedido" id="add_pedido" value='1'>

                </select>
            </div>
        </div>

        <!-- qtd -->
        <div class='row'>
            <div class="col-md-4">
                <label>Quantidade de Material</label>
                <input class="form form-control" type="number" name="qtd" id="qtd" min="1" max="999" value="<?= isset($dados_editar[0]['qtd']) ? $dados_editar[0]['qtd'] : ""; ?>" >
            </div>
        </div>
        <!-- Familias atendidas -->
        <div class='row'>
            <div class="col-md-4">
                <label>Qtd Familias Atentidas</label>
                <input class="form form-control" type="number" name="qtd_familia_atendida" id="qtd_familia_atendida" min="1" max="500" value="<?= isset($dados_editar[0]['qtd_familia_atendida']) ? $dados_editar[0]['qtd_familia_atendida'] :"" ?>">    
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <br>
                <input class="btn btn-primary" type="submit" name="btn_add" id="btn_add" value="Adicionar">    
                <input class="btn btn-primary" type="submit" name="btn_update" id="btn_update" value="Atualizar">    
            </div>

        </div>

    </form>

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
$materiais = H_pedido_pedidajuda_hModel::item_pedido($id_pedido);

foreach ($materiais as $key => $material) {

    print "<tr>";
    print "<td class='col-md-1'>" . $material['id'] . "</td>";
    print "<td class='col-md-2'>" . $material['codigo'] . "</td>";
    print "<td class='col-md-5'>" . $material['descricao_item'] . "</td>";
    print "<td class='col-md-1'>" . $material['qtd'] . "</td>";
    print "<td class='col-md-2'>" . $material['qtd_familia_atendida'] . "</td>";
    print "<td class='col-md-1'>";
    print "<img id='editar' src='/core/imagem/editar.png'>";
    print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_itens', 'delete', array('id' => $material['id'], 'id_pedido' => $id_pedido, 'voltar'=>'idx_recente')) . "'><img src='/core/imagem/delete.png'></a>";
    print "</td>";
    print "</tr>";
}
?>

            </table>
        </div>
        <div class='col-md-1'>
            &nbsp;
        </div>
    </div>
    <div class="col-md-12 text-right">
                <br>
                <a class="btn btn-success" href='<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "edit", array('id' => $id_pedido, 'voltar'=>'idx_recente')); ?>'>Voltar</a>  
            </div>
</div>
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
        
        $('#btn_update').hide();
        $("#btn_add").show();
        
        var editar = '<?=$id_material?>';
        if(editar.length > 0){
            $('#btn_update').show();
            $("#btn_add").hide();
            var id = $("#id").val();
            $('#frmAdd').attr('action', 'index.php?modulo=ajuda&controller=h_pedido_itens&action=edit&id=' + id + '"');
        }

        $("#descricao_item").change(function () {
            var selected = $(this).children(":selected").attr("id");

            $("#codigo").val(selected);
        });

        $("#editar").click(function () {

            var id = $("#id").val();

            $("#id").val($(this).closest('tr').find('td')[0].innerText).change();
            $("#descricao_item").val($(this).closest('tr').find('td')[2].innerText).change();
            $('#qtd').val($(this).closest('tr').find('td')[3].innerText);
            $('#qtd_familia_atendida').val($(this).closest('tr').find('td')[4].innerText);

            $("#btn_add").hide();
            $("#btn_update").show();
            $('#frmAdd').attr('action', 'index.php?modulo=ajuda&controller=h_pedido_itens&action=edit&id=' + id + '"');

        });

    });

</script>