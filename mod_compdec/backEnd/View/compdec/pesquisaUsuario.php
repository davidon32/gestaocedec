<?php print "<!DOCTYPE html>";
	include_once PATH.'/include.php';
/**
 * Pesqui de pipeiro para realizar o acerto de contas
 * 01/03/2011
 * @author Demetrio S Passos - demetriosilp@hotmail.com
 * 
 */

$_login = new Login();

$_login->Logado(CAD_ACERTO, $MODULO['mod_pipa']);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    <div class="container">
     <!-- MENU-->
		<div class="row-fluid">
			<div class="span3">
			    <BR>
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
				<div class="row-fluid">
					<div class="span9 fdo_corpo">
						<div class="span12 text-center"><h4>Manutenção de Usuários</h4></div>
						<!-- INICIO DO CORPO-->
						<form action="?modulo=compdec&secao=compdec&acao=pesquisaUsuario" class="form-search" method="post">
						

							<div class="input-group">
								<input type="radio" name="rbFiltro" id="rbMunicipio" value="municipio">Municipio<br>
								<input type="radio" name="rbFiltro" id="rbLogin" value="email">Login/Email
								<br>
								<br>
								<input type="text" name="txtPesquisa" id="txtPesquisa" /><br>
								<br>
								<input type="submit" name="btnPesquisa" id="btnPesquisa" class="btn btn-primary" value="Pesquisar"/>
							</div>
						</form>
						
						<?php
	
                    	   $usuarioEx = new Usuario();
                    	
                    	   $usuario = isset($_POST['txtPesquisa']) ? $_POST['txtPesquisa'] : "";
                    	   $btn = isset($_POST['btnPesquisa']) ? $_POST['btnPesquisa'] : "";
                    	   $filtro = isset($_POST['rbFiltro']) ? $_POST['rbFiltro'] :"";
                    	   
                    	   if($btn == 'Pesquisar' && !empty($usuario) && !empty($filtro)) {
                    	   	
                    	   		if($filtro == 'municipio'){
                    	   			
                    	   			$dados = $usuarioEx->buscaUsuarioMunicipio($usuario);
                    	   			
                    	   		}else {
                    	   			
                    	       		$dados = $usuarioEx->buscaUsuario($usuario);
                    	   			
                    	   		}
                    	       
                    	   		print '<table class="table table-bordered table-condensed tblcedec">
                    	   		<th>Usuario</th>
                    	   		<th>Municipio</th>
                    	   		<th>Email/Login</th>
                    	   		<th>Último Acesso</th>
                    	   		<th>Status</th>
                    	   		<th>Opções</th>';
                    	
                    	       foreach ($dados as $key => $value) {
                    	           
                    	           print "<tr>";
                    	           print "<td>".$value['usuario']."</td>";
                    	           print "<td>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</td>";
                    	           print "<td>".$value['email_rec']."</td>";
                    	           print "<td>".DataMysql::dataCompletaVisual($value['acesso'])."</td>";
                    	           print "<td>".$value['situacao']."</td>";
                    	           print "<td>
						                      <a href='?modulo=compdec&secao=compdec&acao=cUserEx&id=".$value['id']."' title='Editar dados'><img src='imagem/editar.png'></a>
						                      <a href='?modulo=compdec&secao=compdec&acao=caduser&id=".$value['id']."' title='Visualizar Dados'><img src='imagem/impressao.png'></a>						        					        
						          </td>";
                    	       }
                    	   }
                    	?>
                    	</table>	
                    	<br>
                    	<span style="text-align: center;">Cadastro enviados para Ativação</span>
                    	<table class="table table-bordered table-condensed text-center tblcedec">
                    		<tr>
							<th>Usuario</th>
							<th>Municipio</th>
							<th>Email/Login</th>
							<th>Status</th>
							<th>Opções</th>
							</tr>
							<?php 
								$usuarioPend = $usuarioEx->buscaUsuarioPendente();
						
								foreach ($usuarioPend as $key => $value) {
								
									print "<tr>";
									print "<td>".$value['usuario']."</td>";
									print "<td>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</td>";
									print "<td>".$value['email_rec']."</td>";
									print "<td>".$value['situacao']."</td>";
									print "<td>
						                      <a href='?modulo=compdec&secao=compdec&acao=cUserEx&id=".$value['id']."' title='Editar dados'><img src='imagem/editar.png'></a>
						                      <a href='?modulo=compdec&secao=compdec&acao=caduser&id=".$value['id']."' title='Visualizar Dados'><img src='imagem/impressao.png'></a>
						          </td>";
								}
							
							?>	
							
						</table>						
						

					</div>
				</div>
		</div>
	</div>
	
	<div class="row-fluid text-center">
	    <br><br><br>
		<x-small><?php print RODAPE;?></x-small>
	</div>

	<script src="/js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jasny-bootstrap.js"></script>
	<script>


		$(document).ready(function(){

			$("#btn").change(function(){

				var dados = {
								"id_pmda" : $("#txtIdPmda").val(), 
								"status"  : "1",
								"opcao"   : "gravar",
							}
				
				$.ajax({
			        type: 'POST',
			        url: 'mod_pipa/app/pmda/funcAdm.php',
			        data: dados,
			        success: function(response) {
				        console.log(response);
			        	//location.reload();
			        },
			        error: function(response){
			        	console.log(JSON.stringify(response));
			        }
			    });
			
			});

			$("#btnConfirm").hide();
			$("#txtProtocolo").hide();


			$("#lk_alteracao").click(function(){
				$("#btnConfirm").show();
				$("#txtProtocolo").show();
			});
			$("#btnConfirm").click(function(){
				alert("ok");
			});


		});


	</script>
	</body>
</html>
