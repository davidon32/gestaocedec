<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<style>

    .saldo {
        font-size: 25pt;
    }
</style>

<div class="col-md-12">

    <legend>Ajuste de Saldo Materiais</legend>
    <label>Deposito</label>
    <?=Deposito::pegaDeposito();?>
    <br>
    <div class="col-md-4">
        <label>Material</label>
        <?=Produto::pegaProduto();?>
    </div>
    <div class="col-md-4">
        <label>Saldo Atual</label>
        <input id="txtSaldoAtual" class="form-control" type="text" value="" readonly>
    </div>
    <div class="col-md-4">
        <label>Valor Correção</label>
        <input id="txtSaldoCorrecao" class="form-control" type="spin" value="0" maxlength="4">
    </div>
    <div class="col-md-12">
        <label>Obs (Nº de Liberacao ou Transferencia / origem de algum evento)</label>
        <textarea id="txtObs" name="txtObs" class="form-control" rows="4" maxlength="255" ></textarea>
    </div>

    <div class="col-md-12" id="correcaoSaldo"> 
        <br>
       <div class="col-md-2 text-center">
           <label>Saldo Atual </label><br>
           <span id="saldoAtual" class="saldo"></span>
        </div>
        <div class="col-md-2 text-center">
            <label>Saldo Novo </label><br>
            <span id="saldoNovo" class="saldo">0</span> 
        </div>
        <div class="col-md-8 text-center">
            <p style="font-size: 15pt;color:red;">Leia com Atenção:</p><p class="text-justify" style="font-weight: bold; color: red">Para maior precisão nesta operação e evitar erros desnecessários o usuario deverá incrementar ou decrementar
            o campo "Valor Correção", não sendo possível a livre digitação neste campo, e apos a mudança poderá conferir
                o novo valor que será gravado no saldo do respectivo material escolhido.</p><br>
                No cadastro de Material será lancado um registro desta operação com o histórico <b>"Ajuste manual de Saldo"</b>
            </p>
               
        </div>
        <br>
        <div class="col-md-12 text-center">
             <a class="btn btn-info" id="btnCorrecaoSaldo">Gravar</a>
        </div>
    </div>
</div>

<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=index"/>Voltar</a>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">

$(document).ready(function(){

    var spinner = $("#txtSaldoCorrecao").spinner({
        max:50,
        min:-50,
        step: 1,
        numberFormat : "n"
    });

    /* calcula o novo saldo */
    $("#txtSaldoCorrecao").on("spin", function( event, ui ) {
        var valorCorrecao = ui.value;
        var saldoAtual = parseInt($("#saldoAtual").text());
        var saldoNovo = saldoAtual + valorCorrecao;
        $("#saldoNovo").text(saldoNovo);
        //console.log(ui);

    });


    $("#correcaoSaldo").hide();

    $("#id_produto").change(function(){

        if($("#id_deposito").val() != "0"){

            var id_deposito = $("#id_deposito").val();
            var id_produto = $("#id_produto").val();

            $("#correcaoSaldo").show();

            var dados = {
                    "id_deposito": id_deposito,
                    "id_produto": id_produto,
                    "opcao" : "saldo",
            };

            /* ajax buscar saldo*/
            $.ajax({
                type: 'POST',
                url: 'mod_ajuda/backEnd/View/conEstoque/estoque/buscaSaldoDeposito.php?v=<?=md5(VERSAO)?>',
                data: dados,
                success: function(response) {
                    $("#saldoAtual").text(response);
                    $("#txtSaldoAtual").val(response);


                },
                error: function(e){
                    console.log(JSON.stringify(e));
                }				
            });
        }



    });

    /* Corrige o Saldo */
    $("#btnCorrecaoSaldo").click(function(){
        var id_deposito = $("#id_deposito").val();
        var id_produto = $("#id_produto").val();
        var qtd = parseInt($("#txtSaldoCorrecao").val(), 10);
        var obs = $("#txtObs").val();

        var isValid = $( "#txtSaldoCorrecao" ).spinner( "isValid" );

        var dados = {
                "id_deposito": id_deposito,
                "id_produto": id_produto,
                "qtd"       : qtd,
                "opcao" : "gravar",
                'obs'   : obs,
        };

        if(isValid){

            /* ajax grava saldo*/
            $.ajax({
                type: 'POST',
                url: 'mod_ajuda/backEnd/View/conEstoque/estoque/buscaSaldoDeposito.php?v=<?=md5(VERSAO)?>',
                data: dados,
                success: function(response) {
                    console.log(response);
                    if(response == "sucesso"){
                        alert("Salvo corrigo com Sucesso !");
                        location.reload();
                    }
                },
                error: function(e){
                    console.log(JSON.stringify(e));
                }				
            });
        }else{
            alert("Número inválido para Correção do saldo \n O valor deve estar entre 50 e -50");
        }



    });


})
</script>