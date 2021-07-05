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
                <label><input type="checkbox" name="ck_alta_performance" id="ck_alta_performance"> Manter Fluxo de analise de Alta Performance ?</label>
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
                        print "<option id='".$dados['id_usuario']."'>".$dados['nome']."</option>";
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
                    <label><input type="checkbox" name="ck_alta_performance" id="ck_alta_performance">
                        Analista DLOG
                    </label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="ck_alta_performance" id="ck_alta_performance">
                    Analista Coordenador(a) Adjunto
                    </label>
                </div>
            </div>
            <button class="btn btn-primary" type="button" name="btn_add_permissao" id="btn_add_permissao">Adicionar</button>
            <!-- checkbox div permissao fim-->
        </div>
        <div class="col-md-6">
            <legend>Lista Analistas</legend>
            <table class="table table-bordered">
                <tr>
                    <th>Cod</th>
                    <th>Login</th>
                    <th>Nome</th>
                    <th>Analista DRD</th>
                    <th>Analista DLOG</th>
                    <th>Analista Corrd.Adj</th>
                </tr>
                <?php
                
                    $listaAnalistaCad = H_pedido_pedidajuda_hModel::listaAnalistaPedidoAjuda();
                    
                    foreach ($listaAnalistaCad as $key => $value) {
                        print "<tr>";
                        print "<td>".$value['id']."</td>";
                        print "<td>".$value['login']."</td>";
                        print "<td>".$value['nome']."</td>";
                        print "<td>".$value['analista_drd']."</td>";
                        print "<td>".$value['analista_dlog']."</td>";
                        print "<td>".$value['analista_coord']."</td>";
                        print "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>
    
</div>
    

</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
        
        $("#permissao").hide();
        
        $("#sel_usuario").change(function(){
            $("#permissao").show();
        });

    });
</script>
        