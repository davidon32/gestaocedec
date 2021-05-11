<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';
	
	$_conexao = new ConexaoMysql();

	$_login = new Login();

	$_login->logado();
	
	$_login->Sessao();

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

$_id_transferencia = isset($_GET['id']) ? (int)$_GET['id'] : null;	

// lista os materiais que foram transferidos
$_lista_material = $_transferencia->ListaItensTransferencia($_id_transferencia);
	
// busca os dados da transferencia realizar o recebimento
$_dados = $_transferencia->MaterialReceber($_id_transferencia);

//var_dump($_dados);

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo TITULO;?></title>
	<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		
</head>
<body>
    
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
	<div class="container">
		
		<!-- MENU -->
		<div class="row-fluid">
			<div class="span3">
			    <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
			<div class="span9">
			   
				<legend> Receber Materiais </legend>
				<form method="POST" action="index.php?modulo=ajuda&secao=recebimento&acao=valida&opcao=receber" id="frm_recebe" name="frm_recebe" >
				
				    <div class="span1">&nbsp;</div>
					<div class="span4">
						<label>Depósito Origem:</label>
						<input type="hidden" name="txt_id_transferencia" value="<?php print $_id_transferencia;?>">
						<input type="hidden" name="txt_id_dep_destino"   value="<?php print $_dados['id_dep_destino'];?>">
						<input type="text"   name="txt_depOrigem"        value="<?php print Deposito::PegaNomeDeposito($_dados['id_dep_origem']);?>" readonly="readonly"> 

						<label>Depósito Destino:</label>
						<input type="text" name="txt_depDestino" value="<?php print Deposito::PegaNomeDeposito($_dados['id_dep_destino']);?>"	readonly="readonly"></label>

						<label>Veiculo:</label>
						<input type="text" name="txt_veiculo" value="<?php print $_dados['veiculo'];?>" readonly="readonly">

						<label>Motorista:</label>
						<input type="text" name="txt_motorista" value="<?php print $_dados['motorista'];?>" readonly="readonly">

						<label>Placa:</label>
						<input type="text" name="txt_placa" value="<?php print $_dados['placa'];?>" readonly="readonly">	
					
					    <label>Saída:</label>
                        <input type="text" name="txt_dtSaida" value="<?php print DataMysql::extraiData($_dados['dt_saida']);?>" readonly="readonly">

                        <label>Horário:</label>
                        <input type="text" name="txt_hrSaida" value="<?php print DataMysql::extraiHora($_dados['dt_saida']);?>" readonly="readonly">
                                        

					</div>
					<div class="span4">

									

						
						<label>Chegada:</label>
						<input type="text" name="txt_dtChegada" data-mask="99/99/9999" >

						<label>Horário:</label>
						<input type="text" name="txt_hrChegada" id="mask-hora" data-mask="99:99">

						<label>Responsável:</label>
						<input type="text" name="txt_responsavel" size="40">
						
						<label>Nº Polícia/Identificação:</label>
                        <input type="text" name="txt_doc_resp" size="20">
                            
                        <label>Observação:</label>
                        <textarea rows="4" name="txt_obs"></textarea>

                        <label>Baixa:</label>
                        <input type="text" name="txt_baixa" size="4" value="0" title="Numero de Perda de Materiais com o Transporte">
                            
                        <label>Motivo:</label>
                        <textarea name="txt_motivo" id="" row="4" value="" class="" title="Motivo Perda ex. estrada ruim"></textarea>
                        					
					</div>
					
					

						

						



						
				</div>
		
		</div>
		<div class="span12 text-center"><input class="btn btn-primary" type="submit" value="Receber" name="btn_enviar" onClick="return confirm('Confirmar o Recebimento de Material ?');" title="Receber Material" />
			<br /><br /></div>
			
				</form>
		<div class="row">
			<div class="span3"></div>
			<div class="span9">

				<table class="table">
							<tr>
								<td>Material</td>
								<td>Descrição</td>
								<td>Quantidade</td>
							</tr>
				<?php
	

					for($i=0; $i < count($_lista_material) ; $i++) { 
						

						print "<tr>
									<td>".$_produto->PegaNomeProduto($_lista_material[$i]['id_produto'])."</td>
									<td>".$_lista_material[$i]['descricao']."</td>
									<td>".$_lista_material[$i]['quantidade']."</td>
							</tr>";

					}
				?>

			</div>
				</div>

		</div>
	</div>
					
</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>

</body>
</html>
