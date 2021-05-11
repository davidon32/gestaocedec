<?php //var_dump($_SERVER);

if($_SERVER['HTTP_HOST'] == 'localhost'){

    $path = "gestaocedec";    
   
}else {
          
    $path = "web";    
          
}
      
    require_once($_SERVER['DOCUMENT_ROOT']."/".$path."/system/config.inc.php");
    require_once(PATH."/".$path."/plugins/nusoap-0.9.5/lib/nusoap.php");

	$wsdl = 'http://localhost/php_teste/soap/server2.php?wsdl';

	$cliente = new nusoap_client($wsdl, true);

	$erro = $cliente->getError();

	if($erro) {

		echo "Erro de Construtor <pre>".$erro."<pre>" ;

	}

	$result = $cliente->call('hello', array('Demetrio'));

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