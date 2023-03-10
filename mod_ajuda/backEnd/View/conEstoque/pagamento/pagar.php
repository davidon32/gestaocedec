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
<?php include_once "template/page/corpoHeader.php";?>
<style>
	.info {
		color : red;
	}
	
	#frmPagamento .error {
    	color: red;
	}
</style>
<?php
$_pagamento = new Pagamento();



/* ****************************************************************************************
 *  	Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Fun��o       : Tela de Executar Libera��o de Materiais
*
*******************************************************************************************/

$dtArruma = new dataMysql();

$id_libera = $_GET['id'] ? $_GET['id'] : null;

if((int)$id_libera){
	
	$dado = $_pagamento->EfetPgto($id_libera);
	
        if(count($dado) > 0){
            $dados_municipio = Municipio::dadosMunicipio($dado['id_municipio']);
            
            $numero = filter_var(str_replace(array("-","."), "", $dados_municipio['endereco']), FILTER_SANITIZE_NUMBER_INT);
            //$pgto -> MosLibInd($_SESSION['seguranca']['idUser'], $_GET['idLibera']);
        }else {
            print "<script> alert(' Pagamento não disponivel, Verifique este lancamento');";
            print "window.location.href = '".FuncaoBase::geraLink("ajuda", "conestoque", "idxpagamento")."';";
            print "</script>";
            die();
        }
	
	?>
		
		<legend>Pagamento de Material : <?php print Municipio::PegaNomeMunicipio($dado['id_municipio']);?></legend>
		
	<form method="post" name="efetPag" id="frmPagamento" action="?token='<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=conestoque&action=valida&id=<?php print $dado['id_liberacao']; ?>">
		
		<div class="col-md-12">
			<!--   dados da liberacao -->
			<span>Dados da Libera&ccedil;&atilde;o</span>
			<br><br>
			
			<div class="col-md-4">
				<label>Nº Lib</label>
				<input class="form-control" type="text" name="nLibera" value="<?php print $dado['id_liberacao'];?>" readonly="readonly" />
				<input type="hidden" name="opcao" value="pagamento">
			</div>
			<div class="col-md-4">	
				<label>Data Libera&ccedil;&atilde;o:</label>
                                <input class="form-control" name="dtLibera" type="text" id="dtLibera" value="<?php print DataMysql::dataVisual($dado['datalibera'])?>" readonly="readonly" maxlength="10"/>
			</div>
		
			<div class="col-md-4">
				<label>Data Pagamento:</label>
				<span class="info">*</span>
                                <input class="form-control" name="dtPgto" type="text" id="dtPgto" data-mask="99/99/9999" required maxlength="10"/>
			</div>
		</div>
		<div class="col-md-12"><hr></div>

		
		<!-- dados do destinatario -->
		<span> Dados do Destinat&aacute;rio</span>
		<br><br>
		
		<div class="col-md-12">
			<div class="col-md-2">
				<label>Pessoa Física</label><br>
				<input type="radio" name="ck_pessoa" id="ck_pf" class="ck_pessoa" value="pf" />
			</div>
			<div class="col-md-2">
				<label>Pessoa Jurídica</label><br>
				<input type="radio" name="ck_pessoa" id="ck_pj" class="ck_pessoa" value="pj" checked/>
			</div>
			<div class="col-md-4">
				<label>Destino:</label>
				<input class="form-control" name="beneficiario" type="text" id="beneficiario" value="<?php print $dado['beneficiario'];?>" readonly="readonly" maxlength="45"/>
			</div>
			<div class="col-md-4">
				<label>CNPJ/CPF:</label>
				<span class="info">*</span>
				<input name="cpfCnpj" id="cpfCnpj" type="text" maxlength="18" class="form-control">
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-8">	
				<label>Endere&ccedil;o:</label>
				<span class="info">*</span>
                                <input class="form-control" name="endereco" type="text" maxlength="40" required value="<?=$dados_municipio['endereco']?>">
			</div>
			<div class="col-md-4">
				<label>N&uacute;mero:</label>
				<span class="info">*</span>
				<input  class="form-control" name="numero" type="text" size="6" maxlength="6" required value="<?=$numero?>">
			</div>
		</div>	
		<div class="col-md-12">	
			
			<div class="col-md-4">
				<label>Bairro:</label>
				<span class="info">*</span>
				<input class="form-control" name="bairro" type="text" size="40" maxlength="20" required value="<?=$dados_municipio['bairro']?>">
			</div>
			<div class="col-md-4">					
				<label>Telefone:</label>
				<span class="info">*</span>
				<input class="form-control" name="tel_dest" type="text" size="40" value="<?=$dados_municipio['tel_pref']?>">		
			</div>
			<div class="col-md-4">	
				<label>Celular:</label>
				<span class="info">*</span>
				<input class="form-control" name="cel_dest" type="text" size="40" value="<?=$dados_municipio['cel_pref']?>">
			</div>
		</div>

		<div class="col-md-12"><hr></div>
		<span>Respons&aacute;vel pela Retirada do Material</span>
		
		<div class="col-md-12">
			<div class="col-md-12">
				<!-- dados do responsavel pela liberacao-->
				<label>Respons&aacute;vel:</label>
				<span class="info">*</span>
				<input class="form-control"  name="responsavel" type="text" id="responsavel" size="40" maxlength="40" required value='<?=$dado['resp_receb']?>'/>
			</div>
		</div>	

		<div class="col-md-12">
			<div class="col-md-6">	
				<label>Identidade:</label>
				<span class="info">*</span>
				<input class="form-control" name="nDoc" type="text" id="nDoc" size="40" maxlength="20" value='<?=$dado['resp_receb_ci']?>' required />
			</div>
			
			<div class="col-md-6">
				<!-- campo oculto para pegar a data limite de pagamento-->
				<input type="hidden" name="dtLimite" value="<?php print DataMysql::dataVisual($dado['dtLimite']);?>" />
				<input type="hidden" name="municipio" value="<?php print Municipio::PegaNomeMunicipio($dado['id_municipio'])?>" />
				<label>CPF</label>
				<span class="info">*</span>
				<input class="form-control" name="cpfResp" id="cpfResp" type="text" data-mask="999.999.999-99" size="40" value='<?=$dado['resp_receb_cpf']?>' required>
			</div>
		</div>


		<div class="col-md-12">
			<div class="col-md-6">
				<label>Ve&iacute;culo:</label>
				<span class="info">*</span>
				<input class="form-control" name="veiculo" id="veiculo" type="text" size="40" maxlength="20" value='<?=$dado['resp_receb_veiculo']?>' required >
			</div>	
			<div class="col-md-6">	
				<label>Placa:</label>
				<span class="info">*</span>
                                <input class="form-control" name="placa" id="placa" type="text" size="40" value='<?=$dado['resp_receb_placa']?>' required maxlength="10">
			</div>
		</div>
				
		<div class="col-md-12">
			<div class="col-md-12">
				<label>Obs: (maximo 256 caracteres)</label>
				<textarea  class="form-control" name="obs" cols="40" rows="6" maxlength="256"></textarea>
			</div>
		</div>
		<div class="col-md-12 text-center">		
			<br>
			<a class="btn btn-info" onclick="history.back()">Voltar</a>
			<input type="submit" class="btn btn-success" name="btnPag" id="btnPag" value="Realizar Pagamento" onclick="return confirm('Deseja Confirmar o Pagamento ?');" />
		</div>
				
	</form>
	
	<?php }else {
		print 'erro';
				
	}?>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cpfCnpj").mask('99.999.999/9999-99');
                        $("#cpfCnpj").val('00.000.000.0000-00');

			$("input[type='radio']").click(function(){
				var pessoa = $("input[name='ck_pessoa']:checked").val();
				if(pessoa == "pf"){
				$("#cpfCnpj").mask('999.999.999-99');
                                $("#cpfCnpj").val('000.000.000-00');
				}else {
				$("#cpfCnpj").mask('99.999.999.9999-99');
                                $("#cpfCnpj").val('00.000.000.0000-00');
				}
				console.log(pessoa);
			});

			$("cpfResp1").blur(function(){
				var campo = $("cpfResp").val();
				if(campo.length == 11) {
					alert('cpf');
				}

			});

			$("#dtPgto").datepicker({ 
                            dateFormat: 'dd/mm/yy',
                            minDate: "<?php print DataMysql::dataVisual($dado['datalibera'])?>",
                            maxDate: "+15D", 
                        }).attr('readonly', 'readonly');;
		

		});
		function maskCPFCNPJ(){
			$("#cnpj").hide();
			if($("#ck_pf").is(":checked")){
				$("#cpf").show();
				$("#cnpj").hide();
			}else if($("#ck_pj").is(":checked")){
				$("#cnpj").show();
				$("#cpf").hide();
			}
		}
                
                $("#btnPag").hover(function(){
                   alert(); 
                });

		/* form validation */
		$("#frmPagamento").validate({
		rules: {
			dtPgto: { required: true}, 
			endereco: { required: true, maxlength: 40},
			numero: { required: true, maxlength: 6},
			bairro: { required: true, maxlength: 40},
			responsavel: { required: true, maxlength: 40},
			nDoc: { required: true, maxlength: 20},
			cpfResp: { required: true},
			veiculo: { required: true, maxlength: 20},
			placa: { required: true},
			
			},
			messages: {
				dtPgto: { required:"O Campo Data Liberacao não pode ficar em branco"},
				endereco: { required:'O campo nao pode ficar em branco', maxlength:' O tamanho do campo Justificativa é de 40 caracteres'},
				numero: { required:'O campo nao pode ficar em branco', maxlength:' O tamanho do campo Justificativa é de 6 caracteres'},
				bairro: { required:'O campo nao pode ficar em branco', maxlength:' O tamanho do campo Justificativa é de 40 caracteres'},
				responsavel: { required:'O campo nao pode ficar em branco', maxlength:' O tamanho do campo Justificativa é de 40 caracteres'},
				nDoc: { required:'O campo nao pode ficar em branco', maxlength:' O tamanho do campo Justificativa é de 20 caracteres'},
				cpfResp: { required:'O campo nao pode ficar em branco'},
				veiculo: { required:'O campo nao pode ficar em branco', maxlength:' O tamanho do campo Justificativa é de 20 caracteres'},
				placa: { required:'O campo nao pode ficar em branco'},
			},
		
		});

	</script>