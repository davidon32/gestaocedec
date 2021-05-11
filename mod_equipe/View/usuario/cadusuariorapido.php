

<form action="#" method="POST" name="frmCadUserRapido" id="frmCadUserRapido">
	<label>
		Numero Policia
		<imput type="text" name="txtNumPol" id="txtNumPol" maxlenght="9">
	</label>
	<label>
		Nome Completo
		<imput type="text" name="txtNome" id="txtNome" maxlenght="9">
	</label>
	<label>
		Usuario (alternativo S999999)
		<imput type="text" name="txtUsuario" id="txtUsuario" maxlenght="9">
	</label>
	<label>
		SETOR
		<select name="selSetor" id="selSetor">
		<option>CEDEC</option>
		<option>GMG</option>
	</label>
	<label>
		email
		<imput type="email" name="txtEmail" id="txtEmail">
	</label>
</form>


<?php



	$cadFunctionario = "INSERT INTO cedec_funcionario FROM gestaocedec (`num_masp`, `nome`, `orgao`) VALUES ('0145495-5', 'MARCIA GOMES MAGALHAES', 'GMG');



INSERT INTO cedec_usuario from gestaocedec (`id_deposito`, `nome`, `email_rec`, `nivel`, `situacao`, `login`, `it_m_deposito`) VALUES (1, 'CB MARCIA', 'marcia.magalhaes@gabinetemilitar.mg.gov.br', 1, 1, 'S145495', '0');

UPDATE `gestaocedec`.`cedec_usuario` SET `it_m_pipa`='0',
 `it_m_cce`='0',
 `it_m_decretacao`='0',
 `it_m_comdec`='1',
 `it_m_apoio`='0',
 `it_m_poco`='0',
 `it_m_escola`='0',
 `trsenha`='0',
 `id_funcionario`=179,
 `cedec_admin`='0' WHERE

INSERT INTO `gestaocedec`.`com_permissao` (`login`, `nivel`, `cad_comdec`, `cad_consulta`, `cad_rel`, `alt_comdec`, `admuser`, `adduser`) VALUES ('S145495', 1, 0, 1, 1, 1, 0, 0);"
?>