<?php
    
    #@ acesso a planilha pipa
    if ((isset($_GET['secao'])) && ($_GET['secao'] == "pipa")) {
            
        include 'sc.pipa.php';


    }
    
    #@ acesso a planilha pipa
    if (((isset($_GET['secao'])) && ($_GET['secao'] == "usuario")) && ((isset($_GET['acao'])) && ($_GET['acao'] == "cadastro"))) {
            
        include 'sc.cadastro.usuario.ex.php';


    }
    
?>