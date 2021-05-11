<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_admin/Model/admModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<?php
    $usuario = new Usuario();
?>

<div class="col-md-12">

    <div class="col-md-6">
        <br>
        <a href='?token=<?=hash('sha256', md5(VERSAO));?>&ac=&modulo=admin&controller=adm&action=caduser' class="btn btn-primary">Cadastro Usuario</a>
    </div>

    <div class="col-md-6">
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
                            <th>Situação</th>
                            <th>Ações</th>
                        </tr>";

                    foreach ($dados as $key => $value) {
                        print "<tr>
                                <td>".$value['id_usuario']."</td>
                                <td>".$value['nome']."</td>
                                <td>".$value['situacao']."</td>
                                <td><a href='#'><img src='core/imagem/search.png' width='25' title='Alterar Usuario'></a></td>
                            </tr>";
                    }

                    //var_dump($dados);
                    print "</table></div>";
                }

            ?>
    
</div>  
<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO));?>&ac=&modulo=admin&controller=index&action=index">Voltar</a>
</div>   


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>