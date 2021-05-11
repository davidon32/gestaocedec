<?php include_once PATH.'/core/include.php';?>
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


 $id_pmda = isset($_GET['param'])? $_GET['param'] :"";


$id_municipio = isset($_GET['mun'])? $_GET['mun'] :"";

?>
						<!-- INICIO DO CORPO-->

						<div class="span6 text-center">
							<br>
							<a class="btn btn-primary" href="?ac=itn&modulo=pipa&controller=pipa&action=printPmda&param=<?=$id_pmda.'&a='.rand().'&mun='.$id_municipio;?>">Visualizar PMDA</a>
							<a class="btn btn-primary" href="?ac=itn&modulo=pipa&controller=pipa&action=printPmdaMapa&param=<?=$id_pmda.'&mun='.$id_municipio;?>">Visualizar Mapa PMDA</a>
							
							
						</div>
						<div class="span6 text-left">
						<p style="text-align:center"><b>Anexo do PMDA formato PDF</b></p>
							<br>

							<?php $anexo = new AnexoPmda(); 
							
									$pmda = new Pmda();
  		
						  		$listAnexo = $anexo->listaAnexo($id_pmda);
						  		
						  		foreach ($listAnexo as $value) {
						  			
									  $arquivo = $pmda->previewAnexo($value['id']);
									  if($arquivo['existe'] != false){
										$extensao = substr($arquivo['file'], -3);
										if($extensao == "pdf" || $extensao == "PDF"|| $extensao == "jpg" || $extensao == "peg"){
										
										print "<a style='text-decoration:none;'href="."/anexo/".$arquivo['file']."><img src='/core/imagem/pdf.png'>".$arquivo['file']."</a><br>";
									  }
						  			}
						  			//print "<iframe src=\"".$pmda->previewAnexo($value['id'])."\"&embedded=true\" width=\"700\" height=\"780\" style=\"border: none;\"></iframe>";
						  		} 
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

			$("#lbSituacao").hide();

			$('select').change(function(){

				console.log(this.value);
			
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


			$("#rbOpcaoGeral").click(function(){

				$("#lbPesquisa").hide();
				//alert("ok");
				$("#lbSituacao").show();
			});

			$("#rbOpcaoMun").click(function(){

				$("#lbPesquisa").show();
				//alert("ok");
				$("#lbSituacao").hide();
			});


		});

		function alterarStatus(id_pmda){

			var id_sel = "#selStatus"+id_pmda;

			 var dados = {
						"id_pmda" : id_pmda, 
						"status"  : $(id_sel).val(),
						"opcao"   : "gravar",
					}
		
		$.ajax({
	        type: 'POST',
	        url: 'mod_pipa/app/pmda/funcAdm.php',
	        data: dados,
	        success: function(response) {
		        //console.log(dados);
		        alert('Status Alterado com Sucesso !!')
		        location.reload();
		        

	        },
	        error: function(response){
	        	console.log(JSON.stringify(response));
	        	
	        	
	        }
	    });
			    
		}


	</script>
	</body>
</html>
