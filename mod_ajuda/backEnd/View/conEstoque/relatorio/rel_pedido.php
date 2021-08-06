<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php"; ?>
<style type="text/css">
    .sem_quebra {
        white-space: nowrap !important;
    }
    @media print {
        .imprimir {
            display: none;
        }
        font-size: 9pt !important;
    }

    @media screen{

        table {
            width: 800px !important;

        }
    }

    *{
        font-family: Courier;
        font-size: 13px;
        color:#666666;
        vertical-align:text-top;
    }

    body {
        margin: auto;
    }

    table {
        border-collapse: collapse;
    }

    .cabecalho {
        background:#CCCCCC;
        text-align:center;	
    }

    .rodape {
        font-size: 10px;
        text-align: center;
    }

    #bg img { 
        height:100%; 
        opacity:.5; 
        z-index: -1;
        position: absolute;
        margin-left: 10%;
        width: 300px;
        height: 300px;         
    }


</style>


<br><br>
<div align="center" class="col-md-12">
    <a class="btn btn-success imprimir" href="<?= FuncaoBase::geraLink("ajuda", "relatoriocon", "pedidos") ?>">Voltar</a>
</div>
<?php 

if($dados){ 
    
    
    
    
    ?>
<table align="center" width="600">
    <tr>
        <td>
            <div class="rTopoImagem1">
                <img src="/mod_ajuda/imagem/brasaoMG_80x77.png" />
            </div>
        </td>
        <td class="text-center">
            Estado de Minas Gerais<br />
            Gabinete Militar do Governador<br />
            Coordenadoria Estadual de Defesa Civil
        </td>
        <td>
            <img src="/mod_ajuda/imagem/logodefesacivilpng80x77.png" />

        </td>
    <tr>
        <td colspan="3">
            <p></p>
        </td>
    </tr>
</tr>
</table>

<table align="center" width="700" class="table table-cell">
    <tr>
        <th>PEDIDO</th>
        <th>ALMOXARIFADO</th>
        <th>DATA_EMISSAO</th>
        <th>DATA_ENTREGA</th>
        <th>ARMAZEM</th>
        <th>NR.NOTA</th>
        <th>TRANSPORTADORA</th>
        <th>DESTINATARIO</th>
        <th>DESTINATARIO_FINAL</th>
        <th>NOME_DESTINATARIO_FINAL</th>
        <th>OBS</th>
        <th>SITUACAO</th>
        <th>VOLUME</th>
        <th>JUSTIFICATIVA</th>
    </tr>
  <?php }else {
      
      print "<br><br><br><p class='text-center alert alert-danger'>Sem dados para esse filtro </p>";
  }
?>
    <?php
    
        $situacao = new PedidoConEstoqueModel;

    foreach ($dados as $key => $value) {

        print "<tr>";
        
        print "<td>" . $value['id_pedido'] . "</td>";
        print "<td>" . $value['almoxarifado'] . "</td>";
        print "<td>" . date('d/m/Y', strtotime($value['data_emissao'])) . "</td>";
        print "<td>" . (isset($value['data_entrega']) ? date('d/m/Y', strtotime($value['data_entrega'])) : "" ). "</td>";
        print "<td>" . $value['armazem'] . "</td>";
        print "<td>" . $value['id_nota'] . "</td>";
        print "<td>" . $value['transportadora'] . "</td>";
        print "<td>" . $value['destinatario'] . "</td>";
        print "<td>" . $value['destinatario_final'] . "</td>";
        print "<td>" . $value['nome_destinatario_final'] . "</td>";
        print "<td>" . $value['obs'] . "</td>";
        print "<td>" . $situacao->getSituacao($value['situacao']) . "</td>";
        print "<td>" . $value['volume'] . "</td>";
        print "<td>" . $value['justificativa'] . "</td>";
        print "</tr>";
        print "<tr>";
        
        if(isset($value['id_unidade'])) {
        print"<tr>";
        print "<td style='background-color: #E4E4E4' colspan='10'></td>";
        print "<td style='background-color: #E4E4E4'>Código</td>";
        print "<td style='background-color: #E4E4E4'>Nome</td>";
        print "<td style='background-color: #E4E4E4'>Quatidade</td>";
        print "<td style='background-color: #E4E4E4'>Valor Unit.</td>";
        print "</tr>";
        
        print "<td style='background-color: #E4E4E4' colspan='10'>Material</td>";
        print "<td style='background-color: #E4E4E4'>".$value['id_unidade']."</td>";
        print "<td style='background-color: #E4E4E4'>".$value['material']."</td>";
        print "<td style='background-color: #E4E4E4'>".$value['qtd']."</td>";
        print "<td style='background-color: #E4E4E4'>".$value['val_unid']."</td>";
        
        print "<tr>";
        print "<tr><td colspan='14'><div style='width=100%; heigth:1px;'></div></td></tr>";
        }
    }
    ?>
</table>
