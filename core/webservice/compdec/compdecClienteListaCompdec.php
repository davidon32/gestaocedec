<?php //var_dump($_SERVER);
   
    require_once($_SERVER['DOCUMENT_ROOT']."/system/config.inc.php");
    require_once(PATH."/plugins/nusoap-0.9.5/lib/nusoap.php");

	$wsdl = 'http://desenvolvimento.sgecedec.com/webservice/compdec/compdecServer.php?wsdl';

	$cliente = new nusoap_client($wsdl, true);

	$erro = $cliente->getError();

	if($erro) {

		echo "Erro de Construtor <pre>".$erro."<pre>" ;

	}

	$result = $cliente->call('listacompdec', "ok");

	if($cliente->fault) {

		echo "Falha<pre>".print_r($result)."<pre>";
	}else {

		$erro = $cliente->getError();
		if($erro) {

			echo "Erro<pre>".$erro."<pre>";
		}else {

			print_r($result);
		}
	}

		

?>