<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php
$aju_fornecedor = new Entrada_notaConEstoqueModel();
$dadosFornecedor = $aju_fornecedor->listaid_fornecedorAutocomplete();

$aju_tp_pedido = new Entrada_notaConEstoqueModel();
$dadostpPedido = $aju_tp_pedido->listaid_tp_pedidoAutocomplete();

//$aju_itens_nota = new Entrada_notaConEstoqueModel();
//$dadosItens_nota = $aju_itens_nota->listaid_itens_notaAutocomplete();

$aju_itens_nota = new UnidadeConEstoqueModel();
$dadosItens_nota = $aju_itens_nota->listaUnidadeNomeAutocomplete();

//var_dump($dadosItens_nota);

# armazem 
$aju_almoxarifado = new Entrada_notaConEstoqueModel();
$dadosAlmoxarifado = $aju_almoxarifado->listaid_almoxarifadoAutocomplete();
?>

<legend>Entrada de nota</legend>
<form action="" method="post" accept-charset="utf-8" name="frmEntrada_nota" id="frmEntrada_nota">

    <div class='col-md-6'>
        <label>Fornecedor :</label>
        <div class="input-group">
            <input type="text" class='form form-control' name='nomeFornecedor_fk' id='nomeFornecedor_fk' required readonly='readonly'>
            <span onclick="" class="input-group-addon" id="btnBuscaid_fornecedor">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_fornecedor' id='id_fornecedor'>
    </div>
    
    <div class='col-md-6'>
        <label>Armazém :</label> <!--tbl almoxarifado-->
        <div class="input-group">
            <input type="text" class='form form-control' name='nomeAlmoxarifado_fk' id='nomeAlmoxarifado_fk' required readonly='readonly'>
            <span onclick="" class="input-group-addon" id="btnBuscaid_almoxarifado">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_almoxarifado' id='id_almoxarifado'>
    </div>
    <div class='col-md-6'>
        <label>Almoxarifado</label>
        <div class="input-group">
            <input type="text" class='form form-control' name='nomeTp_pedido_fk' id='nomeTp_pedido_fk' required readonly='readonly'>
            <span onclick="" class="input-group-addon" id="btnBuscaid_tp_pedido">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_tp_pedido' id='id_tp_pedido' >
    </div>
    <div class='col-md-6'>
        <label>Data Emissao: </label>
        <input type="text" class='form form-control' name='data_emissao' id='data_emissao' required >
    </div>
    <div class='col-md-6'>
        <label>Data Entrega :</label>
        <input type="text" class='form form-control' name='data_entrega' id='data_entrega'  required >
    </div>
    <div class='col-md-6'>
            <label>Atendimento Ordinário ? :</label>
            <br>
            <div class="col-md-6">
                <label class="radio-inline">
                    <input type="radio" name="rb_atendimento" id="rb_sim" value="7" checked="checked">
                    Sim
                </label>
                <label class="radio-inline">
                    <input type="radio" name="rb_atendimento" id="rb_nao" value="0">
                    Não
                </label>
            </div>
            <div class="col-md-6">
                   <span class="" id="basic-addon1">Nome</span>
                    <select  class=" form form-control col-md-6" name="selEvento" id="sel_evento">
                        <option></option>
                       <?php
                        $evento = new EventoConEstoqueModel();
                        $option = $evento->listaEvento();
                        foreach ($option as $key => $value) {
                            print "<option value='".$value['id_evento']."'>".$value['nome']."</option>\n";
                        }
                       ?>
                    </select>
            </div>  
    </div>
    <div class="col-md-6">
                   <label class="">Obs:</label>
                   <textarea name="obs" id="obs" class="form form-control"></textarea>
            </div>
    
    <!-- add Produto -->
    <div class='col-md-6'>
        <label>Itens Nota :</label>
        <br>
        <button type="button" class="btn btn-primary" name="btnBuscaid_itens_nota" id="btnBuscaid_itens_nota">Adicionar Produto</button> 
    </div>
    

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "entrada_nota", "index") ?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar"><br><br>
    </div>
    
</form>


