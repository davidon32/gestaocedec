<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

    <legend>Filtro Relatorio Cadastro Materiais</legend>
                <form action="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&controller=relatorio&action=rel_cad_mat" method="POST">

                <div class="col-md-4">
                    <label>Data Inicial de Entrada no Sistema</label>
                    <input class="form-control" type="text" id="txtDtInicio" name="txtDtInicio" data-mask="99/99/9999" required />
                </div>
                <div class="col-md-4">
                    <label>Data Final de Entrada no Sistema</label>
                    <input class="form-control" type="text" id="txtDtFinal" name="txtDtFinal" data-mask="99/99/9999" required />
                </div>
                <div class="col-md-4">
                        <label>Ordem</label><br>
                            <input type="radio" id="" name="rbOrdem" value="0" checked="checked"/>&nbsp; Nome<br>
                            <input type="radio" id="" name="rbOrdem" value="1" />&nbsp; Data Entrada<br>
                            <input type="radio" id="" name="rbOrdem" value="2" />&nbsp; Origem<br>
                            <input type="radio" id="" name="rbOrdem" value="3" />&nbsp; Deposito Destino<br>
                            <input type="radio" id="" name="rbOrdem" value="4" />&nbsp; Validade<br><br>
                </div>
                                   
                            <input class="btn btn-info" type="submit" class="btn" id="" name="" value="Pesquisar"/>
                            <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&controller=conestoque&action=relindex">Voltar</a>
                </form>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">

	$("#txtDtInicio").datepicker({ dateFormat: 'dd/mm/yy' });
	$("#txtDtFinal").datepicker({ dateFormat: 'dd/mm/yy' });
	
</script>