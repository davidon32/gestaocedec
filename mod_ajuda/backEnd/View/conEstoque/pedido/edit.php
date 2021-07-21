

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

$aju_tp_pedido = new PedidoConEstoqueModel();
  
                    $dadosTp_pedido = $aju_tp_pedido->listaid_tp_pedidoAutocomplete();
$aju_almoxarifado = new PedidoConEstoqueModel();
  
                    $dadosAlmoxarifado = $aju_almoxarifado->listaid_almoxarifadoAutocomplete();
$aju_transportadora = new PedidoConEstoqueModel();
  
                    $dadosTransportadora = $aju_transportadora->listaid_transportadoraAutocomplete();
$aju_destinatario = new PedidoConEstoqueModel();
  
                    $dadosDestinatario = $aju_destinatario->listaid_destinatarioAutocomplete();
$aju_destinatario_final = new PedidoConEstoqueModel();
  
                    $dadosDestinatario_final = $aju_destinatario_final->listaid_destinatario_finalAutocomplete();

    $id_pedido = isset($_GET['id']) ? $_GET['id'] : "";
    
    $iten_pedido = $aju_tp_pedido->lista_produto_pedido($id_pedido);

?>

<legend>Editar Pedido</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "pedido", "edit");?>" method="post" accept-charset="utf-8" name="frmPedido" id="frmPedido">
    
<div class='col-md-6'>
<label>Nº Pedido</label>
<input type="text" class='form form-control' name='id_pedido' id='id_pedido' value='<?=$view[0]['id_pedido']?>'  readonly=readonly >
</div>
<div class='col-md-6'>
<label>Almoxarifado</label><!--tp_pedido -->
<div class="input-group">
<input type="text" class='form form-control' name='nomeTp_pedido_fk' id='nomeTp_pedido_fk' value='<?=$pedidoModel->getNomeIdFk('aju_ctp_pedido','id_tp_pedido', $view[0]['id_tp_pedido'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_tp_pedido">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_tp_pedido' id='id_tp_pedido' required readonly='readonly' value='<?=$view[0]['id_tp_pedido']?>'>
</div>
<div class='col-md-6'>
<label>Data Emissão Pedido</label>
<input type="text" class='form form-control' name='data_emissao' id='data_emissao' value='<?=DataMysql::dataVisual($view[0]['data_emissao'])?>'  maxlength='-1' required>
</div>
<!--<div class='col-md-6'>
<label>Data Entrega Pedido</label>
<input type="text" class='form form-control' name='data_entrega' id='data_entrega' value='<?=DataMysql::dataVisual($view[0]['data_entrega'])?>'  maxlength='-1' required>
</div>-->
<div class='col-md-6'>
<label>Armazém</label><!-- Almoxarifado -->
<div class="input-group">
<input type="text" class='form form-control' name='nomeAlmoxarifado_fk' id='nomeAlmoxarifado_fk' value='<?=$pedidoModel->getNomeIdFk('aju_calmoxarifado','id_almoxarifado', $view[0]['id_almoxarifado'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_almoxarifado">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_almoxarifado' id='id_almoxarifado' required readonly='readonly' value='<?=$view[0]['id_almoxarifado']?>'>
</div>
<div class='col-md-6'>
<label>Transportadora</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeTransportadora_fk' id='nomeTransportadora_fk' value='<?=$pedidoModel->getNomeIdFk('aju_ctransportadora','id_transportadora', $view[0]['id_transportadora'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_transportadora">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_transportadora' id='id_transportadora' required readonly='readonly' value='<?=$view[0]['id_transportadora']?>'>
</div>
<div class='col-md-6'>
<label>Destinatário</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeDestinatario_fk' id='nomeDestinatario_fk' value='<?=$pedidoModel->getNomeIdFk('aju_cdestinatario','id_destinatario', $view[0]['id_destinatario'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_destinatario">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_destinatario' id='id_destinatario' required readonly='readonly' value='<?=$view[0]['id_destinatario']?>'>
</div>
<div class='col-md-6'>
<label>Destinatário Final</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeDestinatario_final_fk' id='nomeDestinatario_final_fk' value='<?=$pedidoModel->getNomeIdFk('aju_cdestinatario_final','id_destinatario_final', $view[0]['id_destinatario_final'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_destinatario_final">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_destinatario_final' id='id_destinatario_final' required readonly='readonly' value='<?=$view[0]['id_destinatario_final']?>'>
</div>
<div class='col-md-6'>
<label>Nome Destinatario Final</label>
<input type="text" class='form form-control' name='nome_destinatario_final' id='nome_destinatario_final' value='<?=$view[0]['nome_destinatario_final']?>'  maxlength='69' required>
</div>
<div class='col-md-6'>
<label>Observação</label>
<textarea type="text" class='form form-control' name='obs' id='obs' maxlength='254' required><?=$view[0]['obs']?></textarea>
</div>

<div class="col-md-12">
    <br>
    <span style="color:red;">Caso necessário alterar os itens do pedido, será necessário cancelar e fazer outro pedido !</span><br><br>
    <div class="col-md-2">
        
    </div>
<div class="col-md-8">
    <table class="table table-condensed">
        <tr>
            <th>#</th>
            <th>Cod</th>
            <th>Nome</th>
            <th>Nr.Nota</th>
            <th>Qtd</th>
            <th>Valor Unit</th>
            <th>Valor Total</th>
            <th>Validade</th>
        </tr>
        <?php 

                foreach ($iten_pedido['valor'] as $key => $item) {
                    
                    print "<tr>
                        <td>".($key+1)."</td>
                        <td>".$item->id_unidade."</td>
                        <td>".$item->nome." ".$item->descricao."</td>
                        <td>".$item->id_nota."</td>
                        <td>".$item->qtd."</td>
                        <td>R$ ".FuncaoBase::real($item->val_unid)."</td>
                        <td>R$ ". FuncaoBase::real($item->val_total)."</td>
                        <td>".(($item->data_validade == '') ? 'N/A' : DataMysql::dataVisual($item->data_validade))."</td>
                    </tr>";


                }
            ?>
        
        
    </table>
</div>
<div class="col-md-2"></div>
    
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "pedido", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Atualizar">
    </div>
</form>
        
    <!--######################  MODAL aju_tp_pedido ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_tp_pedido">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_tp_pedido</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_tp_pedido" id="searcid_tp_pedido">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "pedido", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_tp_pedido ####################--><!--######################  MODAL aju_almoxarifado ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_almoxarifado">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_almoxarifado</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_almoxarifado" id="searcid_almoxarifado">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "pedido", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_almoxarifado ####################--><!--######################  MODAL aju_transportadora ###################-->

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
                      <a href="<?=FuncaoBase::geraLink("ajuda", "pedido", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
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
                      <a href="<?=FuncaoBase::geraLink("ajuda", "pedido", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
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
                      <a href="<?=FuncaoBase::geraLink("ajuda", "pedido", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
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

        
        
        
    
     /* ###################  fk_aju_tp_pedido ####################*/
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
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_tp_pedido").easyAutocomplete(itens);
                                
    /*###########################  final aju_tp_pedido #####################*/
    
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
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_destinatario_final").easyAutocomplete(itens);
                                
    /*###########################  final aju_destinatario_final #####################*/

    });
</script>
        