<table class="table table-bordered" name="tbl_itens" id="tbl_itens">
    <thead>
        <tr>
            <th>Código</th>
            <th>Produto</th>
            <th>Descricao</th>
            <th>Armazém</th>
            <th>Almoxarifado</th>
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
            <th colspan="7"></th>
            <th>Total Nota</th>
            <th><span id="total_nota">R$0,00</span></th>
        </tr>
    </tfoot>
</table>



<!--######################  MODAL aju_fornecedor ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_fornecedor">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro aju_fornecedor</h4>
            </div>
            <div class="modal-body">
                <label>Pesquisa</label>
                <input type="text" class="form form-control" name="searcid_fornecedor" id="searcid_fornecedor">
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <div class="col-md-6 text-left">
                    <a href="<?= FuncaoBase::geraLink("ajuda", "fornecedor", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL aju_fornecedor ####################-->

<!--######################  MODAL aju_tp_pedido ( ALMOXARIFADO ) ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_tp_pedido">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro Almoxarifado</h4>
            </div>
            <div class="modal-body">
                <label>Pesquisa</label>
                <input type="text" class="form form-control" name="searcid_tp_pedido" id="searcid_tp_pedido">
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <div class="col-md-6 text-left">
                    <a href="<?= FuncaoBase::geraLink("ajuda", "tp_pedido", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL aju_tp_pedido (ALMOXARIFADO) ####################-->

<!--######################  MODAL aju_itens_nota ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_itens_nota">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Materiais Nota</h4>
            </div>
            <div class="modal-body">
                <div class='col-md-12'>
                <label>Nome Produto</label>
                <div class="row">
                    <div class="">
                        <input type="text" class='form form-control col-md-6' name='nomeUnidade_fk' id='nomeUnidade_fk' required >
                    </div>
                    <div class="col-xs-4">
                        <span name='descricao' id='descricao'></span>
                    </div>
                </div>
                    
                </div><input type="hidden" name='id_unidade' id='id_unidade'>
                
            
            <div class='col-md-6'>
                <label>Quantidade Itens</label>
                <input type="text" class='form form-control' name='qtd' id='qtd' required >
            </div>
            <div class='col-md-6'>
                <label>Valor Unidade</label>
                <span class='form form-control' name='val_unid' id='val_unid'></span>
            </div>
            <div class='col-md-6'>
                <label>Valor Total</label>
                <input type="text" class='form form-control' name='val_total' id='val_total'  required >
            </div>
            <div class='col-md-6'>
                <label>Data Validade</label>
                <input type="text" class='form form-control' name='dat_validade' id='dat_validade' required >
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

<!--###################  FIM MODAL aju_itens_nota ####################-->

