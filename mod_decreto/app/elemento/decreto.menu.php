<?php include_once PATH.'/include.php';
		
$con = Conexao::getInstance();

	$_login = new Login();

	$_login->logado();

	$_acesso_decreto = new AcessoDecreto();
?>
	
	<div class="dropdown clearfix">
       <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 5px; *width: 180px;">
           <li>
                <a href="index.php?secao=cedec&acao=index" title="Menu Principal do Sistema">Menu Principal</a>
           </li>
           <li>
                <a href="index.php?modulo=decreto&secao=menu" title="Página Inicial do Módulo">Página Inicial</a>
           </li>

            <?php  $_acesso_decreto->acessoMenu($_SESSION['seguranca']['login']);?> 
	   </ul>
	</div>
	