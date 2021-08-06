<?php
include_once PATH.'/include.php';

$con = Conexao::getInstance();
?>
<div class="dropdown clearfix">
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 5px; *width: 180px;">
        <li>
            <a href="/index.php?secao=cedec" title="Menu Principal do Sistema">Menu Principal</a>
        </li>
        <li>
            <a href="index.php?modulo=equipe&secao=menu" title="Página Inicial do Módulo">Página Inicial</a>
        </li>
        <?php AcessoEquipe::acessoMenu($_SESSION['seguranca']['login']); ?>
    </ul>
</div>