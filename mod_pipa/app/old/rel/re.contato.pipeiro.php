	

function listaContatoPipeiro($situacao = "A")

	$sql = ""


	<table>
		<tr>
		<td colspan="4"> Lista de Contatos Pipeiro</td>
		</tr>
		<tr>
			<td>Contrato</td>
			<td>Nome</td>
			<td>Telefone</td>
			<td>Celular</td>
		</tr>
		
		<?php

			for ($i=0; $i < count($dados) ; $i++) { 
		
				print "<tr>";
				print "<td>".$dados[$i]['num_contrato']."</td>";
				print "<td>".$dados[$i]['nome']."</td>";
				print "<td>".$dados[$i]['tel']."</td>";
				print "<td>".$dados[$i]['cel']."</td>";
				print "</tr>";
			}

		?>
	</table>

?>