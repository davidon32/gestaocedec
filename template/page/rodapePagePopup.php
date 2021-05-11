  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
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
<script src="js/sweetalert2.all.min.js"></script>

<!-- icone ajuda -->
<div id="div-icon" class="imprimir">
		<a href="index.php?modulo=doc&controller=doc&action=index">
      <img src="/core/imagem/cedec_help.png" id="img-ajuda">
    </a>
	</div>

<script>
  $(document).ready(function () {
    
  $('input[type="text"],textarea').blur(function(){
    $(this).val($(this).val().toUpperCase());
  });

  $('input[type="text"],textarea').blur(function(){
        function retira_acentos(palavra) {
          var string = palavra;
          var mapaAcentosHex = {
                a : /[\xE0-\xE6]/g,
                A : /[\xC0-\xC6]/g,
                e : /[\xE8-\xEB]/g,
                E : /[\xC8-\xCB]/g,
                i : /[\xEC-\xEF]/g,
                I : /[\xCC-\xCF]/g,
                o : /[\xF2-\xF6]/g,
                O : /[\xD2-\xD6]/g,
                u : /[\xF9-\xFC]/g,
                U : /[\xD9-\xDC]/g,
                c : /\xE7/g,
                C : /\xC7/g,
                n : /\xF1/g,
                N : /\xD1/g,
                };

                for ( var letra in mapaAcentosHex ) {
                  var expressaoRegular = mapaAcentosHex[letra];
                  string = string.replace( expressaoRegular, letra );
                }

                string = string.replace(/[\'\"\/\\\|,\.\^\~\?\=\´]/ig, "");

          return string;
        }

        $(this).val(retira_acentos($(this).val()));

  });
});
</script>
</body>
</html>