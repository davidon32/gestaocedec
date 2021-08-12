<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$anexo = new AnexoCompdec();


$id_municipio = isset($_POST['txtIdMunicipio']) ? $_POST['txtIdMunicipio'] : $_GET['mun'];


$opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";

$files = isset($_FILES) ? $_FILES : "";
$post  = isset($_POST)  ? $_POST  : "";


if($opcao == 'gravarleis'){
	
	if($anexo->gravarLeisCompdec($post, $files)){ 
		/* var_dump($_POST);
		die(); */
		//print "sucesso";
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
	if(file_exists($dirAnexo.'/'.$post['arquivo'])){
            unlink($dirAnexo.'/'.$post['arquivo']);
	}
}elseif($opcao == 'valida_anexo'){
    var_dump($_POST);
    var_dump($anexo->validaAnexo($_POST['id_anexo']));
    die();
}

$dados = $anexo->listaAnexo($id_municipio);

	print '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" title="Clique para Anexar Leis e Decretos">Upload</button>';

        print '<table class="table table-condensed tbl">
		
			<tr>
				<th>#</th>
				<th>Data Envio</th>
	 			<th>Tipo Doc.</th>
				<th>Nome Arquivo</th>
				<th>Descrição</th>
				<th>Validade</th>
				<th>Ação</th>
			</tr>';
	$valido = '';
	foreach ($dados as $key => $value) {
		$anexoResult = $anexo->previewAnexo($value['id']);
                
                $valido = (!empty($value['validade'])) ? "style='background-color:#00FF80;' title='Documento validado pela CEDEC'": "style='background-color:#FA5858;' title='Documento validado pela CEDEC'";

		print '<tr>
			<td '.$valido.'>'.($key+1).'</td>
			<td '.$valido.'>'.DataMysql::dataCompletaVisual($value['dt_anexo']).'</td>
			<td '.$valido.'>'.$anexo->enumTipo($value['tipo']).'</td>
			<td '.$valido.'>'.$value['arquivo'].'</td>
			<td '.$valido.'>'.$value['descricao'].'</td>
			<td '.$valido.'>'. DataMysql::dataVisual($value['validade']).'</td>';
                    print '<td '.$valido.'>';
                            print (($anexoResult['existe']) ? '<a onclick="javascript:anexoView(\'anexo/anexo_leis/'.$anexoResult['arquivo'].'\')"><img width="30px" src="/core/imagem/impressao.png" title="Visualizar"></a>'
                                    : '<img src=\'/core/imagem/cancela.png\' width=\'30px\' title=\'Arquivo nao disponível favor apagar este registro e adicionar outro arquivo\'>');
                            print '	&nbsp;&nbsp;<img width="30px" src="/core/imagem/delete.png" title="Deletar" onclick="javascript:deletarAnexoLei('.$value['id'].', \''.$value['arquivo'].'\', \''.$value['id_municipio'].'\');"></a>';
                        
                        if (empty($value['validade'])){
                        # aprovar documento
                            print "<button class='btn btn-link' type=\"button\" name='valida_doc' data-id_anexo=\"".$value['id']."\"><img src='/core/imagem/ok.jpg' title='Aprovar Documento' confirm='Deseja validar o Documento ?'></button>";
                        }
                    print "</td>";

		print "</tr>";
	} 
        
        # linha informando q nao tem decreto 
        if($_dados[0]['sem_lei'] == 1){
            print "<tr>
                <td style='background-color:#00FF80;text-align:center' title='' colspan='7'>Não possui Decreto de Regulamentação da Lei de Criação do Compdec</td>";
        }
        
        # linha informando q nao tem decreto 
        if($_dados[0]['sem_decreto'] == 1){
            print "<tr>
                <td style='background-color:#00FF80;text-align:center' title='' colspan='7'>Não possui Decreto de Regulamentação da Lei de Criação do Compdec</td>";
        }
        
        # linha informando q nao tem Portaria de nomeação compdec 
        if($_dados[0]['sem_portaria'] == 1){
            print "<tr>
                <td style='background-color:#00FF80;text-align:center' title='' colspan='7'>Não possui Portaria de Nomeação do Coordenador Municipal de Defesa Civil </td>";
        }
		
	print '</table>'; 
?>
