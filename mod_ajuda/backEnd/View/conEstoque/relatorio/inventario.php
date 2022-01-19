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

<?php
    $_relatorioAjuda = new RelatorioAju();

    $dados = $_relatorioAjuda->inventarioGeral($_POST['id_deposito']);

?>

   <div class="col-md-9 text-center">
       GABINETE MILITAR DO GOVERNADOR DE MINAS GERAIS <br>
       INVENTÁRIO DE MATERIAIS
   </div>
<div class="col-md-3 text-center">
    <?=date('d/m/Y')." ".date('H:i:s');?>
</div>
<div class="col-md-12">
    <table class="table table-condensed table-bordered">
        <tr>
            <th>CÓDIGO</th>
            <th>DESCRICAO</th>
            <th>UN</th>
            <th>MARCA</th>
            <th>ESTOQUE</th>
            <th>CUSTO</th>
            <th>QTD</th>
        </tr>
        <?php
            foreach ($dados as $key => $value) {
                
                if($value['saldo'] > 0){
                    $saldo = $value['saldo'];
                    print "<tr>";
                    print "<td>".$value['id_unidade']."</td>";
                    print "<td>".$value['produto'].(!empty($value['descricao']) ? " - ".$value['descricao'] : "") ."</td>";
                    print "<td></td>";
                    print "<td></td>";
                    print "<td>".$value['deposito']."</td>";
                    print "<td></td>";
                    print "<td>".$saldo."</td>";
                    print "</tr>";
                    
                }else{
                    if(true){ // busca transito
                        //$saldo = GerTransito::MarcaTransito($rSaldo[1],$rSaldo[0])
                        
                    }
                }   
                    
                
            }
        
        ?>
        
    </table>
</div>



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