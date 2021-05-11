<?php session_start();
    include_once 'include.php';
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";

    /* tempo sessao */
    $_SESSION["sessiontime"] = time();

	date_default_timezone_set('America/Sao_Paulo');
	
	//$_conexao = new ConexaoMysql();

	$_login = new Login();

	$_login->VerificaBrowser();
	

?>
<!-- 

        LOGIN DE ACESSO EXTERNO

 -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
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
			<!--<img src="imagem/topo_compdec.png" alt="Topo" />-->
			<img src="imagem/logo_compdec.png" alt="Topo" width="160px;" />
			<h3>Acesso Restrito COMPDEC</h3>
			<hr>
		</div>
	
		<!-- CONTEUDO -->
		<div class="row-fluid">
			<div class="">
				<div class="span4"></div>
				<div class="span4">
					<br /><br />
					<form id="form1" name="form1" method="POST" action="?secao=login&acao=ex">

                        <table align='center'>
                            <tr>
                                <td><img src="imagem/acesso40x40.png" title="Acesso Restrito" /></td>
                                <td></td>
                            </tr>
							<tr>
							    <td>
							        <label for="login">Login</label>
							        <input name="login" type="text" id="login" size="15" placeholder="Usuário" />
							    </td>
							    <td></td>
							</tr>
							<tr>
							    <td>
							        <label for="senha">Senha</label>
                                    <input type="password" name="senha" id="senha" size="15" placeholder="Senha do Usuário" />
							    </td>
							    <td></td>
							</tr>
							<tr>
							    <!-- <td><label><a href="index.php?secao=login&acao=recsenhaEx"><x-small>Esquecí a Senha</x-small></a></label></td>-->
							    <td>
							    	<label style="text-align:left;">
							    		<a style="float: left;" href="?secao=login&acao=recsenhaEx"><x-small>Esquecí a Senha</x-small></a>
							    	</label>
							    	<label style="text-align:right;">
							    		<a data-toggle="modal" data-target="#myModal"><x-small>Não tenho cadastro</x-small></a>
							    	</label>
							    </td>
							    <td></td>
							</tr>
							<tr>
							     <td align="">
							     	<input class="btn btn-primary" name="enviar" type="submit" value="Entrar" title="Logar no Sistema" />
							     </td>    
							     <td></td>
							</tr>
	
						</table>
					
					</form>
					
	<form name="frmAnexo">
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Solicitação de Senha</h4>
		      </div>
		      <div class="modal-body">
		        <p>Anexar o oficio de solicitação (baixe o modelo, faça o preenchimento e anexe o documento para envio.)</p>
		        <input type="file" name="fileAnexo" id="fileAnexo" class="btn"/><br><br>
		        <p style="text-align:center; text-decoration: none; font-weight: bold;"><a href="?secao=login&acao=download&id=xd45ft6yu" title="clique aqui para Download do documento !">Modelo de Solicitação<img src='imagem/pdf.png'></a></p>
		        <p><b>Obs:</b><br>- Formato PDF<br>- Tamanho máximo 2Mb</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" id="btnEnviar" data-dismiss="modal">Enviar</button>
		      </div>
		    </div>
		
		  </div>
		</div>
	</form>
				</div>
				<div class="span4"></div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="text-center">
				<br /><br /><br /><br /><br /><br />
				<hr>
				<x-small><?php print RODAPE; print Cedec::getVersao(); ?></x-small>

			</div>
		</div>
		<!--corpo-->
	</div>
	<script src="js/jquery-1.12.1.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/funcaobase.js"></script>
	<script src="js/jasny-bootstrap.js"></script>
	<script type="text/javascript">	

	// autocomplete usuario senha
	var currentLocation = window.location;

		if(currentLocation['host'] == 'desenvolvimento.sgecedec.com'){

			$("#login").val('MUNICIPIOTESTE');
			$("#senha").val('portal199');
		}

		// enviar anexo pre-cadastro
		$("#btnEnviar").click(function(){
				    
			// codigo
		if($('#fileAnexo').val() == ""){
					alert("O campo descrição é Obrigatório ! ");
			
			}else {

				var id_tmp = Math.ceil(Math.random()* (9999999999999999 - Math.random()) + 1000);
				var formData = new FormData($("form[name='frmAnexo']")[0]);
				formData.append('btnAddAnexo', $('#btnAddAnexo').val());
				formData.append('id_tmp', id_tmp);
				formData.append('opcao', 'upload');
				
							var extensao = getExtensao($("#fileAnexo").val())  

							if(extensao.toLowerCase() == 'pdf'){
				
								$.ajax({
								       url : 'app/login/valida.php',
								       type : 'POST',
								       data : formData,
								       processData: false,  // tell jQuery not to process the data
								       contentType: false,  // tell jQuery not to set contentType
								       success : function(response) {
								    	   //alert('Documento Anexado com Sucesso !');
								    	   console.log(response);
								       },
								       /* error : function(e) {
								           //alert(data);
								    	   console.log(JSON.stringify(e));
								       } */
								});
								
								$("#fileAnexo").val("");
			
							}else {
								alert('Formatos de arquivos permitidos PDF, JPG, JPEG, PNG !' + getExtensao($("#fileAnexo").val()));
							}

								window.location.href = "/index2.php?acao=precad&id="+id_tmp;
							
						}

					// fim
			      	
		});

		

	</script>
</body>
</html>