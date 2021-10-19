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
$pedidoModel = new PedidoConEstoqueModel();

$dadosTp_pedido = $pedidoModel->listaid_tp_pedidoAutocomplete();

$dadosAlmoxarifado = $pedidoModel->listaid_almoxarifadoAutocomplete();

$dadosTransportadora = $pedidoModel->listaid_transportadoraAutocomplete();

$dadosDestinatario = $pedidoModel->listaid_destinatarioAutocomplete();

$dadosDestinatario_final = $pedidoModel->listaid_destinatario_finalAutocomplete();

?>

<legend>Cadastro de Pedido</legend>
<form method="post" accept-charset="utf-8" name="frmPedido" id="frmPedido">

    <div class='col-md-6'>
        <label>Almoxarifado</label> <!--almoxarifado-->
        <div class="input-group">
            <input type="text" class='form form-control' name='nomeTp_pedido_fk' id='nomeTp_pedido_fk' required readonly='readonly'>
            <span onclick="" class="input-group-addon" id="btnBuscaid_tp_pedido">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_tp_pedido' id='id_tp_pedido' required readonly='readonly'>
    </div>
    <div class='col-md-6'>
        <label>Transportadora</label>
        <div class="input-group">
            <input type="text" class='form form-control' name='nomeTransportadora_fk' id='nomeTransportadora_fk' required readonly='readonly'>
            <span onclick="" class="input-group-addon" id="btnBuscaid_transportadora">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_transportadora' id='id_transportadora' required readonly='readonly'>
    </div>
    <div class='col-md-6'>
        <label>Armazém</label> <!--almoxarifado-->
        <div class="input-group">
            <input type="text" class='form form-control' name='nomeAlmoxarifado_fk' id='nomeAlmoxarifado_fk' required readonly='readonly'>
            <span onclick="" class="input-group-addon" id="btnBuscaid_almoxarifado">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_almoxarifado' id='id_almoxarifado' required readonly='readonly'>
    </div>
    <div class='col-md-6'>
        <label>Data Emissão Pedido</label>
        <input type="text" class='form form-control' name='data_emissao' id='data_emissao'required value="<?= date('d/m/Y') ?>">
    </div>
    <!--<div class='col-md-6'>
        <label>Data Entrega Pedido</label>
        <input type="text" class='form form-control' name='data_entrega' id='data_entrega' >
    </div>-->


    <div class='col-md-6'>
        <label>Destinatário</label>
        <div class="input-group">
            <input type="text" class='form form-control' name='nomeDestinatario_fk' id='nomeDestinatario_fk' required readonly='readonly'>
            <span onclick="" class="input-group-addon" id="btnBuscaid_destinatario">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_destinatario' id='id_destinatario' required readonly='readonly'>
    </div>
    <div class='col-md-6'>
        <label>Destinatário Final</label>
        <div class="input-group">
            <input type="text" class='form form-control' name='nomeDestinatario_final_fk' id='nomeDestinatario_final_fk' readonly='readonly'>
            <span onclick="" class="input-group-addon" id="btnBuscaid_destinatario_final">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_destinatario_final' id='id_destinatario_final'>
    </div>
    <div class='col-md-6'>
        <label>Nome Destinatario Final (Opcional)</label>
        <input type="text" class='form form-control' name='nome_destinatario_final' id='nome_destinatario_final' maxlength='69' >
    </div>
    <div class='col-md-6'>
        <label>Observação</label>
        <textarea class='form form-control' name='obs' id='obs' maxlength='254' ></textarea>
    </div>
    <!-- add Produto -->
    <div class='col-md-6'>
        <label>Itens Pedido</label>
        <br>
        <button type="button" class="btn btn-primary" name="btnBuscaid_itens_pedido" id="btnBuscaid_itens_pedido">Adicionar Produto</button> 
        <button type="button" class="btn disable-button" id="btnDisable" title="Favor preencher as informações primeiro">Adicionar Produto</button>
    </div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "pedido", "index") ?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    </div>

</form>

<table class="table table-bordered" name="tbl_itens" id="tbl_itens">
    <thead>
        <tr>
            <th>Código</th>
            <th>Produto</th>
            <th>Nr.Nota</th>
            <th>Validade</th>
            <th>Quantidade</th>
            <th>Valor Unit.</th>
            <th>Total</th>

        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
        <tr>
            <th colspan="5"></th>
            <th>Total Nota</th>
            <th><span id="total_nota">R$0,00</span></th>
        </tr>
    </tfoot>
</table>

