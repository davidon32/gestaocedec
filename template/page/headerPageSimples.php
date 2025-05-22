<!DOCTYPE html><?php if(isset($pageSession)){
        if(!empty($_COOKIE['session']['seguranca']['email_rec'])){
          $ses_email = $_COOKIE['session']['seguranca']['email_rec'];
          $email = trim($ses_email);
          $email = strtolower( $email );
          $gravataremail =  "https://www.gravatar.com/avatar/".md5( $email );
        }else {
          $gravataremail =  "/core/imagem/padrao.png";
        }
      }
    ?>

<head>
<meta charset="utf-8" name="robots" content="noindex, nofollow">
  <meta http-equiv="Content-Language" content="pt-br">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SDC - Sistema Defesa Ci</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="template/dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="css/style.css" >
  <link rel="stylesheet" href="css/easy-autocomplete.css" />
  
<link rel="stylesheet" href="css/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="css/sweetalert2.min.css" rel="stylesheet" />

<script src="js/sweetalert2.all.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--removido Google Fontes-->
  <style type="text/css">

@media print {
    #div-icon{
      display: none;
    }
  }

  /* icone ajuda */
  @-webkit-keyframes changewidth {
  from {
        width: 100px;
      }

      to {
        width: 103px;
      }
    }

#img-ajuda {
  animation-duration: 2s;
  animation-name: changewidth;
  animation-iteration-count: infinite;
  animation-direction: alternate;
}

#div-icon{
    position: fixed;
    right: 0pt;
    bottom: 0pt;
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
