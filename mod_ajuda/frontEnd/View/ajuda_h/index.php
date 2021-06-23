<?php include_once 'core/include.php';?>
<?php include_once 'core/Model/indexModel.php';?>
<?php include_once 'mod_compdec/Model/Model.php';?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menuExterno.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php

    $id_municipio = isset($pageSession['session']['seguranca']['id_municipio']) ? $pageSession['session']['seguranca']['id_municipio'] :"";
	
?>	
<div class="col-md-12 text-center">
<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=etn&modulo=index&controller=index&action=menue">Voltar</a>
</div>
<div class="col-md-12">
<br>
<a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro")?>">Novo Pedido</a>
<br><br>
<table class="table table-bordered">
        <tr>
            <th colspan="2">Pedidos Recentes</th>
        </tr>
     <tbody>
        <tr>
            <td>Nr</td>
            <td>Data</td>
            <td>Tipo</td>
            <td>Status</td>
            <td>Ações</td>
            
        </tr>
        <?php
        
            print "<tr>
            <td>Nr</td>
            <td>Data</td>
            <td>Tipo</td>
            <td>A</td>
            <td>Ações</td>
            
        </tr>";
        
        ?>
        
    </tbody>
</table>

</div>

 <!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script>

/* Criar novo plano de contingencia */
(function($) {

	novoPlano = function() {

		if(confirm("Deseja Começar o preenchimento de um novo Plano de Contingência ?")){

			$.ajax({
			url: 'mod_compdec/View/plano/process.php',
			type: 'POST',
			data: {
					identificador : "novoPlano",
					id_municipio: "<?=$id_municipio;?>"
				  },

			success: function (response) {
				console.log(response);
				if(response == "sucesso"){
					window.location.href = "?modulo=compdec&secao=plano&acao=planomenu&id=<?=$id_municipio;?>";

				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown, "-");
			}


			});
	}

	return false;

	}

	})(jQuery);

	/* upload de plano de contingencia */
	(function($) {

		uploadModal = function(){
			$("#myModal").modal('show');
		}

	})(jQuery);


	/* Upload arquivo  */
	$('#btnUpload').on('click', function() {
		
		var file_data = $('#filePlano').prop('files')[0];   
		var versao = $('#selVersao').val();
		var dt = $('#txtData').val();
		var id = $('#txtIdMunicipio').val();

		var form_data = new FormData();                  

		form_data.append('file', file_data);
		form_data.append('identificador', 'upload')
		form_data.append('id', id);
		form_data.append('dt_upload', dt);
		form_data.append('versao', versao);
		//alert(form_data);                             
		$.ajax({
			url: 'mod_compdec/View/plano/process.php', // point to server-side PHP script 
			dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                         
			type: 'post',
			success: function(response){
				alert(response);
				$("#myModal").modal('hide');
				window.location.reload();
			}
		});
	});


	(function($) {
		/* Remover o plano de Contingencia */
		removerPlano = function(id_plano) {

		if(confirm("Deseja realmente deletar este Plano de Contingencia ?\nProcesso sem volta !")){

			$.ajax({
			url: 'mod_compdec/View/plano/process.php',
			type: 'POST',
			data: {
					identificador : "removerPlano",
					id_municipio: "<?=$id_municipio;?>",
					id_plano : id_plano,
				},

			success: function (response) {

				if(response == "sucesso"){
					alert("Plano de Contingencia Deletado com Sucesso !");
					window.location.reload();

				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown, "-");
			}


			});
		}

		return false;

		}

	})(jQuery);

</script>
</body>
</html>
	  	
	