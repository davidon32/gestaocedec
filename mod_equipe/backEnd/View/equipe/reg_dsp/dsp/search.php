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

<p>
    <div class='row'>
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form method="POST" action="<?= FuncaoBase::geraLink("equipe", "equipe", "busca_dsp")?>">
                <label>Busca Registro DSP</label>
                <br><br>
                <input type='radio' name='rb' id='rb' value="0" checked="">
                <label>Local</label>
                <br>
                <input type='radio' name='rb' id='rb' value="1">
                <label>Data DSP</label>
                <br>
                <input type='radio' name='rb' id='rb' value="2">
                <label>Integrante</label>
                <br>
                <input type='radio' name='rb' id='rb' value="3"> 
                <label>Evento</label>
            <input type="text" name="txtSearch" id='txtSearch' class='form form-control'>
            <br>
            <input class="btn btn-primary" type="submit" name="btnSearch" id="btnSearch" value="Pesquisar">
            <br>
            </form>
            <br>
            <?php
            
                $pesquisa = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : "";
                $botao = isset($_POST['btnSearch']) ? $_POST['btnSearch'] : "" ;
               
                if($botao = "Pesquisar" && !empty($pesquisa) ){
                    
                    $dados = RegistroDspEquipeModel::search($pesquisa);
                 
                    print "<table id='listViatura' class='table table-bordered' >
                        <thead>
                        <tr>
                            <th colspan=\"8\" class='text-center'>Registro DSP</th>
                        </tr><tr>
                                    <td>#</td>
                                    <td>Data Hora</td>
                                    <td>Evento</td>
                                    <td>Local</td>
                                    <td>Integrantes</td>
                                    <td>Data Inicio</td>
                                    <td>Data Final</td>
                                </tr>
                                </thead>";
                    
                    foreach ($dados as $key => $value) {

                            print "<tbody><tr>
                                    <td>".($key+1)."</td>
                                    <td>".$value['data_hora']."</td>
                                    <td>".FuncaoBase::listaBreakLine('dec_cobrade', 'id_cobrade', 'descricao', FuncaoBase::pipeToString($value['ids_evento']))."</td>
                                    <td>".FuncaoBase::listaBreakLine('cedec_municipio', 'id_municipio', 'nome',FuncaoBase::pipeToString($value['ids_municipio']))."</td>
                                    <td>".FuncaoBase::listaBreakLine('cedec_funcionario', 'id_funcionario','nome', FuncaoBase::pipeToString($value['ids_integrante']))."</td>
                                    <td>".$value['data_hora_inicio']."</td>
                                    <td>".$value['data_hora_fim']."</td>
                                    <td><a href='".FuncaoBase::geraLink("equipe", "equipe", "edit", array('id'=>$value['id_reg_dsp']))."'><img src='/core/imagem/editar.png'></a></td>
                                </tr>
                                </tbody>";
                    }
                        print "</table>";
                }
?>
        <p><button class='btn btn-success' type="button" onclick="window.location.href= '<?= FuncaoBase::geraLink("equipe", "index", "index")?>';" >Voltar</button>
    </div>
    <div class="col-md-1"></div>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>    
