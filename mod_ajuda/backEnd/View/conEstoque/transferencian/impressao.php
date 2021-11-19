<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] ."/core/Model/indexModel.php"; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] ."/mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] ."/template/page/headerPagePrint.php"; ?>


<?php

# nome destinatario final
if(strlen($view[0]['nome_aju_destinatario_final']) > 0) {
    $nome = $view[0]['nome_aju_destinatario_final']. " / ";
}else {
 $nome = $view[0]['nome_aju_destinatario']. " / ";   
}
    
?>

<section class="invoice">
    

    <a class="btn btn-success print" href="<?= FuncaoBase::geraLink("ajuda", "pedido", "separacao") ?>">Voltar</a>
    <button class="btn btn-info print" onclick="window.print();">Imprimir</button>
    <br>
    <br>
    <table class="table table-bordered table-striped">

        <tr>
            <td colspan="4"><span style="display: inline-block; width: 33%;">SEPARAÇÃO DE MERCADORIA : <?=$view[0]['id_pedido']?></span> 
                <span style="display: inline-block; width: 33%; text-align: center">TIPO: PEDIDO</span> 
                <span style="display: inline-block; width: 33%; text-align: right">DATA : <?= date("d/m/Y"); ?></span>
            </td>
        </tr>
    </table>
<table class="table table-bordered table-striped">
        <tr>
            <td style="width: 15%"><b>CLIENTE :</b></td>
            <td style="width: 35%"><?=$nome." ".$view[0]['nome_destinatario_final'];?></td>
            <td style="width: 15%"><b>DATA ENTREGA </b></td>
            <td style="width: 35%"><?= DataMysql::dataVisual($view[0]['data_entrega']); ?></td>
        </tr>
        <tr>
            <td><b>CNPJ :</b></td>
            <td><?=$view[0]['cnpj_destinatario']; ?></td>
            <td><b>ENDERECO :</b></td>
            <td><?=$view[0]['endereco_destinatario']; ?></td>
        </tr>

        <tr>
            <td><b>CIDADE / CEP :</b></td>
            <td><?=$view[0]['municipio_destinatario']."/ ".$view[0]['cep_destinatario']; ?></td>
            <td><b>ESTADO :</b></td>
            <td><?=$view[0]['estado_destinatario']; ?></td>
        </tr>

        <tr>
            <td><b>TRANSPORTADORA :</b></td>
            <td><?=$view[0]['nome_aju_transportadora']; ?></td>
            <td><b>ALMOXARIFADO :</b></td>
            <td><?=$view[0]['nome_aju_almoxarifado']; ?></td>
        </tr>
    </table>

    <table class="table table-bordered table-striped">
        <tr>
            <td class="text-center" colspan="8"><b>PRODUTOS</b></td>
        </tr>
        <tr>
            <td style="width: 5%">#</td>
            <td style="width: 5%">Codigo</td>
            
            <td style="width: 35%">Descrição</td>
            <td style="width: 10%">Marca</td>
            <td style="width: 10%">Unidade</td>
            <td style="width: 5%">Qtd</td>
            <td style="width: 15%">Val Unit.</td>
            <td style="width: 15%">Val Total</td>
        </tr>
        <?php
        foreach ($itens['valor'] as $key => $item) {
            print "<tr>";
            print "<td>" . ($key+1) . "</td>";
            print "<td>" . $item->id_itens_pedido . "</td>";
            print "<td>" . $item->nome . "</td>";
            print "<td>" . $item->nome_marca . "</td>";
            print "<td>" . $item->unidade_med . "</td>";
            print "<td>" . $item->qtd . "</td>";
            print "<td>R$ " . FuncaoBase::real($item->val_unid) . "</td>";
            print "<td>R$ " . FuncaoBase::real($item->val_total) . "</td>";
            print "</tr>";
        }
        ?>
    </table>
    <br>
    <table class="table table-bordered table-striped">
        <tr>
            <td><b>Obs:<br><?= $view[0]['obs']; ?></td>
        </tr>
    </table>
    <br><br>
    <table class="table no-border">
        <tr>
            <td class="text-center">__________________________________</td>
            <td class="text-center">__________________________________</td>
            <td class="text-center">__________________________________</td>
        </tr>
        <tr>
            <td class="text-center">SEPARADOR</td>
            <td class="text-center">CONFERENTE</td>
            <td class="text-center">VOLUME</td>
        </tr>
    </table>
</section>

<!-- =================== RODAPE  ======================== -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] ."/template/page/rodape.php" ?>
