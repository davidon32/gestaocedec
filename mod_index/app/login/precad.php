<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/include.php';
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";

    /* tempo sessao */
    $_SESSION["sessiontime"] = time();

	date_default_timezone_set('America/Sao_Paulo');
	
	$_municipio = new Municipio();
	$municipios = $_municipio->dadosSelectMunicipio();

	
	# id arquivo
	$id_arquivo = isset($_GET['id']) ? $_GET['id'] :"";	

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<link href="css/easy-autocomplete.css" rel="stylesheet" media="screen">
<style>
    
    body {
         width: 100%;
         height: 100%;
        
    }
    
    
</style>
</head>

<body>
	<div class="container">

			<!-- Topo-->
			<div class="row-fluid text-center">
			    <br>
				<!--<img src="imagem/topo_gestao.png" alt="Topo" />-->
				<img src="imagem/logo_novo.png" alt="Topo" />
				<hr>
			</div>
			<!-- CONTEUDO -->
			<div class="row-fluid">
									
				<h4><p style="text-align:center;">CADASTRO PARA O PORTAL DE SERVIÇOS DA CEDEC-MG </p></h4>
				<form name="frmAnexo" enctype="multipart/form-data">
				
					<label>Nome do Município</label>
					<input type="text" class="span4" name="txtMunicipio" id="txtMunicipio" title="Digite o nome do municipio" />
					<input type="hidden" name="txtIdMunicipio" id="txtIdMunicipio">
					<label>Nome Usuário</label>
					<input type="text" class="span4" name="txtNome" id="txtNome">
					<label>CPF</label>
					<input type="text" class="span4" name="txtCpf" id="txtCpf" data-mask="999.999.999-99">
					<label>Email <small>(login / recuperação de senha)</small></label>
					<input type="email" class="span4" name="txtEmail" id="txtEmail" />
					<label>Anexar portaria de nomeação do coordenador</p>
		        	<input type="file" name="filePortaria" id="filePortaria" class="span4 btn"/>
					<label>Cargo/Função</label>
					<select class="span4" name="selCargo" id="selCargo">
						<option>Coordenador</option>
						<!-- <option>Membro Equipe</option>
						<option>Outros</option> -->
					</select />
					<p>
						<input class="btn" type="button" name="btnCadastrar" id="btnCadastrar" value="Enviar" title="Enviar dados para Análise de cadastro !">
					</p>
				</form>
			</div>
	</div>
</body>
<script src="/js/jquery-1.11.2.js"></script>
<script src="/js/jquery.easy-autocomplete.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jasny-bootstrap.js"></script>
<script src="/js/funcaobase.js"></script>
<script type="text/javascript">

		// autocomplete
		var itens = {
				data: 
						<?php print json_encode($municipios);?>, // array com os dados
					
					getValue: "nome",
	
						list: {
						match: {
							enabled: true
						},
		
							onSelectItemEvent: function() {
								var value = $("#txtMunicipio").getSelectedItemData().id_municipio;
		
								$("#txtIdMunicipio").val(value);
							}
					}
			};
		
		$("#txtMunicipio").easyAutocomplete(itens);

		/* verifica digito CPF */
	    $("#txtCpf").blur(function(){

	    	var cpf = $("#txtCpf").val();
	    	var result = TestaCPF(cpf);

	    	if(result){
	    		$("#txtCpf").css('background-color', '#66CDAA');
	    		$("#txtCpf").css('color', '#ffffff');
	    		$("#txtCpf").attr('title', 'Cpf Válido !');
	    		
	        }else {
	        	$("#txtCpf").css('background-color', '#FF6347');
	        	$("#txtCpf").attr('title', 'Cpf Inválido !');
	        	$("#txtCpf").css('color', '#ffffff');
	        	$("#txtCpf").val("");
	        }
	    	
	    });

		$("#btnCadastrar").click(function(){
				
			if(($('#txtMunicipio').val() == "") ||
				($('#txtIdMunicipio').val() == "") ||
				($('#txtNome').val() == "") ||
				($('#txtCpf').val() == "")  ||
				($('#txtEmail').val() == "")||
				($('#selCargo').val() == "")
	
					){
						alert("Gentileza preencher os Campos ! ");
				
				}else {
	
					var formData = new FormData($("form[name='frmAnexo']")[0]);
					formData.append('btnCadastrar', $('#btnCadastrar').val());
					formData.append('id_tmp', <?php echo $id_arquivo;?>);
					formData.append('id_municipio', $("#txtIdMunicipio").val());
					formData.append('nomeUsuario', $("#txtNome").val());
					formData.append('cpf', $("#txtCpf").val());
					formData.append('email', $("#txtEmail").val());
					formData.append('cargo', $("#selCargo").val());
					formData.append('opcao', "cadastro");

								if($("#txtIdMunicipio").val() != ""){
					
									$.ajax({
									       url : 'app/login/valida.php',
									       type : 'POST',
									       data : formData,
									       processData: false,  // tell jQuery not to process the data
									       contentType: false,  // tell jQuery not to set contentType
									       success : function(response) {
												var resposta = response;
												if(resposta.search("Registro Duplicado") != -1){
									    	   		alert('Usuário já cadastrado no sistema !\n\n    Documentação existente no cadastro  !');
												}else {
									    	   		alert('Documentação enviada para análise com Sucesso !');
									    	   		window.location = "index2.php";
												}
									    	   //console.log(response);
									       },
									       /* error : function(e) {
									           //alert(data);
									    	   console.log(JSON.stringify(e));
									       } */
									});
									
									$("#filePortaria").val("");
				
								}else {
									alert('Formatos de arquivos permitidos PDF, JPG, JPEG, PNG !' + getExtensao($("#filePortaria").val()));
								}
	
								
							}

		});
	    
</script>
</html>

<?php

	//var_dump($_POST);

?>
	