
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "conestoque", "movimentacao") ?>">Voltar</a>

<br>
<br>

<?php
$pedido = new PedidoConEstoqueModel();
$pedidos = $pedido->separacaoLista($_dados);


?>

<form action="#" method="POST">
    <div class="col-md-3">
        <label>Pesquisa Nr :</label>
        <input class="form-control" type="text" name="id_pedido" id="id_pedido">
    </div>
    <div class="col-md-2">
        <label>Período Inicial Emissao :</label>
        <input class="form-control" type="text" name="data_pedido_inicio" id="data_pedido_inicio">
    </div>
    <div class="col-md-2">
        <label>Período Final Emissao :</label>
        <input class="form-control" type="text" name="data_pedido_fim" id="data_pedido_fim">
    </div>
    <div class="col-md-3">
        <label>Destinatario :</label>
        <input class="form-control" type="text" name="destinatario" id="destinatario">
    </div>
    <div class="col-md-2">
        <label>&nbsp;</label><br>
        <input class="btn btn-info" type="submit" name="btn_enviar" id="btn_enviar" value="Pesquisar">
    </div>
</form>

<div class="col-md-12">-</div>
<br>
<?php


print "<div class=\"table-responsive col-md-12 \"><table class=\"table table-bordered table-striped table-condensed\">
    <thead>
            <tr>
                <th>id_pedido</th>
<th>data_emissao</th>
<th>id_almoxarifado</th>
<th>id_transportadora</th>
<th>id_destinatario</th>
<th>id_destinatario_final</th>
<th>nome_destinatario_final</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

foreach ($pedidos as $pedido) {

    $dados = [
        'id' => $pedido['id_pedido'],
        'dest' => $pedido['nome_aju_destinatario'],
        'dt_emissao' => $pedido['data_emissao'],
        'dest_final'=> $pedido['nome_aju_destinatario_final']
            ];

    print "<tr>
<td>" . $pedido['id_pedido'] . "</td>
<td>" . DataMysql::dataVisual($pedido['data_emissao']) . "</td>
<td>" . $pedido['nome_aju_almoxarifado'] . "</td>
<td>" . $pedido['nome_aju_transportadora'] . "</td>
<td>" . $pedido['nome_aju_destinatario'] . "</td>
<td>" . $pedido['nome_aju_destinatario_final'] . "</td>
<td>" . $pedido['nome_destinatario_final'] . "</td>";

    print "<td>";
    
    if ($pedido['situacao'] == 1) {
        print " <a href='" . FuncaoBase::geraLink("ajuda", "pedido", "notapedido", array('id' => $pedido['id_pedido'])) . "'><img src='/core/imagem/nota.png' title='Emissao de Nota'></a>";
        print " <a href='" . FuncaoBase::geraLink("ajuda", "pedido", "montagemcarga", array('id' => $pedido['id_pedido'])) . "'><img src='/core/imagem/montacarga.png' width='25' title='Montagem de Carga'></a>";
    } 


    print
            "</td>";

    print "</tr>";
}


print " </tbody></table></div>";
?>


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
