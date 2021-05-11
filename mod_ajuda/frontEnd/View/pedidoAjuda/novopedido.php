<?php include_once 'core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once 'mod_compdec/Model/Model.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menuExterno.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$id_municipio = isset($pageSession['session']['seguranca']['id_municipio']) ? $pageSession['session']['seguranca']['id_municipio'] : "";

$dados = array(Municipio::dadosMunicipio($id_municipio));

$dadosCompdec = Compdec::buscaCompdec($id_municipio);

$dados[] = $dadosCompdec;
var_dump($dados);

?>	
<div class="col-md-12 text-center">
    <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO)) ?>&ac=etn&modulo=index&controller=index&action=menue">Voltar</a>
</div>
<div class="col-md-12">
    <br>
    <a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "ajudahuman", "novo") ?>">Novo Pedido</a>
    <br><br>

    <div class="row">
        <div class="col-md-4">
            <label>Data Preenc.</label>
            <input class="form-control" type="text" name="data_hora_pedido" id="data_hora_pedido">
        </div>
        <div class="col-md-4">
            <label>Município</label>
            <input class="form-control" type="text" name="txt_municipio" id="id_municipio" value="<?=$dados[0]['nome']?>" readonly="reaonly">
        </div>
        <div class="col-md-4">
            <label>Mesorregião</label>
            <input class="form-control" type="text" name="txt_meso" id="txt_meso" value="<?=$dados[0]['macroregiao']?>" readonly="reaonly">
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <label>Nome Coordenador</label>
            <input class="form-control" type="text" name="txt_coordenador" id="txt_coordenador">
        </div>
        <div class="col-md-4">
            <label>Tel. Coordenador</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
        <div class="col-md-4">
            <label>Email Coordenador</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <label>Nome Prefeito</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
        <div class="col-md-4">
            <label>Tel. Prefeito</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
        <div class="col-md-4">
            <label>Email Prefeito</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <label>Tipo Desastre</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
        <div class="col-md-4">
            <label>Pop. Afetada</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
        <div class="col-md-4">
            <label>Decreto SE</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label>Num. Decreto</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
        <div class="col-md-4">
            <label>Data Vigência</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
        <div class="col-md-4">
            <label>Tipo Decreto</label>
            <input class="form-control" type="text" name="txt_num" id="id_num">
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <label>Esforços (descrever)</label>
            <textarea class="form-control" cols="5" rows="10" name="txt_num" id="id_num"></textarea>
        </div>
    </div>


</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>

</body>
</html>

