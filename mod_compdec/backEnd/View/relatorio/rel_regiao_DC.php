<?php

//var_dump($_sel_regiaoDC);
$dados = $_relatorioCompdec->relCompdecRegiaoDC($_sel_regiaoDC);

$regiao = '';

$_tot_reg = count($dados);

$total_existente = 0;
    
    $total_inexistente = 0;
    
    $total_inativo = 0;
    
    $total_nupdec = 0;

print "<table class=\"table table-condensed\">
            
                    <tr>
                        <td colspan=\"11\"style=\"text-align:center;\">Relação de COMPDEC por Região DEFESA CIVIL</td>
                    </tr>";

$num = 1;

    
    
foreach ($dados as $key => $dado) {
    
    $coordenador = Compdec::getCoordenador($dado['id_municipio']);
    $compdec          = isset($coordenador['nome']) ? $coordenador['nome'] :"";
    $telefone_compdec = isset($coordenador['telefone']) ? $coordenador['telefone'] :""; 
    $celular_compdec = isset($coordenador['celular']) ? $coordenador['celular'] :"";
    $email_compdec    = isset($coordenador['email']) ? $coordenador['email'] :"";

          
        # compdec inativa
        if( ($dado['compdec_ativa'] == 0) && ($dado['compdec_existe'] == 1) ) {
            $cor_inativa = " alert alert-warning ";
            $total_inativo++;
        }else {
            $cor_inativa = "";
        }
        
        
        # compdec ativa e existente
        if( ($dado['compdec_ativa'] == 1) && ($dado['compdec_existe'] == 1) ){
            $total_existente++;
        }
        
        #
        if($dado['compdec_existe'] == 0) {
            $total_inexistente++;
            $cor_existe = " alert alert-danger ";
        }else {
            $cor_existe = "";
        }
        
        # nupdec
        if( ($dado['nupdec'] == 1) && ($dado['compdec_existe'] == 1) ) {
            $total_nupdec ++; 
        }
        
        
        
    if ($dado['id_rpm'] != $regiao) {
        
        
        
        print "<tr>
                <td colspan=\"10\" style=\"text-align:center;\"><legend>" . utf8_encode($dado['regiaodc']) . "</legend></td>
               </tr>";

        print "<th>#</th>
                    <th>Código</th>
                    <th>Município</th>
                        <th>Região DC</th>                        
                        <th>Email Pref.</th>
                        <th>Coordenador/Tel Coord.</th>
                        <th>Email Coordenador</th>
                        <th>NUPDEC</th>
                        <th>Existe COMPDEC</th>
                        <th>Situação</th>
            </th>";
        $num = 1;
    }else {
        //print "opa";
    }

    $regiao = $dado['id_rpm'];




    print "<tr>
                        <td class=\"dados {$cor_inativa}{$cor_existe}\">" . $num . "</td>
                        <td class=\"dados {$cor_inativa}{$cor_existe}\">" . $dado['id_comdec'] . "</td>
                            <td class=\" {$cor_inativa}{$cor_existe}\">" . $dado['municipio'] . "</td>
                            <td class=\" {$cor_inativa}{$cor_existe}\">" . utf8_encode($dado['regiaodc']) . "</td>
                            <td class=\" {$cor_inativa}{$cor_existe}\">" . strtolower($dado['email_prefeito']) . "</td>
                            <td class=\" {$cor_inativa}{$cor_existe}\">" . $compdec. "<br>".$telefone_compdec."/ ".$celular_compdec."</td>
                            <td class=\" {$cor_inativa}{$cor_existe}\">" . strtolower($email_compdec)."</td>
                            <td class=\" {$cor_inativa}{$cor_existe}\">" . ( ($dado['nupdec'] == 0) ? "Não" : "Sim" )."</td>
                            <td class=\" {$cor_inativa}{$cor_existe}\">" . ( ($dado['compdec_existe'] == 0) ? "Não tem" : "Existente" )."</td>
                            <td class=\" {$cor_inativa}{$cor_existe}\">" . ( ($dado['compdec_ativa'] == 0) ? (($dado['compdec_existe'] == 0) ? "-" : "Inativa") : "Ativa" )."</td>
                        </tr>";

    $num++;

}


print "<tr>
        <td colspan=\"3\">&nbsp;</td>
            <td colspan=\"7\">Total de Registros : <b>" . $_tot_reg . "</b></td>
        </tr>
        <tr>            
        <td colspan=\"3\">&nbsp;</td>
            <td colspan=\"7\">Total Existente ( Lei de criação e Coordenador atuante ) : <b>" . $total_existente . "</b></td>        
        </tr>
        <td colspan=\"3\">&nbsp;</td>
            <td colspan=\"7\">Total Inexistente ( Não tem Compdec Regulamentada ): <b>" . $total_inexistente . "</b></td>
        </tr>   
        </tr>
        <td colspan=\"3\">&nbsp;</td>
            <td colspan=\"7\">Total Inativa ( Existe Lei de Criação e não tem Coordenador atuante ): <b>" . $total_inativo . "</b></td>
        </tr>   
        <td colspan=\"3\">&nbsp;</td>
            <td colspan=\"7\">Total Nupdec´s : <b>" . $total_nupdec . "</b></td>
        </tr>   
            
            </table>";
?>