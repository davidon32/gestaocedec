<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Strict//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">";
	include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_liberacao = new Liberacao();

$_txt_dt_inicial = isset($_POST['txt_dt_inicial']) ? DataMysql::dataForm(htmlentities(htmlspecialchars($_POST['txt_dt_inicial']))) : "";

$_txt_dt_final   = isset($_POST['txt_dt_final'])   ? DataMysql::dataForm(htmlentities(htmlspecialchars($_POST['txt_dt_final']))) : "" ;

$_txt_municipio  = isset($_POST['id_municipio'])   ? $_POST['id_municipio'] : "";

$_txt_deposito   = isset($_POST['id_deposito'])    ? $_POST['id_deposito'] : "" ;

$_txt_material   = isset($_POST['id_produto'])     ? $_POST['id_produto'] : "";

$_btn_enviar     = isset($_POST['btn_enviar'])     ? true : "";

//var_dump($_POST);

if($_btn_enviar) {

	$_mat_pago = RelatorioAju::MaterialPago($_txt_dt_inicial,
			$_txt_dt_final,
			$_txt_municipio,
			$_txt_deposito,
			$_SESSION['seguranca']['nivel'],
			$_txt_material);
	
}
	
//var_dump($_mat_pago);

	?>
<html>
<head>
<title><?php print TITULO; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/css/bootstrap.css" rel="stylesheet">
<link href="/css/bootstrap-responsive.css" rel="stylesheet">
<style>
	
	@media print {
	
		#imprimir {
		
			display: none;
		
		}
	}
		
	</style>
</head>
<body>
	<div class="container">

	<table align="center" class="table" id="imprimir">
		<tr>
			<td style="text-align: center;">
			    <br>
				<?php FuncaoBase::vifs('volta', 'index.php?token='.hash('sha256', md5(VERSAO)).'&ac=&modulo=ajuda&secao=pagamento&acao=list_pgto_busca')."<br>".FuncaoBase::vifs('imprimir');?>
			</td>
		</tr>
	</table>
	<table class="table table-condensed" >
		<tr>
		    <td>
		        <img src="/imagem/logo_novo.png" alt="" class=""/><br>
		        <small>Data:<?php print date("d/m/Y");?></small>
		        <small> / <?php print date("H:s:m");?></small>
		        <legend>Relatório de Materais Pagos</legend>
		        Período : <?=($_txt_dt_inicial != "") ? $_txt_dt_inicial : "__/__/____"; ?> à <?=($_txt_dt_final != "") ? $_txt_dt_final : date('d/m/Y'); ?>
		        &nbsp;&nbsp;&nbsp;&nbsp;Dep.Origem: <?=($_txt_deposito != "") ? "<i>".Deposito::pegaNomeDeposito($_txt_deposito)."</i>" : "<i>Todos</i>";?>
		        &nbsp;&nbsp;&nbsp;&nbsp;Municipio : <?=($_txt_municipio != "0") ? "<i>".Municipio::PegaNomeMunicipio($_txt_municipio)."</i>" : "<i>Todos</i>"?>
		        <hr>
		    </td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<th style="font-size: 10px; text-align: center;">Nº</th>
			<th style="font-size: 10px; text-align: center;">Dt.Liberação</th>
			<th style="font-size: 10px; text-align: center;">Dt.Pagto</th>
			<th style="font-size: 10px; text-align: center;">Beneficiário</th>
			<th style="font-size: 10px; text-align: center;">Dep.Origem</th>
			<th style="font-size: 10px; text-align: center;">Destino</th>
			<th style="font-size: 10px; text-align: center;">Responsável</th>
			<th style="font-size: 10px; text-align: center;">CPF/CI</th>
			<th style="font-size: 10px; text-align: center;">Veículo</th>
			<th style="font-size: 10px; text-align: center;">Material</th>
		</tr>

		<?php
		for ($i =0; $i < count($_mat_pago); $i++) {
		    
		    print "<tr>
        			<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['id_liberacao']."</td>";
        	print "<td style='font-size: 10px; text-align: center;'>".DataMysql::dataVisual($_mat_pago[$i]['dataLibera'])."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".DataMysql::dataVisual($_mat_pago[$i]['dtPagto'])."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['beneficiario']."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".Deposito::pegaNomeDeposito($_mat_pago[$i]['depDestino'])."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".Municipio::PegaNomeMunicipio($_mat_pago[$i]['id_municipio'])."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['responsavel']."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['cpf_resp']."<br>".$_mat_pago[$i]['nDocumento']."</td>";
		    print "<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['veiculo']. "<br>". $_mat_pago[$i]['placa'].!"</td>";
            print "<td style='font-size: 10px; text-align: center;'>";
				Liberacao::ListaProdutos($_mat_pago[$i]['id_liberacao']);
            print "</td>";
			
            print "</tr>";
       }
?>

	</table>
	</div>
	<div class="row text-center">
		<small><?php print RODAPE;?></small>
	
	</div>
	<br />
</body>
</html>