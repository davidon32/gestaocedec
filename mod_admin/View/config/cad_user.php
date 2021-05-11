<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_compdec/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<div class="col-md-6">
    <form action="?token=<?=hash('sha256', md5(VERSAO));?>&ac=&modulo=admin&controller=adm&action=cad_user_valida" method="POST" name="frmCadUserRapido" id="frmCadUserRapido">
        <label>Numero Policia</label>
        <input class="form-control" type="text" name="txtNumPol" id="txtNumPol" maxlenght="9" data-mask='9999999-9')>

        <label>Nome Completo</label>
            <input class="form-control" type="text" name="txtNome" id="txtNome" maxlenght="9">
        <label>Usuario (alternativo S999999)</label>
            <input class="form-control" type="text" name="txtUsuario" id="txtUsuario" maxlenght="9">
        
        <label>Lotado</label>
        <select class="form-control" name="selSetor" id="selSetor">
            <option>CEDEC</option>
            <option>GMG</option>
        </select>
        
        <label>email</label>
        <input class="form-control" type="email" name="txtEmail" id="txtEmail">
        <input type="hidden" name="opcao" value="caduser">
        <br>

        <input class="btn btn-info" type="submit" name="btnEnviar" id="btnEnviar" value="Gravar">
        
    </form>
</div>
<div class="col-md-6">
    Modulos
    <br>
    <br>
    <div class="col-md-12">
        <label>Ajuda</label>
        <input type="checkbox" id="deposito">
        <br>
        <div class="col-md-6" id='ck_marcar_deposito_todos'>
            <label>Marcar Todos</label>
            <input type="checkbox" id="opcao_deposito_todos">
        </div>
        <br>
    </div>
        <!-- opcoes deposito -->
        <div class="col-md-12" id="opcao_deposito">
        <label>Cadastro de material</label>
<input type="checkbox" id="cad_material"><br>

<label>Pagamento de Material</label>
<input type="checkbox" id="cad_pagamento"><br>

<label>Transferencia de Material</label>
<input type="checkbox" id="cad_transferencia"><br>

<label>Liberacao de Material</label>
<input type="checkbox" id="cad_liberacao"><br>

<label>Ajuda e Suporte ao Sistema</label>
<input type="checkbox" id="cad_ajuda_suporte"><br>

<label>Cadastro de Usuario</label>
<input type="checkbox" id="cad_usuario"><br>

<label>Cadastro de Configuracao Geral do sistema</label>
<input type="checkbox" id="cad_conf_ger"><br>

<label>Consulta e Relatorios</label>
<input type="checkbox" id="relatorio"><br>

<label>Relatorio Saldo Geral de Produtos de Todos os Depositos</label>
<input type="checkbox" id="rel_saldo_geral"><br>

<label>Relatorios de saldo por Deposito</label>
<input type="checkbox" id="rel_saldo_p_deposito"><br>

<label>Acesso a relatorio</label>
<input type="checkbox" id="liberacao"><br>

<label>2 via liberacao</label>
<input type="checkbox" id="rel_comp_liberacao"><br>

<label>Relatorio de Material Liberado</label>
<input type="checkbox" id="rel_mat_liberado"><br>

<label>Relatorio de Material Pago</label>
<input type="checkbox" id="rel_mat_pago"><br>

<label>2 Via recibo de pgto material</label>
<input type="checkbox" id="rel_comp_mat_pago"><br>

<label>Acesso a menu Transferencia de Material</label>
<input type="checkbox" id="transferencia"><br>

<label>Relatorio de Transferencia de Material</label>
<input type="checkbox" id="rel_mat_transferido "><br>

<label>Relatorio de Material em Transito</label>
<input type="checkbox" id="rel_mat_transito"><br>

<label>acesso ao lembrete de liberacao na tela inicial</label>
<input type="checkbox" id="lembrete_libera"><br>

<label>Acesso ao Lembrete de Material em Transito</label>
<input type="checkbox" id="lembrete_transito"><br>

<label>Acesso a Pagina inicial do Modulo</label>
<input type="checkbox" id="inicial"><br>

<label>Acesso ao submenu deposito</label>
<input type="checkbox" id="cad_deposito"><br>

<label>Acesso relatorio de cadastro de material</label>
<input type="checkbox" id="rel_cad_mat"><br>

<label>Resumo de liberacoes</label>
<input type="checkbox" id="rel_resumo_liberacao"><br>

