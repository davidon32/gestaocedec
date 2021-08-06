<?php
$dados = $_relatorioCompdec->relCompdecRegiao($_sel_regiao);
            
            $regiao = '';
            //var_dump($dados);
            
            $_tot_reg = count($dados);
            
            print "<table class=\"table table-condensed\">
            
                    <tr>
                        <td colspan=\"9\"style=\"text-align:center;\">Relação de COMPDEC por Região do Estado</td>
                    </tr>";
            
            

            for($i = 0; $i < $_tot_reg; $i++){
                
             if($dados[$i]['regiao'] != $regiao) {
                 
                 print "<tr>
                            <td colspan=\"9\" style=\"text-align:center;\"><legend>".utf8_encode($dados[$i]['regiao'])."</legend></td>
                 </tr>";
                 
                 print "
                    <th>#</th>
                    <th>Código</th>
                    <th>Município</th>
                        <th>Associação</th>
                        <th>Lei / Data</th>
                        <th>Decreto / Data</th>
                        <th>Portaria</th>
                        <th>Email Pref.</th>
                        <th>Emal Compdec</th>
                    </tr>";
                 
             }
             
             $regiao = $dados[$i]['regiao'];  
                
                          
                
 
            print "<tr>
                        <td class=\"dados\">".$i."</td>
                        <td class=\"dados\">".$dados[$i]['id_comdec']."</td>
                            <td>".$dados[$i]['nome']."</td>
                            <td>".utf8_encode($dados[$i]['nom_associacao'])."</td>
                            <td>".$dados[$i]['num_lei']." ".DataMysql::dataVisual($dados[$i]['dt_lei'])."</td>
                            <td>".$dados[$i]['num_decreto']." ".DataMysql::dataVisual($dados[$i]['dt_decreto'])."</td>
                            <td>".$dados[$i]['num_portaria']."</td>
                            <td>".$dados[$i]['email_pref']."</td>
                            <td>".$dados[$i]['email_compdec']."</td>
                        </tr>";
            
            }
            
            print "<tr>
                <td colspan=\"6\">Total de Registros : ".$_tot_reg."</td>
            </tr>   
            
            </table>";
            
?>