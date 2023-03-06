<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <title>Sistema CEDEC - <?= VERSAO ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="template/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="template/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="template/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="template/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="template/plugins/iCheck/square/blue.css">
        <style>

            /* tela background */
            div#login_fdo {
                min-height: 100vh;  /*For 100% screen height */
                /* width:  100vw;  For 100% screen width 100;*/
                background-image: url("/core/imagem/background1_.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                margin: auto;
                text-align:center;
                justify-content: center;
                display: flex;
            }

            /* col-5 tela login */
            div#login_sdc {
                margin-top: 30vh;
                position: relative;
            }


            img{
                display: block;
                position: relative;
                margin: auto;
            }


            /* div container do login */
            div.login-box1 {
                margin: 0 auto;
                width: 360px;
            }

            /* titulo login */
            div.login-logo1{
                text-align: center;

            }
            div.login-logo1 b{
                font-size: 20pt;

            }
            #topo1{
                /*                height: 100px;*/
            }

/*            div#row1 {
                                max-height: 100vh;
                z-index: 0;
                                position: absolute;

            }*/

/*            div#row2 {
                                //max-height: 10vh;
                display: flex;
                justify-content: flex-end;
            }*/

            #tempo{
                justify-content: flex-end;
            }

/*            @media screen and (max-width: 414px){

                div#login_fdo {
                    height: 10vh;  /*For 100% screen height 
                     width:  100vw;  For 100% screen width 100;
                    background-image: url("/core/imagem/background1_.jpg");
                    background-repeat: no-repeat;
                    background-size: cover;
                    margin: auto;
                    text-align:center;
                    justify-content: center;
                    display: flex;
                }
                img{
                    width: 10%;
                    display: block;
                    position: relative;
                    margin: auto;
                }

            }*/

        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <!--removido Google Fontes-->
        <script src="js/sweetalert2.all.min.js"></script>
    </head>
    <body class="hold-transition login-page">

        <div class="flex-contaner">


            <div class="row" id="row1">
                <div class="col col-md-7" id="login_fdo">
                    <img src="/core/imagem/logo_sdc.png" alt="">
    <!--                <div id="ww_faf7fd42cfdd2" v='1.3' loc='auto' a='{"t":"horizontal","lang":"pt","sl_lpl":1,"ids":[],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"image","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722"}'><a href="https://weatherwidget.org/android-app/" id="ww_faf7fd42cfdd2_u" target="_blank">Best free weather app for android</a></div><script async src="https://app1.weatherwidget.org/js/?id=ww_faf7fd42cfdd2"></script>;-->
                </div>

                <div class="col col-md-5">
                    <div id="login_sdc">
                        <div class="login-box1" >
                            <div class="login-logo1">
                                <!--                        <a href=\"../../index.php\" title="Sistema de Defesa Civil"><b>SDC</b></a>;-->
                                <br>
                            </div>
                            <!-- /.login-logo -->
                            <div class="login-box-body1">
        <!--                        <p class="login-box-msg">Entre com seu <b>usuário</b> e <b>senha</b> para acesso ao Sistema</p>-->

                                <form action="index.php?modulo=index&controller=index&action=logar" method="POST">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" placeholder="Email" name="login" id="login" value="" maxlength="70" title="O email de entrada no SDC é o mesmo email de recuperação de senha">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        <span id='municipio'></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="Password" name="senha"id="senha" value="" title="O SDC diferencia letras maiúsculas de minúsculas !" maxlength="70">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span><br>

                                    </div>
                                    <div class="row">
                                        <div class="col-xs-8">

                                            <!--                                        <label>
                                                                                        <input type="checkbox"> Lembrar Usuário
                                                                                    </label>-->
                                            <a class='btn btn-link' href="index.php<?= FuncaoBase::geraLink("admin", "admin", "esqueci_senha", array('externo' => md5('externo'))) ?>">Esqueci minha senha</a>

                                        </div>
                                        <!-- /.col -->
                                        <div class="col-xs-4">
                                            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>

                                    <div class="row">
                                        <br>
                                        <div class="col-xs-12">
                                            <div class="col alert alert-warning">
                                                Ao usar o recurso "Esquecí minha Senha",<br> verifique em seu email a sua caixa de "SPAM / LIXO ELETRONICO"
                                            </div>
                                        </div>

                                    </div>

                                </form>

                                <!--     <div class="social-auth-links text-center">
                                      <p>- OR -</p>
                                      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                                        Facebook</a>
                                      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                                        Google+</a>
                                    </div> -->
                                <!-- /.social-auth-links -->


                                <!--<a href="register.html" class="text-center">Registrar novo Usuário</a>-->

                                <!--<a href="register.html" class="text-center">Precisando de Ajuda Clique Aqui</a>
                                ou envie email para o suporte <br>demetrio.passos@defesacivil.mg.gov.br-->
                            </div>
                            <!-- /.login-box-body -->

                        </div>
                        <!-- /.login-box -->
                    </div>
                </div>
            </div>
            <div class="row" id="row2">
                <div class="tempo" id="ww_0c8fb7f40166b" v='1.3' loc='auto' a='{"t":"responsive","lang":"pt","sl_lpl":1,"ids":[],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"image","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722"}'>
                    <a href="https://weatherwidget.org/android-app/" id="ww_0c8fb7f40166b_u" target="_blank">Free weather app for android</a>
                </div>
                <script async src="https://app1.weatherwidget.org/js/?id=ww_0c8fb7f40166b"></script>
            </div>
        </div>

    </body>
    <!-- jQuery 3 -->
    <script src="template/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="template/plugins/iCheck/icheck.min.js"></script>
    <script>

        $(document).ready(function () {



            /* $("#login").blur(function(){
             
             $.post( "<?= FuncaoBase::geraLink("index", "index", "buscalogin") ?>", { municipio: $("#login").val()});
             $("#municipio").text('opa'); 
             });*/

        });

        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>

</html>