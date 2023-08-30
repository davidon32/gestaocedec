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
<script src="template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!--<script src="template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
<!-- SlimScroll -->
<script src="template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="template/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="template/dist/js/demo.js"></script>
<script src="template/bower_components/fastclick/lib/fastclick.js"></script>

<!-- plugins pmda -->
<!--<script src="js/jquery-ui.js"></script>-->
<!--<script src="js/jasny-bootstrap_bs3.js"></script>-->
<script src="js/jquery.easy-autocomplete.js"></script>
<script src="js/lib/thickbox.js"></script>
<script src="js/funcaobase.js?v=<?=md5(VERSAO);?>"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/jquery.mask.js"></script>
<script src="/js/chartjs/Chart.js"></script>
<script src="js/pmda.js"></script>
<script src="plugins/image-upload/resize.js"></script>
<script src="/js/knockout-min.js"></script>
<script src="/plugins/jqueryValidation/jquery.validate.min.js"></script>
<script src="/plugins/jqueryValidation/additional-methods.min.js"></script>
<script src="/js/script.js?v=<?=md5(VERSAO);?>"></script>
<script src="/plugins/datetimepicker/jquery.datetimepicker.full.js"></script>
<?php
    include_once('ajuda_php.php');
?>


<!-- barra debug --> 
<!--<div id="posiciona"> 
    <div id="fechar" align=right><a href="#">Fechar</a></div> 
    Modulo : <i><?= $_GET['modulo'] ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Controller : <i><?= $_GET['controller'] ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Action : <i><?= $_GET['action'] ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Url : <i><?= substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "&")); ?></i>
    &nbsp;&nbsp;&nbsp;&nbsp;<a href='<?= FuncaoBase::geraLink("cedec", "index", "vars")?>'>Vars</a>
    <br>
   
<?php 
$modulo = $_GET['modulo'];
$controller = $_GET['controller'];
$action = $_GET['action'];
echo htmlspecialchars("<a href='<?=FuncaoBase::geraLink('$modulo', '$controller', '$action')?>'>Home</a>");

    
    ?>
    
</div>-->


<script>
    
    
    $(document).ready(function () {
        
        $(".overlay1").hide();
        
        /* barra debug */
        var url = window.location.host;
        var host = url.indexOf('desenvolvimento.gestaocedec');
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

        /* jquery.mask.js igor escobar*/
        $("input[name^='val_'").mask("000.000.000.000.000,00", {reverse: true});

        $("input[name^='cep'").mask("00000-000");
        
        $("input[name^='tel'").mask("(00) 0000-0000");
        $("input[name^='cel'").mask("(00) 0-0000-0000");
        
        /* Placa */
        var pl_mask =  {
                onKeyPress: function(placa, e, field, options) {
                  var masks = ['AAA 0000', 'AAA 0A00'];
                  var mask = (typeof placa.substr(3,1) == 'string') ? masks[1] : masks[0];
                  $("input[name^='pl_']").mask(mask, options);
                  $("input[name^='placa']").mask(mask, options);
              }};

              $("input[name^='pl_']").mask('AAA-0A00', pl_mask);
              $("input[name^='placa']").mask('AAA-0000', pl_mask);
              
              
              
        /* cpf/ CNPJ */
        var cpf_cnpj =  {
                onKeyPress: function(cpfcnpj, e, field, options) {
                    console.log(cpfcnpj.length);
                  var masks = ['99.999.999/9999-99', '999.999.999-99_'];
                  var mask = (cpfcnpj.length ==14) ? masks[1] : masks[0];
                   console.log(mask);
                  $("input[name^='cpf_cnpj_'").mask(mask, options);
              }};

              $("input[name^='cpf_cnpj_'").mask('99.999.999/9999-99', cpf_cnpj);
              
        /* DATAPICKER */   
        $("input[name^='data_'").datepicker({dateFormat: 'dd/mm/yy',
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dec'],
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
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
            Swal.fire({
            icon: 'error',
            title: 'Resolução mínima recomendada é : 1024 x768 ',
            text: 'seu computador não está com a resolução de vídeo correta, é Aconselhado mudar a resolução do seu computador',
            });
        }



        /* upper case */
        $('input[type="text"]:not([type="email"]):not([type="submit"]):not([name*="notNormaliza"]),textarea:not([name*="notNormaliza"])').blur(function () {
            $(this).val($(this).val().toUpperCase());
        });

        $('input[type="email"]').blur(function () {
            $(this).val($(this).val().toLowerCase());
        });

        $('input[type="text"]:not([name^="val"]):not([name*="DtInici"]):not([name*="DtFinal"]):not([name*="txtAliquota"]):not([name*="notNormaliza"]),textarea:not([name*="notNormaliza"])').blur(function () {
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
            if ( typeof(nomeCampo) !="undefined" && nomeCampo.indexOf("val_") !== 0 ) {
                $(this).val(retira_acentos($(this).val()));
            }



        });



    });
</script>
</body>
</html>