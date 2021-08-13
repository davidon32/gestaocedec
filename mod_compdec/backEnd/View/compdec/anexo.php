<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';

$anexo = new AnexoCompdec();

$id_municipio = isset($_POST['txtIdMunicipio']) ? $_POST['txtIdMunicipio'] : $_GET['mun'];

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";

$files = isset($_FILES) ? $_FILES : "";
$post = isset($_POST) ? $_POST : "";

/* grava leis */
if ($opcao == 'gravarleis') {

    if ($anexo->gravarLeisCompdec($post, $files)) {
        /* var_dump($_POST);
          die(); */
        //print "sucesso";
        print "<script type='text/javascript'>";
        print "alert('Documento anexado com Sucesso !');";
        print "</script>";
    } else {
        print "<script type='text/javascript'>";

        print "alert('Verifique o tamanho do arquivo !');";

        print "</script>";
    }
    
} elseif ($opcao == "delete") {

    $id_municipio = $post['txtIdMunicipio'];
    //deletar
    $anexo->deletar($post['id_anexo']);
    chdir(PATH . '/anexo/anexo_leis');
    $dirAnexo = getcwd();
    if (file_exists($dirAnexo . '/' . $post['arquivo'])) {
        unlink($dirAnexo . '/' . $post['arquivo']);
    }
    
/* validar anexo */
} elseif ($opcao == 'valida_anexo') {
    $anexo->validaAnexo($_POST['id_anexo'], $id_municipio);
    
/* homologar documentação */
}elseif ($opcao == 'aprovar_compdec'){
    $anexo->homologar_document($id_municipio, $_POST['valor']);
    
}

$dados = $anexo->listaAnexo($id_municipio);


print '<br><br><table class="table table-condensed tbl">
		
			<tr>
				<th class="col-md-1">#</th>
				<th class="col-md-1">Data Envio</th>
	 			<th class="col-md-1">Tipo Doc.</th>
				<th class="col-md-3">Nome Arquivo</th>
				<th class="col-md-3">Descrição</th>
				<th class="col-md-1">Validade</th>
				<th class="col-md-2">Ação</th>
			</tr>';
$valido = '';
foreach ($dados as $key => $value) {
    $anexoResult = $anexo->previewAnexo($value['id']);

    $valido = (!empty($value['validade'])) ? "style='background-color:#00FF80;' title='Documento validado pela CEDEC'" : "style='background-color:#FA5858;' title='Documento validado pela CEDEC'";

    print '<tr>
			<td ' . $valido . '>' . ($key + 1) . '</td>
			<td ' . $valido . '>' . DataMysql::dataCompletaVisual($value['dt_anexo']) . '</td>
			<td ' . $valido . '>' . $anexo->enumTipo($value['tipo']) . '</td>
			<td ' . $valido . '>' . $value['arquivo'] . '</td>
			<td ' . $valido . '>' . $value['descricao'] . '</td>
			<td ' . $valido . '>' . DataMysql::dataVisual($value['validade']) . '</td>';
    print '<td ' . $valido . '>';
    print (($anexoResult['existe']) ? '<a onclick="javascript:anexoView(\'anexo/anexo_leis/' . $anexoResult['arquivo'] . '\')"><img width="30px" src="/core/imagem/impressao.png" title="Visualizar"></a>' : '<img src=\'/core/imagem/cancela.png\' width=\'30px\' title=\'Arquivo nao disponível favor apagar este registro e adicionar outro arquivo\'>');
    print '	&nbsp;&nbsp;<img width="30px" src="/core/imagem/delete.png" title="Deletar" onclick="javascript:deletarAnexoLei(' . $value['id'] . ', \'' . $value['arquivo'] . '\', \'' . $value['id_municipio'] . '\');"></a>';

    if (empty($value['validade'])) {
        # aprovar documento
        print "<button class='btn btn-link' type=\"button\" name='valida_doc' data-id_anexo=\"" . $value['id'] . "\"><img src='/core/imagem/ok.jpg' title='Aprovar Documento' ></button>";
    }
    print "</td>";

    print "</tr>";
}

?>
