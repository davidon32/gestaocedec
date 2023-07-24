<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Site Metas -->
    <title>Defesa Civil Agora</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!--<meta property="og:url"                content="http://www.defesacivil.mg.gov.br/dc_agora/index.php" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="" />
    <meta property="og:description"        content="" />
    <meta property="og:image"              content="http://www.defesacivil.mg.gov.br/anexo/def_civil_agora/<?= $dados['imagem1']; ?>" />-->
    
    <style>
            @font-face {
                font-family: "Droid Sans";
                src: url('fonts/DroidSans.ttf');      
        }
        
            @font-face {
                font-family: "Droid Sans Bold";
                src: url('fonts/DroidSans-Bold.ttf');      
        }

        body {
          font-family: "Droid Sans", "Droid Sans Bold" ;
         }
    </style>

    <!-- Site Icons -->
    <!--    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">-->

    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="css/responsive.css" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="css/colors.css" rel="stylesheet">

    <!-- Version Garden CSS for this template -->
    <link href="css/version/garden.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <?php
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    
    
    if($id == 0) {
        print "<script>";
    print "window.location = 'http://sistema.defesacivil.mg.gov.br/dc_agora'";
    print "</script>";
    
    }

    require('dados.php');
    
    $comentarios = $agora->getComentarios($id);
    
    
    ?>

    <div id="wrapper">
        <div class="collapse top-search" id="collapseExample">
            <?php include_once('search.php');?>
        </div><!-- end top-search -->

        <div class="topbar-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 hidden-xs-down">
                        <div class="topsocial">
                            <?php include_once('rede_social.php') ?>
                        </div><!-- end social -->
                    </div><!-- end col -->

                    <div class="col-lg-4 hidden-md-down">
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="topsearch text-right">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search"></i> Search</a>
                        </div><!-- end search -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end topbar -->

        <div class="header-section">
            <div class="container">

                <div class="row">
                    <div class="col-md-6">
                        <div class="text-right">
                            <a href="http://sistema.defesacivil.mg.gov.br"><img width="100" src="http://sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_gabinete_militar_nova.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <a href="http://sistema.defesacivil.mg.gov.br"><img width="100" src="http://sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_da_defesacivil_nova_expandida.png" alt=""></a>
                        </div><!-- end logo -->
                    </div>

                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end header -->

        <header class="header">
            <div class="container">
                <nav class="navbar navbar-inverse navbar-toggleable-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Forest Timemenu" aria-controls="Forest Timemenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-md-center" id="Forest Timemenu">
                        <?php include_once('menu.php'); ?>
                    </div>
                </nav>
            </div><!-- end container -->
        </header><!-- end header -->

        <div class="page-title wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <h2><i class="fa fa-address-book bg-green"></i> Defesa Civil Agora</h2>
                    </div><!-- end col -->
                    <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Blog</li>
                        </ol>
                    </div><!-- end col -->                    
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end page-title -->

        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-title-area">
                                <span class="color-green"><a href="index.php?cat=<?=FuncaoBase::slug($dados['categoria']);?>" title=""><?= $dados['categoria'] ?></a></span>

                                <h2><?= $dados['texto'] ?></h2>

                                <div class="blog-meta big-meta">
                                    <small><?= DataMysql::dataCompletaVisual($dados['data_hora']) ?></small>
                                    <small><?= $dados['autor'] ?></small>
                                    <small><i class="fa fa-eye"></i> <?=$dados['views']?></small>
                                </div><!-- end meta -->

                                <div class="post-sharing">
                                    <ul class="list-inline">
                                        <li>
                                            <div class="fb-share-button" data-href="http://www.defesacivil.mg.gov.br/dc_agora/index.php" data-layout="button_count" data-size="small">
                                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.sistema.defesacivil.mg.gov.br%2Fdc_agora%2Fpostagem.php%3Fid%3D1142&amp;src=sdkpreparse" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i><span class="down-mobile">Share on Facebook</span></a>&nbsp;
                                            </div>
                                        <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                        <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div><!-- end post-sharing -->
                            </div><!-- end title -->

                            <div class="single-post-media">
                                <img src="/anexo/def_civil_agora/<?=$dados['imagem1']?>" alt="" class="img-fluid" width="700px"; height="700px"; style="max-width: 700px; max-height: 700px; object-fit: cover;">
                            </div><!-- end media -->



                            <hr class="invis1">

                            <div class="custombox authorbox clearfix">
                                <h4 class="small-title">Nota autor</h4>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <img src="/core/imagem/edit_user.png" alt="" class="img-fluid rounded-circle"> 
                                    </div><!-- end col -->

                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <h4><a href="#"><?= $dados['autor'] ?></a></h4>
                                        <p><?= $dados['nota'] ?></p>

                                        <!--<div class="topsocial">
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Website"><i class="fa fa-link"></i></a>
                                        </div><!-- end social -->

                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end author-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">Você pode gostar Disso</h4>
                                
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <a href="postagem.php?id=<?= $aleatorio[0]['id'] ?>" title="">
                                                    <img src="/anexo/def_civil_agora/<?= $aleatorio[0]['imagem1'] ?>" alt="" class="img-fluid" width="364px"; height="364px"; style="max-width: 364px; max-height: 364px; object-fit: cover;">
                                                    <div class="hovereffect">
                                                        <span class=""></span>
                                                    </div><!-- end hover -->
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                                <h4><a href="postagem.php?id=<?= $aleatorio[0]['id'] ?>" title=""><?= (isset($aleatorio[0]['titulo']) ? $aleatorio[0]['titulo'] : substr($aleatorio[0]['texto'], 0, 40)."...") ?></a></h4>
                                                <small><a href="postagem.php?id=<?= $aleatorio[0]['id'] ?>" title=""><?= $aleatorio[0]['categoria'] ?></a></small>
                                                <small><a href="postagem.php?id=<?= $aleatorio[0]['id'] ?>" title=""><?= DataMysql::dataCompletaVisual($aleatorio[0]['data_hora']) ?></a></small>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <a href="postagem.php?id=<?= $aleatorio[1]['id'] ?>" title="">
                                                    <img src="/anexo/def_civil_agora/<?= $aleatorio[1]['imagem1'] ?>" alt="" class="img-fluid" width="364px"; height="364px"; style="max-width: 364px; max-height: 364px; object-fit: cover;">
                                                    <div class="hovereffect">
                                                        <span class=""></span>
                                                    </div><!-- end hover -->
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                                <h4><a href="postagem.php?id=<?= $aleatorio[1]['id'] ?>" title=""><?= (isset($aleatorio[1]['titulo']) ? $aleatorio[1]['titulo'] : substr($aleatorio[1]['texto'], 0, 40)."...") ?></a></h4>
                                                <small><a href="postagem.php?id=<?= $aleatorio[1]['id'] ?>" title=""><?= $aleatorio[1]['categoria'] ?></a></small>
                                                <small><a href="postagem.php?id=<?= $aleatorio[1]['id'] ?>" title=""><?= DataMysql::dataCompletaVisual($aleatorio[1]['data_hora']) ?></a></small>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->

                                </div><!-- end row -->
                            </div><!-- end custom-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">
                                        <?php 
                                            //var_dump($comentarios);
                                           // die();
                                            //if( isset($comentarios) && (count($comentarios > 0)))
                                            //{
                                            //    count($comentarios)."  Comentário(s)";
                                            //}
                                ?>        
                                </h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="comments-list">

                                            <?php
                                            if(is_array($comentarios)) {
                                                foreach ($comentarios as $key => $comentario) {


                                                    print "<div class=\"media\">
                                                    <a class=\"media-left\" href=\"#\">
                                                        <img src=\"/core/imagem/user_icon.png\" alt=\"\" class=\"rounded-circle\">
                                                    </a>
                                                    <div class=\"media-body\">
                                                        <h4 class=\"media-heading user_name\">" . $comentario['nome'] . "<small>" . DataMysql::dataCompletaVisual($comentario['data_coment']) . "</small></h4>
                                                        <p>" . $comentario['texto'] . "</p>
                                                        <!--<a href=\"#\" class=\"btn btn-primary btn-sm\">Responder</a>-->
                                                    </div>
                                                </div>";
                                            }
                                            }
                                            ?>
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end custom-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">Deixe um comentário</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-wrapper" id="frmComentario">
                                            <input type="text" class="form-control" placeholder="Seu nome" name="txt_nome" id="txt_nome">
                                            <input type="text" class="form-control" placeholder="Email" name="txt_email" id="txt_email">
                                            <textarea class="form-control" placeholder="Comentário" name="txt_comentario" id="txt_comentario"></textarea>
                                            <button type="button" class="btn btn-primary" name="btnGravar" id="btnGravar">Enviar comentário</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            <div class="widget">
                                <h2 class="widget-title">Search</h2>
                                <form class="form-inline search-form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Search on the site">
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </form>
                            </div><!-- end widget -->

                            <div class = "widget">
                                <h2 class = "widget-title">Postagens Recentes</h2>
                                <div class = "blog-list-widget">
                                    <div class = "list-group">
