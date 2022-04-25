
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
<?php include_once "template/page/corpoHeader.php"; 

?>


<legend><?=$view[1]['tabela']->TABLE_COMMENT?></legend>
<table class="table table-bordered table-striped">

    <!--<tr>
                <td class="col-md-3">Código Prestação de Contas :</td><td><?=$view[0]['id'];?></td>
            </tr>-->

<tr>
                <td class="col-md-3">Identificador do Pedido :</td><td><?=$view[0]['id_pedido'];?></td>
            </tr>

<tr>
                <td class="col-md-3">Código Material :</td><td><?=$view[0]['cod_material'];?></td>
            </tr>

<tr>
                <td class="col-md-3">Nome do Material :</td><td><?=$view[0]['nome_material'];?></td>
            </tr>
<tr>
                <td class="col-md-3">Quantidade :</td><td><?=$view[0]['qtd'];?></td>
            </tr>

<tr>
                <td class="col-md-3">Total de Familias Atendidas :</td><td><?=$view[0]['total_familia_at'];?></td>
            </tr>
  </table>
<br>

<?php 
    $beneficiarios = H_pedido_benefajuda_hModel::listBeneficiario($view[0]['id']);
    
?>
<legend>Beneficiários</legend>
<table class="table table-bordered table-striped">
    
    <tr>
        <th>#</th>
        <th>Nome Beneficiario</th>
        <th>RG</th>
        <th>Comunidade</th>
        <th>Qtd</th>
        <th>Data Entrega</th>
        <th>Opções</th>
    </tr>
    
    <?php
    $total_material = 0;
    foreach ($beneficiarios as $key => $beneficiario) {
        
        
    
        print "<tr>";
        print "<td>".$beneficiario['id']."</td>";
        print "<td>".$beneficiario['nome_beneficiario']."</td>";
        print "<td>".$beneficiario['rg']."</td>";
        print "<td>".$beneficiario['comunidade']."</td>";
        print "<td>".$beneficiario['qtd']."</td>";
        print "<td>". DataMysql::dataVisual($beneficiario['data_entrega'])."</td>";
        print "<td><a href=".FuncaoBase::geraLink("ajuda", "h_pedido_benef", "delete", array('id'=>$beneficiario['id'], 'id_prest_conta'=>$view[0]['id']))."><img src='/core/imagem/delete.png'></a></td>";
        
        print "</tr>";
        $total_material += $beneficiario['qtd'] ;
    }
    
    print "<tr align='right'><td colspan='7'>"
            . "<i>Total Materiais&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>".$total_material."</b>"
            . "</i><br><i>Materiais Restantes: </i><b>".( (($view[0]['qtd']-$total_material)<$view[0]['qtd']) ? "<span style='color:red;font-size:12pt;'>".($view[0]['qtd']-$total_material)."</span>" : ($view[0]['qtd']-$total_material) ) ."</b></td></tr>";
    
    ?>
    
    
</table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_prest", "index", array('id'=>$view[0]['id_pedido'])) ?>">Voltar</a>
<!--<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_prest", "edit", array('id'=>$view[0]['id'])) ?>">Editar</a>-->
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
