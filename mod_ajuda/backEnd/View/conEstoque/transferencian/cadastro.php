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

<?php
$transferenciaModel = new TransferenciaConEstoqueModel();

$dadosAlmoxarifado = $transferenciaModel->listaid_almoxarifadoAutocomplete();


$id_tp_pedido = isset($_COOKIE['transferencia']['id_tp_pedido']) ? $_COOKIE['transferencia']['id_tp_pedido'] : "";
$nome_tp_pedido = isset($id_tp_pedido) ? $transferenciaModel->getNomeIdFk('aju_ctp_pedido', 'id_tp_pedido', $id_tp_pedido) : "";

$id_almoxarifado = isset($_COOKIE['transferencia']['id_almoxarifado']) ? $_COOKIE['transferencia']['id_almoxarifado'] : "";
$nome_almoxarifado = isset($id_almoxarifado) ? Deposito::PegaNomeDeposito($id_almoxarifado) : "";

$id_unidade = isset($_COOKIE['transferencia']['id_material']) ? $_COOKIE['transferencia']['id_material'] : "";
$nome_unidade = isset($id_unidade) ? $transferenciaModel->getNomeIdFk('aju_cunidade', 'id_unidade', $id_unidade) : "";

$val_unit  = isset($_COOKIE['transferencia']['val_unit']) ? $_COOKIE['transferencia']['val_unit'] : "";

$id_nota   = isset($_COOKIE['transferencia']['id_nota']) ? $_COOKIE['transferencia']['id_nota'] : "";

$saldo = isset($_COOKIE['transferencia']['saldo']) ? $_COOKIE['transferencia']['saldo'] : "0";

?>

<legend>Transferencia de Material</legend>
<form method="post" accept-charset="utf-8" name="frmTransf" id="frmTransf">
<div class='row'>
    <div class='col-md-6'>
        <label>Armazém Origem</label> <!--Armaem-->
        <input type="text" class='form form-control' name='nome_almoxarifado_ori' id='nome_almoxarifado_ori' required readonly='readonly' value="<?=$nome_almoxarifado?>">
        <input type="hidden" name='id_almoxarifado_ori' id='id_almoxarifado_ori' required readonly='readonly' value="<?=$id_almoxarifado?>">
        <input type="hidden" name='val_unit' id='val_unit' required readonly='readonly' value="<?=$val_unit?>">
        <input type="hidden" name='val_total' id='val_total' required readonly='readonly'>
        <input type="hidden" name='id_nota' id='id_nota' required readonly='readonly' value="<?=$id_nota?>">
    </div>
    <div class='col-md-6'>
        <label>Almoxarifado</label> <!--almoxarifado-->
            <input type="text" class='form form-control' name='nomeTp_pedido_fk' id='nomeTp_pedido_fk' required readonly='readonly' value="<?=$nome_tp_pedido->nome?>">
            <input type="hidden" name='id_tp_pedido' id='id_tp_pedido' required readonly='readonly' value="<?=$id_tp_pedido?>">
    </div>
    <div class='col-md-6'>
        <label>Armazém Destino</label>
        <div class="input-group">
            <input type="text" class='form form-control' name='nome_almoxarifado_fk' id='nome_almoxarifado_fk' required readonly='readonly'>
            <span onclick="" class="input-group-addon" id="nomeAlmoxarifado_fk">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_almoxarifado' id='id_almoxarifado' required readonly='readonly'>
    </div>
    
    <div class='col-md-6'>
        <label>Nome Motorista</label>
        <input type="text" class='form form-control' name='txtMotorista' id='txtMotorista' required maxlength="70" >
    </div>
    
    <div class='col-md-6'>
        <label>Data Transferencia</label>
        <input type="text" class='form form-control' name='data_transferencia' id='data_transferencia'required value="<?= date('d/m/Y') ?>">
    </div>
    
    <div class='col-md-6'>
        <label>Identificação Motorista</label>
        <input type="text" class='form form-control' name='txtIdentificacao' id='txtIdentificacao' required maxlength="15" >
    </div>
    
    <div class='col-md-6'>
        <label>Veículo</label>
            <input type="text" class='form form-control' name='txtVeiculo' id='txtVeiculo' required maxlength="45">
    </div>
    <div class='col-md-6'>
        <label>Placa Veículo</label>
        <input type="text" class='form form-control' name='txtPlaca' id='txtPlaca' required maxlength="10">
    </div>
    
    <div class='col-md-6'>
        <label>Observação</label>
        <textarea class='form form-control' name='txtObs' id='txtObs' maxlength='200' ></textarea>
    </div>
    <br>
    <br>
</div>
    <div class="row tex-center">
        <br>
        <div class="col-md-3 text-center"></div>
    <div class="col-md-6 text-center">
        <table class="table table-bordered">
            <tr>
                <th class="text-center text-left col-md-1">Material</th>
                <th class="text-center col-md-1">Quantidade</th>
            </tr>
            <tr>
                <td><?=$nome_unidade->nome;?></td>
                <td>
                    <input class='form form-control' type="hidden" name="txt_id_unidade" id="txt_id_unidade" value="<?=$id_unidade?>" >
                    <input class='form form-control' type="number" name="txtQtd" id="txtQtd" value="0" max="<?=$saldo?>">
                </td>
            </tr>
        </table>
    </div>
        <div class="col-md-3 text-center"></div>
    </div>
    
    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "transferencian", "index") ?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    </div>

</form>


