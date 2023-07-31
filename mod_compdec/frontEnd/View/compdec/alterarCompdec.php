<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_compdec/Model/Model.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menuExterno.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php
$_funcaoBase = new FuncaoBase();

$_municipio = new Municipio();

$_associacao = new Associacao();

$_regiao = new Regiao();

$_territorio = new Territorio();

$_compdec = new Compdec();

$_dados = array();

$_loginEx = new LoginExterno();

$id_municipio = $pageSession['session']['seguranca']['id_municipio'];

$_dados = $_compdec->buscaCompdec($id_municipio);

$dadosMunicipio = $_municipio->dadosMunicipio($_dados[0]['id_municipio']);

$status_anexo = Compdec::verificadoc($id_municipio);

$desatualiza = count($status_anexo);

if ($desatualiza > 0) {

    $voltar = "<button class=\"btn btn-success\" type=\"button\" onclick=\"focus_secao('tblAnexoLeis')\" title='Favor REANEXAR a lei de criação o decreto de regulamentação da lei e a portaria de nomeação do Coordenador Municipal'>Voltar</button>";
    $gravar = "<button class=\"btn btn-success\" type=\"button\" onclick=\"focus_secao('tblAnexoLeis')\" title='Favor REANEXAR a lei de criação o decreto de regulamentação da lei e a portaria de nomeação do Coordenador Municipal'>Gravar</button>";
    $alert = "<span class='alert alert-warning'>Prezado Coordenador, é necessário REANEXAR os documentos no SDC, Lei de Criação da COMPDEC, Decreto de Regulamentação e Portaria de Nomeação do Coordenador</span>";
} else {
    $voltar = "<a class=\"btn btn-success\" href=" . FuncaoBase::geraLink("compdec", "compdec", "index") . ">Voltar</a>";
    $gravar = "<span class=\"btn btn-success\" name=\"btnDados2\" id=\"btnDados2\">Gravar</span>";
    $alert ="";
}
?>


    <?= $alert ?>


<div class="col-md-3">
    <div class="card card-block">
        &nbsp;&nbsp;<img class="img-rounded" src="/anexo/brasao/<?= $_dados[0]['id_municipio'] . "_brasao.png"; ?>" width="115px;">
        &nbsp;&nbsp;
        <a class="btn btn-link" onClick="uploadModal('brasao')" title="Anexar Brasao" id="btnAlterarBrasao" name="btnAlterarBrasao">Alterar</a>
        <br><br>
    </div>
</div>

<div class="col-md-9 text-center">
    <?= $voltar ?>
    <br>
    </br></br>
    </br></br>
</div>



<h4>
    <p style="text-align: center"><?php print $_municipio->PegaNomeMunicipio($_dados[0]['id_municipio']); ?></p>
</h4>


<?= ($_dados[0]['com_ativa'] == 0) ? "<div class='alert alert-danger'>ESTE COMPDEC ESTÁ COM A SITUAÇÃO DE <b>'INATIVO' </b> NA GUIA DADOS GERAIS opção \"Situação do COMPDEC \". <BR>  FAVOR VERIFICAR ANTES DE ALTERAR OS DADOS </div>" : ""; ?>

<div class="tab-content">

    <div role="tabpanel" class="tab-pane1" id="panel-dados">

        <table class="table table-bordered">
            <tr>
                <td width="20%">
                    &nbsp;&nbsp;<img class="img-rounded" src="/anexo/prefeito/<?= AnexoPref::Foto($_dados[0]['id_municipio']); ?>" width="115px;"><br><br>
                    &nbsp;&nbsp;
                    <a class="btn btn-primary glyphicon glyphicon-user" onClick="uploadModal('prefeito')" title="Anexar Foto Prefeito" id="btnAlterarFotoPrefeito" name="btnAlterarFotoPrefeito">Alterar</a>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td>Prefeito:</td><td><input class="form-control" type="text" value="<?= $dadosMunicipio['prefeito']; ?>" name="txtPrefeito" id="txtPrefeito" maxlength="29"></td>
                        </tr>
                        <tr>
                            <td>Endereço:</td><td><input class="form-control" type="text" value="<?= $dadosMunicipio['endereco']; ?>" name="txtEndPref" id="txtEndPref" maxlength="69"></td>
                        </tr>
                        <tr>
                            <td>Bairro:</td><td><input class="form-control" type="text" value="<?= $dadosMunicipio['bairro']; ?>" name="txtBairroPref" id="txtBairroPref" maxlength="44"></td>
                        </tr>
                        <tr>
                            <td>Cep:</td><td><input class="form-control" type="text" value="<?= $dadosMunicipio['cep']; ?>" name="txtCepPref" id="txtCepPref" maxlength="9"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <p style='text-align:center'>
        <legend>DADOS CADASTRAIS</legend>
        </p>
        <label>Nome Município :</label>
        <input class="form-control" type="text" value="<?php print $_municipio->PegaNomeMunicipio($_dados[0]['id_municipio']); ?>" readonly="readonly">
        <br />
        <input class="form-control" type="hidden" name="id_municipio" id="id_municipio" value="<?php print $_dados[0]['id_municipio']; ?>" />
        <input class="form-control" type="hidden" name="txt_org_rep" id="txt_org_rep" value="-" />

        <div class="row">
            <div class="col-md-3">
                <?php
