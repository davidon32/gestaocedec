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
    <div class="col-md-12">
        <div class="col-md-6">
            <a href='<?= FuncaoBase::geraLink("equipe", "equipe", "reg_dsp") ?>' class='btn btn-primary' title='Novo Cadastro e Registro de DSP'>Registro DSP</a><br><br>
            <a href='<?= FuncaoBase::geraLink("equipe", "viatura", "index") ?>' class='btn btn-primary' title='Novo Cadastro e Registro de DSP'>Cadastro Veículo/Viatura</a>
        </div>
        <div class="col-md-6 text-center">
        </div>
    </div>
</div>
<p>
    <div class='row'>
        <div class="col-md-12">
        <table class="table table-bordered table-striped">
            <tr>
                <th colspan="6" style="text-align:center">Últimas DSP's</th>
            </tr>
            <tr>
                <th style="text-align:center">#</th>
                <th style="text-align:center">Data Hora</th>
                <th style="text-align:center">Local</th>
                <th style="text-align:center">Evento</th>
                <th style="text-align:center">Data Inicio</th>
                <th style="text-align:center">Data Final</th>
            </tr>
            <?php
                foreach ($dsp as $key => $value) {

                    print "<tr><td>".($key+1)."</td>";
                    print "<td>". DataMysql::dataCompletaVisual($value['data_hora'])."</td>";
                    print "<td>".Municipio::listaMunicipioBreakLine(FuncaoBase::pipeToString($value['ids_municipio']))."</td>";
                    print "<td>".CobradeModel::listaEventosBreakLine(FuncaoBase::pipeToString($value['ids_evento']))."</td>";
                    print "<td>".DataMysql::dataCompletaVisual($value['data_hora_inicio'])."</td>";
                    print "<td>".DataMysql::dataCompletaVisual($value['data_hora_fim'])."</td>";   
                    print "</tr>";
                    
                }
                
                ?>
            
            

        </table>

            <p><a href='<?= FuncaoBase::geraLink("index", "index", "menu")?>' class='btn btn-success' >Voltar</a>
    </div>
</div>