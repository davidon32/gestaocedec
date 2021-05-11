<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$comunidadePmda = new Pmda();

if(isset($_GET['param'])) {
	$id_pmda = (int)$_GET['param'];
}else if(isset($_POST['id_pmda'])){
	$id_pmda = (int)$_POST['id_pmda']	;
}else {
	$id_pmda = "";
}


/* id_comunidade */
$id_comunidade = isset($_POST['txtIdComunidadeSearch']) ? (int)$_POST['txtIdComunidadeSearch'] : null;

/* id_pmda_comun */
$id_com_pmda = isset($_POST['txtIdPmdaComun']) ? (int)$_POST['txtIdPmdaComun'] : null;

$id_municipio = isset($_POST['txtIdMunAddCom']) ? (int)$_POST['txtIdMunAddCom'] : null;

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";


/* adicionar comunidade no pmda */
if(is_null($id_com_pmda) && $opcao == "novo") {

	$comunidadePmda->novoComPmda($_POST);
        

/* remover comunidade do pmda*/
}else if($opcao == "delete"){
	
	$comunidadePmda->deleteComPmda($id_com_pmda, $id_comunidade, $id_municipio, $id_pmda);

/* alterar dados da comunidade do pmda */
}else if($opcao == "alterar"){
	
	$comunidadePmda->alterarComunidade($_POST);
	
}else {

$totPopAt = 0;

$listComPmda = $comunidadePmda->listaComunidadePmda($id_pmda);

//var_dump($listComPmda);

	foreach ($listComPmda as $value1){
		
		$totPopAt +=$value1['pop_atendida'];
		
	}

    print "<span>Total Comunidades : <i>".count($listComPmda)."</i>&nbsp;&nbsp;&nbsp;&nbsp;Total Pop. Atendida : <i>".$totPopAt."</i> </span>";
	print "<table class='table table-bordered table-striped list_comunidade'>";
	print "<tr>";
	print "<th>Id</th>";
	print "<th>Nome</th>";
	print "<th>Latitude</th>";
	print "<th>Longitude</th>";
	print "<th>Ponto Captação</th>";
	print "<th>Trecho Pavimentado (Km)</th>";
	print "<th>Trecho não Pavimentado (Km)</th>";
	print "<th>Distância Total (Km)</th>";
	print "<th>População Atendida</th>";
	print "<th>Ação</th>";
	print "</tr>";


foreach ($listComPmda as $value) {
	
	$distancia = $value['trecho_pav'] + $value['trecho_n_pav'];
	
	//var_dump($comunidadePmda->contaRep($value['id_comunidade']));
	$erroRep = ($comunidadePmda->contaRep($value['id_comunidade'], $value['id_pmda']) < 3) ? "style='color: red;' title='ESTÁ FALTANDO REPRESENTANTES PARA ESTA COMUNIDADE !!'" : "";
	//var_dump($comunidadePmda->contaRep($value['id_comunidade']));
	
	$pontoCap = PontoCap::getNomePontoCap($value['id_ponto']);
	
	print "<tr>";
	print "<td ".$erroRep.">".$value['id_comunidade']."</td>";
	print "<td ".$erroRep.">".$value['comunidade']."</td>";
	print "<td ".$erroRep.">".$value['latitude']."</td>";
	print "<td ".$erroRep.">".$value['longitude']."</td>";
	print "<td ".$erroRep.">".(isset($pontoCap['nome']) ? $pontoCap['nome'] : "")."</td>";
	print "<td ".$erroRep.">".$value['trecho_pav']."</td>";
	print "<td ".$erroRep.">".$value['trecho_n_pav']."</td>";
	print "<td ".$erroRep.">".$distancia."</td>";
	print "<td ".$erroRep.">".$value['pop_atendida']."</td>";
	print "<td ".$erroRep.">
                  <a onclick='javascript:alterarComunidade(".$value['id_comunidade'].", \"".$value['comunidade']."\", \"".$value['latitude']."\", \"".$value['longitude']."\", \"".$value['id_ponto']."\", \"".$value['trecho_pav']."\", \"".$value['trecho_n_pav']."\", \"".$value['pop_atendida']."\", \"".$value['id_pmda']."\")' title=\"Alterar dados Comunidade\"><img width='30px' src='core/imagem/editar.png'></a>
                  <a onclick='javascript:deletarComunidade(".$value['id_com_pmda'].", ".$value['id_comunidade'].", ".$value['id_municipio'].", ".$value['id_pmda'].")' title=\"Deletar Comunidades do PMDA\"><img width='30px' src='core/imagem/delete.png'></a>
                  <a href=\"#panel-representante\" data-toggle=\"tab\" id=\"lk_tab_representante\" onclick='addIdCom(".$value['id_comunidade'].", \" ".$value['comunidade']." \", ".$value['id_pmda'].");' title=\"Adicionar Representante da Comunidade\"><img width='30px' name='lk_rep' src='core/imagem/representante.png'></a>
                  
                  </td>";
	print "</tr>";
}

/*  <a onclick='javascript:adicionarRepresentante(".$value['id_com_pmda'].", ".$value['id_pmda'].")' title=\"Adicionar Representante da Comunidade\"><img width='30px' src='imagem/representante.png'></a>*/
	print "</table>";

}
?>