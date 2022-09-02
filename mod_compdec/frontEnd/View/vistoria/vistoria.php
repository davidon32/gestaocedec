<?php include_once 'core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once 'mod_compdec/Model/Model.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menuExterno.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$id_municipio = isset($pageSession['session']['seguranca']['id_municipio']) ? $pageSession['session']['seguranca']['id_municipio'] : "";

$numero = vistoriaController::geraNumero($id_municipio, date('Y'));

?>

<div class="col-md-12 text-center">
    <a class="btn btn-success" href="<?= FuncaoBase::geraLink('compdec', 'compdec', 'index') ?>">Voltar</a>   
</div>



<legend>Novo Termo de Vistoria</legend>

<legend>RELATÓRIO DE VISTORIA DE ATENDIMENTO EMERGENCIAL Nº <b><?=$numero;?>/<?=date('Y')?></b></legend>

<legend> 1) - DADOS GERAIS </legend>

<form action="<?= FuncaoBase::geraLink('compdec', 'vistoria', 'gravar') ?>" method="POST" name="frmVistoria" id="frmVistoria">
<div class="row">
    <br><br>
    <div class="col-md-6">
        <label>Proprietário/Morador:</label>
        <input class='form form-control' type="text" name="prop" id="prop" maxlength="110" placeholder="Nome do Proprietário do Imóvel">
        <input type="hidden" name="municipio_id" id="municipio_id" value='<?=$id_municipio;?>'>
        <input type="hidden" name="numero" id="numero" value='<?=$numero."-".date('Y');?>'>
    </div>     
    <div class="col-md-6">
        <label>Endereço do Imóvel:</label>
        <input class='form form-control' type="text" name="endereco" id="endereco" maxlength="110" placeholder="Endereço do Imóvel">
    </div>     
</div>

<div class="row">
    <br><br>
    <div class="col-md-6">
        <label>Contato/Telefone:</label>
        <input class='form form-control' type='text' name='cel' id='tel' required value='' maxlength="15" placehold='Telefone de Contato'>
    </div>     
    <div class="col-md-6">
        <label>Data da vistoria:</label>
        <input class='form form-control' type='date' name='dt_vistoria' id='dt_vistoria' required value=''>
    </div>     
</div>

<div class="row">
    <br><br>
    <div class="col-md-6">
        <label>Tipo da Ocorrência:</label>
        <input class='form form-control' type='text' name='tp_ocorrencia' id='tp_ocorrencia' maxlength="50" required value='' placehold=''>
    </div>     
    <div class="col-md-6">
        <label>Tipo de Imóvel:</label>
        <select class='form form-control' name='tp_imovel' id='tp_imovel' required value=''>
            <option>Casa</option>
            <option>Apartamento</option>
            <option>Predio</option>
            <option>Galpão</option>
            <option>Lote</option>
            <option>Praça</option>
        </select>
    </div>     
</div>


