<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';


?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
        <div class="span12 text-center">
            <br>
            <br>
            <?php
                

                $_id_dsp = isset($_GET['id']) ? $_GET['id'] : "";
                $tipo = isset($_GET['tp']) ? $_GET['tp'] : "";
                
                
                /* DSP Militar */
                if($tipo == "0") {
                
                    
                    print "<a class=\"btn\" href=\"index.php?modulo=equipe&secao=relatorio&acao=dsp_militar&id=" . $_id_dsp . "\">Imprimir DSP</a>&nbsp;&nbsp;";
                    
                    /* relatorio viagem*/
                    print "<a class=\"btn\" href=\"index.php?modulo=equipe&secao=relatorio&acao=dsp_rel_viagem&id=" . $_id_dsp . "\">Rel Viagem</a><br><br>";                
                /* DSP Civil */    
                }else if($tipo == "1") {
                    
                    print "<a class=\"btn\" href=\"index.php?modulo=equipe&secao=relatorio&acao=dsp_civil&id=" . $_id_dsp . "\">Imprimir DSP</a>&nbsp;&nbsp;";                    
                    
                }
 
                    print "<a class=\"btn\" href=\"index.php?modulo=equipe&secao=dsp&acao=cadastro\">Voltar</a>";
                
              
            ?>            
            
        </div>
    </div>
