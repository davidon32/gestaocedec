<?php 

$dados = $_relatorioCompdec->relCompdecAssociacao($_sel_associacao);
            $sigla = '';
            $_tot_reg = count($dados);
            print "<table class=\"table table-condensed\">
                    <tr>
                        <td colspan=\"5\"style=\"text-align:center;\">COMPDEC por Associações Microregionais</td>
                    </tr>";
            for($i = 0; $i < $_tot_reg; $i++){
                
             if($dados[$i]['sigla'] != $sigla) {
                 
                 print "<tr>
                            <td colspan=\"7\" style=\"text-align:center;\"><legend>".$dados[$i]['sigla']."</legend></td>
                 </tr>";
                 
                 print "
                    <!--<th>Nº</th>-->
                    <th>Código</th>
                    <th>Município</th>
                        <th>Região</th>
                        <th>Lei / Data</th>
                        <th>Decreto / Data</th>
                        <th>Portaria</th>
                    </tr>";
                 
             }
             
             $sigla = $dados[$i]['sigla'];  

            print "<tr>
                            <!--<td>".($i+1)."</td>-->
                            <td>".$dados[$i]['id_comdec']."</td>
                            <td>".$dados[$i]['nome']."</td>
                            <td>".utf8_encode($dados[$i]['nom_regiao'])."</td>
                            <td>".$dados[$i]['num_lei']." ".DataMysql::dataVisual($dados[$i]['dt_lei'])."</td>
                            <td>".$dados[$i]['num_decreto']." ".DataMysql::dataVisual($dados[$i]['dt_decreto'])."</td>
                            <td>".$dados[$i]['num_portaria']."</td>
                        </tr>";
            
            }
            
            print "<tr>
                <td colspan=\"6\">Total de Registros : ".$_tot_reg."</td>
            </tr>   
            
            </table>";
            
?>