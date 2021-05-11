<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/include.php';

$comunidade = new Comunidade();

$itens = $comunidade->listComunMun($_SESSION['seguranca']['id_municipio']);


$q = strtolower($_GET["q"]);

if (!$q) return;

$result = array();

foreach ($itens as $key=>$value) {
	if (strpos(strtolower($key), $q) !== false) {
		array_push($result, array(
				"name" => $key,
				"to" => $value
		));
	}
}
echo json_encode($result);
?>
