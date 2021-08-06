<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_pipa/Model/IndexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php // include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
if (isset($_GET['debug'])) {
    //var_dump($page);
    print "<hr>";
    //var_dump($pageSession);
}

$altera = "0";

$municipio = new Municipio ();

$comunidade = new Comunidade ();

$pmda = new Pmda ();

$compdec = new Compdec ();

$adm = isset($pageSession['session']['seguranca']['adm']) ? $pageSession['session']['seguranca']['adm'] : null;

$id_municipio = "0";

/* login adm */
if (isset($pageSession['session']['seguranca']['adm'])) {

    $login = new Login ();

    $id_pmda = isset($_GET ['param']) ? $_GET ['param'] : "";

    $id_municipio = isset($_GET['mun']) ? $_GET['mun'] : "-";

    $inputLeitura = '';
    $btnLeitura = '';

    /* login externo */
} elseif (isset($pageSession['session']['seguranca']['externo'])) {

    $id_pmda = isset($_GET ['param']) ? $_GET ['param'] : "";

    $id_municipio = $_COOKIE['seguranca']['id_municipio'];

    $inputLeitura = 'readonly="readonly" title="Campo não Editável !"';
    $btnLeitura = "disabled='disabled'";
}

if (!empty($id_pmda)) {
    $dados = $pmda->dadosPmda($id_pmda);
    $protocolo = $id_pmda . str_replace("-", "", substr($dados['data'], 0, 10));
    "";
}
?>
<div class="container-fluid">
    <!-- corpo -->
    <b>Municipio :</b>&nbsp;&nbsp;&nbsp; <i><?= Municipio::PegaNomeMunicipio($id_municipio); ?></i>
    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
    <i><?= isset($protocolo) ? "<b>PMDA Nº: </b>" . $protocolo : ""; ?></i>
    <div class="col-md-12">
        <br>
        <!-- ABAS -->
        <div class="tabbable" id="tabs-166211">
            <ul class="nav nav-tabs" role="tablist">
                <li class=""><a href="#panel-inicio" role="tab" data-toggle="tab" id="tab_inicio">Início</a></li>
                <li class=""><a href="#panel-municipio" role="tab" data-toggle="tab" id="tab_municipio">Informações sobre ISS</a></li>
                <li class=""><a href="#panel-compdec" role="tab" data-toggle="tab" id="tab_compdec">Dados do Compdec</a></li>
                <li class=""><a href="#panel-ponto" role="tab" data-toggle="tab" id="tab_ponto">Ponto Captação</a></li>
                <li class=""><a href="#panel-comunidade" role="tab" data-toggle="tab" id="tab_comunidade">Locais de Distribuição</a></li>
                <li class=""><a href="#panel-representante" role="tab" data-toggle="tab" id="tab_representante"></a></li>
                <li class=""><a href="#panel-acoes" role="tab" data-toggle="tab" id="tab_acoes">Ações de Resposta</a></li>
                <li class=""><a href="#panel-anexo" role="tab" data-toggle="tab" id="tab_anexo">Anexos</a></li>
                <li class=""><a href="#panel-instrucao" role="tab" data-toggle="tab" id="tab_instrucao">Instruções Preenchimento</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane" id="panel-inicio">

                    <br> <a onclick="voltarAdm()" class="btn btn-primary" title="Voltar Menu">Voltar</a>
                    </p>
                    <br><br>

                    <div style="vertical-align: center">


                        <?php
                        $dadosPmda = $pmda->listaPmda($id_municipio);

                        if (is_null($adm)) {
                            ?>
                            <table style="width:90%; margin: auto;" class="table table-bordered" id="tblListaPmda">
                                <tr>
                                    <td colspan="5" style="text-align: center"><h4>Histórico dos PMDA</h4></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="col-md-1" style="width: 1%;"></th>
                                    <th class="col-md-1" style="width: 15%;">Protocolo</th>
                                    <th class="col-md-2" style="width: 15%;">Data Criação</th>
                                    <th class="col-md-2" style="width: 10%;">Situação</th>
                                    <th class="col-md-2" style="width: 30%;">Opção</th>
                                    <td style="vertical-align:top" rowspan="<?= count($dadosPmda); ?>">

                                        <p style="text-align:center; font-weight:bold;">Legenda</p>
                                        <span style="background-color:#D6D6D6; width:40%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;PMDA que está em Edição<br><br>
                                        <span style="background-color:#A9F5A9; width:40%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;PMDA que Permite Edição
                                    </td>
                                </tr>
                                <?php
                                foreach ($dadosPmda as $value) {

                                    $protocolo = $value ['id_pmda'] . str_replace("-", "", substr($value ['data'], 0, 10));

                                    $novo = "";
                                    if ($id_pmda == $value ['id_pmda']) {
                                        $fdo = "background-color:#D6D6D6; color:#6E6E6E;";
                                    } elseif ($value['status'] == "0") {
                                        $fdo = "background-color:#A9F5A9; color:#6E6E6E;";
                                        $novo = "<img width='30px;' src='core/imagem/aqui.gif' title='PMDA em Condições de edição'>";
                                    } else {
                                        $fdo = "";
                                    }

                                    print "<tr>";
                                    print "<td style='" . $fdo . "'>" . $novo . "</td>";
                                    print "<td style='" . $fdo . "'>" . $value ['id_pmda'] . str_replace("-", "", substr($value ['data'], 0, 10)) . "</td>";
                                    print "<td style='" . $fdo . "'>" . DataMysql::dataVisual($value ['data']) . "</td>";
                                    print "<td  style='" . $fdo . "' id='statusPmda'>" . $pmda->status($value ['status']) . "</td>";
                                    print "<td style='" . $fdo . "'>";

                                    print ($pmda->opcao($value ['id_pmda']) < "2") ? "<a name='lk_alterar' id='lk_alterarPmda' onclick='javascript:editar(" . $value['id_pmda'] . "," . $protocolo . ", " . $value['id_municipio'] . ")' title='Alterar PMDA'><img width='30px' src='core/imagem/editar.png'></button>" : "-";
                                    print "<a name=lk_impressao onclick='javascript:impressao(" . $value['id_pmda'] . ", " . $id_municipio . ")'><img width='30px' src='core/imagem/impressao.png' title='Impressao do PMDA'></a>";
                                    print ($pmda->opcao($value ['id_pmda']) == "2") ? "<a href='#'><img width='30px' src='core/imagem/request.png' title='Solicitar Alteração' id='lk_alteracao'></a>" : "-";
                                    print ($pmda->buscaStatus($value ['id_pmda']) == '1') ? "<button value='btnEnviar' id='btnEnviarHom' class='btn btn-primary' onclick='javascrip:homologa(" . $value ['id_pmda'] . ")' title='Solicita a Homologação do PMDA'>Enviar p/ Homologação</button>" : "";
                                    print ($pmda->buscaStatus($value ['id_pmda']) < '2') ? "&nbsp;<a id='btnVerificar' onclick='javascrip:verificaPendencia(" . $value ['id_pmda'] . ")' title='Verifica o Status do PMDA'><img width='30px' src='core/imagem/atualizar.png'></a>" : "";

                                    # somente mensagem novas
                                    if (count($pmda->listaMensagem($value ['id_pmda'], '0')) > '0') {
                                        print "&nbsp;<a onclick='lerMensagemRecebida(" . $value ['id_pmda'] . ", 0, \"nv\")' id='btnMensagem' name='mensagem'  title='Nova(s) Mensagem(s) Recebida(s) !'><img src='core/imagem/msg_not.png'></a>";
                                        # mensagens recebidas
                                    } elseif (count($pmda->listaMensagem($value ['id_pmda'], '')) > '0') {
                                        print "&nbsp;<a onclick='lerMensagemRecebida(" . $value ['id_pmda'] . ", 1)' id='btnMensagem' name='mensagem' title='Ver mensagens recebidas'><img src='core/imagem/msg_.png'></a>";
                                    }
                                    //print "<a href='#' id='btnDuplicarPmda' name='btnDuplicarPmda' data-idpmda='" . $value ['id_pmda'] . "' title='Cria um Clone deste PMDA para Edição'> <img src='core/imagem/duplicar.png'></a>";
                                    print "</td></tr>";
                                }
                                ?>

                            </table>
                        <?php } ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="panel-municipio">
                    <br>
                    <!-- *************************  MUNICIPIO  ************************** -->

                    <div style="height: 600px;">
                        <!-- <div class="col-md-12"> -->
                        <span name="protocolo"></span>
                        <!-- </div> -->

                        <?php
                        if ($id_pmda) {

                            $dadosMunicipio = $municipio->dadosMunicipio($id_municipio);
                        } else {

                            $dadosMunicipio = array();
                        }
                        ?>
                        <div class="col-md-12 text-center">
                            <h4>Informações sobre ISS</h4>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 form-group">
                                <label>Nome do Prefeito</label> <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text" id="txtPrefeito"
                                                                                                                       value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['prefeito'] : "" ?>"
                                                                                                                       />
                                <input type="hidden" name="txtIdMunicipioCom" id="txtIdMunicipioCom" value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['id_municipio'] : $id_municipio; ?>" />
                            </div>

                            <div class="col-xs-3 form-group">
                                <label>Telefone Prefeitura</label> 						

                                <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text" name="txtTel" id="txtTel"
                                                                                       data-mask="(99)99999-9999"
                                                                                       value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['tel'] : "" ?>"
                                                                                       />
                            </div>		
                            <div class="col-xs-3 form-group">
                                <label>Fax Prefeitura</label>
                                <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text" name="txtFax" id="txtFax"
                                                                                       data-mask="(99)99999-9999"
                                                                                       value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['fax'] : "" ?>"
                                                                                       />
                            </div>

                            <div class="col-xs-6 form-group">
                                <label>Telefone Prefeito</label>
                                <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text" name="txtTelPref" id="txtTelPref"
                                                                                       data-mask="(99)99999-9999"
                                                                                       value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['tel_pref'] : "" ?>"
                                                                                       />
                            </div>
                            <div class="col-xs-6 form-group">
                                <label>Celular Prefeito</label>
                                <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text" name="txtCelPref" id="txtCelPref"
                                                                                       data-mask="(99)99999-9999"
                                                                                       value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['cel_pref'] : "" ?>"
                                                                                       />
                            </div>



                            <div class="col-xs-8 form-group">
                                <label>Endereço da Prefeitura</label> <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text"
                                                                                                                             name="txtEndereco" id="txtEndereco"
                                                                                                                             value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['endereco'] : "" ?>"
                                                                                                                             />
                            </div>

                            <div class="col-xs-4 form-group">
                                <label>Bairro</label> <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text" name="txtBairro"
                                                                                                             id="txtBairro" value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['bairro'] : "" ?>"
                                                                                                             />
                            </div>
                            <div class="col-xs-4 form-group">
                                <label>Cep</label> <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text" name="txtCep" id="txtCep"
                                                                                                          data-mask="99999-999"
                                                                                                          value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['cep'] : "" ?>"
                                                                                                          />
                            </div>
                            <div class="col-xs-8 form-group">
                                <label>Email</label> <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="email" name="txtEmail" id="txtEmail"
                                                                                                            value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['email'] : "" ?>"
                                                                                                            />
                            </div>


                            <div class="col-xs-12">
                                <div class="col-xs-2 form-group">
                                    <label>Recolhe ISS ?</label> <i class="fa fa-asterisk" style="color:red"></i><select class="form-control" id="selCobraIss"
                                                                                                                         name="selCobraIss">
                                        <option><?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['cobra_iss'] : "" ?></option>
                                        <option>Sim</option>
                                        <option>Não</option>
                                    </select>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Alíquota %</label> <i class="fa fa-asterisk" style="color:red"></i>
                                    <input class="form-control" type="text" name="txtAliquota" id="txtAliquota"	value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['aliquota_iss'] : ""; ?>" />
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Responsabilidade Cobrança</label> <i class="fa fa-asterisk" style="color:red"></i><select class="form-control" id="selResp"
                                                                                                                                     name="selResp">
                                        <option><?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['resp_cob_iss'] : ""; ?></option>
                                        <option>-</option>
                                        <option>Prestador</option>
                                        <option>Tomador</option>
                                    </select>
                                </div>
                                <div class="col-xs-4 form-group">
                                    <label>Número da Lei / Ano</label> <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text" name="txtNumLei"
                                                                                                                              id="txtNumLei"
                                                                                                                              value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['num_lei_iss'] : '' ?>" />
                                </div>
                            </div>

                            <div class="divDadosMuncipio">
                                <div class="col-xs-4 form-group">
                                    <label>População Urbana</label> <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text" name="txtPopUrbana"
                                                                                                                           id="txtPopUrbana"
                                                                                                                           value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['populacao'] : "0" ?>"
                                                                                                                           <?= $inputLeitura; ?> />
                                </div>
                                <div class="col-xs-4 form-group">
                                    <label>População Rural</label> <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text" name="txtPopRural"
                                                                                                                          id="txtPopRural"
                                                                                                                          value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['pop_rural'] : "0" ?>"
                                                                                                                          <?= $inputLeitura; ?> />
                                </div>
                                <div class="col-xs-4 form-group">
                                    <label>Área Território (KM²)</label> <i class="fa fa-asterisk" style="color:red"></i><input class="form-control" type="text"
                                                                                                                                name="txtAreaTerr" id="txtAreaTerr"
                                                                                                                                value="<?= (count($dadosMunicipio) > 0) ? $dadosMunicipio['area'] : "0" ?>"
                                                                                                                                <?= $inputLeitura; ?> />
                                </div>
                            </div>
                        </div>
                        <?php if ($_COOKIE['seguranca']['tipo'] == "i") { ?>
                            <div class="text-right">
                                <button class="btn btn-primary" id="btnInfoMunicipio" <?= $btnLeitura; ?>>Salvar</button>
                            </div>
                        <?php } else { ?>
                            <div class="text-right">
                                <button class="btn btn-primary" id="btnInfoMunicipio">Salvar</button>
                            </div>
                        <?php } ?>
                        <!-- FIM ABA MUNICIPIO -->
                    </div>
                </div>
                <div class="tab-pane" id="panel-compdec">

                    <!-- *************************** COMPDEC *********************** -->

                    <?php
                    include_once 'informacao_tooltip.php';

                    if (!is_null($id_municipio)) {

                        $endCompdec = $compdec->dadosCompdec($id_municipio);
                    } else {

                        $endCompdec = null;
                    }
                    ?>								
                    <br>
                    <div style="height: 600px;">
                        <div class="col-md-12">
                            <span name="protocolo"></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <h4>Informações do Compdec</h4>
                            <br>
                            <span class="alert alert-danger">A atualização dos Membros do COMPDEC é feito pelo "Cadastro de COMPDEC"</span>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label data-toggle="tooltip" title="<?= $informacao['endereco_compdec']; ?>">Endereço&nbsp;<span
                                                class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                            class="form-control" type="text" name="txtEndCompdec" readonly="readonly"
                                            value="<?= empty($endCompdec) ? "" : $endCompdec['endereco']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-md-12 text-right">
                                <?php
                                if (empty($btnLeitura)) {
                                    print "<button class=\"btn btn-primary\" id=\"btnMostraCadMembroCompdec\"" . $btnLeitura . ">Adicionar
												Membro Compdec</button>";
                                }
                                ?>
                            </div>
                            <!-- formulario cadastro comunidade -->
                            <div class="col-md-12" id="frmCadMembroCompdec">
                                <hr>
                                <div class="col-xs-3 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['nome_eq_compdec']; ?>">Nome
                                        Membro&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                    </label> <input class="form-control" type="text" name="txtNomeMembro" id="txtNomeMembro"
                                                    placeholder="Campo Obrigatório" /> <input class="form-control" type="hidden"
                                                    name="txtIdMembro" id="txtIdMembro" />

                                </div>
                                <div class="col-xs-2 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['funcao_eq_compdec']; ?>">Função&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <select
                                        class="form-control" id="selFuncaoMembro">
                                        <option>Selecione a Função</option>
                                        <option>Coordenador</option>
                                        <option>Secretário</option>
                                        <option>Agente</option>
                                    </select>
                                </div>
                                <div class="col-xs-2 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['telefone_eq_compdec']; ?>">Telefone&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                        class="form-control" type="text" name="txtTelMembro" id="txtTelMembro"
                                        data-mask="(99)9999-9999" placeholder="Campo Obrigatório" />
                                </div>
                                <div class="col-xs-2 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['celular_eq_compdec']; ?>">Celular&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                        class="form-control" type="text" name="txtCelMembro" id="txtCelMembro"
                                        data-mask="(99)9999-9999" placeholder="Campo Obrigatório" />
                                </div>
                                <div class="col-xs-2 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['email_eq_compdec']; ?>">Email&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                        class="form-control" type="email" name="txtEmailMembro" id="txtEmailMembro"
                                        placeholder="Campo Obrigatório" />
                                </div>

                                <!-- DIV ADICIONAR -->
                                <div class="col-xs-1 form-group" id="divAddMembroEquipe">
                                    <label data-toggle="tooltip" title="<?= $informacao['acao_cad_compdec']; ?>">Ação&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                                    <button class="btn btn-primary" id="btnAddMembroEquipe"
                                            title="Adicionar Membro do Compdec">Adicionar</button>
                                </div>

                                <!-- DIV ALTERAR -->
                                <div class="col-xs-1 form-group" id="divAlterarMembroEquipe">
                                    <label data-toggle="tooltip" title="<?= $informacao['acao_cad_compdec']; ?>">Ação&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                                    <button class="btn btn-primary" id="btnAlterarMembroEquipe"
                                            title="Alterar dados Membro Compdec">Alterar</button>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4>Membros</h4>
                                    <br>
                                </div>
                                <div id="tblMembroEquipe">

                                    <?php include_once 'membroEquipe.php'; ?>
                                </div>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="panel-comunidade">
                    <!-- ******************** COMUNIDADE ***********************-->

                    <br>
                    <div>

                        <!-- Modal Adicionar comunidade -->
                        <div id="modalAddCom" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Adicionar Comunidade</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xs-9 form-group">
                                            <label data-toggle="tooltip" title="<?= $informacao['nome_comunidade_pesquisa']; ?>">Comunidade&nbsp;
                                                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                            </label>
                                            <input class="form-control" type="text" name="txtComunidade" id="txtComunidade" />
                                            <input class="form-control" type="hidden" name="txtIdComunidadeSearch" id="txtIdComunidadeSearch" />
                                            <input class="form-control" type="hidden" name="idComunidade" id="idComunidade" />
                                            <input class="form-control" type="hidden" name="txtIdPmda" id="txtIdPmda" value="<?= isset($id_pmda) ? $id_pmda : ""; ?>" /> <br>
                                            <span style="color: #FF0000; font-weight: bold;">Obs: Caso não encontre a comunidade na pesquisa, clique no Botão abaixo e Solicite o Cadastramento.</span>
                                            <button type="button" class="btn btn-success form-control col-md-2" id="btnCadastrarComunidade" data-id_municipio='<?= $id_municipio ?>'>Solicitar Cadastro de Comunidade</button>
                                        </div>
                                        <div class="col-xs-3 form-group">
                                            <label>&nbsp;</label>
                                            <button href="#" class="btn btn-primary form-control" id="btnAdicionar">Adicionar</button>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span name="protocolo"></span>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" id="btnMostraCadComunidade">Adicionar Comunidade</button>
                        </div>

                        <!-- formulario cadastro comunidade -->
                        <div class="col-md-12" id="frmCadComunidade">
                            <div class="col-md-12 text-center">

                                <h4>Dados Comunidades</h4>

                                <br>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="row">
                                        <div class="col-xs-12" id="pesquisaCom1">
                                            <label data-toggle="tooltip" title="<?= $informacao['nome_comunidade']; ?>">
                                                Nome&nbsp;
                                                <span	class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                            </label>
                                            <div class="input-group">
                                                <input class="form-control" type="text" name="txtNomeComunidade" id="txtNomeComunidade"	readonly="readonly" placeholder="Campo Obrigatório" />
                                                <span onclick="addComunidade()" class="input-group-addon" id="">
                                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                </span>

                                                <input type="hidden" name="txtIdMunAddCom" id="txtIdMunAddCom" value="<?= $id_municipio; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['latitude_comunidade']; ?>">Latitude&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                                    <!--  data-mask="S99º99’99,99’’" -->
                                    <input class="form-control" type="text" name="txtLatComunidade" id="txtLatComunidade"
                                           data-mask="-99.999999" placeholder="Campo Obrigatório" />
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['longitude_comunidade']; ?>">Longitude&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                                    <!-- data-mask="W99º99’99,99’’"  -->
                                    <input class="form-control" type="text" name="txtLongComunidade" id="txtLongComunidade"
                                           data-mask="-99.999999" placeholder="Campo Obrigatório" />
                                </div>
                                <div class="col-xs-3 form-group" id="dvPonto">
                                    <?php
                                    $pontoCap = new PontoCap();

                                    print "<label data-toggle='tooltip' title='Selecione o ponto de Captação previamente cadastrado a aba Ponto de Captação'>Ponto de Captação&nbsp;<span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span></label>";
                                    print "<select class='form-control' id='selPontoCapCom'>";
                                    print "<option value='0'>Selecione o Ponto</option>";

                                    foreach ($pontoCap->listaPCaptacao($id_municipio) as $value) {

                                        print "<option value='" . $value['id_ponto'] . "'>" . $value['nome'] . "</option>";
                                    }

                                    print "</select>";
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['trecho_pavimentado']; ?>">Trecho
                                        Pavimentado (Km)&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                    </label> <input class="form-control" type="text" name="txtTrecPavComunidade"
                                                    id="txtTrecPavComunidade" placeholder="Campo Obrigatório" />
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['trecho_n_pavimentado']; ?>">Trecho não
                                        Pavimentado (Km)&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                    </label> <input class="form-control" type="text" name="txtTrecNPavComunidade"
                                                    id="txtTrecNPavComunidade" placeholder="Campo Obrigatório" />
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['distancia_total']; ?>">Distância Total
                                        (Km)&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                    </label> <input class="form-control" type="text" name="txtDistTotComunidade"
                                                    id="txtDistTotComunidade" readonly="readonly" />
                                </div>
                                <div class="col-xs-3 form-group">
                                    &nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <label
                                        data-toggle="tooltip" title="<?= $informacao['populacao_atendida']; ?>">População Atendida<input
                                            class="form-control" type="text" name="txtPopAtComunidade" id="txtPopAtComunidade"
                                            placeholder="Campo Obrigatório" /></label>
                                </div>


                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary" id="btnAddComunidade">Salvar</button>
                                <button class="btn btn-primary" id="btnAlterarComunidade">Alterar</button>

                            </div>
                        </div>


                        <div class="col-xs-12">
                            <h4>Informe as Comunidades a serem atendidas.</h4>
                            <h4>
                                Após acrescentar as <u>Comunidades</u> você deverá adicionar os representantes clicando no
                                ícone. &nbsp;&nbsp;<img src="core/imagem/representante.png" width="30x">
                            </h4>

                        </div>
                        <!-- LISTA DE COMUNIDADES -->
                        <div class="col-xs-12 text-center">
                            <h5>Listagem de Comunidades</h5>
                        </div>
                        <div id="tblComunidadePmda">
                            <?php include_once ("comunidade.php"); ?>
                        </div>
                    </div>
                </div>
                <!-- *************************  PONTO CAPTACAO **********************  -->
                <div class="tab-pane" id="panel-ponto">




                    <br>
                    <div style="height: 600px;">
                        <div class="col-md-12">
                            <span name="protocolo"></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <h4>Dados Ponto Captação</h4>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" id="btnMostraCadPontoCap">Adicionar Ponto Captação</button>
                            </div>
                            <div class="12" id="frmCadPontoCap">
                                <div class="col-xs-3 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['nome_ponto']; ?>">Nome&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                        class="form-control" type="text" name="txtPontoCapNome" id="txtNomePontoCap"
                                        placeholder="Campo Obrigatório" /> <input type="hidden" name="txtIdPontoCap"
                                        id="txtIdPontoCap" />



                                </div>
                                <div class="col-xs-2 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['tipo']; ?>">Tipo&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <select
                                        class="form-control" id="selTipoPontoCap">
                                        <option value="0">Selecione o Tipo</option>
                                        <option value="1">COPASA</option>
                                        <option value="2">COPANOR</option>
                                        <option value="3">BARRAGEM</option>
                                        <option value="4">SAAE / DMAE</option>
                                        <option value="5">POÇO ARTESIANO PÚBLICO</option>
                                        <option value="6">POÇO ARTESIANO PARTICULAR</option>
                                    </select>
                                </div>
                                <div class="col-xs-2 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['latitude_ponto']; ?>">Latitude&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                                    <!-- data-mask="S99º99’99,99’’" -->
                                    <input class="form-control" type="text" name="txtLatPontoCap" id="txtLatPontoCap"
                                           data-mask="-99.999999" placeholder="Campo Obrigatório" />
                                    <input type="hidden" name="txtIdMunicipio" id="txtIdMunicipio" value="<?= $id_municipio; ?>" />
                                </div>
                                <div class="col-xs-2 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['longitude_ponto']; ?>">Longitude&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                                    <!-- data-mask="W99º99’99,99’’" -->
                                    <input class="form-control" type="text" name="txtLongPontoCap" id="txtLongPontoCap"
                                           data-mask="-99.999999" placeholder="Campo Obrigatório" />
                                </div>
                                <div class="col-xs-2 form-group">
                                    <label data-toggle="tooltip" title="<?= $informacao['capacidade_ponto']; ?>">Capacidade M³&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                        class="form-control" type="text" name="txtCapacidadePontoCap" id="txtCapacidadePontoCap"
                                        placeholder="Opcional" value="0" />
                                </div>

                                <!-- div botao Adicionar -->
                                <div class="col-xs-1 form-group" id="divAddPontoCap">
                                    <label data-toggle="tooltip" title="<?= $informacao['acao_ponto']; ?>">Ação&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                                    <button class="btn btn-primary" id="addPontoCap" title="Adicionar Ponto Captação">Adicionar</button>
                                </div>

                                <!-- div botao Alterar -->
                                <div class="col-xs-1 form-group" id="divAlterarPontoCap">
                                    <label data-toggle="tooltip" title="<?= $informacao['acao_ponto']; ?>">Ação&nbsp;<span
                                            class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                                    <button class="btn btn-primary" id="btnAlterarPontoCap" title="Alterar dados Ponto Captação">Alterar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="row">
                                <br>
                                <br>
                                <div id="tblPontoCap">
                                    <?php
                                    include_once ("ponto.php");
                                    ?>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="panel-representante">
                    <!--  
                                                                    
                                                                            *************************  REPRESENTANTE **********************
                    -->
                    <br>
                    <div style="height: 600px;">
                        <div class="col-md-12">
                            <span name="protocolo"></span>
                        </div>
                        <div class="col-md-12">
                            Comunidade:<span id="nomComunidade" style="font-weight: bold;">nome</span><br>
                        </div>

                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" id="btnMostraCadRep">Adicionar Representante</button>
                            <br>
                            <br>
                        </div>

                        <!-- Cadastro de Representante  -->
                        <div class="col-xs-12" id="frmCadRepresentante">
                            <div class="col-md-12 text-center">
                                <h4>Dados Representantes</h4>
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <label data-toggle="tooltip" title="<?= $informacao['nome_rep']; ?>">Representante&nbsp;<span
                                                    class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                                class="form-control" type="text" name="txtNomeRep" id="txtNomeRep"
                                                placeholder="Campo Obrigatório" /> <input class="form-control" type="hidden" name="idCom"
                                                id="idCom" /> <input class="form-control" type="hidden" name="txtIdRep" id="txtIdRep" />

                                        </div>
                                        <div class="col-xs-2">
                                            <label data-toggle="tooltip" title="<?= $informacao['cpf_rep']; ?>">CPF&nbsp;<span
                                                    class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                                class="form-control" type="text" name="txtCpfRep" id="txtCpfRep" data-mask="999.999.999-99"
                                                placeholder="Campo Obrigatório" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label data-toggle="tooltip" title="<?= $informacao['tel_rep']; ?>">Telefone&nbsp;<span
                                                    class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                                class="form-control" type="text" name="txtTelRep" id="txtTelRep" data-mask="(99)99999-9999"
                                                placeholder="Campo Obrigatório" />
                                        </div>
                                        <div class="col-xs-3">
                                            <label data-toggle="tooltip" title="<?= $informacao['watsapp_rep']; ?>">Esse Tel. Possui
                                                Watsapp ?&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                            </label><br> <select class="form-control" name="selWatsapp" id="selWatsapp">
                                                <option>Não</option>
                                                <option>Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label data-toggle="tooltip" title="<?= $informacao['endereco_rep']; ?>">Endereço&nbsp;<span
                                                    class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                                class="form-control" type="text" name="txtEnderecoRep" id="txtEnderecoRep"
                                                placeholder="Opcional" />
                                        </div>
                                        <div class="col-xs-2">
                                            <label data-toggle="tooltip" title="<?= $informacao['bairro_rep']; ?>">Bairro&nbsp;<span
                                                    class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                                class="form-control" type="text" name="txtBairroRep" id="txtBairroRep"
                                                placeholder="Opcional" />
                                        </div>
                                        <div class="col-xs-4">
                                            <label data-toggle="tooltip" title="<?= $informacao['email_rep']; ?>">Email&nbsp;<span
                                                    class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label> <input
                                                class="form-control" type="email" name="txtEmailRep" id="txtEmailRep" placeholder="Opcional" />
                                        </div>
                                    </div>
                                </div>
                                <!-- div botao Adicionar -->
                                <div class="col-xs-12 form-group text-right" id="divAddRep">
                                    <button class="btn btn-primary" id="btnAddRep">Salvar</button>
                                </div>

                                <!-- div botao Alterar -->
                                <div class="col-xs-12 form-group text-right" id="divAlterarRep">
                                    <button class="btn btn-primary" id="btnAlterarRep">Alterar</button>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="col-xs-12">

                            <div class="row">
                                <div id="tblRep">
                                    <?php include_once 'representante.php'; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 text-center">
                            <span class="alert alert-danger">Fique atento, é obrigatório três representantes por Comunidade
                                !</span><br>
                        </div>

                    </div>
                </div>
                <!-- ABA AÇOES PARA ESTIAGEM  -->
                <div class="tab-pane" id="panel-acoes">
                    <br>
                    <div class="col-md-12">
                        <span name="protocolo"></span>
                    </div>
                    <div class="col-xs-12 text-center">
                        <h4>Ações Executadas pelo Município para enfrentar a estiagem</h4>
                    </div>
                    <br> <br> <br>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label data-toggle="tooltip" title="<?= $informacao['descricao_acoes']; ?>">Descreva as ações de
                                respostas ja adotadas tais como: Contratação de caminhão pipa, Distribuição de Ajuda
                                Humanitária etc.</label>&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                            <textarea class="form-control" col="10" rows="7" name="txtDescrAcoes" id="txtDescrAcoes"
                                      placeholder="Campo Obrigatório"><?= isset($dados['acoes']) ? $dados['acoes'] : ""; ?> </textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label data-toggle="tooltip" title="<?= $informacao['qtd_caminhao_acoes']; ?>">Quantidade
                                caminhões pipa pertencentes e ou contratados pelo município</label>&nbsp;<span
                                class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <input class="form-control"
                                type="number" name="txtQtdContratado" id="txtQtdContratado"
                                value="<?= isset($dados['qtd_caminhao']) ? $dados['qtd_caminhao'] : ""; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label data-toggle="tooltip" title="<?= $informacao['pop_atend_municipio']; ?>">População atendida
                                pelo próprio Município</label>&nbsp;<span class="glyphicon glyphicon-info-sign"
                                                                      aria-hidden="true"></span> <input class="form-control" type="number" name="txtPopAtMunicipio"
                                                                      id="txtPopAtMunicipio"
                                                                      value="<?= isset($dados['pop_at_municipio']) ? $dados['pop_at_municipio'] : ""; ?>" />
                        </div>
                    </div>
                    <!-- div botao Alterar -->
                    <div class="col-xs-12 form-group text-right" id="btnAcoesSalvar">
                        <button class="btn btn-primary" id="btnAcoesSalvar">Salvar</button>
                    </div>

                </div>
                <!-- ==================   ANEXO ===================== -->

                <div class="tab-pane" id="panel-anexo">
                    <br>
                    <div class="col-md-12">
                        <span name="protocolo"></span>
                    </div>
                    <br> <br> <strong>"Para envio do PMDA é obrigatório fazer o Download do "TERMO DE COMPROMISSO".
                        preencher, assinar e enviar copia digitalizada anexada no sistema, e a inserção de cópia de
                        ofício em papel timbrado da Prefeitura Municipal, contendo as seguintes informações:</strong> <br>
                    <br> 1. Se o município possui lei que institui cobrança do Imposto sobre Serviços (ISS) ou
                    equivalnete;<br> 2. Se o imposto incide sobre o serviço de Transporte e Distribuição de Água
                    Potável; <br> 3. Se incidente, qual a alíquota aplicável e qual a base de cálculo; <br> 4. A quem
                    cabe a responsabilidade pelo pagamento (se ao prestador ou ao contratante)." <br>
                    <div class="col-xs-12 text-center">
                        <h4>Anexos de Documentação</h4>
                    </div>
                    <br> <br> <br>
                    <form name="frmAnexo" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-8">
                                <label data-toggle="tooltip" title="<?= $informacao['descricao']; ?>">Descrição</label>&nbsp;<span
                                    class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                <textarea class="form-control" name="txtAnexoDesc" id="txtAnexoDesc" rows="4"
                                          placeholder="Campo Opcional"></textarea>
                                <input type="hidden" id="txtAnexoDt" name="txtAnexoDt" value="<?= date("Y-m-d H:i:s"); ?>"> <input
                                    type="hidden" id="txtIdPmda" name="txtIdPmda" value="<?= $id_pmda; ?>">
                            </div>
                            <div class="col-xs-2 text-center">
                                <h4>Download</h4>
                                <button type="button" onclick="javascript:termo_compromisso()" title="declaracao_termo" class="btn btn-default">Termo de Compromisso</button><br>
                                <br> 
                                <button type="button" onclick="javascript:declaracaoiss()" class="btn btn-default"
                                        title="declaracao_iss">Declaração de ISS</button>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <br> <label data-toggle="tooltip" title="<?= $informacao['anexo']; ?>">Anexar Documento (Arquivos
                                    nos formatos PDF, JPG, JPEG, PNG) Tamanho Máximo <span style="color: red">2Mb</span>(megaBytes)
                                </label>&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <input
                                    class="btn btn-primary" type="file" id="fileAnexo" name="fileAnexo"
                                    title="Envia o arquivo para o Servidor"> <br>
                                <button class="btn btn-primary" type="button" name="btnAddAnexo" id="btnAddAnexo"
                                        value="upload">Upload do Arquivo</button>
                            </div>
                        </div>
                    </form>
                    <br> <br>
                    <div class="col-xs-12 text-center" id="tblAnexo">
                        <?php include_once 'anexo.php'; ?>

                    </div>

                </div>

                <!-- ABA INSTRUÇÕES  -->
                <div class="tab-pane" id="panel-instrucao">
                    <br>
                    <div style="height: 600px;">
                        <?php include_once('instrucoes.php'); ?>
                    </div>
                </div>
            </div>
            <!-- FINALABA-->
        </div>

    </div>
