<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$muncipio = new Municipio();

//$municipio->alterarComunidade($_POST);

$dados = isset($_POST) ? $_POST : "";

if($dados['btnInfoMunicipio'] == "gravar"){

	$erro = false;
        
        if($dados['txtAliquota'] == '') {
            $dados['txtAliquota'] = '0.00';
            
        }

	foreach ($dados as $key=>$value) {
		if($key != 'txtNumLei' && $key != 'txtAliquota'){
                    if($value == ""){ 
                        var_dump($key);
			$erro = true;
			continue;
                    }
		}
	}
       
	if(!$erro) {
            
		if($muncipio->alterarMunPmda($dados)){
                    #log alteração
                    print 'sucesso';
		}else {
                    print 'erro';
		}
	
	}
	
}else {
	print "erro";
}

				 
?>