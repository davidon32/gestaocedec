
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

$id_pedido = isset($_GET['id']) ? $_GET['id'] : "";

$pedido = H_ajuda::Pedido($id_pedido);

$itemPedido = H_ajuda::ItemPedido($id_pedido, "L");

  
?>

<legend>Prestação de Contas</legend>
<table class="table table-bordered">
    <tr>
        <td class="col-md-3">Nº do Pedido :</td><td><?= $pedido['id']; ?></td>
    </tr>
    <tr>
        <td class="col-md-3">Data do Pedido :</td><td><?= DataMysql::dataCompletaVisual($pedido['data_entrada_sistema']); ?></td>
    </tr>
</table>
<br>
    <table class="table table-bordered">
    <?php
        foreach ($itemPedido as $key => $value) {
            $beneficiarios = H_ajuda::beneficiario($value['id']);
    ?>
    
    <tr>
        <th class="">#</th>
        <th class="">Código</th>
        <th class="">Nome do Material</th>
        <th class="">Quantidade :</th>
        <th class="">Total de Familias Atendidas :</th>
    </th>

    <tr>
        <td class=""><?= ($key+1); ?></td>
        <td class=""><?= $value['codigo']; ?></td>
        <td class=""><?= $value['descricao_item']; ?></td>
        <td class=""><?= $value['qtd']; ?></td>
        <td class=""><?= $value['qtd_familia_atendida']; ?></td>
    </tr>
    <?php
        if(count($beneficiarios) >0){
            $total_materiais_prestado_conta = 0;
        ?>
        <tr>
            <td></td>
        <td colspan="4">
            <table class='table table-bordered table-condensed-super'>
                <tr>
                    <th colspan="6" style='text-align:center'>BENEFICIÁRIOS</th>
                </tr>
                <tr>
                    <th style='text-align:center'>#</th>
                    <th style='text-align:center'>Nome Beneficiário</th>
                    <th style='text-align:center'>Identidade</th>
                    <th style='text-align:center'>Comunidade</th>
                    <th style='text-align:center'>Data Entrega</th>
                    <th style='text-align:center'>Qtd Material</th>
                </tr>
       <?php
            foreach ($beneficiarios as $key => $beneficiario) {
        ?>
    
                <tr>
                    <td><?=($key+1)?></td>
                    <td><?=$beneficiario['nome_beneficiario']?></td>
                    <td><?=$beneficiario['rg']?></td>
                    <td><?=$beneficiario['comunidade']?></td>
                    <td><?= DataMysql::dataCompletaVisual($beneficiario['data_entrega'])?></td>
                    <td><?=$beneficiario['qtd']?></td>
                </tr>
            
    <?php
                $total_materiais_prestado_conta += $beneficiario['qtd'];
                $cor = '';
                $title = '';
        }
                if($total_materiais_prestado_conta < $value['qtd']){
                    $cor = 'red';
                    $title = 'Existe Materiais para prestar contas !';
                }
        print "</table>
        </td></tr>
        <tr>
            <td colspan='4'></td>
            <td style='color:".$cor."; text-align:right' title='".$title."'>Total Material Pedido : ".$value['qtd']."<br> Total Materiais Prestado Conta : ".$total_materiais_prestado_conta."<br> Saldo a Prestar Conta : ".($value['qtd'] - $total_materiais_prestado_conta)."</td>
        </tr>
        ";
        }
    
    }
    
    ?>
                
                <tr>
                    <td>Total </td>
                </tr>
</table>
<br>


<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_prest", "index", array('id' => $id_pedido)) ?>">Voltar</a>
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
