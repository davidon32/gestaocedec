<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<div class="col-lg10 col-xs-12">

<?php

    $id = isset($_GET['id']) ? $_GET['id'] :"";

    $defesaAgora = new DefesaAgora();
    $dados = $defesaAgora->listaId($id);

?>
    <div id="frmLancamento">
        <form method="POST" name="frmAnexoImagem" id="frmAnexoImagem">

            <label>Autor / Nome :</label>
            <input type="text" class="form-control" id="txtAutor" value="<?=$dados[0]['autor'];?>">
            <br>
            <br>
            <label>Texto :</label>
            <textarea class="form-control" id="txtTexto" rows="5"><?=$dados[0]['texto'];?></textarea>
            <br>
            <input type='hidden' id='nomeImagem' value='<?=(is_null($dados[0]['imagem1'])) ? "" :$dados[0]['imagem1'];?>'>

                   <div class="rounded">
                    <?php
                        print "<img width='140px' src='anexo/def_civil_agora/";
                        print (is_null($dados[0]['imagem1'])) ? "sem_imagem.png" : $dados[0]['imagem1'];
                        print "'>";
                        print "&nbsp;<button type='button' class='btn' name='btnDeletar' id='btnDeletar' title='Apagar imagem'>Deletar</button>";
                    ?>
                </div>
            <br>
            <?php 
                if(is_null($dados[0]['imagem1'])){
            ?>
            <label>Imagem :</label>&nbsp;&nbsp;<span>(Resolução Máxima 600x600)</span>
            <input type="file" class="form-control" id="txtImagem" name="txtImagem">
            <?php } ?>
            
            <input type="hidden" name="txtId" id="txtId" value="<?=$id;?>">
            <input type="hidden" name="txtCategoria" id="txtCategoria" value="CEDEC-MG">
            <input type="hidden" name="txtDtHora" id="txtDtHora" value="<?=date('Y-m-d H:i:s');?>">
            <input type="hidden" class="form-control" name="txtOrgao" id="txtOrgao" value="CEDEC-MG">

            <br>
            <a href="index.php?modulo=cedec&controller=agora&action=busca" class="btn btn-primary">Voltar</a>
            <button type="button" class="btn btn-primary" name="btnSalvar" id="btnSalvar" title="Clique para salvar o Registro !">Salvar</button>
        </form>
  </div>
  
  </div>
    <?php
        $defesaAgora = new DefesaAgora();
    ?>
</div> 
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script>

$(document).ready(function(){

    /* salvar registro  */
	$("#btnSalvar").click(function(){

        if($("#txtImagem").val() == "") {
			
            alert("Favor Anexar um arquivo! ");

        }else {

        var formData = new FormData($("form[name='frmAnexoImagem']")[0]);
        formData.append('btnSalvar', $('#btnSalvar').val());
        formData.append('autor', $('#txtAutor').val());
        formData.append('texto', $('#txtTexto').val());
        formData.append('categoria', $('#txtCategoria').val());
        formData.append('data_hora', $('#txtDtHora').val());
        formData.append('orgao', $('#txtOrgao').val());
        formData.append('id', $('#txtId').val());
        formData.append('status', '0');
        formData.append('opcao', 'editar');
        formData.append('nomeImagem', $('#nomeImagem').val());
       
            $.ajax({
                url : 'mod_cedec/View/agora/valida.php',
                type : 'POST',
                data : formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                    success : function(response) {
                        console.log(response);
                            if(response == "erro"){
                                //alert('Erro ao Fazer o UPload do arquivo ! \n Possíveis Causas: \n - Arquivo maior que 2MB (Mega Bytes) \n - Arquivo com nome muito extenso ! \n	para reduzí-ló acesse https://smallpdf.com/pt ');
                            }else{
                                alert('Registro Salvo com Sucesso !');
                                    window.location.href = '?modulo=cedec&controller=agora&action=lista';
                            }      
                    },
                    error : function(e) {
                    }
            });
        }
    });

    /* Deleta imagem */
    $("#btnDeletar").click(function(){
        var result = confirm("Deseja realmente Apagar este registro");

        var dados = {
            "opcao"     : "deletarImagem",
            "id"        : "<?=$id;?>",
            "imagem"    : $("#nomeImagem").val(),
        };

        if(result){

            $.ajax({
            url : 'mod_cedec/View/agora/valida.php',
            type : 'POST',
            data: dados,
            success : function(response) {
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