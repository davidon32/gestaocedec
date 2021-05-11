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
        $dados = $_relatorioCompdec->relComPlano();
        $titulo = "Lista do Municipio Com Plano de Contingencia";
    }elseif($opcao == "lista_sem_plano") {
        $dados = $_relatorioCompdec->relSemPlano();
        $titulo = "Lista dos Municipio sem Plano de Contingencia";
    }
        
        
        print "<div class=\"container\"><div class=\"col-md-12\">";
        
        
        print "<a class=\"btn btn-success\" href=\"".FuncaoBase::geraLink("compdec", "plano", "indexplano")."\">voltar</a>";

        print "<legend>".$titulo."</legend>";
            
                       
            print "<table align=\"center\" class=\"table table-condensed\" >";
                                
            print "<tr>
                    <th>#</th>
                    <th>Município</th>
                    <th>Plano</th>
                    <th>Data Envio</th>
                    <th>Qtd Versões</th>
                   </tr>";

            foreach ($dados as $key => $value) {

                print "<tr>";

                print "<td class=\"\">".($key+1)."</td>";
                print "<td class=\"dados\">".$value['nome']."</td>";
                print "<td class=\"dados\"><a href='/anexo/plano_cont/".$value['file_plano']."'>".$value['file_plano']."</a></td>";    
                print "<td class=\"dados\">".$value['dt_upload']."</td>";    
                print "<td class=\"dados\">".$value['qtd_plano']."</td>";    

                
                
             }

             print "</table>";
             
             print"</div></div>";
?>