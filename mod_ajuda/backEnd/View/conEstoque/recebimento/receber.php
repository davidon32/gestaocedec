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
<?php

	$_transferencia = new TransferenciaMaterial();

	$_produto = new Produto();
        


/* ****************************************************************************************
 *   Org�o 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Fun��o       :  tela efetivar recebimento de Materiais Transferidos
*
*******************************************************************************************/

$_id_transferencia = isset($_GET['n']) ? (int)$_GET['n'] : null;
if($_transferencia::getSituacaoTransferencia($_id_transferencia) > 0) {
    print "<script>alert('Transferencia não disponivel para Recebimento !');";
    print "window.location.href= '".FuncaoBase::geraLink("ajuda", "conestoque", "idxtransf")."';";
    print "</script>";
    die();
}

if(is_null($_id_transferencia)){
	die();
}

// lista os materiais que foram transferidos
$_lista_material = $_transferencia->ListaItensTransferencia($_id_transferencia);
	
// busca os dados da transferencia realizar o recebimento
$_dados = $_transferencia->MaterialReceber($_id_transferencia);

?>
			   
	<legend> Receber Materiais Transferencia entre Depósito </legend>
	<form method="POST" action="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=vreceber" id="frm_recebe" name="frm_recebe" >
				
	<div class="col-md-6">
		<div class="col-md-6">
			<label>Depósito Origem:</label>
			<input type="text"  class="form-control" name="txt_depOrigem"        value="<?php print Deposito::PegaNomeDeposito($_dados['id_dep_origem']);?>" readonly="readonly"> 
			<input type="hidden" name="id_dep_origem" id="id_dep_origem"   value="<?php print $_dados['id_dep_origem'];?>">
			
                        <input type="hidden" name="txt_id_transferencia" value="<?php print $_dados['id_transferencia'];?>">
			
		</div>
		<div class="col-md-6">
			<label>Depósito Destino:</label>
			<input type="text" class="form-control" name="txt_depDestino" value="<?php print Deposito::PegaNomeDeposito($_dados['id_dep_destino']);?>"	readonly="readonly"></label>
			<input type="hidden" name="txt_id_dep_destino"   value="<?php print $_dados['id_dep_destino'];?>">
		</div>
		<div class="col-md-6">
			<label>Veiculo:</label>
			<input type="text" class="form-control" name="txt_veiculo" value="<?php print $_dados['veiculo'];?>" readonly="readonly">
		</div>
			<div class="col-md-6">
			<label>Motorista:</label>
			<input type="text" class="form-control" name="txt_motorista" value="<?php print $_dados['motorista'];?>" readonly="readonly">
		</div>
		<div class="col-md-6">
			<label>Placa:</label>
			<input type="text" class="form-control" name="txt_placa" value="<?php print $_dados['placa'];?>" readonly="readonly">	
		</div>
		<div class="col-md-6">			
			<label>Saída:</label>
            <input type="text" class="form-control" name="txt_dtSaida" value="<?php print DataMysql::extraiData($_dados['dt_saida']);?>" readonly="readonly">
		</div>
		<div class="col-md-6">
            <label>Horário:</label>
        	<input type="text" class="form-control" name="txt_hrSaida" value="<?php print DataMysql::extraiHora($_dados['dt_saida']);?>" readonly="readonly">
		</div>                                
		<div class="col-md-6">
			<label>Responsável:</label>
                        <input class="form-control" type="text" name="txt_responsavel" size="40" maxlength="45">
		</div>
		<div class="col-md-6">
			<label>Chegada:</label>
                        <input class="form-control" type="text" name="txt_dtChegada" id="txt_dtChegada" data-mask="99/99/9999" maxlength="10">
		</div>
		<div class="col-md-6">
			<label>Horário:</label>
                        <input class="form-control" type="text" name="txt_hrChegada" id="mask-hora" data-mask="99:99" maxlength="6">
		</div>
		<div class="col-md-6">	
			<label>Nº Polícia/Identificação:</label>
                        <input class="form-control" type="text" name="txt_doc_resp" size="20" maxlength="45">
		</div>
		<div class="col-md-6">
			<label>&nbsp;</label>
                        <input class="form-control" type="text"  size="20" readonly maxlength="0" name="">
		</div>
		<div class="col-md-6">
			<label>Perda de Material no Transporte ?</label><br>
			<input type="radio" name="txt_baixa" value="1" >Sim 
			<input type="radio" name="txt_baixa" value="0" checked>Não <br>
		</div>
		<div class="col-md-6">
			<label>Motivo:</label>
                        <textarea class="form-control" name="txt_motivo" id="" row="4" value="" class="" title="Motivo Perda ex. estrada ruim" maxlength="155"></textarea>
		</div>
		<div class="col-md-12">
			<label>Observação:</label>
                        <textarea class="form-control" rows="4" name="txt_obs" maxlength="155"></textarea>
		</div>
	</div>
	<div class="col-md-6">
            <legend>Materiais da Transferência</legend>
				<table class="table table-bordered">
							<tr>
								<td>Cod</td>
								<td>Material</td>
								<td>Descrição</td>
								<td>Quantidade</td>
							</tr>
				<?php
	
					for($i=0; $i < count($_lista_material) ; $i++) { 
						

						print "<tr>
									<td>".$_lista_material[$i]['id_produto']."</td>
									<td>".$_produto->PegaNomeProduto($_lista_material[$i]['id_produto'])."</td>
									<td>".$_lista_material[$i]['descricao']."</td>
									<td>".$_lista_material[$i]['quantidade']."</td>
							</tr>";

					}
				?>
				</table>

	</div>
	<div class="col-md-12">
            <br><br>
		<input class="btn btn-primary" type="submit" value="Receber" name="btn_enviar" onClick="return confirm('Confirmar o Recebimento de Material ?');" title="Receber Material" />
	</div>
            
</form>
        <?=FuncaoBase::voltar(); ?><br><br>

	<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#txt_dtChegada").datepicker({ dateFormat: 'dd/mm/yy' });

	});



</script>