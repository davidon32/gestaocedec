<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';?>
<?php

$_liberacao = new Liberacao();
$_id_libera = isset($_POST['id']) ? $_POST['id'] : null;
if(empty($_id_libera)){

}else {
	$dados = $_liberacao->listaProdutos($_id_libera);
?>

	<div class="span12 text-center">
		Liberação N&ordm;:
		<?php print $_id_libera;

		print "<table class=\"table table-bordered table-striped\">";
								print "<tr>";
								print "<th>Código</th>";
								print "<th>Material</th>";
								print "<th>Descrição</th>";
								print "<th>Quantidade</th>";
								print "</tr>"; 

								foreach ($dados as $key => $value) {
									print "<tr>"; 
									print "<td>".$value['cod']."</td>";
									print "<td>".Produto::PegaNomeProduto($value['cod'])."</td>";
									print "<td>".$value['descricao']."</td>";
									print "<td>".$value['quantidade']."</td>";
									print "</tr>"; 
								}
								print "</table>";
}
?>
</div>

