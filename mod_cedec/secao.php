<?php

##########################################  arquivo  ##############################################
    
    #@ arquivamento Oficio
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "arquivo") && (isset($_GET['acao'])) && ($_GET['acao'] == "cadastrar")) {
        
        include 'visao/sc.arquivo.oficio.php';
        exit();

    }


    # busca arquivamento Oficio
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "arquivo") && (isset($_GET['acao'])) && ($_GET['acao'] == "buscar")) {
        
        include 'visao/sc.arquivo.oficio.consulta.php';
        exit();
        
    }
    
    # validar arquivamento Oficio
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "arquivo") && (isset($_GET['acao'])) && ($_GET['acao'] == "valida")) {
        
        include 'controle/valida.oficio.arquivar.php';
        exit();
        
    }
    
    
    
    ##########################################  MUNICIPIO  ##############################################
    
    #@ cadastro
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "municipio") && (isset($_GET['acao'])) && ($_GET['acao'] == "cadastrar")) {
        
        include 'visao/sc.municipio.cadastrar.php';
        exit();

    }


    # busca Municipio alteração
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "municipio") && (isset($_GET['acao'])) && ($_GET['acao'] == "buscar")) {
        
        include 'visao/sc.municipio.consulta.php';
        exit();
        
    }
    
    # validar cadastro/alterar municipio
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "municipio") && (isset($_GET['acao'])) && ($_GET['acao'] == "valida")) {
        
        include 'controle/valida.municipio.cadastrar.php';
        exit();
        
    }
    
    
    

        
    
?>  