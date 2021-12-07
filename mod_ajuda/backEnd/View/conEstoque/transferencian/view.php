
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

$pedido = new PedidoConEstoqueModel();


var_dump($view);
$volta = isset($_GET['volta']) ? $_GET['volta'] : 'index';

$situacao = "Situacao : ". $pedido->getSituacao($view['situacao']); 
?>

<legend><?= $view[1]['tabela']->TABLE_COMMENT. $situacao ?></legend>
<table class="table table-bordered table-striped">

    <tr>
        <td class="col-md-3">Nº Transferencia :</td><td><?= $view[0]['id']; ?></td>
    </tr></div>

<tr>
    <!-- tp_pedido -->
    <td class="col-md-3">Almoxarifado :</td><td><?= $pedido->getNomeIdFk('aju_ctp_pedido', 'id_tp_pedido', $view[0]['id_tp_pedido'])->nome; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Data Emissão Pedido :</td><td><?= DataMysql::dataVisual($view[0]['data_emissao']); ?></td>
</tr></div>

<tr>
    <!-- almoxarifado -->
    <td class="col-md-3">Armazém :</td><td><?= $pedidoModel->getNomeIdFk('aju_calmoxarifado', 'id_almoxarifado', $view[0]['id_almoxarifado'])->nome; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Transportadora :</td><td><?= $pedidoModel->getNomeIdFk('aju_ctransportadora', 'id_transportadora', $view[0]['id_transportadora'])->nome; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Destinatário :</td><td><?= $pedidoModel->getNomeIdFk('aju_cdestinatario', 'id_destinatario', $view[0]['id_destinatario'])->nome; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Destinatário Final :</td><td><?= $pedidoModel->getNomeIdFk('aju_cdestinatario_final', 'id_destinatario_final', $view[0]['id_destinatario_final'])->nome; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Nome Destinatario Final :</td><td><?= $view[0]['nome_destinatario_final']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Observação :</td><td><?= $view[0]['obs']; ?></td>
</tr>
<tr>
    <td class="col-md-3">Itens Pedido :</td><td>
    <!-- itens pedido -->
    <table class="table table-condensed">
            <tr>
                <th>Cod Prod</th>
                <th>Nome</th>
                <th>Nr.Nota</th>
                <th>Quantidade</th>
                <th>Valor Inid</th>
                <th>Valor Total</th>
                <th>Validade</th>
            </tr>
            
            <?php 

                foreach ($iten_pedido['valor'] as $key => $item) {
                    
                    print "<tr>
                        <td>".$item->id_unidade."</td>
                        <td>".$item->nome." ".$item->descricao."</td>
                        <td>".$item->id_nota."</td>
                        <td>".$item->qtd."</td>
                        <td>R$ ".FuncaoBase::real($item->val_unid)."</td>
                        <td>R$ ". FuncaoBase::real($item->val_total)."</td>
                        <td>".(($item->data_validade == '') ? 'N/A' : DataMysql::dataVisual($item->data_validade))."</td>
                    </tr>";


                }
            ?>
        </table>
    
    
    
    </td>
</tr>



</table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "pedido", $volta) ?>">Voltar</a>
<?php

    if($view[0]['situacao'] == 0){
        print "<a class='btn btn-primary' href='".FuncaoBase::geraLink("ajuda", "pedido", "edit", array('id'=>$view[0]['id_pedido']))."'>Editar</a>";
    }
?>
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
