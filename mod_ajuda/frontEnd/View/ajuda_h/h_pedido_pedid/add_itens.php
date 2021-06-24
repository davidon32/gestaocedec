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
<?php

$materiais = H_pedido_pedidajuda_hModel::MaterialPedido();

?>    

<!-- material -->
<div class='row'>
    <div class="col-md-6">
        <label>Material de Ajuda Humanitária</label>
        <select class="form form-control">
            <option>Selecione o Material</option>
            <?php
            foreach ($materiais as $material) {
                print "<option>".$material['nome'].$material['descricao']."</option>";
            }
            
            ?>
        </select>
    </div>
</div>

<!-- qtd -->
<div class='row'>
    <div class="col-md-2">
    <label>Quantidade</label>
    <input class="form form-control" type="number" name="txt_qtd" id="txt_qtd" min="1" max="999" >
    </div>
</div>
<!-- Familias atendidas -->
<div class='row'>
    <div class="col-md-2">
    <label>Familias Atentidas</label>
    <input class="form form-control" type="number" name="txt_qtd_familias" id="txt_qtd_familias" min="1" max="500" >    
    </div>
</div>

<div class='row'>
    <div class='col-md-1'>
</div>
<div class='col-md-10'><br>
    <legend>Materiais</legend>
    
    <table class="table table-bordered">
        <tr>
            <td>Codigo</td>
            <td>Descrição</td>
            <td>Qtd</td>
            <td>Qtd Familias At.</td>
        </tr>
        
    </table>
</div>
<div class='col-md-1'>
    &nbsp;
</div>
</div>