<!--######################  MODAL aju_itens_pedido ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_itens_pedido">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Materiais Pedido</h4>
            </div>
            <div class="modal-body">
                <div class='col-md-12'>
                    <label>Nome Produto</label>
                    <input type="text" class='form form-control' name='nomeUnidade_fk' id='nomeUnidade_fk' required >
                </div><input type="hidden" name='id_unidade' id='id_unidade'>


                <div class='col-md-3'>
                    <label>Nr. Nota:</label>
                    <input type="number" class='form form-control' name='id_nota' id='id_nota' readonly="readonly" >
                </div>

                <div class='col-md-3'>
                    <label>Quantidade Itens</label>
                    <input type="number" class='form form-control' name='qtd' id='qtd' required >
                </div>
                <div class='col-md-3'>
                    <label>Valor Unidade</label>
                    <input type="text" class='form form-control' name='val_unid' id='val_unid' readonly="readonly" >
                </div>
                <div class='col-md-3'>
                    <label>Em estoque:</label>
                    <input type="text" class='form form-control' name='em_estoque' id='em_estoque'  readonly="readonly" >
                </div>
                <div class='col-md-6'>
                    <label>Valor Total</label>
                    <input type="text" class='form form-control' name='val_total' id='val_total'  readonly="readonly" >
                </div>
                <div class='col-md-6'>
                    <label>Data Validade</label>
                    <input type="text" class='form form-control' name='dat_validade' id='dat_validade' readonly="readonly" >
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <div class="col-md-6 text-left">
                    <br>
                    <button type="button" class="btn btn-success text-left" name="btnAddItem" id="btnAddItem" >Adicionar</button>
                </div>
                <div class="col-md-6 text-right">
                    <br>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL aju_itens_pedido ####################-->


<!--######################  MODAL aju_tp_pedido ( ALMOXARIFADO )###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_tp_pedido">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Almoxarifado</h4>
            </div>
            <div class="modal-body">
                <label>Pesquisa</label>
                <input type="text" class="form form-control" name="searcid_tp_pedido" id="searcid_tp_pedido">
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-success" data-dismiss="modal" id='cad_almoxarifado'>Cadastrar Novo</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- CADASTRO )-->

<div class="modal" tabindex="-1" role="dialog" id="modal_cad_almoxarifado">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Novo Almoxarifado</h4>
            </div>
            <div class="modal-body">
                <label>Nome</label>
                <input type="text" class="form form-control" name="txtNomeAlmoxarifado" id="txtNomeAlmoxarifado">
            </div>
            <div class="modal-footer">
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL aju_tp_pedido ( ALMOXARIFADO ) ####################-->



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


