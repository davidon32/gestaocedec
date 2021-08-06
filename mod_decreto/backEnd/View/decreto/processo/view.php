
<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<legend><?=$view[1]['tabela']->TABLE_COMMENT?></legend>
<table class="table table-bordered table-striped">

    <tr>
                <td class="col-md-3">Identificador do Processo :</td><td><?=$view[0]['id_processo'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3"> :</td><td><?=$view[0]['ano'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data de Entrada do Registro :</td><td><?=$view[0]['data_entrada'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Numero do Processo :</td><td><?=$view[0]['num_processo'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador do Municipio :</td><td><?=$view[0]['id_municipio'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Número Decreto Municipal :</td><td><?=$view[0]['num_dec_mun'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data Decreto Municipal :</td><td><?=$view[0]['data_dec_mun'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Vigencia do Decreto (dias) :</td><td><?=$view[0]['dec_vigencia'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome Tipo Desastre :</td><td><?=$processoModel->getNomeIdFk('dec_cobrade','id_cobrade', $view[0]['id_cobrade'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data de Vencimento do Decreto :</td><td><?=$view[0]['data_vencimento'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Status do Processo Analise :</td><td><?=$view[0]['status'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador do Funcionário (Analista do Processo) :</td><td><?=$view[0]['id_funcionario'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Número do Decreto Homologação :</td><td><?=$view[0]['num_dec_homo'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data Publicação Decreto Homologação :</td><td><?=$view[0]['data_pub_dec_homo'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Numero e Data de Portaria de Reconhecimento :</td><td><?=$view[0]['num_dt_port_dec_rec'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Número do D.O.U :</td><td><?=$view[0]['num_dt_dou'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Populacao do Município :</td><td><?=$view[0]['populacao'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">PIB do Município :</td><td><?=$view[0]['val_pib'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Orçamento do Município :</td><td><?=$view[0]['val_orcamento'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Arrecadação do Município :</td><td><?=$view[0]['val_arrecadacao'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Receita Anual do Município :</td><td><?=$view[0]['val_rec_anual'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Receita Mensal do Município :</td><td><?=$view[0]['val_rec_mensal'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Telefone do Município :</td><td><?=$view[0]['tel_municipio'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">email do Município :</td><td><?=$view[0]['email'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor Total do Prejuizo :</td><td><?=$view[0]['val_total'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade de Pessoas Mortas :</td><td><?=$view[0]['morto'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade Pessoas Feridas :</td><td><?=$view[0]['ferido'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade de Pessoas Enfermas :</td><td><?=$view[0]['enfermo'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade de Pessoas Desabrigadas :</td><td><?=$view[0]['desabrigado'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade de Pessoas Desalojadas :</td><td><?=$view[0]['desalojado'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade de Pessoas com Outros Problemas :</td><td><?=$view[0]['outro'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Quantidade de Pessoas Afetadas :</td><td><?=$view[0]['afetado'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd de Unidades Públicas de Saúde Destruidas :</td><td><?=$view[0]['mat_pub_saude_destr'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd de Unidades Públicas de Saúde Danificada :</td><td><?=$view[0]['mat_pub_saude_danif'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor do Prejuizo Material Unidades Públicas de Saude :</td><td><?=$view[0]['val_mat_pub_saude'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd de unidades Públicas de ensino Destruidas :</td><td><?=$view[0]['mat_pub_ensino_destr'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd de unidades Públicas de Saúde Danificada :</td><td><?=$view[0]['mat_pub_ensino_danif'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor do Prejuizo Material Unidades Públicas de Ensino :</td><td><?=$view[0]['val_mat_pub_ensino'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Prejuizo Material Outros Unidades Públicas Destruidas :</td><td><?=$view[0]['mat_pub_outro_destr'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Prejuizo Material Outros Unidades Públicas Danificadas :</td><td><?=$view[0]['mat_pub_outro_danif'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor Prejuizo Material a outros unidades públicas :</td><td><?=$view[0]['val_mat_pub_outro'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Prejuizo Material de Unidades Públicas Comunitarias Destruídas :</td><td><?=$view[0]['mat_pub_com_destr'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd de Prejuizo Material de unidades públicas Danificadas :</td><td><?=$view[0]['mat_pub_com_danif'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor Prejuizo Material de Unidades Públicas :</td><td><?=$view[0]['val_mat_pub_com'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Prejuízo Material unidades Habitacionais Destruidas :</td><td><?=$view[0]['mat_unid_hab_destr'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Prejuízo Material unidades Habitacionais Danificadas :</td><td><?=$view[0]['mat_unid_hab_danif'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor Prejuizo Material a Unidades Habitacionais :</td><td><?=$view[0]['val_mat_unid_hab'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Prejuízo Material a Obras de InfraEstrutura Públicas Destruídas :</td><td><?=$view[0]['mat_obr_infr_pub_destr'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Prejuízo Material a Obras de InfraEstrutura Públicas Danificadas :</td><td><?=$view[0]['mat_obr_infr_pub_danif'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor Prejuízo Obras InfraEstrutura Públicas :</td><td><?=$view[0]['val_mat_obr_infr_pub'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Pessoas Atingida contaminação da Agua :</td><td><?=$view[0]['agua_pop_atingida'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Pessoas Atingida contaminação da Solo :</td><td><?=$view[0]['solo_pop_atingida'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Pessoas Atingida contaminação da Ar :</td><td><?=$view[0]['ar_pop_atingida'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Qtd Pessoas Atingida pelo incendio :</td><td><?=$view[0]['incendio_pop_atingida'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos da Saúde :</td><td><?=$view[0]['val_eco_pub_saude'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos de Água :</td><td><?=$view[0]['val_eco_pub_agua'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos com Esgoto :</td><td><?=$view[0]['val_eco_pub_esgoto'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos com Lixo :</td><td><?=$view[0]['val_eco_pub_lixo'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos com Pragas :</td><td><?=$view[0]['val_eco_pub_praga'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos com Energia :</td><td><?=$view[0]['val_eco_pub_energia'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos com Telecomunicação :</td><td><?=$view[0]['val_eco_pub_telec'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos Com transporte :</td><td><?=$view[0]['val_eco_pub_transp'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos com Combustível :</td><td><?=$view[0]['val_eco_pub_comb'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos com Segurança :</td><td><?=$view[0]['val_eco_pub_segur'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prejuízo Econômicos Públicos com Ensino :</td><td><?=$view[0]['val_eco_pub_ensino'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor total de Prejuizos Econômicos Públicos :</td><td><?=$view[0]['val_eco_pub'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prezuizo Econômico Privado com Agricultura :</td><td><?=$view[0]['val_eco_priv_agricul'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prezuizo Econômico Privado com Pecuária :</td><td><?=$view[0]['val_eco_priv_pecuaria'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prezuizo Econômico Privado com Indústria :</td><td><?=$view[0]['val_eco_priv_industria'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Prezuizo Econômico Privado com Serviços :</td><td><?=$view[0]['val_eco_priv_servico'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor Total Prezuízo Econômico Privado :</td><td><?=$view[0]['val_eco_priv'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Status reconhecido nacional :</td><td><?=$view[0]['ck_stat_reconhecido'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Status processo arquivado :</td><td><?=$view[0]['ck_stat_arquivo'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Status processo homologado :</td><td><?=$view[0]['ck_stat_homologa'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Status processo analise :</td><td><?=$view[0]['ck_stat_analise'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("decreto", "processo", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("decreto", "processo", "edit", array('id'=>$view[0]['id_processo'])) ?>">Editar</a>
<br>
<br>

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

    });
</script>
