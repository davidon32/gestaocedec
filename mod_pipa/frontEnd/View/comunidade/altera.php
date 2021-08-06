<?php include_once 'core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_pipa/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menuExterno.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<?php

/*$_login = new Login();

$_login->Logado();*/

$municipio = new Municipio();

$id_municipio = isset($_GET['idMun']) ? $_GET['idMun'] : "";

$id_comunidade = isset($_GET['id']) ? ($_GET['id']) :"";

$comunidade = new Comunidade();

$dados = $comunidade->buscaComunidadeId($id_comunidade);
?>

						<!-- INICIO DO CORPO-->
						<p class="text-center">Alterar nome Comunidade de :</p>
						<br>
						<br>
						<form method="POST" name="frmAlteraCom">
							<label>Comunidade</label>
							<input class="form-control" type="text" id="txtComunidade" name="txtComunidade" value="<?=$dados['comunidade'];?>" title="Digite aqui o nome da Comunidade">
							<input type="hidden" id="txtIdComunidade" name="txtIdComunidade" value="<?=$dados['id_comunidade'];?>">
							<br>
							<button class="btn btn-primary" type="button" id="btnGravar" name="btnGravar" value="Gravar" title="Grava o nome da comunidade">Gravar</button>
							<a  class="btn btn-primary" href="?modulo=pipa&controller=pipa&action=valcom&id=<?=$id_municipio;?>">Voltar</a>
						</form>
						<br>

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


			// Alterar Nome comunidade
			$("#btnGravar").click(function(){

				var result = confirm("Deseja Alterar o nome desta Comunidade ?");

				if(result){

					var dados = { 	"id_comunidade" : $("#txtIdComunidade").val(),
									"txtComunidade" : $("#txtComunidade").val(),
									"opcao" : "alterar",
					};

					$.ajax({
					       url : 'mod_pipa/View/comunidade/func.php',
					       type : 'POST',
					       data : dados,
					       //dataType : 'json',
					       success : function(response) {
					    	   //alert('Nome da Comunidade Alterada com Sucesso !');
					    	   console.log(JSON.stringify(response));
					       },
					       error : function(response){
					    	   console.log(JSON.stringify(response));
					       }
					});


				}

			});


			// liberar comunidade para pmda 
			function efetivarCom(id_comunidade){

				var result = confirm("Deseja Liberar Comunidade para PMDA ?");

				if(result){

					var dados = { 	"id_comunidade" : id_comunidade,
									"opcao" : "efetiva",
					};

					$.ajax({
					       url : 'mod_pipa/View/comunidade/func.php',
					       type : 'POST',
					       data : dados,
					       //dataType : 'json',
					       success : function(response) {
					    	   alert('Comunidade Ativada para Cadastramento PMDA');
					    	   location.reload();
					    	   console.log(JSON.stringify(response));
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
					       url : 'mod_pipa/app/comunidade/func.php',
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


		});

	</script>
	</body>
</html>
