<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";

    $id_transferencia = isset($_GET['id']) ? $_GET['id'] : "";  

    $_transferencia = new TransferenciaMaterial();
    $dados = $_transferencia->MaterialReceber($id_transferencia);

?>
<style>

    *{
        margin: 0 auto;
    }
    table {
        width: 70%
    }

    @media print {

        .imprimir {
            display: none;
        }
    }

</style>
<?php

    if(isset($_GET['via'])){ ?>
        <div class="col-md-12 text-center"><a href="?token=<?=hash('sha256', md5(VERSAO))?>&ac=itn&modulo=ajuda&controller=relatorio&action=rel_material_tranf" class="btn btn-success imprimir">Voltar</a></div>
    <?php }else if(isset($_GET['idx'])) {
?>
<div class="col-md-12 text-center"><a href="?token=<?=hash('sha256', md5(VERSAO))?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxtransf" class="btn btn-success imprimir">Voltar</a></div>
<?php }else {
?>
<div class="col-md-12 text-center"><a href="?token=<?=hash('sha256', md5(VERSAO))?>&ac=itn&modulo=ajuda&controller=conestoque&action=transf" class="btn btn-success imprimir">Voltar</a></div>
<?php } ?>

<table class="">
    <tr>
        <td style="width: 20%; text-align: center"><img src="core/imagem/logo_gab.png"></td>
        <td style="width: 60%; text-align: center;font-size: 15pt;">Gabinete Militar do Governador de Minas<br>
            Coordenadoria Estadual de Proteção e Defesa Civil</td>
        <td style="width: 20%; text-align: center"><img src="core/imagem/cedec.png"></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center"><h4>Guia de Transferência de Materiais entre Depósitos Avançados</h4></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <table class="table" style="width: 80%">
                <tr>
                    <td><b>Data Transferência</b></td>
                    <td>:<?=date('d/m/Y')?></td>
                </tr>
                <tr>
                    <td><b>Nome Motorista</b></td>
                    <td>:<?=$dados['motorista'];?></td>
                </tr>
                <tr>
                    <td><b>Veículo</b></td>
                    <td>:<?=$dados['veiculo'];?></td>
                </tr>
                <tr>
                    <td><b>Placa</b></td>
                    <td>:<?=$dados['placa'];?></td>
                </tr>
                <tr>
                    <td><b>Depósito Origem : </b><?=Deposito::PegaNomeDeposito($dados['id_dep_origem']);?></td>
                    <td><b>Depósito Destino : </b><?=Deposito::PegaNomeDeposito($dados['id_dep_destino']);?></td>
                </tr>
                <tr>
        
        <td colspan="2" style="text-align: center"><br><h4>Itens da Transferencia</h4></td>

    </tr>
                    
        </table>
        <table class="table">
            <tr>
                <th>Codigo</th>
                <th>Produto</th>
                <th>Descrição</th>
                <th>Quantidade</th>
            </tr>
                    <?php
                            $itens = $_transferencia->getItensTranferecia($id_transferencia);
                    
                            foreach ($itens as $key => $value){
                                print "<tr>";
                                print "<td>".$value['id_produto']."</td>";
                                print "<td>".Produto::PegaNomeProduto($value['id_produto'])."</td>";
                                print "<td>".$value['descricao']."</td>";
                                print "<td>".$value['quantidade']."</td>";
                                
                            }
                            
                            ?>
                            </tr>
            </table>
            
        </td>
        
    </tr>
    <tr>
    <td></td>
    <td>
            _________________, <?php print date('d')." de ".FuncaoBase::numTomes(date('m'))." de ".date('Y') ;?>
        </td>
    </tr>
  
</table>