</div>
<?php
//include_once "template/page/corpoRodape.php";
$comMunicipio = $comunidade->buscaComunidadeMunicipio($id_municipio);
?>

<!-- =================== RODAPE  ============================ -->
<?php include_once "template/page/rodape.php"; ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">


    $(document).ready(function () {


        $("#tab_inicio").trigger('click');

        $('#tabs-166211 a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        });

        $(".divDadosMuncipio").hide();

        var adm = '<?= $adm; ?>';
        if (adm.length > 0) {
            $(".divDadosMuncipio").show();
        } else {
            $(".divDadosMuncipio").hide();
        }

        /* aciona click janela busca comunidade */
        (function ($) {
            addComunidade = function () {
                $("#modalAddCom").modal('show');
                $("#txtIdComunidadeSearch").val("");
                $("#txtComunidade").val("");

            }
        })(jQuery);

        $("txtComunidade").blur(function () {
            console.log($("txtComunidade").val());

        });

        $("#txtCapacidadePontoCap").blur(function () {
            valor = $("#txtCapacidadePontoCap").val();
            valor = valor.replace(",", ".");
            $("#txtCapacidadePontoCap").val(valor);

        });

        $("#btnCadastrarComunidade").click(function () {
            var id_municipio = $(this).data('id_municipio');
            NovaJanela('?ac=itn&modulo=pipa&controller=pipa&action=precadcom&id=' + id_municipio, '700', '500');
        });

        $('[data-toggle="tooltip"]').tooltip();

        /* ocultar campos add comunidade */
        $("#frmCadComunidade").hide();

        /* ocultar campos add Membro Compdec */
        $("#frmCadMembroCompdec").hide();

        /* ocultar campos add Membro Compdec */
        $("#frmCadPontoCap").hide();

        /* ocultar campos add Representante */
        $("#frmCadRepresentante").hide();

        $("#spanAlert").hide();


        /* Mostra Mensagens Analista  */
        $('a[name="mensagem"]').click(function () {

            var id_pmda = $(this).data('idpmda');
            var status = $(this).data('status');

            //console.log(id_pmda);

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        // codigo

                        var dados = {
                            "id_pmda": id_pmda,
                            "status": status,
                            "opcao": "list_msg",
                        };

                        $.ajax({
                            type: 'POST',
                            url: 'mod_pipa/View/pmda/mensagemView.php?v=<?= md5(VERSAO) ?>',
                            data: dados,
                            //dataType: 'json',
                            success: function (response) {
                                //alert("Registro adicionado com sucesso !");
                                //$("#mensagem").html(response);
                                console.log(response);
                            },
                            error: function (e) {
                                console.log(JSON.stringify(e));
                            }

                        });

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });


        });


        /* mostrar form cadastro Comunidade*/
        $("#btnMostraCadComunidade").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        $("#frmCadComunidade").show();
                        $("#btnMostraCadComunidade").hide();
                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });


        /* mostrar form cadastro Ponto Captação*/
        $("#btnMostraCadPontoCap").click(function () {
            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        $("#frmCadPontoCap").show();
                        $("#btnMostraCadPontoCap").hide();

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });

        });

        /* mostrar form cadastro Membro Compdec*/
        $("#btnMostraCadMembroCompdec").click(function () {

            //arrumar
            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        $("#frmCadMembroCompdec").show();
                        $("#btnMostraCadMembroCompdec").hide();
                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });

        /* mostrar form cadastro Representante */
        $("#btnMostraCadRep").click(function () {
            $("#frmCadRepresentante").show();
            $("#btnMostraCadRep").hide();
        });


        /* limite latitude */
        $("#txtLatPontoCap").blur(function () {

            //coordLat($("#txtLatPontoCap").val());

        });

        /* limite Longitude */
        $("#txtLongPontoCap").blur(function () {

            //coordLong($("#txtLongPontoCap").val());

        });


        var itens = {
            data:
<?php print json_encode($comMunicipio); ?>, // array com os dados

            getValue: "comunidade",

            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var value = $("#txtComunidade").getSelectedItemData().id_comunidade;

                    $("#txtIdComunidadeSearch").val(value);
                    //$("#txtIdComunidadeSearch").val(value).trigger("change");


                }

            }

        };

        // set campos dados iss inicial
        if ($("#selCobraIss").val() == "Não") {
            $("#txtAliquota").prop('readonly', true);
            $("#selResp").attr('readonly', true);
            $("#txtNumLei").prop('readonly', true);
        } else {
            $("#txtAliquota").prop('readonly', false);
            $("#selResp").attr('readonly', false);
            $("#txtNumLei").prop('readonly', false);

        }


        // desabilita campos de dados iss
        $("#selCobraIss").change(function () {

            if ($("#selCobraIss").val() == "Não") {
                $("#txtAliquota").prop('readonly', true);
                $("#selResp").attr('readonly', true);
                $("#txtNumLei").prop('readonly', true);

                /* Limpa campos */
                $("#txtAliquota").val("");
                $("#selResp").val("-").change();
                $("#txtNumLei").val("");

            } else {
                $("#txtAliquota").prop('readonly', false);
                $("#selResp").attr('readonly', false);
                $("#txtNumLei").prop('readonly', false);
            }

        });

        /*********** autocomplete ***********/
        $("#txtComunidade").easyAutocomplete(itens);

        var id_pmda = getUrlVars()['param'];

        var adm = getUrlVars()['a'];

        //  muda cor das abas para liberar a alteração
        if (typeof id_pmda == 'undefined') {
            $("#tab_municipio").css({'color': 'silver'});
            $("#tab_compdec").css({'color': 'silver'});
            $("#tab_comunidade").css({'color': 'silver'});
            $("#tab_ponto").css({'color': 'silver'});
            $("#tab_representante").css({'color': 'silver'});
            $("#tab_acoes").css({'color': 'silver'});
            $("#tab_anexo").css({'color': 'silver'});

        } else {
            $("span[name=protocolo]").text('Protocolo Nº: ' + getUrlVars()['p']);
            $("#tab_municipio").css({'color': '#337ab7'});
            $("#tab_compdec").css({'color': '#337ab7'});
            $("#tab_comunidade").css({'color': '#337ab7'});
            $("#tab_ponto").css({'color': '#337ab7'});
            $("#tab_representante").css({'color': '#337ab7'});
            $("#tab_acoes").css({'color': '#337ab7'});
            $("#tab_anexo").css({'color': '#337ab7'});

        }


        /* inserir representante correcao exibição menu */
        $("img[name=lk_rep]").click(function () {
            alert("aqui");

            $("#tab_representante").attr("href", "#panel-representante");
            $("#tab_representamte").attr("data-toggle");
            $("#tab_representante").attr("data-toggle", "tab");

            $("#tab_representante").trigger("click");

            $('#tab_representante').removeAttr('href');
            $("#tab_representamte").removeAttr("data-toggle", "tab");

            $("#frmCadRepresentante").hide();
            $("#btnMostraCadRep").show();

        });


        $("#lk_alteracao").click(function () {

            var result = confirm('Deseja enviar uma solicitação de Alteração do PMDA ?');

            if (result == true) {
            }
        });

        /****************  reload ponto captaçao ************/
        $("#tab_comunidade").click(function () {

            var dados = {"id": "0"};

            var id_pmda = getUrlVars()['param'];
            //alert(id_pmda);
            $("#tblComunidadePmda").load("/mod_pipa/backEnd/View/pmda/comunidade.php?param=" + id_pmda);

            $.ajax({
                url: 'mod_pipa/backEnd/View/pmda/selPonto.php',
                type: 'POST',
                data: dados,
                success: function (response) {

                    //$("#dvPonto").html(response);
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });

        });


        /*********** total distancia para Alterar ***********/
        $("#btnAlterarComunidade").hover(function () {

            var trecho_pav = parseFloat($("#txtTrecPavComunidade").val());
            var trechoN_pav = parseFloat($("#txtTrecNPavComunidade").val());

            $("#txtDistTotComunidade").val(trecho_pav + trechoN_pav);

        });

        /*********** total distancia para Novo ***********/
        $("#btnAddComunidade").hover(function () {

            var trecho_pav = parseFloat($("#txtTrecPavComunidade").val());
            var trechoN_pav = parseFloat($("#txtTrecNPavComunidade").val());
            $("#txtDistTotComunidade").val(trecho_pav + trechoN_pav);
        });

        /*********** botao Adicionar MOdal pesquisa comunidade no input ***********/
        $("#btnAdicionar").click(function () {
            $("#txtNomeComunidade").val($("#txtComunidade").val());
            $("#idComunidade").val($("#txtIdComunidadeSearch").val());
            $("#txtIdPmda").val(id_pmda);
            $("#txtComunidade").val("");
            //$("#txtIdComunidadeSearch").val("");
            $("#modalAddCom").modal('hide');
            $("#txtIdMunAddCom").val('<?= $id_municipio; ?>');
        });

        /*********** verificar comunidade existe para adicionar  ***********/
        $("#txtComunidade").blur(function () {
            if ($("#txtIdComunidadeSearch").val() == "") {
                /* desabilitar botão Adicionar */
                $("#btnAdicionar").hide();
            } else {
                /* Habilitar botão Adicionar */
                $("#btnAdicionar").show();
            }
        });

        $("#btnAdicionar").hover(function () {

            if (($("#txtComunidade").val() == "") && ($("#txtIdComunidadeSearch").val() == "")) {
                /* desabilitar botão Adicionar */
                $("#btnAdicionar").hide();
            } else {
                /* Habilitar botão Adicionar */
                $("#btnAdicionar").show();
            }
        });


        /************* Remove acesso as abas **************/
        if (typeof id_pmda == 'undefined') {
            $("#tab_municipio").text("");
            $("#tab_compdec").text("");
            $("#tab_comunidade").text("");
            $("#tab_ponto").text("");
            $("#tab_acoes").text("");
            $("#tab_anexo").text("");

            $('#tab_municipio').removeAttr('href');
            $("#tab_municipio").removeAttr("data-toggle");
            $('#tab_compdec').removeAttr('href');
            $('#tab_compdec').removeAttr('data-toggle');
            $('#tab_comunidade').removeAttr('href');
            $('#tab_comunidade').removeAttr('data-toggle');
            $('#tab_ponto').removeAttr('href');
            $('#tab_ponto').removeAttr('data-toggle');
            $('#tab_acoes').removeAttr('href');
            $('#tab_acoes').removeAttr('data-toggle');
            $('#tab_anexo').removeAttr('href');
            $('#tab_anexo').removeAttr('data-toggle');


        }
        $('#tab_representante').removeAttr('href');
        $('#tab_representante').removeAttr('data-toggle');

        /************* Liberar abas para edição **************/
        $("a.lk_alterarPmda").click(function () {

            $("#tab_municipio").attr("href", "#panel-municipio");
            $("#tab_compdec").attr("href", "#panel-compdec");
            $("#tab_comunidade").attr("href", "#panel-comunidade");
            $("#tab_ponto").attr("href", "#panel-ponto");
            $("#tab_acoes").attr("href", "#panel-acoes");
            $("#tab_anexo").attr("href", "#panel-anexo");

            $("#tab_municipio").text("Informações sobre ISS");
            $("#tab_compdec").text("Dados Compdec");
            $("#tab_comunidade").text("Locais de Distribuição");
            $("#tab_ponto").text("Ponto Captação");
            $("#tab_acoes").text("Ações de Resposta");
            $("#tab_anexo").text("Anexos");

        });

        /**
         * 
         */
        $("#tblListaPmda a").click(function () {
            var id_pmda = $(this).data('idpmda');
            var protocolo = $(this).data('protocolo');
            //alert(id_pmda);
            //window.href = '?modulo=pipa&controller=pipa&action=index&param='+id_pmda+'&p='+$protocolo;

        });
        /********** Esconde botoes de alteracao **************/
        $("#divAlterarPontoCap").hide();
        $("#divAlterarMembroEquipe").hide();
        $("#btnAlterarComunidade").hide();
        $("#divAlterarRep").hide();


        /**
         *
         * gravar dados municipio
         *
         *
         */
        $("#btnInfoMunicipio").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        var dados = {"txtPrefeito": $("#txtPrefeito").val(),
                            "txtTel": $("#txtTel").val(),
                            "txtFax": $("#txtFax").val(),
                            "txtCelPref": $("#txtCelPref").val(),
                            "txtTelPref": $("#txtTelPref").val(),
                            "txtEndereco": $("#txtEndereco").val(),
                            "txtBairro": $("#txtBairro").val(),
                            "txtCep": $("#txtCep").val(),
                            "txtEmail": $("#txtEmail").val(),
                            "txtPopUrbana": $("#txtPopUrbana").val(),
                            "txtPopRural": $("#txtPopRural").val(),
                            "txtAreaTerr": $("#txtAreaTerr").val(),
                            "selCobraIss": $("#selCobraIss").val(),
                            "txtAliquota": $("#txtAliquota").val(),
                            "selResp": $("#selResp").val(),
                            "txtNumLei": $("#txtNumLei").val(),
                            "id_municipio": $("#txtIdMunicipioCom").val(),
                            "btnInfoMunicipio": "gravar",

                        };

                        var result = confirm("Deseja gravar as Alteraçãoes ?");

                        if (result) {

                            $.ajax({
                                url: '/mod_pipa/backEnd/View/pmda/municipio.php',
                                type: 'POST',
                                data: dados,
                                //dataType : 'json',
                                success: function (response) {
                                    if (response == 'sucesso') {
                                        alert('Dados gravados com Sucesso !');
                                        //window.location = window.location.href+"#municipio";
                                        window.location.reload();
                                    } else {
                                        alert("Não foi possivel gravar verifique os campos obrigatórios !");
                                    }
                                },
                                error: function (response) {
                                    console.log(JSON.stringify(response));
                                },
                            });
                        }
                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });

        /**
         *
         * DUPLICAR PMDA
         *
         *
         */
        $("#btnDuplicarPmda").click(function () {

            var id_pmda = $(this).data('idpmda');
            var id_municipio = $(this).data('idpmda');

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        var dados = {
                            "id_pmda": id_pmda,
                            "id_municipio": id_municipio,
                            "opcao": "duplicar",

                        };

                        var result = confirm("Deseja Duplicar esse Pmda ?");

                        if (result) {

                            $.ajax({
                                url: 'mod_pipa/app/pmda/pmda.php',
                                type: 'POST',
                                data: dados,
                                //dataType : 'json',
                                success: function (response) {
                                    if (response == 'sucesso') {
                                        alert('PMDA Duplicado com Sucesso !');
                                    }
                                },
                                error: function (response) {
                                    console.log(JSON.stringify(response));
                                }
                            });
                        }

                        //$("#txtDescrAcoes").val("");
                        //$("#txtQtdContratado").val("");

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });


        /**
         *
         *
         * gravar acoes de resposta
         * campos obrigatorios 
         *
         */
        $("#btnAcoesSalvar").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {

                    //inicio
                    if (response == "sucesso") {
                        // codigo	

                        if (
                                ($("#txtQtdContratado").val() == "") ||
                                ($("#txtDescrAcoes").val() == "")
                                ) {

                            alert("Preencha os Campos Obrigatórios !");

                        } else {

                            var dados = {"btnAcoesSalvar": "gravar",
                                'id_pmda': $("#txtIdPmda").val(),
                                "txtDescrAcoes": $("#txtDescrAcoes").val(),
                                "txtQtdContratado": $("#txtQtdContratado").val(),
                                "txtPopAtMunicipio": $("#txtPopAtMunicipio").val(),

                            };

                            $.ajax({
                                url: '/mod_pipa/backEnd/View/pmda/acoes.php',
                                type: 'POST',
                                data: dados,
                                success: function (response) {
                                    alert('Dados gravados com Sucesso !');
                                    console.log(response);
                                }
                            });
                        }

                        //$("#txtDescrAcoes").val("");
                        //$("#txtQtdContratado").val("");

                        //fim
                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });


        /*********** Adicionar Anexo leis ************************/
        $("#btnAddAnexo").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {

                    // inicio
                    if (response == "sucesso") {
                        // codigo
                        if (($('#txtAnexoDesc').val() == "") && ($('#fileAnexo').val() == "")) {

                            alert("O campo descrição é Obrigatório ! ");

                        } else {

                            var formData = new FormData($("form[name='frmAnexo']")[0]);
                            formData.append('btnAddAnexo', $('#btnAddAnexo').val());
                            formData.append('opcao', 'gravar');
                            formData.append('txtIdPmda', <?= $id_pmda; ?>);

                            var extensao = getExtensao($("#fileAnexo").val())

                            if (extensao.toLowerCase() == 'pdf' ||
                                    extensao.toLowerCase() == 'jpg' ||
                                    extensao.toLowerCase() == 'peg' ||
                                    extensao.toLowerCase() == 'png') {

                                $.ajax({
                                    url: '/mod_pipa/backEnd/View/pmda/valida_anexo.php',
                                    type: 'POST',
                                    data: formData,
                                    processData: false, // tell jQuery not to process the data
                                    contentType: false, // tell jQuery not to set contentType
                                    success: function (response) {
                                        if (response.trim() == "sucesso") {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                title: 'Arquivo anexado com Sucesso !',
                                                showConfirmButton: false,
                                                timer: 1500
                                            });

                                            setTimeout(() => {
                                                location.reload();
                                            }, 2000);
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: 'Algo deu Errado! \n Verifique o tamanho do documento ( Maximo 2Mb ou 2000Kb) ',
                                                footer: 'ou o nome do arquivo pode conter caracteres especiais !'
                                            })
                                        }

                                    },
                                });

                                $("#txtAnexoDesc").val("");
                                $("#fileAnexo").val("");

                            } else {
                                alert('Formatos de arquivos permitidos PDF, JPG, JPEG, PNG !' + getExtensao($("#fileAnexo").val()));
                            }
                        }

                        // fim
                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });

        });

        /*********** Adcionar pmda novo ***********/
        $("#addPmda").click(function () {
            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        //inicio
                        console.log('opa');
                        var dados = {"envia": "novo",
                            "id_municipio": "<?= isset($_COOKIE['seguranca']['id_municipio']) ? $_COOKIE['seguranca']['id_municipio'] : "-"; ?>",
                        };

                        $.ajax({
                            type: 'POST',
                            //dataType: 'json',
                            url: '/mod_pipa/backEnd/View/pmda/novo.php?v=<?= md5(VERSAO) ?>',
                            data: dados,
                            success: function (response) {
                                console.log(dados);
                                location.reload();
                            }
                        });
                        //fim
                    } else {
                        alert('Sessão expirada !')
                        //window.location.href ='index2.php';
                    }
                    location.reload();
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });


        /*********** Adicionar ponto de captacao ***********/
        $("#addPontoCap").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        // codigo

                        var capacidade = $("#txtCapacidadePontoCap").val();

                        if (
                                ($("#txtNomePontoCap").val() == "") ||
                                ($("#selTipoPontoCap").val() == "") ||
                                ($("#txtLatPontoCap").val() == "") ||
                                ($("#txtLongPontoCap").val() == "") ||
                                ($("#selTipoPontoCap").val() == 0)

                                ) {

                            alert("Todos os Campos São Obrigatórios !");
                        } else {

                            if (capacidade == "") {
                                capacidade = 0;
                            }
                            var dados = {
                                "opcao": "novo",
                                "txtNomePontoCap": $("#txtNomePontoCap").val(),
                                "selTipoPontoCap": $("#selTipoPontoCap").val(),
                                "txtLatPontoCap": $("#txtLatPontoCap").val(),
                                "txtLongPontoCap": $("#txtLongPontoCap").val(),
                                "txtCapacidadePontoCap": capacidade,
                                "txtIdMunicipio": "<?= isset($id_municipio) ? $id_municipio : ""; ?>"
                            };
                            $.ajax({
                                type: 'POST',
                                url: '/mod_pipa/backEnd/View/pmda/ponto.php?v=<?= md5(VERSAO) ?>',
                                data: dados,
                                success: function (response) {
                                    $("#tblPontoCap").html(response);
                                }
                            });

                            // limpa os controles
                            $("#txtNomePontoCap").val("");
                            $("#txtLatPontoCap").val("");
                            $("#txtLongPontoCap").val("");
                            $("#txtCapacidadePontoCap").val("");
                            $("#selTipoPontoCap").val(0);

                            $("#frmCadPontoCap").hide();
                            $("#btnMostraCadPontoCap").show();

                            alert("Ponto de Captação Adicionar com Sucesso !");
                        }

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });


        /*********** Alterar dados ponto de captacao ***********/
        $("#btnAlterarPontoCap").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {

                        if (
                                ($("#txtNomePontoCap").val() == "") ||
                                ($("#selTipoPontoCap").val() == "") ||
                                ($("#txtLatPontoCap").val() == "") ||
                                ($("#txtLongPontoCap").val() == "") ||
                                ($("#selTipoPontoCap").val() == 0)

                                ) {

                            alert("Preencha os campos que são Obrigatórios !");
                        } else {

                            var dados = {

                                "opcao": "alterar",
                                "id_ponto": $("#txtIdPontoCap").val(),
                                "txtNomePontoCap": $("#txtNomePontoCap").val(),
                                "selTipoPontoCap": $("#selTipoPontoCap").val(),
                                "txtLatPontoCap": $("#txtLatPontoCap").val(),
                                "txtLongPontoCap": $("#txtLongPontoCap").val(),
                                "txtCapacidadePontoCap": $("#txtCapacidadePontoCap").val(),
                                "txtIdMunicipio": <?= isset($_COOKIE['seguranca']['id_municipio']) ? $_COOKIE['seguranca']['id_municipio'] : $_GET['mun']; ?>,

                            };

                            $.ajax({
                                type: 'POST',
                                url: '/mod_pipa/backEnd/View/pmda/ponto.php?v=<?= md5(VERSAO) ?>',
                                data: dados,
                                success: function (response) {
                                    $("#tblPontoCap").html(response);
                                    console.log(response);
                                },
                                error: function (response) {
                                    console.log(response);
                                },
                            });

                            $("#txtNomePontoCap").val("");
                            $("#selTipoPontoCap").val(0);
                            $("#txtLatPontoCap").val("");
                            $("#txtLongPontoCap").val("");
                            $("#txtCapacidadePontoCap").val("");
                            $("#txtIdPontoCap").val("");
                            //$("#txtIdMunicipio").val("");
                            $("#frmCadPontoCap").hide();
                            $("#btnMostraCadPontoCap").show();

                        }

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });

        });


        /*********** Adicionar Membro Equipe Compdec ***********/
        $("#btnAddMembroEquipe").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        // codigo

                        if (
                                ($("#txtNomeMembro").val() == "") ||
                                ($("#selFuncaoMembro").val() == "") ||
                                ($("#txtTelMembro").val() == "") ||
                                ($("#txtCelMembro").val() == "") ||
                                ($("#txtEmailMembro").val() == "") ||
                                ($("#selFuncaoMembro").val() == "Selecione a Função")
                                ) {

                            alert("Todos os Campos São Obrigatórios !");

                        } else {

                            var dados = {
                                "opcao": "novo",
                                "txtNomeMembro": $("#txtNomeMembro").val(),
                                "selFuncaoMembro": $("#selFuncaoMembro").val(),
                                "txtTelMembro": $("#txtTelMembro").val(),
                                "txtCelMembro": $("#txtCelMembro").val(),
                                "txtEmailMembro": $("#txtEmailMembro").val(),
                                "txtIdMunicipio": $("#txtIdMunicipio").val(),

                            };

                            $.ajax({
                                type: 'POST',
                                url: '/mod_pipa/backEnd/View/pmda/membroEquipe.php?v=<?= md5(VERSAO) ?>',
                                data: dados,
                                //dataType: 'json',
                                success: function (response) {
                                    alert("Registro adicionado com sucesso !");
                                    $("#tblMembroEquipe").html(response);
                                },
                                error: function (e) {
                                    console.log(JSON.stringify(e));
                                }

                            });

                            // limpa os controles
                            $("#txtNomeMembro").val("");
                            $("#selFuncaoMembro").val("Selecione a Função");
                            $("#txtTelMembro").val("");
                            $("#txtCelMembro").val("");
                            $("#txtEmailMembro").val("");
                            $("#ckWatsapp").attr('checked', false);

                            $("#frmCadMembroCompdec").hide();
                            $("#btnMostraCadMembroCompdec").show();


                        }

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });

        });


        /*********** Alterar dados Membro Equipe ***********/
        $("#btnAlterarMembroEquipe").click(function () {
            var dados = {
                "opcao": "alterar",
                "id_equipe": $("#txtIdMembro").val(),
                "txtNomeMembro": $("#txtNomeMembro").val(),
                "selFuncaoMembro": $("#selFuncaoMembro").val(),
                "txtTelMembro": $("#txtTelMembro").val(),
                "txtCelMembro": $("#txtCelMembro").val(),
                "txtEmailMembro": $("#txtEmailMembro").val(),
                "ckWatsapp": $("#ckWatsapp").val(),
            };
            $.ajax({
                type: 'POST',
                url: '/mod_pipa/backEnd/View/pmda/membroEquipe.php?v=<?= md5(VERSAO) ?>',
                data: dados,
                success: function (response) {
                    alert("Registro alterado com sucesso !");
                    $("#tblMembroEquipe").html(response);
                }
            });

            // limpa os controles
            $("#txtNomeMembro").val("");
            $("#selFuncaoMembro").val("Selecione a Função");
            $("#txtTelMembro").val("");
            $("#txtCelMembro").val("");
            $("#txtEmailMembro").val("");
            $("#txtIdMembro").val("");
            $("#ckWatsapp").attr('checked', false);

            $("#divAddMembroEquipe").show();
            $("#divAlterarMembroEquipe").hide();
            $("#frmCadMembroCompdec").hide();
            $("#btnMostraCadMembroCompdec").show();

        });



        /*********** Alterar dados Comunidade***********/
        $("#btnAlterarComunidade").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {

                        if (
                                ($("#txtNomeComunidade").val() == "") ||
                                ($("#txtLatComunidade").val() == "") ||
                                ($("#txtLongComunidade").val() == "") ||
                                ($("#selPontoCapCom").val() == 0) ||
                                ($("#txtTrecPavComunidade").val() == "") ||
                                ($("#txtTrecNPavComunidade").val() == "") ||
                                ($("#txtPopAtComunidade").val() == "")
                                ) {

                            alert("Existem campos em branco");

                        } else {

                            var dados = {
                                "opcao": "alterar",
                                //"txtNomeComunidade" : $("#txtNomeComunidade").val(),
                                "txtLatComunidade": $("#txtLatComunidade").val(),
                                "txtLongComunidade": $("#txtLongComunidade").val(),
                                "selPontoCapCom": $("#selPontoCapCom").val(),
                                "txtTrecPavComunidade": $("#txtTrecPavComunidade").val(),
                                "txtTrecNPavComunidade": $("#txtTrecNPavComunidade").val(),
                                "txtPopAtComunidade": $("#txtPopAtComunidade").val(),
                                "id_comunidade": $("#txtIdComunidadeSearch").val(),
                                "id_pmda": $("#txtIdPmda").val(),
                                "txtIdMunicipioCom": $("#txtIdMunicipioCom").val(),
                            };

                            var result = confirm('Deseja Confirmar sua Alteracao ?');

                            if (result == true) {

                                $.ajax({
                                    type: 'POST',
                                    url: '/mod_pipa/backEnd/View/pmda/comunidade.php?v=<?= md5(VERSAO) ?>',
                                    data: dados,
                                    //dataType : 'json',
                                    success: function (response) {
                                        alert("Registro alterado com sucesso !");
                                        //console.log(dados);
                                        // console.log(JSON.stringify(response));
                                        $("#tblComunidadePmda").html(response);
                                    },
                                    error: function (response) {
                                        console.log(JSON.stringify(response));
                                    }
                                });
                                // limpa os controles
                                $("#txtNomeComunidade").val("");
                                $("#txtLatComunidade").val("");
                                $("#txtLongComunidade").val("");
                                $("#selPontoCapCom").val(0);
                                $("#txtTrecPavComunidade").val("");
                                $("#txtTrecNPavComunidade").val("");
                                $("#txtPopAtComunidade").val("");
                                $("#txtIdComunidadeSearch").val("");

                                $("#btnAddComunidade").show();
                                $("#btnAlterarComunidade").hide();

                                $("#frmCadComunidade").hide();
                            }

                        }

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });

        });


        //$("#tab_municipio").removeAttr('href');


        /*********** Adicionar Comunidade***********/
        $('#btnAddComunidade').click(function () {

            id_pmda = getUrlVars()['param'];

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {


                        if ($("#txtIdComunidadeSearch").val() == "") {
                            alert("Esta Comunidade Ainda não está Cadastrada ou não foi liberada para Uso no PMDA !");
                        } else if (
                                ($("#txtNomeComunidade").val() == "") ||
                                ($("#txtLatComunidade").val() == "") ||
                                ($("#txtLongComunidade").val() == "") ||
                                ($("#selPontoCapCom").val() == 0) ||
                                ($("#txtTrecPavComunidade").val() == "") ||
                                ($("#txtTrecNPavComunidade").val() == "") ||
                                ($("#txtPopAtComunidade").val() == "") ||
                                ($("#txtIdMunAddCom").val() == "")
                                ) {
                            alert("Favor preencher os campos Obrigatórios !");
                            //console.log($("#txtIdMunAddCom").val());
                        } else {

                            var dados = {

                                "opcao": "novo",
                                "nomComunidade": $("#txtNomeComunidade").val(),
                                "id_comunidade": $("#txtIdComunidadeSearch").val(),
                                "txtLatComunidade": $("#txtLatComunidade").val(),
                                "txtLongComunidade": $("#txtLongComunidade").val(),
                                "selPontoCapCom": $("#selPontoCapCom").val(),
                                "txtTrecPavComunidade": $("#txtTrecPavComunidade").val(),
                                "txtTrecNPavComunidade": $("#txtTrecNPavComunidade").val(),
                                "txtPopAtComunidade": $("#txtPopAtComunidade").val(),
                                "txtIdMunAddCom": $("#txtIdMunAddCom").val(),
                                "id_pmda": id_pmda,

                            };


                            $.ajax({
                                type: 'POST',
                                url: '/mod_pipa/backEnd/View/pmda/comunidade.php?v=<?= md5(VERSAO) ?>',
                                data: dados,
                                success: function (response) {
                                    /* ja existe comunidade em algum pmda*/
                                    if(response.substr(0, 7) == 'existe_'){
                                        alert("Esta comunidade ja faz parte de algum pmda em Edição !");
                                        $("#txtIdComunidadeSearch").val("");
                                    }else if (response.substr(0, 7) == 'sucesso') {
                                        alert("Registro adicionado com sucesso !");
                                        //$("#tblComunidadePmda").html(response);
                                        $("#txtIdComunidadeSearch").val("");
                                        location.reload();
                                    }
                                    //console.log(response.substr(0, 7));
                                    //console.log(response);

                                },
                                error: function (e) {
                                    //console.log(JSON.stringify(e));
                                }
                            });

                            $("#id_comunidade").val("");
                            $("#txtNomeComunidade").val("");
                            $("#txtLatComunidade").val("");
                            $("#txtLongComunidade").val("");
                            $("#selPontoCapCom").val(0);
                            $("#txtTrecPavComunidade").val("");
                            $("#txtTrecNPavComunidade").val("");
                            $("#txtPopAtComunidade").val("");
                            $("#txtDistTotComunidade").val("");

                            $("#frmCadComunidade").hide();
                            $("#btnMostraCadComunidade").show();
                            return false;
                        }

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });






        });


        /************** Adicionar Representante ***************/
        $('#btnAddRep').click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        $("#txtIdPmda").val(<?= isset($id_pmda) ? $id_pmda : ""; ?>)

                        var dados = {

                            "opcao": "novo",
                            "id_comunidade": $("#idCom").val(),
                            "txtNomeRep": $("#txtNomeRep").val(),
                            "txtTelRep": $("#txtTelRep").val(),
                            "txtEnderecoRep": $("#txtEnderecoRep").val(),
                            "txtBairroRep": $("#txtBairroRep").val(),
                            "txtEmailRep": $("#txtEmailRep").val(),
                            "txtCpfRep": $("#txtCpfRep").val(),
                            "selWatsapp": $("#selWatsapp").val(),
                            "id_pmda": $("#txtIdPmda").val(),
                        };

                        if (
                                ($("#txtNomeRep").val() == "") ||
                                ($("#txtCpfRep").val() == "") ||
                                ($("#txtTelRep").val() == "") ||
                                ($("#idCom").val() == "") ||
                                ($("#txtIdPmda").val() == "")

                                ) {

                            alert("Os campos Representante, CPF e Telefone são Obrigatórios !");

                            //$("#txtNomeRep").css({bg-danger});	            	

                        } else {

                            var id_comunidade = $("#idCom").val();

                            $.ajax({
                                type: 'POST',
                                url: '/mod_pipa/backEnd/View/pmda/representante.php?v=<?= md5(VERSAO) ?>',
                                data: dados,
                                success: function (response) {
                                    $("#tblRep").html(response);
                                    //console.log(JSON.stringify(e));
                                },
                                error: function (e) {
                                    console.log(JSON.stringify(e));
                                }
                            });

                            /* limpar campos */
                            $("#txtNomeRep").val("");
                            $("#txtTelRep").val("");
                            $("#txtEnderecoRep").val("");
                            $("#txtBairroRep").val("");
                            $("#txtEmailRep").val("");
                            $("#txtCpfRep").val("");
                            $("#selWatsapp").val("Não");

                            $("#frmCadRepresentante").hide();
                            $("#btnMostraCadRep").show();
                            return false;

                        }
                        // codigo
                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });


        /************ Alterar Representante ****************/
        $('#btnAlterarRep').click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {

                        var id_pmda = getUrlVars()['param'];

                        var dados = {

                            "opcao": "alterar",
                            "id_rep": $("#txtIdRep").val(),
                            "id_comunidade": $("#idCom").val(),
                            "txtNomeRep": $("#txtNomeRep").val(),
                            "txtTelRep": $("#txtTelRep").val(),
                            "txtEnderecoRep": $("#txtEnderecoRep").val(),
                            "txtBairroRep": $("#txtBairroRep").val(),
                            "txtEmailRep": $("#txtEmailRep").val(),
                            "txtCpfRep": $("#txtCpfRep").val(),
                            "selWatsapp": $("#selWatsapp").val(),
                            "id_pmda": id_pmda,
                        };

                        $.ajax({
                            type: 'POST',
                            url: '/mod_pipa/backEnd/View/pmda/representante.php?v=<?= md5(VERSAO) ?>',
                            data: dados,
                            success: function (response) {
                                alert("Registro alterado com sucesso !");
                                $("#tblRep").html(response);
                            },
                            error: function (e) {
                                console.log(JSON.stringify(e));
                            }
                        });

                        $("#txtNomeRep").val("");
                        $("#txtTelRep").val("");
                        $("#txtEnderecoRep").val("");
                        $("#txtBairroRep").val("");
                        $("#txtEmailRep").val("");
                        $("#txtCpfRep").val("");
                        $("#selWatsapp").val("Não");

                        $("#divAlterarRep").hide();
                        $("#divAddRep").show();

                        $("#frmCadRepresentante").hide();
                        $("#btnMostraCadRep").show();

                        return false;
                        // codigo
                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });

        /* verifica digito CPF */
        $("#txtCpfRep").blur(function () {

            var cpf = $("#txtCpfRep").val();
            var result = TestaCPF(cpf);

            if (result) {
                $("#txtCpfRep").css('background-color', '#66CDAA');
                $("#txtCpfRep").css('color', '#ffffff');
                $("#txtCpfRep").attr('title', 'Cpf Válido !');

            } else {
                $("#txtCpfRep").css('background-color', '#FF6347');
                $("#txtCpfRep").attr('title', 'Cpf Inválido !');
                $("#txtCpfRep").css('color', '#ffffff');
                $("#txtCpfRep").val("");
            }

        });


    });

    function voltarAdm() {
        window.location.href = "<?= FuncaoBase::geraLink("pipa", "pipa", "pesquisaPmda", array('idmun' => $id_municipio)) ?>";

    }

    /*
     
     Deletar ponto de captacao
     @param id - identidicador do registro
     @param contexto - pagina envio
     @param view - atualizar tabela sem refresh
     
     */
    function deletarPonto(id) {

        //console.log($(this).attr('name'));

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {

                    var dados = {

                        "id_ponto": id,
                        "opcao": "delete",
                        "txtIdMunicipio": <?= isset($_COOKIE['seguranca']['id_municipio']) ? $_COOKIE['seguranca']['id_municipio'] : $_GET['mun']; ?>,
                    };

                    var confirm1 = confirm('Deseja realmente Apagar o Registro ?');

                    if (confirm1 == true) {

                        $.ajax({
                            type: 'POST',
                            url: '/mod_pipa/backEnd/View/pmda/ponto.php?v=<?= md5(VERSAO) ?>',
                            data: dados,
                            success: function (response) {
                                alert("Registro apagado com sucesso !");
                                $("#tblPontoCap").html(response);
                                //console.log(response);
                            }
                        });
                    }

                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });

    }





    /*
     
     Deletar comunidade do pmda
     @param id - identidicador do registro
     @param contexto - pagina envio
     @param view - atualizar tabela sem refresh
     
     */
    function deletarComunidade(id_com_pmda, id_comunidade, id_municipio, id_pmda) {

        //console.log($(this).attr('name'));

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {

                    var dados = {

                        "txtIdPmdaComun": id_com_pmda,
                        "opcao": "delete",
                        "id_pmda": id_pmda,
                        "txtIdComunidadeSearch": id_comunidade,
                        "txtIdMunicipio": id_municipio,
                    };

                    var result = confirm('Deseja realmente apagar a Comunidade ?');

                    if (result == true) {

                        $.ajax({
                            type: 'POST',
                            url: '/mod_pipa/backEnd/View/pmda/comunidade.php?v=<?= md5(VERSAO) ?>',
                            data: dados,
                            success: function (response) {
                                alert("Registro apagado com sucesso !");
                                $("#tblComunidadePmda").html(response);
                            },

                        });

                    }

                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });

    }


    /*
     
     Deletar Membro equipe
     @param id - identidicador do registro
     @param contexto - pagina envio
     @param view - atualizar tabela sem refresh
     
     
     */
    function deletarMembro(id) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {

                    //console.log($(this).attr('name'));
                    var dados = {

                        "id_equipe": id,
                        "opcao": "delete"
                    };

                    var confirm1 = confirm('Deseja realmente apagar o registro ?');

                    if (confirm1 == true) {

                        $.ajax({
                            type: 'POST',
                            url: '/mod_pipa/backEnd/View/pmda/membroEquipe.php?v=<?= md5(VERSAO) ?>',
                            data: dados,
                            success: function (response) {
                                alert("Registro apagado com sucesso !");
                                $("#tblMembroEquipe").html(response);
                                //console.log(response);
                            }
                        });
                    }

                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }

    /* deletar Representante */
    function deletarRep(id, id_comunidade, id_pmda) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {
                    //console.log($(this).attr('name'));

                    if (
                            (id == "") ||
                            (id_comunidade == "") ||
                            (id_pmda == "")

                            ) {

                        alert("Os campos são de preenchimento Obrigatório !");

                    } else {
                        var dados = {
                            "id_rep": id,
                            "opcao": "delete",
                            "id_comunidade": id_comunidade,
                            "id_pmda": id_pmda,
                        };

                        var result = confirm('Deseja realmente apagar o Representante ?');

                        if (result == true) {

                            $.ajax({
                                type: 'POST',
                                url: '/mod_pipa/backEnd/View/pmda/representante.php?v=<?= md5(VERSAO) ?>',
                                data: dados,
                                success: function (response) {
                                    alert("Registro apagado com sucesso !");
                                    $("#tblRep").html(response);
                                    //console.log(response);
                                }
                            });
                        }

                    }

                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }//
        });
    }


    function deletarAnexo(id, id_pmda, arquivo) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {

                    var dados = {

                        "id_anexo": id,
                        "opcao": "delete",
                        "arquivo": arquivo,
                        "txtIdPmda": id_pmda,
                    };

                    var confirm1 = confirm('Deseja realmente apagar o registro ?');

                    if (confirm1 == true) {

                        $.ajax({
                            type: 'POST',
                            url: '/mod_pipa/backEnd/View/pmda/valida_anexo.php?v=<?= md5(VERSAO) ?>',
                            data: dados,
                            success: function (response) {
                                //$("#tblAnexo").html(response);
                                alert("Registro apagado com sucesso !");
                                location.reload();
                                //console.log(response);
                            },
                            error: function (response) {
                                //console.log(response);
                            },
                        });
                    }
                    // codigo
                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }


    /*
     Alterar o Ponto captação
     
     
     */
    function alterarPonto(id, nome, tipo, lat, longitude, cap, id_municipio) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {
                    $("#divAlterarPontoCap").show();
                    $("#divAddPontoCap").hide();

                    $("#txtNomePontoCap").val(nome);
                    $("#selTipoPontoCap").val(tipo);
                    $("#txtLatPontoCap").val(lat);
                    $("#txtLongPontoCap").val(longitude);
                    $("#txtCapacidadePontoCap").val(cap);
                    $("#txtIdPontoCap").val(id);

                    $("#frmCadPontoCap").show();
                    $("#btnMostraCadPontoCap").hide();

                    // codigo
                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });

    }


    /*	Alterar o Membros Compdec */
    function alterarMembro(id, nome, funcao, telefone, celular, email) {

        $("#divAlterarMembroEquipe").show();
        $("#divAddMembroEquipe").hide();

        $("#txtNomeMembro").val(nome);
        $("#selFuncaoMembro").val(funcao);
        $("#txtTelMembro").val(telefone);
        $("#txtCelMembro").val(celular);
        $("#txtEmailMembro").val(email);
        $("#txtIdMembro").val(id);
        $("#btnMostraCadMembroCompdec").hide();
        $("#frmCadMembroCompdec").show();


    }

    /*	Alterar Comunidade */
    function alterarComunidade(id, comunidade, latitude, longitude, id_ponto, trecho_pav, trecho_n_pav, pop_atendida, id_pmda) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {

                    $("#btnAlterarComunidade").show();
                    $("#btnAddComunidade").hide();
                    $("#txtNomeComunidade").val(comunidade);
                    $("#txtLatComunidade").val(latitude);
                    $("#txtLongComunidade").val(longitude);
                    $("#txtTrecPavComunidade").val(trecho_pav);
                    $("#txtTrecNPavComunidade").val(trecho_n_pav);
                    $("#txtPopAtComunidade").val(pop_atendida);
                    $("#selPontoCapCom").val(id_ponto);
                    $("#txtIdComunidadeSearch").val(id);
                    $("#txtIdPmda").val(id_pmda);
                    $("#txtDistTotComunidade").val(parseFloat(trecho_pav) + parseFloat(trecho_n_pav));

                    $("#frmCadComunidade").show();

                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });

    }


    /*	
     
     Alterar Representante
     
     */
    function alterarRep(id, nome, endereco, bairro, email, tel, cpf, watsapp) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {

                if (response == "sucesso") {
                    $("#txtNomeRep").val(nome);
                    $("#txtTelRep").val(tel);
                    $("#txtEnderecoRep").val(endereco);
                    $("#txtBairroRep").val(bairro);
                    $("#txtEmailRep").val(email);
                    $("#txtCpfRep").val(cpf);
                    $("#txtIdRep").val(id);
                    $("#selWatsapp").val(watsapp);

                    $("#divAddRep").hide();
                    $("#divAlterarRep").show();

                    $("#btnMostraCadRep").hide();
                    $("#frmCadRepresentante").show();


                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });


    }


    /* envia para homologação */
    function homologa(id_pmda) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {
                    var dados = {

                        "btnEnviar": "gravar",
                        "id_pmda": id_pmda,
                        "status": "2",
                    };
                    var result = confirm("Deseja enviar o PMDA para Homologação ?");

                    if (result) {

                        $.ajax({
                            type: 'POST',
                            url: '/mod_pipa/backEnd/View/pmda/homologacao.php?v=<?= md5(VERSAO) ?>',
                            data: dados,
                            success: function (response) {
                                //console.log(response);
                                location.reload();
                            },
                            error: function (response) {
                                console.log(JSON.stringify(response));
                            }
                        });

                        $("#btnVerificar").hide();
                    }
                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }

    /* editar pmda */
    function editar(id_pmda, protocolo, id_municipio) {
        $.ajax({

            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {
                    var dados = [];
                    $.ajax({
                        type: 'POST',
                        url: '#',
                        data: dados,
                        success: function (response) {
                            window.location.href = '?token=<?= hash("sha256", md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=pipa&controller=pipa&action=pmda&param=' + id_pmda + '&p=' + protocolo + '&mun=' + id_municipio;
                        },
                        error: function (response) {
                            console.log(JSON.stringify(response));
                        }
                    });

                } else {
                    alert('Sessão expirada !')
                    //window.location.href ='index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }

    /* mensgem pmda */
    function mensagem() {
        $.ajax({

            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {
                    var dados = [];
                    $.ajax({
                        type: 'POST',
                        url: '#',
                        data: dados,
                        success: function (response) {
                            window.location.href = '?token=<?= hash("sha256", md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=pipa&controller=pipa&action=mensagem';
                        },
                        error: function (response) {
                            console.log(JSON.stringify(response));
                        }
                    });

                } else {
                    alert('Sessão expirada !')
                    //window.location.href ='index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }

    /* impressao pmda */
    function impressao(id_pmda, id_municipio) {
        $.ajax({

            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {
                    var dados = [];
                    $.ajax({
                        type: 'POST',
                        url: '#',
                        data: dados,
                        success: function (response) {
                            window.location.href = '?token=<?= hash("sha256", md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=pipa&controller=pipa&action=printPmda&param=' + id_pmda + '&mun=' + id_municipio;
                        },
                        error: function (response) {
                            console.log(JSON.stringify(response));
                        }
                    });
                    $("#btnVerificar").hide();
                } else {
                    alert('Sessão expirada !')
                    //window.location.href ='index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }

    /* Verifica Pendencias do PMDA */
    function verificaPendencia(id_pmda) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {

                    var dados = {

                        "btnEnviar": "verifica",
                        "id_pmda": id_pmda,
                    };
                    var result = confirm("Confirma a Verificação do Status do PMDA ?");

                    if (result) {

                        $.ajax({
                            type: 'POST',
                            url: '/mod_pipa/backEnd/View/pmda/homologacao.php?v=<?= md5(VERSAO) ?>',
                            data: dados,
                            success: function (response) {
                                console.log(response);
                                if (response == "0") {
                                    alert("Seu pmda não está em condiçoes de Envio para Homologação ! \n 1) Verifique os parâmetros mínimos para envio ! \n 2) Consulte a Documentação de Preenchimento ! \n 3) Fique atento as Regras de Aprovação do PMDA ! ");
                                    //location.reload();
                                } else if (response == "1") {
                                    alert("Este PMDA está com o mínino de condições para ser homologado, \nesta condição porém, deve ser avaliada pelo corpo técnico da Diretoria de Resposta à Desastres ! \n Por favor Clique em \"Enviar p/ Homologação\"");
                                }
                            },
                            error: function (response) {
                                console.log(JSON.stringify(response));
                            }
                        });
                    }

                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });


    }

    /* adicioanr id_comunidade para cadastro de representante */
    function addIdCom(id_comunidade, nome, id_pmda) {

        $("#tab_representante").attr("href", "#panel-representante");
        $("#tab_representamte").attr("data-toggle");
        $("#tab_representante").attr("data-toggle", "tab");

        $("#tab_representante").trigger("click");

        $('#tab_representante').removeAttr('href');
        $("#tab_representamte").removeAttr("data-toggle", "tab");

        //$("#frmCadRepresentante").hide();
        //$("#btnMostraCadRep").show();	

        $("#idCom").val(id_comunidade);
        $("#nomComunidade").html(nome);
        $("#divAddRep").show();
        $("#divAlterarRep").hide();

        var dados = {
            "id_comunidade": id_comunidade,
            "id_pmda": id_pmda,
        };
        $.ajax({
            type: 'POST',
            url: '/mod_pipa/backEnd/View/pmda/representante.php?v=<?= md5(VERSAO) ?>',
            data: dados,
            success: function (response) {
                $("#tblRep").html(response);
                //console.log(response);
            }
        });
    }

    function coordLat(latitude) {

        var result = latitude.replace(/S|º|,|’/g, "");
        var grau = result.substring(0, 2);
        var min = latitude.substring(4, 6);
        var seg = latitude.substring(10, 12);

        if (grau > 14) {
            return false;
        } else if ((grau == 14) && (min > 13)) {
            return false;
        } else if (min > 59) {
            return false;

        }

        var segundos = "";

        console.log(min);

        if ((result < "14135800") || (result > "22540000")) {

            $("#txtLatPontoCap").css("background-color", "#FB8694");
            $("#txtLatPontoCap").prop("title", "Latitude Fora do Território de Minas Gerais");
            $("#txtLatPontoCap").val("");

        }
    }

    /**
     * Download termo de compromisso
     */
    function termo_compromisso() {
        window.location.href = 'index.php?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=pipa&controller=pipa&action=termo&param=<?= $id_pmda; ?>&mun=<?= $id_municipio; ?>';

    }

    /**
     * Download Declaração ISS
     */
    function declaracaoiss() {
        window.location.href = 'index.php?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=pipa&controller=pipa&action=declaracaoiss&param=<?= $id_pmda; ?>&mun=<?= $id_municipio; ?>';

    }


    /**
     * Download 
     */
    function anexopmda(url) {
        window.location.href = url;
    }

    /* ver mensagens recebidas */
    function lerMensagemRecebida(id_pmda, status, opcao) {

        window.location.href = 'index.php?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=pipa&controller=pipa&action=mensagem&id_pmda=' + id_pmda + '&status=' + status + '&opcao=' + opcao;

    }

    function ajudacoordenada() {
        window.location.href = 'http://conversor-de-medidas.com/coordenadas-geograficas';
    }

    function passoapasso() {
        window.location.href = 'doc/PMDA_INSTRUCAO_VERSAO_COMPDEC.pdf';
    }




</script>