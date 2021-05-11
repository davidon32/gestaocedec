<?php
	include_once '../../include.php';
	
	$_conexao = new ConexaoMysql();
	
	//Login::logado();

	#@ id liberacao 
	$_id = isset($_POST['id_libera']) ? $_POST['id_libera'] : null;
	
	#@ motivo cancelamento
	$_motivo = isset($_POST['motivo']) ? $_POST['motivo'] : null;
	
	$_cancela = isset($_POST['cancela']) ? $_POST['cancela'] : null;
	
		if($_cancela == 'Confirmar') {
			
			if((($_id != '') && ($_id != null)) && (($_motivo != '') && ($_motivo != null))) {
				
				
				Liberacao::CancelaLiberacao($_id, $_motivo);
			}
			else {
				
				print FuncaoBase::alert('Preencimento de Campos Sao Obrigatorios !');
					FuncaoBase::voltar();
			}
			
		}
		
		FuncaoBase::vd($_POST);
			
			
			
	
	
	
	

?>
