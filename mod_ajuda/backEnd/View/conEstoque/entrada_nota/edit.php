

<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================-->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php

$aju_fornecedor = new Entrada_notaConEstoqueModel();
  
                    $dadosFornecedor = $aju_fornecedor->listaid_fornecedorAutocomplete();
$aju_natureza = new Entrada_notaConEstoqueModel();
  
                    $dadosNatureza = $aju_natureza->listaid_naturezaAutocomplete();
$aju_itens_nota = new Entrada_notaConEstoqueModel();
  
                    $dadosItens_nota = $aju_itens_nota->listaid_itens_notaAutocomplete();
$aju_almoxarifado = new Entrada_notaConEstoqueModel();
  
                    $dadosAlmoxarifado = $aju_almoxarifado->listaid_almoxarifadoAutocomplete();


?>

<legend>Editar Cadastro Entrada_nota</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "entrada_nota", "edit");?>" method="post" accept-charset="utf-8" name="frmEntrada_nota" id="frmEntrada_nota">
    
<div class='col-md-6'>
<label>Identificador Entrada Nota</label>
<input type="text" class='form form-control' name='id_entrada_nota' id='id_entrada_nota' value='<?=$view[0]['id_entrada_nota']?>'  readonly=readonly >
</div>
<div class='col-md-6'>
<label>Fornecedor</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeFornecedor_fk' id='nomeFornecedor_fk' value='<?=$entrada_notaModel->getNomeIdFk('aju_cfornecedor','id_fornecedor', $view[0]['id_fornecedor'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_fornecedor">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_fornecedor' id='id_fornecedor' required readonly='readonly' value='<?=$view[0]['id_fornecedor']?>'>
</div>
<div class='col-md-6'>
<label>Data Emissao</label>
<input type="text" class='form form-control' name='data_emissao' id='data_emissao' value='<?=DataMysql::dataVisual($view[0]['data_emissao'])?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Data Entrega</label>
<input type="text" class='form form-control' name='data_entrega' id='data_entrega' value='<?=DataMysql::dataVisual($view[0]['data_entrega'])?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Natureza</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeNatureza_fk' id='nomeNatureza_fk' value='<?=$entrada_notaModel->getNomeIdFk('aju_cnatureza','id_natureza', $view[0]['id_natureza'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_natureza">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_natureza' id='id_natureza' required readonly='readonly' value='<?=$view[0]['id_natureza']?>'>
</div>
<div class='col-md-6'>
<label>Itens notas</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeItens_nota_fk' id='nomeItens_nota_fk' value='<?=$entrada_notaModel->getNomeIdFk('aju_citens_nota','id_itens_nota', $view[0]['id_itens_nota'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_itens_nota">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_itens_nota' id='id_itens_nota' required readonly='readonly' value='<?=$view[0]['id_itens_nota']?>'>
</div>
<div class='col-md-6'>
<label>Almoxarifado</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeAlmoxarifado_fk' id='nomeAlmoxarifado_fk' value='<?=$entrada_notaModel->getNomeIdFk('aju_calmoxarifado','id_almoxarifado', $view[0]['id_almoxarifado'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_almoxarifado">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_almoxarifado' id='id_almoxarifado' required readonly='readonly' value='<?=$view[0]['id_almoxarifado']?>'>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "entrada_nota", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Atualizar">
    </div>
</form>
        
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
                      <a href="<?=FuncaoBase::geraLink("ajuda", "entrada_nota", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_fornecedor ####################--><!--######################  MODAL aju_natureza ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_natureza">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_natureza</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_natureza" id="searcid_natureza">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "entrada_nota", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_natureza ####################--><!--######################  MODAL aju_itens_nota ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_itens_nota">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_itens_nota</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_itens_nota" id="searcid_itens_nota">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "entrada_nota", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_itens_nota ####################--><!--######################  MODAL aju_almoxarifado ###################-->

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
                      <a href="<?=FuncaoBase::geraLink("ajuda", "entrada_nota", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
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

        
        
        
    
     /* ###################  fk_aju_fornecedor ####################*/
        $('#btnBuscaid_fornecedor').click(function () {
            $('#modal_id_fornecedor').modal('show');
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
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_fornecedor").easyAutocomplete(itens);
                                
    /*###########################  final aju_fornecedor #####################*/
    
     /* ###################  fk_aju_natureza ####################*/
        $('#btnBuscaid_natureza').click(function () {
            $('#modal_id_natureza').modal('show');
        });

        var itens = {
            data:
            <?php print json_encode($dadosNatureza); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_natureza").getSelectedItemData().id_natureza;
                    var nome = $("#searcid_natureza").getSelectedItemData().nome;
                     
                        $("#nomeNatureza_fk").val(nome); // Mudar
                       $("#id_natureza").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_natureza").easyAutocomplete(itens);
                                
    /*###########################  final aju_natureza #####################*/
    
     /* ###################  fk_aju_itens_nota ####################*/
        $('#btnBuscaid_itens_nota').click(function () {
            $('#modal_id_itens_nota').modal('show');
        });

        var itens = {
            data:
            <?php print json_encode($dadosItens_nota); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_itens_nota").getSelectedItemData().id_itens_nota;
                    var nome = $("#searcid_itens_nota").getSelectedItemData().nome;
                     
                        $("#nomeItens_nota_fk").val(nome); // Mudar
                       $("#id_itens_nota").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_itens_nota").easyAutocomplete(itens);
                                
    /*###########################  final aju_itens_nota #####################*/
    
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

    });
</script>
        