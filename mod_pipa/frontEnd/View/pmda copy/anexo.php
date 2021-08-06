<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$id_pmda = isset($_GET['param']) ? $_GET['param'] : null;

if(is_null($id_pmda)) {
	
	$id_pmda = isset($_POST['txtIdPmda']) ? $_POST['txtIdPmda'] : null;
}

$anexo = new AnexoPmda();
$pmda = new Pmda();

$files = isset($_FILES) ? $_FILES : "";
$post  = isset($_POST)  ? $_POST  : "";

$opcao = isset($post['opcao']) ? $post['opcao'] : "";

//var_dump($_POST);
//var_dump($id_pmda);

if($opcao == 'gravar'){

	$anexo->gravar($post, $files, "anexo");
	

}else if($opcao == "delete"){
	
	//deletar
	$anexo->deletar($post['id_anexo']);
	chdir(PATH.'/anexo');
	$dirAnexo = getcwd();
	unlink($dirAnexo.'/'.$post['id_anexo'].'_'.$post['arquivo']);
}

$dados = $anexo->listaAnexo($id_pmda);

	 print '<table style="width: 80%; margin:auto;" class="table table-bordered">
		
			<tr>
				<th>#</th>
				<th>Data</th>
				<th>Arquivo</th>
				<th>Descrição</th>
				<th>Ação</th>
			</tr>';
	
	foreach ($dados as $key => $value) {
		
		print '<tr>
				<td>'.($key+1).'</td>
				<td>'.$value['dt_anexo'].'</td>
				<td>'.$value['arquivo'].'</td>
				<td>'.$value['descricao'].'</td>
				<td colspan="2">';
						
		print "<img onclick=\"javascript:anexopmda('anexo/".$pmda->previewAnexo($value['id'])."')\" width=\"30px\" src=\"core/imagem/impressao.png\" title=\"Visualizar\">";

		print "&nbsp;&nbsp; 
			<img width='30px' src='core/imagem/delete.png' title='Deletar' onclick=\"javascript:deletarAnexo(".$value['id'].", ".$id_pmda.", '".$value['arquivo']."')\" id='lk_delete'></a>
						</td>
			</tr>";
	} 
		
	print '</table>'; 
?>