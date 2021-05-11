
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


<legend><?=$view[1]['tabela']->TABLE_COMMENT?></legend>
<table class="table table-bordered table-striped">

    <tr>
                <td class="col-md-3">Identificador Montagem Carga :</td><td><?=$view[0]['id_montagem'];?></td>
            </tr></div>

<tr>
    <td class="col-md-3">Data Montagem Carga :</td><td><?= DataMysql::dataVisual($view[0]['data_montagem']);?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome Motorista :</td><td><?=$view[0]['motorista'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">placa do veículo :</td><td><?=$view[0]['placa'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3"> Transportadora :</td><td><?=$montagemModel->getNomeIdFk('aju_ctransportadora','id_transportadora', $view[0]['id_transportadora'])->nome;?></td>
            </tr></div>
  </table>
<br>
<table class="table table-bordered table-condensed table-striped">
    <tr>
        <th>Nº Pedido</th>
        <th>Destinatario</th>
        <th>Data Emissão</th>
    </tr>
    
    <?php
    
    foreach ($montagens as $key => $montagem) {
        
        print "<tr>";
        print "<td width='8%'>".$montagem['id_pedido']."</td>";
        print "<td>".$montagem['destinatario']." - ".$montagem['nome']."</td>";
        print "<td>". DataMysql::dataVisual($montagem['data_emissao'])."</td></tr>";
        
        print "<tr>";
        print "<td></td>";
        print "<td colspan='2'>";
        print "<table style='width:80%; margin-left: auto;margin-right: auto;'>";
        
            print "<tr>";
            print "<th>Cod</th>";
            print "<th>Descrição / Marca</th>";
            print "<th>Qtd</th>";
            print "</tr>";
            
            $itens_pedido = $montagemModel->item_pedido($montagem['id_pedido']);

            # itens 
            foreach ($itens_pedido as $key => $item) {
                
                print "<tr>";
                print "<td>".$item->id_unidade."</td>";
                print "<td>".$item->nome." - ".$item->marca."</td>";
                print "<td>".$item->qtd."</td>";
                print "</tr>";
                
            }
            
            print "</table>";
        print "</td>";
        print "</tr>";
        
    }
    
    ?>
    
    
</table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "montagem", "index") ?>">Voltar</a>
<!--<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "montagem", "edit", array('id'=>$view[0]['id_montagem'])) ?>">Editar</a>-->
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "montagem", "impressao", array('id'=>$view[0]['id_montagem'])) ?>">Impressão</a>
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
