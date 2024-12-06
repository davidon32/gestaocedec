<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
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
<div class="container table table-responsive">

    <div class='col-md-12 text-center'>
        <?php
        if (isset($_GET['voltar']) && $_GET['voltar'] == 'estoque') {

            print "<a class=\"btn btn-success imprimir\" href=\"" . FuncaoBase::geraLink('ajuda', 'conestoque', 'index') . "\">Voltar</a>";
        }elseif($_GET['voltar'] == 'menu') {
            print "<a class=\"btn btn-success imprimir\" href=\"" . FuncaoBase::geraLink('index', 'index', 'index1') . "\">Voltar</a>";
        } else {
            print "<a class=\"btn btn-success imprimir\" href=\"".FuncaoBase::geraLink('ajuda', 'conestoque', 'relIndex') ."\">Voltar</a>";
        }
        ?>

        <button type="button" class="btn btn-primary imprimir" onclick="window.print();">Imprimir</button>
    </div>

    <?php
    $id_deposito = isset($_POST['id_deposito']) ? $_POST["id_deposito"] : "";

    $dataInventario = isset($_POST['txtDtInicial']) ? DataMysql::dataForm($_POST["txtDtInicial"]) : "";

    //$linha = "<td>" . date('d/m/Y') . "</td>";

    if (empty($_POST)) {

        print "<script>window.location.href='" . FuncaoBase::geraLink("ajuda", "relatorio", "form_busca_invet_libera") . "';</script>";
    }

    $_relatorioAjuda = new RelatorioAju();

    /* relatorio deposito especifico */
    if (empty($dataInventario) || $dataInventario == date('Y/m/d')) {       
        $inventarios = $_relatorioAjuda->inventarioGerencial($id_deposito);
    } else {
        $inventarios = $_relatorioAjuda->inventarioGerencial($id_deposito);
        
        //$linha = "<td>" . DataMysql::dataVisual($dataInventario) . "</td>";
        //$dados = $_relatorioAjuda->inventarioGeralSaldoAnterior($dataInventario,$id_deposito);
    }





    $data = date('d/m/Y');
    $hora = date('H:i:s');
    ?>
    <br>
    <div class="col-md-2 text-center"></div>
    <div class="col-md-8 text-center"><br>
        GABINETE MILITAR DO GOVERNADOR DE MINAS GERAIS <br>
        INVENTÁRIO DE MATERIAIS
    </div>
    <div class="col-md-2 text-center"><br>
        <?=$data."  ".$hora?>
    </div>
    <div class="col-md-12 p-2" style="font-size:10pt;">
        <br>
        <table class="table table-condensed table-bordered table-hover table-striped">
            <tr>
                <th class="text-center alert-success">MATERIAL</th>
                <th class="text-center alert-success">DEPÓSITO</th>
                <th class="text-center alert-success">SALDO</th>
            </tr>
            <?php
            
                $total = 0;
                foreach ($inventarios as $key => $inventario) {
                    
                        $dados = $_relatorioAjuda->inventarioMateriaisGerencial("", $inventario['categoria']);
                    
                    if(empty($id_deposito)) {
                    }else {
                        /*  lista de entradas */
                        $dados = $_relatorioAjuda->inventarioMateriaisGerencial($id_deposito, $inventario['categoria']);
                    }
                    
                    print "<tr name='lk_material' data-key=\"".$key."\" class='info'>";
                    print "<td>".$inventario['categoria']."</td>";     
                    print "<td>". ( empty($id_deposito) ? "TODOS" : Deposito::PegaNomeDeposito($inventario['id_deposito']) )."</td>";
                    print "<td><h4 class='text-danger'>".$inventario['saldo']."</h4></td>";
                    print "</tr>";
                    print "<tr name=\"mostra_entradas\" id=\"tes".$key."\">";
                        print "<td colspan='3'>";
                            print "<table class=\"table table-sm table-condensed table-responsive-sm table-bordered table-hover table-striped\">
                                <tr class='danger'>
                                
                                <th>CODIGO </th>
                                <th>MATERIAL/FONTE </th>";
                                print ( (empty($id_deposito)) ? "<th>DEPOSITO</th>" : "" );
                                print "<td>VALOR</td>
                                <td>PESO</td>
                                <th>SALDO</th>
                                </tr>";
                            foreach ($dados as $key1 => $value) {
                                print "<tr>
                                    
                                    <td class='danger'>".$value['id_unidade']."</td>
                                    <td class='danger'>
                                    
                                        <!--INVENTARIO-->
                                        
                                        <a href='#' id='prest".$key1."' name='lkPrest' data-id_mat='".$value['id_unidade']."' data-id_dep='".$id_deposito."'>".$value['material']."/".$value['descricao']."</a>";                                    
                                        
                                     print "</td>";
                                    print ( (empty($id_deposito)) ? "<td class='danger'>".Deposito::PegaNomeDeposito($value['id_deposito'])."</td>" : "" );
                                    print "<td class='danger'>".$value['valor']."</td>
                                        <td class='danger'>".$value['peso']."</td>
                                        <td class='danger '><b class='text-danger'>".$value['saldo']."</b></td>
                                    <tr>";
                                    $total += $value['saldo'];
                            }
                            print "</table>";
                        print "</td>";
                        /* final lista de entradas materiais */
                    print "</tr>";
                    
                    
                }
            
                print "<tr>";
                print "<th colspan='2' class='text-right'><h4>Total de Materiais em Estoque :</h4></th>";
                print "<th><h4 class='text-info'>".$total."</h4></th>";
                "</tr>";
            ?>
            
            
        </table>
