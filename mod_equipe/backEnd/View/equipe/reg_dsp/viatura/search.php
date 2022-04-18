<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_admin/Model/admModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<style>
    p {text-align: center};

</style>

<p>
    <div class='row'>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="POST" action="<?= FuncaoBase::geraLink("equipe", "viatura", "search")?>">
            <input type="text" name="txtSearch" id='txtSearch' class='form form-control'>
            <br>
            <input class="btn btn-primary" type="submit" name="btnSearch" id="btnSearch" value="Pesquisar">
            <br>
            </form>
            <br>
            <?php
            
                $pesquisa = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : "";
                $botao = isset($_POST['btnSearch']) ? $_POST['btnSearch'] : "" ;
            
                if($botao = "Pesquisar" && !empty($pesquisa) ){
                    
                    $dados = RegDspViatura::search($pesquisa);
            
                    print "<table class=\"table table-bordered table-striped\">
                        <tr>
                            <th colspan=\"5\" class='text-center'>CADASTRO VIATURA</th>
                        </tr><tr>
                                    <td>#</td>
                                    <td>Placa</td>
                                    <td>Placa Seg.</td>
                                    <td>Nome</td>
                                    <td>Ação</td>
                                </tr>";
                    
                    foreach ($dados as $key => $value) {

                            print "<tr>
                                    <td>".($key+1)."</td>
                                    <td>".$value['placa']."</td>
                                    <td>".$value['placa_seguranca']."</td>
                                    <td>".$value['nome']."</td>
                                    <td><a href='".FuncaoBase::geraLink("equipe", "viatura", "edit", array('id'=>$value['id_viatura']))."'><img src='/core/imagem/editar.png'></a></td>
                                </tr>";
                    }
                        print "</table>";
                }
?>
        <p><button class='btn btn-success' type="button" onclick="window.location.href= '<?= FuncaoBase::geraLink("equipe", "viatura", "index")?>';" >Voltar</button>
    </div>
    <div class="col-md-3"></div>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>    