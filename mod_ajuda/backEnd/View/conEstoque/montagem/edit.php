

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

$aju_transportadora = new MontagemConEstoqueModel();
  
    $dadosTransportadora = $aju_transportadora->listaid_transportadoraAutocomplete();
    
    $id_montagem = isset($_GET['id']) ? $_GET['id'] :"";
    
    $item_carga = $montagemModel->item_carga($id_montagem);


?>

<legend>Editar Cadastro Montagem</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "montagem", "edit");?>" method="post" accept-charset="utf-8" name="frmMontagem" id="frmMontagem">
    
<div class='col-md-6'>
<label>Identificador Montagem Carga</label>
<input type="text" class='form form-control' name='id_montagem' id='id_montagem' value='<?=$view[0]['id_montagem']?>'  readonly=readonly >
</div>
<div class='col-md-6'>
<label>Data Montagem Carga</label>
<input type="text" class='form form-control' name='data_montagem' id='data_montagem' value='<?=DataMysql::dataVisual($view[0]['data_montagem'])?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Nome Motorista</label>
<input type="text" class='form form-control' name='motorista' id='motorista' value='<?=$view[0]['motorista']?>'  maxlength='69' required>
</div>
<div class='col-md-6'>
<label>placa do veículo</label>
<input type="text" class='form form-control' name='placa' id='placa' value='<?=$view[0]['placa']?>'  maxlength='44' required>
</div>
<div class='col-md-6'>
<label></label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeTransportadora_fk' id='nomeTransportadora_fk' value='<?=$montagemModel->getNomeIdFk('aju_ctransportadora','id_transportadora', $view[0]['id_transportadora'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_transportadora">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_transportadora' id='id_transportadora' required readonly='readonly' value='<?=$view[0]['id_transportadora']?>'>
            <br>
</div>
    
<div class='col-md-12'>
    <table class="table table-bordered" name="tbl_itens" id="tbl_itens">
    <thead>
        <tr>
            <th>Nº Pedido</th>
            <th>Data Emissao</th>
            <th>Destinatario</th>
            <th>Volume</th>            
        </tr>
    </thead>
    <tbody>
        <?php        
        foreach ($item_carga as $item) {
            print "<tr><td>".$item->id_pedido."</td>";
            print "<td>". DataMysql::dataVisual($item->data_emissao)."</td>";
            print "<td>".$item->nome."/".$item->nome_destinatario_final."</td>";
            print "<td>".$item->volume."</td></tr>";

        }
        
        ?>
        
    </tbody>
</table>
</div>
    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "montagem", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Atualizar">
    </div>
</form>
        
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
                      <a href="<?=FuncaoBase::geraLink("ajuda", "montagem", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
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

    });
</script>
        