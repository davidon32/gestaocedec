
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

$entrada_nota = new Entrada_notaConEstoqueModel();

$iten_nota = $entrada_nota->lista_produto_nota($view[0]['id_entrada_nota']);

?>


<legend><?=$view[1]['tabela']->TABLE_COMMENT?></legend>
<table class="table table-bordered table-striped">

    <tr>
                <td class="col-md-3">Identificador Entrada Nota :</td><td><?=$view[0]['id_entrada_nota'];?></td>
            </tr>

<tr>
                <td class="col-md-3">Fornecedor :</td><td><?=$entrada_notaModel->getNomeIdFk('aju_cfornecedor','id_fornecedor', $view[0]['id_fornecedor'])->nome;?></td>
            </tr>

<tr>
    <td class="col-md-3">Data Emissao :</td><td><?= DataMysql::dataVisual($view[0]['data_emissao']);?></td>
            </tr>

<tr>
                <td class="col-md-3">Data Entrega :</td><td><?=DataMysql::dataVisual($view[0]['data_entrega']);?></td>
            </tr>

<tr>
                <td class="col-md-3">Armazem :</td><td><?=$entrada_notaModel->getNomeIdFk('aju_calmoxarifado','id_almoxarifado', $view[0]['id_almoxarifado'])->nome;?></td>
            </tr>
            <tr>
                <td class="col-md-3">Almoxarifado :</td><td><?=$entrada_notaModel->getNomeIdFk('aju_ctp_pedido','id_tp_pedido', $view[0]['id_tp_pedido'])->nome;?></td>
            </tr>

<tr>
    <td class="col-md-3">Itens notas :</td><td>
        <table class="table table-condensed">
            <tr>
                <th>Cod Prod</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Valor Inid</th>
                <th>Valor Total</th>
                <th>Validade</th>
            </tr>
            
            <?php 
            
                foreach ($iten_nota as $key => $item) {
                    
                    print "<tr>
                        <th>".$item['id_unidade']."</th>
                        <th>".$item['nome']." - ".$item['descricao']."</th>
                        <th>".$item['qtd']."</th>
                        <th>".$item['val_unid']."</th>
                        <th>".$item['val_total']."</th>
                        <th>".(($item['data_validade'] == '') ? 'N/A' : DataMysql::dataVisual($item['data_validade']))."</th>
                    </tr>";


                }
            ?>
        </table>
        
        
    </td>
            </tr>

  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "entrada_nota", "index") ?>">Voltar</a>
<!--<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "entrada_nota", "edit", array('id'=>$view[0]['id_entrada_nota'])) ?>">Editar</a>-->
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
