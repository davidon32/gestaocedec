<?php session_start();
	include_once '../include.php';

$_conexao = new ConexaoMysql();

Login::Logado();

Log::GravaLog('Acesso ao Modulo Decreto', 'dec_log');

print "<script text/javascript>";

print "window.location = 'index2.php?id=".session_id()."';";

print "</script>";
?>