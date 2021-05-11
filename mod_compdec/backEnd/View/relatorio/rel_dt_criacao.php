<?php
$_dt_inicial = ($_REQUEST ['dt_inicio'] != "//") ? DataMysql::dataForm ( $_REQUEST ['dt_inicio'] ) : "";

$dados = $_relatorioCompdec->relCompdecDtCriacao ( $_dt_inicial );

$total_reg = count ( $dados );

print "<table class=\"table table-condensed\">
            
                    <tr>
                        <td colspan=\"8\"style=\"text-align:center;\">Compdec´s Por data de Criação</td>
                    </tr>";

print "<tr>
                    <th>Código</th>
                    <th>Região</th>
                    <th>Município</th>
                    <th>Lei</th>
                    <th>Decreto</th>
                    <th>Portaria</th>
                    <th>Endereço</th>
                    <th>Fone</th>
                    <th>Fone</th>
                    </tr>";

for($i = 0; $i < count ( $dados ); $i ++) {
	
	print "<tr>
                        <td class=\"dados\">" . $dados [$i] ['id_comdec'] . "</td>
                        <td class=\"dados\">" . utf8_encode ( $dados [$i] ['regiao'] ) . "</td>
                        <td class=\"dados\">" . $dados [$i] ['municipio'] . "</td>
                        <td class=\"dados\">" . DataMysql::dataVisual ( $dados [$i] ['dt_lei'] ) . " " . $dados [$i] ['num_lei'] . "</td>
                        <td class=\"dados\">" . DataMysql::dataVisual ( $dados [$i] ['dt_decreto'] ) . " " . $dados [$i] ['num_decreto'] . "</td>
                        <td class=\"dados\">" . DataMysql::dataVisual ( $dados [$i] ['dt_portaria'] ) . " " . $dados [$i] ['num_portaria'] . "</td>
                        <td class=\"dados\">" . utf8_encode ( $dados [$i] ['endereco'] ) . "</td>
                        <td class=\"dados\">" . $dados [$i] ['fone_com1'] . "</td>
                        <td class=\"dados\">" . $dados [$i] ['fone_com2'] . "</td>
                        </tr>";
}
print "<tr>
        <td colspan='9'>Total de Registros : " . $total_reg . "</td>
        </tr>
       </table>";