<!--######################  MODAL aju_almoxarifado ###################-->
<!-- ARMAZEM -->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_almoxarifado">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Armazém</h4>
            </div>
            <div class="modal-body">
                <label>Pesquisa</label>
                <input type="text" class="form form-control" name="searcid_almoxarifado" id="searcid_almoxarifado">
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <div class="col-md-6 text-left">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cadastrar Armazem</button>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL aju_almoxarifado ####################-->

<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
        
        var val_unit = 0.0;
        var qtd = 0;
        $("#data_emissao").mask("99/99/9999");
        
        $("#txtQtd").change(function(){

            qtd = parseInt($("#txtQtd").val());
            val_unit = parseFloat($("#val_unit").val().replace(",", "."));
            $("#val_total").val(val_unit *qtd)
            
        })
        
        
        /*###############################################*/
        /* clic form campo FK Armazem (almoxarifado) */
        $("#nomeAlmoxarifado_fk").click(function () {
            $("#modal_id_almoxarifado").modal('show');
        });
        /* focus no campo pesquisa  Armazem ( almoxarifado ) */
        $('#modal_id_almoxarifado').on('shown.bs.modal', function (e) {
            $("#searcid_almoxarifado").focus();
        });
        /*###############################################*/

        
        $("#frmTransf").trigger("reset");

        /*###################  ENVIO POST GRAVAR ################*/

        $("#frmTransf").submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {

                id_almoxarifado_ori :{required: true},
                nome_almoxarifado_ori: {required: true},
                id_tp_pedido :{required: true},
                nomeTp_pedido_fk: {required: true},
                id_almoxarifado :{required: true},
                txtMotorista :{required: true},
                txtIdentificacao :{required: true},
                data_transferencia :{required: true},
                txtVeiculo :{required: true},
                txtPlaca :{required: true},
                txt_id_unidade :{required: true},
                txtQtd: {max : <?=$saldo?>, required: true},
            },
            messages: {

                id_almoxarifado_ori: {required: 'O campo Quantidade não pode ficar em Branco !'},
                nome_almoxarifado_ori: {required: 'O campo Nome não pode ficar em Branco !'},
                id_tp_pedido: {required: 'O campo Quantidade não pode ficar em Branco !'},
                nomeTp_pedido_fk: {required: 'O campo Quantidade não pode ficar em Branco !'},
                id_almoxarifado: {required: 'O campo Quantidade não pode ficar em Branco !'},
                nome_almoxarifado_fk: {required: 'O campo Quantidade não pode ficar em Branco !'},
                txtMotorista: {required: 'O campo Quantidade não pode ficar em Branco !'},
                txtIdentificacao: {required: 'O campo Quantidade não pode ficar em Branco !'},
                data_transferencia: {required: 'O campo Quantidade não pode ficar em Branco !'},
                txtVeiculo: {required: 'O campo Quantidade não pode ficar em Branco !'},
                txtPlaca: {required: 'O campo Quantidade não pode ficar em Branco !'},
                txt_id_unidade: {required: 'O campo Quantidade não pode ficar em Branco !'},
                txtQtd: {max: 'Este valor é maior que o saldo em estoque !'},

            },

            submitHandler: function (form) {

                var form_data = new FormData();

                    form_data.append("id_almoxarifado_ori", $("#id_almoxarifado_ori").val());
                    form_data.append("id_tp_pedido", $("#id_tp_pedido").val());
                    form_data.append("id_almoxarifado", $("#id_almoxarifado").val());
                    form_data.append("motorista", $("#txtMotorista").val());
                    form_data.append("identificacao", $("#txtIdentificacao").val());
                    form_data.append("data_transferencia", $("#data_transferencia").val()+ " "+"<?=date("H:i:s");?>");
                    form_data.append("veiculo", $("#txtVeiculo").val());
                    form_data.append("obs", $("#txtObs").val());
                    form_data.append("placa", $("#txtPlaca").val());
                    form_data.append("val_unit", $("#val_unit").val().replace(",","."));
                    form_data.append("val_total", $("#val_total").val());
                    form_data.append("id_nota", $("#id_nota").val());
                    
                    form_data.append("id_unidade", $("#txt_id_unidade").val());
                    form_data.append("qtd", $("#txtQtd").val());

                    $.ajax({
                        type: 'POST',
                        url: '<?= FuncaoBase::geraLink('ajuda', 'transferencian', 'gravar') ?>',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function (response) {
                            console.log(response);
                            var resposta = response;
                            if (resposta.trim() === 'sucesso') {
                                alert("Transferencia realizada com Sucesso !");
                                window.location.href = "<?= FuncaoBase::geraLink('ajuda', 'transferencian', 'index') ?>";
                            } else {
                                console.log(response);
                            }
                        },
                        error: function (e) {
                            console.log(JSON.stringify(form_data));
                            console.log(JSON.stringify(response));
                            alert("Ocorreu um Erro !");
                        }

                    });

            }
        });


        /* ###################  fk_aju_almoxarifado ####################*/
        $('#btnBuscaid_almoxarifado').click(function () {
            $('#modal_id_almoxarifado').modal('show');
        });

        var itens = {
            data:
<?php print json_encode($dadosAlmoxarifado); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_almoxarifado").getSelectedItemData().id_almoxarifado;
                    var nome = $("#searcid_almoxarifado").getSelectedItemData().nome;

                    $("#nome_almoxarifado_fk").val(nome); // Mudar
                    $("#id_almoxarifado").val(id);
                },
                onClickEvent: function () {
                    $("#modal_id_almoxarifado").modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_almoxarifado").easyAutocomplete(itens);

        /*###########################  final aju_almoxarifado #####################*/

    });
</script>
