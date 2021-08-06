<?php 

	$dados = $_relatorioCompdec->relCompdecRegiaoDesenvolvimento();
            
            $totalCompdec = 0;
            $totalSemCompdec = 0;
        
            //var_dump($dados);
            
            print "<table class=\"table table-condensed\">
            
                    <tr>
                        <td colspan=\"5\"style=\"text-align:center;\">Relação de Compdec por Região de Desenvolvimento</td>
                    </tr>
                    <tr>
                        <td colspan=\"5\"></td>
                        <td colspan=\"1\" style=\"text-align:right\"><img src=\"".SISTEMA."/imagem/leg_verme.png\" />&nbsp;<small>Municípios Sem Compdec<small></td>
                    </tr>";
                    
            print "<tr>
                    <th>Código</th>
                    <th>Território</th>
                    <th>Município</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Telefone</th>
                    </tr>";

            for ($i=0; $i < count($dados); $i++) {
                
                $_semCompdec = ($dados[$i]['num_lei'] == 0) ? "style='background-color:#FF4040; color:#FFFFFF;'" : "";

                print "<tr>";
                
                if($_semCompdec == "") {
                    $totalCompdec = $totalCompdec+1;
                    print "<td class=\"dados\">".$dados[$i]['id_comdec']."</td>";    
                }else {
                    $totalSemCompdec = $totalSemCompdec+1;    
                    print "<td ".$_semCompdec." class=\"dados\"></td>";
                }
                
                print "
                        <td ".$_semCompdec." class=\"dados\">".utf8_encode($dados[$i]['nomTerritorio'])."</td>
                        <td ".$_semCompdec."  class=\"dados\">".$dados[$i]['municipio']."</td>
                        <td ".$_semCompdec."  class=\"dados\">".utf8_encode($dados[$i]['endereco'])."</td>
                        <td ".$_semCompdec."  class=\"dados\">".$dados[$i]['fone_com1']."</td>
                        <td ".$_semCompdec."  class=\"dados\">".$dados[$i]['fone_com2']."</td>
                        </tr>";
                 
                
             }
             print "<tr>
                        <td></td>
                        <td colspan='4'>Total Compdec Existente :".$totalCompdec."</td>
                        <td colspan='4'>Total Municipio Sem Compdec :".$totalSemCompdec."</td>
                    </tr>
             
             </table>";
            