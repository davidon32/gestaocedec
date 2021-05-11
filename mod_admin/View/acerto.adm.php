<?php include_once("../../configuracao.php");include_once("../../mod_pipa/classe/Classe.Calculo.php");


    $conta = new Calculo();

    # ler arquivo texto
    $lista[] = array("placa"=>"AAA-0000", "km"=>"1000", "mes"=>"09", "ano"=>"2015");
    
    # quantidade de registros
    print "Quantidade de Registro : ". count($lista);
    
    #lanca as contas
    for($i = 0; $i < count($lista); $i++) {
    
        # atualiza conta existente
        if($conta->buscaconta($lista[$i])) {

        # lanca conta nova    
        }else {
            
            
        }
        
    }
    
    
    


?>