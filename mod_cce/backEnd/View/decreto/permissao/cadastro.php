

<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_cce/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php


$cedec_usuario = new PermissaodecretoModel();
  
                    $dadosUsuario = $cedec_usuario->listaid_usuarioAutocomplete();


?>

<legend>Cadastro de Permissao</legend>
<form action="<?=FuncaoBase::geraLink("cce", "permissao", "gravar");?>" method="post" accept-charset="utf-8" name="frmPermissao" id="frmPermissao">
    
    <div class='row'>
<div class='col-md-2'>
<label></label>
<input type="text" class='form form-control' name='login' id='login' maxlength='8' required >
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label></label>
<input type="text" class='form form-control' name='nivel' id='nivel' maxlength='' required >
</div>
</div>
<div class='row'>
<div class='col-md-2'><br>
<input type="checkbox" class='checkbox-inline' name='cad_decreto' id='cad_decreto' >
<label></label>
</div>
</div>
<div class='row'>
<div class='col-md-2'><br>
<input type="checkbox" class='checkbox-inline' name='relatorio' id='relatorio' >
<label>Acesso aos Relatórios</label>
</div>
</div>
<div class='row'>
<div class='col-md-2'><br>
<input type="checkbox" class='checkbox-inline' name='rel_resumo' id='rel_resumo' >
<label>Acesso ao Resumo dos Processos</label>
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Identificador do Usuario</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeUsuario_fk' id='nomeUsuario_fk' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_usuario">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_usuario' id='id_usuario' required readonly='readonly'>
</div>
</div>
<div class='row'>
<div class='col-md-2'><br>
<input type="checkbox" class='checkbox-inline' name='edit_decreto' id='edit_decreto' >
<label>Permissao Editar analisar Decreto</label>
</div>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("cce", "permissao", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
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
                      <a href="<?=FuncaoBase::geraLink("cce", "usuario", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
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
    
        /* ckeck box padrao */
        
$("#cad_decreto).attr("checked",false);
if($("#cad_decreto).is(":checked")){
$("#cad_decreto).val(1);
}


$("#relatorio).attr("checked",false);
if($("#relatorio).is(":checked")){
$("#relatorio).val(1);
}


$("#rel_resumo).attr("checked",false);
if($("#rel_resumo).is(":checked")){
$("#rel_resumo).val(1);
}


$("#edit_decreto).attr("checked",false);
if($("#edit_decreto).is(":checked")){
$("#edit_decreto).val(1);
}


    
        /* radio button padrao */
        
    
        /* close focus pesquisa */
         /* clic form campo FK fornecedor */
        $("#nomeUsuario").click(function(){
            $("#modal_id_usuario").modal({backdrop: 'static', keyboard: false});   
        });
        /* focus no campo pesquisa fornecedor */
        $('#modal_id_usuario').on('shown.bs.modal', function (e) {
            $("#searcid_usuario").focus();
        });

    
        $("#frmPermissao").trigger("reset");
        
    
        
        
        
   

         /* ###################  fk_cedec_usuario ####################*/
            $('#btnBuscaid_usuario').click(function () {
                $('#modal_id_usuario').modal({backdrop: 'static', keyboard: false});
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
        