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

<legend>Edição Produto</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "fornecedor", "edit");?>" method="post" accept-charset="utf-8" name="frmFornecedor" id="frmFornecedor">
    <div class="col-md-6">
        <label>Código:</label>
        <input class="col-md-12 form-control" type="text" name="id_unidade" id="id_unidade" value="<?=$view['id_unidade']?>" required="" readonly="readonly">
    </div>
    <div class="col-md-6">
        <label>Nome:</label>
        <input class="col-md-12 form-control" type="text" name="nome" id="nome" value="<?=$view['nome']?>" required="" maxlength="44">
    </div>
    <div class="col-md-6">
        <label>Descrição:</label>
        <input  class="col-md-12 form-control" type="text" name="descricao" id="descricao" value="<?=$view['descricao']?>" required="" maxlength="69">
    </div>

    <div class="col-md-6">
        <label>Valor:</label>
        <input  class="col-md-12 form-control" type="text" name="val_prod" id="val_prod" value="<?=$view['valor']?>" required="" maxlength="10">
    </div>
    <div class="col-md-6">
        <label>Marca:</label>
            <div class="input-group">
            <input  class="col-md-12 form-control" type="text" name="id_marca" id="id_marca" value="<?=$view['id_marca']?>" required="" maxlength="20">
            <div class="input-group-btn">
                <button class="btn btn-default" type="button">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label>Catgegoria:</label>
        <div class="input-group">
        <input  class="col-md-12 form-control" type="text" name="id_categoria" id="id_categoria" value="<?=$view['id_categoria']?>" required="" maxlength="20">
            <div class="input-group-btn">
                <button class="btn btn-default" type="button">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label>Almoxarifado:</label>
        <div class="input-group">
        <input  class="col-md-12 form-control" type="text" name="id_almoxarifado" id="id_almoxarifado" value="<?=$view['id_almoxarifado']?>" required="" maxlength="20">
            <div class="input-group-btn">
                <button class="btn btn-default" type="button">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
    </div>
     <div class="col-md-6">
        <label>Fornecedor:</label>
        <div class="input-group">
        <input  class="col-md-12 form-control" type="text" name="id_fornecedor" id="id_fornecedor" value="<?=$view['id_fornecedor']?>" required="" maxlength="20">
            <div class="input-group-btn">
                <button class="btn btn-default" type="button">
                   <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
     </div>
     <div class="col-md-6">
        <label>Unid.Medida:</label>
        <div class="input-group">
        <input  class="col-md-12 form-control" type="text" name="id_unidade_med" id="id_unidade_med" value="<?=$view['id_unidade_med']?>" required="" maxlength="20">
    
        <div class="input-group-btn">
                <button class="btn btn-default" type="button">
                   <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label>Validade:</label>
        <input  class="col-md-12 form-control" type="text" name="data_validade" id="data_validade" value="<?=$view['validade']?>" required="" maxlength="20">
    </div>
     
    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "conestoque", "cadgeral")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Atualizar">
    </div>
</form>

<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>
  
</script>


