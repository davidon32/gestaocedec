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
        <div class="col-md-12">
            <a href='<?= FuncaoBase::geraLink("equipe", "viatura", "novo") ?>' class='btn btn-primary' title='Cadastrar nova Vatura para DSP'>Novo</a>
            <br>
            <br>
            <a href='<?= FuncaoBase::geraLink("equipe", "viatura", "search") ?>' class='btn btn-primary' title='Pesquisa para Edição e Visualizar Registro'>Pesquisar</a>
        </div>
    </div>
</div>
<p>
    <div class='row'>
        <div class="col-md-12">

        <table class="table table-bordered table-striped">
            <tr>
                <th colspan="5" class='text-center'>CADASTRO VIATURA</th>
            </tr>
            <tr>
                <td>#</td>
                <td>Placa</td>
                <td>Placa Seg.</td>
                <td>Nome</td>
                <td>Ação</td>
            </tr>
            
            <?php
                       
                foreach ($viatura as $key => $value) {
                    
                    print "<tr>
                            <td>".($key+1)."</td>
                            <td>".$value['placa']."</td>
                            <td>".$value['placa_seguranca']."</td>
                            <td>".$value['nome']."</td>
                            <td><a href='#'><img src='/core/imagem/view.png'></a></td>
                    </tr>";
                    
                }
            
            ?>

        </table>

        <p><button class='btn btn-success' type="button" onclick="history.back();" >Voltar</button>
    </div>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>    