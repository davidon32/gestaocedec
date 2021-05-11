<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';?>
<?php

$transferencia = new TransferenciaMaterial();

$id_transf = isset($_POST['id']) ? $_POST['id'] :"";

if(empty($id_transf)){

    print 'Erro ao Acessar o sistema !';
    print "<a href=\"#\" onclick=\"history.back();\">Voltar</a>";
    die();
}else {

$dados = $transferencia->getItensTranferecia($id_transf);

?>

<div class="span12 text-center">
		Liberação N&ordm;:
		<?php print $id_transf;

		print "<table class=\"table table-bordered table-striped\">";
								print "<tr>";
								print "<th>Código</th>";
								print "<th>Material</th>";
								print "<th>Descrição</th>";
								print "<th>Quantidade</th>";
								print "</tr>"; 

								foreach ($dados as $key => $value) {

									print "<tr>"; 
									print "<td>".$value['id_produto']."</td>";
									print "<td>".Produto::PegaNomeProduto($value['id_produto'])."</td>";
									print "<td>".$value['descricao']."</td>";
									print "<td>".$value['quantidade']."</td>";
									print "</tr>"; 
								}
								print "</table>";
}
?>
</div>