<!-- ################################################################-->
<div class="row">
    <br>
    <div class="col-md-12"> 
        <legend> 2) - CONDIÇÕES DO LOCAL  </legend>
        <legend>Trincas nos elementos estruturais (sim/não)</legend>
        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-3">
                        <label>Pilar :</label><br>
                    </div>

                    Sim <input type="radio" name="tr_pilar" id="tr_pilar_s" value="1">
                    Não <input type="radio" name="tr_pilar" id="tr_pilar_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6">&nbsp; 
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-3">
                        <label>Viga :</label><br>
                    </div>

                    Sim <input type="radio" name="tr_viga" id="tr_viga_s" value="1">
                    Não <input type="radio" name="tr_viga" id="tr_viga_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-3">
                        <label>Laje :</label><br>
                    </div>

                    Sim <input type="radio" name="tr_laje" id="tr_laje_s" value="1">
                    Não <input type="radio" name="tr_laje" id="tr_laje_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>

        <div class="col-md-12">
            <legend>Trincas nos elementos construtivos (sim/Não)</legend>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-3">
                        <label>Parede :</label><br>
                    </div>

                    Sim <input type="radio" name="parede" id="parede_s" value="1">
                    Não <input type="radio" name="parede" id="parede_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-3">
                        <label>Piso :</label><br>
                    </div>

                    Sim <input type="radio" name="piso" id="piso_s" value="1">
                    Não <input type="radio" name="piso" id="piso_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-3">
                        <label>Muro :</label><br>
                    </div>

                    Sim <input type="radio" name="muro" id="muro_s" value="1">
                    Não <input type="radio" name="muro" id="muro_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>

        <div class="mol-md-12">
            <legend>Risco de colapso</legend>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-6">
                        <label>Elementos estruturais :</label><br>
                    </div>

                    Sim <input type="radio" name="r_col_estrutural" id="r_col_estrutural_s" value="1">
                    Não <input type="radio" name="r_col_estrutural" id="r_col_estrutural_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-6">
                        <label>Elementos construtivos :</label><br>
                    </div>

                    Sim <input type="radio" name="r_col_construtivo" id="r_col_construtivo_s" value="1">
                    Não <input type="radio" name="r_col_construtivo" id="r_col_construtivo_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-6">
                        <label>Risco externos :</label><br>
                    </div>

                    Sim <input type="radio" name="r_externo" id="r_externo_s" value="1">
                    Não <input type="radio" name="r_externo" id="r_externo_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-6">
                        <label>Vazamentos :</label><br>
                    </div>

                    Sim <input type="radio" name="r_vazamento" id="r_vazamento_s" value="1">
                    Não <input type="radio" name="r_vazamento" id="r_vazamento_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>
        <div class="col-md-12">
            <legend>Agentes externos</legend>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-6">
                        <label>Deformações no muro :</label><br>

                    </div>

                    Sim <input type="radio" name="ae_muro" id="ae_muro_s" value="1">
                    Não <input type="radio" name="ae_muro" id="ae_muro_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-6">
                        <label>Ruptura de redes Hidráulicas :</label><br>
                    </div>

                    Sim <input type="radio" name="ae_rede_hidraulica" id="ae_rede_hidraulica_s" value="1">
                    Não <input type="radio" name="ae_rede_hidraulica" id="ae_rede_hidraulica_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-6">
                        <label>Deslizamentos de encosta/talude :</label><br>
                    </div>

                    Sim <input type="radio" name="ae_deslizamento" id="ae_deslizamento_s" value="1">
                    Não <input type="radio" name="ae_deslizamento" id="ae_deslizamento_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-6">
                        <label>Inundação :</label><br>
                    </div>

                    Sim <input type="radio" name="ae_inundacao" id="ae_inundacao_s" value="1">
                    Não <input type="radio" name="ae_inundacao" id="ae_inundacao_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <div class="col-md-6">
                        <label>Outros :</label><br>
                    </div>

                    Sim <input type="radio" name="ae_outros" id="ae_outros_s" value="1">
                    Não <input type="radio" name="ae_outros" id="ae_outros_n" value="0" checked>
                    <br>
                </div>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label>Outras anomalias (detalhar) :</label><br>
                <textarea class="form form-control" name="ae_outros_txt" id="ae_outros_txt" cols="" rows="6" maxlength="16777200"></textarea>
            </div>
            <br><br><br><br><br><br>
        </div> 

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <br>
        <legend>3. CARACTERIZAÇÃO DO LOCAL (Relatar qual a condição do terreno onde está a edificação)</legend>
        <div class="col-md-12">
            <textarea class="form form-control" name="caracterizacao" id="caracterizacao" cols="" rows="5" maxlength="16777200"></textarea>
        </div>
        <br><br><br><br><br><br>
    </div> 

</div>


<div class="row">
    <div class="col-md-12">
        <br>
        <legend>4. PARECER/CONCLUSÃO</legend>
        <div class="col-md-12">
            <textarea class="form form-control" name="parecer" id="parecer" cols="" rows="5"  maxlength="16777200"></textarea>
        </div>
        <br><br><br><br><br><br>
    </div> 

</div>

<div class="row">
    <div class="col-md-12">
        <br>
        <legend>5. RECOMENDAÇÃO/CONSIDERAÇÃO</legend>
        <div class="col-md-12">
            <label>Providências imediatas :</label><br>
            <textarea class="form form-control" name="rec_prov_imediata" id="rec_prov_imediata" cols="" rows="5"  maxlength="16777200"></textarea>
        </div>

        <div class="col-md-12">
            <label>Medidas para recuperação :</label><br>
            <textarea class="form form-control" name="rec_medidas_recuperacao" id="rec_medidas_recuperacao" cols="" rows="5" maxlength="16777200"></textarea>
        </div>
        <br><br><br><br><br><br>
    </div> 

</div>


<div class="row">
    <div class="col-md-12">
        <br>
        <legend>6. CONSIDERAÇÕES FINAIS</legend>
        <div class="col-md-12">
            <textarea class="form form-control" name="considera_finais" id="considera_finais" cols="" rows="5" maxlength="16777200"></textarea>
        </div>
        <br><br><br><br><br><br>
    </div> 

</div>


<div class="row">
    <div class="col-md-12">
        <br>
        <legend>7. RESPONSÁVEL/VISTORIADOR</legend>
        <div class="col-md-12">
            <label>Nome do Responsavel :</label><br>
            <input class="form form-control" type="text" name="resp_vistoriador" id="resp_vistoriador" maxlength="100">

        </div>
        <br><br><br><br><br><br>
    </div> 

</div>


<input class='btn btn-primary' type="submit" name="btnGravar" id="btnGravar" value="Gravar">
</form>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>


</script>
</body>
</html>

