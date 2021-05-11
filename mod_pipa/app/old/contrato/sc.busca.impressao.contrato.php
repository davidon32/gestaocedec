<?php session_start();
print "<!DOCTYPE html>";
include_once '../include.php';
/************************************************************************************+
 #  Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
 #  Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
 #  Autor       : Demetrio S. Passos                                                 #
 #  Criação     : 00/00/0000                                                         #
 #  Descrição   : cadastro de DSP
 #
 +************************************************************************************/

$_conexao = new ConexaoMysql();

$_municipio = new Municipio();

$_funcionario = new EquipeFuncionario();

$_funcaoBase = new FuncaoBase();

$_dsp = new EquipeDSP();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO; ?></title>
<link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
        <div class="row-fluid text-center">
            <img src="../imagem/topo_pipa.png" />
            <hr>
        </div>
        <!-- BARRA -->
        <div class="row-fluid">
            <div class="span6 text-left">
                <small><?php print "Data :" . date("d/m/Y"); ?> </small>
            </div>
            <div class="span6 text-right">
                <small><?php print "Hora :" . date("H:i:s"); ?> </small>
            </div>
        </div>

        <!-- LOGOUT -->
        <div class="row-fluid">
            <div class="span12 text-right">
                <a class="btn btn-primary" href="<?php print SISTEMA; ?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
                <p> 
                <hr>
            </div>
        </div>

        <div class="row-fluid">

            <!-- MENU -->
            <div class="span3">
                <?php
                include_once 'visao/pipa.menu.php';
            ?>
            </div>

            <!-- CORPO PAGINA  -->
            <div class="span7 fdo_corpo">
                <legend>Impressão Cadastro Contrato</legend>
                <form action="secao.php?secao=relatorio&acao=relCadContrato" method="POST" name="frmFiltroRelContr">

                    <label>Nome</label>
                    <input type="text" name="txtNome" id="txtNome" title="Nome do Motorista" class="" >

                    <label>Placa</label>
                    <input type="text" name="txtPlaca" id="txtPlaca" title="Placa do Contrato" class="" >
                    <br>
                    <label>Ano</label>
                    <input type="text" name="txtAno" id="txtAno" title="Ano de Contratação" class="" >
                    <br>
                                        
                    <input type="submit" class="btn btn-primary" value="Pesquisar" name="btnEnviar" id="btnEnviar" >
                    
                    </form>

            </div>

        <!-- RODAPE -->
        <div class="row-fluid">
            <div class="span12 text-center">
                <small><?php print RODAPE; ?> </small>
            </div>
        </div>
    </div>

    <script src="<?php print SISTEMA; ?>/js/jquery.js"></script>
    <script src="<?php print SISTEMA; ?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/jasny-bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/funcaobase.js"></script>

    

</body>
</html>
