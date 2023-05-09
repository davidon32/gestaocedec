<?php

    $filtro = isset($_POST['selExistente']) ? $_POST['selExistente'] : "";

	$dados = $_relatorioCompdec->relCompdec($filtro);
            
            $totalCompdec = 0;
            $totalSemCompdec = 0;
            
            if($filtro == ""){
                $titulo = "Lista COMPDEC";
            }elseif($filtro == 0){
                $titulo = "Lista Municípios sem COMPDEC";
            }elseif($filtro == 1){
                $titulo = "Lista COMPDEC existentes";
            }

            
            print "<table class=\"table table-condensed\" id=\"rel_compdec\">
            
                    <tr>
                        <td colspan=\"13\"style=\"text-align:center;\"><h3>".$titulo."</h3></td>
                    </tr>
                    <tr>
                        <td colspan=\"7\"></td>
                        <td colspan=\"6\" style=\"text-align:right\"><img src=\"/core/imagem/leg_verme.png\" />&nbsp;<small>Municípios Sem Compdec<small></td>
                    </tr>";
                    
            print "<tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Região</th>
                    <th>Município</th>
                    <th>RPM</th>
                    <th title='Deposito Avançado'>D.A.</th>
                    <th>Lei</th>
                    <th>Decreto</th>
                    <th>Nupdec</th>
                    <th>Portaria</th>
                    <th>Endereço</th>
                    <th>Fone</th>
                    <th>Fone</th>
                    </tr>";


            $totalNupdec = 0;
            
            for ($i=0; $i < count($dados); $i++) {
                
                if( $dados[$i]['nudec'] == 1 && $dados[$i]['com_const'] == 1) {
                    $totalNupdec ++; 
                }
                
                print "<tr>";
                
                if($dados[$i]['com_const'] == 0) {
                    $_semCompdec = "style='background-color:#FF4040; color:#FFFFFF;vertical-align: middle;'";
                    $totalSemCompdec = $totalSemCompdec+1;
                }elseif ($dados[$i]['com_const'] == 1) {
                    $totalCompdec = $totalCompdec+1;
                    $_semCompdec = "style='vertical-align: middle'";  
                }
                
                print "<td ".$_semCompdec." class=\"dados\">".$i."</td>";
                print "<td ".$_semCompdec." class=\"dados\">".$dados[$i]['id_comdec']."</td>";    

                print "
                        <td ".$_semCompdec." class=\"dados\">".utf8_encode($dados[$i]['regiao'])."</td>
                        <td ".$_semCompdec."  class=\"dados\">".$dados[$i]['municipio']."</td>
                        <td ".$_semCompdec."  class=\"dados\">".$dados[$i]['rpm']."</td>
                        <td ".$_semCompdec."  class=\"dados\">".$dados[$i]['da']."</td>
                        <td ".$_semCompdec."  class=\"dados\">".DataMysql::dataVisual($dados[$i]['dt_lei'])." ".$dados[$i]['num_lei']."</td>
                        <td ".$_semCompdec."  class=\"dados\">".DataMysql::dataVisual($dados[$i]['dt_decreto'])." ".$dados[$i]['num_decreto']."</td>
                        <td ".$_semCompdec."  class=\"dados\">".( ($dados[$i]['nudec'] == 0) ? 'Não' : "Sim") ."</td>
                        <td ".$_semCompdec."  class=\"dados\">".DataMysql::dataVisual($dados[$i]['dt_portaria'])." ".$dados[$i]['num_portaria']."</td>
                        <td ".$_semCompdec."  class=\"dados\">".utf8_encode($dados[$i]['endereco'])."</td>
                        <td ".$_semCompdec."  class=\"dados\">".$dados[$i]['fone_com1']."</td>
                        <td ".$_semCompdec."  class=\"dados\">".$dados[$i]['fone_com2']."</td>
                        </tr>";
                 
                
             }

             print "<tr>
                        <td></td>
                        <td colspan='4'>Total Compdec Existente :".$totalCompdec."</td>
                        <td colspan='4'>Total Municipio Sem Compdec :".$totalSemCompdec."</td>
                        <td colspan='4'>Total Municipio com Nupdec :".$totalNupdec."</td>
                    </tr>
             
             </table>";
?>