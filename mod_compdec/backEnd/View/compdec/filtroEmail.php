<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_compdec/Model/Model.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php

$_login = new Login();

$_funcaoBase = new FuncaoBase();

$_municipio = new Municipio();

$_associacao = new Associacao();

$_regiao = new Regiao();

$_compdec = new Compdec();

//FuncaoBase::vd($_SESSION);
?>

<div class="col-md-6">
    <legend> Filtro de Relatórios</legend>
    <br>
    <form action="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=compdec&controller=compdec&action=enviaEmail" method="POST" name="frm_filtro">

        <!--<div class="span5 inline">
            <input type="checkbox" value="0" name="rb_filtro" id="rb_existente">Todos Compdec's<br>
            <!--<input type="radio" value="1" name="rb_filtro" id="rb_existente">Compdec Existente<br>
            <input type="radio" value="2" name="rb_filtro" id="rb_regiao">Compdec por Região do Estado<br>
            
        </div>-->
</div>
<div class='col-md-6'>
<br><br>
    <div class="span4 divAssociacao">
        <!-- sub seção de relatório -->
        <legend>Associação</legend>
        <?php $_associacao->ComboAssociacao(); ?>
    </div>
    <div class="span4 divRegiao">
        <!-- sub seção de relatório -->
        <legend>Regial</legend>
        <?php $_regiao->ComboRegiao(); ?>
    </div>
    <div class="span4 divData">
        <!-- sub seção de relatório -->
        <legend>Por Data</legend>
        Data Inicial : <input type="text" name="dt_inicio" data-mask="99/99/9999">
    </div>
    <div class="span4 divEmail"><br><br><br>
        <select id="" name="selEmail">
            <option value="0">Todos</option>
            <option value="1">Compdec Existente</option>
            <option value="2">Sem Compdec</option>
        </select>
    </div>
</div>
<div class="col-md-12 text-center">
    <input class="btn btn-primary" type="submit" name="btn_enviar" id="btn_enviar" value="Redigir Email" />
    
</div>
<div class='col-md-12 text-center'>
    <br>
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=compdec&controller=compdec&action=index">Voltar</a><br> <br> 
</div>
</form>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">
    $(document).ready(function() {

        $(".divAssociacao").hide();
        $(".divRegiao").hide();
        $(".divData").hide();
        $(".divEmail").hide();

        $("#rb_associacao").change(function() {

            $(".divAssociacao").show("slow");
            $(".divRegiao").hide();
            $(".divData").hide();

        });

        $("#rb_regiao").change(function() {

            $(".divRegiao").show("slow");
            $(".divAssociacao").hide();
            $(".divData").hide();

        });

        $("#rb_data").change(function() {

            $(".divData").show("slow");
            $(".divAssociacao").hide();
            $(".divRegiao").hide();

        });

        $("#rb_endereco").change(function() {

            $(".divData").hide();
            $(".divAssociacao").hide();
            $(".divRegiao").hide();

        });

        $("#rb_existente").change(function() {

            $(".divData").hide();
            $(".divAssociacao").hide();
            $(".divRegiao").hide();

        });
        $("#rb_resumo").change(function() {

            $(".divData").hide();
            $(".divAssociacao").hide();
            $(".divRegiao").hide();

        });
        $("#rb_listaEmail").change(function() {

            $(".divEmail").show();
        });

        $("#rb_listaOutlook").change(function() {

            $(".divEmail").show();
        });

    });
</script>

</body>

</html>