<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_pipa/Model/IndexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php

//var_dump($dados);
?>
<!-- INICIO DO CORPO-->

<div class="span12 text-center">
    <br>
    <a class="btn btn-success" href="<?= FuncaoBase::geraLink('pipa', 'pipa', 'pmdaindex')?>">Voltar</a>

</div>
<div class="col-md-12">
    
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Município</th>
                <th>Data Criação</th>
                <th>Data Análise</th>
                <th>Data Aprovação</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            foreach ($dados as $key => $value) {
                print "<tr>";
                print "<td>".($key+1)."</td>";
                print "<td><a href='".FuncaoBase::geraLink('pipa', 'pipa', 'printView', ['param'=>$value['id_pmda'], 'mun'=>$value['id_municipio']])."'>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</a></td>";
                print "<td><a href='".FuncaoBase::geraLink('pipa', 'pipa', 'printView', ['param'=>$value['id_pmda'], 'mun'=>$value['id_municipio']])."'>".DataMysql::dataCompletaVisual($value['data'])."</a></td>";
                
                print "<td>";
                    if(!is_null($value['dt_analise']) && $value['status'] == 0) {
                        print 'Este Processo já foi devolvido para ajustes pelo menos uma vez';
                    }else {
                        print "<a href='".FuncaoBase::geraLink('pipa', 'pipa', 'printView', ['param'=>$value['id_pmda'], 'mun'=>$value['id_municipio']])."'>".DataMysql::dataCompletaVisual($value['dt_analise'])."</a></td>";
                    }
                print "<td><a href='".FuncaoBase::geraLink('pipa', 'pipa', 'printView', ['param'=>$value['id_pmda'], 'mun'=>$value['id_municipio']])."'>".DataMysql::dataCompletaVisual($value['data_aprov'])."</a></td>";
                print "<td><a href='".FuncaoBase::geraLink('pipa', 'pipa', 'printView', ['param'=>$value['id_pmda'], 'mun'=>$value['id_municipio']])."'>".Pmda::status($value['status'])."</a></td>";
                
                
                print "</tr>";
                
            }
            
            
            ?>
        </tbody>
    </table>

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

        $("#lbSituacao").hide();

        $('select').change(function () {

            console.log(this.value);

        });

        $("#btnConfirm").hide();
        $("#txtProtocolo").hide();


        $("#lk_alteracao").click(function () {
            $("#btnConfirm").show();
            $("#txtProtocolo").show();
        });
        $("#btnConfirm").click(function () {
            alert("ok");
        });


        $("#rbOpcaoGeral").click(function () {

            $("#lbPesquisa").hide();
            //alert("ok");
            $("#lbSituacao").show();
        });

        $("#rbOpcaoMun").click(function () {

            $("#lbPesquisa").show();
            //alert("ok");
            $("#lbSituacao").hide();
        });


    });

    function alterarStatus(id_pmda) {

        var id_sel = "#selStatus" + id_pmda;

        var dados = {
            "id_pmda": id_pmda,
            "status": $(id_sel).val(),
            "opcao": "gravar",
        }

        $.ajax({
            type: 'POST',
            url: 'mod_pipa/app/pmda/funcAdm.php?v=<?= md5(VERSAO) ?>',
            data: dados,
            success: function (response) {
                //console.log(dados);
                alert('Status Alterado com Sucesso !!')
                location.reload();


            },
            error: function (response) {
                console.log(JSON.stringify(response));


            }
        });

    }


</script>
</body>
</html>
