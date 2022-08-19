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
            <img src='/core/imagem/icon_app/novo.png'><a href='<?= FuncaoBase::geraLink("equipe", "equipe", "reg_dsp") ?>' title='Novo Cadastro e Registro de DSP'>Novo Registro DSP</a>&nbsp;&nbsp;|&nbsp;&nbsp;
            <img src='/core/imagem/icon_app/novo.png'><a href='<?= FuncaoBase::geraLink("equipe", "viatura", "index") ?>' title='Novo Cadastro de Viatura'>Cadastro Veículo/Viatura</a>&nbsp;&nbsp;|&nbsp;&nbsp;
            <img src='/core/imagem/icon_app/search.png'><a href='<?= FuncaoBase::geraLink("equipe", "equipe", "busca_dsp") ?>' title='Listagem busca Registro'>Pesquisa</a>
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
                <th colspan="7" style="text-align:center">Últimas DSP's</th>
            </tr>
            <tr>
                <th style="text-align:center">#</th>
                <th style="text-align:center">Data Hora</th>
                <th style="text-align:center">Local</th>
                <th style="text-align:center">Evento</th>
                <th style="text-align:center">Data Inicio</th>
                <th style="text-align:center">Data Final</th>
                <th style="text-align:center">Ações</th>
            </tr>
            <?php
            
                if(count($dsp) > 0) {
            
                foreach ($dsp as $key => $value) {

                    print "<tr><td>".($key+1)."</td>";
                    print "<td>". DataMysql::dataCompletaVisual($value['data_hora'])."</td>";
                    print "<td>".FuncaoBase::listaBreakLine('cedec_municipio', 'id_municipio', 'nome', FuncaoBase::pipeToString($value['ids_municipio']))."</td>";
                    print "<td>".FuncaoBase::listaBreakLine('dec_cobrade', 'id_cobrade', 'descricao', FuncaoBase::pipeToString($value['ids_evento']))."</td>";
                    print "<td>".DataMysql::dataCompletaVisual($value['data_hora_inicio'])."</td>";
                    print "<td>".DataMysql::dataCompletaVisual($value['data_hora_fim'])."</td>";   
                    print "<td><a href='".FuncaoBase::geraLink("equipe", "equipe", "editDsp", array('id'=>$value['id_reg_dsp']))."'><img src='/core/imagem/editar.png'></a>&nbsp;&nbsp;
                          <a href='".FuncaoBase::geraLink("equipe", "equipe", "upload_dsp", array('id'=>$value['id_reg_dsp']))."' title='upload de Documentos'><img width='25' src='/core/imagem/upload1.png'></a>
                          <a href='".FuncaoBase::geraLink("equipe", "equipe", "view_dsp", array('id'=>$value['id_reg_dsp']))."' title='Visualizar Registro'><img width='25' src='/core/imagem/view.png'></a></td>";   
                    print "</tr>";
                    
                }
                
                }
                
                ?>
            
            

        </table>

            <p><a href='<?= FuncaoBase::geraLink("index", "index", "menu")?>' class='btn btn-success' >Voltar</a>
    </div>
</div>
<?php include_once "template/page/rodapePage.php" ?>