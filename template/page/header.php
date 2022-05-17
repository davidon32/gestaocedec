<?php
if (isset($pageSession['session']['seguranca']['nome_usuario'])) {
    
} else {
print "<script>";
print "window.location.href='index.php'";
print "</script>";
}
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
<?php ?>
<!-- BARRA SUPERIOR USUARIO  -->
<header class="main-header print">
    <!-- Logo -->
    <!--<a href="http://www.defesacivil.mg.gov.br" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <!--<span class="logo-mini"><b>SGE</b></span>
    <!-- logo for regular state and mobile devices -->
     <!--<span class="logo-lg"><b>CEDEC-MG</b></span>
  </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle"><img src="/core/imagem/sdc-110x32.png"></a>
        <!-- Sidebar toggle button remover barra lateral
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>-->

        <!-- inicio itens usuario -->

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Você tem 1 Mensagens</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <?php Usuario::mensagemSuporte($pageSession); ?>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">Ver todas as Mensagens</a></li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Voçê tem 1 notificação</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 atualizações de núcleo do sistema ativada
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">Ver todas</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Você tem 1 Tarefa pendente</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Tarefa teste
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Completa</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">Ver todas as Tarefas</a>
                        </li>
                    </ul>

                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu" style="min-width: 200px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding:0;">

                        <?php
                        if (isset($pageSession['session']['seguranca']['externo'])) {
                            print $pageSession['session']['seguranca']['nome_usuario'];
                        } else {
                            print $pageSession['session']['seguranca']['posto']." ".$pageSession['session']['seguranca']['nome_usuario'];
                        }
                        ?>
                        <script>start_countdown();</script>
                    </a>
                    <a href="<?= FuncaoBase::geraLink("index", "index", "logout") ?>" class="btn btn-default" style="padding:0; width: 40%; float: left; color: #ABABAB;" title="Sair com Segurança do Sistema">Logout</a>
                    <p id="countdown" style="margin:0; font-size:14px; color: #ffffff; float: right"></p>

                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img  src="<?= $gravataremail; ?>" class="img-circle" alt="User Image">

                            <br>
                            <br>
                            <p style="text-align: left; font-size: 10pt;">Recuperação de Senha :<br>
                                <span class="hidden-xs"><?= isset($pageSession['session']['seguranca']['email_rec']) ? $pageSession['session']['seguranca']['email_rec'] : "Sem Email de Recuperação de senha"; ?></span>
                            </p>
                            <small>Membro desde : </small>



                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <!-- <div class="row">
                              <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                              </div>
                              <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                              </div>
                              <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                              </div>
                            </div> -->
                            <!-- /.row -->
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
                            <div class="pull-right">
<!--                                <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=index&controller=index&action=logout" class="btn btn-default btn-flat">Logout</a>-->
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
        <!-- final itens usuario-->
    </nav>
</header>