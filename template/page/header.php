<?php
if (isset($pageSession['session']['seguranca']['nome_usuario'])) {
    
} else {
print "<script>";
print "window.location.href='index.php'";
print "</script>";
}

$posto = isset($pageSession['session']['seguranca']['posto']) ? $pageSession['session']['seguranca']['posto'] : "";

$secao = isset($pageSession['session']['seguranca']['secao']) ? $pageSession['session']['seguranca']['secao'] : "";

?>
<script type="text/javascript">
    function start_countdown()
    {
        var sessao_expira = new Date(<?= isset($_COOKIE['seguranca']['sessao']) ? $_COOKIE['seguranca']['sessao'] : "0"; ?> * 1000);

        myVar = setInterval(function ()
        {
            var tempo_sessao = (sessao_expira - new Date(Date.now()));

            if (tempo_sessao > 1000)
            {

                var result = new Date(tempo_sessao);

                var duration = sessao_expira - new Date(Date.now());

                var milliseconds = parseInt((duration % 1000) / 100);
                var seconds = parseInt((duration / 1000) % 60);
                var minutes = parseInt((duration / (1000 * 60)) % 60);
                var hours = parseInt((duration / (1000 * 60 * 60)) % 24);

                hours = (hours < 10) ? "0" + hours : hours;
                minutes = (minutes < 10) ? "0" + minutes : minutes;
                seconds = (seconds < 10) ? "0" + seconds : seconds;
                if (hours == 0 & minutes == 0 & seconds == 20) {
                    setInterval(function() {
                        $("#countdown").fadeTo(250, 0).fadeTo(250,1).fadeTo(250,0).fadeTo(250,1);
                        $("#countdown").attr('title', 'Tempo de Sessão expirando será necessário refazer o login')
                    },1000);
                }

            } else {

                hours = "00";
                minutes = "00";
                seconds = "00";

                $.ajax
                        ({
                            type: 'post',
                            url: 'mod_equipe/View/usuario/func.php?v=<?= md5(VERSAO) ?>',
                            data: {
                                logout: "logout"
                            },
                            success: function (response)
                            {
                                window.location = "index.php";

                            },
                            error: function (response) {
                                console.log(response);
                            }
                        });
            }
            document.getElementById("countdown").innerHTML = "Sessão: " + hours + ":" + minutes + ":" + seconds;
        }, 1000)
        
    }

    $(function() {
        $('.dropdown-toggle').dropdown();
    });
</script>
<style>
.overlay1 {
    position: fixed;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background: rgba(70,20,15,0.3);
    z-index: 2;
    background-image: url(https://i.stack.imgur.com/BNGOI.gif);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 100px;
  }    

.logout-link .logout-img {
    transition: filter 0.2s, transform 0.2s;
}
.logout-link:hover .logout-img {
    filter: brightness(1.5) drop-shadow(0 0 4px #fff);
}
</style>
    
<div class="overlay1"> <i class="fa fa-cog fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> </div>

<!-- BARRA SUPERIOR USUARIO  -->
<header class="main-header print">
    <nav class="navbar navbar-static-top">
        <!-- <a href="#" class="sidebar-toggle"><img style="border-radius:6px; width: 200px" src="/core/imagem/logo_modelo_1-160X44-a.png"></a> -->

        <!-- <div class="navbar-custom-menu" > -->
            <!-- <ul class=""> -->
                <div style="display: flex; flex-direction: row; align-items: center; height: 100%; margin: 10px; justify-content:space-between">
                    <div>
                        <img style="border-radius:6px; width: 200px" src="/core/imagem/logo_modelo_1-160X44-a.png">
                    </div>
                    <div>
                        <div style="display: flex; flex-direction: row; align-items: center; gap: 10px;">
                            <div class="dropdown user user-menu" style="min-width: 200px; display: flex; flex-direction: column; align-items: flex-end; padding-right: 10px; justify-content: center; height: 100%;">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff; padding:0;" title="Nome do Usuario do Sistema">
                                    <?php
                                    if (isset($pageSession['session']['seguranca']['externo'])) {
                                        print $pageSession['session']['seguranca']['nome_usuario'];
                                    } else {
                                        print $posto." ".substr($pageSession['session']['seguranca']['nome_usuario'], 0, 20)."..";
                                        print "( ".$secao." )";
                                    }
                                    ?>
                                    <script>start_countdown();</script>
                                </a>
                                <ul class="dropdown-menu" style="right:0; left:auto; min-width: 260px; padding: 15px; background: #222d32; color: #fff;">
                                    <li>
                                        <p style="text-align: left; font-size: 10pt; margin-bottom: 10px;">Recuperação de Senha :<br>
                                            <span class="hidden-xs"><?= isset($pageSession['session']['seguranca']['email_rec']) ? $pageSession['session']['seguranca']['email_rec'] : "Sem Email de Recuperação de senha"; ?></span>
                                        </p>
                                    </li>
                                    <?php
                                    if (!isset($pageSession['session']['seguranca']['externo'])) {
                                        ?>
                                        <li style="margin-bottom: 5px;">
                                            <a href="<?= FuncaoBase::geraLink("admin", "adm", "perfil", array('id' => $pageSession['session']['seguranca']['idUser'])) ?>" class="btn btn-default btn-flat btn-block" title="Alterar senha / email de recuperação " style="text-align:left;">Perfil</a>
                                        </li>
                                        <li>
                                            <a href="<?= FuncaoBase::geraLink("equipe", "funcionario", "alterar", array('id' => $pageSession['session']['seguranca']['idUser'])) ?>" class="btn btn-default btn-flat btn-block" title="Atualize / Complete o seus dados" style="text-align:left;">Dados Funcionário</a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <p id="countdown" style="margin:0; font-size:14px; color: #ffffff;" title="Tempo Restante de Sessão">SESSÃO: <span class="fa fa-refresh fa-spin" style="margin-right: 5px;"></p>
                            </div>
                            <div class="dropdown tasks-menu" style="display: flex; align-items: center; height: 100%;">
                                <a class="dropdown-toggle logout-link" href="<?= FuncaoBase::geraLink("index", "index", "logout") ?>" title="Sair com Segurança do Sistema">
                                    <img src="/core/imagem/logout_white.png" class="logout-img">
                                </a>
                            </div>
                            <style>
                            </style>
                        </div>
                    </div>

                <!-- </div> -->
            <!-- </ul> -->
        </div>
        <!-- final itens usuario-->
    </nav>
</header>
<br>