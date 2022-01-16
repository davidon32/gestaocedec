

<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_decreto/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php
$dec_cobrade = new ProcessodecretoModel();

$municipio = new Municipio();

$dadosCobrade = $dec_cobrade->listaid_cobradeAutocomplete();
$dadosMunicipio = $municipio->listaid_municipioAutocomplete();
?>

<legend>Cadastro de Processo</legend><br>
<form action="<?= FuncaoBase::geraLink("decreto", "processo", "gravar"); ?>" method="post" accept-charset="utf-8" name="frmProcesso" id="frmProcesso">

    <p><span style="font-size: 11pt;">Informações Básicas</span></p>    
    <div class='row'>
        <div class='col-md-4'>
            <label>Ano Processo</label>
            <input type="text" class='form form-control' name='ano' id='ano' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Data de Entrada do Registro</label>
            <input type="text" class='form form-control' name='data_entrada' id='data_entrada' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Municipio</label>
            <input type="text" class='form form-control' name='municipio' id='municipio' maxlength='70' >
            <input type="hidden" class='form form-control' name='id_municipio' id='id_municipio' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Status do Processo Analise</label>
            <select class="form form-control" name="status" id="status">
                <option>Status do Processo</option>
                <option>HOMOLOGADO</option>
                <option>ARQUIVADO</option>
                <option>AGUARDANDO ANALISE</option>
                <option>DECRETO ESTADUAL</option>
                <option>DEVOLIDO</option>
                <option>DEVOLVIDO (REANALISAR</option>
                <option>EM ANÁLISE</option>
                <option>ENVIO P/ UNIÃO</option>
                <option>SOLICITOU EXPLOSÃO</option>
                <option></option>
            </select>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Número Decreto Municipal</label>
            <input type="text" class='form form-control' name='num_dec_mun' id='num_dec_mun' maxlength='14' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Data Decreto Municipal</label>
            <input type="text" class='form form-control' name='data_dec_mun' id='data_dec_mun' maxlength='' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Vigencia do Decreto (dias)</label>
            <input type="text" class='form form-control' name='dec_vigencia' id='dec_vigencia' maxlength='9' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Nome Tipo Desastre</label>
            <div class="input-group">
                <input type="text" class='form form-control' name='nomeCobrade_fk' id='nomeCobrade_fk' required readonly='readonly'>
                <span onclick="" class="input-group-addon" id="btnBuscaid_cobrade">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span> </div><input type="hidden" name='id_cobrade' id='id_cobrade' required readonly='readonly'>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Data de Vencimento do Decreto</label>
            <input type="text" class='form form-control' name='data_vencimento' id='data_vencimento' maxlength='' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Identificador do Funcionário (Analista do Processo)</label>
            <input type="text" class='form form-control' name='id_funcionario' id='id_funcionario' maxlength='' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Número do Decreto Homologação</label>
            <input type="text" class='form form-control' name='num_dec_homo' id='num_dec_homo' maxlength='14' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Data Publicação Decreto Homologação</label>
            <input type="text" class='form form-control' name='data_pub_dec_homo' id='data_pub_dec_homo' maxlength='' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Numero e Data de Portaria de Reconhecimento</label>
            <input type="text" class='form form-control' name='num_dt_port_dec_rec' id='num_dt_port_dec_rec' maxlength='19' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Número do D.O.U</label>
            <input type="text" class='form form-control' name='num_dt_dou' id='num_dt_dou' maxlength='19' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Populacao do Município</label>
            <input type="text" class='form form-control' name='populacao' id='populacao' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>PIB do Município</label>
            <input type="text" class='form form-control' name='val_pib' id='val_pib' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Orçamento do Município (R$)</label>
            <input type="text" class='form form-control' name='val_orcamento' id='val_orcamento' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Arrecadação do Município (R$)</label>
            <input type="text" class='form form-control' name='val_arrecadacao' id='val_arrecadacao' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Receita Anual do Município (R$)</label>
            <input type="text" class='form form-control' name='val_rec_anual' id='val_rec_anual' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Receita Mensal do Município (R$)</label>
            <input type="text" class='form form-control' name='val_rec_mensal' id='val_rec_mensal' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Telefone do Município</label>
            <input type="text" class='form form-control' name='tel_municipio' id='tel_municipio' maxlength='19' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-6'>
            <label>email do Município</label>
            <input type="text" class='form form-control' name='email' id='email' maxlength='44' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Valor Total do Prejuizo (R$)</label>
            <input type="text" class='form form-control' name='val_total' id='val_total' maxlength='10' required >
        </div>
    </div>

    <br><legend>Danos Humanos</legend>  

    <div class='row'>
        <div class='col-md-4'>
            <label>Quantidade de Pessoas Mortas</label>
            <input type="text" class='form form-control' name='morto' id='morto' maxlength='3' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Quantidade Pessoas Feridas</label>
            <input type="text" class='form form-control' name='ferido' id='ferido' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Quantidade de Pessoas Enfermas</label>
            <input type="text" class='form form-control' name='enfermo' id='enfermo' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Quantidade de Pessoas Desabrigadas</label>
            <input type="text" class='form form-control' name='desabrigado' id='desabrigado' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Quantidade de Pessoas Desalojadas</label>
            <input type="text" class='form form-control' name='desalojado' id='desalojado' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Quantidade de Pessoas com Outros Problemas</label>
            <input type="text" class='form form-control' name='outro' id='outro' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Quantidade de Pessoas Afetadas</label>
            <input type="text" class='form form-control' name='afetado' id='afetado' maxlength='4' required >
        </div>
    </div>

    <br><legend>Danos Materiais</legend>  

    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd de Unidades Públicas de Saúde Destruidas</label>
            <input type="text" class='form form-control' name='mat_pub_saude_destr' id='mat_pub_saude_destr' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd de Unidades Públicas de Saúde Danificada</label>
            <input type="text" class='form form-control' name='mat_pub_saude_danif' id='mat_pub_saude_danif' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Valor do Prejuizo Material Unidades Públicas de Saude (R$)</label>
            <input type="text" class='form form-control' name='val_mat_pub_saude' id='val_mat_pub_saude' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd de unidades Públicas de ensino Destruidas</label>
            <input type="text" class='form form-control' name='mat_pub_ensino_destr' id='mat_pub_ensino_destr' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd de unidades Públicas de Saúde Danificada</label>
            <input type="text" class='form form-control' name='mat_pub_ensino_danif' id='mat_pub_ensino_danif' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Valor do Prejuizo Material Unidades Públicas de Ensino (R$)</label>
            <input type="text" class='form form-control' name='val_mat_pub_ensino' id='val_mat_pub_ensino' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Prejuizo Material Outros Unidades Públicas Destruidas</label>
            <input type="text" class='form form-control' name='mat_pub_outro_destr' id='mat_pub_outro_destr' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Prejuizo Material Outros Unidades Públicas Danificadas</label>
            <input type="text" class='form form-control' name='mat_pub_outro_danif' id='mat_pub_outro_danif' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Valor Prejuizo Material a outros unidades públicas (R$)</label>
            <input type="text" class='form form-control' name='val_mat_pub_outro' id='val_mat_pub_outro' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Prejuizo Material de Unidades Públicas Comunitarias Destruídas</label>
            <input type="text" class='form form-control' name='mat_pub_com_destr' id='mat_pub_com_destr' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd de Prejuizo Material de unidades públicas Danificadas</label>
            <input type="text" class='form form-control' name='mat_pub_com_danif' id='mat_pub_com_danif' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Valor Prejuizo Material de Unidades Públicas (R$)</label>
            <input type="text" class='form form-control' name='val_mat_pub_com' id='val_mat_pub_com' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Prejuízo Material unidades Habitacionais Destruidas</label>
            <input type="text" class='form form-control' name='mat_unid_hab_destr' id='mat_unid_hab_destr' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Prejuízo Material unidades Habitacionais Danificadas</label>
            <input type="text" class='form form-control' name='mat_unid_hab_danif' id='mat_unid_hab_danif' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Valor Prejuizo Material a Unidades Habitacionais (R$)</label>
            <input type="text" class='form form-control' name='val_mat_unid_hab' id='val_mat_unid_hab' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Prejuízo Material a Obras de InfraEstrutura Públicas Destruídas</label>
            <input type="text" class='form form-control' name='mat_obr_infr_pub_destr' id='mat_obr_infr_pub_destr' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Prejuízo Material a Obras de InfraEstrutura Públicas Danificadas</label>
            <input type="text" class='form form-control' name='mat_obr_infr_pub_danif' id='mat_obr_infr_pub_danif' maxlength='2' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Valor Prejuízo Obras InfraEstrutura Públicas (R$)</label>
            <input type="text" class='form form-control' name='val_mat_obr_infr_pub' id='val_mat_obr_infr_pub' maxlength='10' required >
        </div>
    </div>

    <br><legend>Danos Humanos</legend>  

    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Pessoas Atingida contaminação da Agua</label>
            <input type="text" class='form form-control' name='agua_pop_atingida' id='agua_pop_atingida' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Pessoas Atingida contaminação da Solo</label>
            <input type="text" class='form form-control' name='solo_pop_atingida' id='solo_pop_atingida' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Pessoas Atingida contaminação da Ar</label>
            <input type="text" class='form form-control' name='ar_pop_atingida' id='ar_pop_atingida' maxlength='4' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Qtd Pessoas Atingida pelo incendio</label>
            <input type="text" class='form form-control' name='incendio_pop_atingida' id='incendio_pop_atingida' maxlength='4' required >
        </div>
    </div>

    <br><legend>Prejuízos Econômicos Publicos</legend>  

    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos da Saúde (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_saude' id='val_eco_pub_saude' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos de Água (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_agua' id='val_eco_pub_agua' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos com Esgoto (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_esgoto' id='val_eco_pub_esgoto' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos com Lixo (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_lixo' id='val_eco_pub_lixo' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos com Pragas (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_praga' id='val_eco_pub_praga' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos com Energia (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_energia' id='val_eco_pub_energia' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos com Telecomunicação (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_telec' id='val_eco_pub_telec' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos Com transporte (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_transp' id='val_eco_pub_transp' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos com Combustível (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_comb' id='val_eco_pub_comb' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos com Segurança (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_segur' id='val_eco_pub_segur' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prejuízo Econômicos Públicos com Ensino (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub_ensino' id='val_eco_pub_ensino' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Valor total de Prejuizos Econômicos Públicos (R$)</label>
            <input type="text" class='form form-control' name='val_eco_pub' id='val_eco_pub' maxlength='10' required >
        </div>
    </div>

    <br><legend>Prejuízos Econômicos Privados</legend>  

    <div class='row'>
        <div class='col-md-4'>
            <label>Prezuizo Econômico Privado com Agricultura (R$)</label>
            <input type="text" class='form form-control' name='val_eco_priv_agricul' id='val_eco_priv_agricul' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prezuizo Econômico Privado com Pecuária (R$)</label>
            <input type="text" class='form form-control' name='val_eco_priv_pecuaria' id='val_eco_priv_pecuaria' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prezuizo Econômico Privado com Indústria (R$)</label>
            <input type="text" class='form form-control' name='val_eco_priv_industria' id='val_eco_priv_industria' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Prezuizo Econômico Privado com Serviços (R$)</label>
            <input type="text" class='form form-control' name='val_eco_priv_servico' id='val_eco_priv_servico' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>
            <label>Valor Total Prezuízo Econômico Privado (R$)</label>
            <input type="text" class='form form-control' name='val_eco_priv' id='val_eco_priv' maxlength='10' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'><br>
            <input type="checkbox" class='checkbox-inline' name='ck_stat_reconhecido' id='ck_stat_reconhecido' >
            <label>Status reconhecido nacional</label>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'><br>
            <input type="checkbox" class='checkbox-inline' name='ck_stat_arquivo' id='ck_stat_arquivo' >
            <label>Status processo arquivado</label>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'><br>
            <input type="checkbox" class='checkbox-inline' name='ck_stat_homologa' id='ck_stat_homologa' >
            <label>Status processo homologado</label>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'><br>
            <input type="checkbox" class='checkbox-inline' name='ck_stat_analise' id='ck_stat_analise' >
            <label>Status processo analise</label>
        </div>
    </div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?= FuncaoBase::geraLink("decreto", "processo", "index") ?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    </div>
</form>


<!--######################  MODAL dec_cobrade ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_cobrade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro dec_cobrade</h4>
            </div>
            <div class="modal-body">
                <label>Pesquisa</label>
                <input type="text" class="form form-control" name="searcid_cobrade" id="searcid_cobrade">
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <div class="col-md-6 text-left">
                    <a href="<?= FuncaoBase::geraLink("decreto", "cobrade", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL dec_cobrade ####################-->


<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {  
        
        $("#dec_vigencia").change(function(){
            var dt = new Date();
            var dec_vig = $("#dec_vigencia").val();
            var dt_venc = new Date(dt.getDate()+dec_vig);
            $("#data_vencimento").val(dateFormat(dt_venc, "dd/mmm/yyyy"));
            
        });
        
    /* ckeck box padrao */

    $("#ck_stat_reconhecido").attr("checked",false);
            if ($("#ck_stat_reconhecido").is(":checked")){
                    $("#ck_stat_reconhecido").val(1);
            }
    $("#ck_stat_arquivo").attr("checked",false);
        if ($("#ck_stat_arquivo").is(":checked")){
            $("#ck_stat_arquivo").val(1);
        }


    $("#ck_stat_homologa").attr("checked",false);
        if ($("#ck_stat_homologa").is(":checked")){
            $("#ck_stat_homologa").val(1);
        }


    $("#ck_stat_analise").attr("checked",false);
        if ($("#ck_stat_analise").is(":checked")){
            $("#ck_stat_analise").val(1);
        }



        /* radio button padrao */

    /* close focus pesquisa */
    /* clic form campo FK fornecedor */
    $("#nomeCobrade").click(function(){
        $("#modal_id_cobrade").modal({backdrop: 'static', keyboard: false});
    });
    /* focus no campo pesquisa fornecedor */
    $('#modal_id_cobrade').on('shown.bs.modal', function (e) {
        $("#searcid_cobrade").focus();
    });
    $("#frmProcesso").trigger("reset");
    
    /* ###################  fk_dec_cobrade ####################*/
    $('#btnBuscaid_cobrade').click(function () {
        $('#modal_id_cobrade').modal({backdrop: 'static', keyboard: false});
    });
    
    var itens = {
        data: <?=json_encode($dadosCobrade); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                enabled: true
                },
                onSelectItemEvent: function () {
                    var id = $("#searcid_cobrade").getSelectedItemData().id_cobrade;
                    var nome = $("#searcid_cobrade").getSelectedItemData().nome;
                    $("#nomeCobrade_fk").val(nome); // Mudar
                    $("#id_cobrade").val(id);
                },
                onClickEvent:function(){
                    $('#modal_id_cobrade').modal('hide');
                }
            }
    };
    
    /*********** autocomplete cobrade ***********/
        $("#searcid_cobrade").easyAutocomplete(itens);

        /*###########################  final dec_cobrade #####################*/
        
        var itens_municipio = {
        data: <?=json_encode($dadosMunicipio); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                enabled: true
                },
                onSelectItemEvent: function () {
                    var id =   $("#municipio").getSelectedItemData().id_municipio;
                    var nome = $("#municipio").getSelectedItemData().nome;
                    //$("#nomeMunicipio_fk").val(nome); // Mudar
                    $("#id_municipio").val(id);
                },
                
            }
    };
    
        /*********** autocomplete municipio ***********/
        $("#municipio").easyAutocomplete(itens_municipio);


    });
</script>
