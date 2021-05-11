<?php include_once 'core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_pipa/Model/IndexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php

$municipio = new Municipio();

?>
		<!-- INICIO DO CORPO-->
						<p class="text-center">Comunidades para Efetivação de Pré-Cadastro</p>
						<br>
						<br>
						<form action="" method="POST">
						<label>Pesquisar Município</label>
						<input class="form-control" type="text" id="txtMunicipio" name="txtMunicipio"><br>
						<input class="btn btn-primary" type="submit" id="btnPesquisar" name="btnPesquisar" value="Pesquisar">
						<a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=pipa&controller=pipa&action=pmdaCom&a=adm">Voltar</a>
						</form>
						<br>
						<?php
						
							$nomMunicipio = isset($_POST['txtMunicipio']) ? $_POST['txtMunicipio'] :"";
							$btn = isset($_POST['btnPesquisar']) ? $_POST['btnPesquisar'] :"";
							
							$comunidade = new Comunidade();
							
							$id_municipio = isset($_GET['id']) ? $_GET['id'] : "";
							
							/* pesquisa o municipio */
							if(($btn == "Pesquisar") && !empty($nomMunicipio)){
								
								$listMunicipio = $municipio->BuscaMunicipio($nomMunicipio);

								print "<table class='table table-bordered'>
								<tr>
								<th>Código</th>
								<th>Município</th>
								<th>Opção</th>
								</tr>";
								
								foreach ($listMunicipio as $value) {
									print "<tr>";
									print "<td>".$value['id_municipio']."</td>";
									print "<td>".$value['nome']."</td>";
									print "<td><a href='?token=".hash('sha256', md5(VERSAO))."&ac=itn&modulo=pipa&controller=pipa&action=valcom&id=".$value['id_municipio']."' title='Visualiza Comunidades para Efetivação de Cadastro'>Visualizar</a></td>";
									print "</tr>";
								}
							}
							
								/* comunidades */
								if(!empty($id_municipio)){	
									$listCom = $comunidade->listaComunidadePreCadastro($id_municipio);
								
									print "<table class='table table-bordered'>";
									print "<tr>";
									print "<th>Municpio</th>";
									print "<th>Nome Comunidade</th>";
									print "<th>Validado por</th>";
									print "<th>Opção</th>";
									print "</tr>";						
									
									foreach ($listCom as $value) {
										
										$preCad = ($value['tipo_cad'] == "pre") ? "style='background-color:#F78181; color:#FFFFFF;' title='Comunidade com pendência para liberação para Compor PMDA'" : "title='Esta comunidade faz parte das opções disponíveis para compor o PMDA deste Município!'";

										print "<tr>";
		 								print "<td $preCad>".$value['municipio']."</td>";
										print "<td $preCad>".$value['comunidade']."</td>";						
										print "<td $preCad>".Usuario::getNomeId($value['id_user_validador'])."</td>";						
										print "<td $preCad>";
										print ($value['tipo_cad'] =="pre") ? "<a href='?token=".hash('sha256', md5(VERSAO))."&ac=itn&modulo=pipa&controller=pipa&action=alteraComunidade&id=".$value['id_comunidade']."&idMun=".$id_municipio."' id='btnEfetiva' title='Editar Nome Comunidade'><img src='/core/imagem/editar.png' width='30px;'></a>
												<a onclick='javascript:efetivarCom(".$value['id_comunidade'].", ".$_COOKIE['seguranca']['idUser'].");' id='btnEfetiva' title='Liberar Comunidade para PMDA'><img src='/core/imagem/ok.jpg' width='30px;'></a>
										      	<a onclick='javascript:deletaCom(".$value['id_comunidade'].")' id='btnDeleta' title='Deletar Registro'><img src='/core/imagem/delete.png' width='30px;'></a>" : "";								
										print "</td>";		
										print "</tr>";
									}
									print "<tr>";
									print "<td colspan='3'>Total Registros Encontrado(s): ".count($listCom)."</td>";
									print "</tr>";
									print "</table>";
								}
							
						?>
						
						</table>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
	<script>


		$(document).ready(function(){

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

			// liberar comunidade para pmda 
			function efetivarCom(id_comunidade, id_user){

				var result = confirm("Deseja Liberar Comunidade para PMDA ?");

				if(result){

					var dados = { 	"id_comunidade" : id_comunidade,
									"opcao" : "efetiva",
									"id_usuario" : id_user,
					};

					$.ajax({
					       url : 'mod_pipa/backEnd/View/comunidade/func.php',
					       type : 'POST',
					       data : dados,
					       //dataType : 'json',
					       success : function(response) {
					    	   alert('Comunidade Ativada para Cadastramento PMDA');
					    	   location.reload();
					    	   //console.log(JSON.stringify(response));
					       },
					       error : function(response){
					    	   console.log(JSON.stringify(response));
					       }
					});


				}

			};

			// deletar registro nao aprovado
			function deletaCom(id_comunidade){

				var result = confirm("Deseja Deletar o registro desta Comunidade  ?");

				if(result){

					var dados = { 	"id_comunidade" : id_comunidade,
							"opcao" : "delete",
			};

					$.ajax({
					       url : 'mod_pipa/backEnd/View/comunidade/func.php',
					       type : 'POST',
					       data : dados,
					       //dataType : 'json',
					       success : function(response) {
					    	   alert('Registro apagado com Sucesso !');
					    	   location.reload();
					    	   //console.log(JSON.stringify(response));
					       },
					       error : function(response){
					    	   console.log(JSON.stringify(response));
					       }
					});


				}

			};




	</script>