<!--######################  MODAL aju_almoxarifado ( ARMAZEM ) ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_almoxarifado">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro Armazém</h4>
            </div>
            <div class="modal-body">
                <label>Pesquisa</label>
                <input type="text" class="form form-control" name="searcid_almoxarifado" id="searcid_almoxarifado">
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <div class="col-md-6 text-left">
                    <a href="<?= FuncaoBase::geraLink("ajuda", "almoxarifado", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
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
<script src="js/script.js"></script>
<script>

    $(document).ready(function () {
        
        $("#rb_sim").attr("checked",true);
        $("#sel_evento").hide();
        $("#basic-addon1").hide();
        
        $("#rb_sim").change(function(){
            if($("#rb_sim").is(":checked")) {
                $("#sel_evento").hide();
                $("#basic-addon1").hide();
                $("#sel_evento").val("");
            }
        }); 
        
        $("#rb_nao").change(function(){
            if($("#rb_nao").is(":checked")) {
                $("#sel_evento").show();
                $("#basic-addon1").show();
                $("#sel_evento").val("");
            }
        });


        /* clic form campo FK fornecedor */
        $("#nomeFornecedor_fk").click(function(){
            $("#modal_id_fornecedor").modal({backdrop: 'static', keyboard: false});   
        });
        
        /* focus no campo pesquisa fornecedor */
        $('#modal_id_fornecedor').on('shown.bs.modal', function (e) {
            $("#searcid_fornecedor").focus();
        });
        
        /* clic form campo FK Armazem */
        $("#nomeAlmoxarifado_fk").click(function(){
            $("#modal_id_almoxarifado").modal({backdrop: 'static', keyboard: false});   
        });
        
        /* focus no campo pesquisa Armazem */
        $('#modal_id_almoxarifado').on('shown.bs.modal', function (e) {
            $("#searcid_almoxarifado").focus();
        });
        
        /* clic form campo FK TP_pedido */
        $("#nomeTp_pedido_fk").click(function(){
            $("#modal_id_tp_pedido").modal({backdrop: 'static', keyboard: false});   
        });
        
        /* focus no campo pesquisa Armazem */
        $('#modal_id_almoxarifado').on('shown.bs.modal', function (e) {
            $("#searcid_almoxarifado").focus();
        });
        
        $("#tbl_itens").hide();
        
        var total = 0.0;
        var totalNota = 0.0;
        var qtd = 0;
        var val_unid = 0.0;
        
        var data_validade = $("#dat_validade").val();
        
        var itensNota = [];
        $("#qtd").blur(function(){
            qtd = parseInt($("#qtd").val());
            
            val_unid = parseFloat($("#val_unid").val().substring(3).replace(".","").replace(",", "."));
            if(qtd > 0){
            total = qtd * val_unid;
       
            $("#val_total").val(total.toLocaleString('pt-BR',
                    { minimumFractionDigits: 2 ,
                      style: 'currency',
                      currency: 'BRL' })
                    );
            }

        });
        
        /*##################  ADICIONAR ITEM TABELA ###############*/
        $("#btnAddItem").click(function(){
            
            $("#tbl_itens").show();
            
            // verifica campos em branco
            if( ($("#id_unidade").val() != "") &&
                ($("#nomeUnidade_fk").val() != "") &&
                ($("#qtd").val() != "") &&
                ($("#val_unid").val() != "") &&
                ($("#val_total").val() != "") 
                
            ){
            
            var item = {'id_unidade' : $("#id_unidade").val(),
                            'nome' : $("#nomeUnidade_fk").val(),
                                 'qtd'        : $("#qtd").val(),
                                 'val_unid'   : $("#val_unid").val().replace('R$', "").trim().replace(".", "").replace(",", "."),
                                 'val_total'  : $("#val_total").val().replace('R$', "").trim().replace(".", "").replace(",", "."),
                                 'data_validade': dataForm($("#dat_validade").val()),
                                 'armazem': $("#nomeAlmoxarifado_fk").val(),
                                 'descricao': $("#descricao").text(),
                                 'tp_pedido': $("#nomeTp_pedido_fk").val(),
                                 'data_validade': dataForm($("#dat_validade").val()),
                                 };
                                 
            
            //  lanca primeiro item da tabela sem restrições e addiciona os produtos na tabela
            if(
                ($("#tbl_itens").find("tbody>tr").length == 0)
            ) {
                
                itensNota.push(item);

                var linha = "<tr><td>"+item['id_unidade']+"</td>";
                    linha += "<td>"+item['nome']+"</td>";
                    linha += "<td>"+item['descricao']+"</td>";
                    linha += "<td>"+item['armazem']+"</td>";
                    linha += "<td>"+item['tp_pedido']+"</td>";
                    linha += "<td>"+dataVisual(item['data_validade'])+"</td>";
                    linha += "<td>"+item['qtd']+"</td>";
                    linha += "<td>"+item['val_unid']+"</td>";
                    linha += "<td>"+item['val_total']+"</td></tr>";

                totalNota += total;

                $("#total_nota").text(totalNota.toLocaleString('pt-BR', 
                                                                { minimumFractionDigits: 2 ,
                                                                  style: 'currency',
                                                                  currency: 'BRL' })
                                                                );


                $("#tbl_itens").append(linha);
                alert("Material Adicionar com Sucesso !");

                /* limpa dos comproles */
                $("#id_unidade").val("");
                $("#nomeUnidade_fk").val("");
                $("#qtd").val("");
                $("#val_unid").val("");
                $("#val_total").val("");
                $("#data_validade").val("");
            
            // verifica armazem ou almoxarifados divergentes e addiciona os produtos na tabela
            }else if(
                    ($("#tbl_itens").find("tbody>tr").last().find("td").eq(3).text() == $("#nomeAlmoxarifado_fk").val()) &&
                    ($("#tbl_itens").find("tbody>tr").last().find("td").eq(4).text() == $("#nomeTp_pedido_fk").val())
                
            ){
        
                itensNota.push(item);

                var linha = "<tr><td>"+item['id_unidade']+"</td>";
                    linha += "<td>"+item['nome']+"</td>";
                    linha += "<td>"+item['descricao']+"</td>";
                    linha += "<td>"+item['armazem']+"</td>";
                    linha += "<td>"+item['tp_pedido']+"</td>";
                    linha += "<td>"+dataVisual(item['data_validade'])+"</td>";
                    linha += "<td>"+item['qtd']+"</td>";
                    linha += "<td>"+item['val_unid']+"</td>";
                    linha += "<td>"+item['val_total']+"</td></tr>";

                totalNota += total;

                $("#total_nota").text(totalNota.toLocaleString('pt-BR', 
                                                                { minimumFractionDigits: 2 ,
                                                                  style: 'currency',
                                                                  currency: 'BRL' })
                                                                );

                $("#tbl_itens").append(linha);
                alert("Material Adicionar com Sucesso !");

                /* limpa dos comproles */
                $("#id_unidade").val("");
                $("#nomeUnidade_fk").val("");
                $("#qtd").val("");
                $("#val_unid").val("");
                $("#val_total").val("");
                $("#data_validade").val("");            
            }else {
                alert('Foi encontrado divergencia dos dados do pedido !, Favor conferir-los')
                }

        }else {
            
            alert("Preencha o campo Obgrigatorio !");
                                 
        }
            
        });
        
        /*###################  ENVIO POST GRAVAR ################*/
        
        $("#frmEntrada_nota").submit(function(e) {
		e.preventDefault();
	}).validate({
		rules: {
				id_fornecedor:{ required: true},
                                nomeFornecedor_fk:{ required: true},
				id_almoxarifado:{ required: true},
                                nomeAlmoxarifado_fk:{ required: true},	
				id_natureza:{ required: true},
                                nomeNatureza_fk:{ required: true},
                                data_emissao:{ required: true},
                                data_entrega:{ required: true},

			},
			messages: {
				id_fornecedor: { required: 'O campo Quantidade não pode ficar em Branco !'},
				nomeFornecedor_fk: { required: 'O campo Origem não pode ficar em Branco !'},
				id_almoxarifado: { required: 'O campo Material não pode ficar em Branco !'},
                                nomeAlmoxarifado_fk: { required: 'O campo Material não pode ficar em Branco !'},
                                id_natureza: { required: 'O campo Deposito não pode ficar em Branco !'}	,
                                nomeNatureza_fk: { required: 'O campo Origem não pode ficar em Branco !'},
                                data_emissao:{ required: 'O campo Origem não pode ficar em Branco !'},
                                data_entrega : { required: 'O campo Origem não pode ficar em Branco !'},
                    
			},
			
		submitHandler: function(form) { 

			var form_data = new FormData();
                        
                        var jsonItens = JSON.stringify(itensNota);

                         /* upload de arquivos */
			//var file_data = $("#fl_nota").prop("files")[0];

				//form_data.append("fl_nota",        file_data);
				form_data.append("id_fornecedor", $("#id_fornecedor").val());
				form_data.append("id_almoxarifado",  $("#id_almoxarifado").val());
				form_data.append("id_natureza",$("#id_natureza").val());
				form_data.append("data_emissao",   $("#data_emissao").val());
				form_data.append("data_entrega", $("#data_entrega").val());
				form_data.append("itens",      jsonItens);
				form_data.append("id_tp_pedido", $("#id_tp_pedido").val());
				
				
			$.ajax({
				type: 'POST',
				url: '<?=FuncaoBase::geraLink('ajuda', 'entrada_nota', 'gravar')?>',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				success: function(response) {
                                        var resposta = response;
					if(resposta.trim() === 'sucesso'){
					alert("Cadastro realizado com Sucesso !");
					location.reload();
					}else {
                                            console.log(resposta);
                                        }
				},
				error: function(e){
					console.log(JSON.stringify(form_data));
					console.log(JSON.stringify(response));
					alert("Ocorreu um Erro !");
				}
				
			});

		}
	});
       
       
       /* limpa o form add material */
        $("#frmEntrada_nota").trigger("reset");


        /*#####   ADICIONAR ITEN NA NOTA ########  */




        /* ###################  fk_aju_fornecedor ####################*/
        $('#btnBuscaid_fornecedor').click(function () {
            $('#modal_id_fornecedor').modal({backdrop: 'static', keyboard: false});
        });

        var itens = {
            data:
<?php print json_encode($dadosFornecedor); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_fornecedor").getSelectedItemData().id_fornecedor;
                    var nome = $("#searcid_fornecedor").getSelectedItemData().nome;

                    $("#nomeFornecedor_fk").val(nome); // Mudar
                    $("#id_fornecedor").val(id);
                },
                onClickEvent:function(){
                    $("#modal_id_fornecedor").modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_fornecedor").easyAutocomplete(itens);

        /*###########################  final aju_fornecedor #####################*/

        /* ###################  fk_aju_tp_pedido ( ALMOXARIFADO ) ####################*/
        $('#btnBuscaid_tp_pedido').click(function () {
            $('#modal_id_tp_pedido').modal({backdrop: 'static', keyboard: false});
        });

        var itens = {
            data:
<?php print json_encode($dadostpPedido); ?>, // array com os dados
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
                onClickEvent:function(){
                    $("#modal_id_tp_pedido").modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_tp_pedido").easyAutocomplete(itens);

        /*###########################  final aju_tp_pedido ( ALMOXARIFADO ) #####################*/

        /* ###################  fk_aju_itens_nota ####################*/
        $('#btnBuscaid_itens_nota').click(function () {
            
            if(($("#id_tp_pedido").val() != "") && ($("#id_almoxarifado").val() != "")){
                $('#modal_id_itens_nota').modal({backdrop: 'static', keyboard: false});
            }else {
                alert("Favor preencher corretamente os campos 'ARMAZEM' E 'ALMOXARIFADO' ");
            }
        });

        var val_unid = 0.0;
        var itens = {
            data:
<?php print json_encode($dadosItens_nota); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },
                
                onSelectItemEvent: function () {
                    var id = $("#nomeUnidade_fk").getSelectedItemData().id_unidade;
                    val_unid = parseFloat($("#nomeUnidade_fk").getSelectedItemData().valor);
                    var data_validade = $("#nomeUnidade_fk").getSelectedItemData().data_validade;
                    var descricao = $("#nomeUnidade_fk").getSelectedItemData().descricao;

                    $("#id_unidade").val(id);
                    $("#val_unid").text(val_unid);
                    $("#dat_validade").val(data_validade);
                    
                    $("#nomeUnidade_fk").parent().parent().addClass("col-xs-8");
                    $("#descricao").text(descricao);
                    
                    
                    
                },
                onClickEvent: function(){
                    $("#val_unid").val(val_unid.toLocaleString('pt-BR', 
                                                            { minimumFractionDigits: 2 ,
                                                              style: 'currency',
                                                              currency: 'BRL' })
                                                            );
                    if($("#dat_validade").val() !== ""){
                        var data = $("#dat_validade").val();
                        $("#dat_validade").val(dataVisual(data));
                    }
                }
            },
            template: {
            type: "custom",
                method: function(value, item) {
                            return "Cod : " + item.id_unidade + " | Nome: " + value + " | Descr.: " +item.descricao+ " | Marca : " +item.marca+" | Val: R$ "+item.valor;
                }
        }
        };
        /*********** autocomplete ***********/
        $("#nomeUnidade_fk").easyAutocomplete(itens);

        /*###########################  final aju_itens_nota #####################*/

        /* ###################  fk_aju_almoxarifado ####################*/
        $('#btnBuscaid_almoxarifado').click(function () {
            $('#modal_id_almoxarifado').modal({backdrop: 'static', keyboard: false});
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
                onClickEvent:function(){
                    $("#modal_id_almoxarifado").modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_almoxarifado").easyAutocomplete(itens);

        /*###########################  final aju_almoxarifado #####################*/


    });
</script>
