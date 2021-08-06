<?php include_once '../../include.php';

	$_conexao = new ConexaoMysql();
	
	Login::Logado();
	
	$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
	
	$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
	
	$dados = Relatorio::RelatorioCadastroMotorista($cpf, $nome);

	FuncaoBase::vd($dados);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<link href="../css/relatorio.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../../js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="../../js/mascara.js"></script>
	</head>
	<body>
	
	<table border="1" width="700" cellspacing="0" cellpadding="0">
  <tr>
    <th colspan="7">Ficha Cadastral de Motorista</th>
    
    
  </tr>
  	<?php for ($i = 0; $i < count($dados); $i++) {
  		
  	?>
  	<tr>
    	<td class="titulo">Código</td>
    	<td class="titulo">Nome</td>
    	<td class="titulo">Endereço</td>
    	<td class="titulo">Bairro</td>
    	<td class="titulo">Cidade</td>
    	<td class="titulo">email</td>
    	<td class="titulo">Cep</td>
    </tr>
  <tr>
    <td><?php print utf8_encode($dados[$i]['id_motorista']);?></td>
	<td><?php print utf8_encode($dados[$i]['nome']);?></td>
	<td><?php print utf8_encode($dados[$i]['endereco']);?></td>
	<td><?php print utf8_encode($dados[$i]['bairro']);?></td>
	<td><?php print utf8_encode($dados[$i]['cidade']);?></td>
	<td><?php print utf8_encode($dados[$i]['email']);?></td>
	<td><?php print utf8_encode($dados[$i]['cep']);?></td>
</tr>
<tr>
    	<td class="titulo">Estado</td>
    	<td class="titulo">Telefone</td>
    	<td class="titulo">Cel</td>
    	<td class="titulo">CPF/CNPJ</td>
    	<td class="titulo">C.I</td>
    	<td class="titulo">Orgão</td>
    	<td class="titulo">Inscrição Est.</td>
</tr>
<tr>
	<td><?php print utf8_encode($dados[$i]['uf']);?></td>
	<td><?php print utf8_encode($dados[$i]['tel']);?></td>
	<td><?php print utf8_encode($dados[$i]['cel']);?></td>
	<td><?php print utf8_encode($dados[$i]['cpf_cnpj']);?></td>
	<td><?php print utf8_encode($dados[$i]['rg']);?></td>
	<td><?php print utf8_encode($dados[$i]['orgao']);?></td>
	<td><?php print utf8_encode($dados[$i]['inscr_est']);?></td>
	
</tr>
<tr>
	<td class="titulo">Pis/Pasep</td>
	<td class="titulo">CNH</td>
	<td class="titulo">INSS</td>
	<td class="titulo">Inscrição Mun.</td>
	<td class="titulo">Nit</td>
	<td class="titulo">Banco</td>
	<td class="titulo">Agência</td>
</tr>
<tr>
	<td><?php print utf8_encode($dados[$i]['pis_pasep']);?></td>
	<td><?php print utf8_encode($dados[$i]['cnh']);?></td>
	<td><?php print utf8_encode($dados[$i]['inss']);?></td>
	<td><?php print utf8_encode($dados[$i]['inscr_mun']);?></td>
	<td><?php print utf8_encode($dados[$i]['nit']);?></td>
	<td><?php print utf8_encode($dados[$i]['banco']);?></td>
	<td><?php print utf8_encode($dados[$i]['agencia']);?></td>
	
	
</tr>
<tr>
	<td class="titulo">Conta</td>
	<td class="titulo">Tipo</td>
	<td class="titulo">Mun Banco</td>
	<td class="titulo">Pessoa</td>
	<td class="titulo">Nome Rep</td>
	<td class="titulo">Cpf Rep</td>
	<td class="titulo">C.I rep</td>
</tr>
<tr>
	<td><?php print utf8_encode($dados[$i]['conta']);?></td>
	<td><?php print utf8_encode($dados[$i]['tipo']);?></td>
	<td><?php print utf8_encode($dados[$i]['mbanco']);?></td>
	<td><?php print utf8_encode($dados[$i]['pessoa']);?></td>
	<td><?php print utf8_encode($dados[$i]['nome_rep']);?></td>
	<td><?php print utf8_encode($dados[$i]['cpf_rep']);?></td>
	<td><?php print utf8_encode($dados[$i]['rg_rep']);?></td>
	
	
</tr>
<tr>
	<td class="titulo">Orgão Rep</td>
	<td class="titulo">Est. Civil</td>
	<td class="titulo">Natur. Rep.</td>
	<td class="titulo">Pai</td>
	<td class="titulo">Mãe</td>
	<td class="titulo">Placa</td>
	<td class="titulo">Dt. Nasc.</td>
</tr>
<tr>
	<td><?php print utf8_encode($dados[$i]['orgao_rep']);?></td>
	<td><?php print utf8_encode($dados[$i]['est_civil_rep']);?></td>
	<td><?php print utf8_encode($dados[$i]['natural_rep']);?></td>
	<td><?php print utf8_encode($dados[$i]['pai']);?></td>
	<td><?php print utf8_encode($dados[$i]['mae']);?></td>
	<td><?php print utf8_encode($dados[$i]['placa']);?></td>
	<td><?php print utf8_encode($dados[$i]['dt_nasc']);?></td>
</tr>
<tr>
	<td colspan="7"><p></td>
</tr>
	
	<?php
		}
	?>

</table>
	
	</body>
</html>
<?php
