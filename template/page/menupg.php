<?php if(!isset($_SESSION)){
	session_start();
}

include_once 'core/system/config/config.inc.php';
include_once 'core/system/config/config.php';
include_once 'core/model/'.$action.$modulo."Model.php";
include_once 'core/include.php';

$session = $_SESSION;
?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?PHP require_once "corpo.php"; ?>
<!-- =================== RODAPE  ============================ -->
<?php include_once "rodape.php"?>
<?php include_once "barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
