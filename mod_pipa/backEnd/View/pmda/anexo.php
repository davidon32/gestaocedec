<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';

$id_pmda = isset($_GET['param']) ? $_GET['param'] : null;

if (is_null($id_pmda)) {

    $id_pmda = isset($_POST['txtIdPmda']) ? $_POST['txtIdPmda'] : null;
}

$anexoPmda = new AnexoPmda();

$dados = $anexoPmda->listaAnexo($id_pmda);

print '<table style="width: 80%; margin:auto;" class="table table-bordered">
		
			<tr>
				<th>#</th>
				<th>Data</th>
				<th>Arquivo</th>
				<th>Descrição</th>
				<th>Ação</th>
			</tr>';

foreach ($dados as $key => $value) {

    $path = PATH . "/anexo/pmda";
    $diretorio = dir($path);

    while ($arquivo = $diretorio->read()) {

        //print strpos("dem", "m");
        //die();
        //print substr($arquivo, 0, strpos($arquivo, "_"));
        if ($value['id'] == substr($arquivo, 0, strpos($arquivo, "_"))) {

            print '<tr>
				<td>' . ($key + 1) . '</td>
				<td>' . $value['dt_anexo'] . '</td>
				<td>' . $value['arquivo'] . '</td>
				<td>' . $value['descricao'] . '</td>
				<td colspan="2">';

            print "<a href='/anexo/pmda/" . $arquivo . "' target='_blank'>" . $arquivo . "</a>";
            print "</td>";
        print "</tr>";
        }
    }
    $diretorio->close();

//		$resultPreview = $pmda->previewAnexo($value['id']);
//
//		print '<tr>
//				<td>'.($key+1).'</td>
//				<td>'.$value['dt_anexo'].'</td>
//				<td>'.$value['arquivo'].'</td>
//				<td>'.$value['descricao'].'</td>
//				<td colspan="2">';
//		if($resultPreview['existe']) {
//			print "<img onclick=\"javascript:anexopmda('anexo/pmda/".$resultPreview['file']."')\" width=\"30px\" src=\"core/imagem/impressao.png\" title=\"Visualizar\">";
//		}else {
//			print "<img width=\"30px\" src=\"core/imagem/cancela.png\" title=\"Arquivo Corrompido !, favor apagar este registro e anexo ou documento\">";
//		}
//
//		print "&nbsp;&nbsp; 
//			<img width='30px' src='core/imagem/delete.png' title='Deletar' onclick=\"javascript:deletarAnexo(".$value['id'].", ".$id_pmda.", '".$value['arquivo']."')\" id='lk_delete'></a>
//						</td>
//			</tr>";
}

print '</table>';
?>