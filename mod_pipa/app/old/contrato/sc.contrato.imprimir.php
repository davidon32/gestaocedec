<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/proj.portal_cedec/mod_pipa/css/contrato.css" />
<link rel="stylesheet" type="text/css" href="/proj.portal_cedec/mod_pipa/css/print.css"
	media="print" />

</head>
<body>

	<?php
	session_start();
	include_once '../classe/Class.Conexao.php';
	

	$con = new ConexaoMysql();

	date_default_timezone_set('Brazil/East');

	#@ data do contrato
	$dt_contrato = isset($_GET['dt_contrato']) ? $_GET['dt_contrato'] : null;
	
	#@ id do motorista
	$idMot = isset($_GET['id']) ? (int)$_GET['id'] : null;

	#@ dados do contrato
	$_dados = Pipeiro::BuscaPipeiro($idMot, $_GET['cpf']);

	//if($_SESSION['modo']){
		
		//FuncaoBase::vd($_GET);
		//FuncaoBase::vd($_dados);
		//FuncaoBase::vd($_SESSION);
	//}
	
	
	//$_tes1 = $_GET['tes1'];
	//$_tes2 = $_GET['tes2'];
	//$_cpf1 = $_GET['cpf1'];
	//$_cpf2 = $_GET['cpf2'];

	if($_dados[0]['mot'] == 'on') {

		$nomerep = $_dados[0]['nome'];
		$rg_mot = $_dados[0]['rg'];
		$cpf_mot = $_dados[0]['cpf_cnpj'];

	}else {

		$nomerep = $_dados[0]['nome_mot'];
		$rg_mot = $_dados[0]['rg_mot'];
		$cpf_mot = $_dados[0]['cpf_mot'];

	}


	#@ data e cidade no final do contrato

	function Local($_data) {
		if(($_data >= "01/08/2012") && ($_data <= "03/08/2012")){

			return "Montes Claros";

		}elseif (($_data >= "06/08/2012") && ($_data <= "07/08/2012")){

			return "Ara�ua�;";

		}elseif ($_data == "09/08/2012") {

			return "Te�filo Otoni";
		}


	}

	//FuncaoBase::vd(Local(DataMysql::dataVisual(date("Y/m/d"))));





	?>
	<div class="cabecalho">

		<a href="#" onclick="window.print();">Imprimir</a> <br /> <a
			href="sc.busca.gerar.contrato.php">Voltar</a>


	</div>
	<div>
		<img src="../imagens/cabecalho.png">
	</div>
	<br />
	<div class="corpo">
		<p class="titulo">
			CONTRATO DE PRESTAÇÃO DE SERVIÇOS N.° <span class="dados"> <?php print $_GET['n_contrato'] ; ?>
			</span> /2012
		</p>
		<br />
		<p class="primeiro">
			Contrato de prestação de serviços de pessoa física ou jurídica para o
			transporte e distribuição de água potável, para consumo humano,
			através de carros pipas, para atender os municípios mineiros
			assolados pela seca ou estiagem, no período que compreende fevereiro
			a novembro de 2012, que entre si celebram o Estado de Minas Gerais,
			através do Gabinete Militar do Governador e <span class="dados"><?php print htmlentities($_dados[0]['nome']); ?>
			</span>conforme regulamentação disposta no Edital de Credenciamento
			n.° 001/2012.
		</p>

		<p>
			<strong>O ESTADO DE MINAS GERAIS</strong>, através do <strong>GABINETE MILITAR DO GOVERNADOR</strong>,
			Pessoa Jurídica de Direito Público, inscrito no CNPJ sob o nº
			18.715.565/0001-10, situado na Cidade Administrativa Presidente
			Tancredo Neves, Rodovia Prefeito Americo Gianett, s/nº., Palácio
			Tiradentes, 2º andar, Bairro Serra Verde, Belo Horizonte/MG, neste
			ato representado pelo seu Chefe Coronel PM Luis Carlos Dias Martins,
			CPF nº. 532.151.686-34, doravante denominado <strong>TOMADOR</strong>, e a
			Empresa/Pessoa Física <span class="dados"><?php print htmlentities($_dados[0]['nome']); ?>
			</span> , inscrita no CNPJ/CPF sob n.º <span class="dados"><?php print htmlentities($_dados[0]['cpf_cnpj']); ?>
			</span>, com endereço na <span class="dados"><?php print htmlentities($_dados[0]['endereco']); ?>
			</span>, neste ato representada pelo(a) Sr.(a) <span class="dados"><?php print htmlentities($nomerep); ?>
			</span>, <span class="dados"><?php print htmlentities($_dados[0]['nac_mot']);?> </span>,
			<span class="dados"><?php print htmlentities($_dados[0]['est_mot']);?> </span>, <span
				class="dados"><?php print htmlentities($_dados[0]['prof_mot']);?> </span>,
			portador (a) do RG n.° <span class="dados"><?php print htmlentities($rg_mot);?> </span>
			e do CPF n.° <span class="dados"><?php print htmlentities($cpf_mot);?> </span>,
			doravante denominada(o) <strong>PRESTADOR</strong>, com base na Lei Nacional n.°
			8.666/93, no Processo de Inexigibilidade de Licitação n.° 04/2012 –
			GMG, no Parecer n.° 061/2012 da Assessoria Jurídica e no Edital de
			Credenciamento n.° 001/2012, c/c com as disposições previstas na Lei
			Nacional nº10.406/02-Código Civil, que dispõe acerca do contrato de
			prestação de serviços, RESOLVEM celebrar o presente Contrato de
			prestação de serviços, de acordo com as cláusulas e condições
			seguintes:
		</p>

		<p class="titulo">Cláusula Primeira - DO OBJETO</p>

		<p>Constitui objeto deste Contrato a prestação de serviço de
			transporte e distribuição de água potável, para consumo humano,
			através de carros pipas, para atender os municípios mineiros que
			tenham Decreto de Situação de Emergência ou de Estado de Calamidade
			Pública, devidamente editado pelo Prefeito Municipal e reconhecido
			pelo Governo do Federal, em virtude da seca ou da estiagem,
			registrada no período de fevereiro a novembro de 2012.</p>

		<p class="titulo">Parágrafo Único</p>

		<p>I - O prestador responsabiliza-se inteiramente pela legítima posse
			do veículo empregado na execução do contrato, bem como por eventuais
			direitos de terceiros em relação ao mesmo, sendo, ainda, de sua
			responsabilidade todos os encargos legais e contratuais relativos ao
			veículo empregado, o qual deve ser mantido nas condições apresentadas
			por ocasião da inspeção para fins de cadastramento.</p>

		<p class="titulo">II - Dados do veículo cadastrado:</p>

		<p>
			- Marca / Modelo / Ano Fabricação: <span class="dados"><?php print htmlentities($_dados[0]['marca']); ?>
			</span>, <span class="dados"><?php print htmlentities($_dados[0]['modelo']); ?> </span>,
			<span class="dados"><?php print htmlentities($_dados[0]['fabric']); ?> </span>
		</p>

		<p>
			- Chassi: <span class="dados"><?php print htmlentities($_dados[0]['chassi']); ?> </span>
		</p>
		<p>
			- Placa: <span class="dados"><?php print htmlentities($_dados[0]['placa']); ?> </span>
		</p>
		<p>
			- Capacidade da Pipa: <span class="dados"><?php print htmlentities($_dados[0]['capacidade']); ?>
			</span>&nbsp;&nbsp;(metros cúbicos).
		</p>
		
		<div class="rodape">
			<hr>
			<div class="l2">
				<div class="l1">
				Cristie Rosa de Gouvêa da Silva, OAB/MG 80.643 <br /> Assessora
				Jurídica-Chefe do GMG
			</div>
			</div>
			<br />


		</div>
		<!-- #####################################3  fim pagina -->
		<br /> <br /> <br /> <br />
		<br /> <br />
		<div class="topo">
			<img src="../imagens/cabecalho.png">
		</div>
		<br />
		<p class="titulo">Cláusula Segunda - DA FUNDAMENTAÇÃO</p>

		<p>O presente Contrato fundamenta-se:</p>

		<p>a) nas demais determinações da Lei Nacional nº. 8.666/93,
			especialmente o art. 25, caput;</p>

		<p>b) no Processo de Inexigibilidade de Licitação n.° 04/2012;</p>
		<p>c) no Parecer n.° 061/2012 da Assessoria Jurídica do GMG;</p>
		<p>d) no Edital de Credenciamento n.° 001/2012;</p>
		<p>e) nos preceitos do Direito Público;</p>
		<p>f) nas determinações da Lei Nacional nº10.406/02-CC, especialmente
			o art. 593 e seguintes;</p>
		<p>g) supletivamente, nos princípios da Teoria Geral dos Contratos e
			nas disposições do Direito Privado.</p>

		<p class="titulo">Cláusula Terceira – DA VIGÊNCIA DA PRESTAÇÃO DE
			SERVIÇOS
		
		
		<p>
		
		
		<p>Este Contrato tem prazo de vigência de 80 (oitenta) dias, a contar
			da data de sua assinatura, podendo ser prorrogado, a critério do
			TOMADOR, conforme disposto no art. 598 da Lei Nacional
			nº10.406/02-CC..</p>

		<p class="titulo">Cláusula Quarta – DA DOTAÇÃO ORÇAMENTÁRIA</p>

		<p>As despesas decorrentes desta contratação correrão por conta da
			dotação orçamentária: 1071.06.182.741.4262.0001.3390.0.57.1.</p>

		<p class="titulo">Cláusula Quinta – DAS ESPECIFICAÇÕES DO OBJETO E DOS
			PREÇOS A SEREM PAGOS</p>

		<p>I - As especificações do objeto do presente Contrato e respectivos
			preços a serem pagos pelo Gabinete Militar do
			Governador/Coordenadoria Estadual de Defesa Civil – CEDEC, são os
			seguintes:</p>

		<p>
		
		
		<table align="center" border="1" cellspacing="0">
			<tr>
				<td width="350"><center><strong>Objeto</strong></center></td>
				<td><center><strong>Critério para aferição de preços a serem pagos
						mensalmente</strong></center></td>
			</tr>
			<tr>
				<td><p align="justify">Transporte e distribuição de água potável,
						para consumo humano, através de carros pipas, previamente
						credenciados pela administração pública, para atender os
						municípios mineiros em Situação de Emergência ou Estado de
						Calamidade Pública, devidamente reconhecido pelo Governo Federal,
						em virtude da estiagem no período de fevereiro a novembro de 2012.


					
				
				</td>
				<td><center>(fórmula)</center> <br />
					<center>V = L x C x Km x N</center>
				</td>
			</tr>

		</table>
		<br />
		</p>

		<p>
			V = Valor;<br />
		
		
		<p>Volume em m³ (metros cúbicos) transportado de acordo com a
			VOLUME/M3;</p>

		<div class="rodape">
			<hr>
			<div class="l2">
				<div class="l1">
				Cristie Rosa de Gouvêa da Silva, OAB/MG 80.643 <br /> Assessora
				Jurídica-Chefe do GMG
			</div>
			</div>
			<br />


		</div>

		<!-- #############################  fim Da pagina ######################### -->
		<br /> <br /> <br /> <br /> <br />
		<div class="topo">
			<img src="../imagens/cabecalho.png">
		</div>
		<br />



		<p>C = Valor da carrada;</p>
		<p>Km = Quilometro percorrido entre o ponto de captação e o local de
			entrega da àgua;</p>
		<p>N = Números de carradas (viagens)</p>


		<p>II - O valor mensal devido pelos serviços executados será obtido
			por meio de medição realizada pela Administração, observando-se, em
			princípio, a menor distância entre os pontos pré-determinados pelo
			GPS instalado no veículo, multiplicando-se o número de viagens
			executadas, no período considerado, pelo preço unitário acima
			estabelecido - em conformidade com a(s) rota(s) determinada(s) na
			Ordem de Serviço, considerando o(s) tipo(s) de estrada(s), a
			quantidade de água transportada (em metros cúbicos) e a(s)
			distância(s) percorrida(s) (em quilômetros) entre o local de captação
			e o ponto final de descarga, conforme planilha abaixo:</p>


		<table border="1" width="600" cellspacing="0">
			<tr>
				<td><center><strong><font size="2"><font>MOMENTO DE TRANSPORTE:</font></strong></center></td>
				<td><center><strong>VALOR</strong></center></td>
			</tr>
			<tr>
				<td align="center"><font size="2">ESTRADA PAVIMENTADA</td>
				<td align="center"><font size="2">R$ 0,43 (quarenta e três centavos)</td>
			</tr>
			<tr>
				<td align="center"><font size="2">ESTRADA MISTA - MAIS PAVIMETADA QUE TERRA</td>
				<td align="center"><font size="2">R$ 0,45 (quarenta e cinco centavos)</td>
			</tr>
			<tr>
				<td align="center"><font size="2">ESTRADA MISTA - MAIS TERRA QUE PAVIMENTO</td>
				<td align="center"><font size="2">R$ 0,47 (quarenta e sete centavos)</td>
			</tr>
			<tr>
				<td align="center"><font size="2">ESTRADA NÃO PAVIMENTADA</td>
				<td align="center"><font size="2">R$ 0,49 (quarenta e nove centavos)</td>
			</tr>
			<tr>
				<td align="center"><font size="2">NECESSITA DE TRATOR / REBOQUE</td>
				<td align="center"><font size="2">R$ 0,93 (noventa e três centavos)</td>
			</tr>
		</table>



		<p>
			<strong> III – O PRESTADOR deverá cumprir o número pré-estabelecido
				de vezes para o transporte e distribuição de água potável para
				consumo humano, de acordo com a ROTA Nº <span class="dados"><?php print htmlentities($_dados[0]['rota']); ?>
			</span> do município <span class="dados"><?php print htmlentities($_dados[0]['municipio_rota']); ?>
			</span> e a quantidade de litros a serem entregues na localidade.
				(Anexo <span class="dados">VII</span>)
			</strong>.
		</p>

		<p class="titulo">Cláusula Sexta – DO PAGAMENTO</p>

		<p>I - O pagamento será efetuado, mensalmente, após liquidação da
			despesa, no prazo de até 30 (trinta) dias consecutivos, por meio de
			crédito no Cartão de Pagamento de Benefícios (CPB), ao PRESTADOR
			pessoa física, e através do Cartão de Pagamento de Defesa Civil
			(CPDC) ao PRESTADOR pessoa jurídica, sendo obrigatória para esta
			última a disponibilidade de máquina para o recebimento de cartão de
			crédito com a bandeira Visa, mediante a apresentação de Nota Fiscal,
			Fatura, Recibo de Pagamento Autônomo (RPA) ou planilha de serviço,
			devidamente certificada pelo Setor responsável pelo recebimento
			através de aferição via GPS, e sem que haja incidência de juros ou
			correção monetária.</p>

		<p>II - Para fazer jus ao pagamento de que trata o item anterior, o
			PRESTADOR deverá apresentar, juntamente com o documento de cobrança,
			prova de regularidade perante o Instituto Nacional do Seguro Social –
			INSS, perante o Fundo de Garantia por Tempo de Serviço - FGTS e
			certidões negativas de débitos perante a Fazenda Estadual e
			Municipal, sendo o FGTS dispensado para pessoas físicas.</p>

		<p>III - Na ocorrência de necessidade de providências complementares
			por parte do PRESTADOR, o decurso do prazo de pagamentos será
			interrompido, reiniciando-se sua contagem a partir da data em que
			estas forem cumpridas, caso em que não será devida atualização
			financeira.</p>
			
		<p>IV - Não haverá, em nenhuma hipótese, pagamento antecipado.</p>

		<p>V - No caso de atraso de pagamento será utilizado, para atualização
			do valor, o Índice Nacional de Preços ao Consumidor – INPC/IBGE.</p>

		<div class="rodape">
			<hr>
			<div class="l2">
				<div class="l1">
				Cristie Rosa de Gouvêa da Silva, OAB/MG 80.643 <br /> Assessora
				Jurídica-Chefe do GMG
			</div>
			</div>
			<br />


		</div>


		<!-- #############################  fim Da pagina ######################### -->
		<br /> <br /> <br /> <br /> <br />
		<div class="topo">
			<img src="../imagens/cabecalho.png">
		</div>
		<br />



		

		<p>VI - O TOMADOR não se responsabiliza por despesas efetuadas que não
			estejam dentro das especificações do objeto, estabelecidas na
			cláusula primeira deste instrumento.</p>

		<p class="titulo">Cláusula Sétima – DAS OBRIGAÇÕES DAS PARTES</p>

		<p>I - São obrigações do TOMADOR:</p>

		<p>a) efetuar o pagamento ao PRESTADOR de acordo com as condições
			estabelecidas neste instrumento;</p>
		<p>b) aplicar as penalidades por descumprimento do pactuado neste
			Contrato;</p>
		<p>c) promover a fiscalização e o acompanhamento da execução do objeto
			contratado;</p>
		<p>d) fiscalizar para que, durante a vigência do contrato, sejam
			mantidas as condições de habilitação e qualificação exigidas no
			Edital de Credenciamento n. 001/2012;</p>
		<p>e) emitir ordem de serviço autorizando o início dos trabalhos.</p>

		<p>II - São obrigações do PRESTADOR:</p>
		<p>a) apresentar veículo em perfeita condição de uso e licenciamento
			do Órgão Estadual de Trânsito em dia;</p>
		<p>b) observar a legislação de trânsito, conforme dispõe a Lei
			Nacional nº9.503/97-CTB;</p>
		<p>c) manter o veículo com manutenção mecânica, elétrica, pneus e
			chaparia em perfeitas condições de uso e de segurança;</p>
		<p>d) possuir reservatório tipo Pipa em perfeito estado de conservação
			e com volume mínimo de 6m³;</p>
		<p>e) cumprir, integralmente, sob pena de cancelamento do presente
			contrato, todas as cláusulas constantes deste instrumento e mais as
			do Edital de Credenciamento n. 001/2012;</p>
		<p>f) não fazer, ou permitir que se faça, qualquer tipo de propaganda
			política, quando da execução dos serviços, responsabilizando-se pelas
			vedações previstas na legislação eleitoral;</p>
		<p>g) abastecer a pipa apenas nos mananciais determinados ou
			autorizados pelo TOMADOR, responsabilizando-se por eventuais
			pagamentos de abastecimento da carga de àgua apanhada em manancial
			particular (poços artesianos, açudes, barragens, etc), quando assim
			for determinado. Nessa última hipótese o PRESTADOR deve atestar a
			qualidade da àgua ou se obrigar a colocar no tanque uma pastilha de
			hipoclorito de sódio a ser fornecido previamente pelo TOMADOR;</p>
		<p>h) é vedado ao PRESTADOR utilizar-se, a qualquer titulo, da
			contratação de terceiros para a execução dos serviços, objeto deste
			contrato;</p>
		<p>i) em caso de utilização do caminhão pipa para outros fins, o
			PRESTADOR se obriga a proceder à desinfecção do tanque, às suas
			custas;</p>
			<p>j) responsabilizar-se, com foros de exclusividade, pela observância
			a todas as normas estatuídas pela legislação trabalhista, social e
			previdenciária, tanto no que se refere a seus empregados, como a
			contratados e prepostos, responsabilizando-se, mais, por toda e
			qualquer autuação e condenação oriunda da eventual inobservância das
			citadas normas, aí incluídos acidentes de trabalho, ainda que
			ocorridos nas dependências do TOMADOR. Caso este seja chamado a juízo
			e condenado pela eventual inobservância das normas em referência, o
			PRESTADOR obriga-se a ressarci-lo do respectivo desembolso,
			ressarcimento este que abrangerá despesas processuais e honorários de
			advogado arbitrados na referida condenação;</p>


		<div class="rodape">
			<hr>
			<div class="l2">
				<div class="l1">
				Cristie Rosa de Gouvêa da Silva, OAB/MG 80.643 <br /> Assessora
				Jurídica-Chefe do GMG
			</div>
			</div>
			<br />


		</div>

		<!-- #############################  fim Da pagina ######################### -->
		<br /> <br /> <br /> <br /> <br />
		<div class="topo">
			<img src="../imagens/cabecalho.png">
		</div>
		<br />



		
		<p>k) cumprir, durante toda a execução do contrato, as obrigações
			assumidas, mantendo todas as condições de habilitação e qualificação
			exigidas na licitação;</p>


		<p>l) é de responsabilidade exclusiva e integral do PRESTADOR a
			utilização de pessoal para a execução do objeto, bem como os encargos
			trabalhistas, previdenciários, sociais, fiscais e comerciais
			resultantes de vínculo empregatício, cujo ônus e obrigações em
			nenhuma hipótese poderão ser transferidos para o TOMADOR;</p>
		<p>m) providenciar a imediata correção das deficiências apontadas pelo
			TOMADOR;</p>
		<p>n) é vedado substituir o veículo cadastrado, bem como o seu tanque,
			salvo em caráter excepcional mediante autorização do TOMADOR, após a
			devida vistoria;</p>


		<p>o) cumprir estritamente a rota definida e a distribuição de água
			nos termos deste contrato;</p>
		<p>p) arcar com eventuais prejuízos causados ao TOMADOR e/ou a
			terceiros, provocados por ineficiência ou irregularidade cometidas
			por seus empregados, contratados ou prepostos, envolvidos na execução
			do contrato;</p>
		<p>q) manter, durante a vigência do credenciamento, a regularidade do
			Cadastro de Pessoa Física (CPF) ou o Cadastro Nacional de Pessoa
			Jurídica (CNPJ);</p>
		<p>r) é vedado ao PRESTADOR trocar o manancial de captação da água sem
			prévia ciência e autorização do TOMADOR;</p>
		<p>s) comparecer obrigatoriamente ao local de credenciamento para a
			desinstalação do sistema GPS quando for convocado pelo TOMADOR;</p>
		<p>t) a água deverá ser desaguada pelo PRESTADOR com mangueira
			própria, dentro das cisternas, reservatórios ou caixas d’água, nos
			locais designados;</p>
		<p>u) o caminhão deverá apresentar total higiene, com bom estado de
			conservação do carro-pipa, seus acessórios, tais como tanque,
			eletro-bomba, e mangueiras que devem estar em perfeita conservação.</p>

		<p class="titulo">Cláusula Oitava – DAS INCIDÊNCIAS FISCAIS</p>

		<p>I - Os tributos, emolumentos, contribuições fiscais e parafiscais,
			custos e despesas que sejam devidos, em decorrência direta ou
			indireta do presente contrato, serão de exclusiva responsabilidade do
			contribuinte, assim definido na Norma Tributária.</p>
		<p>II - Ao aceitar os termos deste contrato, o PRESTADOR declara haver
			levado em conta os tributos, contribuições fiscais e parafiscais,
			encargos trabalhistas e todas as despesas incidentes sobre o objeto
			do presente Contrato, não cabendo quaisquer reivindicações devidas a
			erros nessa avaliação.</p>
		<p>III – Os tributos: INSS,imposto de renda e contribuição SEST/SENAT
			serão recolhidos pelo TOMADOR e descontados no ato do pagamento à
			pessoa física.</p>

		<div class="rodape">
			<hr>
			<div class="l2">
				<div class="l1">
				Cristie Rosa de Gouvêa da Silva, OAB/MG 80.643 <br /> Assessora
				Jurídica-Chefe do GMG
			</div>
			</div>
			<br />


		</div>


		<!-- #############################  fim Da pagina ######################### -->
		<br /> <br /> <br /> <br /> <br />
		<div class="topo">
			<img src="../imagens/cabecalho.png">
		</div>
		<br />

		<p class="titulo">Cláusula Nona – DAS SANÇÕES ADMINISTRATIVAS</p>

		<p>I - Pela inexecução total ou parcial do objeto estipulado neste
			Contrato, conforme o caso poderá ser aplicado ao PRESTADOR as
			seguintes sanções, garantida a prévia defesa: a) advertência;</p>
		<p>a) advertência;</p>
		<p>b) multa de 0,5% (zero vírgula cinco por cento) até o máximo de 10%
			(dez por cento), sob o valor do não fornecimento injustificado dos
			serviços descritos na cláusula primeira deste instrumento;</p>
		<p>c) declaração de inidoneidade para licitar ou contratar com a
			Administração Pública.</p>
		<p>II - Garantidos o contraditório e a ampla defesa, ensejam o
			cancelamento do credenciamento do PRESTADOR:</p>
		<p>a) não aceitar os termos das especificações do objeto, conforme
			descrito na cláusula primeira deste Contrato, salvo motivo plenamente
			justificado;</p>
		<p>b) comportar-se de modo inidôneo;</p>
		<p>c) fizer declaração falsa;</p>
		<p>d) cometer fraude fiscal;</p>
		<p>e) falhar ou fraudar no fornecimento do objeto.</p>
		<p>III - A multa prevista na alínea b do inciso I desta cláusula
			poderá, a critério da Administração, ser aplicada isolada ou
			conjuntamente com outras sanções, a depender do grau da infração
			cometida pelo PRESTADOR.</p>
		<p>IV - Quando aplicada, a multa deverá ser paga espontaneamente no
			prazo máximo de 5 (cinco) dias úteis ou ser deduzida do valor
			correspondente ao valor do serviço, após prévio processo
			administrativo, garantida a ampla defesa e o contraditório ou, ainda,
			cobrada judicialmente, a critério do TOMADOR.</p>
		<p>V - Os danos e prejuízos serão ressarcidos ao TOMADOR no prazo
			máximo de 48 (quarenta e oito) horas, contado da notificação
			administrativa ao PRESTADOR, sob pena de multa.</p>

		<p class="titulo">Cláusula Décima – DAS DISPOSIÇÕES FINAIS</p>

		<p>I - O PRESTADOR é responsável pela fidelidade e legitimidade das
			informações prestadas e dos documentos apresentados em qualquer fase
			do Credenciamento Centralizado. A falsidade de qualquer documento
			apresentado ou a inverdade das informações nele contidas implicará a
			imediata rescisão do presente contrato, sem prejuízo das demais
			sanções cabíveis.</p>
		<p>II - A rescisão do referido CONTRATO, a pedido do PRESTADOR,
			somente se dará em face de motivo justo decorrente de fato
			superveniente e comunicado ao TOMADOR com antecedência mínima de 30
			(trinta) dias.</p>
		<p>III - Da contagem dos prazos estabelecidos neste CONTRATO
			excluir-se-á o dia do início e incluir-se-á o do vencimento. Só se
			iniciam e vencem os prazos em dias de expediente nos Órgãos e
			Entidades do TOMADOR.</p>
		<p>IV - O resumo deste Contrato de Prestação de Serviços será
			publicado no Diário Oficial do Estado.</p>

		<div class="rodape">
			<hr>
			<div class="l2">
				<div class="l1">
				Cristie Rosa de Gouvêa da Silva, OAB/MG 80.643 <br /> Assessora
				Jurídica-Chefe do GMG
			</div>
			</div>
			<br />


		</div>

		<!-- #############################  fim Da pagina ######################### -->
		<br /> <br /> <br /> <br /> <br />
		<div class="topo">
			<img src="../imagens/cabecalho.png">
		</div>
		<br />
		<p>V – O TOMADOR reserva-se o direito de paralisar ou suspender a
			qualquer tempo a execução dos serviços contratados, mediante
			pagamento único e exclusivo daqueles já executados.</p>
		<p>VI - Os casos omissos serão decididos pelo TOMADOR, em conformidade
			com as disposições constantes do Edital de Credenciamento n.°
			001/2012 e com as normas legais aplicáveis.</p>

		<p class="titulo">Cláusula Décima Primeira – DO FORO</p>

		<p>Fica eleito o foro de Belo Horizonte, Minas Gerais, para dirimir
			quaisquer dúvidas na aplicação deste contrato, em renúncia a qualquer
			outro, por mais privilegiado que seja.</p>
		<p>E assim ajustado e contratado, é lavrado este contrato que, depois
			de lido e achado de acordo, será assinado pelas partes contratantes e
			pelas testemunhas abaixo, em 03 (três) vias de igual teor para um só
			efeito legal.</p>
			<br />
			<br />
			<br />
			<br />
		<p align="left">
			<?php print "Montes Claros,   ".DataMysql::dataExtensoDocumento($dt_contrato).".";?>
		</p>
		<br />
		<br />

		<p style="width: 100%; text-align: center; " >
			<span class="n_assina">Luis Carlos Dias Martins, Cel PM</span><br />
			Chefe do Gabinete Militar do Governador e<br /> Coordenador Estadual de Defesa Civil
			
			</span>
			
		</p>

		
		<p style="width: 100%; text-align: center; " >
			
			<?php 
				if($_dados[0]['pessoa'] == 'pj') {
					
					print "<span class='n_assina'>".htmlentities($_dados[0]['nome_mot'])."</span><br />
							Representante legal da Empresa<br />".
							htmlentities($_dados[0]['nome']);
					
				}else {
					
					print "<span class='n_assina'>".htmlentities($_dados[0]['nome'])."</span><br />";
					
					
					
				}
			
			
			
			?>
			
		</p>
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<p>
			TESTEMUNHAS :<br />
			<div class="">
			1)__________________________________________ 2)__________________________________________
			Assinatura e CPF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Assinatura e CPF
			</div>
					
		</p>
			<br />
		<br />
		<br />
		<br />
		<br />
		<div class="rodape">
			<hr>
			<div class="l2">
				<div class="l1">
				Cristie Rosa de Gouvêa da Silva, OAB/MG 80.643 <br /> Assessora
				Jurídica-Chefe do GMG
			</div>
			</div>
			<br />


		</div>
	</div>


</body>
</html>


