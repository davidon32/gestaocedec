<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_admin/Model/admModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<link href="/plugins/select2/css/select2.min.css" rel="stylesheet" />

<style>
    p {text-align: center};

</style>
<div class="col-md-12 text-center">
    <a class='btn btn-success' href='<?= FuncaoBase::geraLink('equipe', 'index', "index")?>'>Voltar</a>
    <br>
</div>

<form action="<?= FuncaoBase::geraLink("equipe", "equipe", "editDsp")?>" method="POST" name="frmDsp" id="frmDsp" >
    <div class='row'>
        <div class="col-md-12">

            <label>Código</label>
            <input type="text" class="form form-control" name="id_reg_dsp" id="id_reg_dsp" maxlength="4" readonly="readonly" value="<?=$dados['id_reg_dsp']?>" >
            
            <label>Data</label>
            <input type="text" class="form form-control" name="data_hora" id="data_hora" maxlength="16" required value="<?= DataMysql::dataVisual($dados['data_hora'])?>">

            <label>Local de Atividades</label>
            <select class="js-example-basic-multiple form form-control" name="states[]" multiple="multiple" id="selLocal" required " >
                <?= $lista ?>
            </select>

            <label>Objetivo DSP</label> (Maximo 255 Caracteres)
            <textarea class="form form-control" maxlength="255" rows="10" name="txtObj" id="txtObj" required ><?=$dados['objetivo']?></textarea>


            <label>Evento Associado</label>
            <select class="js-example-basic-multiple form form-control" name="evento[]" multiple="multiple" id="selEvento" required >
                <?= $listaEvento ?>
            </select>

            <label>Data Início</label>
            <input type="datetime" class="form form-control" name="datetime_inicio" id="data_inicio" maxlength="16" required value="<?= DataMysql::dataCompletaVisual($dados['data_hora_inicio'])?>" >

            <label>Data Final</label>
            <input type="text" class="form form-control" name="datetime_final" id="data_final" maxlength="16" required value="<?=DataMysql::dataCompletaVisual($dados['data_hora_fim'])?>" >

            <label>Historico DSP</label> (Maximo 255 Caracteres)
            <textarea class="form form-control" maxlength="16777" rows="15" name="txtHist" id="txtHist" required ><?=$dados['historico']?></textarea>

            <label>Viaturas</label>
            <select class="js-example-basic-multiple form form-control" name="viatura[]" multiple="multiple" id="selViatura" required >
                <?= $listaViatura ?>
            </select>

            <label>Integrantes</label>
            <select class="js-example-basic-multiple form form-control" name="integrante[]" multiple="multiple" id="selIntegrante" required >
                <?= $listaInteg ?>
            </select>

            <label>Observações</label> (Maximo 255 Caracteres)
            <textarea class="form form-control" maxlength="255" rows="10" name="txtObs" id="txtObs" required ><?=$dados['obs']?></textarea>


        </div>
        <div class="col-md-12 text-center">
            <br>
            <input type="submit" name="btnGravar" id="btnGravar" class="btn btn-primary" value="Gravar">
        </div>
    </div>
</form>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>    

<script src="/plugins/select2/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
        
        $('#selLocal').val([<?=FuncaoBase::pipeToString($dados['ids_municipio'])?>]);
        $('#selLocal').trigger('change');
        
        $('#selEvento').val([<?=FuncaoBase::pipeToString($dados['ids_evento'])?>]);
        $('#selEvento').trigger('change');
        
        $('#selViatura').val([<?=FuncaoBase::pipeToString($dados['ids_viatura'])?>]);
        $('#selViatura').trigger('change');
        
        $('#selIntegrante').val([<?=FuncaoBase::pipeToString($dados['ids_integrante'])?>]);
        $('#selIntegrante').trigger('change');
        
        jQuery('#data_inicio').datetimepicker({
            format:'d/m/Y H:i',
            lang:'pt-BR',
        });
        jQuery('#data_final').datetimepicker({
            format:'d/m/Y H:i',
            lang:'pt-BR',
        });
        
        
    });
        
</script>