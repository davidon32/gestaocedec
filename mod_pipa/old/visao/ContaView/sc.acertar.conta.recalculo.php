<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once '../include.php';

$_conexao = new ConexaoMysql();

$_calculo = new Calculo();

if(isset($id_conta)) {
    
    if($_pessoa == "PF") {

	   //var_dump($id_conta);
	   $dados = $_calculo->buscaConta($id_conta);
       
    }
	
}else {

	header("Location: ?secao=conta&acao=acertar");
}

//var_dump($dados);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>

<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/calculo_rota.js"></script>
</head>
<body onload="load();">
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png">
			<hr>
		</div>
		<!-- BARRA -->
	    <div class="row-fluid">
	      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
	      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
	    </div>

	    <!-- LOGOUT -->
	    <div class="row-fluid">
	      <div class="span12 text-right">
	        <a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
	        <p>
	        <hr>
	      </div>
	    </div>
		<div class="row-fluid">
			<!-- MENU -->
			<div class="span3">
				<?php include_once 'visao/pipa.menu.php';?>
			</div>

			<!-- CORPO PARTE 1 -->
			<div class="span3">
				<legend>Dados do Calculo</legend>
				<form action="secao.php?secao=conta&acao=previaConta" method="POST" name="frm_calcula" id="frm_calcula">
					<!-- campo para guardar o nome do motorista -->
					<input type="hidden" name="id_mot" value="<?php print $dados['id_motorista']; ?>" />
					
					<!-- campo id conta  -->
					<input type="hidden" name="idC" value="<?php print $id_conta; ?>" />
					<input type="hidden" name="pessoa" value="<?php print $_pessoa; ?>" />
					<label>Placa</label>
					
					<!-- campo que retorna a placa do veiculo -->
					<input type="text" name="placa" id="placa" size="10" class="destaque" value="<?php print $dados['placa'] ;?>" readonly="readonly">
					
					<!-- retorna os meses em um select -->
					<label>Mês</label>
					<input type="text" name="mes" id="mes" value="<?php print FuncaoBase::numTomes($dados['mes']);?>" readonly="readonly" />
					
					<!-- ano de acerto de conta -->
					<input type="hidden" name="ano" id="ano" value="<?php print $dados['ano']?>" readonly="readonly" />
					
					<label>Data Acerto</label>
					<input type="text" name="dt_acerto" id="dt_acerto" class="mask-data" size="10" value="<?php print date("d/m/Y");?>" readonly="readonly"/>
					
					<label>Km</label>
					<input type="text" name="km" id="km" size="10" value="<?php print $dados['km']?>" onblur="valorFinal()">

					<label>Lote</label>
					<input type="text" name="lote" id="lote" size="5" value="<?php print $dados['lote'];?>" readonly="readonly"/>
	
					<div class="alert">
					Qtd Itens do Lote :<b><?php print $_calculo->getQtdItemLote($dados['lote']);?></b></div>
					
					<label>Observações</label>
					<textarea name="obs" id="obs" col="15" rows="4" value="">-</textarea>
					
					<label>Valor Rota</label>
					<input type="text" name="vr_rota" id="vr_rota" size="10" value="0" onblur="removeVirgula();" />
					
					<span style="color:red; font-weight:bold; font-size:15px">Atencão : Valor para recalculo de Impostos</span>
					
					<input class="btn btn-primary" type="button" name="calcular" value="Calcular" onclick="Confirmacao();" />
					<br /> Atenção : o valor digitado deve conter somente (.)ponto ou (,) no valor de centavos.

			</div>
					<div class="span3">
						<legend>Trecho (km)</legend>
												
							<label>Necessita Trator/Reboque</label>
							<input type="checkbox" name="ck_tator" id="ck_trator" onclick="" onchange="vr_trator()" />

							<label id="lb_trator">Trator</label>
							<input type="text" name="trator" id="trator" size="4" value="0" onchange="vr_momento()" />

							<label id="lb_asfalto">Asfalto</label>
							<input type="text" name="asfalto" id="asfalto" size="4" value="0" onchange="vr_momento()" />

							<label id="lb_terra">Terra</label>
							<input type="text" name="terra" id="terra" size="4" value="0" onchange="vr_momento()" />
							
							<label>Momento de Transporte</label> 
							<input type="text" name="momento" id="momento" size="10" value="<?php print $dados['momento'];?>" />
																					
							<label>Nº Real de Viagens</label>
							<input type="text" name="viagem_real" id="viagem_real" size="5" value="1" />

							
							
					</div>
			<!-- CORPO PARTE2 -->
			<div class="span3">
				<legend>Dados da Rota </legend>
	    		<label>Capacidade</label>
	    		<input type="text" name="capacidade" id="capacidade" size="7" value="<?php print $dados['capacidade'];?>" readonly="readonly" />
			</div>

				</form>
		
	</div>
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</body>
</html>
