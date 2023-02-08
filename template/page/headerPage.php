<!DOCTYPE html><?php
if(isset($pageSession)){
    
        if(!empty($_COOKIE['seguranca']['email_rec'])){
          $ses_email = $_COOKIE['seguranca']['email_rec'];
          $email = trim($ses_email);
          $email = strtolower( $email );
            //$gravataremail =  "https://www.gravatar.com/avatar/".md5( $email );
            $gravataremail =  "/core/imagem/padrao.png";
        }else {
          $gravataremail =  "/core/imagem/padrao.png";
          
        }
        
    }else{
        header('Location: /index.php');var_dump($pageSession, !empty($_COOKIE['seguranca']['email_rec']));
            die();
    }
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Language" content="pt-br">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$pageSession['titulo'];?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="template/bower_components/bootstrap/dist/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="template/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="template/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="template/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="template/dist/css/skins/_all-skins.min.css">
  
<!---->
<link rel="stylesheet" href="css/style.css">

  <!-- auxiliar PMDA -->
  <link rel="stylesheet" href="js/lib/thickbox.css"/>
<link rel="stylesheet" href="css/easy-autocomplete.css" />
<link rel="stylesheet" href="css/jquery-ui.css"/>
<link rel="stylesheet" href="css/sweetalert2.min.css"/>

<script src="js/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="/plugins/datetimepicker/jquery.datetimepicker.css"/>

   <!-- Google Font -->
  <!--<!--removido Google Fontes-->

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


      ul .imgHover {
          display: flex;
      }

      li {
          list-style-type: none;
          padding: 10px;
          position: relative;
      }
      .large {
          position: absolute;
          left: -9999px;
      }
      li:hover .large {
          left: 20px;
          top: -150px;
      }
      .large-image {
          border-radius: 4px;
          box-shadow: 1px 1px 3px 3px rgba(127, 127, 127, 0.15);
      }
      
      .table th {
          background-color: #C0C0C0;
      }
      
      
      /* barra debug */
       #posiciona {
           font-family: tahoma;
        position: fixed; /* posição absoluta ao elemento pai, neste caso o BODY */
        /* Posiciona no meio, tanto em relação a esquerda como ao topo */
        padding-left: 5px;
        left: 0%; 
        top: 90%;
        width: 100% ; /* Largura da DIV */
        height: 100px; /* Altura da DIV */
        background-color: #FFF;
        color: #FFF;
        background-color: #666;
        /*text-align: center; /* Centraliza o texto */
        z-index: 1000; /* Faz com que fique sobre todos os elementos da página */
    }
    #fechar { margin-right: 5px; font-size: 12px; }

</style>

</head>
<!--<body class="hold-transition skin-blue sidebar-mini" id="menuLateral"> remover bara lateral --> 
<body class="hold-transition skin-blue" id="menuLateral">
<!-- Site wrapper --> 
<!--<div class="wrapper">-->