<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_doc/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php
$_funcaoBase = new FuncaoBase();

?>
<div class="col-md-12 text-center"><a href='<?= FuncaoBase::geraLink("doc", "doc", "ajudahtml")?>' class='btn btn-success'>Voltar</a></div>
    <legend>Glossário </legend>

    <table class="table table-bordered table-responsive">
        <tr>
            <td>CEDEC</td><td>COORDENADORIA ESTADUAL DE PROTEÇÃO E DEFESA CIVIL</td>
        </tr>
        <tr>
            <td>COMPDEC</td><td>COORDENADORIA MUNICIPAL DE PROTEÇÃO E DEFESA CIVIL</td>
        </tr>
        <tr>
            <td>SIMPDEC</td><td>SISTEMA NACIONAL DE PROTEÇÃO E DEFESA CIVIL</td>
        </tr>
        <tr>
            <td>SDC</td><td>SISTEMA DE DEFESA CIVIL ( MINAS GERAIS )</td>
        </tr>
        <tr>
            <td>S2ID</td><td>SISTEMA INTEGRADO DE INFORMAÇÕES SOBRE DESASTRES ( GOVERNO FEDERAL )</td>
        </tr>
        
    </table>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>