</div>
            

    </div>

    <!-- =================== RODAPE CORPO ==================== -->
            <?php include_once "template/page/corpoRodape.php"; ?>
    <!-- =================== RODAPE  ======================== -->
            <?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
    <!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>

    <script src="js/script.js"></script>
    <script type="text/javascript">

            $(document).ready(function () {
                
                $("table tr[name='mostra_entradas']").hide();
                               
                $("table tr[name='lk_material']").click(function(){
                    var key1 = $(this).data('key');
                    $(this).addClass('danger');
                    $("table tr[name='lk_material']").css({"font-style": "normal", "font-weight": "normal"}).addClass('info');
                    $("table tr[name='lk_material']").removeClass('danger');
                    $("table tr[name='lk_material']").addClass('info');

                    $(this).css({"font-style": "italic", "font-weight": "bold"});
                    $('#tes'+key1).addClass('danger');
                    $('#tes'+key1).toggle();
                });
                
                $("#inventario").hide();
                //console.log(checkmobile());
                /* remove colunas mobile */
                if (checkmobile()) {

                    //$("#inventario").tr

                    $("#inventario").find("tr").each(function () {
                        $(this).find("th:eq(0)").remove();
                        $(this).find("td:eq(0)").remove();
                    });

                    $("#inventario").find("tr").each(function () {
                        $(this).find("th:eq(1)").remove();
                        $(this).find("td:eq(1)").remove();
                    });
                    $("#inventario").find("tr").each(function () {
                        $(this).find("th:eq(2)").remove();
                        $(this).find("td:eq(2)").remove();
                    });
                    $("#inventario").find("tr").each(function () {
                        $(this).find("th:eq(3)").remove();
                        $(this).find("td:eq(3)").remove();
                    });

                    $("#inventario").find("tr").each(function () {
                        $(this).find("th:eq(1)").remove();
                        $(this).find("td:eq(1)").remove();
                    });

                }
                
                
                /* rel prest contas */
                $("a[name=lkPrest]").click(function(){
                   
                   var id_material = $(this).data('id_mat');
                   var id_deposito = $(this).data('id_dep');
                   
                   /* ajax */
                   
                   
                   //".FuncaoBase::geraLink('ajuda', 'relatorio', 'rel_prest_conta', ['voltar'=>'menu'])
                   
                   
                    
                });

            });


    </script>