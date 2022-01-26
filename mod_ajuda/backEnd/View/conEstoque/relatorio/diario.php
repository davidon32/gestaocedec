<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<style>
    
    * {
     fonte{size : 10pt;}   
    }
    
    @media print {
               
        #cabecalho {
            display: none;
        }
        .imprimir {
            display: none;
        }
        .main-footer{
        display: none;
        }
        .box-header {
            display: none;
        }

        body {
            width: 700px;
            margin: 0 auto;
        }
        th, td {
            padding: 2px !important;
            margin: 1px;
            white-space: nowrap;
        }

        body {
            font-family: calibri;
            color: rgba(94,93,82,1);
        }

    } 

    .break { page-break-before: always; }


    .rodape {
        background-color: #C0C0C0;
    }

    hr.linha {
        border: 1px solid blue;
    }

    #div-icon {
        display:none;
    }
    
</style>
<div class='col-md-12 text-center'>
    <a class="btn btn-success imprimir" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex">Voltar</a>				 
    <br><br>
</div>

<form action="#" method="POST" name="frmSaldo" id="frmSaldo" >
    
    <input type="text" class="form form-control" name="data" id="data" >
    <input type="submit" name="btnEnvia" id="btnEnvia" value="Pesquisar">
</form>


<?php

    $dataHoje = date('Y-m-d');
    
    $data = date('Y-m-d H:i:s', strtotime($dataHoje . ' -1 day'));
    
    $filtro['data'] = $data;
    $filtro['material'] = ''; 
    $_relatorioAjuda = new RelatorioAju();

    $dados = $_relatorioAjuda->saldoAnterior($filtro);
    
   
       
    
$data1 = date('d/m/Y');
$hora = date('H:i:s');
?>
<div class="col-md-3 text-center">
    
</div>
<div class="col-md-6 text-center">
       GABINETE MILITAR DO GOVERNADOR DE MINAS GERAIS <br>
       INVENTÁRIO DE MATERIAIS
   </div>
<div class="col-md-3 text-center">
    <?=$data1." ".$hora?>   
</div>
<div class="col-md-12" style="font-size:10pt;">
    <table class="table table-condensed table-bordered">
        <tr>
            <th>CÓDIGO</th>
            <th>NOME</th>
            <th>ESTOQUE</th>
            <th>DATA</th>
            <th>SALDO</th>
        </tr>
        
        <?php
            foreach ($dados as $key => $value) {

                print "<tr>";
                print "<td>".$value['id_produto']."</td>";
                print "<td>".$value['nome']."</td>";
                print "<td>".Deposito::PegaNomeDeposito($value['id_deposito'])."</td>";
                print "<td>". DataMysql::dataVisual($data)."</td>";
                print "<td>".$value['saldo']."</td>";
                print "</tr>";
            }
        
          
    print "</table>
</div>";
?>



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script type="text/javascript">

$(document).ready(function(){

});


</script>