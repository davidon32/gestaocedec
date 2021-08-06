<?php
include_once '/include.php';

$_acessoMenu = new AcessoEscola();

$_login = isset($_SESSION['seguranca']['login']) ? $_SESSION['seguranca']['login'] : "";
?>

<div class="dropdown clearfix">
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 5px; *width: 180px;">
        <li>
            <a href="/index.php?secao=cedec" title="Menu Principal do Sistema">Menu Principal</a>
        </li>
        <li>
            <a href="index.php?modulo=escola&secao=menu" title="Página Inicial do Módulo">Página Inicial</a>
        </li>

        <?php $_acessoMenu -> acessoMenu($_login); ?>
    </ul>
</div>
