<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimplesFull.php";?>
<style>
  #caracter {
     font-size: 10px;
  }
</style>
<div class="container">

  <div class="col-xs-12 text-center"><br><br>
    <img src="/core/imagem/logo-agua-doce.png" width="100px;">
  </div>
  <div class="col-lg10 col-xs-6">
  <br>
  <span>Envie suas noticias / informações ou atividades sobre o Projeto Agua Doce.</span><br>
  <span>Após avaliação/Aprovação pelo Técnico, seu registro será publicado.</span><br><br>

      
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
        <option>Cidadão</option>
        <option>Outros Órgãos</option>
      </select><br>
      <label>Imagem </label>&nbsp;&nbsp;<span>(Resolução Máxima 600x600)</span>
      <input type="file" class="form-control" name="txtImagem" id="txtImagem">
      <br>
      <button class="btn btn-primary" type="button" name="btnSalvar" id="btnSalvar">Enviar</button>

    </form>
    <br>
    <p style="text-align:center"><button class="btn" onclick="javascript:window.location='http://www.defesacivil.mg.gov.br';">Voltar</button></p>
  </div> 
</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script>

$(document).ready(function(){
      var limite = 255;
      $("#caracter").text("(caracteres restantes :" +limite);

    $("#txtTexto").keypress(function(event){  
      var caracter = $("#txtTexto").val().length;
      var texto = $("#txtTexto").val();
      $("#caracter").text("(caracteres restantes :" +(limite - caracter)+" )");
      //alert(caracter);

      if((caracter) == 255 ){
        $("#txtTexto").text(texto.substr(0, limite));
        alert("Limite de texto atingido");
      }

    });
    
    /*
     salvar lançamento
    */
    $("#btnSalvar").click(function(event){

      event.preventDefault();

      if(
          ($('#txtAutor').val() == '') ||
          ($('#txtTexto').val() == '')
          )

      {
          alert('Preencha os Campos Obrigatórios !');
      }else {

        var form = $("#frmCadastro")[0];
        var dados = new FormData(form);
        dados.append("status", "0");
        dados.append("opcao", "cadastro");
        dados.append("dt", "<?=date('Y-m-d H:i:s')?>");

        $.ajax({
            url : 'mod_cedec/View/aguadoce/valida.php',
            type : 'POST',
            data: dados,
            enctype: 'multipart/form-data',
            processData: false,  // Important!
            contentType: false,
            cache: false,
            success : function(response) {
                //alert(response);
                alert("Aguarde a analise do seu registro para publicação !")
                //history.back();
                location.reload();

            },
            error : function(response){
                    console.log(JSON.stringify(response));
            }
        });
      }
    });

});

</script>