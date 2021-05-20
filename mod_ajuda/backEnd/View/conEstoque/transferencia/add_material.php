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
<?php include_once "template/page/corpoHeader.php";

$_deposito = new Deposito();

$_controleSaldo = new ControleSaldo();

$_pedido = new Pedido();

/*****************************************************************************************
 *   Org�o 		: Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        : Demetrio Silva Passos
*	Fun��o       : Adiciona material na cesta para transferencia
*
*******************************************************************************************/


$saldo = new Relatorio();

if(!isset($_SESSION['cesta'])){

	$_SESSION['cesta'] = array();
}



$nProd = new Produto();	
//FuncaoBase::vd($_SESSION);

?>
	<div class="row-fluid">
		<div class="row">
			<div class="span12 text-center"><legend>Transferência de Materiais entre Depósitos</legend></div>
		</div>

			<div class="col-md-12">
					<legend>Adicionar Material</legend>
						<form method="POST" action="#" name="adItem">

					
							<div class="col-md-6">
								<label>Dep&oacute;sito Origem :</label>
								<?php $_deposito->pegaDeposito();?>
							</div>
							
							<div class="col-md-6">
								<label>Produto :</label>
								<?php $nProd -> PegaProduto();?>
							</div>

							<div class="col-md-4">

								<input type="hidden" name="la" value="0">
										
								<label>Evento :</label>
								<select name="evento" class="form-control">
									<option></option>
								<?php
									Material::Evento();
								?>

								</select>
							</div>
							<div class="col-md-4">
								<label>Descrição :</label>
								<input class="form-control" type="text" name="descricao" size="25" value="-">
							</div>	
							<div class="col-md-4">
								<label>Quantidade :</label>
								<input class="form-control" type="text" name="qtd" id="txtQtd" size="25" maxlength="5">
								<br />	
							</div>
							<div class="col-md-12 text-center">
							<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=conestoque&action=transf">Voltar</a>
							<input class="btn btn-primary" type="submit" name="acao" value="Adicionar">
							</div>
						</form>
			</div>
			
			<p class="text-center"><legend>Materiais da Transferência</legend></p>

			<div class="col-md-2"></div>
			<div class="col-md-8" style="background:#BDBDBD;">
			<br>
					<?php $pedido = new Pedido();
						//FuncaoBase::vd($_SESSION);
						#@ mostra os materiais que estao no pedido
						$pedido -> MostraPedido($_SESSION['cesta']);
						?>
			</div>
			<div class="col-md-2"></div>
						
			<div class="col-md-12">
				<span id="id"></span>
				<?php
							
							$acao = isset($_POST['acao']) ? $_POST['acao'] : '';
							$material = isset($_POST['id_produto']) ? $_POST['id_produto'] : '';
							$qtd = isset($_POST['qtd']) ? $_POST['qtd'] : '';
							$id_deposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : '';
							$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
							$evento = isset($_POST['evento']) ? $_POST['evento'] : '';
				
							if($acao == 'Adicionar'){
				
								$campos = array('Acao'=>$acao,
												'Material'=>$material,
												'Quantidade'=>$qtd,
												'Deposito'=>$id_deposito,
												'Descrição'=>$descricao);
								
								if(FuncaoBase::CampoBranco($campos)){
					
									#@ Monta o item 
									$item = $_pedido->Item($id_deposito, $material, $descricao, $qtd, $evento);
								
									#@ adiciona na cesta 
									$_pedido->AdicionaItem($item);
					
								}
									
							}
						?>
			</div>
	</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			var id = $("#id_deposito").val();

		if(typeof id !== 'undefined') {
			$("#id").load('mod_ajuda/backEnd/View/conEstoque/liberacao/saldo_por_deposito.php?id='+id);
		}

		$("#id_deposito").change(function(){
			var id = $("#id_deposito").val();
			$("#id").load('mod_ajuda/backEnd/View/conEstoque/liberacao/saldo_por_deposito.php?id='+id);


		});


			$("#txtQtd").blur(function(){
					var num = $("#txtQtd").val();

					numInt = parseInt(num);
					$("#txtQtd").val(numInt);
				});

		});
	</script>


</body>
</html>
