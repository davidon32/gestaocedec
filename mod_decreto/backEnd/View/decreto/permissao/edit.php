

<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_cce/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php

$cedec_usuario = new PermissaoConEstoqueModel();
  
                    $dadosUsuario = $cedec_usuario->listaid_usuarioAutocomplete();


?>

<legend>Editar Cadastro Permissao</legend>


<form action="<?=FuncaoBase::geraLink("cce", "permissao", "edit");?>" method="post" accept-charset="utf-8" name="frmPermissao" id="frmPermissao">
    
<div class='col-md-12'>
<div class='col-md-1'>
<label></label>
<input type="text" class='form form-control' name='id_permissao' id='id_permissao' value='<?=$view[0]['id_permissao']?>'  readonly=readonly >
</div>
</div>
<div class='col-md-2'>
<label></label>
<input type="text" class='form form-control' name='login' id='login' value='<?=$view[0]['login']?>'  maxlength='8' required>
</div>
<div class='col-md-2'>
<label></label>
<input type="text" class='form form-control' name='nivel' id='nivel' value='<?=$view[0]['nivel']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label></label>
<input type="checkbox" class='form form-control' name='cad_decreto' id='cad_decreto' value='<?=$view[0]['cad_decreto']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Acesso aos Relatórios</label>
<input type="checkbox" class='form form-control' name='relatorio' id='relatorio' value='<?=$view[0]['relatorio']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Acesso ao Resumo dos Processos</label>
<input type="checkbox" class='form form-control' name='rel_resumo' id='rel_resumo' value='<?=$view[0]['rel_resumo']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Identificador do Usuario</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeUsuario_fk' id='nomeUsuario_fk' value='<?=$permissaoModel->getNomeIdFk('cedec_usuario','id_usuario', $view[0]['id_usuario'])->nome;?>' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_usuario">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_usuario' id='id_usuario' required readonly='readonly' value='<?=$view[0]['id_usuario']?>'>
</div>
<div class='col-md-2'>
<label>Permissao Editar analisar Decreto</label>
<input type="checkbox" class='form form-control' name='edit_decreto' id='edit_decreto' value='<?=$view[0]['edit_decreto']?>'  maxlength='-1' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("cce", "permissao", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Atualizar">
    </div>
</form>
        
    <!--######################  MODAL cedec_usuario ###################-->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_id_usuario">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro cedec_usuario</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_usuario" id="searcid_usuario">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("cce", "permissao", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL cedec_usuario ####################-->

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
    
     /* close focus pesquisa */
         /* clic form campo FK fornecedor */
        $("#nomeUsuario").click(function(){
            $("#modal_id_usuario").modal({backdrop: 'static', keyboard: false});   
        });
        /* focus no campo pesquisa fornecedor */
        $('#modal_id_usuario').on('shown.bs.modal', function (e) {
            $("#searcid_usuario").focus();
        });
 /* clic form campo FK fornecedor */
        $("#nomeUsuario").click(function(){
            $("#modal_id_usuario").modal('show');   
        });
        /* focus no campo pesquisa fornecedor */
        $('#modal_id_usuario').on('shown.bs.modal', function (e) {
            $("#searcid_usuario").focus();
        });


        
        
        
    
     /* ###################  fk_cedec_usuario ####################*/
        $('#btnBuscaid_usuario').click(function () {
            $('#modal_id_usuario').modal('show');
        });

        var itens = {
            data:
            <?php print json_encode($dadosUsuario); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_usuario").getSelectedItemData().id_usuario;
                    var nome = $("#searcid_usuario").getSelectedItemData().nome;
                     
                        $("#nomeUsuario_fk").val(nome); // Mudar
                       $("#id_usuario").val(id);
                },
                onClickEvent:function(){
                    $('#modal_id_usuario').modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_usuario").easyAutocomplete(itens);
                                
    /*###########################  final cedec_usuario #####################*/

    });
</script>
        