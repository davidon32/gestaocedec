<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<style>	
	#frmCancela .error {
    	color: red;
	}
</style>
<?php
$_readOnly = "";
	$id_liberacao = isset($_GET['id']) ? $_GET['id'] :"";
	if(!empty($id_liberacao)){
		$_readOnly = "readonly='readonly'";
	}

?>

	<legend>Cancelar Liberação</legend>

	<form method="POST" id="frmCancela" action="">
	<!-- ?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=lcancela" name="frm_cancela -->
		
	<div class="col-md-4">
		<label>Nº Liberacao </label>
		<input class="form-control" type="text" name="txt_id_libera" id="txt_id_libera" value="<?=$id_liberacao;?>" <?=$_readOnly;?> required/>
	</div>
		<br />
		<input class="btn btn-success" type="submit" name="btn_cancela" value="Buscar" />
		
	</form>

	<div class="col-md-12">

			<?php

				$liberacao = new Liberacao();

				$btnCancela = isset($_POST['btn_cancela']) ? true : false;
				$id_liberacao_post = isset($_POST['txt_id_libera']) ? $_POST['txt_id_libera'] : false;

				if($btnCancela) {


					$dados = $liberacao->buscaLiberacaoId($id_liberacao_post);			

				if(!empty($dados)){
					$situacao = Liberacao::situacaoLib($dados['situacao']);
					
					if($situacao == 'Aberto'){
						$css =" style='color:#FFFFFF;background:#2E64FE'";
						$link = "<a id='cancela'><img width='35px' src='core/imagem/cancela.png'></a>";
					}elseif($situacao == 'Pago'){
						$css =" style='color:#FFFFFF;background:#088A29'";
						$link = "<a id='cancela' data-pago><img width='35px' src='core/imagem/cancela.png'></a>";
                                                print "<script>Swal.fire({
                                                                            icon: 'error',
                                                                            title: 'Atenção...',
                                                                            text: 'Você está a caminho de fazer um cancelamento de uma Liberação que já foi paga, deseja prosseguir assim mesmo ?',
                                                                            footer: ''
                                                                          })</script>";
					}elseif($situacao == 'Cancelado') {
						$css =" style='color:#FFFFFF;background:#FE9A2E' title='Liberação já Cancelada'";
						$link = "-";
					}

					print "<table class=\"table\">
					<tr>
						<th>Nº Lib</th>
						<th>Data</th>
						<th>Dep. Origem</th>
						<th>Municipio Destino</th>
						<th>Situação</th>
						<th>Ação</th>
					</tr>";

					print "<tr>
						<td ".$css.">".$dados['id_liberacao']."</td>
						<td ".$css.">".DataMysql::dataVisual($dados['dataLibera'])."</td>
						<td ".$css.">".$dados['depDestino']."</td>
						<td ".$css.">".Municipio::PegaNomeMunicipio($dados['id_municipio'])."</td>
						<td ".$css.">".$situacao."</td>
						<td ".$css.">".$link."</td>
					</tr>";
					print "<tr>
							<td colspan=6>
							<label>Justificativa</label>
							<textarea rows='5' class=\"form-control\" name=\"txt_motivo\" id=\"txt_motivo\" required/></textarea>
							<input type='hidden' name='id_liberacao' id='id_liberacao' value='".$dados['id_liberacao']."'>
							</td>
							</tr>";
				}else {
					print "<tr>
							<td colspan=5>Não Existe Liberacao para este número !</td>
							</tr>";
				}
				
				
		print "</table>";

	}else {

	}
?>
		<p style="text-align:center"><a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxliberacao">Voltar</a></p>

	</div>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">

$(document).ready(function(){
    
	$("#cancela").click(function(){
                    var result = confirm("Você usuario, <?=$_COOKIE['seguranca']['nome_usuario']?> tem certeza que deseja cancelar esta liberação ?");

		if($("#txt_motivo").val() == ""){
			alert("O campo Justificativa não pode ficar em branco !")
		}else if(result){

			var dados = {	
				"opcao"        : "cancela",
				'id_liberacao' : $("#id_liberacao").val(),
				'txt_motivo'       : $("#txt_motivo").val(),
				'btn_cancela'  : true,
			};

					$.ajax({
						type: 'POST',
						url: 'mod_ajuda/backEnd/View/conEstoque/liberacao/valida.php',
						data: dados,
						success: function(response) {
								console.log(response.length);
							if(response.indexOf("sucesso") != -1){
								alert("Cancelamento Realizado com Sucesso !");
								window.location.href = '<?=FuncaoBase::geraLink("ajuda", "conestoque", "idxliberacao")?>';
							}else if(response.indexOf("semPermissao") != -1){
								alert("Usuario nao tem Permissao para Cancelar essa Liberacao !");
							}else if(response.indexOf("erro") != -1) {
								alert("Ocorreu um erro ao cancelar esta liberacao !");
							}
							
						},
						error: function(e){
							console.log(JSON.stringify(response));
							alert("Ocorreu um Erro !");
						}
					});
					return false;
		}

	});
        
        

});	

</script>