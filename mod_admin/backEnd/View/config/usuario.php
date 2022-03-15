<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_admin/Model/admModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<?php
    $usuario = new Usuario();
?>

<div class="col-md-12">

    <div class="col-md-4">
        <br>
        <a href='?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=&modulo=admin&controller=adm&action=caduser' class="btn btn-primary">Cadastro Usuario</a>
    </div>

    <div class="col-md-8">
        <legend>Alterar Usuario</legend>
        <form action="#" method="post" name="frmPesquisa">
            <div class="col-md-12">
                <br>
                <label>Pesquisa</label>
                <input type="text" class="form-control" name="txtPesquisaUsuario">
            </div>
            <div class="col-md-12 text-center">
                <br>
                <input class="btn btn-info" type="submit" name="btnEnviar" value="Pesquisar">

            </div>
<br><br>
        </form>

            <?php
                $btn = isset($_POST['btnEnvia']) ? $_POST['btnEnvia'] : true;
                $nome = isset($_POST['txtPesquisaUsuario']) ? $_POST['txtPesquisaUsuario'] :"";
                if($btn && !empty($nome)){
                    $dados =$usuario->getUsuario($nome);

                print "<div class='col-md-12'><br><table class='table table-bordered table-condensed table-striped'>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Email Rec</th>
                            <th>Situação</th>
                            <th>Ultimo Acesso</th>
                            <th>Ações</th>
                        </tr>";

                    foreach ($dados as $key => $value) {
                        print "<tr>
                                <td>".$value['id_usuario']."</td>
                                <td>".$value['nome']."</td>
                                <td>".$value['email_rec']."</td>
                                <td>".($value['situacao'] == 1 ? "Ativo" : "Inativo")."</td>
                                    <td>".$value['ultimo_acesso']."</td>
                                <td>
                                <!-- visualizar registro -->
                                <a href='".FuncaoBase::geraLink("admin", "adm", "caduser", array('id'=>$value['id_usuario']))."'><img src='core/imagem/view.png' width='25' title='Visualizar'></a>";
                                    # Alterar Permissoes 
                                    if(Usuario::getPermissao('cedec_permissao', 'permissao_usuario')){
                                        print "<a href='".FuncaoBase::geraLink("admin", "adm", "alterar", array('id'=>$value['id_usuario']))."'><img src='core/imagem/permissao_icon.png' width='25' title='Alterar Permissoes Usuario'></a>";
                                    }
                                    # alterar perfil 
                                    if(Usuario::getPermissao('cedec_permissao', 'dados_usuario')){
                                        print "<a href='".FuncaoBase::geraLink("equipe", "funcionario", "alterar", array('id'=>$value['id_funcionario'], 'voltar'=>'pesquisa', 'id_'=> $value['id_funcionario'] ))."'><img src='core/imagem/editar.png' width='25' title='Alterar Usuario'></a>";
                                        //print "<a href='".FuncaoBase::geraLink("equipe", "funcionario", "alterar", array('id'=>$value['id_usuario']))."'><img src='core/imagem/editar.png' width='25' title='Alterar dados perfil Usuario'></a>";
                                    }
                                    print "</td></tr>";
                    }

                    //var_dump($dados);
                    print "</table></div>";
                }

            ?>
    
<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=&modulo=admin&controller=index&action=index">Voltar</a>
</div>   
</div> 
</div>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>