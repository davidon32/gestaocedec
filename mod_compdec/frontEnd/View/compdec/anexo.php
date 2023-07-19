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
	if(file_exists($dirAnexo.'/'.$post['arquivo'])) {
            unlink($dirAnexo.'/'.$post['arquivo']);
	}
}

$doc_aprova = Compdec::getDocAprov($id_municipio);

$dados = $anexo->listaAnexo($id_municipio);
        if($doc_aprova == 0){
            print '<button type="button" id="btn_anexo" onclick="uploadModal(\'leis\')" class="btn btn-primary" title="Clique para Anexar Leis e Decretos">Upload</button><br><br>';

	}
        #print "<br><br><span class='alert alert-success'> Seus documentos estão atualizados, em caso de mudança entre em contato com a CEDEC </span><br><br>";
	 print '<table class="table table-condensed tbl">
		
			<tr>
				<th class="col-md-1">#</th>
				<th class="col-md-1">Data </th>
	 			<th class="col-md-1">Tipo Doc.</th>
				<th class="col-md-3">Nome Arquivo</th>
				<th class="col-md-3">Descrição</th>
				<!--<th class="col-md-1">Validade</th>-->
				<th class="col-md-2">Ação</th>
			</tr>';
$valido = '';

$bg = "";
	
	foreach ($dados as $key => $value) {
            
            $date = new DateTime($value['dt_anexo']);
            if($date->diff(new DateTime('2023-06-01'))->days <=30){
                $bg = "";
            }else {
                $bg = "class='alert alert-danger' title='Favor Atualizar os Documentos anexos, lei de criação, decreto e portaria de nomeação do Coordenador'";
            }
            
		$anexoResult = $anexo->previewAnexo($value['id']);
                
                //$valido = (!empty($value['validade'])) ? "style='background-color:#00FF80;' title='Documento validado pela CEDEC'" : "style='background-color:#FA5858;' title='Documento validado pela CEDEC'";
                $valido = "";
		
		print '<tr>
				<td '.$bg.' ' . $valido . '>'.($key+1).'</td>
				<td '.$bg.' ' . $valido . '>'.DataMysql::dataCompletaVisual($value['dt_anexo']).'</td>
				<td '.$bg.'' . $valido . '>'.$anexo->enumTipo($value['tipo']).'</td>
				<td '.$bg.'' . $valido . '>'.$value['arquivo'].'</td>
				<td '.$bg.'' . $valido . '>'.$value['descricao'].'</td>
				<!--<td ' . $valido . '>'. DataMysql::dataVisual($value['validade']).'</td>-->
                                <td '.$bg.'' . $valido . '>';

				print (($anexoResult['existe']) ? '<a onclick="javascript:anexoView(\'anexo/anexo_leis/'.$anexoResult['arquivo'].'\')"><img width="30px" src="/core/imagem/impressao.png" title="Visualizar"></a>'
						: '<img src=\'/core/imagem/cancela.png\' width=\'30px\' title=\'Arquivo nao disponível favor apagar este registro e adicionar outro arquivo\'>');
                                    print '	&nbsp;&nbsp;<img width="30px" src="/core/imagem/delete.png" title="Deletar" onclick="javascript:deletarAnexoLei('.$value['id'].', \''.$value['arquivo'].'\', \''.$value['id_municipio'].'\');"></a>';
//				if(empty($value['validade'])){
//                                }
                                print '</td></tr>';
	} 
	
	print '</table>'; 
        
?>
