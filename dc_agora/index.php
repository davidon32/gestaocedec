<!DOCTYPE html>
<html lang="pt-Br">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Site Metas -->
    <title>Defesa Civil Agora - Versão 1.0</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <!--<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">-->



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

</head>
<body>


    <?php
    //$categoria = isset($_GET['cat']) ? $_GET['cat'] : "";

    require('dados.php');
    ?>

    <div id="wrapper">
        <div class="collapse top-search" id="collapseExample">

            <?= include_once 'search.php'; ?>

        </div><!-- end top-search -->

        <div class="topbar-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="topsocial">
                            <?php include_once('rede_social.php') ?>
                        </div><!-- end social -->
                    </div><!-- end col -->

                    <div class="col-lg-4 hidden-md-down">
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="topsearch text-right">
                            <!--<a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search"></i> Busca</a>-->
                        </div><!-- end search -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end topbar -->

        <div class="header-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 text-right">

                        <a href="http://www.defesacivil.mg.gov.br"><img width="100" src="http://sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_da_defesacivil_nova_expandida.png" alt=""></a>                            

                    </div>
                    <div class="col-6 text-left">

                        <a href="http://www.defesacivil.mg.gov.br"><img width="100" src="http://sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_gabinete_militar_nova.png" alt=""></a>
                        <!-- end logo -->
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
                    <div class="collapse navbar-collapse justify-content-md-center menu_dc" id="Forest" ><!--ForestTimemenu-->
                        <?php include_once('menu.php') ?>
                    </div>
                </nav>
            </div><!-- end container -->
        </header><!-- end header -->

        <section class="section first-section">
            <div class="container-fluid">
                <div class="masonry-blog clearfix">
                    <div class="left-side">
                        <div class="masonry-box post-media" data-id="<?= $ultimas_postagens[0]['id'] ?>">
                            <img src="/anexo/def_civil_agora/<?= $ultimas_postagens[0]['imagem1'] ?>" alt="" class="">
                            <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        <span class="bg-aqua"><?= (strpos($ultimas_postagens[0]['categoria'], "Outros") === 0) ? "Diversos" : $ultimas_postagens[0]['categoria'] ?></span>
                                        <h4 style="color: white;"><?= substr($ultimas_postagens[0]['texto'], 0, 60) ?>...</h4>
                                        <small style="color: white;"><?= $ultimas_postagens[0]['orgao'] ?></small>
                                        <small style="color: white;"><?= date('d/m/Y H:i:s', strtotime($ultimas_postagens[0]['data_hora'])) ?></small>
                                        <!--<small style="color: white;"><?= $ultimas_postagens[0]['autor'] ?></small>-->
                                        <small style="color: white;" title="Visualizações"><i class="fa fa-eye"> <?= $ultimas_postagens[0]['views'] ?></i></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                            </div><!-- end shadow -->
                        </div><!-- end post-media -->
                    </div><!-- end left-side -->

                    <div class="center-side">
                        <div class="masonry-box post-media" data-id="<?= $ultimas_postagens[1]['id'] ?>">
                            <img src="/anexo/def_civil_agora/<?= $ultimas_postagens[1]['imagem1'] ?>" width="534" height=""" alt="" class="img-fluid">
                            <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        <span class="bg-aqua"><a href="postagem.php?id=<?= $ultimas_postagens[1]['id'] ?>" title=""><?= (strpos($ultimas_postagens[1]['categoria'], "Outros") === 0) ? "Diversos" : $ultimas_postagens[1]['categoria'] ?></a></span>
                                        <h4 style="color: white;"><?= substr($ultimas_postagens[1]['texto'], 0, 60) ?>...</h4>
                                        <small style="color: white;"><?= $ultimas_postagens[1]['orgao'] ?></small>
                                        <small style="color: white;"><?= date('d/m/Y H:i:s', strtotime($ultimas_postagens[1]['data_hora'])) ?></small>
                                        <!--<small style="color: white;"><?= $ultimas_postagens[1]['autor'] ?></small>-->
                                        <small style="color: white;" title="Visualizações"><i class="fa fa-eye"> <?= $ultimas_postagens[1]['views'] ?></i></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                            </div><!-- end shadow -->
                        </div><!-- end post-media -->
                    </div><!-- end left-side -->

                    <div class="right-side hidden-md-down">
                        <div class="masonry-box post-media" data-id="<?= $ultimas_postagens[2]['id'] ?>">
                            <img src="/anexo/def_civil_agora/<?= $ultimas_postagens[2]['imagem1'] ?>" width="534" height="468"" alt="" class="img-fluid">
                            <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        <span class="bg-aqua"><a href="postagem.php?id=<?= $ultimas_postagens[2]['id'] ?>" title=""><?= (strpos($ultimas_postagens[2]['categoria'], "Outros") === 0) ? "Diversos" : $ultimas_postagens[2]['categoria'] ?></a></span>
                                        <h4 style="color: white;"><?= substr($ultimas_postagens[2]['texto'], 0, 60) ?>...</h4>
                                        <small style="color: white;"><?= $ultimas_postagens[2]['orgao'] ?></small>
                                        <small style="color: white;"><?= date('d/m/Y H:i:s', strtotime($ultimas_postagens[2]['data_hora'])) ?></small>
                                        <!--<small style="color: white;"><?= $ultimas_postagens[2]['autor'] ?></small>-->
                                        <small style="color: white;" title="Visualizações"><i class="fa fa-eye"> <?= $ultimas_postagens[2]['views'] ?></i></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                            </div><!-- end shadow -->
                        </div><!-- end post-media -->
                    </div><!-- end right-side -->
                </div><!-- end masonry -->
            </div>
        </section>

        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">

                            <?php
//var_dump($paginacao->dados);
                            foreach ($paginacao->dados as $value) {



                                print "<div class=\"blog-list clearfix\">";
                                print "<div class=\"blog-box row\">";
                                print "<div class=\"col-md-4\">";
                                print "<div class=\"post-media\" data-id=\"" . $value['id'] . "\">";
                                print "<a href=\"postagem.php?id=" . $value['id'] . "\" title=\"\">";
                                print "<img src=\"/anexo/def_civil_agora/" . $value['imagem1'] . "\" alt=\"\" class=\"img-fluid\" width=\"255px\"; height=\"255px\"; style=\"max-width: 255px; max-height: 255px; object-fit: cover;\">";
                                print "<div class=\"hovereffect\"></div>";
                                print "</a>";
                                print "</div><!-- end media -->";
                                print "</div><!-- end col -->";

                                print "<div class=\"blog-meta big-meta col-md-8\">";
                                print "<span class=\"bg-aqua\">" . $value['categoria'] . "</span>";
                                print "<h4><a href=\"postagem.php?id=" . $value['id'] . "\" title=\"\">" . (isset($value['titulo']) ? $value['titulo'] : substr($value['texto'], 0, 40) . "...") . "</a></h4>";
                                print "<p>" . substr($value['texto'], 0, 200) . " <span>Leia mais...</span></p>";
                                print "<small><a href=\"\" title=\"\"><i class=\"fa fa-eye\"></i> " . $value['views'] . "</a></small>";
                                print "<small><a href=\"postagem.php?id=" . $value['id'] . "\" title=\"\">" . $value['orgao'] . "</a></small>";
                                print "<small><a href=\"postagem.php?id=" . $value['id'] . "\" title=\"\">" . DataMysql::dataExtensoDocumento(DataMysql::dataVisual($value['data_hora'])) . "</a></small>";
                                /* print "<small>" . $value['autor'] . "</small>"; */
                                print "</div><!-- end meta -->";
                                print "</div><!-- end blog-box -->";

                                print "<hr class=\"invis\">";

                                print "</div><!-- end blog-list -->";
                            }
                            ?>
                        </div><!-- end page-wrapper -->

                        <hr class="invis">

                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-start">
                                        <?php
                                        print $paginacao->rodape;

// print "<li class=\"page-item\"><a class=\"page-link\" href=\"" . FuncaoBase::geraLink('ajuda', 'entrada_nota', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
                                        ?>

                                    </ul>
                                </nav>
                            </div><!--end col -->
                        </div><!--end row -->
                    </div><!--end col -->

                    <div class = "col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class = "sidebar">
                            <div class = "widget">
                                <h2 class = "widget-title">Busca</h2>
                                <form class = "form-inline search-form">
                                    <div class = "form-group">
                                        <input type = "text" class = "form-control" placeholder = "Buscar postagens">
                                    </div>
                                    <button type = "submit" class = "btn btn-primary"><i class = "fa fa-search"></i></button>
                                </form>
                            </div><!--end widget -->

                            <div class = "widget">
                                <h2 class = "widget-title">Postagens </h2>
                                <div class = "blog-list-widget">
                                    <div class = "list-group">
                                        <?php
                                        foreach ($post_recente as $key => $value) {
                                            print "<div class= 'list-group-item list-group-item-action flex-column align-items-start' data-id='" . $value['id'] . "'>
                                            <div class='w-100 justify-content-between'>
                                                <img src = \"/anexo/def_civil_agora/" . $value['imagem1'] . "\" alt ='' class= 'img-fluid float-left' width='55px'; height='55px'; style='max-width: 55px; max-height: 55px; object-fit: cover;'>
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
                            <!--</div><!-- end banner -->
                            <!--</div><!-- end widget -->

                            <!--<div class="widget">
                                <h2 class="widget-title">Instagram Feed</h2>
                                <div class="instagram-wrapper clearfix">
                                    <a href="#"><img src="upload/garden_sq_01.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/garden_sq_02.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/garden_sq_03.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/garden_sq_04.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/garden_sq_05.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/garden_sq_06.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/garden_sq_07.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/garden_sq_08.jpg" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="upload/garden_sq_09.jpg" alt="" class="img-fluid"></a>
                                </div><!-- end Instagram wrapper -->
                            <!--</div><!-- end widget -->

                            <div class="widget">
                                <h2 class="widget-title" id="todos">Categorias</h2>
                                <div class="link-widget">
                                    <ul>
                                        <?php
                                                                                var_dump($categorias);
                                        foreach ($categorias as $key => $value) {
                                            print "<li><a href=\"index.php?cat=" . FuncaoBase::slug($value['categoria']) . "\">" . $value['categoria'] . "<span>(" . $value['qtd'] . ")</span></a></li>";
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="widget">
                            <div class="footer-text text-center">
                                <div class="container-fluid">
                                    <div class="row">

                                        <div class="col-6 text-right ">
                                            <a href="garden-index.html"><img width="100" src="http://sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_da_defesacivil_nova_s_fundo.png" alt=""></a>
                                        </div>


                                        <div class="col-6 text-left">
                                            <a href="garden-index.html"><img width="100" src="http://sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_gabinete_militar_nova_sem_fundo.png" alt=""></a>

                                        </div><!-- end logo -->


                                    </div><!-- end row -->
                                </div>
                                <!--<a href="index.html"><img src="images/version/garden-footer-logo.png" alt="" class="img-fluid"></a>-->
                                <p>Defesa Civil do Estado de Minas Gerais <br>Defesa Civil, somos todos nós !</p>
                                <div class="social">
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>              
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>

<!--<a href="#" data-toggle="tooltip" data-placement="bottom" title="Google Plus"><i class="fa fa-google-plus"></i></a>
<a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>-->
                                </div>

                                <hr class="invis">

                                <div class="newsletter-widget text-center">
                                    <form class="form-inline">
                                        <!--<input type="text" class="form-control" placeholder="Enter your email address">
                                        <button type="submit" class="btn btn-primary">Subscribe <i class="fa fa-envelope-open-o"></i></button>-->
                                    </form>
                                </div><!-- end newsletter -->
                            </div><!-- end footer-text -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <!--<div class="copyright">&copy; Forest Time. Design: <a href="http://html.design">HTML Design</a>.</div>-->
                    </div>
                </div>
            </div><!-- end container -->
        </footer><!-- end footer -->

        <div class="dmtop">Scroll to Top</div>

    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            
            var resWidth = window.innerWidth;
            var resHeight = window.innerHeight;
            
            //alert(resWidth+"-"+resHeight);
            
            if(( resWidth >"780" && resWidth <= "1300") && (resHeight > "412" && resHeight <= "635") ){
              $(".topbar-section").hide(); 
              $(".header-section").css('padding', 0); 
              $("div.menu_dc").remove(); 
              
            }
            

            function view(id) {

                var dados = {'opcao': 'view',
                    'id': id,
                };

                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: dados,
                    success: function (response) {
                        console.log(response);
                    }
                });

            }
            ;

            $("#frmBusca").keydown(function (e) {
                if (e.keyCode == 13) {
                    var dados = {
                        "termo": $("#termo").val(),
                        "opcao": "busca",
                    };

                    $.ajax({
                        type: 'GET',
                        url: 'index.php',
                        data: dados,
                        success: function (response) {

                        }
                    });
                }

            });


            $(".post-media, .list-group-item").hover(function () {
                $(".post-media").css('cursor', 'pointer');
                $(".list-group-item").css('cursor', 'pointer');
            });

            /*click contagem de visualizações */
            $(".post-media, .list-group-item").click(function () {
                var id = $(this).data('id');
                window.location = 'postagem.php?id=' + id;
                view(id);
            });

        });

        Redirect();
        function Redirect()
        {
            setTimeout("location.reload(true);", 300000);

        }

    </script>

</body>
</html>