<!--######################  MODAL aju_transportadora ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_transportadora">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Transportadora</h4>
            </div>
            <div class="modal-body">
                <label>Pesquisa</label>
                <input type="text" class="form form-control" name="searcid_transportadora" id="searcid_transportadora">
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <div class="col-md-6 text-left">
                    <a href="<?= FuncaoBase::geraLink("ajuda", "transportadora", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL aju_transportadora ####################--><!--######################  MODAL aju_destinatario ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_destinatario">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro aju_destinatario</h4>
            </div>
            <div class="modal-body">
                <label>Pesquisa</label>
                <input type="text" class="form form-control" name="searcid_destinatario" id="searcid_destinatario">
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <div class="col-md-6 text-left">
                    <a href="<?= FuncaoBase::geraLink("ajuda", "destinatario", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL aju_destinatario ####################--><!--######################  MODAL aju_destinatario_final ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_destinatario_final">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro aju_destinatario_final</h4>
            </div>
            <div class="modal-body">
                <label>Pesquisa</label>
                <input type="text" class="form form-control" name="searcid_destinatario_final" id="searcid_destinatario_final">
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <div class="col-md-6 text-left">
                    <a href="<?= FuncaoBase::geraLink("ajuda", "destinatario_final", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL aju_destinatario_final ####################-->

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

        $("#btnBuscaid_itens_pedido").hide();
        $("#btnDisable").show();


        /* ##############################################
         *  clic form campo FK Almoxarifado*/
        $("#nomeTp_pedido_fk").click(function () {
            $("#modal_id_tp_pedido").modal('show');
        });
        /* focus no campo pesquisa Almoxarifado */
        $('#modal_id_tp_pedido').on('shown.bs.modal', function (e) {
            $("#searcid_tp_pedido").focus();
        });
        
        /* form cadastro almoxarifado */
        $("#cad_almoxarifado").click(function () {
            $("#modal_cad_almoxarifado").modal('show');
        });
        /*###############################################*/


        /*###############################################*/
        /* clic form campo FK Transportadora*/
        $("#nomeTransportadora_fk").click(function () {
            $("#modal_id_transportadora").modal('show');
        });
        /* focus no campo pesquisa Transportadora */
        $('#modal_id_transportadora').on('shown.bs.modal', function (e) {
            $("#searcid_transportadora").focus();
        });
        /*###############################################*/

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

        
        /*###############################################*/
        /* clic form campo FK Destinataro */
        $("#nomeDestinatario_fk").click(function () {
            $("#modal_id_destinatario").modal('show');
        });
        /* focus no campo pesquisa  Destinatario */
        $('#modal_id_destinatario').on('shown.bs.modal', function (e) {
            $("#searcid_destinatario").focus();
        });
        /*###############################################*/
        

        /*###############################################*/
        /* clic form campo FK Destinataro Final */
        $("#nomeDestinatario_final_fk").click(function () {
            $("#modal_id_destinatario_final").modal('show');
        });
        /* focus no campo pesquisa  Destinatario Final */
        $('#modal_id_destinatario_final').on('shown.bs.modal', function (e) {
            $("#searcid_destinatario_final").focus();
        });
        /*###############################################*/

        $("#frmPedido").trigger("reset");

        $("#tbl_itens").hide();

        var itensPedido = [];

        var total_nota = 0.0;
        var total = 0.0;
        var qtd = 0;
        var val_unit = 0.0;

        var data_validade = $("#dat_validade").val();


        $("#qtd").blur(function () {

            qtd = parseInt($("#qtd").val());
            val_unit = parseFloat($("#val_unid").val().substring(3).replace(",", "."));

            if (qtd > 0) {
                total = val_unit * qtd;
                /*formata moeda*/
                $("#val_total").val(total./*formata moeda*/toLocaleString('pt-BR',
                        {minimumFractionDigits: 2,
                            style: 'currency',
                            currency: 'BRL'})
                        );
            }

        });


        /*##################  ADICIONAR ITEM TABELA ###############*/
        $("#btnAddItem").click(function () {

            var saldo = $("#em_estoque").val();
            var qtd = $("#qtd").val();
            if (parseInt(qtd) <= parseInt(saldo)) {

                $("#tbl_itens").show();

                if (($("#id_unidade").val() != "") &&
                        ($("#nomeUnidade_fk").val() != "") &&
                        ($("#qtd").val() != "") &&
                        ($("#val_unid").val() != "") &&
                        ($("#val_total").val() != "")
                        ) {

                    var item = {'id_unidade': $("#id_unidade").val(),
                        'nome': $("#nomeUnidade_fk").val(),
                        'qtd': $("#qtd").val(),
                        'val_unid': $("#val_unid").val(),
                        'val_total': $("#val_total").val(),
                        'data_validade': $("#dat_validade").val(),
                        'id_nota': $("#id_nota").val(),
                    };
                   
                    
                var linha = "<tr><td>" + item['id_unidade'] + "</td>";
                    linha += "<td>" + item['nome'] + "</td>";
                    linha += "<td>" + item['id_nota'] + "</td>";
                    linha += "<td>" + item['data_validade'] + "</td>";
                    linha += "<td>" + item['qtd'] + "</td>";
                    linha += "<td>" + item['val_unid'] + "</td>";
                    linha += "<td>" + item['val_total'] + "</td></tr>";

                    itensPedido.push(item);



                    total_nota += total;

                    $("#total_nota").text(total_nota.toLocaleString('pt-BR',
                            {minimumFractionDigits: 2,
                                style: 'currency',
                                currency: 'BRL'})
                            );


                    $("#tbl_itens").append(linha);
                    alert("Material Adicionar com Sucesso !");

                    /* limpa dos comproles */
                    $("#id_unidade").val("");
                    $("#nomeUnidade_fk").val("");
                    $("#qtd").val("");
                    $("#val_unid").val("");
                    $("#val_total").val("");
                    $("#dat_validade").val("");
                    $("#id_nota").val("");

                } else {

                    alert("Preencha o campo Obgrigatorio !");

                }
            } else {
                alert("Produto sem Estoque !");
            }

        });

        /*###################  ENVIO POST GRAVAR ################*/

        $("#frmPedido").submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {

                nomeTp_pedido_fk: {required: true},
                id_tp_pedido: {required: true},
                nomeTransportadora_fk: {required: true},
                id_transportadora: {required: true},
                nomeAlmoxarifado_fk: {required: true},
                id_almoxarifado: {required: true},
                data_emissao: {required: true},
                nomeDestinatario_fk: {required: true},
                id_destinatario: {required: true},
            },
            messages: {

                nomeTp_pedido_fk: {required: 'O campo Quantidade não pode ficar em Branco !'},
                id_tp_pedido: {required: 'O campo Quantidade não pode ficar em Branco !'},
                nomeTransportadora_fk: {required: 'O campo Quantidade não pode ficar em Branco !'},
                id_transportadora: {required: 'O campo Quantidade não pode ficar em Branco !'},
                nomeAlmoxarifado_fk: {required: 'O campo Quantidade não pode ficar em Branco !'},
                id_almoxarifado: {required: 'O campo Quantidade não pode ficar em Branco !'},
                data_emissao: {required: 'O campo Quantidade não pode ficar em Branco !'},
                nomeDestinatario_fk: {required: 'O campo Quantidade não pode ficar em Branco !'},
                id_destinatario: {required: 'O campo Quantidade não pode ficar em Branco !'},

            },

            submitHandler: function (form) {

                var form_data = new FormData();

                var jsonItens = JSON.stringify(itensPedido);

                /* upload de arquivos */
                //var file_data = $("#fl_nota").prop("files")[0];
                
                if(itensPedido.length > 0){


                    form_data.append("id_tp_pedido", $("#id_tp_pedido").val());
                    form_data.append("id_transportadora", $("#id_transportadora").val());
                    form_data.append("id_almoxarifado", $("#id_almoxarifado").val());
                    form_data.append("data_emissao", $("#data_emissao").val());
                    form_data.append("data_entrega", $("#data_entrega").val());
                    form_data.append("id_destinatario", $("#id_destinatario").val());
                    form_data.append("id_destinatario_final", $("#id_destinatario_final").val());
                    form_data.append("nome_destinatario_final", $("#nome_destinatario_final").val());
                    form_data.append("obs", $("#obs").val());
                    form_data.append("itens", jsonItens);
                    console.log(jsonItens);



                    $.ajax({
                        type: 'POST',
                        url: '<?= FuncaoBase::geraLink('ajuda', 'pedido', 'gravar') ?>',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function (response) {
                            var resposta = response;
                            if (resposta.trim() === 'sucesso') {
                                alert("Cadastro realizado com Sucesso !");
                                location.reload();
                            } else {
                                alert();
                            }
                        },
                        error: function (e) {
                            console.log(JSON.stringify(form_data));
                            console.log(JSON.stringify(response));
                            alert("Ocorreu um Erro !");
                        }

                    });

                }else {
                    alert('Pedido não tem nenhum material, favor verificar !');
                }
            }
        });

        /* ###################  fk_aju_tp_pedido ( almoxarifado) ####################*/
        $('#btnBuscaid_tp_pedido').click(function () {
            $('#modal_id_tp_pedido').modal('show');
        });

        var itens = {
            data:
<?php print json_encode($dadosTp_pedido); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_tp_pedido").getSelectedItemData().id_tp_pedido;
                    var nome = $("#searcid_tp_pedido").getSelectedItemData().nome;

                    $("#nomeTp_pedido_fk").val(nome); // Mudar
                    $("#id_tp_pedido").val(id);
                },
                onClickEvent: function () {
                    $("#modal_id_tp_pedido").modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_tp_pedido").easyAutocomplete(itens);

        /*###########################  final aju_tp_pedido #####################*/

        /* ###################  fk_aju_itens_pedido ####################*/

        $('#btnBuscaid_itens_pedido,#btnDisable').hover(function () {
            if (
                    ($('#nomeTp_pedido_fk').val() === "") ||
                    ($('#id_tp_pedido').val() === "") ||
                    ($('#nomeTransportadora_fk').val() === "") ||
                    ($('#id_transportadora').val() === "") ||
                    ($('#nomeAlmoxarifado_fk').val() === "") ||
                    ($('#id_almoxarifado').val() === "") ||
                    ($('#data_emissao').val() === "") ||
                    ($('#nomeDestinatario_fk').val() === "") ||
                    ($('#id_destinatario').val() === "")

                    ) {
                $("#btnBuscaid_itens_pedido").hide();
                $("#btnDisable").show();
                alert('Favor preencher os campos primeiro');
            } else {
                $("#btnBuscaid_itens_pedido").show();
                $("#btnDisable").hide();
            }
        });
        
        

        $('#btnBuscaid_itens_pedido').click(function () {
            $('#modal_id_itens_pedido').modal('show');

        });

        var val_unid = 0.0;
        var itens = {
            url: function (almoxarifado) {
                return 'index.php?modulo=ajuda&controller=pedido&action=listitens&format=json';
            },
            getValue: function (element) {
                return element.nome;
            },
            ajaxSettings: {
                dataType: "json",
                method: "POST",
                data: {
                    dataType: "json"
                }
            },

            preparePostData: function (data) {
                data.id_tp_pedido = $("#id_tp_pedido").val();
                data.tp_pedido = $("#nomeTp_pedido_fk").val();
                data.nomeUnidade_fk = $("#nomeUnidade_fk").val();
                return data;
            },
            

            /*data:
            /*<?php #print json_encode($dadosItens_pedido); ?>, // array com os dados 
                getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },
                onSelectItemEvent: function () {
                    var id = $("#nomeUnidade_fk").getSelectedItemData().id_unidade;
                    val_unid = parseFloat($("#nomeUnidade_fk").getSelectedItemData().val_unit);
                    var data_validade = $("#nomeUnidade_fk").getSelectedItemData().data_validade;
                    var saldo = $("#nomeUnidade_fk").getSelectedItemData().qtd;
                    var id_nota = $("#nomeUnidade_fk").getSelectedItemData().id_nota;

                    $("#id_unidade").val(id);
                    $("#val_unid").val(val_unid);
                    $("#dat_validade").val(data_validade);
                    $("#em_estoque").val(saldo);
                    $("#id_nota").val(id_nota);
                    $("#val_unid").val(val_unid.toLocaleString('pt-BR',
                            {minimumFractionDigits: 2,
                                style: 'currency',
                                currency: 'BRL'})
                            );
                },
                onClickEvent: function () {

                    if ($("#dat_validade").val() !== "") {
                        var data = $("#dat_validade").val();
                        $("#dat_validade").val(dataVisual(data));
                    }
                }
            },
            template: {
                type: "custom",
                method: function (value, item) {
                        return "Nr.Nota: " + item.id_nota + " -" + value + "- " + item.descricao + " | " + item.unid_med_nome + " | Vr: R$ " + item.val_unit + " | saldo : " + item.qtd + " Armaz." + item.armazem + " Almox :" + item.almoxarifado;
                }
            },
            requestDelay: 400
        };
        
        /*********** autocomplete ***********/
        $("#nomeUnidade_fk").easyAutocomplete(itens);

        /*###########################  final aju_itens_pedido #####################*/

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

                    $("#nomeAlmoxarifado_fk").val(nome); // Mudar
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

        /* ###################  fk_aju_transportadora ####################*/
        $('#btnBuscaid_transportadora').click(function () {
            $('#modal_id_transportadora').modal('show');
        });

        var itens = {
            data:
<?php print json_encode($dadosTransportadora); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_transportadora").getSelectedItemData().id_transportadora;
                    var nome = $("#searcid_transportadora").getSelectedItemData().nome;

                    $("#nomeTransportadora_fk").val(nome); // Mudar
                    $("#id_transportadora").val(id);
                },
                onClickEvent: function () {
                    $("#modal_id_transportadora").modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_transportadora").easyAutocomplete(itens);

        /*###########################  final aju_transportadora #####################*/

        /* ###################  fk_aju_destinatario ####################*/
        $('#btnBuscaid_destinatario').click(function () {
            $('#modal_id_destinatario').modal('show');
        });

        var itens = {
            data:
<?php print json_encode($dadosDestinatario); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_destinatario").getSelectedItemData().id_destinatario;
                    var nome = $("#searcid_destinatario").getSelectedItemData().nome;

                    $("#nomeDestinatario_fk").val(nome); // Mudar
                    $("#id_destinatario").val(id);
                },
                onClickEvent: function () {
                    $("#modal_id_destinatario").modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_destinatario").easyAutocomplete(itens);

        /*###########################  final aju_destinatario #####################*/

        /* ###################  fk_aju_destinatario_final ####################*/
        $('#btnBuscaid_destinatario_final').click(function () {
            $('#modal_id_destinatario_final').modal('show');
        });

        var itens = {
            data:
<?php print json_encode($dadosDestinatario_final); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_destinatario_final").getSelectedItemData().id_destinatario_final;
                    var nome = $("#searcid_destinatario_final").getSelectedItemData().nome;

                    $("#nomeDestinatario_final_fk").val(nome); // Mudar
                    $("#id_destinatario_final").val(id);
                },
                onClickEvent: function () {
                    $("#modal_id_destinatario_final").modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_destinatario_final").easyAutocomplete(itens);

        /*###########################  final aju_destinatario_final #####################*/


    });
</script>
