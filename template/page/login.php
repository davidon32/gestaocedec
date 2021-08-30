<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <title>Sistema CEDEC - <?=VERSAO?></title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="js/sweetalert2.all.min.js"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
   <a href=\"../../index.php\"><b>SDC</b><br><h4>Sistema de Defesa Civil</h4></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Entre com seu <b>usuário</b> e <b>senha</b> para acesso ao Sistema</p>

    <form action="index.php?modulo=index&controller=index&action=logar" method="POST">
      <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Email" name="login" id="login" value="" maxlength="70">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span id='municipio'></span>
      </div>
      <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="senha"id="senha" value="" title="O sistema diferencia letras maiúsculas de minúsculas !" maxlength="70">
          <span class="glyphicon glyphicon-lock form-control-feedback">-</span><br>
        <p>O sistema diferencia letras <i style='color:red'>MAIÚSCULAS</i> e <i style='color:red'>minúsculas</i>.</p>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Lembrar Usuário
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
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

    <a href="index.php<?=FuncaoBase::geraLink("admin", "admin", "esqueci_senha", array('externo'=>md5('externo')))?>">Esqueci minha senha</a><br>
    <!--<a href="register.html" class="text-center">Registrar novo Usuário</a>-->
    
    <!--<a href="register.html" class="text-center">Precisando de Ajuda Clique Aqui</a>
    ou envie email para o suporte <br>demetrio.passos@defesacivil.mg.gov.br-->
    
    

  </div>
  <!-- /.login-box-body -->

</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="template/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="template/plugins/iCheck/icheck.min.js"></script>
<script>
    
    $(document).ready(function(){
       
      /* $("#login").blur(function(){
           
           $.post( "<?=FuncaoBase::geraLink("index", "index", "buscalogin")?>", { municipio: $("#login").val()});
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
</body>
</html>