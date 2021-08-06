<?php

    $_opcao = isset($_GET['op']) ? $_GET['op'] : false;
    
    /* AJUDA HUMANITARIA */
    if($_opcao == "ajuda") {
        
        include_once "ajuda/sc.doc.ajuda.php";
        exit;
      
    }

    /* PIPA */
    if($_opcao == "pipa") {
        
        include_once "pipa/sc.doc.pipa.php";
        exit;
      
    }
    
    /* CONTROLE DE EMERGENCIA */
    if($_opcao == "dce") {
        
        include_once "dce/sc.doc.dce.php";
        exit;
      
    }
    
    /* COMPDEC */
    if($_opcao == "compdec") {
        
        include_once "compdec/sc.doc.compdec.php";
        exit;
      
    }
    
    /* ESCOLA */
    if($_opcao == "escola") {
        
        include_once "escola/sc.doc.escola.php";
        exit;
      
    }
    
    /* DECRETACAO */
    if($_opcao == "dtec") {
        
        include_once "dtec/sc.doc.dtec.php";
        exit;
      
    }
    
      
    /* CEDEC  */
    if($_opcao == "cedec") {
        
        include_once "cedec/sc.doc.cedec.php";
        exit;
      
    }
    
    /* EQUIPE  */
    if($_opcao == "equipe") {
        
        include_once "equipe/sc.doc.equipe.php";
        exit;
      
    }