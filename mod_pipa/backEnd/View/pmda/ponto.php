<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$pontoCap = new PontoCap();

$id = isset($_POST['id_ponto']) ? (int)$_POST['id_ponto'] : null;
$opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";

$id_municipio = isset($_POST['txtIdMunicipio']) ? $_POST['txtIdMunicipio'] : $_GET['mun'];
    
if(is_null($id) && $opcao == "novo") {

    $pontoCap->novo($_POST);

}else if($opcao == "delete"){
    
    $pontoCap->delete($id);
    
}else if($opcao == "alterar"){

    $pontoCap->alterarPonto($_POST);

}

print "<table class='table table-bordered'>
            <tr>
			<th>Código</th>
			<th>Nome</th>
            <th>Tipo</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Capacidade M³</th>
            <th>Ação</th>
			</tr>";

    $listPonto = $pontoCap->listaPCaptacao($id_municipio);
    
    
    foreach ($listPonto as $value) {
        print "<tr>";
        print "<td width='5%'>".$value['id_ponto']."</td>";
        print "<td width='25%'>".$value['nome']."</td>";
        print "<td width='20%'>".$pontoCap->enumTipoCap($value['tipo'])."</td>";
        print "<td width='15%'>".$value['latitude']."</td>";
        print "<td width='15%'>".$value['longitude']."</td>";
        print "<td width='10%'>".$value['capacidade']."</td>";
        print "<td width='10%'>
                  <a onclick='javascript:alterarPonto(".$value['id_ponto'].", \"".$value['nome']."\", \"".$value['tipo']."\", \"".$value['latitude']."\", \"".$value['longitude']."\", \"".$value['capacidade']."\", \"".$value['id_municipio']."\")' title=\"Editar Ponto de Captação\"><img width='30px' src='core/imagem/editar.png'></a>
                  <a onclick='javascript:deletarPonto(".$value['id_ponto'].")' title=\"Deletar Ponto de Captação\"><img width='30px' src='core/imagem/delete.png'></a>
              </td>
              </tr>";
    
    }
    
print "</table>";

?>