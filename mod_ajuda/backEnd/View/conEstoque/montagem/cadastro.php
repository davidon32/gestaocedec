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

$aju_pedido = new PedidoConEstoqueModel();
$dados_pedido = $aju_pedido->listaid_pedidoAutocomplete();

$aju_transportadora = new MontagemConEstoqueModel();
$dadosTransportadora = $aju_transportadora->listaid_transportadoraAutocomplete();


?>

<legend>Cadastro de Montagem</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "montagem", "gravar");?>" method="post" accept-charset="utf-8" name="frmMontagem" id="frmMontagem">
    
    <div class='col-md-6'>
<label>Data Montagem Carga</label>
<input type="text" class='form form-control' name='data_montagem' id='data_montagem' required data-mask="99/99/9999" maxlength='11' value="<?=date('d/m/Y')?>">
</div>
<div class='col-md-6'>
<label>Nome Motorista</label>
<input type="text" class='form form-control' name='motorista' id='motorista' maxlength='69' required >
</div>
<div class='col-md-6'>
<label>Placa do veículo</label>
<input type="text" class='form form-control' name='placa' id='placa' maxlength='9' required data-mask="SSS-9999">
</div>
<div class='col-md-6'>
    <label>Transportadora</label>
    <div class="input-group">
        <input type="text" class='form form-control' name='nomeTransportadora_fk' id='nomeTransportadora_fk' required readonly='readonly'>
        <span onclick="" class="input-group-addon" id="btnBuscaid_transportadora">
           <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </span>
    </div>
    <input type="hidden" name='id_transportadora' id='id_transportadora'>
</div>
<div class='col-md-6'>
    <br>
    <input type="button" name='btnBuscaid_pedido' id='btnBuscaid_pedido' class="btn btn-adn" value="Adicionar Pedido">
</div>
<div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "montagem", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    </div>
</form>

<table class="table table-bordered" name="tbl_itens" id="tbl_itens">
    <thead>
        <tr>
            <th>Nr. Pedido</th>
            <th>Destinatario</th>
            <th>Data Emissao</th>
            <th>Volume</th>
            <th>Valor Total</th>           
        </tr>
    </thead>
    <tbody>
        
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3"></th>
            <th>Total Carga</th>
            <th><span id="total_carga">R$0,00</span></th>
        </tr>
    </tfoot>
</table>
   
