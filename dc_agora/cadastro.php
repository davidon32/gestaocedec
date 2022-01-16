<!DOCTYPE html>
<html lang="pt-br">

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

    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="/dc_agora/css/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="/dc_agora/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/dc_agora/style.css" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="/dc_agora/css/responsive.css" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="/dc_agora/css/colors.css" rel="stylesheet">

    <!-- Version Garden CSS for this template -->
    <link href="/dc_agora/css/version/garden.css" rel="stylesheet">

    <style>
        select:invalid { 
            color: gray ;
        }
        .loading {
            width: 300px;
            height: 300px;
            position: absolute;
            top: 70%;
            left: 6%;
            /*color: blue;*/
        }

        .mask-loading {
            position: absolute;
            top: 40px;
            left: 0px;
            z-index: 1000;
            background-color: #000;
            opacity: 0.5;
            width: 100%;
            height: 100%;
        } 
        
        #upload-Preview{
         max-width: 500px;   
        }
        
                       
    </style>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div id="wrapper">
        <div class="collapse top-search" id="collapseExample">
            <div class="card card-block">
                <div class="newsletter-widget text-center">
                    <form class="form-inline" >
                        <input type="text" class="form-control" placeholder="What you are looking for?">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end top-search -->

        <div class="topbar-section">
            <div class="mask-loading">
                <img src="core/imagem/loading.gif" class="loading" alt="">
            </div>
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
                            <a href="http://www.defesacivil.mg.gov.br"><img width="100" src="http://sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_da_defesacivil_nova_expandida.png" alt=""></a>                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left">
                            <a href="http://www.defesacivil.mg.gov.br"><img width="100" src="http://sistema.defesacivil.mg.gov.br/logo/imagens/logomarca_gabinete_militar_nova.png" alt=""></a>
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
                        <?php include_once('dc_agora/menu.php') ?>
                    </div>
                </nav>
            </div><!-- end container -->
        </header><!-- end header -->

        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="page-wrapper">

                            <hr class="invis">

                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form class="form-wrapper" method="post" enctype="multipart/form-data">
                                        <input type="text" name="txt_nome" id="txt_nome"  class="form-control" placeholder="Seu nome" title="Nome do autor" maxlength="69">
                                        <input type="text" name="txt_titulo" id="txt_titulo"  class="form-control" placeholder="Titulo da postagem ( opcional )"  title="Titulo da postagem ( opcional )" maxlength="149">
                                        <input type="text" name="txt_orgao" id="txt_orgao"  class="form-control" placeholder="Órgão ( Opcional )" title="Órgão referente a postagem ( opcional )">
                                        <input type="text" name="txt_nota" id="txt_nota"  class="form-control" placeholder="Nota do autor ( opcional )" title="Nota do autor ref. a postagem" maxlength="149">
                                        <select name="sel_categoria" id="sel_categoria" class="form-control" style="color: gray ;" title="Nota do autor ref. a postagem" maxlength="149">
                                            <option>Selecione uma Categoria</option>
                                            <option>CEDEC-MG</option>
                                            <option>Outros(descrever no texto)</option>
                                            <option>Reunião</option>
                                            <option>Diligência</option>
                                            <option>Ajuda Humanitária</option>
                                            <option>Vistoria/Fiscalização</option>
                                            <option>Treinamento Capacitação</option>
                                            <option>Elogios/Sugestões</option>
                                            <option>Mapeamento de Área de Risco</option>
                                            <option>Programa Agua Doce</option>
                                        </select>
                                        <textarea name="txt_texto" id="txt_texto"  class="form-control" placeholder="Texto" title="Texto da Postagem" maxlength="254"></textarea>
                                        <input name="fl_image" id="fl_image" onchange="loadImageFile()" accept="image/jpg,image/jpeg" type="file" class="form-control" placeholder="Imagem ( opcional )" title="Imagem para a postagem ( opcional )" >
                                        <button name="btn_enviar" id="btn_enviar" type="button" class="btn btn-primary">Enviar</button>
                                        <button name="btn_voltar" id="btn_voltar" type="button" onclick='history.back();' class="btn btn-success">Voltar</button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->
                    <div class="col-md-12 text-center ">
                        <br>
                        <img id="upload-Preview" name="imgFormat" > 
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="widget">
                            <div class="footer-text text-center">
                                <a href="index.html"><img src="images/version/garden-footer-logo.png" alt="" class="img-fluid"></a>
                                <p>Gabinete Militar do Estado de Minas Gerais e Coordenadoria Estadual de Defesa Civil de Minas Gerais.</p>
                                <div class="social">
                                    <a href="https://www.facebook.com/defesacivilmg/" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>              
                                    <a href="https://www.youtube.com/c/DefesaCivildeMinasGerais/videos" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                                    <a href="https://www.twitter.com/defesacivil_mg" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/defesacivil_mg" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                                </div>

                                <hr class="invis">

                                <!--<div class="newsletter-widget text-center">
                                    <form class="form-inline">
                                        <input type="text" class="form-control" placeholder="Enter your email address">
                                        <button type="submit" class="btn btn-primary">Subscribe <i class="fa fa-envelope-open-o"></i></button>
                                    </form>
                                </div><!-- end newsletter -->
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

    <!-- Core JavaScript
    ================================================== -->
    <script src="/dc_agora/js/jquery.min.js"></script>
    <script src="/dc_agora/js/tether.min.js"></script>
    <script src="/dc_agora/js/bootstrap.min.js"></script>
    <script src="/dc_agora/js/custom.js"></script>

    <script type="text/javascript">
                                            $(document).ready(function () {
                                                
                                                $(".mask-loading").hide();

                                                $("#btn_enviar").click(function () {

                                                    if (
                                                            ($("#txt_nome").val() == '') ||
                                                            ($('#txt_nome').val() == '') ||
                                                            ($('#txt_titulo').val() == '') ||
                                                            ($('#txt_orgao').val() == '') ||
                                                            ($('#txt_nota').val() == '') ||
                                                            ($('#categoria').val() == 'Selecione uma Categoria') ||
                                                            (typeof $("#fl_image")[0].files[0] === "undefined")
                                                            ) {
                                                        alert('Preencha os Campos Obrigatórios !');
                                                    } else {

                                                        $(".mask-loading").show();
                                                        var preview = document.getElementById("upload-Preview");
                                                        var imageUp = preview.src;
                                                        imageUp = imageUp.replace(/^data:image\/(png|jpg);base64,/, "");
                                                        var form_data = new FormData();
                                                        form_data.append('file', $("#fl_image").prop("files")[0]);
                                                        form_data.append('nome', $("#txt_nome").val());
                                                        form_data.append('titulo', $("#txt_titulo").val());
                                                        form_data.append('orgao', $("#txt_orgao").val())
                                                        form_data.append('nota', $("#txt_nota").val());
                                                        form_data.append('categoria', $("#sel_categoria").val());
                                                        form_data.append('opcao', "cadastro");
                                                        form_data.append("imageData", imageUp);
                                                        form_data.append("texto", $("#txt_texto").val());
                                                        form_data.append("data_hora", '<?=date('Y-m-d H:i:s');?>');
                                                        form_data.append("status1 ", 0);
                                                        
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'index.php?modulo=cedec&controller=agora&action=postagem',
                                                            dataType: 'text',
                                                            contentType: false,
                                                            processData: false,
                                                            data: form_data,
                                                            success: function (response) {
                                                                //console.log(response)
                                                                $(".mask-loading").fadeOut('slow');
                                                                alert('Registro Lançado com Sucesso ! \n Sua postagem será avaliado por um moderador !');
                                                                location.reload();
                                                            }
                                                        });
                                                    }


                                                    $(".mask-loading").hide();
                                                    $("#btnSalvar").attr("disabled", true);
                                                    var limite = 254;
                                                    $("#caracter").text("(caracteres restantes :" + limite);
                                                    $("#txtTexto").bind('keyup change', function (event) {
                                                        var texto = $("#txtTexto").val();
                                                        var caracter = $("#txtTexto").val().length;
                                                        $("#caracter").text("(caracteres restantes :" + (limite - caracter) + " )");
                                                        if (caracter >= limite) {
                                                            alert("Limite de texto atingido");
                                                            $("#txtTexto").val(texto.substr(0, limite));
                                                            $("#caracter").text("(caracteres restantes : 0)");
                                                        }

                                                    });
                                                    /*######################################################### */
                                                });
                                            });
                                            /*###############################################################################*/


                                            var fileReader = new FileReader();
                                            
                                            fileReader.onload = function (event) {
                                                        var image = new Image();
                                                        image.onload = function () {

                                                            var canvas = document.createElement("canvas");
                                                            var context = canvas.getContext("2d");
                                                            if (image.width >= 600) {
                                                                canvas.width = image.width / 3;
                                                                canvas.height = image.height / 3;
                                                            }

                                                            context.drawImage(image,
                                                                    0,
                                                                    0,
                                                                    image.width,
                                                                    image.height,
                                                                    0,
                                                                    0,
                                                                    canvas.width,
                                                                    canvas.height
                                                                    );
                                                            document.getElementById("upload-Preview").src = canvas.toDataURL();
                                                            var dataURL = canvas.toDataURL();
                                                            
                                                            //document.getElementById('hidden_data').value = dataURL;
                                                        };
                                                        image.src = event.target.result;
                                                    };

                                            
                                            var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
                                            var loadImageFile = function () {
                                                var uploadImage = document.getElementById("fl_image");
                                                //check and retuns the length of uploded file.
                                                if (uploadImage.files.length === 0) {
                                                    return;
                                                }
                                                //Is Used for validate a valid file.
                                                var uploadFile = document.getElementById("fl_image").files[0];
                                                if (!filterType.test(uploadFile.type)) {
                                                    alert("Please select a valid image.");
                                                    return;
                                                }
                                                fileReader.readAsDataURL(uploadFile);
                                                $("#btnSalvar").attr("disabled", false);
                                            };

    </script>

</body>
</html>