<?php if($_SERVER['HTTP_HOST'] == 'desenvolvimento.sgecedec.com'){

    $path = "gestaocedec";    
   
}else {
          
    $path = "web";    
          
}
      
    require_once($_SERVER['DOCUMENT_ROOT']."/system/config.inc.php");
    require_once(PATH."/plugins/nusoap-0.9.5/lib/nusoap.php");


	$server = new nusoap_server;
   
    $server->configureWSDL('server.listacompdec', 'urn:server.listacompdec');
    $server->wsdl->schemaTargetNamespace = 'urn:server.listacompdec';

	    
    /* inicio método */
    $server->register('listacompdec', // nome metodo
        array('name'=> 'xsd:string'), //parametro de entrada
        array('return' => 'xsd:string'), // parametro saida
        'urn:server.listacompdec', //namespace
        'urn:server.listacompdec#listacompdec', //soapaction
        'rpc', //style
        'encode', //use
        'Retorna uma tabela com os compdec cadastrados' // documentacao do serviço
        );


    function listacompdec($name) {

        return "lista compdec".$name;

    }
    /* fim metodo */
    

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

	$server->service($HTTP_RAW_POST_DATA);

?>