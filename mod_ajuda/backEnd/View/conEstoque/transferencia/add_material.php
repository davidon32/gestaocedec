<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
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

$id_deposito1 = isset($_GET['id']) ? $_GET['id'] :0;
$itensProduto = ControleSaldo::saldoPorDeposito($id_deposito1);

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

					
							<div class="col-md-4">
								<label>Dep&oacute;sito Origem :</label>
								<!--<?php $_deposito->pegaDeposito();?>-->
                                                                <input type="text" class="form form-control" readonly value="<?=Deposito::PegaNomeDeposito($id_deposito1);?>">
                                                                <input type="hidden" name='id_deposito' id='id_deposito' value="<?=$id_deposito1;?>">
							</div>
							
							<div class="col-md-4">
								<label>Produto :</label>
								<!--<?php $nProd -> PegaProduto();?>-->
                                                                <input type="text" name="nome_produto" id="nome_produto" class="col-md-12">
                                                                <input type="hidden" name="id_produto" id="id_produto">
							</div>
                                                        <div class="col-md-4">
								<label>Entrada</label>
                                                                <select class='form form-control' id="selEntrada" name="selEntrada" required>
                                                    <option></option>
                                                </select>
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
                                                                <input class="form-control" type="text" name="descricao" size="25" value="-" maxlength="45">
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
                                                        $id_entrada = isset($_POST['selEntrada']) ? $_POST['selEntrada'] : '';
				
							if($acao == 'Adicionar'){
				
								$campos = array('Acao'=>$acao,
												'Material'=>$material,
												'Quantidade'=>$qtd,
												'Deposito'=>$id_deposito,
												'Descrição'=>$descricao);
								
								if(FuncaoBase::CampoBranco($campos)){
					
									#@ Monta o item 
									$item = $_pedido->Item($id_deposito,
                                                                                                $material,
                                                                                                $descricao,
                                                                                                $qtd,
                                                                                                Material::getNomeEvento($evento),
                                                                                                $id_entrada);
								
									#@ adiciona na cesta 
									$_pedido->AdicionaItem($item);
					
								}
									
							}
						?>
			</div>
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
                
                var itensProduto = {
            data:
                <?php print json_encode($itensProduto); ?>, // array com os dados
                getValue: "nome",
                template: {
                    type: "custom",
                    method: function(value, item) {
			return value + " | " + item.descricao + " | Saldo :  " + item.saldo;
		}
                },
                list: {
                    match: {
                            enabled: true
                        },
                        onSelectItemEvent: function () {
                            $('#selEntrada')[0].options.length = 0;
                            var id = $("#nome_produto").getSelectedItemData().id_unidade;
                            var id_deposito = $("#id_deposito").val();
                            
                            var dados = {
                                'id_material': ''+ id +'',
                                'id_deposito':''+id_deposito+''
                            }
                            
                            $("#id_produto").val(id);
                            
                            $.ajax({
                                url:"mod_ajuda/backEnd/View/conEstoque/liberacao/busca_entrada.php",
                                type:"POST",
                                data: dados,
                                dataType : "json",
                                success:function(dados){
                                    console.log(dados)
                                    $('#selEntrada').append("<option></option>");
                                    $.each(dados, (i, val) => {
                                        var saldo = val.saldo;
                                        if(typeof saldo == 'object') {
                                            saldo = val.quantidade;
                                        }else {
                                            saldo = val.saldo;
                                        }
                                        $('#selEntrada').append(`<option value="${val.id_produto}" data-saldo="${saldo}"> ${val.id_produto} - Saldo Individual ${saldo} </option>`);
                                    });
                                    
                                }
                                });
                            
                            
                        }

                }

        };
            $("#nome_produto").easyAutocomplete(itensProduto);
            $("#selEntrada").change(function(){
                var max = $(this).find(':selected').data('saldo')
                $("#txtQtd").attr({
                        "max" : max,        
                        "min" : 1});
            });
	</script>


</body>
</html>
