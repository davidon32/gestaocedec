<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";
?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<div class="col-md-12 text-center">
    <div class="col-md-6">
        <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "cadastroEmpr") ?>' class='btn btn-success' title="Cadastrar novo acesso de  Empreendedor">Novo Usuário Externo</a></p>
    </div>

    <div class="col-md-6">
        <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "paebmindex") ?>' class='btn btn-primary'>Voltar</a></p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="#" method="POST" name="frmPesquisa" id="frmPesquisa">
            <label>Pesquisa</label><br>
            <input type="text" class="form form-control" name="pesquisa" id="pesquisa"><br>
            <input type="submit" class="btn btn-primary" name="btn" value="Pesquisar">
        </form>
    </div>
</div>

<div class="row">

    <div class="col-md-12 text-center">
        <legend>Usuários Ativos no Sistema</legend>

        <p>Os usuários abaixo, são os usuários que estão aptos a consultar os processos de Protocolo de PAE</p>

        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Empreendedor</th>
                <th>CNPJ</th>
                <th>Nome Usuário</th>
                <th>CPF</th>
                <th>Opções</th>
            </tr>

            <?php

            $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : "";
            $btn      = isset($_POST['btn'])      ? $_POST['btn'] : null;


            

            if ($btn) {
                $usuarios = Usuario::busca(NULL, "pae", str_replace(['.','-'], "", $pesquisa) );
            } else {
                $usuarios = Usuario::busca(NULL, "pae");
            }

            //var_dump($pesquisa, $btn, $usuarios, $_POST);
            foreach ($usuarios as $key => $usuario) {

                print "<tr>";
                print "<td>" . ($key + 1) . "</td>";
                print "<td>" . $usuario['usuario'] . "</td>";
                print "<td>" . $usuario['usuario'] . "</td>";
                print "<td>" . $usuario['usuario'] . "</td>";
                print "<td>" . $usuario['cpf'] . "</td>";

                print "<td>";
                print "<a href='#' title='Desativar o Acesso do Usuário'><img src='/core/imagem/cancela.png' width='25'></a>";
                print "</td>";
                print "</tr>";
            }

            ?>

        </table>
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

$('#pesquisa').mask("999.999.999-99");    

</script>