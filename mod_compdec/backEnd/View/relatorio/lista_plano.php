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
                    <th>Plano</th>
                   </tr>";

                

                $id_mun = "";
                $num =1;
                foreach ($planos as $key => $plano) {
                print "<tr>";
                print "<td class=\"col-md-1\">".($key+1)."</td>";
                print "<td class=\"col-md-1\">".($id_mun != $plano['id_municipio'] ? $num++ :"")."</td>";
                    
                print "<td><b>". $plano['id_municipio']."</b></td>";
                print "<td><b>". Municipio::PegaNomeMunicipio($plano['id_municipio'])."</b></td>";
                print "<td>".DataMysql::dataCompletaVisual($plano['dt_upload'])."</td>";
                print "<td>".$plano['file_plano']."</td>";
                print "<td>".( (strlen($plano['file_plano']) > 0) ? "<a onclick=\"javascript:anexoView('anexo/planoCont/".$plano['file_plano']."')\"><img src='/core/imagem/impressao.png'></a>" : "Sem Plano de Contingência")."</td>";    
                    $id_mun = $plano['id_municipio'];
                }
                print "</td></tr>";
   
                print "<tr><td></td><td colspan='2' align=right><label>Total Municipios com Plano de Contingência : </label></td><td>".($num-1)."</td></tr>";
                print "<tr><td></td></tr>";
                print "<tr><td></td><td colspan='2' align=right><label>Total Planos de Contingência Hospedados : </label></td><td>".($key+1)."</td></tr>";
                print "<tr><td></td></tr>";

             print "</table>";
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