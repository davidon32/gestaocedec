

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

$aju_marca = new UnidadeConEstoqueModel();
  
                    $dadosMarca = $aju_marca->listaid_marcaAutocomplete();
$aju_categoria = new UnidadeConEstoqueModel();
  
                    $dadosCategoria = $aju_categoria->listaid_categoriaAutocomplete();
$aju_almoxarifado = new UnidadeConEstoqueModel();
  
                    $dadosAlmoxarifado = $aju_almoxarifado->listaid_almoxarifadoAutocomplete();
$aju_fornecedor = new UnidadeConEstoqueModel();
  
                    $dadosFornecedor = $aju_fornecedor->listaid_fornecedorAutocomplete();
$aju_unidade_med = new UnidadeConEstoqueModel();
  
                    $dadosUnidade_med = $aju_unidade_med->listaid_unidade_medAutocomplete();


?>

<legend>Cadastro de Produto</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "cunidade", "gravar");?>" method="post" accept-charset="utf-8" name="frmUnidade" id="frmUnidade">
    
    <div class='col-md-6'>
<label>Nome do Material</label>
<input type="text" class='form form-control' name='nome' id='nome' maxlength='44' required >
</div>
<div class='col-md-6'>
<label>Descrição Material</label>
<input type="text" class='form form-control' name='descricao' id='descricao' maxlength='69' required >
</div>
<div class='col-md-6'>
<label>Valor Unit.</label>
<input type="text" class='form form-control' name='valor' id='valor' required >
</div>
<div class='col-md-6'>
    <div class='col-md-6'>
        <label>Produto Tem validade ? :</label><br>
    <label class="radio-inline">
        <input type="radio" name="rb_validade" id="rb_sim" value="0">
        Sim
    </label>
    <label class="radio-inline">
        <input type="radio" name="rb_validade" id="rb_nao" value="1" checked="checked">
        Não 
    </label><br><br>
   
    </div>
    <div class='col-md-6'>
