<?php include_once '/include.php';

    /*
     * 
     * Valida Cadastro de mensagens na pagina inicial do Sistema.
     * 
     * 
     */
	
	$_conexao = new ConexaoMysql();

	$titulo = isset($_POST['titulomsg']) ? $_POST['titulomsg'] : false;
	
	$mensagem = isset($_POST['msg']) ? $_POST['msg']: false;
	
	$enviar = isset($_POST['enviar']) ? $_POST['enviar']: false;
	
	
	$cadastro = MensagemSistema::cadastroMensagem($titulo, $mensagem);
		
		if($cadastro) {
			
			print "Mensagem Cadastrada com Sucesso !<br>";
			
			print "<a href=\"/administrator/adm\">Voltar</a>";
			
		}
		
		
	
	


?>