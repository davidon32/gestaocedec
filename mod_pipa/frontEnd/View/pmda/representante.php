<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$rep = new RepPmda();

/* id_representante */
$id_rep = isset($_POST['id_rep']) ? (int)$_POST['id_rep'] : null;

/* id_pmda_comun */
$id_com  = isset($_POST['id_comunidade']) ? (int)$_POST['id_comunidade'] : null;

$cpf  = isset($_POST['txtCpfRep']) ? $_POST['txtCpfRep'] : null;

$opcao   = isset($_POST['opcao']) ? $_POST['opcao'] : "";

$id_pmda = isset($_POST['id_pmda']) ? $_POST['id_pmda'] : ""; 

$ck_status = new Pmda();

if($opcao == "novo") {

	if($rep->buscaRepDupPmda($cpf, $id_pmda)){
		print "<align='center' width='100%'><span class='alert alert-danger'>Esse representante já está cadastrado em outra <b>comundiade</b> deste PMDA</span></div>";
	}else {
		$rep->novoRep($_POST);
	}
	
}else if($opcao == "delete"){
	
	$rep->deletarRep($id_rep, $id_pmda);
	
}else if($opcao == "alterar"){
	
	$rep->alterarRep($_POST);

}

print "<table class=\"table table-bordered\">
			<tr>
            <th>#</th>
			<th>Representante</th>
            <th>CPF</th>
			<th>Endereço</th>
			<th>Bairro</th>
			<th>Telefone</th>
			<th>Watsapp</th>
			<th>Email</th>
			<th>Ação</th>
			</tr>";

			
		$listRep = $rep->listaRepComunidade($id_com, $id_pmda);
				
	  foreach ($listRep as $key=>$value) {
	  	
		
		print "<tr>";
		print "<th>".($key+1)."</th>";
		print "<td>".$value['nome']."</td>";
		print "<td>".$value['cpf']."</td>";
		print "<td>".$value['endereco']."</td>";
		print "<td>".$value['bairro']."</td>";
		print "<td>".$value['tel']."</td>";
		print "<td>".$value['watsapp']."</td>";
		print "<td>".$value['email']."</td>";
		print "<td>
	                  <a onclick='javascript:alterarRep(".$value['id'].", \"".$value['nome']."\", \"".$value['endereco']."\", \"".$value['bairro']."\", \"".$value['email']."\", \"".$value['tel']."\", \"".$value['cpf']."\", \"".$value['watsapp']."\")' title=\"Alterar Representante\"><img width='30px' src='core/imagem/editar.png'></a>
	                  <a onclick='javascript:deletarRep(".$value['id'].", ".$value['id_comunidade'].", ".$id_pmda.")' title=\"Deletar Representante da Comunidade\"><img width='30px' src='core/imagem/delete.png'></a>
	                  </td>";
		print "</tr>";
	}

 	print "</table>";

?>