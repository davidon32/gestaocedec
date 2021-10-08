<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimplesFull.php";?>
<style>
  #caracter {
     font-size: 10px;
  }

  #img-ajuda {
    display:none;
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
</style>

<body onload="loadImageFile();">
<div class="container">
<div class="mask-loading">
<img src="core/imagem/loading.gif" class="loading">
</div>

  <div class="col-md-12 text-center"><br><br>
    <img src="/core/imagem/defesa_civil_agora.png" width="100px;">
  </div>
  <div class="col-lg10 col-xs-12" id="col1">
  <br>
  <span>Envie suas noticias / informações ou atividades sobre Defesa Civil para CEDEC.</span><br>
  <span>Após avaliação/Aprovação pela CEDEC, seu registro será publicado</span><br><br>

      
    <form action="#" method="POST" name="frmCadastro" id="frmCadastro">

      <label>Autor / Nome</label>
      <input type="text" class="form-control" name="txtAutor" id="txtAutor" placeholder="Coloque o autor ou nome para o registro">
      <br>
      <label>Órgão</label>&nbsp;&nbsp;<span>Opcional</span>
      <input type="text" class="form-control" name="txtOrgao" id="txtOrgao" placeholder="Nome do órgão envolvido.">
      <br>
      <label>Texto </label> <span id="caracter"></span>
      <textarea rows="5" class="form-control" name="txtTexto" id="txtTexto" placeholder="Texto que será publicado">
      </textarea>
      <br>
      <label>Categoria </label>
      <select class="form-control" name="selCategoria" id="selCategoria">
        <option>Selecine uma Categoria</option>
        <option>Ajuda Humanitária</option>
        <option>Treinamento Capacitação</option>
        <option>Diligência</option>
        <option>Mapeamento de Área de Risco</option>
        <option>Reunião</option>
        <option>Reclamação/Denúncia</option>
        <option>Elogios/Sugestões</option>
        <option>Vistoria</option>
        <!--<option>Outros(descrever no texto)</option>-->
      </select><br>
      <label>Imagem </label>&nbsp;&nbsp;<span>(Resolução Máxima 600x600)</span>
      <input type="file" class="form-control" name="txtImagem" id="txtImagem" accept="image/*" onchange="loadImageFile();">
      <input name="hidden_data" id='hidden_data' type="hidden"/>
      <br>
      <button class="btn btn-primary" type="button" name="btnSalvar" id="btnSalvar">Enviar</button>

    </form>
    <br>
    <p style="text-align:center"><button class="btn" onclick="javascript:window.location='http://www.defesacivil.mg.gov.br';">Voltar</button></p>
  </div> 
  <div class="col-lg10 col-xs-6 text-center" style="vertical-align:middle;" id="col2">
    <img id="upload-Preview" width="300">

  </div>
  </div>

  <!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script>

$(document).ready(function(){

      $(".mask-loading").hide();

      var limite = 255;
      $("#caracter").text("(caracteres restantes :" +limite);

      $("#txtTexto").bind('keyup change', function(event){  
        var texto = $("#txtTexto").val();
        var caracter = $("#txtTexto").val().length;
        $("#caracter").text("(caracteres restantes :" +(limite - caracter)+" )");

          if(caracter >= limite ){
            alert("Limite de texto atingido");
            $("#txtTexto").val(texto.substr(0, limite));
            $("#caracter").text("(caracteres restantes : 0)");
          }

    });

    /*######################################################### */

	fileReader.onload = function (event) {
	  var image = new Image();
	  
	  image.onload=function(){

      var canvas=document.createElement("canvas");
	      var context=canvas.getContext("2d");
	      if(image.width >=600){
	      		canvas.width=image.width/3;
	      		canvas.height=image.height/3;
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

	      var dataURL = canvas.toDataURL("image/png");
	      document.getElementById('hidden_data').value = dataURL;
	  }
	  image.src=event.target.result;
	};



 /*###############################################################################*/

 

    /*
     salvar lançamento
    */
    $("#btnSalvar").click(function(event){

      //event.preventDefault();

      
      if(
        ($('#txtAutor').val() == '') ||
        ($('#txtTexto').val() == '')
        )
        
        {
          alert('Preencha os Campos Obrigatórios !');
        }else {
        
          $(".mask-loading").show();

        var form = $("#frmCadastro")[0];
        var dados = new FormData(form);

        var preview = document.getElementById("upload-Preview");
    
        var imageUp = preview.src;

        imageUp = imageUp.replace(/^data:image\/(png|jpg);base64,/, "");

        dados.append("status", "0");
        dados.append("opcao", "cadastro");
        dados.append("dt", "<?=date('Y-m-d H:i:s')?>");
        dados.append("imageData" , imageUp);


        /* envia imagem */
        $.ajax({
              type: 'POST',
              url: 'mod_cedec/View/agora/valida.php?v=<?=md5(VERSAO)?>',
              data: dados,
              processData: false,  // Important!
              contentType: false,
              //contentType: 'application/json; charset=utf-8',
              //dataType: 'json',
              success: function (msg) {
                console.log(msg);
                if(msg == "sucesso"){
                  $(".mask-loading").fadeOut('slow');
                  alert('Registro Lançado com Sucesso ! \n Sua postagem será avaliado por um moderador !');
                  location.reload();
                }
                  
              }
          });

        /*$.ajax({
            url : 'mod_cedec/View/agora/valida.php',
            type : 'POST',
            data: dados,
            enctype: 'multipart/form-data',
            processData: false,  // Important!
            contentType: false,
            cache: false,
            success : function(response) {
                if( response == 'formato'){
                  alert(' inválido por favor insira um arquivo no formato png, jpg, jpeg')
                }else {
                  //alert("Aguarde a analise do seu registro para publicação !")
                  //history.back();
                  //location.reload();
                  console.log(response);
                }

            },
            error : function(response){
                    console.log(JSON.stringify(response));
            }
        });*/
      }
    });

});

var fileReader = new FileReader();
	var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

  var loadImageFile = function () {
	  var uploadImage = document.getElementById("txtImagem");
  
	  //check and retuns the length of uploded file.
	  if (uploadImage.files.length === 0) { 
	    return; 
	  }  
	  //Is Used for validate a valid file.
	  var uploadFile = document.getElementById("txtImagem").files[0];
	  if (!filterType.test(uploadFile.type)) {
	    alert("Please select a valid image."); 
	    return;
	  }
	  fileReader.readAsDataURL(uploadFile);
	};

</script>