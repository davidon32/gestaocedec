<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cce/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php

$_login = new Login();

$_usuario = new Usuario();

$_diario = new Diario();

$_id_usuario = $pageSession['session']['seguranca']['idUser'];

$boletim = new Boletim();

$dados = $boletim->listBoletim(10);

?>


<div class="col-md-12 text-center">
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=index"class="btn btn-success">Voltar</a>
</div>

					
					   <p>
					   	<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=novo" title="Novo Boletim" class="btn btn-primary">Publicar Boletim</a>
						<br><br>
					   </p>
					   <table class="table table-bordered table-condensed table-striped">
					   		<thead>
					   		<tr>
					   			<th colspan="7" style="text-align:center">Últimos Boletins Publicados</th>
					   		</tr>
					   		<thead>
					       <tr>
					       	<thead>
                               <th style="text-align:center;">Código</th>
                               <th style="text-align:center;">Data</th>
                               <th style="text-align:center;">Documento</th>
                               <th style="text-align:center;">Tipo</th>
                               <th style="text-align:center;">Tamanho</th>
                               <th style="text-align:center;">Plantonista</th>
                               <th style="text-align:center;">Opção</th>
                               <thead>
                               
                           </tr>
                           
                           <?php 
                           		foreach ($dados as $value) {
                           			print "<tr>
												<td>".$value['id']."</td>
												<td>".DataMysql::dataCompletaVisual($value['data'])."</td>
												<td><a href=\"anexo/boletim/".$value['nome']."\" title=\"Visualizar Documento\">Boletim nº ".$value['descricao']." ".$value['complemento']."</a></td>
												<td>".substr($value['nome'], -3, 3)."</td>
												<td>".$value['tamanho']." Kb</td>
												<td>".Usuario::getNomeId($value['plantonista'])."</td>
												<td><a name='linkDelete' id='linkDelete' href='#' onclick=\"javascript:deletar(".$value['id'].", '".$value['nome']."');\"><img src='/core/imagem/delete.png' title='Remover boletim'></a></td>
											</tr>";
                           		}
                           
                           ?>
                           
					   </table>
					 
				    <?php
				    
				        
					?>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

    <script type="text/javascript">
    /* funcao deletar boletim */
function deletar(id, arquivo){
				var confirmacao = confirm("Deseja realmente Deletar o Boletim ?");
				var dados = {
                		"id" :id,
                		"arquivo" :arquivo,
                		"opcao" : "delete" 		
                	};
				if(confirmacao == true){
			            $.ajax({
			                type: 'POST',
			                url: 'mod_cce/backEnd/View/boletim/valida.php?v=<?=md5(VERSAO)?>',
			                data: dados,
			                success: function(response) {
			                	alert("Registro apagado com sucesso !");
			                    location.reload();
			                }
			            });
				}else {
				}
}
    </script>

