<?php include_once "core/Model/indexModel.php"?>
<?php include_once "mod_pipa/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<div class="container">
    <!-- PAGINA -->
    <div class="container">
            <!-- CORPO -->
        <div class="row-fluid">
            <div class="span10">
			<span>Em construção !</span>
						<!-- <div class="span12 text-center"><h4>Manutenção de Usuários</h4></div>
						<!-- INICIO DO CORPO-->
						<!-- <form action="?modulo=pipa&secao=pmda&acao=pesquisaUsuario" class="form-search" method="post">
						
							<label>Escolha um Municipio do Usuário</label>
							<div class="input-group">
								<input type="text" name="txtPesquisa" id="txtPesquisa" />
								<input type="submit" name="btnPesquisa" id="btnPesquisa" class="btn btn-primary" value="Pesquisar"/>
							</div>
						</form>
						
						<table class="table">
							<th>Municipio</th>
							<th>Opções</th>-->
							
						
						<?php
	
                    	   /* $usuarioEx = new Usuario();
                    	
                    	   $usuario = isset($_POST['txtPesquisa']) ? $_POST['txtPesquisa'] : "";
                    	   $btn = isset($_POST['btnPesquisa']) ? $_POST['btnPesquisa'] : "";
                    	   
                    	   if($btn == 'Pesquisar') {
                    	       
                    	       $dados = $usuarioEx->buscaUsuario($usuario);
                    	
                    	       foreach ($dados as $key => $value) {
                    	           
                    	           print "<tr>";
                    	           print "<td>".$value['usuario']."</td>";
                    	           print "<td>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</td>";
                    	           print "<td>".$value['email_rec']."</td>";
                    	           print "<td>-</td>";
                    	           print "<td>
						                      <a href='?modulo=pipa&secao=pmda&acao=cUserEx&id=".$value['id']."'>Alterar</a>
						                      <a href='#'>Visualizar</a>						        
						          </td>";
                    	       }
                    	       //var_dump($_POST);
                    	       
                    	       
                    	   } */
                    	
                    	
                    	?>
                    	
                    	</table>								
						

                    

                  
            </div>       
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
