<?php

//var_dump($_sel_regiaoDC);
$dados = $_relatorioCompdec->relCompdecRegiaoDC($_sel_regiaoDC);

$regiao = '';

$_tot_reg = count($dados);

print "<table class=\"table table-condensed\">
            
                    <tr>
                        <td colspan=\"9\"style=\"text-align:center;\">Relação de COMPDEC por Região DEFESA CIVIL</td>
                    </tr>";

$num = 1;

foreach ($dados as $key => $dado) {
    
    $coordenador = Compdec::getCoordenador($dado['id_municipio']);
    $compdec          = isset($coordenador['nome']) ? $coordenador['nome'] :"";
    $telefone_compdec = (isset($coordenador['telefone']) ? $coordenador['telefone'] :"").isset($coordenador['celular']) ? $coordenador['celular'] :"";
    $email_compdec    = isset($coordenador['email']) ? $coordenador['email'] :"";

    if ($dado['id_rpm'] != $regiao) {

        print "<tr>
                            <td colspan=\"9\" style=\"text-align:center;\"><legend>" . utf8_encode($dado['regiaodc']) . "</legend></td>
                 </tr>";

        print "
                    <th>#</th>
                    <th>Código</th>
                    <th>Município</th>
                        <th>Região DC</th>                        
                        <th>Email Pref.</th>
                        <th>Coordenador</th>
                        <th>Telefone Coord.</th>
                        <th>Email Coordenador</th>
                    </tr>";
        $num = 1;
    }

    $regiao = $dado['id_rpm'];




    print "<tr>
                        <td class=\"dados\">" . $num . "</td>
                        <td class=\"dados\">" . $dado['id_comdec'] . "</td>
                            <td>" . $dado['municipio'] . "</td>
                            <td>" . utf8_encode($dado['regiaodc']) . "</td>
                            <td>" . $dado['email_prefeito'] . "</td>
                            <td>" . $compdec. "</td>
                            <td>" . $telefone_compdec."</td>
                            <td>" . $email_compdec."</td>
                        </tr>";

    $num++;

}


print "<tr>
                <td colspan=\"6\">Total de Registros : " . $_tot_reg . "</td>
            </tr>   
            
            </table>";
?>