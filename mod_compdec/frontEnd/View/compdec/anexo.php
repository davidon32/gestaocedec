<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$anexo = new AnexoCompdec();

$id_municipio = isset($_COOKIE['seguranca']['id_municipio']) ? $_COOKIE['seguranca']['id_municipio'] :$_GET['mun'];


$files = isset($_FILES) ? $_FILES : "";
$post  = isset($_POST)  ? $_POST  : "";

//var_dump($_POST);

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";

if($opcao == 'gravarleis'){
	
	if($anexo->gravarLeisCompdec($post, $files)){ 
		
		print "<script type='text/javascript'>";
		print "alert('Documento anexado com Sucesso !');";
		print "</script>";
	 
	}else {	
		print "<script type='text/javascript'>";
		  		print "alert('Verifique o tamanho do arquivo !');";
		  		print "</script>";
	}
	
}elseif($opcao == "delete"){

	$id_municipio = $post['txtIdMunicipio'];
	//deletar
	$anexo->deletar($post['id_anexo']);
	chdir(PATH.'/anexo/anexo_leis');
	$dirAnexo = getcwd();
	if(unlink($dirAnexo.'/'.$post['arquivo'])) {

	}
}

$dados = $anexo->listaAnexo($id_municipio);

	print '<button type="button" id="btn_anexo" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" title="Clique para Anexar Leis e Decretos">Upload</button>';

					
	 print '<table class="table table-bordered table-striped table-condensed tbl">
		
			<tr>
				<th>#</th>
				<th>Data</th>
	 			<th>Tipo</th>
				<th>Arquivo</th>
				<th>Descrição</th>
				<th>Ação</th>
			</tr>';
	
	foreach ($dados as $key => $value) {
		$anexoResult = $anexo->previewAnexo($value['id']);
		
		print '<tr>
				<td>'.($key+1).'</td>
				<td>'.DataMysql::dataCompletaVisual($value['dt_anexo']).'</td>
				<td>'.$anexo->enumTipo($value['tipo']).'</td>
				<td>'.$value['arquivo'].'</td>
				<td>'.$value['descricao'].'</td><td>';

				print (($anexoResult['existe']) ? '<a onclick="javascript:anexoView(\'anexo/anexo_leis/'.$anexoResult['arquivo'].'\')"><img width="30px" src="/core/imagem/impressao.png" title="Visualizar"></a>'
						: '<img src=\'/core/imagem/cancela.png\' width=\'30px\' title=\'Arquivo nao disponível favor apagar este registro e adicionar outro arquivo\'>');
				print '	&nbsp;&nbsp;<img width="30px" src="/core/imagem/delete.png" title="Deletar" onclick="javascript:deletarAnexoLei('.$value['id'].', \''.$value['arquivo'].'\', \''.$value['id_municipio'].'\');"></a>
						</td>
					</tr>';
	} 
		
	print '</table>'; 
?>
