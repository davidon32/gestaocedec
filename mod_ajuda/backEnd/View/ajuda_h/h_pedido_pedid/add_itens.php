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

$materiais = H_pedido_pedidajuda_hModel::MaterialPedido(1);

if(isset($_GET['id'])){
    $id_pedido = (int)$_GET['id'];   
}else {
    print "erro de acesso a pagina !";
    die();
}


?>    

<form action="<?= FuncaoBase::geraLink("ajuda", "h_pedido_itens", "gravar")?>" method="POST" name="frmAdd" id="frmAdd">
<!-- material -->
<div class='row'>
    
    <div class="col-md-6">
        <label>Material de Ajuda Humanitária</label>
        <select class="form form-control" name="descricao_item" id="descricao_item">
            <option>Selecione o Material</option>
            <?php
            foreach ($materiais as $material) {
                print "<option value='".$material['id_unidade']."'>".$material['nome'].$material['descricao']."</option>";
            }
            
            ?>
            <input type="hidden" name="codigo" id="codigo">
            <input type="hidden" name="id_pedido" id="id_pedido" value="<?=$id_pedido;?>">
            <!-- id itens_pedido -->
            <input type="hidden" name="id" id="id">
            
            <input type="hidden" name="tipo" id="tipo" value='L'>
            <input type="hidden" name="add_pedido" id="add_pedido" value='1'>
            
        </select>
    </div>
</div>

<!-- qtd -->
<div class='row'>
    <div class="col-md-2">
    <label>Quantidade</label>
    <input class="form form-control" type="number" name="qtd" id="qtd" min="1" max="999" >
    </div>
</div>
<!-- Familias atendidas -->
<div class='row'>
    <div class="col-md-2">
    <label>Familias Atentidas</label>
    <input class="form form-control" type="number" name="qtd_familia_atendida" id="qtd_familia_atendida" min="1" max="500" >    
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <br>
        <input class="btn btn-primary" type="submit" name="btn_add" id="btn_add" value="Adicionar">    
    </div>
    <div class="col-md-6 text-right">
        <br>
        <a class="btn btn-success" href='<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "edit", array('id'=>$id_pedido, 'voltar'=>'idx_recente'));?>'>Voltar</a>  
    </div>
    
</div>
     
</form>

<div class='row'>
    <div class='col-md-1'>
</div>
<div class='col-md-10'><br>
    <legend>Materiais</legend>
    
    <table class="table table-bordered">
        <tr>
            <td>Cod. Item</td>
            <td>Codigo Material</td>
            <td>Descrição</td>
            <td>Qtd</td>
            <td>Qtd Familias At.</td>
            <td>Opções</td>
        </tr>
        <?php
        
            $materiais = H_pedido_pedidajuda_hModel::item_pedido($id_pedido, "L");
                       
            foreach ($materiais as $key => $material) {
                
                print "<tr>";
                print "<td>".$material['id']."</td>";
                print "<td>".$material['codigo']."</td>";
                print "<td>".$material['descricao_item']."</td>";
                print "<td>".$material['qtd']."</td>";
                print "<td>".$material['qtd_familia_atendida']."</td>";
                print "<td>";
                    //print "<img id='editar' src='/core/imagem/editar.png'>";
                    print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_itens', 'delete', array('id'=> $material['id'], 'id_pedido' => $material['id_pedido'], 'voltar'=> 'idx_recente'))."'><img src='/core/imagem/delete.png'></a>";
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
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function(){
       
       $("#descricao_item").change(function(){
          $('#codigo').val($("#descricao_item :selected").val());
       });
        
    });
</script>
