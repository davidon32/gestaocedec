<?php $id= isset($_GET['id']) ? $_GET['id'] : "";

$filename = "Modelo_Solicitacao_cadastro.doc";

if($id == "xd45ft6yu"){
	header("Content-type: application/msword");
	header("Content-Disposition: attachment; filename=" . $filename);
	readfile("doc/Modelo_Solicitacao_cadastro.doc");
}

?>