<?php include_once PATH.'/include.php';

$con = Conexao::getInstance();

	$_login = new Login();

	$_login->logado();

	$_acessoCompdec = new AcessoCompdec();
?>
	<div class="dropdown clearfix">
	   <ul class="nav nav-pills nav-stacked" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 5px; *width: 180px;">
	       <li>
            <a href="/index.php?secao=cedec" title="Menu Principal do Sistema">Menu Principal</a>
           </li>
           <li>
            <a href="index.php?modulo=compdec&secao=menu" title="Página Inicial do Módulo">Página Inicial</a>
           </li>    

		    <?php $_acessoCompdec->acessoMenu($_SESSION['seguranca']['login']); ?>
	</ul>
	</div>