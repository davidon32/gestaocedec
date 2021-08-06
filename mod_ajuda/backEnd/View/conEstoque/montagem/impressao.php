<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPagePrint.php"; ?>


<?php
//$_GET['id']
//var_dump($view);

$itens = array();

$totalItens = 0;
$totalGeral = 0.0;
?>

<section class="invoice">


    <a class="btn btn-success print" href="<?= FuncaoBase::geraLink("ajuda", "montagem", "index") ?>">Voltar</a>
    <button class="btn btn-info print" onclick="window.print();">Imprimir</button>
    <br>
    <br>
    <table class="table table-bordered table-striped">

        <tr>
            <td colspan="4"><span style="display: inline-block; width: 33%;">GABINETE MILITAR DO GOVERNADOR</span> 
                <span style="display: inline-block; width: 33%; text-align: center"></span> 
                <span style="display: inline-block; width: 33%; text-align: right">DATA : <?= date("d/m/Y"); ?></span>
            </td>
        </tr>
        <tr>
            <td>RELACAO DE ENTREGAS POR ENDEREÇO - CARGA Nº: <b><?= $view[0]['id_montagem'] ?></b></td>
            <td>DATA EMISSAO : <?= DataMysql::dataVisual($view[0]['data_montagem']) ?></td>
        </tr>
    </table>

    <table class="table table-bordered table-striped table-condensed">
        <tr>
            <th>NÚMERO</th>
            <th>CLIENTE</th>
            <th>ENDERECO</th>
            <th>QTD</th>
            <th>BAIRRO</th>
            <th>CIDADE</th>
            <th>CEP</th>
            <th>ENTREGA</th>
            <th>PESO</th>
            <th>VR. NOTA</th>
        </tr>

        <!--pedidos--> 
        <?php
        foreach ($pedidos as $key => $pedido) {
            
            $totalGeral += $pedido['val_total'];
            
            $itens = $montagemModel->item_pedido($pedido['id_pedido']);
            print "<tr>";
            print "<td>" . $pedido['id_pedido'] . "</td>";
            print "<td>" . $pedido['nome'] . "</td>";
            print "<td>" . $pedido['endereco'] . "</td>";
            print "<td>" . $pedido['qtd'] . "</td>";
            print "<td></td>";
            print "<td>" . $pedido['estado'] . "/." . $pedido['municipio'] . "</td>";
            print "<td>" . $pedido['cep'] . "</td>";
            print "<td>" . DataMysql::dataVisual($pedido['data_entrega']) . "</td>";
            print "<td></td>";
            print "<td>R$ " . FuncaoBase::real($pedido['val_total']) . "</td>";

            print "</tr>";
            print "<tr>";
            print "<td></td>";
            print "<td colspan='9'>";
            ?>

            <!-- itens pedido -->
            <table class="table table-striped table-condensed">
                <tr>
                    <td class="text-center" colspan="7"><b>PRODUTOS</b></td>
                </tr>
                <tr>
                    <td style="width: 5%">Codigo</td>

                    <td style="width: 60%">Descrição</td>
                    <td style="width: 10%">Qtd</td>
                </tr>
                <?php
                
                
            
            //$totalGeral += $pedido['val_total'];
                foreach ($itens as $key => $item) {

                    $totalItens += $item->qtd;
                    print "<tr>";
                    print "<td>" . $item->id_unidade . "</td>";
                    print "<td>" . $item->nome . "</td>";
                    print "<td>" . $item->qtd . "</td>";
                    print "</tr>";
                }

                print "</table>";
            }
            ?>
        </table>
            <div class="col-md-12" style="page-break-after:always;"><hr>
                <div class="col-md-4">Total Pedido(s) : <b><?=count($pedidos);?></b></div>
                <div class="col-md-4">Total Itens: <b><?=$totalItens?></b></div>
                <div class="col-md-4">Total Nota : <b>R$ <?= FuncaoBase::real($totalGeral)?></b></div>
            </div>

        <br>
        <div class="col-md-12 text-center">
            <br>
            <legend>RESUMO LISTAGEM </legend><br>
        </div>
        <div class="col-md-5 text-left">
            CARGA Nº :<?=$_GET['id'];?>
        </div>
        <div class="col-md-5 text-right">
            DATA :<?=date('d/m/Y');?>
        </div>
        <div class="col-md-12">
             <br><br></div>
            <table class="table table-condensed">
                <tr>
                    <td>Código</td>
                    <td>Material / Descrição</td>
                    <td>Qtd</td>
                </tr>
                
                <!-- lista de todos os materiais -->
                <?php
                
                    $itensTodosMontCarga = $itens = $montagemModel->item_pedido_por_montagem($_GET['id']);
                
                            foreach ($itensTodosMontCarga as $key => $value) {
                                
                                print "<tr>";
                                print "<td>".$value->id_unidade."</td>";
                                print "<td>".$value->nome."</td>";
                                 print "<td>".$value->qtd."</td>";
                                 print "</tr>";
                                
                            }
                
                            print "<tr>";
                            print "<td></td>";
                            print "<td></td>";
                            print "<td>Total Resumo : <b>".$totalItens."</b></td>";
                            print "</tr>";
                
                ?> 
            </table>

        </div>
        <div class="col-md-4">TRANSPORTADORA : <b><?=$view[0]['nome_aju_transportadora']?></b></div>
        <div class="col-md-4">NOME DO MOTORISTA : <b><?=strtoupper($view[0]['motorista'])?></b></div>
        <div class="col-md-4">PLACA DO VEÍCULO : <b><?= strtoupper($view[0]['placa'])?></b></div>

        <div class="col-md-12"><br>DATA EMBARQUE : __/___/_____<br><br></div>
        

        <br>
        <table class="table no-border">
            <tr>
                <td class="text-center"><br>__________________________________</td>
                <td class="text-center"><br>__________________________________</td>
            </tr>
            <tr>
                <td class="text-center">ASSINATURA CONFERENTE</td>
                <td class="text-center">ASSINATURA MOTORISTA</td>

            </tr>
        </table>
</section>

<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
