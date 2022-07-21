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
    
    @page {
        size: A4;
    }
    
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
            /*white-space: nowrap;*/
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
        border: 0.5em solid blue;
    }

    #div-icon {
        display:none;
    }
    
</style>

<?php

    $id_deposito = isset($_GET['id_deposito']) ? $_GET["id_deposito"] : die();;
    $id_unidade = isset($_GET['id_unidade']) ? $_GET["id_unidade"] : die();
    
    
    
    $_relatorioAjuda = new RelatorioAju();

?>
<div class="container table table-responsive">
    
<div class='col-md-6 text-center'>
    <?php if(isset($_GET['voltar'])) {
        print "<a class=\"btn btn-success imprimir\" href=\"".FuncaoBase::geraLink('index', 'index', 'index1')."\">Voltar</a>";				 
    }else {
        print "<a class=\"btn btn-success imprimir\" href=\"?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex\">Voltar</a>";				 
    }
    ?>
    
</div>
<div class='col-md-6 text-center'>
    <button type="button" class="btn btn-primary imprimir" onclick="window.print();">Imprimir</button>
</div>
    
    <div class='col-md-12'>
        <table class="table table-bordered">
            <tr>
                <th colspan="8"><legend>ENTRADA DE MATERIAL</legend></th>       
            </tr>
             <tr>
                    <th>COD.ENTRADA</th>
                    <th>COC.MATERIAL</th>
                    <th>NOME MAT.</th>
                    <th>DATA ENTRADA</th>
                    <th>ORIGEM</th>
                    <th>QTD</th>
                    <th>OBS</th>
                    <th>DEP.DESTINO</th>
                    </tr>
            <?php
                $entradas = RelatorioAju::EntradaMaterial(array('id_material'=>$id_unidade, 'id_deposito'=>$id_deposito));
                
                $totalSaida = 0;
                
                $liberacao = RelatorioAju::Liberacao($entradas[0]['id_produto']);
                
                
                
                foreach ($entradas as $key => $value) {
                    
                    //$totalEntrada += $value['quantidade'] ;
                    
                    $cor = ($value['cancelado'] == 1) ? "class='alert'":"";
                    print "<tr>";
                    print "<td {$cor}>".$value['id_produto']."</td>";
                    print "<td {$cor}>".$value['codProd']."</td>";
                    print "<td {$cor}>".$value['nome']."</td>";
                    print "<td {$cor}>". DataMysql::dataVisual($value['dtEntradaSaida'])."</td>";
                    print "<td {$cor}>".$value['origem']."</td>";
                    print "<td {$cor}>".$value['quantidade']."</td>";
                    print "<td {$cor}>".$value['obs']."</td>";
                    print "<td {$cor}>".$value['depDestino']."</td>";
                    print "</tr>";
                    
                    
                    ########## itens de liberacao #########
                    
                    print "<tr><td colspan='8'><table class=\"table table-bordered\">
                        <tr>
                            <th colspan='8'><legend>LIBERAÇÕES</legend></th>       
                        </tr>
                        
                        <tr>
                        <th>Cod.Liberacao</th>
                        <th>Data Liberacao</th>
                        <th>Municipio</th>
                        <th>Usuario Liberac.</th>
                        <th>Beneficiario</th>
                        <th>Evento</th>
                        <th>Material</th>
                        <th>Qtd</th>
                        </tr>";
            
                        foreach ($liberacao as $key => $value) {
                            
                            
                            $material_libera = $_relatorioAjuda::MaterialLibera($value['id_liberacao'],$entradas[0]['codProd']);
                            
                            print "<tr>";
                            print "<td>".$value['id_liberacao']."</td>";
                            print "<td>". DataMysql::dataVisual($value['dataLibera'])."</td>";
                            print "<td>".$value['id_municipio']."</td>";
                            print "<td>".$value['id_usuario']."</td>";
                            print "<td>".$value['beneficiario']."</td>";
                            print "<td>".$value['evento']."</td>";
                            print "<td>".$entradas[0]['nome']."</td>";
                            print "<td>".$material_libera."</td>";
                            print "</tr>";
                            $totalSaida += $material_libera;
                        }
            
                        print "<tr>
                            <td style='text-align:right; font-weight: bold' colspan=\"7\">Total Materiais</td>
                            <td style='font-weight: bold'>".$totalSaida."</td>
                            </tr>
                    </table>";
                       
                    ########## itens de liberacao fim #########    
                }
            ?>
        </td></tr>
                <tr>
                        <td colspan="5"></td>
                        <td colspan="3" style='text-align:right; font-weight: bold; font-size: 15pt'>
                                Total Entrada : <?=$entradas[0]['quantidade']?>
                                <br>
                                Total Saida : <?=$totalSaida?>
                                <br>
                                Material Restante (Saldo Inventário) : <?=($entradas[0]['quantidade']-$totalSaida)?>
                        </td> 
                </tr>
                
                    <!--<tr>
                        <td style='text-align:right; font-weight: bold' colspan="7">Total Materiais</td>
                        <td style='font-weight: bold'><?=$totalEntrada;?></td>
                    </tr>-->
        </table>
        <br>
        
        
    </div>


</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script src="js/script.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    });
</script>