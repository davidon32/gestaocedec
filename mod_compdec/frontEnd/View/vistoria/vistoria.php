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

$plano = new Plano();
?>


<legend>Termo de Vistoria</legend>

<div class="col-md-12 text-center">
    <a class="btn btn-success" href="<?= FuncaoBase::geraLink('index', 'index', 'menue')?>">Voltar</a>
</div>
<div class="col-md-6">
    <a class="" href="<?= FuncaoBase::geraLink('compdec', 'compdec', 'download', array('arquivo'=>'anexo/modelo/RELATORIO_VISTORIA_ATENDIMENTO_EMERGENCIAL.docx'))?>">baixar Modelo de Termo de Vistoria </a><br><br>
     <a class="btn btn-primary" href="<?= FuncaoBase::geraLink('compdec', 'vistoria', 'novo')?>">Novo Termo</a>
     <form>
         <label>Buscar</label>
         <input class='form form-control' type="text" name="txtBusca" id="txtBusca">
         <br>
         <input class='btn btn-primary' type="submit" name="btnBusca" id="btnBusca">
         
     </form>

</div>
<div class="col-md-6">
    
    

    <legend>Listagem Termo de Vistoria</legend>

    <table class="table table-bordered table-condensed table-striped" >
        <tr>
            <th class="col-md-1">Data</th>
            <th class="col-md-1">Número</th>
            <th class="col-md-5">Bairro</th>
            <th class="col-md-5">Endereço</th>
        </tr>


        <?php
        
        ?>
    </table>

</div>


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

