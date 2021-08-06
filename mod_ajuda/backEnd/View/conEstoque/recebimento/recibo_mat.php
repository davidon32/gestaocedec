<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<?php

# Gabinete Miltar do Governador do Estado de Minas Gerais
# Coordenadoria Estadual de Proteção e Defesa Civil do Estado de Minas Gerais
# Criação 03/04/2020
# Autor : Demetrio da Silva Passos
# Masp: 1296844-2
# recibo de recebimento de materiais transferidos entre deposito


$receb = new TransferenciaMaterial();

$id_transferencia = isset($_GET['id']) ? $_GET['id'] :"";
$dados = $receb->CompRecebMateriais($id_transferencia);
?>
<style>
    *{
        margin: 0 auto;
    }
    div  {
        font-size: 10pt;
    }

    table {
        width: 70%;
    }
    table,td {
        height: 60px;
        text-align: left;
    }
    table, tr {
        text-align: center;

    }

    @media print{
        a:link {
            display: none;
        }
    }

</style>

<br><br>

<p class="text-center"><a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxtransf" class="btn btn-success">Voltar</a></p>

<table>
    <tr>
        <td style="text-align: center; vertical-align: middle">
            <img src="core/imagem/logo_gab.png" width="80">
        </td>
        <td colspan="2" style="text-align: center; vertical-align: middle">
            <h4>Gabinete Militar do Governador de Minas Gerais<br>
            Coordenadoria Estadual de Proteção e Defesa Civil</h4>
        </td>
        <td style="vertical-align: middle">
            <img src="core/imagem/logo_novo_2.png" width="80">
        </td>
    </tr>
    <tr>
    <td></td>
        <td colspan="2">
            <h4><p class="text-center">Comprovante de Recebimento de Materias Transferidos</p></h4>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <b>Transferencia: Nº: </b><?=$dados['id_transferencia'];?>
        </td>
        <td>
            <b>Data Transferencia:</b> <?=DataMysql::dataCompletaVisual($dados['dt_transferencia']);?>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <b>Deposito Origem:</b> <?=Deposito::PegaNomeDeposito($dados['id_dep_origem']);?>
        </td>
        <td>
            <b>Deposito Destino:</b> <?=Deposito::PegaNomeDeposito($dados['id_dep_destino']);?>
        </td>
        <td></td>
    </tr>
    <tr>
    <td></td>
        <td>           
            <b>Motorista:</b> <?=$dados['motorista'];?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    <td></td>
        <td>>
            <b>Veículo Placa:</b> <?=$dados['placa'];?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <b>Data Saida:</b> <?=DataMysql::dataCompletaVisual($dados['dt_saida']);?>
            </td>
        <td>
            <b>Data Chegada:</b> <?=DataMysql::dataCompletaVisual($dados['dt_chegada']);?>
        </td>
        <td></td>
    </tr>
    <tr>
    <td></td>
        <td> 
            <b>Recebido por:</b> <?=$dados['responsavel'];?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    <td></td>
        <td>
            <b>Nº Policia / C.I.:</b> <?=$dados['doc_res'];?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    <td></td>
        <td>
            <b>Houve material danificado no transporte:</b> <?=(($dados['baixa'] == 0) ? "Não" : "Sim");?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    <td></td>
        <td>
            <b>Motivo:</b> <?=$dados['motivo'];?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    <td></td>
        <td colspan="2">
            <br><br>
            <p class="text-left">___________________, ____ de ________________ de _________.</p><br><br>
            <p class="text-center">____________________________________________</p>
            <p class="text-center"><?=$dados['responsavel']?></p>
        </td>
        <td></td>
    </tr>
     