<?php include_once "core/Model/indexModel.php"?>
<?php include_once "mod_pipa/Model/IndexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menuExterno.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<div class="container">
    <!-- PAGINA -->
    <div class="container">
            <!-- CORPO -->
        <div class="row-fluid">
            <div class="span10">
            <br><br>
						<a class='btn btn-primary' href='?modulo=pipa&controller=pipa&action=caduser' title='Cadastro de Usuários COMPDEC'>Cadastro de Usuários (COMPDEC)</a><br>	<br>					
						<a class='btn btn-primary' href='?modulo=pipa&controller=pipa&action=pesquisaUsuario' title='Alterar dados do Usuário COMPDEC'>Alteração de Usuários (COMPDEC)</a>						

                    

                  
            </div>       
        </div> 
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>