<?php
foreach ($post_recente as $key => $value) {
    print "<div class= 'list-group-item list-group-item-action flex-column align-items-start' data-id='".$value['id']."'>
                                            <div class='w-100 justify-content-between'>
                                                <img src = \"/anexo/def_civil_agora/".$value['imagem1']."\" alt ='' class= 'img-fluid float-left'>
                                                <h5 class ='mb-1'>" . substr($value['texto'], 0, 40) . "...</h5>
                                                <small>" . DataMysql::dataCompletaVisual($value['data_hora']) . "</small>
                                            </div>
                                        </div>";
}
?>


                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->

                            <!--<div class="widget">
                                <h2 class="widget-title">Advertising</h2>
                                <div class="banner-spot clearfix">
                                    <div class="banner-img">
                                        <img src="upload/banner_04.jpg" alt="" class="img-fluid">
                                    </div><!-- end banner-img -->
                        </div><!-- end banner 
                    </div><!-- end widget -->


                        <div class="widget">
                            <h2 class="widget-title" id="todos">Categorias</h2>
                            <div class="link-widget">
                                <ul>
<?php
foreach ($categorias as $key => $value) {
    print "<li><a href=\dc_agora\index.php?cat=" . FuncaoBase::slug($value['categoria']) . ">" . ( (strlen($value['categoria']) >= 20) ? substr($value['categoria'], 0, 20)."..." : $value['categoria'] ) . "<span>(" . $value['qtd'] . ")</span></a></li>";
}
?>
                                </ul>
                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                    </div><!-- end sidebar -->
                </div><!-- end col -->
            </div><!-- end row -->
    </div><!-- end container -->
