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


$pedid_model = new H_pedido_pedidajuda_hModel();
  
$dadosMunicipio = $pedid_model->listaid_municipioAutocomplete();
 
$dadosRegiao = $pedid_model->listaid_mesoAutocomplete();

 
$dadosCobrade = $pedid_model->listaid_cobradeAutocomplete();
    
$id_municipio = $_COOKIE['seguranca']['id_municipio'];  

$dados = Municipio::dadosMunicipio($id_municipio);

$dados1 = $pedid_model->buscaDadosPedido($id_municipio);


if(!is_array($dados1)){
    
    print "<script>
                Swal.fire('Favor verificar o Cadastro de Compdec, pois não foi encontrato um membro da Equipe do COMPDEC com a função de Coordenador !').then(function() {
    history.back();
});
           </script>";
    die();
}
?>

<legend>Pedido de Ajuda Humanitária</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "gravar");?>" method="post" accept-charset="utf-8" name="frmH_pedido_pedid" id="frmH_pedido_pedid">
    
<div class='col-md-12'>

<div class='row'>
<div class='col-md-2'>
<label>Data Entrada Sistema</label>
<input type="text" class='form form-control' name='data_entrada_sistema' id='data_entrada_sistema' maxlength='' required value='<?=date('d/m/Y')?>'>
</div>
</div>

<div class='row'>
<div class='col-md-6'>
<label>Identificador Municipio</label>
<div class="input-group">
    <input type="text" class='form form-control' name='nomeMunicipio_fk' id='nomeMunicipio_fk' required readonly='readonly' value="<?=$dados['nome'];?>">
    <input type="hidden" name='id_municipio' id='id_municipio' required readonly='readonly' value="<?=$dados['id_municipio']?>">
</div>
</div>
</div>
<div class='row'>
<div class='col-md-3'>
<label>Identificador Mesorregião</label>
<input type="text" class='form form-control' name='nomeRegiao_fk' id='nomeRegiao_fk' required readonly='readonly' value='<?=$dados['mesorregiao']?>'>
<input type="hidden" name='id_meso' id='id_meso' required readonly='readonly' value='<?=$dados['id_meso']?>'>
</div>
</div>
<div class='row'>
<div class='col-md-8'>
<label>Nome do Coordenador</label>
<div class="input-group">
<input type="text" class='form form-control' name='nome_coordenador' id='nome_coordenador' maxlength='70' required readonly value="<?=$dados1['nome_coordenador']?>">
</div>
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Telefone do Coordenador</label>
<input type="text" class='form form-control' name='tel_coordenador' id='tel_coordenador' maxlength='12' required readonly value="<?=$dados1['tel_coordenador']?>">
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Celular do Coordenador</label>
<input type="text" class='form form-control' name='cel_coordenador' id='cel_coordenador' maxlength='12' required readonly value="<?=$dados1['cel_coordenador']?>">
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label>Email do Coordenador</label>
<input type="text" class='form form-control' name='email_coordenador' id='email_coordenador' maxlength='49' required readonly value="<?=$dados1['email_coordenador']?>">
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label>Nome do Prefeito</label>
<input type="text" class='form form-control' name='nome_prefeito' id='nome_prefeito' maxlength='44' required readonly value="<?=$dados1['nome_prefeito']?>">
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Telefone do Prefeito</label>
<input type="text" class='form form-control' name='tel_prefeito' id='tel_prefeito' maxlength='12' required readonly value="<?=$dados1['tel_prefeito']?>">
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Celular do Prefeito</label>
<input type="text" class='form form-control' name='cel_prefeito' id='cel_prefeito' maxlength='12' required readonly value="<?=$dados1['cel_prefeito']?>">
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label>Email do Prefeito</label>
<input type="text" class='form form-control' name='email_prefeito' id='email_prefeito' maxlength='49' required readonly value="<?=$dados1['email_prefeito']?>" >
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label>Tipo do Desastre</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeCobrade_fk' id='nomeCobrade_fk' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_cobrade">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_cobrade' id='id_cobrade' required readonly='readonly'>
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>População a ser Atendida</label>
<input type="number" class='form form-control' name='pop_atendida' id='pop_atendida' max='1000' required >
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Decreto SE ou ECP Vigente ?</label>
<div class="radio">
  <label>
    <input type="radio" name="decreto_se_ecp_vig" id="nao" value="0" checked>
    Não
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="decreto_se_ecp_vig" id="sim" value="1">
    Sim
  </label>
