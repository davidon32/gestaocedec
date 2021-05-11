<?php include_once PATH.'/include.php';
?>
    <div class="dropdown">
	   <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 5px; *width: 180px;">
           <li>
                <a href="index.php?secao=cedec&acao=index" title="Menu Principal do Sistema">Menu Principal</a>
           </li>
           <li>
                <a href="index.php?modulo=ajuda&secao=menu" title="Página Inicial do Módulo">Página Inicial</a>
           </li>
           <?php AcessoAjuda::acessoMenu($_SESSION['seguranca']['login']); ?>
	   </ul>
	   </div>
    <?php
		if (isset($_GET['area'])) {
			include_once 'sc.liberacao.material.php';
		}
    ?>