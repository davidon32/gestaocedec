<?php include_once PATH.'/core/include.php';

 
if(isset($_COOKIE['seguranca'])){
$session = $_COOKIE;


$pageSession = array(
		'titulo' => VERSAO, 
		'titulo1' => "Menu Secundário",
		'session' => $session,
);

}