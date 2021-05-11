<?php $id_session = session_id();
    if(empty($id_session)) session_start();

	include_once 'include.php';

    	$_loginEx = new LoginExterno();
    	
    	$_loginEx->logadoExterno(); 	
    	
    	$_loginEx->Sessao();
    	   	
	    $id_pmda = isset($_GET['param']) ? $_GET['param'] :"";
	
	    if(!empty($id_pmda)){
	    	
	    	$_SESSION['seguranca']['id_pmda'] = $id_pmda;
	    }
	    
		$id_municipio = isset($_SESSION['seguranca']['id_municipio']) ? $_SESSION['seguranca']['id_municipio'] :"";
		
		$municipio = new Municipio();

		$dados = $municipio->dadosMunicipio($id_municipio);

		//var_dump($dados);
	    
?>	
	<!DOCTYPE html>
	<html lang="pt-Br">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap3.3.2.min.css" rel="stylesheet"/>
	
	<style type="text/css">

		.plano th {
			background-color: #6c7ae0;
			border: 15px #6c7ae0;
		}
	
		a.itemMenu {
			font-size: 10px;
			text-decoration: none;
		}

        .versao{
            background:#e6e6ff;
            min-height: 600px;
            border-radius:6px;
            font-weight: bold;

        }
        .versao span {
            text-align:center !important;

        }
        .versao a{
                font-size: 12px;
            }

        

	</style>
	  </head>
	  <body>
	  		<?php include_once(PATH.'/ex/barra_usuario.php');?>
	  		
	  	<div class="container">

	  		<div class="col-xs-12 img-responsive">
	  			<!-- corpo -->
				  <h1>Conhecimentos Gerais</h1>

				<table class="table table-bordered">
					<tr>
						<th width="30%">Municipio</th>
						<td>:<?=$dados['nome'];?></td>
					</tr>
					<tr>
						<th>Habitantes</th>
						<td>:<?=$dados['populacao'];?></td>
					</tr>
					<tr>
								<td>
									<label for="txtMunicipio" class="control-label">Mesorregião</label>
								</td>
								<td>:
									<span><?=$dados['macroregiao'];?></span>
								</td>
							</tr>
				</table>
				
					<div class="form-group">
					<form action="#" method="POST" name="frmConhencimento" id="conhencimento">
						
					</div>
					
					<!-- Vias de acesso ao Município: -->
					<div class="form-group">
						<div id="tblViadeAcesso">
        					<?php
								include_once ("view_reg_plano.php");
							?>
        				</div>	

						<table class="table table-bordered">
							<tr>
								<th colspan="3" class="text-center">Bairros, regiões, distritos e comunidades (população por área de risco)</th>
							</tr>
							<tr>
								<td class="text-center" width="50%">Nome do bairro</td>
								<td class="text-center" colspan="2" width="50%">População estimada</td>

							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtAcesso" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
						</table>
						<!-- Características marcantes do relevo no município -->
						<div class="form-group">
							<label class="control-label" for="checkbox">Características marcantes do relevo no município</label><br>
							<label class="control-label" for="checkbox">(pode ser marcado mais de um item):</label>
							<div>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
									Planícies fluviais
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="duck">
									Plano
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Encostas
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Serrano
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Outros:____________________
							</label>
							</div>
						</div> 
						<!-- Problemas relacionados ao relevo no município -->
						<div class="form-group">
							<label class="control-label" for="checkbox">Problemas relacionados ao relevo no município</label><br>
							<label class="control-label" for="checkbox">(pode ser marcado mais de um item):</label>
							<div>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Deslizamento de encosta
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="duck">
									Inundação
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Erosão
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Enxurradas
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Outros:_____________________
							</label>
							</div>
						</div> 

						<!-- Características marcantes do clima no município -->
						<div class="form-group">
							<label class="control-label" for="checkbox">Características marcantes do clima no município</label><br>
							<label class="control-label" for="checkbox">(pode ser marcado mais de um item):</label>
							<div>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Tropical Úmido
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="duck">
									Semiárido
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									tropical de Altitude
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Outros:_____________________
							</label>
							</div>
						</div> 

						<!-- Problemas relacionados ao clima no município -->
						<div class="form-group">
							<label class="control-label" for="checkbox">Problemas relacionados ao clima no município</label><br>
							<label class="control-label" for="checkbox">(pode ser marcado mais de um item):</label>
							<div>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Chuvas concentradas
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="duck">
									Seca
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Geada
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Chuva de Granizo
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Chuvas Torrenciais
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Frentes Frias
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Tempestade com raios
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Outros:_____________________
							</label>
							</div>
						</div> 

						<!-- Problemas relacionados com a expansão, ocupação e acesso do município: -->
						<div class="form-group">
							<label class="control-label" for="checkbox">Problemas relacionados com a expansão, ocupação e acesso do município:</label><br>
							<label class="control-label" for="checkbox">(pode ser marcado mais de um item):</label>
							<div>

								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Ocupação em áreas de risco de inundação
								</br>

								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Saneamento precário em alguns localidades
	

								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Dificuldades com coleta de lixo
							</br>

								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Dificuldades na destinação e no tratamento de esgoto
							</br>

								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Ocupação em áreas de risco de encosta
							</br>

								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Existência de comunidades isoladas com dificuldade de acesso
							</br>

								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Dificuldades com destinação e tratamento de lixo
							</br>

								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Outros: _________________________
							</br>
							
							</div>
						</div>

						<!-- PIB e principais atividades econômicas desenvolvidas -->
						<div class="form-group">
							<label class="control-label" for="checkbox">PIB e principais atividades econômicas desenvolvidas</label><br>
							<label class="control-label" for="checkbox">Valor do PIB (R$): R$ 1.000.000,00</label>
							<label class="control-label" for="checkbox">Indicação das principais atividades econômicas ou principais fontes de emprego no município (pode ser marcada mais de uma opção):</label>
							<div>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Serviço Público
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="duck">
									Turismo
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Pecuária
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Comércio
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Agricultura Familiar
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Prestadores de Serviço
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Indústria
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Grandes produtores agrícolas
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Mineração
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Outros:_____________________
							</label>
							</div>
						</div>

						<!--Quais são as indústrias, em funcionamento no município, e os respectivos produtos delas e os riscos que envolvem:  -->
						<table class="table table-bordered">
							<tr>
								<td colspan="5" class="text-center">Quais são as indústrias, em funcionamento no município, e os respectivos produtos delas e os riscos que envolvem:</td>
							</tr>
							<tr>
								<th class="text-center" width="30%">Nome</th>
								<th class="text-center" width="20%" colspan="">Localização</th>
								<th class="text-center" width="30%">Produtos</th>
								<th class="text-center" width="15%" colspan="" >Riscos</th>
								<th class="text-center" width="5%" colspan="" >Ação</th>


							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtAcesso" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtAcesso" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtAcesso" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
							
						</table>

						<!-- Matriz Energetica -->
						<span>Matriz Energêtica</span><br>
						<span>Principal tipo de geração do Município</span><br>
						<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Cemig
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="duck">
									Produção Alternativa
							</label>

					<!-- Principais fontes de produção de energia (pode ser marcada mais de uma alternativa): -->
					<div class="form-group">
							<label class="control-label" for="checkbox">Principais fontes de produção de energia (pode ser marcada mais de uma alternativa):</label><br>							
							<div>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Hidroelétrica
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="duck">
								Solar
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Heólica
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Termoelétrica
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Nuclear
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Outros:_____________________
							</label>
							</div>
					</div>

					<!-- Problemas relacionados ao fornecimento de energia -->
					<div class="form-group">
							<label class="control-label" for="checkbox">Problemas relacionados ao fornecimento de energia</label><br>							
							<div>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
								Queda frequente no fornecimento
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="duck">
								Existência de comunidades ou localidades em que não há o fornecimento de energia
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="checkbox" checked="checked" value="fish">
									Outros:_________________________________
							</label>
							</div>
					</div>

					<!--Localização das subestações de energia do município ou locais de produção de energia independente:  -->
					<table class="table table-bordered">
							<tr>
								<td colspan="5" class="text-center">Localização das subestações de energia do município ou locais de produção de energia independente:</td>
							</tr>
							<tr>
								<th class="text-center" width="30%">Nome</th>
								<th class="text-center" width="20%" colspan="">Localização</th>
								<th class="text-center" width="5%" colspan="" >Ação</th>


							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtAcesso" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
							
					</table>

					<!-- Abastecimento de água e saneamento básico-->
					<span>Abastecimento de água e saneamento básico</span>

					<div class="form-group">
							<label class="control-label" for="checkbox">Forma de abastecimento de água e saneamento básico: </label><br>							
							<div>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
									COPASA
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="duck">
									SAAE (Serviço Autônomo de Água e Esgoto)
								</label>
							
							</div>
					</div>

					<!--Localização das subestações de tratamento de água e esgoto do município  -->
					<table class="table table-bordered">
							<tr>
								<td colspan="5" class="text-center">Localização das subestações de energia do município ou locais de produção de energia independente:</td>
							</tr>
							<tr>
								<th class="text-center" width="30%">Nome</th>
								<th class="text-center" width="20%" colspan="">Localização</th>
								<th class="text-center" width="5%" colspan="" >Ação</th>


							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtAcesso" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
							
					</table>

					<span>Telefonia móvel e fixa:</span><br>
					
					<!-- Operadoras móveis e fixas que têm cobertura no município (pode ser marcada mais de uma alternativa):-->
					<span>Operadoras móveis e fixas que têm cobertura no município (pode ser marcada mais de uma alternativa):</span><br>

					<div class="form-group">
							<label class="control-label" for="checkbox">Forma de abastecimento de água e saneamento básico: </label><br>							
							<div>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
									OI
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
									TIM
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="duck">
									VIVO
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
									Claro
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
									ALGAR
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
									CTBC
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
									Outros :____________________________
								</label>
							
							</div>
					</div>

					<!--Se houverem bairros ou comunidades em que não haja cobertura telefônica, indique-as no quadro abaixo:  -->
					<table class="table table-bordered">
							<tr>
								<td colspan="5" class="text-center">Se houverem bairros ou comunidades em que não haja cobertura telefônica, indique-as no quadro abaixo:</td>
							</tr>
							<tr>
								<th class="text-center" width="30%">Nome do bairro ou comunidade</th>
								<th class="text-center" width="5%" colspan="" >Ação</th>
							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
							
					</table>


					<span>Rádio Amador</span>
					<!-- Radio Amador -->
					<div class="form-group">
							<label class="control-label" for="checkbox">Existem operadores de rádio amador no município: </label><br>							
							<div>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="rabbit">
									Não
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="checkbox" checked="checked" value="duck">
									Sim (se sim, preencha o quadro abaixo)
								</label>
							
							</div>
					</div>

					<table class="table table-bordered">
							<tr>
								<td colspan="5" class="text-center">Se houverem bairros ou comunidades em que não haja cobertura telefônica, indique-as no quadro abaixo:</td>
							</tr>
							<tr>
								<th class="text-center" width="30%">Nome do Operador</th>
								<th class="text-center" width="30%">Identificação do canal utilizado</th>
								<th class="text-center" width="5%" colspan="" >Ação</th>
							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
							
					</table>

					<!-- Mídia (radio, TV, etc) existente no munícipio: -->
					<span>Mídia (radio, TV, etc) existente no munícipio:</span>

					<table class="table table-bordered">
							<tr>
								<td colspan="5" class="text-center">Identifique os canais de mídia existentes no município:</td>
							</tr>
							<tr>
								<th class="text-center" width="30%">Nome</th>
								<th class="text-center" width="30%">Contato</th>
								<th class="text-center" width="5%" colspan="" >Ação</th>
							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
							
					</table>


					<!-- Diagnóstico das unidades hospitalares e/ou pronto atendimentos do município: -->

					<table class="table table-bordered">
							<tr>
								<td colspan="5" class="text-center">Diagnóstico das unidades hospitalares e/ou pronto atendimentos do município:</td>
							</tr>
							<tr>
								<th class="text-center" width="25%">Nome</th>
								<th class="text-center" width="20%">Localização</th>
								<th class="text-center" width="20%">Especialização e horário de funcionamento</th>
								<th class="text-center" width="20%">Capacidade máxima de atendimento imediato</th>
								<th class="text-center" width="15%" colspan="" >Ação</th>
							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
							
					</table>


					<!-- Nomes dos hospitais, localizados em outros municípios, aos quais os pacientes são encaminhados ou que a própria população procura para atendimento: -->

					<table class="table table-bordered">
							<tr>
								<td colspan="5" class="text-center">Nomes dos hospitais, localizados em outros municípios, aos quais os pacientes são encaminhados ou que a própria população procura para atendimento:</td>
							</tr>
							<tr>
								<th class="text-center" width="30%">Nome do hospital</th>
								<th class="text-center" width="30%">Município de localização do município</th>
								<th class="text-center" width="30%">Contato</th>
								<th class="text-center" width="5%" colspan="" >Ação</th>
							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
							
					</table>

					<!-- Diagnóstico das unidades escolares e locais que poderão ser utilizados como abrigos: -->

					<table class="table table-bordered">
							<tr>
								<td colspan="5" class="text-center">Diagnóstico das unidades escolares e <br>locais que poderão ser utilizados como abrigos:</td>
							</tr>
							<tr>
								<th class="text-center" width="25%">Nome</th>
								<th class="text-center" width="20%">Localização</th>
								<th class="text-center" width="20%">Descrição (Acomodações e capacidade)</th>
								<th class="text-center" width="20%">Contato do responsável pela chave do local</th>
								<th class="text-center" width="15%">Ação</th>
							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
							
					</table>

					<!-- Histórico de eventos adversos e desastres no município -->

					<table class="table table-bordered">
							<tr>
								<td colspan="3" class="text-center">Histórico de eventos adversos e desastres no município</td>
							</tr>
							<tr>
								<th class="text-center" width="45%">Ano</th>
								<th class="text-center" width="45%">Descrição</th>
								<th class="text-center" width="10%" colspan="" >Ação</th>
							</tr>
							<tr>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td class="text-center"><input type="text" name="txtMunicipio" class="form-control"></td>
								<td><button class="btn" onclick="AddTableRow()" type="button">Add</button></td>
							</tr>
							
					</table>

					



					<!-- fim -->						
					</div> 
					<div class="form-group">
						<button name="submit" type="submit" class="btn btn-primary">Submit</button>
					</div>
					</form>
					
	  		</div>
            
	  	</div>
        
