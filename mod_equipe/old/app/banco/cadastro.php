<?php session_start();
print "<!DOCTYPE html>";
include_once '/include.php';

$_conexao = new ConexaoMysql();

$_funcionario = new EquipeFuncionario();

$helper = new Html();

/***********************************************************************
 * Órgão      : Gabinete Militar do Governador de Minas Gerais
 * Secretária : Coordenadoria Estadual de Defesa Civil de Minas Gerais
 * Descrição  : Cadastro de dados bancários dos funcionarios
 * Autor      : Demetrio S. Passos
 * Data       : 01/01/2013
 * 
 ***********************************************************************/

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO; ?></title>
<link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body><div class="container">
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
                    include_once "/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';
                ?>
            </div>
            <!-- CORPO PAGINA  -->
            <div class="span7">
                <legend>Cadastro Dados Bancários</legend>
                <form action="index.php?modulo=equipe&secao=banco&acao=valida" method="POST" name="frm_cad_banco">
                    <label>Nome do Banco</label>
                    <input type="text" name="txt_non_banco" id="txt_non_banco" title="Nome do Banco" />
                    
                    <label>Número Banco</label>
                    <input type="text" name="txt_num_banco" id="txt_num_nbanco" title="Número do Banco" maxlength="3"/>
                    
                    <label>Número Conta</label>
                    <input type="text" name="txt_conta" id="txt_conta" title="Número da Conta" />
                    
                    <label>Agência</label>
                    <input type="text" name="txt_agencia" id="txt_agencia" title="Número da Agência" />
                    
                    <!--Tipo de conta conta (padrao conta corrente)<label>Tipo Conta</label> -->
                    <input type="hidden" name="txt_tp_conta" id="txt_tp_conta" value="1" />
                    <br>
                    Conta Principal : <input type="checkbox" id="ck_princ" name="ck_princ" />
                    <br><br>
                    
                    <!-- id do funcionario -->
                    <?php $helper->input("select", "idFuncionario", "Funcionario", false, $_funcionario->dadosCombo());?>
                    
                    <br><br><br><br>
                    
                    <input type="submit" name="btn_enviar" id="btn_enviar" class="btn btn-primary" value="Cadastrar"/>
                </form>   
            </div>
       </div>
</body>
</html>