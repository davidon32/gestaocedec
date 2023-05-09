<?php $_relatorioCompdec = new RelatorioComdec();
?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<!-- =================== HEADER ============================ -->
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<?php

    if($opcao == "lista_geral"){
	$dados = $_relatorioCompdec->relGeralPlano();
        $titulo = "Lista Geral de Municipios";
    }elseif ($opcao == "lista_com_plano"){
        $dadosPlanos = $_relatorioCompdec->countPlanoPorMunicipio();
        $planos = $_relatorioCompdec->listPlano();
        $titulo = "Lista de Municípios Com Plano de Contingência";
    }elseif($opcao == "lista_sem_plano") {
        $planos = $_relatorioCompdec->relSemPlano();
        $titulo = "Lista de Município sem Plano de Contingência";
    }elseif($opcao == "listakit") {
        $ids = "'40',
'50',
'90',
'163',
'200',
'205',
'210',
'250',
'285',
'320',
'330',
'360',
'370',
'375',
'430',
'520',
'550',
'660',
'710',
'770',
'780',
'790',
'800',
'810',
'820',
'830',
'855',
'860',
'880',
'910',
'990',
'1030',
'1050',
'1080',
'1110',
'1115',
'1130',
'1160',
'1180',
'1230',
'1265',
'1360',
'1380',
'1390',
'1440',
'1460',
'1480',
'1520',
'1580',
'1615',
'1690',
'1700',
'1720',
'1730',
'1740',
'1750',
'1760',
'1770',
'1787',
'1840',
'1850',
'1920',
'2010',
'2015',
'2060',
'2150',
'2200',
'2220',
'2247',
'2270',
'2300',
'2310',
'2320',
'2460',
'2510',
'2520',
'2560',
'2650',
'2680',
'2690',
'2707',
'2720',
'2730',
'2740',
'2870',
'2940',
'2965',
'2970',
'2990',
'3020',
'3030',
'3040',
'3055',
'3065',
'3070',
'3080',
'3130',
'3140',
'3150',
'3180',
'3190',
'3375',
'3390',
'3420',
'3460',
'3507',
'3550',
'3630',
'3650',
'3652',
'3665',
'3695',
'3720',
'3770',
'3835',
'3850',
'3867',
'3910',
'3920',
'4030',
'4053',
'4055',
'4090',
'4150',
'4170',
'4225',
'4270',
'4310',
'4350',
'4465',
'4510',
'4537',
'4540',
'4545',
'4550',
'4587',
'4600',
'4710',
'4760',
'4810',
'4830',
'4875',
'4880',
'4950',
'4990',
'5000',
'5010',
'5015',
'5100',
'5110',
'5140',
'5150',
'5170',
'5190',
'5200',
'5330',
'5340',
'5360',
'5390',
'5440',
'5445',
'5530',
'5600',
'5610',
'5645',
'5710',
'5750',
'5765',
'5810',
'5850',
'5860',
'5870',
'5880',
'5900',
'5935',
'5970',
'5980',
'6000',
'6020',
'6100',
'6105',
'6140',
'6160',
'6165',
'6200',
'6210',
'6220',
'6225',
'6255',
'6257',
'6280',
'6292',
'6320',
'6330',
'6340',
'6350',
'6380',
'6410',
'6430',
'6447',
'6510',
'6550',
'6556',
'6560',
'6570',
'6600',
'6630',
'6640',
'6690',
'6700',
'6720',
'6730',
'6810',
'6840',
'6850',
'6900',
'6905',
'6935',
'6960',
'6980',
'7050',
'7057',
'7090',
'7190',
'7210'";
        $dadosPlanos = $_relatorioCompdec->countPlanoPorMunicipioIds($ids);
        $planos = $_relatorioCompdec->listPlano();
        
        $titulo = "Lista de Município sem Plano de Contingência";
    }
        
    //var_dump($dados);   
        
        print "<div class=\"container\"><div class=\"col-md-12\">";
        
        
        print "<a class=\"btn btn-success\" href=\"".FuncaoBase::geraLink("compdec", "plano", "indexplano")."\">voltar</a>";

        print "<legend>".$titulo."</legend>";
           
        print "<div class='col-md-12'>";              
            print "<table align=\"center\" class=\"table table-bordered table-condensed table-striped\" >";
                                
            print "<tr>
                    <th>#</th>
                    <th>Munic. com Plano</th>
                    <th>Cod.Município</th>
                    <th>Município</th>
                    <th>Data</th>
                    <th>Plano</th>
                    <th>Opção</th>
                    <th>tag</th>
                    <th>-</th>
                   </tr>";

                

                $id_mun = "";
                $num =1;
                $sem_arquivo = 0;
                foreach ($planos as $key => $plano) {
                    
                        if(file_exists("anexo/planoCont/".$plano['file_plano'])){
                            $file =  ( (strlen($plano['file_plano']) > 0) ? "<a onclick=\"javascript:anexoView('anexo/planoCont/".$plano['file_plano']."')\"><img src='/core/imagem/impressao.png'></a>" : "Sem Plano de Contingência");    
                            //$file = "";
                            $tag = "ok";
                        }else {
                            $sem_arquivo ++; 
                            //$file = "<img width=\"25\" src=\"/core/imagem/cancela1.png\" title=\"Arquivo Inexistente\">";
                            $file ="";
                            $tag = "x";
                        }
                    
                    print "<tr>";
                    print "<td class=\"col-md-1\">".($key+1)."</td>";
                    print "<td class=\"col-md-1\">".($id_mun != $plano['id_municipio'] ? $num++ :"")."</td>";

                    print "<td><b>". $plano['id_municipio']."</b></td>";
                    print "<td><b>". Municipio::PegaNomeMunicipio($plano['id_municipio'])."</b></td>";
                    print "<td>".DataMysql::dataCompletaVisual($plano['dt_upload'])."</td>";
                    print "<td>".$plano['file_plano']."</td>";
                    print "<td>";
                        print $file;
                        $id_mun = $plano['id_municipio'];
                    print "</td>";
                    print "<td>".$tag."</td>";
                
                }
             print "</table>";
             print "<table class='table table-bordered'>";
   
                print "<tr>";
                print "<td align=right><label>Municipios com Plano de Contingência Inseridos no sistema: </label></td>";
                print "<td> ".($num-1-$sem_arquivo)."</td>";
                print "</tr>";
                /*print "<tr>";
                print "<td align=right><label>Total Planos de Contingência Hospedados : </label></td>";
                print "<td> ".($key+1)."</td>";
                print "</tr>";*/

             print"</div>"
             . "</div>";
?>
<?php include_once "template/page/rodapePage.php";?>
<script>
    $(document).ready(function(){
        $("a").hover(function(){
            $(this).css('cursor','pointer');
        })   
    });
    
    function anexoView(url){
		window.location.href = url;	
                
	}
</script>