</section>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="widget">
                    <div class="footer-text text-center">
                        <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-right">
                                            <a href="http://www.defesacivil.mg.gov.br"><img width="100" src="http://sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_da_defesacivil_nova_expandida.png" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-left">
                                            <a href="http://www.defesacivil.mg.gov.br"><img width="100" src="http://sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_gabinete_militar_nova.png" alt=""></a>

                                        </div><!-- end logo -->
                                    </div>

                                </div><!-- end row -->
                                <!--<a href="index.html"><img src="images/version/garden-footer-logo.png" alt="" class="img-fluid"></a>-->
                                <p>Defesa Civil do Estado de Minas Gerais <br>Defesa Civil, somos todos nós !</p>
                                <div class="social">
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>              
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                    </div><!-- end footer-text -->
                </div><!-- end widget -->
            </div><!-- end col -->
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <br>
                <br>
                <!--<div class="copyright">&copy; Forest Time. Design: <a href="http://html.design">HTML Design</a>.</div>-->
            </div>
        </div>
    </div><!-- end container -->
</footer><!-- end footer -->

<div class="dmtop">Scroll to Top</div>

</div><!-- end wrapper -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v12.0&appId=939110226455556&autoLogAppEvents=1" nonce="sYGYdogU"></script>

<!-- Core JavaScript
================================================== -->
<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>

<script type="text/javascript">
    

    $(document).ready(function () {
        
     
        
        function view(id) {
                
                var dados = {'opcao' : 'view',
                             'id' : id,
                };
                
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: dados,
                    success: function (response) {
                        console.log(response);
                    }
                });
                
            };

        $("#btnGravar").click(function(){
          var dados = {
                    "txt_nome": $("#txt_nome").val(),
                    "txt_email": $("#txt_email").val(),
                    "txt_comentario": $("#txt_comentario").val(),
                    "id_post" : '<?=$_GET['id'];?>',
                    "opcao" : "comentario",
                };

                $.ajax({
                    type: 'POST',
                    url: '/index.php<?=FuncaoBase::geraLink("cedec", "agora", "gravarComentario") ?>',
                    data: dados,
                    success: function (response) {
                        if(response === "sucesso"){
                            alert("Comentario gravado com Sucesso !");
                            $("#txt_nome").val('');
                            $("#txt_email").val('');
                            $("#txt_comentario").val('');
                            window.location.reload();
                        }

                    }
                            
                });
        });
        
        
        $(".post-media, .list-group-item").hover(function(){  
                $(".post-media").css('cursor', 'pointer'); 
                $(".list-group-item").css('cursor', 'pointer'); 
            });

            /*click contagem de visualizações */
            $(".post-media, .list-group-item").click(function(){
                var id = $(this).data('id');
               window.location = 'postagem.php?id='+id;
               view(id);
            });


    });
</script>

</body>
</html>