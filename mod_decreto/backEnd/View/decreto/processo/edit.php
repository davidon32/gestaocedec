

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

$dec_cobrade = new ProcessoConEstoqueModel();
  
                    $dadosCobrade = $dec_cobrade->listaid_cobradeAutocomplete();


?>

<legend>Editar Cadastro Processo</legend>


<form action="<?=FuncaoBase::geraLink("decreto", "processo", "edit");?>" method="post" accept-charset="utf-8" name="frmProcesso" id="frmProcesso">
    
<div class='col-md-12'>
<div class='col-md-1'>
<label>Identificador do Processo</label>
<input type="text" class='form form-control' name='id_processo' id='id_processo' value='<?=$view[0]['id_processo']?>'  readonly=readonly >
</div>
</div>
<div class='col-md-2'>
<label></label>
<input type="" class='form form-control' name='ano' id='ano' value='<?=$view[0]['ano']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Data de Entrada do Registro</label>
<input type="date" class='form form-control' name='data_entrada' id='data_entrada' value='<?=DataMysql::dataVisual($view[0]['data_entrada'])?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Identificador do Municipio</label>
<input type="text" class='form form-control' name='id_municipio' id='id_municipio' value='<?=$view[0]['id_municipio']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Número Decreto Municipal</label>
<input type="text" class='form form-control' name='num_dec_mun' id='num_dec_mun' value='<?=$view[0]['num_dec_mun']?>'  maxlength='14' required>
</div>
<div class='col-md-2'>
<label>Data Decreto Municipal</label>
<input type="date" class='form form-control' name='data_dec_mun' id='data_dec_mun' value='<?=DataMysql::dataVisual($view[0]['data_dec_mun'])?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Vigencia do Decreto (dias)</label>
<input type="text" class='form form-control' name='dec_vigencia' id='dec_vigencia' value='<?=$view[0]['dec_vigencia']?>'  maxlength='9' required>
</div>
<div class='col-md-6'>
<label>Nome Tipo Desastre</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeCobrade_fk' id='nomeCobrade_fk' value='<?=$processoModel->getNomeIdFk('dec_cobrade','id_cobrade', $view[0]['id_cobrade'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_cobrade">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_cobrade' id='id_cobrade' required readonly='readonly' value='<?=$view[0]['id_cobrade']?>'>
</div>
<div class='col-md-2'>
<label>Data de Vencimento do Decreto</label>
<input type="date" class='form form-control' name='data_vencimento' id='data_vencimento' value='<?=DataMysql::dataVisual($view[0]['data_vencimento'])?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Status do Processo Analise</label>
<input type="text" class='form form-control' name='status' id='status' value='<?=$view[0]['status']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Identificador do Funcionário (Analista do Processo)</label>
<input type="text" class='form form-control' name='id_funcionario' id='id_funcionario' value='<?=$view[0]['id_funcionario']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Número do Decreto Homologação</label>
<input type="text" class='form form-control' name='num_dec_homo' id='num_dec_homo' value='<?=$view[0]['num_dec_homo']?>'  maxlength='14' required>
</div>
<div class='col-md-2'>
<label>Data Publicação Decreto Homologação</label>
<input type="date" class='form form-control' name='data_pub_dec_homo' id='data_pub_dec_homo' value='<?=DataMysql::dataVisual($view[0]['data_pub_dec_homo'])?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Numero e Data de Portaria de Reconhecimento</label>
<input type="text" class='form form-control' name='num_dt_port_dec_rec' id='num_dt_port_dec_rec' value='<?=$view[0]['num_dt_port_dec_rec']?>'  maxlength='19' required>
</div>
<div class='col-md-2'>
<label>Número do D.O.U</label>
<input type="text" class='form form-control' name='num_dt_dou' id='num_dt_dou' value='<?=$view[0]['num_dt_dou']?>'  maxlength='19' required>
</div>
<div class='col-md-2'>
<label>Populacao do Município</label>
<input type="text" class='form form-control' name='populacao' id='populacao' value='<?=$view[0]['populacao']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>PIB do Município</label>
<input type="" class='form form-control' name='val_pib' id='val_pib' value='<?=$view[0]['val_pib']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Orçamento do Município</label>
<input type="" class='form form-control' name='val_orcamento' id='val_orcamento' value='<?=$view[0]['val_orcamento']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Arrecadação do Município</label>
<input type="" class='form form-control' name='val_arrecadacao' id='val_arrecadacao' value='<?=$view[0]['val_arrecadacao']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Receita Anual do Município</label>
<input type="" class='form form-control' name='val_rec_anual' id='val_rec_anual' value='<?=$view[0]['val_rec_anual']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Receita Mensal do Município</label>
<input type="" class='form form-control' name='val_rec_mensal' id='val_rec_mensal' value='<?=$view[0]['val_rec_mensal']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Telefone do Município</label>
<input type="text" class='form form-control' name='tel_municipio' id='tel_municipio' value='<?=$view[0]['tel_municipio']?>'  maxlength='19' required>
</div>
<div class='col-md-6'>
<label>email do Município</label>
<input type="text" class='form form-control' name='email' id='email' value='<?=$view[0]['email']?>'  maxlength='44' required>
</div>
<div class='col-md-2'>
<label>Valor Total do Prejuizo</label>
<input type="" class='form form-control' name='val_total' id='val_total' value='<?=$view[0]['val_total']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Quantidade de Pessoas Mortas</label>
<input type="text" class='form form-control' name='morto' id='morto' value='<?=$view[0]['morto']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Quantidade Pessoas Feridas</label>
<input type="text" class='form form-control' name='ferido' id='ferido' value='<?=$view[0]['ferido']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Quantidade de Pessoas Enfermas</label>
<input type="text" class='form form-control' name='enfermo' id='enfermo' value='<?=$view[0]['enfermo']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Quantidade de Pessoas Desabrigadas</label>
<input type="text" class='form form-control' name='desabrigado' id='desabrigado' value='<?=$view[0]['desabrigado']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Quantidade de Pessoas Desalojadas</label>
<input type="text" class='form form-control' name='desalojado' id='desalojado' value='<?=$view[0]['desalojado']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Quantidade de Pessoas com Outros Problemas</label>
<input type="text" class='form form-control' name='outro' id='outro' value='<?=$view[0]['outro']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Quantidade de Pessoas Afetadas</label>
<input type="text" class='form form-control' name='afetado' id='afetado' value='<?=$view[0]['afetado']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd de Unidades Públicas de Saúde Destruidas</label>
<input type="text" class='form form-control' name='mat_pub_saude_destr' id='mat_pub_saude_destr' value='<?=$view[0]['mat_pub_saude_destr']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd de Unidades Públicas de Saúde Danificada</label>
<input type="text" class='form form-control' name='mat_pub_saude_danif' id='mat_pub_saude_danif' value='<?=$view[0]['mat_pub_saude_danif']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Valor do Prejuizo Material Unidades Públicas de Saude</label>
<input type="" class='form form-control' name='val_mat_pub_saude' id='val_mat_pub_saude' value='<?=$view[0]['val_mat_pub_saude']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd de unidades Públicas de ensino Destruidas</label>
<input type="text" class='form form-control' name='mat_pub_ensino_destr' id='mat_pub_ensino_destr' value='<?=$view[0]['mat_pub_ensino_destr']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd de unidades Públicas de Saúde Danificada</label>
<input type="text" class='form form-control' name='mat_pub_ensino_danif' id='mat_pub_ensino_danif' value='<?=$view[0]['mat_pub_ensino_danif']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Valor do Prejuizo Material Unidades Públicas de Ensino</label>
<input type="" class='form form-control' name='val_mat_pub_ensino' id='val_mat_pub_ensino' value='<?=$view[0]['val_mat_pub_ensino']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Prejuizo Material Outros Unidades Públicas Destruidas</label>
<input type="text" class='form form-control' name='mat_pub_outro_destr' id='mat_pub_outro_destr' value='<?=$view[0]['mat_pub_outro_destr']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Prejuizo Material Outros Unidades Públicas Danificadas</label>
<input type="text" class='form form-control' name='mat_pub_outro_danif' id='mat_pub_outro_danif' value='<?=$view[0]['mat_pub_outro_danif']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Valor Prejuizo Material a outros unidades públicas</label>
<input type="" class='form form-control' name='val_mat_pub_outro' id='val_mat_pub_outro' value='<?=$view[0]['val_mat_pub_outro']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Prejuizo Material de Unidades Públicas Comunitarias Destruídas</label>
<input type="text" class='form form-control' name='mat_pub_com_destr' id='mat_pub_com_destr' value='<?=$view[0]['mat_pub_com_destr']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd de Prejuizo Material de unidades públicas Danificadas</label>
<input type="text" class='form form-control' name='mat_pub_com_danif' id='mat_pub_com_danif' value='<?=$view[0]['mat_pub_com_danif']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Valor Prejuizo Material de Unidades Públicas</label>
<input type="" class='form form-control' name='val_mat_pub_com' id='val_mat_pub_com' value='<?=$view[0]['val_mat_pub_com']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Prejuízo Material unidades Habitacionais Destruidas</label>
<input type="text" class='form form-control' name='mat_unid_hab_destr' id='mat_unid_hab_destr' value='<?=$view[0]['mat_unid_hab_destr']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Prejuízo Material unidades Habitacionais Danificadas</label>
<input type="text" class='form form-control' name='mat_unid_hab_danif' id='mat_unid_hab_danif' value='<?=$view[0]['mat_unid_hab_danif']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Valor Prejuizo Material a Unidades Habitacionais</label>
<input type="" class='form form-control' name='val_mat_unid_hab' id='val_mat_unid_hab' value='<?=$view[0]['val_mat_unid_hab']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Prejuízo Material a Obras de InfraEstrutura Públicas Destruídas</label>
<input type="text" class='form form-control' name='mat_obr_infr_pub_destr' id='mat_obr_infr_pub_destr' value='<?=$view[0]['mat_obr_infr_pub_destr']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Prejuízo Material a Obras de InfraEstrutura Públicas Danificadas</label>
<input type="text" class='form form-control' name='mat_obr_infr_pub_danif' id='mat_obr_infr_pub_danif' value='<?=$view[0]['mat_obr_infr_pub_danif']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Valor Prejuízo Obras InfraEstrutura Públicas</label>
<input type="" class='form form-control' name='val_mat_obr_infr_pub' id='val_mat_obr_infr_pub' value='<?=$view[0]['val_mat_obr_infr_pub']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Pessoas Atingida contaminação da Agua</label>
<input type="text" class='form form-control' name='agua_pop_atingida' id='agua_pop_atingida' value='<?=$view[0]['agua_pop_atingida']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Pessoas Atingida contaminação da Solo</label>
<input type="text" class='form form-control' name='solo_pop_atingida' id='solo_pop_atingida' value='<?=$view[0]['solo_pop_atingida']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Pessoas Atingida contaminação da Ar</label>
<input type="text" class='form form-control' name='ar_pop_atingida' id='ar_pop_atingida' value='<?=$view[0]['ar_pop_atingida']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Qtd Pessoas Atingida pelo incendio</label>
<input type="text" class='form form-control' name='incendio_pop_atingida' id='incendio_pop_atingida' value='<?=$view[0]['incendio_pop_atingida']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos da Saúde</label>
<input type="" class='form form-control' name='val_eco_pub_saude' id='val_eco_pub_saude' value='<?=$view[0]['val_eco_pub_saude']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos de Água</label>
<input type="" class='form form-control' name='val_eco_pub_agua' id='val_eco_pub_agua' value='<?=$view[0]['val_eco_pub_agua']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos com Esgoto</label>
<input type="" class='form form-control' name='val_eco_pub_esgoto' id='val_eco_pub_esgoto' value='<?=$view[0]['val_eco_pub_esgoto']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos com Lixo</label>
<input type="" class='form form-control' name='val_eco_pub_lixo' id='val_eco_pub_lixo' value='<?=$view[0]['val_eco_pub_lixo']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos com Pragas</label>
<input type="" class='form form-control' name='val_eco_pub_praga' id='val_eco_pub_praga' value='<?=$view[0]['val_eco_pub_praga']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos com Energia</label>
<input type="" class='form form-control' name='val_eco_pub_energia' id='val_eco_pub_energia' value='<?=$view[0]['val_eco_pub_energia']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos com Telecomunicação</label>
<input type="" class='form form-control' name='val_eco_pub_telec' id='val_eco_pub_telec' value='<?=$view[0]['val_eco_pub_telec']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos Com transporte</label>
<input type="" class='form form-control' name='val_eco_pub_transp' id='val_eco_pub_transp' value='<?=$view[0]['val_eco_pub_transp']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos com Combustível</label>
<input type="" class='form form-control' name='val_eco_pub_comb' id='val_eco_pub_comb' value='<?=$view[0]['val_eco_pub_comb']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos com Segurança</label>
<input type="" class='form form-control' name='val_eco_pub_segur' id='val_eco_pub_segur' value='<?=$view[0]['val_eco_pub_segur']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prejuízo Econômicos Públicos com Ensino</label>
<input type="" class='form form-control' name='val_eco_pub_ensino' id='val_eco_pub_ensino' value='<?=$view[0]['val_eco_pub_ensino']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Valor total de Prejuizos Econômicos Públicos</label>
<input type="" class='form form-control' name='val_eco_pub' id='val_eco_pub' value='<?=$view[0]['val_eco_pub']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prezuizo Econômico Privado com Agricultura</label>
<input type="" class='form form-control' name='val_eco_priv_agricul' id='val_eco_priv_agricul' value='<?=$view[0]['val_eco_priv_agricul']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prezuizo Econômico Privado com Pecuária</label>
<input type="" class='form form-control' name='val_eco_priv_pecuaria' id='val_eco_priv_pecuaria' value='<?=$view[0]['val_eco_priv_pecuaria']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prezuizo Econômico Privado com Indústria</label>
<input type="" class='form form-control' name='val_eco_priv_industria' id='val_eco_priv_industria' value='<?=$view[0]['val_eco_priv_industria']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Prezuizo Econômico Privado com Serviços</label>
<input type="" class='form form-control' name='val_eco_priv_servico' id='val_eco_priv_servico' value='<?=$view[0]['val_eco_priv_servico']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Valor Total Prezuízo Econômico Privado</label>
<input type="" class='form form-control' name='val_eco_priv' id='val_eco_priv' value='<?=$view[0]['val_eco_priv']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Status reconhecido nacional</label>
<input type="checkbox" class='form form-control' name='ck_stat_reconhecido' id='ck_stat_reconhecido' value='<?=$view[0]['ck_stat_reconhecido']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Status processo arquivado</label>
<input type="checkbox" class='form form-control' name='ck_stat_arquivo' id='ck_stat_arquivo' value='<?=$view[0]['ck_stat_arquivo']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Status processo homologado</label>
<input type="checkbox" class='form form-control' name='ck_stat_homologa' id='ck_stat_homologa' value='<?=$view[0]['ck_stat_homologa']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Status processo analise</label>
<input type="checkbox" class='form form-control' name='ck_stat_analise' id='ck_stat_analise' value='<?=$view[0]['ck_stat_analise']?>'  maxlength='-1' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("decreto", "processo", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Atualizar">
    </div>
</form>
        
    <!--######################  MODAL dec_cobrade ###################-->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_id_cobrade">
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
                      <a href="<?=FuncaoBase::geraLink("decreto", "processo", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
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
    
     /* close focus pesquisa */
         /* clic form campo FK fornecedor */
        $("#nomeCobrade").click(function(){
            $("#modal_id_cobrade").modal({backdrop: 'static', keyboard: false});   
        });
        /* focus no campo pesquisa fornecedor */
        $('#modal_id_cobrade').on('shown.bs.modal', function (e) {
            $("#searcid_cobrade").focus();
        });
 /* clic form campo FK fornecedor */
        $("#nomeCobrade").click(function(){
            $("#modal_id_cobrade").modal('show');   
        });
        /* focus no campo pesquisa fornecedor */
        $('#modal_id_cobrade').on('shown.bs.modal', function (e) {
            $("#searcid_cobrade").focus();
        });


        
        
        
    
     /* ###################  fk_dec_cobrade ####################*/
        $('#btnBuscaid_cobrade').click(function () {
            $('#modal_id_cobrade').modal('show');
        });

        var itens = {
            data:
            <?php print json_encode($dadosCobrade); ?>, // array com os dados
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
        /*********** autocomplete ***********/
        $("#searcid_cobrade").easyAutocomplete(itens);
                                
    /*###########################  final dec_cobrade #####################*/

    });
</script>
        