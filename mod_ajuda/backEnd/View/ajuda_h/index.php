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
    
    $dados = H_pedido_pedidajuda_hModel::lista();
    $pedido_h = new H_pedido_pedidajuda_hModel();
	
?>	
<div class="col-md-12 text-center">
<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&modulo=ajuda&controller=index&action=index">Voltar</a>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-6">
<a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro")?>">Novo Pedido</a>
<a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "index")?>">Pesquisa</a>
</div>
<div class="col-md-6">
    <p class="text-right"> <a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "config_ajuda")?>" title="Cadastro Analistas">Configurações</a></p>
    </div>
</div>
<table class="table table-bordered">
        <tr>
            <th colspan="7">Pedidos Recentes</th>
        </tr>
     <tbody>
        <tr>
            <td>Nr</td>
            <td>Data</td>
            <td>Tipo</td>
            <td>Analista</td>
            <td>Status</td>
            <td>Data Envio Analise</td>
            <td>Ações</td>
            
        </tr>
        <?php
        foreach ($dados as $key => $value){
            
            $cor = $pedido_h->getCorStatus($value['status']);
            print "<tr style='background-color:".$cor."'>
            <td>".$value['numero']."-".substr($value['data_entrada_sistema'], 0, 4)."</td>
            <td>".$value['data_entrada_sistema']."</td>
            <td>". Decreto::getNomeCobrade($value['id_cobrade'])."</td>
            <td>".(($value['despachante_analista'] == "") ? "enviando   " : $value['despachante_analista'])."</td>
            <td>".$pedido_h->enumStatus($value['status'])."</td>
            <td>".$value['data_hora_envio']."</td>
            <td>";
            print "<a href='".FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'edit', array('id'=> $value['id']))."' title='Editar Pedido'><img src='/core/imagem/editar.png'></a>";
            print "<a href='".FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "impressao", array('id'=> $value['id']))."' title='Visualiação e Impressa do Pedido'><img src='/core/imagem/impressao.png'></a> ";
            print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'peido_itens', 'pcont')."' title='Presatação de contas'><img width='25' src='/core/imagem/relatorio.png'></a>";
            print "</td>";
            print "</tr>";
        }
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
	  	
	