# possui compdec
                Html::inputSelect("compdec", "compdec", "Possui Compdec ?", Config::$SIMNAO, array(array($_dados[0]['com_const'], ($_dados[0]['com_const'] == '1' ? 'Sim' : 'Não'))), "");
                ?>
            </div>
            <div class="col-md-6">
                <!--possui efetivo -->
                <label>Possui Efetivo ? <span> Caso exista somente o Coordenador responda "sim"</span></label>
                <select class="form-control" name="selEfetivo" id="selEfetivo">
                    <option value="<?= $_dados[0]['efetivo']; ?>"><?= ($_dados[0]['efetivo'] == 0) ? "Sim" : "Não"; ?></option>
                    <option value="0">Sim</option>
                    <option value="1">Não</option>
                </select>
            </div>
            <div class="col-md-3">
                <?php
                Html::inputSelect("ativo", "ativo", "Situação do Compdec ?", Config::$ATIVOINATIVO, array(array($_dados[0]['com_ativa'], ($_dados[0]['com_ativa'] == '1' ? 'Ativo' : 'Inativo'))), "");
                ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <!--regioes de desenvolvimento do governo estadual -->
                <label>Região Desenvolvimento :</label>
                <select class="form-control" name="selTerritorioDesenv" id="selTerritorioDesenv">
                    <option value='<?= $_dados[0]['id_territorio']; ?>'>
                        <?php
                        $nomTerritorio = $_territorio->pegaNomeTerritorio($_dados[0]['id_territorio']);
                        print $nomTerritorio['nome'];
                        ?>
                    </option>
                    <?php
                    $_dados_territorio = $_territorio->dadosCombo();
                    foreach ($_dados_territorio as $key => $value) {
                        print "<option value='" . $value[0] . "'>" . $value[1] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <!--regioes de planejamento do governo estadual -->
                <label>Mesorregião Região :</label>
                <?php $_regiao->ComboRegiao($_dados[0]['regiao'], ""); ?>
            </div>
            <div class="col-md-4">
                <label>Associação</label>
                <?php $_associacao->ComboAssociacao($_dados[0]['associacao'], ""); ?>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-6">
                Número Lei :<input class="form-control" type="text" name="txt_num_lei" id="txt_num_lei" value="<?php print $_dados[0]['num_lei']; ?>" maxlength="10">&nbsp;&nbsp;
            </div>
            <div class="col-md-6">
                Data Lei:<input class="form-control" type="text" name="txt_dt_lei" id="txt_dt_lei" value="<?php print DataMysql::dataVisual($_dados[0]['dt_lei']); ?>" maxlength="10">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                Número Decreto:<input class="form-control" type="text" name="txt_num_decreto" id="txt_num_decreto" value="<?php print $_dados[0]['num_decreto']; ?>" maxlength="10">&nbsp;&nbsp;
            </div>
            <div class="col-md-6">
                Data Decreto :<input class="form-control" type="text" name="txt_dt_decreto" id="txt_dt_decreto" value="<?php print DataMysql::dataVisual($_dados[0]['dt_decreto']); ?>" maxlength="10" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Número Portaria:<input class="form-control" type="text" name="txt_num_portaria" id="txt_num_portaria" value="<?php print $_dados[0]['num_portaria']; ?>" maxlength="10"> &nbsp;&nbsp;
            </div>
            <div class="col-md-6">
                Data Portaria:<input class="form-control" type="text" name="txt_dt_portaria" id="txt_dt_portaria" value="<?php print DataMysql::dataVisual($_dados[0]['dt_portaria']); ?>" maxlength="10"/>
            </div>
        </div>
        <label>Endereço (Compdec):</label>
        <input class="form-control" type="text" name="txt_endereco" id="txt_endereco" value="<?php print $_dados[0]['endereco']; ?>" maxlength="100">

        <div class="row">
            <div class="col-md-6">
                <label>Telefone (Compdec)</label>
                <input class="form-control" type="text" name="txt_comp_fone1" id="txt_comp_fone1" value="<?php print $_dados[0]['fone_com1']; ?>" maxlength="20">
            </div>
            <div class="col-md-6">
                <label>Telefone2 (Compdec)</label>
                <input class="form-control" type="text" name="txt_comp_fone2" id="txt_comp_fone2" value="<?php print $_dados[0]['fone_com2']; ?>" maxlength="20">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label>Possui Nupdec ?</label>
                <select class="form-control" name="selNudec" id="selNudec">
                    <option value="<?= $_dados[0]['nudec']; ?>"><?= ($_dados[0]['nudec'] == 0) ? "Sim" : "Não"; ?></option>
                    <option value="0">Sim</option>
                    <option value="1">Não</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Quantos nupdec's ?</label>
                <input class="form-control" type="text" name="txt_qtd_nudec" id="txt_qtd_nudec" value="<?php print $_dados[0]['qtd_nudec']; ?>" maxlength="1">
            </div>
            <div class="col-md-4">
                <label>Quantos integrantes ?</label>
                <input class="form-control" type="text" name="txt_qtd_efetivo" id="txt_qtd_efetivo" value="<?php print $_dados[0]['qtd_efetivo']; ?>" maxlength="2">
            </div>


        </div>

        <label>Qual a capacitação dos Membros ?</label>
        <input class="form-control" name='txt_cap_nupdec' id='txt_cap_nupdec' value="<?php print $_dados[0]['capacitacao_nupdec'] ?>" maxlength="70">
        <br><br>
        <button class="" type="button" name="btnDados" id="btnDados">-</button>
    </div>

    <!-- ABA DADOS PARTE 2 -->
    <div role="tabpanel" class="tab-pane1" id="panel-dados2">

        <br>
        <div class='col-md-12'>
            <label style="color:red">Email Rec : ( será usado para Login e Recuperação de Senha de acesso, apenas um email )</label>
            <input class="form-control" type="email" name="txt_email_rec" id="txt_email_rec" value="<?php print $_dados[0]['email_rec']; ?>" required maxlength="100">
        </div>

        <div class='col-md-12'><br>
            <label style="">Email 1:</label>
            <?php //Compdec::getEmailRec();
            ?>
            <input class="form-control" type="email" name="txt_email" id="txt_email" value="<?php print $_dados[0]['email']; ?>" required maxlength="100">
            <span id='sp_email' style="color: red">Email invalido !</span>
        </div>
        <div class='col-md-12'><br>
            <label style="">Email 2:</label>
            <?php //Compdec::getEmailRec();
            ?>
            <input class="form-control" type="email" name="txt_email2" id="txt_email2" value="<?php print $_dados[0]['email2']; ?>" required maxlength="100">
            <span id='sp_email2' style="color: red">Email invalido !</span>
        </div>

        <div class='col-md-12'><br>
            <label style="">Email 3: </label>
            <?php //Compdec::getEmailRec();
            ?>
            <input class="form-control" type="email" name="txt_email3" id="txt_email3" value="<?php print $_dados[0]['email3']; ?>" required maxlength="100">
            <span id='sp_email3' style="color: red">Email invalido !</span>
        </div>
        <div class='col-md-6'>
            <br>
            <label style="">Email da Prefeitura </label>
            <?php //Compdec::getEmailRec();
            ?>
            <input class="form-control" type="text" name="email_prefeitura" id="email_prefeitura" value="<?= $dadosMunicipio['email'] ?>" maxlength="45">
        </div>
        <br>
        <!-- # telefone prefeiura e prefeito -->
        <div class='col-md-6'>
            <br>
            <label style="">Telefone Prefeito </label>
            <input class="form-control" type="text" name="tel_pref" id="tel_pref" value="<?= $dadosMunicipio['tel_pref'] ?>" maxlength="20">
        </div>
        <div class='col-md-6'>
            <label style="">Celuar Prefeito </label>
            <input class="form-control" type="text" name="cel_pref" id="cel_pref" value="<?= $dadosMunicipio['cel_pref'] ?>" maxlength="20">
        </div>

        <br>
        <div class='col-md-6'>
            <label>Possui Plano de Contingência ?</label>
            <div class="form-group">
                <div class="radio">
                    <label>
                        <input class="" type="radio" name="rdb_plano" value="0" <?php print ($_dados[0]['plano_cont'] == 0) ? 'checked="checked"' : ''; ?> />
                        Não
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input class="" type="radio" name="rdb_plano" value="1" <?php print ($_dados[0]['plano_cont'] == 1) ? 'checked="checked"' : ''; ?> />
                        Sim
                    </label>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <label>Possui Capacitação em Proteção e Defesa Civil ?</label>
            <div class="form-group">
                <div class="radio">
                    <label>
                        <input class="" type="radio" name="rdb_capacitacao" id="rdb_capacitacao" value="0" <?php print ($_dados[0]['capacitacao'] == 0) ? 'checked="checked"' : ''; ?> />
                        Não
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input class="" type="radio" name="rdb_capacitacao" id="rdb_capacitacao" value="1" <?php print ($_dados[0]['capacitacao'] == 1) ? 'checked="checked"' : ''; ?> />
                        Sim
                    </label>
                </div>
            </div>
            <label>Data do Curso :</label> <input class="form-control nretira" type="text" name="txt_dt_curso" id="txt_dt_curso" value="<?php print DataMysql::dataVisual($_dados[0]['dt_curso_capac']); ?>" maxlength="10">
        </div>
        <br>
        <div class='col-md-6'>
            <label>Possui Cartão de Proteção e Defesa Civil ?</label>
            <div class="form-group">
                <div class="radio">
                    <label>
                        <input class="" type="radio" name="rdb_cartao" id="rdb_cartao" value="0" <?php print ($_dados[0]['cartao_pdc'] == 0) ? 'checked="checked"' : ''; ?> />
                        Não
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="radio">
                    <label>
                        <input class="" type="radio" name="rdb_cartao" id="rdb_cartao" value="1" <?php print ($_dados[0]['cartao_pdc'] == 1) ? 'checked="checked"' : ''; ?> />
                        Sim
                    </label>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <label>Estrutura da Compdec</label><br>
            <input class="" type="checkbox" name="ck_sede" id="ck_sede" <?php print ($_dados[0]['sede_propria'] == 1) ? 'checked="checked" value="1"' : 'value="0"'; ?> />&nbsp;&nbsp;Sede Própria
            <br>
            <input class="" type="checkbox" name="ck_viatura" id="ck_viatura" <?php print ($_dados[0]['viatura'] == 1) ? 'checked="checked"  value="1"' : 'value="0"'; ?> />&nbsp;&nbsp;Viaturas
            <br>
            <input class="" type="checkbox" name="ck_computador" id="ck_computador" <?php print ($_dados[0]['computador'] == 1) ? 'checked="checked"  value="1"' : 'value="0"'; ?> />&nbsp;&nbsp;Computadores
        </div>
        <br>

        <div class='col-md-6'>
            <label>Realiza Simulados </label>
            <br>
            <div class="form-group">
                <div class="radio">
                    <label>
                        <input class="" type="radio" name="rdb_simulado" id="rdb_simulado" value="0" <?php print ($_dados[0]['simulado'] == 0) ? 'checked="checked"' : ''; ?> />
                        Não
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="radio">
                    <label>
                        <input class="" type="radio" name="rdb_simulado" id="rdb_simulado" value="1" <?php print ($_dados[0]['simulado'] == 1) ? 'checked="checked"' : ''; ?> />
                        Sim
                    </label>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <label>Possui mapeamento de área de risco ?</label>
            <br>
            <div class="form-group">
                <div class="radio">
                    <label>
                        <input class="" type="radio" name="rdb_mapeamento" id="rdb_mapeamento" value="0" <?php print ($_dados[0]['mapeamento'] == 0) ? 'checked="checked"' : ''; ?> />
                        Não
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="radio">
                    <label>
                        <input class="" type="radio" name="rdb_mapeamento" id="rdb_mapeamento" value="1" <?php print ($_dados[0]['mapeamento'] == 1) ? 'checked="checked"' : ''; ?> />
                        Sim
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <label>Sobre a Capacidade gerencial do COMPDEC</label>
            <div class='col-md-6'>
                <br>
                <input class="" type="checkbox" name="ck_curso_gestao" id="ck_curso_gestao" value="1" <?php print ($_dados[0]['curso_gestao'] == 1) ? 'checked="checked"' : ''; ?> />&nbsp;&nbsp;Possui Curso de Gestão em Proteção e Defesa Civil e Mudanças Climáticas<br><br>

                Data Curso <input class="form-control" type="text" name="dt_curso_gestao" id="dt_curso_gestao" value="<?php print DataMysql::dataVisual($_dados[0]['dt_curso_gestao']) ?>" maxlength="10"><br>

                <input class="" type="checkbox" name="ck_curso_sco" id="ck_curso_sco" value="1" <?php print ($_dados[0]['curso_sco'] == 1) ? 'checked="checked"' : ''; ?> />&nbsp;&nbsp;Possui Curso de SCO ( Sistema de Comandos e Operações).<br>

                Data Curso <input class="form-control nretira" type="text" name="dt_curso_sco" id="dt_curso_sco" value="<?php print DataMysql::dataVisual($_dados[0]['dt_curso_sco']); ?>" maxlength="10"><br>

            </div>
            <div class='col-md-6'>
                <input class="" type="checkbox" name="ck_particip_workshop" id="ck_particip_workshop" value="1" <?php print ($_dados[0]['particip_workshop'] == 1) ? 'checked="checked"' : ''; ?> />&nbsp;&nbsp;Participou de WorkShop<br>

                Data <input class="form-control nretira" type="text" name="dt_partic_workshop" id="dt_partic_workshop" value="<?php print DataMysql::dataVisual($_dados[0]['dt_partic_workshop']); ?>" maxlength="10">

                <input class="" type="checkbox" name="ck_exp_dc" id="ck_exp_dc" value="1" <?php print ($_dados[0]['exp_dc'] == 1) ? 'checked="checked"' : ''; ?> />&nbsp;&nbsp;Possui experiencia na área<br>

                Tempo ( Anos ) <input class="form-control" type="text" name="tp_ex_dc" id="tp_ex_dc" value="<?php print $_dados[0]['tp_ex_dc']; ?>" maxlength="2">

                <br>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <?= $gravar ?>
        <br>
        <br>
    </div>
    <br>



    <!-- ABA COMPDEC -->
    <div role="tabpanel" class="tab-pane1" id="panel-compdec">
        <br>

        <!-- Formulario cadastro membro equipe -->
        <p style="text-align:center">

        </p>
        <br>
        <div id="spanSemEfetivo" class="alert alert-danger">Este compdec não tem Efetivo ( Revise o cadastro de compdec na guia "Dados Gerais -> Possiu Efetivo ?" )</div>
        <div class='row'>
            <div class="col-md-3 text-center" id="tblMembroEquipe">
                <img class="img-rounded" src="/anexo/compdec/<?= AnexoCompdec::Foto($_dados[0]['id_municipio']); ?>" width="115px;">
                <br><br>
                <a class="btn btn-info" onClick="uploadModal('compdec')" title="Alterar Foto Compdec" id="btnAlterarFoto" name="btnAlterarFoto">Alterar Foto</a>
            </div>
            <div class='col-md-9'>
                <?php
                $compdec = new MembroEqCompdec();

                $membros = $compdec->listaMembro($_dados[0]['id_municipio']);
                print "Coordenador Municipal de Proteção e Defesa Civil<br>";
                foreach ($membros as $value) {
                    if (($value['funcao'] == 'Coordenador') || ($value['funcao'] == 'COORDENADOR')) {
                        print $value['nome'];
                    }
                }
                ?>
            </div>
            <div class='col-md-12 text-center' id='equipe' >
                <button type='button' id='btnAddMembro' class='btn btn-primary'>Adicionar Membro Compdec</button>
                <br><br>
            </div>


            <div class="span12" id="formMembro">
                <div class='col-md-12 text-center'>
                    <legend>EDITAR EQUIPE COMPDEC</legend>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <label>Nome</label>
                        <input class="form-control" type="text" name="txtNomeMembro" id="txtNomeMembro" required maxlength="70">&nbsp;<span style="color: red; font-size: 13pt;" >*</span>
                    </div>

                    <div class="col-md-6">
                        <label>Função</label>
                        <select class="form-control" id="selFuncaoMembro" name="selFuncaoMembro" class="form-control">

                            <option>Selecione a Função</option>
                            <option>Coordenador</option>
                            <option>Secretário</option>
                            <option>Agente</option>
                        </select><span style="color: red; font-size: 13pt;">*</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <label>CPF</label>
                        <input class="form-control" type="text" name="txtCpf" id="txtCpf" required maxlength="15" data-mask='999.999.999-99'>&nbsp;<span style="color: red; font-size: 13pt;" >*</span>
                    </div>

                    <div class="col-md-6">
                        <label>Telefone</label>
                        <input class="form-control" type="text" name="txtTelMembro" id="txtTelMembro" maxlength="20">
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <label>Celular</label>
                        <input class="form-control" type="text" name="txtCelMembro" id="txtCelMembro" maxlength="20">
                    </div>


                    <div class="col-md-6">
                        <label>Email</label>
                        <input class="form-control" type="email" name="txtEmailMembro" id="txtEmailMembro" maxlength="100" ><span style="color: red; font-size: 13pt;">*</span>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <input class="form-control" type="hidden" name="txtIdMembro" id="txtIdMembro" maxlength="5">
                        <input class="form-control" type="hidden" name="txtIdMunicipio" id="txtIdMunicipio" value="<?php print $_dados[0]['id_municipio']; ?>" maxlength="5">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-info" id="btnGravarMembro" type="button" title="Grava o Membro do Compdec Preenchido no Formulário.">Gravar Membro Equipe</button>
                        <button type="button" id="btnAlterarMembro" class="btn btn-success">Alterar Membro</button>
                    </div>
                </div>
                <br>
            </div>

            <div class="col-md-12" >

                <?php
                $pageSession['session']['seguranca']['id_municipio'] = $_dados[0]['id_municipio'];

                include PATH . '/mod_pipa/frontEnd/View/pmda/membroEquipe.php';
                ?>
            </div>
        </div>

        </form>

        <!-- Modal Adicionar Foto compdec -->
        <div id="modalWindowFotoCompdec" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header" id="leis_anexos">
                        <button type="button" class="close" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Upload</h4>
                    </div>
                    <div class="modal-body">
                        <input class="form-control btn" type="file" name="fileAnexo" accept=".jpg,.png" id="fileAnexo" /> <br> <br>
                        <p style='color:red; font-size:15pt' id='sp_size_comp'>&nbsp;</p>
                        <p>Tipos de Imagem válidas  <b style="color:red">"JPG", "PNG"</b></p>
                        <p>Tamanho máximo da imágem :  <b style="color:red">400kb</b></p>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" name="btnGravarFoto" id="btnGravarFoto">Upload Foto</button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <!-- Modal Adicionar Foto Prefeito-->
            <div class="modal fade" id="modalWindowFotoPrefeito">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Upload Foto Prefeito</h4>
                        </div>
                        <div class="modal-body">
                            <input class="form-control btn" type="file" accept=".jpg,.png" name="fileAnexoPref" id="fileAnexoPref" /> <br> <br>
                            <p style='color:red; font-size:15pt' id='sp_size_pref'>&nbsp;</p>
                            <p>Tipos de Imagem válidas  <b style="color:red">"JPG", "PNG"</b></p>
                            <p>Tamanho máximo da imágem :  <b style="color:red">400kb</b></p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button class="btn btn-info" type="button" name="btnGravarFotoPref" id="btnGravarFotoPref" value="salvar">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Adicionar brasao -->
            <div class="modal fade" id="modalWindowBrasao">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Upload Brasão</h4>
                        </div>
                        <div class="modal-body">
                            <input class="form-control btn" type="file" accept=".jpg,.png" name="fileAnexoBrasao" id="fileAnexoBrasao" /> <br> <br>
                            <p style='color:red; font-size:15pt' id='sp_size_pref'>&nbsp;</p>
                            <p>Tipos de Imagem válidas  <b style="color:red">"PNG"</b></p>
                            <p>Tamanho máximo da imágem :  <b style="color:red">400kb</b></p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button class="btn btn-info" type="button" name="btnGravarBrasao" id="btnGravarBrasao" value="salvar">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- ABA ANEXO LEIS -->
    <br>
    <div role="tabpanel" class="tab-pane1" id="panel-anexo">

        <p style='text-align:center'>
        <legend>ANEXO LEIS E DECRETOS</legend>
        </p>

        <div class="col-md-12">
            <h4><p style="text-align:center;">LEIS E DECRETOS</p></h4>
            <br>
            <!--<span class="alert alert-danger">OBS: Quando as três opções abaixo estiverem marcadas não será possível anexar os documentos</span></br> </br> </br> -->

            <table class="table table-bordered table-striped table-condensed tbl">
                <tr>
                    <td>
                        <input type="checkbox" name="ckSemDoc" id="sem_decreto" value="1" <?= ($_dados[0]['sem_decreto']) == "1" ? "checked='ckecked'" : ""; ?>> Não possui Decreto de Regulamentação da Lei de Criação do COMPDEC <br><br>
                        <input type="checkbox" name="ckSemDoc" id="sem_portaria" value="1" <?= ($_dados[0]['sem_portaria']) == "1" ? "checked='ckecked'" : ""; ?>> Não possui Portaria de Nomeação do Coordenado Municipal de Defesa Civil<br><br>
                        <input type="checkbox" name="ckSemDoc" id="sem_lei" value="1" <?= ($_dados[0]['sem_lei']) == "1" ? "checked='ckecked'" : ""; ?>> Não possui Lei de Criação do COMPDEC
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-12" id="tblAnexoLeis">
            <span class="alert alert-danger">Favor NÃO anexar documento fora do conteúdo solicitado. !</span></br></br><br>
            

            <?=$alert?>
            </br></br>
            <?php
            include PATH . '/mod_compdec/frontEnd/View/compdec/anexo.php';
            /* print "<table class='table table-bordered'>";
              # linha informando q nao tem lei de criacao
              if ($_dados[0]['sem_lei'] == 1) {
              print "<tr>
              <td style='background-color:#00FF80;text-align:center' title='' colspan='7'>Não possui Lei de Criação da COMPDEC</td>";
              }

              # linha informando q nao tem decreto
              if ($_dados[0]['sem_decreto'] == 1) {
              print "<tr>
              <td style='background-color:#00FF80;text-align:center' title='' colspan='7'>Não possui Decreto de Regulamentação da Lei de Criação do Compdec</td>";
              }

              # linha informando q nao tem Portaria de nomeação compdec
              if ($_dados[0]['sem_portaria'] == 1) {
              print "<tr>
              <td style='background-color:#00FF80;text-align:center' title='' colspan='7'>Não possui Portaria de Nomeação do Coordenador Municipal de Defesa Civil </td>";
              }
              print '</table>'; */
            ?>
        </div>
        <!-- Modal Adicionar Anexo Leis  -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Upload de Arquivo</h4>
                    </div>
                    <div class="modal-body">
                        <form name="frmAnexoLeis" enctype="multipart/form-data">
                            <input class="form-control" type="file" accept=".jpg,.pdf,.png" name="fileAnexoLeis" id="fileAnexoLeis" >
                            <br>
                            <span id='sp_size' class="col-md-12">
                                <span style='color:red' class="col-md-11" id='sp_size_lei'>&nbsp;</span>
                                <img id='sp_size_img' width="25px;" class="pull-right" src="/core/imagem/check.png"><br>
                            </span>
                            <br>
                            <p class="alert alert-danger">
                                -> Evite nome de arquivos con espaços<br>                                
                            </p>
                            <br>
                            <p>Tipos de Imagem válidas : <b style="color:red">"PDF"</b></p>
                            <span>Tamanho máximo da imágem :  <b style="color:red">2 MB</b></span><br>
                            <label>Descrição</label>
                            <input class="form-control" type='text' name='txtDescricao' id='txtDescricao' maxlength="40">
                            <label>Tipo Doc</label>
                            <select class="form-control" name="selTipo" id="selTipo">
                                <option value="0">Decreto</option>
                                <option value="1">Lei Criação</option>
                                <option value="2">Portaria Nomeação</option>
                            </select>
                            <br>
                            <input type='hidden' name='txtDtAnexo' id='txtDtAnexo' value='<?= date('Y/m/d H:i:s'); ?>' >
                            <input type='hidden' name='txtIdMunicipio' id='txtIdMunicipio' value='<?= $_dados[0]['id_municipio']; ?>' maxlength="5">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info" type="button" name="btnGravarLeis" id="btnGravarLeis">Salvar</button>
                        <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</div>
<!--</div>-->


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">
    $(document).ready(function () {

        $('#span_info').hide();
        var info = '<?= $info ?>';
        if (info.length > 0) {
            $('#span_info').text(info).addClass('alert alert-danger h4');
            $('#span_info').show();
        }


        $('#tbl_equipe > tbody  > tr').each(function (index, tr) {
            if (index > 0) {
                var table = tr.cells[2].innerHTML;
                var coord = tr.cells[3].innerHTML;
                if(table === "" && coord === 'Coordenador'){
                    focus_secao('equipe');
                }
            }
        });

        if(<?=$desatualiza?> > 0) {
            focus_secao('tblAnexoLeis');
        
        }
        
      
        $("#sp_email").hide();
        $("#sp_email2").hide();
        $("#sp_email3").hide();
        $("#txt_email").blur(function () {
            var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if ($("#txt_email").val().length > 0) {
                var email = $("#txt_email").val();
                if (!email.match(validRegex)) {
                    $("#sp_email").css('color', 'red');
                    $("#sp_email").show();
                    $("#txt_email").focus();
                    return true;
                } else {
                    $("#sp_email").hide();
                }
            } else {
                $("#sp_email").hide();
            }
        });
        $("#txt_email2").blur(function () {
            var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if ($("#txt_email2").val().length > 0) {
                var email = $("#txt_email2").val();
                if (!email.match(validRegex)) {
                    $("#sp_email2").css('color', 'red');
                    $("#sp_email2").show();
                    $("#txt_email2").focus();
                    return true;
                } else {
                    $("#sp_email2").hide();
                }
            } else {
                $("#sp_email2").hide();
            }
        });
        $("#txt_email3").blur(function () {
            var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if ($("#txt_email3").val().length > 0) {
                var email = $("#txt_email3").val();
                if (!email.match(validRegex)) {
                    $("#sp_email3").css('color', 'red');
                    $("#sp_email3").show();
                    $("#txt_email3").focus();
                    return true;
                } else {
                    $("#sp_email3").hide();
                }
            } else {
                $("#sp_email3").hide();
            }
        });
        /*Swal.fire({
         icon: 'error',
         title: 'Mudanças para Atualização de Anexos de Leis',
         text: 'Apartir do dia 18/08/2021, foi mudado a forma de hospedagem de documentos, será necessária a aprovação dos Anexos de Lei de Criação, Decreto de Regulamentação da Lei e Portaria de Nomeação do Coordenador por um Analista da CEDEC. \n O processo será feito Gradualmente'
         });*/

        $("#btn_anexo").click(function () {
            $("#btnDados2").trigger('click', [false]);
        });
        $("#fileAnexoPref").change(function () {
            var size = $("#fileAnexoPref")[0].files[0].size;
            if (size > 419430) {
                alert('Seu arquivo é maior que 400Kb')
                $("#sp_size_pref").text('Seu arquivo é maior que o recomendado !\n Gentileza verificá-lo !');
                $("#btnGravarFotoPref").hide();
            } else {
                $("#btnGravarFotoPref").show();
            }
        });
        $("#fileAnexo").change(function () {
            var size = $("#fileAnexo")[0].files[0].size;
            if (size > 419430) {
                alert('Seu arquivo é maior que 400Kb')
                $("#sp_size_comp").text('Seu arquivo é maior que o recomendado !\n Gentileza verificá-lo !');
                $("#btnGravarFoto").hide();
            } else {
                $("#btnGravarFoto").show();
            }
        });
        /* $("#txt_email").blur(function(){
         
         var email = validaEmail($("#txt_email").val());
         
         if(email) {
         alert("ok");
         }else {
         alert("Email inválido !");
         //$("#txt_email").focus();
         }
         
         }); */

        $('#sp_size_img').hide();
        $("#fileAnexoLeis").change(function () {
            tamanho = this.files;
            $('#sp_size_lei').text('Tamanho : ' + Number.parseFloat(tamanho[0].size / 1000000).toFixed(2) + ' Mb');
            if (tamanho[0].size < 1999353) {
                $('#sp_size_lei').addClass('alert alert-info');
                $('#sp_size_lei, #sp_size_img').show();
            } else {
                $('#sp_size_lei').addClass('alert alert-danger');
                $('#sp_size_img').attr("src", '/core/imagem/remove.png');
                $('#sp_size_img').show();
            }
            if (tamanho[0]['size'] > 1999353) {
                $("#btnGravarLeis").attr("disabled", true);
                $("#btnGravarLeis").attr("title", "Seu arquivo é maior que 2mb tente reescanear com a opção compactar !");
                Swal.fire({
                    icon: 'error',
                    title: 'Ocorreu um Erro !',
                    text: 'Algo deu errado, seu arquivo é maior que : 2 megas!',
                    footer: '<a target=\'_blank\' href=\'https://www.ilovepdf.com/pt/comprimir_pdf\'>Clique aqui e tente comprimir seu arquivo </a>'
                });
            } else {
                $("#btnGravarLeis").attr("disabled", false);
            }

        });
        /* $('#tabs-166211 a').click(function (e) {
         e.preventDefault()
         $(this).tab('show')
         }); */

        $("#menu_compdec").height($(".form_cadastro").height());
        $("#txt_dt_lei").datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: null
        });
        $("#txt_dt_decreto").datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: null
        });
        $("#txt_dt_portaria").datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: null
        });
        $("#txt_dt_curso").datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: null
        });
        $("#dt_curso_gestao").datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: null
        });
        $("#dt_curso_sco").datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: null
        });
        $("#dt_partic_workshop").datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: null
        });
        $("#txtTelMembro").mask("(00) 0-0000-0009");
        $("#txtCelMembro").mask("(00) 0-0000-0009");
        $("#txt_comp_fone1").mask("(00) 0-0000-0009");
        $("#txt_comp_fone2").mask("(00) 0-0000-0009");
        $("#txt_dt_lei").mask("99/99/9999");
        $("#txt_dt_decreto").mask("99/99/9999");
        $("#txt_dt_portaria").mask("99/99/9999");
        $("#txt_dt_curso").mask("99/99/9999");
        $("#dt_curso_gestao").mask("99/99/9999");
        $("#dt_curso_sco").mask("99/99/9999");
        $("#dt_partic_workshop").mask("99/99/9999");
        $("#formMembro").hide();
        $("#btnAlterarMembro").hide();
        /* mostr form cadastro membro*/
        $("#btnAddMembro").click(function () {

            $("#formMembro").show();
            $("#btnAddMembro").hide();
        });
        /* read only mudança (existe efetivo ?) */
        $("#selCompdec").change(function () {
            if ($("#selCompdec").val() == 0) {
                $("#cadastro_compdec").find('input, radio, textarea, select, button, a').attr('readonly', 'readonly');
                $("#cadastro_compdec").find('button').attr('disabled', 'disabled');
                $("#spanSemEfetivo").show();
                $("#tblMembroEquipe").hide();
                $("#selCompdec").removeProp('readonly');
                $("#btn_enviar").removeProp('disabled');
            } else {
                $("#cadastro_compdec").find('input, radio, textarea, select, button, a').removeProp('disabled');
                $("#tblMembroEquipe").show();
                $("#spanSemEfetivo").hide();
            }
        });
        /* read only no carregamento*/
        if ($("#selCompdec").val() == 1) {
            $("#cadastro_compdec").find('input, radio, textarea, select, button, a').removeProp('disabled');
            $("#tblMembroEquipe").show();
            $("#spanSemEfetivo").hide();
            $("#selCompdec").removeProp('disabled');
        } else {
            $("#cadastro_compdec").find('input, radio, textarea, select, button, a').attr('disabled', 'disabled');
            $("#tblMembroEquipe").hide();
            $("#spanSemEfetivo").show();
        }

        /* gravar membro equipe */
        $("#btnGravarMembro").click(function () {

            if (
                    ($("#txtNomeMembro").val() == "") ||
                    ($("#selFuncaoMembro").val() == "") ||
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
                    "txtCpf": $("#txtCpf").val(),
                };
                $.ajax({
                    type: 'POST',
                    url: 'mod_pipa/frontEnd/View/pmda/membroEquipe.php?v=<?= md5(VERSAO) ?>',
                    data: dados,
                    //dataType: 'json',
                    success: function (response) {
                        alert("Registro adicionado com sucesso !");
                        location.reload();
                        //console.log(response);
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
                $("#txtCpf").val("");
                $("#formMembro").hide();
                $("#btnAddMembro").show();
            }
        });
        /**
         * gravar dados parte 1
         *
         */
        $("#btnDados").click(function () {

            if (false) {
                alert("Todos os Campos São Obrigatórios !");
            } else {

                var dados = {
                    "opcao": "parte1",
                    "id_municipio": $("#id_municipio").val(),
                    "selCompdec": $("#selCompdec").val(),
                    "selAtivo": $("#selAtivo").val(),
                    "selTerritorioDesenv": $("#selTerritorioDesenv").val(),
                    "sel_regiao": $("#sel_regiao").val(),
                    "sel_associacao": $("#sel_associacao").val(),
                    "txt_num_lei": $("#txt_num_lei").val(),
                    "txt_dt_lei": $("#txt_dt_lei").val(),
                    "txt_num_decreto": $("#txt_num_decreto").val(),
                    "txt_dt_decreto": $("#txt_dt_decreto").val(),
                    "txt_num_portaria": $("#txt_num_portaria").val(),
                    "txt_dt_portaria": $("#txt_dt_portaria").val(),
                    "txt_endereco": $("#txt_endereco").val(),
                    "txt_comp_fone1": $("#txt_comp_fone1").val(),
                    "txt_comp_fone2": $("#txt_comp_fone2").val(),
                    "selEfetivo": $("#selEfetivo").val(),
                    "txt_qtd_efetivo": $("#txt_qtd_efetivo").val(),
                    "selNudec": $("#selNudec").val(),
                    "txt_cap_nupdec": $("#txt_cap_nupdec").val(),
                    "txt_qtd_nudec": $("#txt_qtd_nudec").val(),
                };
                $.ajax({
                    type: 'POST',
                    url: 'mod_compdec/frontEnd/View/compdec/valida.php?v=<?= md5(VERSAO) ?>',
                    data: dados,
                    //dataType: 'json',
                    success: function (response) {
                        //alert("Registro Atualizado com Sucesso !");
                        //console.log(response);
                        //location.reload();
                    },
                    error: function (e) {
                        console.log(JSON.stringify(dados));
                    }

                });
            }
        });
        /**
         * dados parte 2
         *
         */
        $("#btnDados2").click(function (e, param) {


            if (validaEmail($("#txt_email").val())) {


                $("#btnDados").trigger("click");
                /* ck sede */
                if ($("#ck_sede").is(":checked")) {
                    $("#ck_sede").val(1);
                } else {
                    $("#ck_sede").val(0);
                }

                /* ck viatura */
                if ($("#ck_viatura").is(":checked")) {
                    $("#ck_viatura").val(1);
                } else {
                    $("#ck_viatura").val(0);
                }
                /* ck computador */
                if ($("#ck_computador").is(":checked")) {
                    $("#ck_computador").val(1);
                } else {
                    $("#ck_computador").val(0);
                }

                if ($("#ck_curso_gestao").is(":checked")) {
                    $("#ck_curso_gestao").val(1);
                } else {
                    $("#ck_curso_gestao").val(0);
                }

                if ($("#ck_curso_sco").is(":checked")) {
                    $("#ck_curso_sco").val(1);
                } else {
                    $("#ck_curso_sco").val(0);
                }

                if ($("#ck_particip_workshop").is(":checked")) {
                    $("#ck_particip_workshop").val(1);
                } else {
                    $("#ck_particip_workshop").val(0);
                }

                if ($("#ck_exp_dc").is(":checked")) {
                    $("#ck_exp_dc").val(1);
                } else {
                    $("#ck_exp_dc").val(0);
                }

                if (false) {

                    alert("Todos os Campos São Obrigatórios !");
                } else {

                    var dados = {
                        "opcao": "parte2",
                        "txt_email": $("#txt_email").val(),
                        "txt_email_rec": $("#txt_email_rec").val(),
                        "txt_email2": $("#txt_email2").val(),
                        "txt_email3": $("#txt_email3").val(),
                        "rdb_plano": $('input[name="rdb_plano"]:checked').val(),
                        "rdb_capacitacao": $('input[name="rdb_capacitacao"]:checked').val(),
                        "txt_dt_curso": $("#txt_dt_curso").val(),
                        "rdb_cartao": $('input[name="rdb_cartao"]:checked').val(),
                        "ck_sede": $("#ck_sede").val(),
                        "ck_viatura": $("#ck_viatura").val(),
                        "ck_computador": $("#ck_computador").val(),
                        "rdb_simulado": $('input[name="rdb_simulado"]:checked').val(),
                        "rdb_mapeamento": $('input[name="rdb_mapeamento"]:checked').val(),
                        "ck_curso_gestao": $("#ck_curso_gestao").val(),
                        "dt_curso_gestao": $("#dt_curso_gestao").val(),
                        "ck_curso_sco": $("#ck_curso_sco").val(),
                        "dt_curso_sco": $("#dt_curso_sco").val(),
                        "ck_particip_workshop": $("#ck_particip_workshop").val(),
                        "dt_partic_workshop": $("#dt_partic_workshop").val(),
                        "ck_exp_dc": $("#ck_exp_dc").val(),
                        "tp_ex_dc": $("#tp_ex_dc").val(),
                        "email_pref": $("#email_prefeitura").val(),
                        "tel_pref": $("#tel_pref").val(),
                        "cel_pref": $("#cel_pref").val(),
                        "id_municipio": $("#id_municipio").val(),
                        "prefeito": $("#txtPrefeito").val(),
                        "pref_endereco": $("#txtEndPref").val(),
                        "pref_bairro": $("#txtBairroPref").val(),
                        "pref_cep": $("#txtCepPref").val(),
                    };
                    $.ajax({
                        type: 'POST',
                        url: 'mod_compdec/frontEnd/View/compdec/valida.php?v=<?= md5(VERSAO) ?>',
                        data: dados,
                        success: function (response) {
                            if (typeof param === 'undefined') {
                                alert("Registro Atualizado com sucesso !");
                                location.reload();
                            }

                        },
                        error: function (e) {
                            console.log(JSON.stringify(e));
                        }

                    });
                }
            } else {
                alert('email invalido');
                $("#txt_email").focus();
                $("#txt_email").css("background", "#FF6347");
                $("#txt_email").css("color", "#FFFFFF");
            }
        });
        /* grava checkebox sem DEcreto */
        $("input[name=ckSemDoc]").click(function () {

            var valor = ($(this).is(":checked")) ? 1 : 0;
            var campo = $(this).attr('id');
            var dados = {
                "opcao": "GravaSemDoc",
                "campo": campo,
                "valor": valor,
                "id_municipio": $("#txtIdMunicipio").val(),
            };
            /*if(valor == 1){ 
             Swal.fire({
             icon: 'error',
             title: 'Declaro que não possuo Lei de Criação da COMPDEC',
             text: 'Ao marcar esta opção você, usuario, \n não conseguirá enviar o documento marcando-o como Lei de Criação do COMPDEC'
             });
             }*/

            $.ajax({
                type: 'POST',
                url: 'mod_compdec/frontEnd/View/compdec/valida.php?v=<?= md5(VERSAO) ?>',
                data: dados,
                //dataType: 'json',
                success: function (response) {
                    //alert(semDecreto);
                    //console.log(JSON.stringify(response));

                },
                error: function (e) {
                    console.log(JSON.stringify(e));
                }
            });
        });
        /*********** Alterar dados Membro Equipe ***********/
        $("#btnAlterarMembro").click(function () {


            var dados = {
                "opcao": "alterar",
                "id_equipe": $("#txtIdMembro").val(),
                "txtNomeMembro": $("#txtNomeMembro").val(),
                "selFuncaoMembro": $("#selFuncaoMembro").val(),
                "txtTelMembro": $("#txtTelMembro").val(),
                "txtCelMembro": $("#txtCelMembro").val(),
                "txtEmailMembro": $("#txtEmailMembro").val(),
                "txtCpf": $("#txtCpf").val(),
                "ckWatsapp": $("#ckWatsapp").val(),
            };
            $.ajax({
                type: 'POST',
                url: 'mod_pipa/frontEnd/View/pmda/membroEquipe.php?v=<?= md5(VERSAO) ?>',
                data: dados,
                success: function (response) {
                    alert("Registro alterado com sucesso !");
                    location.reload();
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
            $("#formMembro").hide();
        });
        /*********** Gravar Foto compdec ************************/
        /* abrir modal*/
        /* defoto compdec */
        (function ($) {

            uploadModal = function (param) {
                if (param == "compdec") {
                    $("#modalWindowFotoCompdec").modal('show');
                } else if (param == "prefeito") {
                    $("#modalWindowFotoPrefeito").modal('show');
                } else if (param == "brasao") {
                    $("#modalWindowBrasao").modal('show');
                } else if (param == 'leis') {
                    $("#modal-default").modal('show');
                }
            }
        })(jQuery);
        /* gravar imagem brasao */
        $("#btnGravarBrasao").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {

                    // inicio
                    if (response == "sucesso") {
                        // codigo
                        if ($('#fileAnexoBrasao').val() == "") {

                            alert("Favor escolher uma foto ! ");
                        } else {

                            var formData = new FormData();
                            var fileData = $('#fileAnexoBrasao').prop('files')[0];
                            formData.append('btnGravarBrasao', $('#btnGravarBrasao').val());
                            formData.append('fileAnexo', fileData);
                            formData.append('opcao', 'alterarImagemBrasao');
                            formData.append('txtIdMunicipio', <?= (isset($_COOKIE['seguranca']['id_municipio'])) ? $_COOKIE['seguranca']['id_municipio'] : $_GET['mun']; ?>);
                            var extensao = getExtensao($("#fileAnexoBrasao").val());
                            if (extensao.toLowerCase() == 'png') {

                                $.ajax({
                                    url: 'mod_compdec/frontEnd/View/compdec/valida.php?v=<?= md5(VERSAO) ?>',
                                    type: 'POST',
                                    enctype: 'multipart/form-data',
                                    data: formData,
                                    processData: false, // tell jQuery not to process the data
                                    contentType: false, // tell jQuery not to set contentType 
                                    success: function (response) {
                                        alert('-Foto Anexada com Sucesso !');
                                        console.log(response);
                                        //location.reload();
                                    },
                                    error: function (e) {
                                        //alert(data);
                                        console.log(JSON.stringify(e));
                                    }
                                });
                            } else {
                                alert('Formatos de arquivos permitidos PNG !');
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
        /* gravar imagem compdec */
        $("#btnGravarFoto").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {

                    // inicio
                    if (response == "sucesso") {
                        // codigo
                        if ($('#fileAnexo').val() == "") {

                            alert("Favor escolher uma foto ! ");
                        } else {

                            var formData = new FormData();
                            var fileData = $('#fileAnexo').prop('files')[0];
                            formData.append('btnGravar', $('#btnGravar').val());
                            formData.append('fileAnexo', fileData);
                            formData.append('opcao', 'alterarImagem');
                            formData.append('txtIdMunicipio', <?= (isset($_COOKIE['seguranca']['id_municipio'])) ? $_COOKIE['seguranca']['id_municipio'] : $_GET['mun']; ?>);
                            var extensao = getExtensao($("#fileAnexo").val());
                            if (extensao.toLowerCase() == 'jpg' ||
                                    extensao.toLowerCase() == 'jpeg' ||
                                    extensao.toLowerCase() == 'png') {

                                $.ajax({
                                    url: 'mod_compdec/frontEnd/View/compdec/valida.php?v=<?= md5(VERSAO) ?>',
                                    type: 'POST',
                                    enctype: 'multipart/form-data',
                                    data: formData,
                                    processData: false, // tell jQuery not to process the data
                                    contentType: false, // tell jQuery not to set contentType 
                                    success: function (response) {
                                        alert('-Foto Anexada com Sucesso !');
                                        //console.log(response);
                                        location.reload();
                                    },
                                    error: function (e) {
                                        //alert(data);
                                        console.log(JSON.stringify(e));
                                    }
                                });
                            } else {
                                alert('Formatos de arquivos permitidos JPG, JPEG, PNG !');
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
        /*********** Gravar Foto Prefeito ************************/

        $("#btnGravarFotoPref").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {

                    // inicio
                    if (response == "sucesso") {
                        // codigo
                        if ($('#fileAnexoPref').val() == "") {

                            alert("Favor escolher uma foto ! ");
                        } else {

                            var formData = new FormData();
                            var fileData = $('#fileAnexoPref').prop('files')[0];
                            formData.append('btnGravar', $('#btnGravarFotoPref').val());
                            formData.append('fileAnexoPref', fileData);
                            formData.append('opcao', 'alterarImagemPref');
                            formData.append('txtIdMunicipio', <?= $id_municipio; ?>);
                            var extensao = getExtensao($("#fileAnexoPref").val());
                            if (extensao.toLowerCase() == 'jpg' ||
                                    extensao.toLowerCase() == 'jpeg' ||
                                    extensao.toLowerCase() == 'png') {

                                $.ajax({
                                    url: 'mod_cedec/app/prefeitura/valida.php?v=<?= md5(VERSAO) ?>',
                                    type: 'POST',
                                    data: formData,
                                    processData: false, // tell jQuery not to process the data
                                    contentType: false, // tell jQuery not to set contentType
                                    success: function (response) {
                                        if (response == "sucesso") {
                                            alert('Foto Anexada com Sucesso !');
                                        } else if (response == "mais17mb") {
                                            alert('Tamanho do arquivo máximo permitido 1Mb !');
                                        }
                                        //console.log(response);
                                        //location.reload();
                                        //$("#tblAnexo").html(response);
                                    },
                                    error: function (e) {
                                        //alert(data);
                                        console.log(JSON.stringify(e) + "erro-");
                                    }
                                });
                            } else {
                                alert('Formatos de arquivos permitidos, JPG, JPEG, PNG !');
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
        /*********** Anexo leis Decretos ************************/
        $("#btnGravarLeis").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php?v=<?= md5(VERSAO) ?>',
                type: 'POST',
                success: function (response) {

                    // inicio
                    if (response == "sucesso") {
                        // codigo
                        if ($("#fileAnexoLeis").val() == "") {

                            alert("Favor Anexar um arquivo! ");
                        } else {



                            var formData = new FormData($("form[name='frmAnexoLeis']")[0]);
                            formData.append('btnGravarLeis', $('#btnGravar').val());
                            formData.append('opcao', 'gravarleis');
                            formData.append('txtIdMunicipio', <?= (isset($pageSession['session']['seguranca']['id_municipio'])) ? $pageSession['session']['seguranca']['id_municipio'] : 0; ?>);
                            formData.append('txtDtAnexo', $('#txtDtAnexo').val());
                            formData.append('txtDescricao', $('#txtDescricao').val());
                            formData.append('selTipo', $('#selTipo').val());
                            formData.append('selTipoNome', $('#selTipo').find(":selected").text());
                            var extensao = getExtensao($("#fileAnexoLeis").val());
                            if (extensao.toLowerCase() == 'pdf') { //||
//                                    extensao.toLowerCase() == 'jpg' ||
//                                    extensao.toLowerCase() == 'peg' ||
//                                    extensao.toLowerCase() == 'png') {

                                $.ajax({
                                    url: 'mod_compdec/frontEnd/View/compdec/anexo.php?v=<?= md5(VERSAO) ?>',
                                    type: 'POST',
                                    data: formData,
                                    processData: false, // tell jQuery not to process the data
                                    contentType: false, // tell jQuery not to set contentType
                                    success: function (response) {
                                        var parsedData = JSON.parse(response);
                                         //$("#modal-default").modal('hide');
                                        //$("#tblAnexoLeis").html(response);
                                        window.open('anexo/anexo_leis/'+parsedData.file);
                                        location.reload();
                                    },
                                    error: function (response) {
                                        //console.log(JSON.stringify(response));
                                    }
                                });
                            } else {
                                //alert($('#txtFoto').val());
                                //alert('Formatos de arquivos permitidos PDF, JPG, JPEG, PNG !' + getExtensao($("#txtFoto").val()));
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
    });
    function anexoView(url) {
        window.location.href = url;
    }

    /*	Deletar Anexo Leis Decreto */
    function deletarAnexoLei(id, arquivo, id_municipio) {

        var dados = {

            "id_anexo": id,
            "arquivo": arquivo,
            "opcao": "delete",
            "txtIdMunicipio": id_municipio,
        };
        var confirm1 = confirm('Deseja realmente apagar o registro ?');
        if (confirm1 == true) {

            $.ajax({
                type: 'POST',
                url: 'mod_compdec/frontEnd/View/compdec/anexo.php?v=<?= md5(VERSAO) ?>',
                data: dados,
                success: function (response) {
                    $("#tblAnexoLeis").html(response);
                    //console.log(response);
                    location.reload();
                }
            });
            $("#btnAddMembro").hide();
        }
    }


    /*
     
     Deletar Membro equipe
     @param id - identidicador do registro
     @param contexto - pagina envio
     @param view - atualizar tabela sem refresh
     
     
     */
    function deletarMembro(id) {

        //console.log($(this).attr('name'));

        var dados = {

            "id_equipe": id,
            "opcao": "delete"
        };
        var confirm1 = confirm('Deseja realmente apagar o registro ?');
        if (confirm1 == true) {

            $.ajax({
                type: 'POST',
                url: 'mod_pipa/frontEnd/View/pmda/membroEquipe.php?v=<?= md5(VERSAO) ?>',
                data: dados,
                success: function (response) {
                    alert("Registro apagado com sucesso !");
                    location.reload();
                }
            });
            $("#btnAddMembro").hide();
        }
    }


    /*	Alterar o Membros Compdec */
    function alterarMembro(id, nome, funcao, telefone, celular, email, cpf) {

        $('#tbl_membro').hide();
        $('html, body').animate({scrollTop: $('#equipe').offset().top}, 2000);
        $("#formMembro").show();
        $("#btnGravar").hide();
        $("#btnAlterarMembro").show();
        $("#btnAddMembro").hide();
        $("#btnGravarMembro").hide();
        $("#txtNomeMembro").val(nome);
        $("#selFuncaoMembro").val(funcao).change();
        $("#txtTelMembro").val(telefone);
        $("#txtCelMembro").val(celular);
        $("#txtEmailMembro").val(email);
        $("#txtIdMembro").val(id);
        $("#txtCpf").val(cpf);
    }

    function validaEmail(email) {
        var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return regex.test(email);
    }
    
    
    /* */
    function focus_secao(secao) {
        $('html, body').animate({scrollTop: $("#"+secao).offset().top}, 2000);  
    }

</script>