<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<!--<div class="control-sidebar-bg"></div>-->
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="template/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="template/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="template/dist/js/demo.js"></script>

<!-- plugins pmda -->
<!--<script src="js/jquery-ui.js"></script>-->
<!--<script src="js/jasny-bootstrap_bs3.js"></script>-->
<script src="js/jquery.easy-autocomplete.js"></script>
<script src="js/lib/thickbox.js"></script>
<script src="js/funcaobase.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/jquery.mask.js"></script>
<script src="/js/chartjs/Chart.js"></script>
<script src="js/pmda.js"></script>
<script src="plugins/image-upload/resize.js"></script>
<script src="/js/knockout-min.js"></script>
<script src="/plugins/jqueryValidation/jquery.validate.min.js"></script>
<script src="/plugins/jqueryValidation/additional-methods.min.js"></script>
<script src="/js/script.js"></script>

<!-- icone ajuda -->
<div id="div-icon" class="imprimir">
    <div class="close">x</div>
    <a href="index.php?modulo=doc&controller=doc&action=index">
        <img src="/core/imagem/cedec_help.png" id="img-ajuda">
    </a>
</div>

<!-- barra debug --> 
<div id="posiciona"> 
    <div id="fechar" align=right><a href="#">Fechar</a></div> 
    Modulo : <i><?= $_GET['modulo'] ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Controller : <i><?= $_GET['controller'] ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Action : <i><?= $_GET['action'] ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Url : <i><?= substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "&")); ?></i>
    &nbsp;&nbsp;&nbsp;&nbsp;<a href='<?= FuncaoBase::geraLink("cedec", "index", "vars")?>'>Vars</a>
    
</div>

<script>
    $(document).ready(function () {
        
        /* barra debug */
        var url = window.location.host;
        var host = url.indexOf('desenvolvimento.projetos');
        if (host === 0) {
            $("#posiciona").show();
        } else {
            $("#posiciona").hide();
        }


        $("#fechar").click(function () {
            $("#posiciona").css('display', 'none');
        });


        var action = getUrlVars()['action'];

        if (action != 'index') {
            //$("div").removeClass('content-wrapper');
            $(".main-sidebar").hide();
            $(".navbar").css('margin', '0');
            $(".main-footer").css('margin', '0');
            $(".content-wrapper").css('margin', '0');
            $('a.logo').hide();
        }

        $("input[name^='val_'").mask("#.##0,00", {reverse: true});

        $("input[name^='cep'").mask("99999-999");

        $("input[name^='tel'").mask("(99)9999-9999");
        $("input[name^='cel'").mask("(99)99999-9999");

        $("input[name^='data_'").datepicker({dateFormat: 'dd/mm/yy',
            orientation: "bottom left",
            beforeShow: function () { /* problema datapicker atras controle input*/
                setTimeout(function () {
                    $('.ui-datepicker').css('z-index', 99999999999999);
                }, 0);
            }
        }, );


        $('.close').click(function (event) {
            $('#div-icon').fadeOut();
            event.preventDefault();
        });


        $('.sidebar-menu').tree();

        $('#myTabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })

        /* encolher barra ferramenta */
        var largura = $(window).width();
        var altura = $(window).height();

        var os = navigator.userAgent;

        if ((largura <= 1024) && (altura <= 768)) {
            $("#menuLateral").addClass("sidebar-collapse");
            $(".content-header").hide();
            $(".messages-menu").hide();
            $(".notifications-menu").hide();
            $(".tasks-menu").hide();
            $(".box-title").hide();
            $(".box-header").css('padding', '0');
            $(".content").css('padding', '0');
        }

        if ((largura <= 800) && (altura <= 600) && (os.indexOf("Android") == -1)) {
            Swal.fire(
                    'Resolução mínima recomendada é : 1024 x768 ',
                    'seu computador não está com a resolução de vídeo correta, é Aconselhado mudar a resolução do seu computador',
                    'error');
        }



        $('input[type="text"]:not([type="email"]),textarea').blur(function () {
            $(this).val($(this).val().toUpperCase());
        });

        $('input[type="email"]').blur(function () {
            $(this).val($(this).val().toLowerCase());
        });

        $('input[type="text"]:not([name^="val"]):not([name*="DtInici"]):not([name*="DtFinal"]):not([name*="txtAliquota"]),textarea').blur(function () {
            function retira_acentos(palavra) {
                var string = palavra;
                var mapaAcentosHex = {
                    a: /[\xE0-\xE6]/g,
                    A: /[\xC0-\xC6]/g,
                    e: /[\xE8-\xEB]/g,
                    E: /[\xC8-\xCB]/g,
                    i: /[\xEC-\xEF]/g,
                    I: /[\xCC-\xCF]/g,
                    o: /[\xF2-\xF6]/g,
                    O: /[\xD2-\xD6]/g,
                    u: /[\xF9-\xFC]/g,
                    U: /[\xD9-\xDC]/g,
                    c: /\xE7/g,
                    C: /\xC7/g,
                    n: /\xF1/g,
                    N: /\xD1/g,
                };

                for (var letra in mapaAcentosHex) {
                    var expressaoRegular = mapaAcentosHex[letra];
                    string = string.replace(expressaoRegular, letra);
                }



                string = string.replace(/[\'\"\|,\^\~\?\=\´]/ig, "");

                string = string.replace(/[\/\\]/ig, "-");
               
                
                return string;
            }

            var nomeCampo = $(this).attr("name");
            /* nao normaliza campos com nome val_ (monetario )*/
            if (nomeCampo.indexOf("val_") !== 0) {
                $(this).val(retira_acentos($(this).val()));
            }



        });



    });
</script>
</body>
</html>