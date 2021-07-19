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

    $usuario = new Usuario();
    $usuarios = $usuario->getIdNome("1");
    
    $h_pedido_pedid = new H_pedido_pedidajuda_hModel();
    
    $alta_perf = Config::getConfig();
    

?>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-12 text-right">
        <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_index", "index") ?>">Voltar</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="checkbox">
                <label><input type="checkbox" name="ck_alta_performance" id="ck_alta_performance" <?=($alta_perf['aju_h_alta_perf'] == 1 ? "checked" :"")?>> Manter Fluxo de analise de Alta Performance ?</label>
                <br><span style="font-size: 12px; color: #666666; font-style: italic"> *Nessa modalidade, os processos são analisados, por qualquer analista, não obedecendo as suas devidas Diretorias.</span>
            </div>  
        </div>
    </div>    
    <div class="row">
        <div class="col-md-6">
            <legend>Cadastrar Analistas</legend>
            <select class="form form-control" name="sel_usuario" id="sel_usuario">
                <option>Selecione o Analista</option>
                <?php
                    foreach ($usuarios as $key => $dados) {
                        print "<option value='".$dados['id_usuario']."' data-login='".$dados['login']."'>".$dados['nome']."</option>";
                    }
                ?>
            </select>
            
            <!-- checkbox div permissao-->
            <div class="col-md-6" id='permissao'>
                <div class="checkbox">
                    <label><input type="checkbox" name="ck_analista_drd" id="ck_analista_drd">
                        Analista DRD
                    </label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="ck_analista_dlog" id="ck_analista_dlog">
                        Analista DLOG
                    </label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="ck_analista_coord" id="ck_analista_coord">
                    Analista Coordenador(a) Adjunto
                    </label>
                </div>
            <!-- checkbox div permissao fim-->
            <button class="btn btn-primary" type="button" name="btn_add_permissao" id="btn_add_permissao">Adicionar</button>
            </div>
        </div>
        <div class="col-md-6">
            <legend>Permissoes Lista Analistas</legend>
            <table class="table table-bordered">
                <tr>
                    <th>Cod</th>
                    <th>Login</th>
                    <th>Nome</th>
                    <th>Analista DRD</th>
                    <th>Analista DLOG</th>
                    <th>Analista Corrd.Adj</th>
                    <th>opcao</th>
                </tr>
                <?php
                
                        $listaAnalistaCad = H_pedido_pedidajuda_hModel::listaAnalistaPedidoAjuda();
                        
                        foreach ($listaAnalistaCad as $key => $value) {
                            
                            $corDRD = (($value['analista_drd'] == '1') ? 'style=\'font-size:15pt;font-weight:bold; color:#04B431;\'' : '');
                            $corDLOG = (($value['analista_dlog'] == '1') ? 'style=\'font-size:15pt;font-weight:bold; color:#04B431;\'' : '');
                            $corCORRD = (($value['analista_coord'] == '1') ? 'style=\'font-size:15pt;font-weight:bold; color:#04B431;\'' : '');
                            
                            print "<tr>";
                            print "<td>".$value['id_usuario']."</td>";
                            print "<td>".$value['login']."</td>";
                            print "<td>".Usuario::getNomeId($value['id_usuario'])."</td>";
                            
                            print "<td ".$corDRD."><select name='sel_analista_drd'>"
                                        . "<option value='1'>Sim</option>"
                                        . "<option value='0'>Não</option>"
                                    . "</select>"
                                    .(($value['analista_drd'] == '1') ? 'Sim' : 'Não')
                                    ."</td>";
                            
                            print "<td ".$corDLOG."><select name='sel_analista_dlog'>"
                                        . "<option value='1'>Sim</option>"
                                        . "<option value='0'>Não</option>"
                                    . "</select>"
                                    .(($value['analista_dlog'] == '1') ? 'Sim' : 'Não')
                                    ."</td>";
                            
                            print "<td ".$corCORRD."><select name='sel_analista_coord'>"
                                        . "<option value='1'>Sim</option>"
                                        . "<option value='0'>Não</option>"
                                    . "</select>"
                                    .(($value['analista_coord'] == '1') ? 'Sim' : 'Não')
                                    ."</td>";
                            print "<td><!--<a href='#' name='permissao_edit' title='Editar Permissoes'><img src='/core/imagem/editar.png'</a> |-->";
                            print "<a href='index.php?".FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "config_ajuda", array('id'=>$value['id_usuario']))."' name='permissao_remove' data-id_usuario='".$value['id_usuario']."' title='Remover Permissoes'><img src='/core/imagem/delete.png'</a></td>";
                            print "</tr>";
                        }
                ?>
            </table>
        </div>
    </div>
    
</div>
    

</div>

<?php

    $id_usuario = isset($_GET['id']) ? $_GET['id'] : "";
    
    if(!empty($id_usuario)){
        $h_pedido_pedid->removerPermissao($id_usuario);
        print "<script>";
        print "window.location.href = 'index.php?".FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "config_ajuda")."';";
        print "</script>";
    }

?>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
        
        $("select[name='sel_analista_drd']").hide();
        $("select[name='sel_analista_dlog']").hide();
        $("select[name='sel_analista_coord']").hide();
        
        $("#permissao").hide();
        $("#btn_add_permissao").hide();
        $("#sel_usuario").change(function(){
            $("#permissao").show();
            $("#btn_add_permissao").show();
        });
        
        $("#ck_alta_performance").change(function(){
            var result = $("#ck_alta_performance").is(':checked') ? 1 : 0;
            var formData = new FormData();
		formData.append('opcao', 'ck_alta_perf');
		formData.append('aju_h_alta_perf', result); 
           $.ajax({
		url : '/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax.php',
		type : 'POST',
		data : formData,
		processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
		success : function(response) {
                    console.log(response);
                    //Swal.fire('Gravação realizada com Sucesso !').then(function(){
                        //window.location.reload();
                    //});//
		},
		error : function(e) {
		//console.log(JSON.stringify(e));
		}
            });

            
        });
        
        $("#btn_add_permissao").click(function(){
            
            var analista_drd = $("#ck_analista_drd").is(':checked') ? 1 : 0;
            var analista_dlog = $("#ck_analista_dlog").is(':checked') ? 1 : 0;
            var analista_coord = $("#ck_analista_coord").is(':checked') ? 1 : 0;
            
            var formData = new FormData();
		formData.append('opcao', 'add_permissao');
		formData.append('id_usuario', $("#sel_usuario").val()); 
		formData.append('analista_drd', analista_drd); 
		formData.append('analista_dlog', analista_dlog); 
		formData.append('analista_coord', analista_coord); 
		formData.append('login', $("#sel_usuario").find(':selected').data('login')); 
                
           $.ajax({
		url : '/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax.php',
		type : 'POST',
		data : formData,
		processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
		success : function(response) {
                    Swal.fire('Cadastro realizada com Sucesso !').then(function(){
                        window.location.reload();
                    });
		},
		error : function(e) {
		//console.log(JSON.stringify(e));
		}
            });

            
        })
        
       

    });
</script>
        
