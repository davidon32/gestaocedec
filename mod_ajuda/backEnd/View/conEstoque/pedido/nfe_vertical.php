<html>
    <head>
        <title>-</title>
        <link rel="stylesheet" href="/css/notaf.css">
        <style>
            #img-ajuda {
                display: none;
            }
            
            .myButton {
	box-shadow: 0px 10px 14px -7px #276873;
	background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
	background-color:#599bb3;
	border-radius:8px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:17px;
	font-weight:bold;
	padding:7px 17px;
	text-decoration:none;
	text-shadow:0px 1px 0px #3d768a;
}
.myButton:hover {
	background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
	background-color:#408c99;
}
.myButton:active {
	position:relative;
	top:1px;
}

        

        </style>
    </head>

    <body>

        <?php
        //defined('envia') or die();

        $id = isset($_GET['id']) ? $_GET['id'] : "";
        $pedido = new PedidoConEstoqueModel();
        $dados = $pedido->listadadosPedido($id);

        $itens = $pedido->lista_produto_pedido($id);
        $total_nota = $itens['total'];
               
        ?>
        
        <div style="text-align:center">
            <a class="myButton" href="<?=(isset($_GET['volta']) == 'index') ? FuncaoBase::geraLink("ajuda", "pedido", "index") : FuncaoBase::geraLink("ajuda", "pedido", "separacao");?>">Voltar</a></div>
           
        <div class="page nfeArea">
            <img class="imgCanceled" src="/core/imagem/tarja_nf_cancelada.png" alt="" />
            <img class="imgNull" src="/core/imagem/tarja_nf_semvalidade.png" alt="" />
            <div class="boxFields" style="padding-top: 20px;">
                <table cellpadding="0" cellspacing="0" border="1">
                    <tbody>
                        <tr>
                            <td colspan="2" class="txt-upper">
                                Recebemos de (18.715.565/0001-10) GABINETE MILITAR DO GOVERNADOR DE MINAS GERAIS OS PRODUTOS CONSTAINTES NESTE RECIBO
                            </td>
                            <td rowspan="2" class="tserie txt-center">
                                <span class="font-12" style="margin-bottom: 5px;"><!--NF-e--></span>
                                <span>Nº <?= $dados->id_pedido ?></span>
                                <span>Série </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 32mm">
                                <span class="nf-label">Data de recebimento</span>
                            </td>
                            <td style="width: 124.6mm">
                                <span class="nf-label">Identificação de assinatura do Recebedor</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="hr-dashed" />
                <table cellpadding="0" cellspacing="0" border="1">
                    <tbody>
                        <tr>
                            <td rowspan="3" style="width: 30mm">
                                <img class="client_logo" src="/core/imagem/brasaogmg.png" alt="" onerror=" javascript:this.src='data:image/png;base64,"/>
                            </td>
                            <td rowspan="3" style="width: 46mm; font-size: 7pt;" class="txt-center">
                                <span class="mb2 bold block">GABINETE MILITAR DO GOVERNADOR DE MINAS GERAIS</span>
                                <span class="block">Rodovia Papa João Paulo II, 3777</span>
                                <span class="block">
                                    Serra Verde <br> Palácio Tiradentes, 2 andar
                                </span>
                                <span class="block">
                                    31630-903 - Belo Horizonte (MG)<br> Fone (31)3916-0822 Fax (31)3916-0822
                                </span>
                            </td>
                            <td rowspan="3" class="txtc txt-upper" style="width: 34mm; height: 29.5mm;">
                                <h3 class="title">Danfe</h3>
                                <p class="mb2">Documento auxiliar da Nota Fiscal Eletrônica </p>
                                <p class="entradaSaida mb2">
                                    <span class="identificacao">
                                        <span>1</span>
                                    </span>
                                    <span class="legenda">
                                        <span>0 - Entrada</span>
                                        <span>1 - Saída</span>
                                    </span>
                                </p>
                                <p>
                                    <span class="block bold">
                                        <span>Nº</span>
                                        <span><?= $dados->id_pedido ?></span>
                                    </span>
                                    <span class="block bold">
                                        <span>SÉRIE:</span>
                                        <span>-</span>
                                    </span>
                                    <span class="block">
                                        <span>Página</span>
                                        <span>1</span>
                                        <span>de</span>
                                        <span>1</span>
                                    </span>
                                </p>
                            </td>
                            <td class="txt-upper" style="width: 85mm;">
                                <span class="nf-label">Controle do Fisco</span>
                                <span class="codigo">-</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="nf-label">CHAVE DE ACESSO</span>
                                <span class="bold block txt-center info">-</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="txt-center valign-middle">
                                <span class="block"><!--Consulta de autenticidade no portal nacional da NF-e --></span><!-- www.nfe.fazenda.gov.br/portal ou no site da Sefaz Autorizada.-->
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Natureza da Operação -->
                <table cellpadding="0" cellspacing="0" class="boxNaturezaOperacao no-top" border="1">
                    <tbody>
                        <tr>
                            <td>
                                <span class="nf-label">NATUREZA DA OPERAÇÃO</span>
                                <span class="info">-</span>
                            </td>
                            <td style="width: 84.7mm;">
                                <span class="nf-label">-</span>
                                <span class="info">-</span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Inscrição -->
                <table cellpadding="0" cellspacing="0" class="boxInscricao no-top" border="1">
                    <tbody>
                        <tr>
                            <td>
                                <span class="nf-label">INSCRIÇÃO ESTADUAL</span>
                                <span class="info">-</span>
                            </td>
                            <td style="width: 67.5mm;">
                                <span class="nf-label">INSCRIÇÃO ESTADUAL DO SUBST. TRIB.</span>
                                <span class="info">-</span>
                            </td>
                            <td style="width: 64.3mm">
                                <span class="nf-label">CNPJ</span>
                                <span class="info">18.715.565/0001-10</span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Destinatário/Emitente -->
                <p class="area-name">Destinatário/Emitente</p>
                <table cellpadding="0" cellspacing="0" class="boxDestinatario" border="1">
                    <tbody>
                        <tr>
                            <td class="pd-0">
                                <table cellpadding="0" cellspacing="0" border="1">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="nf-label">NOME/RAZÃO SOCIAL</span>
                                                <span class="info"><?= $dados->nome_aju_destinatario ?> / <?= $dados->nome_aju_destinatario_final ?></span>
                                            </td>
                                            <td style="width: 40mm">
                                                <span class="nf-label">CNPJ/CPF</span>
                                                <span class="info"><?= $dados->cnpj ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td style="width: 22mm">
                                <span class="nf-label">DATA DE EMISSÃO</span>
                                <span class="info"><?= DataMysql::dataVisual($dados->data_emissao) ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-0">
                                <table cellpadding="0" cellspacing="0" border="1">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="nf-label">ENDEREÇO</span>
                                                <span class="info"><?= $dados->endereco ?></span>
                                            </td>
                                            <td style="width: 47mm;">
                                                <span class="nf-label">BAIRRO/DISTRITO</span>
                                                <span class="info"></span>
                                            </td>
                                            <td style="width: 37.2 mm">
                                                <span class="nf-label">CEP</span>
                                                <span class="info"><?= $dados->cep ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <span class="nf-label">DATA DE ENTR./SAÍDA</span>
                                <span class="info"><?= DataMysql::dataVisual($dados->data_entrega) ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pd-0">
                                <table cellpadding="0" cellspacing="0" style="margin-bottom: -1px;" border="1">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="nf-label">MUNICÍPIO</span>
                                                <span class="info"><?= $dados->municipio ?></span>
                                            </td>
                                            <td style="width: 34mm">
                                                <span class="nf-label">FONE/FAX</span>
                                                <span class="info">-</span>
                                            </td>
                                            <td style="width: 28mm">
                                                <span class="nf-label">UF</span>
                                                <span class="info"><?= $dados->estado ?></span>
                                            </td>
                                            <td style="width: 51mm">
                                                <span class="nf-label">INSCRIÇÃO ESTADUAL</span>
                                                <span class="info">-</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <span class="nf-label">HORA ENTR./SAÍDA</span>
                                <span id="info">-</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Fatura -->
                <div class="boxFatura">
                    <p class="area-name">Fatura</p>

                </div>

                <!-- Calculo do Imposto -->
                <p class="area-name">Calculo do imposto</p>
                <div class="wrapper-table">
                    <table cellpadding="0" cellspacing="0" border="1" class="boxImposto">
                        <tbody>
                            <tr>
                                <td>
                                    <span class="nf-label label-small">BASE DE CÁLC. DO ICMS</span>
                                    <span class="info">-</span>
                                </td>
                                <td>
                                    <span class="nf-label">VALOR DO ICMS</span>
                                    <span class="info">-</span>
                                </td>
                                <td>
                                    <span class="nf-label label-small" style="font-size: 4pt;">BASE DE CÁLC. DO ICMS ST</span>
                                    <span class="info">-</span>
                                </td>
                                <td>
                                    <span class="nf-label">VALOR DO ICMS ST</span>
                                    <span class="info">-</span>
                                </td>
                                <td>
                                    <span class="nf-label label-small">V. IMP. IMPORTAÇÃO</span>
                                    <span class="info"></span>
                                </td>
                                <td>
                                    <span class="nf-label label-small">V. ICMS UF REMET.</span>
                                    <span class="info"></span>
                                </td>
                                <td>
                                    <span class="nf-label">VALOR DO FCP</span>
                                    <span class="info">-</span>
                                </td>
                                <td>
                                    <span class="nf-label">VALOR DO PIS</span>
                                    <span class="info"></span>
                                </td>
                                <td>
                                    <span class="nf-label label-small">V. TOTAL DE PRODUTOS</span>
                                    <span class="info valor"><?= FuncaoBase::real($total_nota) ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="nf-label">VALOR DO FRETE</span>
                                    <span class="info">0,00</span>
                                </td>
                                <td>
                                    <span class="nf-label">VALOR DO SEGURO</span>
                                    <span class="info">0,00</span>
                                </td>
                                <td>
                                    <span class="nf-label">DESCONTO</span>
                                    <span class="info">0,00</span>
                                </td>
                                <td>
                                    <span class="nf-label">OUTRAS DESP.</span>
                                    <span class="info">0,00</span>
                                </td>
                                <td>
                                    <span class="nf-label">VALOR DO IPI</span>
                                    <span class="info">0,00</span>
                                </td>
                                <td>
                                    <span class="nf-label">V. ICMS UF DEST.</span>
                                    <span class="info"></span>
                                </td>
                                <td>
                                    <span class="nf-label label-small">V. APROX. DO TRIBUTO</span>
                                    <span class="info">0,00</span>
                                </td>
                                <td>
                                    <span class="nf-label label-small">VALOR DA CONFINS</span>
                                    <span class="info"></span>
                                </td>
                                <td>
                                    <span class="nf-label label-small">V. TOTAL DA NOTA</span>
                                    <span class="info"><?= FuncaoBase::real($total_nota) ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Transportador/Volumes transportados -->
                <p class="area-name">Transportador/volumes transportados</p>
                <table cellpadding="0" cellspacing="0" border="1">
                    <tbody>
                        <tr>
                            <td>
                                <span class="nf-label">RAZÃO SOCIAL</span>
                                <span class="info"><?= $dados->nome_aju_transportadora ?></span>
                            </td>
                            <td class="freteConta" style="width: 32mm">
                                <span class="nf-label">FRETE POR CONTA</span>
                                <div class="border">
                                    <span class="info"></span>
                                </div>
                                <p>0 - Emitente</p>
                                <p>1 - Destinatário</p>
                            </td>
                            <td style="width: 17.3mm">
                                <span class="nf-label">CÓDIGO ANTT</span>
                                <span class="info">-</span>
                            </td>
                            <td style="width: 24.5mm">
                                <span class="nf-label">PLACA</span>
                                <span class="info">-</span>
                            </td>
                            <td style="width: 11.3mm">
                                <span class="nf-label">UF</span>
                                <span class="info">-</span>
                            </td>
                            <td style="width: 29.5mm">
                                <span class="nf-label">CNPJ/CPF</span>
                                <span class="info">-</span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table cellpadding="0" cellspacing="0" border="1" class="no-top">
                    <tbody>
                        <tr>
                            <td class="field endereco">
                                <span class="nf-label">ENDEREÇO</span>
                                <span class="content-spacer info"></span>
                            </td>
                            <td style="width: 32mm">
                                <span class="nf-label">MUNICÍPIO</span>
                                <span class="info"></span>
                            </td>
                            <td style="width: 31mm">
                                <span class="nf-label">UF</span>
                                <span class="info"></span>
                            </td>
                            <td style="width: 51.4mm">
                                <span class="nf-label">INSC. ESTADUAL</span>
                                <span class="info"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table cellpadding="0" cellspacing="0" border="1" class="no-top">
                    <tbody>
                        <tr>
                            <td class="field quantidade">
                                <span class="nf-label">QUANTIDADE</span>
                                <span class="content-spacer info">-</span>
                            </td>
                            <td style="width: 31.4mm">
                                <span class="nf-label">ESPÉCIE</span>
                                <span class="info">-</span>
                            </td>
                            <td style="width: 31mm">
                                <span class="nf-label">MARCA</span>
                                <span class="info"></span>
                            </td>
                            <td style="width: 31.5mm">
                                <span class="nf-label">NUMERAÇÃO</span>
                                <span class="info"></span>
                            </td>
                            <td style="width: 31.5mm">
                                <span class="nf-label">PESO BRUTO</span>
                                <span class="info">0,000</span>
                            </td>
                            <td style="width: 32.5mm">
                                <span class="nf-label">PESO LÍQUIDO</span>
                                <span class="info">0,000</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Dados do produto/serviço -->
                <p class="area-name">Dados do produto/serviço</p>
                <div class="wrapper-border">
                    <table cellpadding="0" cellspacing="0" border="1" class="boxProdutoServico">
                        <thead class="listProdutoServico" id="table">
                            <tr class="titles">
                                <th class="cod" style="width: 15.5mm">CÓDIGO</th>
                                <th class="descrit" style="width: 66.1mm">DESCRIÇÃO DO PRODUTO/SERVIÇO</th>
                                <th class="ncmsh">NCMSH</th>
                                <th class="cst">CST</th>
                                <th class="cfop">CFOP</th>
                                <th class="un">UN</th>
                                <th class="amount">QTD.</th>
                                <th class="valUnit">VLR.UNIT</th>
                                <th class="valTotal">VLR.TOTAL</th>
                                <th class="bcIcms">BC ICMS</th>
                                <th class="valIcms">VLR.ICMS</th>
                                <th class="valIpi">VLR.IPI</th>
                                <th class="aliqIcms">ALIQ.ICMS</th>
                                <th class="aliqIpi">ALIQ.IPI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($itens['valor'] as $key => $item) {

                                print "<tr>
                                     <td>" . $item->id_unidade . "</td>
                                            <td>" . $item->nome . " / " . ".$item->nome_marca." . "</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>" . $item->unidade_med . "</td>
                                            <td>" . $item->qtd . "</td>
                                            <td>" . FuncaoBase::real($item->val_unid) . "</td>
                                            <td>" . FuncaoBase::real($item->val_total) . "</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>0,00</td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Calculo de ISSQN -->
                <p class="area-name">Calculo do issqn</p>
                <table cellpadding="0" cellspacing="0" border="1" class="boxIssqn">
                    <tbody>
                        <tr>
                            <td class="field inscrMunicipal">
                                <span class="nf-label">INSCRIÇÃO MUNICIPAL</span>
                                <span class="info txt-center">0,000</span>
                            </td>
                            <td class="field valorTotal">
                                <span class="nf-label">VALOR TOTAL DOS SERVIÇOS</span>
                                <span class="info txt-right">0,000</span>
                            </td>
                            <td class="field baseCalculo">
                                <span class="nf-label">BASE DE CÁLCULO DO ISSQN</span>
                                <span class="info txt-right">0,000</span>
                            </td>
                            <td class="field valorIssqn">
                                <span class="nf-label">VALOR DO ISSQN</span>
                                <span class="info txt-right">0,000</span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Dados adicionais -->
                <p class="area-name">Dados adicionais</p>
                <table cellpadding="0" cellspacing="0" border="1" class="boxDadosAdicionais">
                    <tbody>
                        <tr>
                            <td class="field infoComplementar">
                                <span class="nf-label">INFORMAÇÕES COMPLEMENTARES</span>
                                <span><?= $dados->obs ?></span>
                            </td>
                            <td class="field reservaFisco" style="width: 85mm; height: 24mm">
                                <span class="nf-label">RESERVA AO FISCO</span>
                                <span></span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <footer>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="text-align: right"><strong><!--Empresa de Software www.empresa.com--></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </footer>
            </div>

        </div>
    </body>
    <?php include_once "template/page/rodapePage.php"; ?>
    <script>

        $(document).ready(function () {

        })
    </script>
</html>