<!--######################  MODAL aju_pedido ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_pedido">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Pedido</h4>
            </div>
            <div class="modal-body">
                <div class='col-md-12'>
                <label>Nr Pedido</label>
                    <input type="text" class='form form-control' name='searcid_pedido' id='searcid_pedido' required >
                    <input type="hidden" name='id_pedido' id='id_pedido'>
                    <input type="hidden" name='nomeDestinatario_fk' id='nomeDestinatario_fk'>
                    <input type="hidden" name='data_emissao' id='data_emissao'>
                    <input type="hidden" name='volume' id='volume'>
                    <input type="hidden" name='total_pedido' id='total_pedido'>
                    <br>
                </div>

                <div class='col-md-12'>
                    <span id="span_id_pedido"></span>
                    <span id="span_destinatario"></span>
                    <span id="span_data_emissao"></span>
                    <span id="span_volume"></span>
                    <span id="span_valor_pedido"></span>
                </div>
                
        </div>
        <div class="modal-footer">
            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
            <div class="col-md-6 text-left">
                <br>
                <button type="button" class="btn btn-success text-left" name="btnAddPedido" id="btnAddPedido" >Adicionar</button>
            </div>
            <div class="col-md-6 text-right">
                <br>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL aju_pedido ####################-->
    
    <!--######################  MODAL aju_transportadora ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_transportadora">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_transportadora</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_transportadora" id="searcid_transportadora">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "transportadora", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_transportadora ####################-->

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
        $("#frmMontagem").trigger("reset");
        
        $("#tbl_itens").hide();

        var valor_pedido = 0.0;
        var total_carga = 0;
        
        var itensPedido = [];
                       
        /*##################  ADICIONAR ITEM TABELA ###############*/
        $("#btnAddPedido").click(function(){
            
            $("#tbl_itens").show();
            
            if( ($("#id_pedido").val() != "")
            ){
                                 
            var item = {'id_pedido'    : $("#id_pedido").val(),
                        'destinatario' : $("#nomeDestinatario_fk").val(),
                        'data_emissao' : dataVisual($("#data_emissao").val()),
                        'volume'       : $("#volume").val(),
                        'total_pedido' : $("#total_pedido").val(),
                    };
                             
            itensPedido.push(item);
                             
            var linha = "<tr><td>"+item['id_pedido']+"</td>";
                linha += "<td>"+item['destinatario']+"</td>";
                linha += "<td>"+item['data_emissao']+"</td>";
                linha += "<td>"+item['volume']+"</td>";
                linha += "<td>"+item['total_pedido']+"</td></tr>";
            
            valor_pedido = parseFloat($("#total_pedido").val());
            total_carga += valor_pedido;
            
            $("#total_pedido").text(valor_pedido.toLocaleString('pt-BR', 
                                                            { minimumFractionDigits: 2 ,
                                                              style: 'currency',
                                                              currency: 'BRL' })
                                                            );
            $("#total_carga").text(total_carga.toLocaleString('pt-BR', 
                                                            { minimumFractionDigits: 2 ,
                                                              style: 'currency',
                                                              currency: 'BRL' })
                                                            );
                             
                             
            $("#tbl_itens").append(linha);
            alert("Pedido Adicionado com Sucesso !");
            
            /* limpa dos comproles */
            $("#id_pedido").val("");
            $("#searcid_pedido").val("");

            /* limpa campo span */
            $("#span_id_pedido").text("");
            $("#span_destinatario").text("");
            $("#span_volume").text("");
            $("#span_data_emissao").text("");
            $("#span_valor_pedido").text("");
            $("#modal_id_pedido").modal('hide');
            
            
            

        }else {
            
            alert("Preencha o campo Obgrigatorio !");
                                 
        }
            
        });
        
    /* ###################  fk_aju_pedido ####################*/
        $('#btnBuscaid_pedido').click(function () {
            $('#modal_id_pedido').modal('show');
        });

        var itens = {
            data:
            <?php print json_encode($dados_pedido); ?>, // array com os dados
            getValue: "id_pedido", /* alterar com nome do item BD */
            template: {
                type: "description",
                fields:{
                    description: "nome"
                }
            },
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id_pedido    = $("#searcid_pedido").getSelectedItemData().id_pedido;
                    var nome         = $("#searcid_pedido").getSelectedItemData().nome;
                    var data_emissao = $("#searcid_pedido").getSelectedItemData().data_emissao;
                    var volume       = $("#searcid_pedido").getSelectedItemData().volume;
                    var total_pedido = $("#searcid_pedido").getSelectedItemData().total_pedido;
                    
                        $("#id_pedido").val(id_pedido);
                        $("#nomeDestinatario_fk").val(nome);
                        $("#data_emissao").val(data_emissao);
                        $("#volume").val(volume);
                        $("#total_pedido").val(total_pedido);
                     
                       $("#span_id_pedido").text(id_pedido+" | ");
                       $("#span_destinatario").text(nome+" | ");
                       $("#span_volume").text(volume+" | ");
                       $("#span_data_emissao").text(data_emissao+" | ");
                      
                       $("#span_valor_pedido").text("R$ " +total_pedido);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_pedido").easyAutocomplete(itens);
                                
    /*###########################  final aju_pedido #####################*/
     
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
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_transportadora").easyAutocomplete(itens);
                                
    /*###########################  final aju_transportadora #####################*/
    
    
     /*###################  ENVIO POST GRAVAR ################*/
        
        $("#frmMontagem").submit(function(e) {
		e.preventDefault();
	}).validate({
		rules: {
                    
                    data_montagem:{ required: true},
                    id_pedido:{ required: true},     
                    id_transportadora:{ required: true},
			},
			messages: {
                            
                            data_montagem: { required: 'A Data da Montagem não pode Fica em branco !'},
                            id_pedido: { required: 'O campo Numero do pedido não pode ficar em Branco !'},
                            id_transportadora: { required: 'A Transportadora não pode ficar em Branco !'},
			},
			
		submitHandler: function(form) { 

			var form_data = new FormData();
                        
                        var jsonItens = JSON.stringify(itensPedido);

                         /* upload de arquivos */
			//var file_data = $("#fl_nota").prop("files")[0];
                        
                            form_data.append("id_pedido",         $("#id_pedido").val());
                            form_data.append("id_transportadora", $("#id_transportadora").val());
                            form_data.append("motorista",         $("#motorista").val());
                            form_data.append("placa",             $("#placa").val());
                            form_data.append("data_montagem",     $("#data_montagem").val());
                            form_data.append("itens",             jsonItens);
	
			$.ajax({
				type: 'POST',
				url: '<?=FuncaoBase::geraLink('ajuda', 'montagem', 'gravar')?>',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				success: function(response) {
                                        var resposta = response;
					if(resposta.trim() === 'sucesso'){
					alert("Cadastro realizado com Sucesso !");
					location.reload();
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
        

    });
</script>
        