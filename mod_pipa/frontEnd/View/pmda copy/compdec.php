<?php session_start();

	include_once $_SERVER['DOCUMENT_ROOT'] .'/include.php';

$eqCompdec = new MembroEqCompdec();

$eqCompdec->novo($_POST);
    
    

?>





?>