<script src="js/jquery-1.12.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap3.3.2.min.js"></script>
<script src="js/jasny-bootstrap_bs3.js"></script>
<script src="js/jquery.easy-autocomplete.js"></script>
<script src="js/lib/thickbox.js"></script>
<script src="js/funcaobase.js"></script>
<script>

$(document).ready(function(){

/****************************************************    INICIO VIAS DE ACESSO ******************************************************/
(function($) {
	AddViasdeAcesso = function(tabela) {

			var newRow = $("<tr>");
			var cols = "";
			var i = $("#vias_de_acesso tr").length;

			cols += '<td>'+ (i-1) +'</td>';
			cols += '<td id="campo1'+ i +'">Insira o nome dos Municipios próximos</td>';
			cols += '<td  id="campo2'+ i +'" onblur="GravaViasdeAcesso()">Adicione as vias de Acesso </td>';
			cols += '<td>';
			cols += '<button class="btn" onclick="AddViasdeAcesso()" type="button" title="Adicionar Linha"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button> ';
			cols += '<button class="btn" onclick="GravaViasdeAcesso()" type="button" title="Gravar Alteração"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>';
			cols += '<button class="btn" onclick="RemoveViasdeAcesso(this)" type="button" title="Remover Linha"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
			cols += '</td>';

			newRow.append(cols);
			$("#vias_de_acesso").append(newRow);

			$("#campo1"+ i).addClass("editavel");
			$("#campo2"+ i).addClass("editavel");
			
				/* tabela editavel */
				$("td.editavel").on('dblclick', function () {
					var conteudoOriginal = $(this).text();
					
					$(this).addClass("celulaEmEdicao");
					$(this).html("<input type='text' value='" + conteudoOriginal + "' class='form-control'/>");
					$(this).children().first().focus();

					$(this).children().first().keypress(function (e) {
						if (e.which == 13) {
							var novoConteudo = $(this).val();
							$(this).parent().text(novoConteudo);
							$(this).parent().removeClass("celulaEmEdicao");
						}
					});
					
				$(this).children().first().blur(function(){
					$(this).parent().text(conteudoOriginal);
					$(this).parent().removeClass("celulaEmEdicao");
				});
				});

			return false;
	};
	
})(jQuery);

(function($) {
	RemoveViasdeAcesso = function(item) {
    var tr = $(item).closest('tr');

    tr.fadeOut(400, function() {
      tr.remove();  
    });

    return false;
  }
})(jQuery);

(function($) {

	GravaViasdeAcesso = function() {

		var tabela, tr;
		var $dados = [];

	
		tabela = document.getElementById("vias_de_acesso");
		tr  = tabela.getElementsByTagName("tr");

		for (i = 0; i < tr.length; i++) {
                municipio = tr[i].getElementsByTagName("td")[1];
                acesso = tr[i].getElementsByTagName("td")[2];
				if(($(municipio).text() === "") && ($(acesso).text() === "")){
				}else {
					$dados.push([$(municipio).text(), $(acesso).text(), getUrlVars()['id']]);
				}
		}

		var dadAjax = JSON.stringify($dados);;

		$.ajax({
        url: 'mod_compdec/app/plano/process.php',
        type: 'POST',
		data: {
				dadAjax: dadAjax,
				'identificador': 'viasAcesso'
			  },

        success: function (response) {
			// if(response == 'duplicado'){
			// 	alert('Este registro já está cadastrado !');
			// }
			// $("#tblViadeAcesso").load("mod_compdec/app/plano/view_reg_plano.php?id="+getUrlVars()['id']);
			console.log(response);
			
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown, "-");
        }
    	});
	}

	return false;

})(jQuery);


/******************  FIM VIAS DE ACESSO **********************************************/


/* tabela editavel */
$("td.editavel").dblclick(function () {
	var conteudoOriginal = $(this).text();
	
	$(this).addClass("celulaEmEdicao");
	$(this).html("<input type='text' value='" + conteudoOriginal + "' class='form-control'/>");
	$(this).children().first().focus();

	$(this).children().first().keypress(function (e) {
		if (e.which == 13) {
			var novoConteudo = $(this).val();
			$(this).parent().text(novoConteudo);
			$(this).parent().removeClass("celulaEmEdicao");
		}
	});
				
		$(this).children().first().blur(function(){
			$(this).parent().text(conteudoOriginal);
			$(this).parent().removeClass("celulaEmEdicao");
		});
});


});
</script>

</body>
</html>
	  	
	