<label>Pedido Ajuda Humanitária</label>
<input type="checkbox" id="pedido_ajuda"><br>


        </div>
    
    <div class="col-md-12">
        <label>Emergencia
        <input type="checkbox" id="cce"></label>
    </div>
        <!-- opcoes cce -->
        <div class="col-md-12" id="opcao_cce">
            opcoes cce
        </div>
    
    <div class="col-md-12">
        <label>Decreto
        <input type="checkbox" id="decretacao"></label>
    </div>
        <!-- opcoes deposito -->
        <div class="col-md-12" id="opcao_decretacao">
            opcoes decreto
        </div>

    <div class="col-md-12">
        <label>Compdec
        <input type="checkbox" id="compdec"></label>
    </div>
        <!-- opcoes deposito -->
        <div class="col-md-12" id="opcao_compdec">
            opcoes compdec
        </div>

    <div class="col-md-12">
        <label>Equipe
        <input type="checkbox" id="apoio"></label>
    </div>
        <!-- opcoes deposito -->
        <div class="col-md-12" id="opcao_apoio">
            opcoes apoio
        </div>

    <div class="col-md-12">
        <label>EScola
        <input type="checkbox" id="escola"></label>
    </div>
        <!-- opcoes deposito -->
        <div class="col-md-12" id="opcao_escola">
            opcoes escola
        </div>
    
    <div class="col-md-12">
        <label>Poço
        <input type="checkbox" id="poco"></label>
    </div>
        <!-- opcoes deposito -->
        <div class="col-md-12" id="opcao_poco">
            opcoes poco
        </div>

</div>
<br>
<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO));?>&ac=&modulo=admin&controller=adm&action=usuario">Voltar</a>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script>

    $(document).ready(function(){

        $("#opcao_deposito").hide();
        $("#opcao_cce").hide();
        $("#opcao_decretacao").hide();
        $("#opcao_compdec").hide();
        $("#opcao_apoio").hide();
        $("#opcao_escola").hide();
        $("#opcao_poco").hide();
        
        
        $("#ck_marcar_deposito_todos").hide();
        



        var mod_deposito = 0;
        var mod_cce = 0;
        var mod_decretacao = 0;
        var mod_compdec = 0;
        var mod_apoio = 0;
        var mod_escola = 0;
        var mod_poco = 0;



        $("#opcao_deposito_todos").change(function(){
            
            if($("#opcao_deposito_todos").is(":checked")){
                $("#opcao_deposito").children('input[type=checkbox]').prop('checked', true);
            }else {
                $("#opcao_deposito").children('input[type=checkbox]').prop('checked', false);
            }
        });

        $("#deposito").change(function(){
            if($("#deposito").is(":checked")){
                mod_deposito = 1;
                $("#opcao_deposito").fadeIn('slow');
                $("#ck_marcar_deposito_todos").fadeIn('slow');
            }else{
                mod_deposito = 0;
                $("#opcao_deposito").fadeOut('slow');
                $("#ck_marcar_deposito_todos").fadeOut('slow');
            }
        });

        $("#cce").change(function(){
            if($("#cce").is(":checked")){
                mod_cce = 1;
                $("#opcao_cce").fadeIn('slow');
            }else{
                mod_cce = 0;
                $("#opcao_cce").fadeOut('slow');
            }
        });
        $("#decretacao").change(function(){
            if($("#decretacao").is(":checked")){
                mod_decretacao = 1;
                $("#opcao_decretacao").fadeIn('slow');
            }else{
                mod_decretacao = 0;
                $("#opcao_decretacao").fadeOut('slow');
            }
        });
        $("#compdec").change(function(){
            if($("#compdec").is(":checked")){
                mod_compdec = 1;
                $("#opcao_compdec").fadeIn('slow');
            }else{
                mod_compdec = 0;
                $("#opcao_compdec").fadeOut('slow');
            }
        });
        $("#apoio").change(function(){
            if($("#apoio").is(":checked")){
                mod_apoio = 1;
                $("#opcao_apoio").fadeIn('slow');
            }else{
                mod_apoio = 0;
                $("#opcao_apoio").fadeOut('slow');
            }
        });
        $("#escola").change(function(){
            if($("#escola").is(":checked")){
                mod_escola = 1;
                $("#opcao_escola").fadeIn('slow');
            }else{
                mod_escola = 0;
                $("#opcao_escola").fadeOut('slow');
            }
        });
        $("#poco").change(function(){
            if($("#poco").is(":checked")){
                mod_poco = 1;
                $("#opcao_poco").fadeIn('slow');
            }else{
                mod_poco = 0;
                $("#opcao_poco").fadeOut('slow');
            }
        });
        
        // ajax gravar modulos

        //ajax gravar permissao






    });

</script>