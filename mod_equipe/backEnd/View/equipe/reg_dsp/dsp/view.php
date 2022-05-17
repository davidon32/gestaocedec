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
<style>
    p {text-align: center};

</style>


<div class='row'>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <p><button class='btn btn-success' type="button" onclick="window.location.href = '<?= FuncaoBase::geraLink("equipe", "index", "index") ?>';" >Voltar</button>
    </div>
    <div class="col-md-2"></div>
</div>

<table class="table table-bordered">
    <tr>
        <td class="col-md-6"><label>Numero DSP :</label><br><?= $dados['id_reg_dsp']; ?></td>
        <td class="col-md-6"><label>Data Hora Registro :</label><br><?= $dados['data_hora']; ?></td>
    </tr>

    <tr>
        <td colspan="2"><label>Objetivo :</label><br><?= $dados['objetivo']; ?></td>
    </tr>

    <tr>
        <td colspan="2"><label>Evento :</label><br><?= FuncaoBase::listaBreakLine('dec_cobrade', 'id_cobrade', 'descricao', FuncaoBase::pipeToString($dados['ids_evento'])); ?></td>
    </tr>

    <tr>
        <td class="col-md-6"><label>Data Inicio :</label><br><?= $dados['data_hora_inicio']; ?></td>
        <td class="col-md-6"><label>Data Fim DSP :</label><br><?= $dados['data_hora_fim']; ?></td>
    </tr>

    <tr>
        <td colspan="2"><label>Integrante(s) :</label><br><?= FuncaoBase::listaBreakLine('cedec_funcionario', 'id_funcionario', 'nome', FuncaoBase::pipeToString($dados['ids_integrante'])); ?></td>
    </tr>

    <tr>
        <td colspan="2"><label>Local DSp :</label><br><?= FuncaoBase::listaBreakLine('cedec_municipio', 'id_municipio', 'nome', FuncaoBase::pipeToString($dados['ids_municipio'])); ?></td>
    </tr>

    <tr>
        <td colspan="2"><label>Viaturas DSP :</label><br><?= FuncaoBase::listaBreakLine('equ_reg_dsp_viatura', 'id_viatura', 'nome', FuncaoBase::pipeToString($dados['ids_viatura'])); ?></td>
    </tr>

    <tr>
        <td colspan="2"><label>Historico DSP :</label><br><?= $dados['historico']; ?></td>
    </tr>

    <tr>
        <td colspan="2"><label>Obs :</label><br><?= $dados['obs']; ?></td>
    </tr>
    
    <tr>
        <td colspan="2"><label>Documento Anexo :</label><br>
        
        <?php
                foreach ($anexo as $key => $value) {
                    print "<br>".($key+1).")&nbsp;&nbsp;&nbsp;<a target='_blank' href='".strtolower($value['nome'])."'>".strtolower($value['nome']).$value['data_hora']."</a><br>";
            }
        ?>
        </td>
    </tr>

</table>



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>    