<label id="lbl_validade">Validade Material</label>
<input type="text" class='form form-control' name='data_validade' id='data_validade' maxlength='10' >
</div>
</div>
<div class='col-md-6'>
<label>Marca</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeMarca_fk' id='nomeMarca_fk' required>
<span onclick="" class="input-group-addon" id="btnBuscaid_marca">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_marca' id='id_marca'>
</div>
<div class='col-md-6'>
<label>Categoria</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeCategoria_fk' id='nomeCategoria_fk' required>
<span onclick="" class="input-group-addon" id="btnBuscaid_categoria">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_categoria' id='id_categoria'>
</div>
<!--<div class='col-md-6'>
<label>Armazém</label><!--Almoxarifado
<div class="input-group">
<input type="text" class='form form-control' name='nomeAlmoxarifado_fk' id='nomeAlmoxarifado_fk' required>
<span onclick="" class="input-group-addon" id="btnBuscaid_almoxarifado">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_almoxarifado' id='id_almoxarifado'>
</div>
<div class='col-md-6'>
<label>Fornecedor</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeFornecedor_fk' id='nomeFornecedor_fk' required>
<span onclick="" class="input-group-addon" id="btnBuscaid_fornecedor">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_fornecedor' id='id_fornecedor'>
</div>-->
<div class='col-md-6'>
<label>Unidade de Medida</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeUnidade_med_fk' id='nomeUnidade_med_fk' required >
<span onclick="" class="input-group-addon" id="btnBuscaid_unidade_med">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_unidade_med' id='id_unidade_med'>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "cunidade", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    </div>
</form>
    
    
    <!--######################  MODAL aju_marca ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_marca">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div id="modal_search_marca">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Cadastro aju_marca</h4>
                    </div>
                    <div class="modal-body">

                      <label>Pesquisa</label>
                              <input type="text" class="form form-control" name="searcid_marca" id="searcid_marca">
                    </div>
                    <div class="modal-footer">
                      <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                      <div class="col-md-6 text-left">
                          <!--<button type="button"  class="btn btn-success text-left" id="btn_nova_marca">Cadastrar Novo</button>-->
                          <a href="<?=FuncaoBase::geraLink("ajuda", "marca", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                      </div>
                      <div class="col-md-6 text-right">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                      </div>
                    </div>
                  </div>
                  <!--<div id="modal_nova_marca">
                      <?php //$modal = true;
                            //include_once 'mod_ajuda/backEnd/View/conEstoque/marca/cadastro.php';
                      ?>
                  </div>-->
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_marca ####################-->
 <!--######################  MODAL aju_categoria ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_categoria">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_categoria</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_categoria" id="searcid_categoria">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "categoria", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_categoria ####################-->
 
 <!--######################  MODAL aju_almoxarifado ( armazem )###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_almoxarifado">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro Armazem</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_almoxarifado" id="searcid_almoxarifado">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "almoxarifado", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_almoxarifado ####################-->
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
                      <a href="<?=FuncaoBase::geraLink("ajuda", "fornecedor", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_fornecedor ####################-->
 
 <!--######################  MODAL aju_unidade_med ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_unidade_med">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_unidade_med</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_unidade_med" id="searcid_unidade_med">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "unidade_med", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_unidade_med ####################-->

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

        $("#frmUnidade").trigger("reset");
        
        $("#valor").mask("#.##0,00", {reverse: true});
        
        $("#data_validade").hide();
        $("#lbl_validade").hide();
        
        $("#rb_sim").change(function(){
            if($("#rb_sim").is(":checked")) {
                $("#data_validade").show();
                $("#lbl_validade").show();
            }
        }); 
        
        $("#rb_nao").change(function(){
            if($("#rb_nao").is(":checked")){
                $("#data_validade").hide();
                $("#lbl_validade").hide();
                $("#data_validade").val("");
                
            }
        });
        
        $("#btnGravar").off( "click" );
        
        $("#btnGravar").hover(function (e) {
        if (($("#id_marca").val() === "") ||
            ($("#id_categoria").val() === "") ||
            ($("#id_almoxarifado").val() === "") ||
            ($("#id_fornecedor").val() === "") ||
            ($("#id_unidade_med").val() === "")
                
            ){
        
            $("#nomeMarca_fk").css({"outline": "none", "border-color": "#FF4500","box-shadow": "0 0 10px #FF4500"})
            $("#nomeCategoria_fk").css({"outline": "none", "border-color": "#FF4500","box-shadow": "0 0 10px #FF4500"})
            $("#nomeAlmoxarifado_fk").css({"outline": "none", "border-color": "#FF4500","box-shadow": "0 0 10px #FF4500"})
            $("#nomeFornecedor_fk").css({"outline": "none", "border-color": "#FF4500","box-shadow": "0 0 10px #FF4500"})
            $("#nomeUnidade_med_fk").css({"outline": "none", "border-color": "#FF4500","box-shadow": "0 0 10px #FF4500"})
            Swal.fire({
                title: 'O campos em Destaque, devem ser preenchidos Corretamente !',
            });

        }else {
            
            $("#btnGravar").bind( "click" );
            
        }
        
    });
    
     /* ###################  fk_aju_marca ####################*/
     
        $("#modal_nova_marca").hide();
        
        $("#btn_nova_marca").click(function(){
            $("#modal_search_marca").hide();
            $("#modal_nova_marca").show(); 
            $("#m_embutido").val("embutido");
        });
        
        
        
        $('#nomeMarca_fk').click(function () {
            $('#modal_id_marca').modal({backdrop: 'static', keyboard: false});
        });
        $('#btnBuscaid_marca').click(function () {
            $('#modal_id_marca').modal({backdrop: 'static', keyboard: false});
        });

        var itens = {
            data:
            <?php print json_encode($dadosMarca); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_marca").getSelectedItemData().id_marca;
                    var nome = $("#searcid_marca").getSelectedItemData().nome;
                     
                        $("#nomeMarca_fk").val(nome); // Mudar
                       $("#id_marca").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_marca").easyAutocomplete(itens);
                                
    /*###########################  final aju_marca #####################*/
    
     /* ###################  fk_aju_categoria ####################*/
        $('#btnBuscaid_categoria').click(function () {
            $('#modal_id_categoria').modal({backdrop: 'static', keyboard: false});
        });
        $('#nomeCategoria_fk').click(function () {
            $('#modal_id_categoria').modal({backdrop: 'static', keyboard: false});
        });

        var itens = {
            data:
            <?php print json_encode($dadosCategoria); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_categoria").getSelectedItemData().id_categoria;
                    var nome = $("#searcid_categoria").getSelectedItemData().nome;
                     
                        $("#nomeCategoria_fk").val(nome); // Mudar
                       $("#id_categoria").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_categoria").easyAutocomplete(itens);
                                
    /*###########################  final aju_categoria #####################*/
    
     /* ###################  fk_aju_almoxarifado (Armazem ) ####################*/
        $('#btnBuscaid_almoxarifado').click(function () {
            $('#modal_id_almoxarifado').modal({backdrop: 'static', keyboard: false});
        });
        $('#nomeAlmoxarifado_fk').click(function () {
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
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_almoxarifado").easyAutocomplete(itens);
                                
    /*###########################  final aju_almoxarifado #####################*/
    
     /* ###################  fk_aju_fornecedor ####################*/
        $('#btnBuscaid_fornecedor').click(function () {
            $('#modal_id_fornecedor').modal({backdrop: 'static', keyboard: false});
        });
        
        $('#nomeFornecedor_fk').click(function () {
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
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_fornecedor").easyAutocomplete(itens);
                                
    /*###########################  final aju_fornecedor #####################*/
    
     /* ###################  fk_aju_unidade_med ####################*/
        $('#btnBuscaid_unidade_med').click(function () {
            $('#modal_id_unidade_med').modal({backdrop: 'static', keyboard: false});
        });
        
        $('#nomeUnidade_med_fk').click(function () {
            $('#modal_id_unidade_med').modal({backdrop: 'static', keyboard: false});
        });

        var itens = {
            data:
            <?php print json_encode($dadosUnidade_med); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_unidade_med").getSelectedItemData().id_unidade_med;
                    var nome = $("#searcid_unidade_med").getSelectedItemData().nome;
                     
                        $("#nomeUnidade_med_fk").val(nome); // Mudar
                       $("#id_unidade_med").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_unidade_med").easyAutocomplete(itens);
                                
    /*###########################  final aju_unidade_med #####################*/
        

    });
</script>
        