<?php
include_once '../../include.php';


	$_conexao = new ConexaoMysql();


	$_usuario = isset($_POST['login'])? $_POST['senha'] : null;

	$login = new Login();
	
	$login::logar($_POST['login'], $_POST['senha'], true);
	
	
	
	
	FuncaoBase::vd($login);
	
	FuncaoBase::vd($_post);
		
	$log = new Log();
	
	
	//$log->GravaLog(1,'teste');		
	


?>



<script >alert('vc esta dentro do sistema');</script>
<?php
	header('Location:../core/sc.menu.php');

?>