</div>
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Número do Decreto</label>
<input type="text" class='form form-control' name='numero_decreto' id='numero_decreto' maxlength='19' required >
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Data de Vigencia Decreto</label>
<input type="text" class='form form-control' name='data_vigencia' id='data_vigencia' maxlength='' required >
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Tipo do Decreto</label>
<div class="radio">
  <label>
    <input type="radio" name="tipo_decreto" id="ECP" value="ECP" checked>
    ECP
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="tipo_decreto" id="SE" value="SE">
    SE
  </label>
</div>
</div>
</div>
<div class='row'>
<div class='col-md-12'>
<label>Esforços Realizados</label>
<textarea class='form form-control' rows="9" name='esforcos_realizados' id='esforcos_realizados' maxlength='65534' required >
</textarea>
</div>
</div>

        
    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "h_pedido_index", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Prosseguir >>"><br><br>
        <span id="msg" class="alert alert-danger">Campo "Tipo de Desastre é Obrigatório !"</span>
    </div>
    
    </form>
</div>

    
 <!--######################  MODAL com_regiao ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_regiao">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro com_regiao</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_regiao" id="searcid_regiao">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "regiao", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL com_regiao ####################-->
 
 <!--######################  MODAL dec_cobrade ###################-->

<div class="modal" tabindex="-1" role="dialog" id="modal_id_cobrade">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Pesquisa de Cadastro dec_cobrade</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_cobrade" id="searcid_cobrade">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <!--<a href="<?=FuncaoBase::geraLink("ajuda", "cobrade", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>-->
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL dec_cobrade ####################-->

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
        
        $("#msg").hide();
        
        $("#btnGravar").hover(function(){
           if($('#nomeCobrade_fk').val() == "") {
               $("#btnGravar").attr("type", "button");
               $("#msg").show();
               $("#nomeCobrade_fk").addClass('alert alert-danger');
           }else {
               $("#btnGravar").attr("type", "submit");
               $("#msg").hide();
               $("#nomeCobrade_fk").removeClass('alert alert-danger');
           }
            
        });

        $("#numero_decreto,#data_vigencia").val("");
        $("#numero_decreto,#data_vigencia").attr('readonly', 'readonly');
        $("#data_vigencia").datepicker("destroy");
        $("#numero_decreto,#data_vigencia").css('cursor', 'not-allowed');
        
        $("[name=decreto_se_ecp_vig]").change(function(){
            if($("#nao").is(":checked")){
                $("#nao").attr("checked",true);
                $("#sim").attr("checked",false);
                 
                /* campos numero decreto, data vigencia */
                $("#numero_decreto,#data_vigencia").val("");
                $("#numero_decreto,#data_vigencia").attr('readonly', 'readonly');
                $("#data_vigencia").datepicker("destroy");
                $("#numero_decreto,#data_vigencia").css('cursor', 'not-allowed');
                
            } else if($("#sim").is(":checked")){
                $("#sim").attr("checked",true);
                $("#nao").attr("checked",false);
                
                /* campos numero decreto, data vigencia */
                $("#numero_decreto,#data_vigencia").removeAttr('readonly');
                $("#data_vigencia").datepicker({dateFormat: 'dd/mm/yy',
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    monthNamesShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dec'],
                    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                    dayNamesMin: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
                    orientation: "bottom left",
                    beforeShow: function () { /* problema datapicker atras controle input*/
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }
                }, );
                
                $("#numero_decreto,#data_vigencia").css('cursor', 'text');
            }
        });
        
        $("[name=tipo_decreto]").change(function(){
            if($("#ECP").is(":checked")){
                $("#ECP").attr("checked",true);
                $("#SE").attr("checked",false);
            } else if($("#SE").is(":checked")){
                $("#SE").attr("checked",true);
                $("#ECP").attr("checked",false);
            }
            
        });
        
    
        /* close focus pesquisa */
         /* clic form campo FK fornecedor */
        $("#nomeMunicipio").click(function(){
            $("#modal_id_municipio").modal({backdrop: 'static', keyboard: false});   
        });
        /* focus no campo pesquisa fornecedor */
        $('#modal_id_municipio').on('shown.bs.modal', function (e) {
            $("#searcid_municipio").focus();
        });
 /* clic form campo FK fornecedor */
        $("#nomeRegiao").click(function(){
            $("#modal_id_regiao").modal({backdrop: 'static', keyboard: false});   
        });
        /* focus no campo pesquisa fornecedor */
        $('#modal_id_regiao').on('shown.bs.modal', function (e) {
            $("#searcid_regiao").focus();
        });
 /* clic form campo FK fornecedor */
        $("#nomeCobrade").click(function(){
            $("#modal_id_cobrade").modal({backdrop: 'static', keyboard: false});   
        });
        /* focus no campo pesquisa fornecedor */
        $('#modal_id_cobrade').on('shown.bs.modal', function (e) {
            $("#searcid_cobrade").focus();
        });

    
        $("#frmH_pedido_pedid").trigger("reset");
    
        
        
        
   
    
     /* ###################  fk_cedec_municipio ####################*/
        $('#btnBuscaid_municipio').click(function () {
            $('#modal_id_municipio').modal({backdrop: 'static', keyboard: false});
        });

        var itens = {
            data:
            <?php print json_encode($dadosMunicipio); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_municipio").getSelectedItemData().id_municipio;
                    var nome = $("#searcid_municipio").getSelectedItemData().nome;
                     
                        $("#nomeMunicipio_fk").val(nome); // Mudar
                       $("#id_municipio").val(id);
                },
                onClickEvent:function(){
                    $('#modal_id_municipio').modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_municipio").easyAutocomplete(itens);
                                
    /*###########################  final cedec_municipio #####################*/
    
     /* ###################  fk_com_regiao ####################*/
        $('#btnBuscaid_regiao').click(function () {
            $('#modal_id_regiao').modal({backdrop: 'static', keyboard: false});
        });

        var itens = {
            data:
            <?php print json_encode($dadosRegiao); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_regiao").getSelectedItemData().id_meso;
                    var nome = $("#searcid_regiao").getSelectedItemData().nome;
                     
                        $("#nomeRegiao_fk").val(nome); // Mudar
                       $("#id_meso").val(id);
                },
                onClickEvent:function(){
                    $('#modal_id_regiao').modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_regiao").easyAutocomplete(itens);
                                
    /*###########################  final com_regiao #####################*/
    
     /* ###################  fk_dec_cobrade ####################*/
        $('#btnBuscaid_cobrade').click(function () {
            $('#modal_id_cobrade').modal({backdrop: 'static', keyboard: false});
        });

        var itens = {
            data:
            <?php print json_encode($dadosCobrade); ?>, // array com os dados
            getValue: "descricao", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_cobrade").getSelectedItemData().id_cobrade;
                    var descricao = $("#searcid_cobrade").getSelectedItemData().descricao;
                     
                        $("#nomeCobrade_fk").val(descricao); // Mudar
                       $("#id_cobrade").val(id);
                },
                onClickEvent:function(){
                    $('#modal_id_cobrade').modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_cobrade").easyAutocomplete(itens);
                                
    /*###########################  final dec_cobrade #####################*/
        

    });
</script>
        