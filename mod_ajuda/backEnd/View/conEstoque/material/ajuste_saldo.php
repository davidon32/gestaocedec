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

<div class='row'>
<div class="col-md-12">

    <legend>Ajuste de Saldo Materiais</legend>
    <label>Deposito</label>
    <?=Deposito::pegaDeposito();?>
    <br>
</div>
    <div class="col-md-3">
        <label>Material</label>
        <?=Produto::pegaProduto();?>
    </div>
    <div class="col-md-3">
        <label>Entrada</label>
        <select class='form-control' id='selEntrada' name='selEntrada'>
            <option></option>
        </select>
    </div>
    <div class="col-md-3">
        <label>Saldo Atual</label>
        <input id="txtSaldoAtual" name="txtSaldoAtual" class="form-control" type="text" value="0" readonly>
    </div>
    <div class="col-md-3">
        <label>Valor Correção</label><br>
        <input id="txtSaldoCorrecao" class="form-control" type="number" />
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

    
    $("#correcaoSaldo").hide();

    $("#selEntrada").change(function(){
        saldo = $("#selEntrada").find(':selected').data('saldo');
        $("#txtSaldoAtual").val(saldo);
        $("#txtSaldoCorrecao").attr({
            "max" : saldo,
            "min" : 1
                 });
        $("#saldoAtual").text(saldo);
    });
    
    $("#txtSaldoCorrecao").change(function(){
        var valorCorrecao = $(this).val();
        var saldoAtual = parseInt($("#txtSaldoAtual").val());
       
        if(valorCorrecao > saldoAtual){
            alert('Valor maior que o saldo disponivel !');
            $('#btnCorrecaoSaldo').attr('disabled', true);
        }else if(valorCorrecao <1){
            alert('Os Valores não podem ser negativos !');
            $('#btnCorrecaoSaldo').attr('disabled', true);
        
        }else {
            var saldoNovo = saldoAtual - valorCorrecao;
            $("#saldoNovo").text(saldoNovo);
            $('#btnCorrecaoSaldo').attr('disabled', false);
        }
    }); 

    $("#id_produto").change(function(){

        if($("#id_deposito").val() != "0"){
            
            $('#selEntrada')[0].options.length = 0;

            var id = $("#id_produto").val();
            var id_deposito = $("#id_deposito").val();

            $("#correcaoSaldo").show();

            var dados = {
                    'id_material': ''+ id +'',
                    'id_deposito':''+id_deposito+''
                }

            /* ajax buscar entrada */
            $.ajax({
                type: 'POST',
                url:"mod_ajuda/backEnd/View/conEstoque/liberacao/busca_entrada.php?v=<?=md5(VERSAO)?>",
                data: dados,
                dataType : "json",
                success: function(dados) {
                    //console.log(dados)
                    $('#selEntrada').append("<option></option>");
                    $.each(dados, (i, val) => {
                        var saldo = val.saldo;
                        if(typeof saldo == 'object') {
                            saldo = val.quantidade;
                        }else {
                            saldo = val.saldo;
                        }
                        $('#selEntrada').append(`<option value="${val.id_produto}" data-saldo="${saldo}"> ${val.id_produto} - Saldo Individual ${saldo} </option>`);
                        
                    });
                                    


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
        var qtd = parseInt(-$("#txtSaldoCorrecao").val(), 10);
        var obs = $("#txtObs").val();
        var id_entrada = $("#selEntrada").find(':selected').val();

        var dados = {
                "id_deposito": id_deposito,
                "id_produto": id_produto,
                "qtd"       : qtd,
                "opcao" : "gravar",
                "operacao" : "correcao",
                'obs'   : obs,
                'id_entrada' : id_entrada,
        };

            /* ajax grava saldo*/
            $.ajax({
                type: 'POST',
                url: 'mod_ajuda/backEnd/View/conEstoque/estoque/buscaSaldoDeposito.php?v=<?=md5(VERSAO)?>',
                data: dados,
                success: function(response) {
                    //console.log(response);
                    if(response == "sucesso"){
                        alert("Salvo corrigo com Sucesso !");
                        location.reload();
                    }
                },
                error: function(e){
                    console.log(JSON.stringify(e));
                }				
            });

    });


})
</script>