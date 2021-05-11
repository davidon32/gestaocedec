<?php include_once PATH.'/include.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/proj.portal_cedec/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="/proj.portal_cedec/js/jquery.price_format.1.7.js"></script>
		<script type="text/javascript" src="/proj.portal_cedec/mod_pipa/js/calculo_rota.js"></script>
		<script type="text/javascript" src="/proj.portal_cedec/js/funcaobase.js"></script>

	</head>

<?php

		
	
		?>
<body>
	
	<div class="titulo">
		Cadastro de Rota
	</div>
	<form action="valida.cadastro.rota.php" method="post" name="frm_cad_rota" id="frm_cad_rota">
		<fieldset class="cad">
		
		<table border="1">
			<tr>
				<td>
					<label>Nova Rota</label>:<input type=checkbox name="cn_rota" id="cn_rota" onchange="hide_caixa()" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Número Rota</label>
					<input type="text" name="num_rota" id="num_rota" size="10" value="" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Motorista</label>
					<?php Motorista::MotoristaSemRota();?>
				</td>
			</tr>
			<tr>
				<td>
					<label>Município</label>:
					<?php Municipio::PegaMunicipio();?>
				</td>
			</tr>
			<tr>
				<td>
					<label>Comunidade</label>
					<select name="comunidade" id="comunidade">
					<option></option>
					<option>Distrito de Itamarati</option>
					<option>Angicão</option>
					<option>Mumbuca</option>
					<option>São Domingos</option>
					<option>Pov de Abacaxí</option>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<label>Situação</label>
					<input type="text" name="situacao" id="situacao" size="10" value="" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Reservatório</label>
					<select name="reservatorio" id="reservatorio">
					<option></option>
					<option>Copasa</option>
					<option>Rio</option>
					<option>Manancial</option>
					</select>	
				</td>
			</tr>
			
			<tr>
				<td>
				
				</td>
			</tr>
		</table>
		<br />
		
		<table border="1">
		
			<tr>
				<td>
					<label>Necessita de Trator/ Reboque</label>
					<input type="checkbox" name="ck_tator" id="ck_trator" onclick="" onchange="vr_trator()" />
				</td>
			</tr>
			<tr>
				<td>
					<label id="lb_trator">Trator</label>
					<input type="text" name="trator" id="trator" value="0" onchange="vr_momento()" />
					<label id="lb_asfalto">Asfalto</label>
					<input type="text" name="asfalto" id="asfalto" value="0" onchange="vr_momento()" />
					<label id="lb_terra">Terra</label>
					<input type="text" name="terra" id="terra" value="0" onchange="vr_momento()" />
				</td>
			</tr>
			<tr>
				<td><label>Distância Percorrida</label>
				<input type="text" name="km" id="km" size="10" onfocus="distanciaTotal()"/>
			</td>
			</tr>
			
			<tr>
				<td>
					<label>Momento de Transporte</label>
					<input type="text" name="momento" id="momento" size="10" /><input type="text" name="m_des" id="m_des" size="45"/>
				</td>
			</tr>
			
			<tr>
				<td>
					<label>População Atendida</label>
					<input type="text" name="pop" id="pop" size="10" onblur="necessidade()" />
				</td>
			</tr>

			<tr>
				<td>
				<label>Necessidade Àgua</label>
				Diária:<input type="text" name="necessidade_d" id="necessidade_d" size="10" />
				Mensal:<input type="text" name="necessidade_m" id="necessidade_m" size="10" />
				</td>
			</tr>
			
			<tr>
				<td>
				<label>Capacidade do Caminhão</label>
				<input type="text" name="capacidade" id="capacidade" size="10" onblur="nr_viagem()"/>
				</td>
			</tr>
			
			<tr>
				<td>
				<label>Nº de Viagens</label>
				<input type="text" name="n_viagem" id="n_viagem" size="20" />
				</td>
			</tr>
			
			<tr>
				<td>
				<label>Nº Real de Viagens</label>
				<input type="text" name="viagem_real" id="viagem_real" size="20" value="0" onblur="valorFinal()"/>
				</td>
			</tr>
			
			<tr>
				<td>
				<label>Local Contrato</label>
				<select name="local_contrato" id="local_contrato" onchange="valorFinal()">
				<option></option>
				<option>Araçuaí</option>
				<option>Montes Claros</option>
				<option>Teófilo Otoni</option>
				</select>
				</td>
			</tr>
			
			<tr>
				<td>
				<label>Valor Rota</label>
				<input type="text" name="vr_rota" id="vr_rota" size="10" />
				</td>
			</tr>
			
			<tr>
				<td>
				<input type="submit" name="cad_rota" value="Cadastrar"/>
				</td>
			</tr>
		</table>
	</form>

</body>
</html>