<footer class="main-footer print">
    <div class="pull-right hidden-xs">
        <?php
            if(isset($_COOKIE['seguranca']['externo']) && (!$_COOKIE['seguranca']['externo'])){
                print "<a href='".FuncaoBase::geraLink("admin", "release", "rel")."'>".VERSAO."</a>";
            }else {
                print VERSAO;
            }
            ?>
    </div>
    <strong>CEDEC-MG <a href="www.defesacivil.mg.gov.br">Coordenadoria Estadual de Defesa Civil de Minas Gerais</a>.</strong>
</footer>