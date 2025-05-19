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
</style>
    
<div class="overlay1"> <i class="fa fa-cog fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> </div>

<!-- BARRA SUPERIOR USUARIO  -->
<header class="main-header print">
    <nav class="navbar navbar-static-top d-flex">
        <div>
            <a href="#" class="sidebar-toggle"><img style="border-radius:6px; width: 200px" src="/core/imagem/logo_modelo_1-160X44-a.png"></a>
        </div>

        <div class="navbar-custom-menu" >
            <ul class="nav navbar-nav">
                <li class="dropdown tasks-menu">
                    <a class="dropdown-toggle" href="<?= FuncaoBase::geraLink("index", "index", "logout") ?>" title="Sair com Segurança do Sistema">
                        <img src="/core/imagem/desligar.png">
                    </a>
                </li>

                <li class="dropdown user user-menu" style="min-width: 200px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding:0;" title="Nome do Usuario do Sistema">

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
                    <p id="countdown" style="margin:0; font-size:14px; color: #ffffff; float: right" title="Tempo Restante de Sessão"></p>

                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img  src="<?= $gravataremail; ?>" class="img-circle" alt="User Image">

                            <br>
                            <br>
                            <p style="text-align: left; font-size: 10pt;">Recuperação de Senha :<br>
                                <span class="hidden-xs"><?= isset($pageSession['session']['seguranca']['email_rec']) ? $pageSession['session']['seguranca']['email_rec'] : "Sem Email de Recuperação de senha"; ?></span>
                            </p>
                            <small>Membro desde : </small>



                        </li>
                      
                        <!-- Menu Footer-->
                        <li class="user-footer">

                            <?php
                            if (isset($pageSession['session']['seguranca']['externo'])) {
                                
                            } else {
                                print "<div class=\"pull-left\">";
                                print "<div class='pull-left'><a href='" . FuncaoBase::geraLink("admin", "adm", "perfil", array('id' => $pageSession['session']['seguranca']['idUser'])) . "' class=\"btn btn-default btn-flat\" title='Alterar senha / email de recuperação '>Perfil</a></div>
                                <div class='pull-right'><a href='" . FuncaoBase::geraLink("equipe", "funcionario", "alterar", array('id' => $pageSession['session']['seguranca']['idUser'])) . "' class=\"btn btn-default btn-flat\" title='Atualize / Complete o seus dados'>Dados Funcionário</a></div>
                      </div>";
                            }
                            ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- final itens usuario-->
    </nav>
</header>
<br>