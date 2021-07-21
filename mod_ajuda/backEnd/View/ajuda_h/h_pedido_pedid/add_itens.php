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
                print "<option id='".$material['id_unidade']."'>".$material['nome'].$material['descricao']."</option>";
            }
            
            ?>
            <input type="hidden" name="codigo" id="codigo">
            <input type="hidden" name="id_pedido" id="id_pedido" value="<?=$id_pedido;?>">
            <!-- id itens_pedido -->
            <input type="hidden" name="id" id="id">
            
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
        <input class="btn btn-primary" type="submit" name="btn_update" id="btn_update" value="Atualizar">    
    </div>
    <div class="col-md-6 text-right">
        <br>
        <a class="btn btn-success" href='<?= FuncaoBase::geraLink("ajuda", "h_pedido_index", "index");?>'>Voltar</a>  
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
        
            $materiais = H_pedido_pedidajuda_hModel::item_pedido($id_pedido);
                       
            foreach ($materiais as $key => $material) {
                
                print "<tr>";
                print "<td>".$material['id']."</td>";
                print "<td>".$material['codigo']."</td>";
                print "<td>".$material['descricao_item']."</td>";
                print "<td>".$material['qtd']."</td>";
                print "<td>".$material['qtd_familia_atendida']."</td>";
                print "<td>";
                    print "<img id='editar' src='/core/imagem/editar.png'>";
                    print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_itens', 'delete', array('id'=> $material['id']))."'><img src='/core/imagem/delete.png'></a>";
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
    
    $(document).ready(function() {
        
        $('#btn_update').hide();

       $("#descricao_item").change(function(){  
          var selected = $(this).children(":selected").attr("id");
          $("#codigo").val(selected);          
       });
        
        $("#editar").click(function(){
            
            var id = $("#id").val();
          
            $("#id").val($(this).closest('tr').find('td')[0].innerText).change();
            $("#descricao_item").val($(this).closest('tr').find('td')[2].innerText).change();
            $('#qtd').val($(this).closest('tr').find('td')[3].innerText);
            $('#qtd_familia_atendida').val($(this).closest('tr').find('td')[4].innerText);
            
            $("#btn_add").hide();
            $("#btn_update").show();
            $('#frmAdd').attr('action', 'index.php?modulo=ajuda&controller=h_pedido_itens&action=edit&id='+ id +'"');
            
        });
    
    });

</script>