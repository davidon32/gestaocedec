<?php

$secao = isset($_GET['secao']) ? $_GET['secao'] : null;

$op = isset($_GET['op']) ? $_GET['op'] : null;

//var_dump($_REQUEST);

if($secao != null) {

	switch ($secao) {


		#@ consulta de material em transito @
		case 'cmatt':
		include 'sc.consulta.material.transito.php';
		break;

		#@ consulta de  recebimento de materiais @
		case 'crmt':
			include 'sc.consulta.receb.material.php';
		break;
			
		#@ consulta de material pago @
		case 'cmatp':
			include 'sc.consulta.mat.pago.php';
		break;
			
		#@ consulta tranferencia de materiais
		case 'ctrans':
			include 'sc.consulta.material.transferido.php';
		break;

		default :
			print "<script type=\"text/javascript\">alert('opcao inválida !');
			history.back();</script>";
			break;
	}
}

if($op != null) {
	
	switch ($op){

		#@ relatorio direto de material em transito @
		case 'rmatt':
		include '../rel/rel.material.transito.php';
		break;

		#@ relatorio de material pago @
		case 'rmpg':
			include '../rel/rel.material.pago.php';
		break;

		#@ relatorio recebimento de materiais @
		case 'rrmat':
			include '../rel/rel.receb.material.php';
		break;

		#@ relatorio material transferido
		case 'rtrans':
			include '../rel/rel.consulta.material.transferido.php';
		break;

		default:
			print "<script type=\"text/javascript\">alert('opcao inválida !');
			history.back();</script>";
			break;
	}

}


?>

