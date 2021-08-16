<?php include_once 'core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$id_municipio = isset($_GET['id']) ? $_GET['id'] : "";

$plano = new Plano();
?>
<div class="col-lg-8 col-xs-8">
    Plano de Contingência
</div>

<div class="col-lg-8 col-xs-8">

      <!--<a href="#" onClick="novoPlano()"><img src="core/imagem/add.png" width="35px;" alt="Novo Plano de Contingência" title="Criar novo Plano de Contingência"> Novo Plano de Contingência</a><span> (Em construção !)</span><br>-->
    <br>
    <a href="#" onClick="uploadModal()" title="Envio de Plano de Contingência"><img src="core/imagem/upload1.png"  width="35px;" alt="Upload de Plano de Contingência"> Upload de Plano de Contigencia</a><br>

</div>
<!-- VERSOES PLANO CONTINGENCIA -->
<div class="col-lg-4 col-xs-4">
    <label>Versões</label>
    <br><br>

    <?php
    $lista = $plano->listaPlano($id_municipio);
    

    foreach ($lista as $key => $value) {
        print "<i class=\"glyphicon glyphicon-asterisk\"></i>";
        print "<a href=\"" . FuncaoBase::geraLink("compdec", "plano", "vupload", array("id" => $value['id'])) . "\">Plano Versao " . $value['versao'] . " -  Data: " . $value['dt_upload'] . "</a>";
        print "&nbsp;&nbsp;<a href=\"#\" title=\"Deletar Plano\" onclick=\"removerPlano(" . $value['id'] . ")\"><img width=\"20px;\" src=\"core/imagem/delete.png\"></a>";
        print "<br>";
    }
    ?>
    
    <div class='col-md-12'>
        <table class="table table-bordered table-condensed"
        
    </div>


</div>

<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="<?= FuncaoBase::geraLink('compdec', 'compdec', 'buscarAlterar') ?>">Voltar</a>
</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Upload de Plano de Contingencia</h4>
            </div>
            <div class="modal-body">
                <input type="file" name="filePlano" id="filePlano" class="form-control">
                <br>
                <span>Versão do Documento em caso de Alteração</span>
                <select name="selVersao" id="selVersao" class="form-control" >
                    <option value="0">Versão</option>
<?php
for ($index = 1; $index < 20; $index++) {
    print "<option value='" . $index . "'>" . $index . "</option>";
}
?>
                </select>
                <br>
                <div class="alert alert-danger">
                    OBS:
                    <li>
                        Os planos deverão estar no formato, Arquivos com Extensão PDF e DOC, DOCX até 2MB
                    </li>
                </div>
                <div class="alert alert-warning">
                    DICAS
                    <li>
                        <a href="https://smallpdf.com/pt/compressor-de-pdf">Comprimir arquivos PDF</a><br>
                    </li>
                    <li>
                        <a href="http://ptcomputador.com/Software/data-compression/112119.html">Comprimir Imagem em Documento Word</a><br>
                    </li>

                </div>

                <input type="hidden" name="txtData" id="txtData" value="<?= date('Y-m-d h:i:s'); ?>">
                <input type="hidden" name="txtIdMunicipio" id="txtIdMunicipio" value="<?= $id_municipio; ?>">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" name="btnUpload" id="btnUpload">Upload</button>
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

    /* Criar novo plano de contingencia */
    (function ($) {


        /* ENVIAR PLANO */
        novoPlano = function () {

            if (confirm("Deseja Começar o preenchimento de um novo Plano de Contingência ?")) {

                $.ajax({
                    url: 'mod_compdec/View/plano/process.php?v=<?= md5(VERSAO) ?>',
                    type: 'POST',
                    data: {
                        identificador: "novoPlano",
                        id_municipio: "<?= $id_municipio; ?>"
                    },

                    success: function (response) {
                        console.log(response);
                        if (response == "sucesso") {
                            window.location.href = "?modulo=compdec&secao=plano&acao=planomenu&id=<?= $id_municipio; ?>";

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown, "-");
                    }


                });
            }

            return false;

        }

    })(jQuery);

    /* upload de plano de contingencia */
    (function ($) {

        uploadModal = function () {
            $("#myModal").modal('show');
        }

    })(jQuery);


    /* Upload arquivo  */
    $('#btnUpload').on('click', function () {

        var file_data = $('#filePlano').prop('files')[0];
        var versao = $('#selVersao').val();
        var dt = $('#txtData').val();
        var id = $('#txtIdMunicipio').val();

        var form_data = new FormData();

        form_data.append('file', file_data);
        form_data.append('identificador', 'upload')
        form_data.append('id', id);
        form_data.append('dt_upload', dt);
        form_data.append('versao', versao);
        //alert(form_data);                             
        $.ajax({
            url: 'mod_compdec/View/plano/process.php?v=<?= md5(VERSAO) ?>', // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                if (response.trim() == 'sucesso') {
                    alert('Upload realizado com Sucesso "');
                    $("#myModal").modal('hide');
                    window.location.reload();
                }
            }, error: function (response) {
                console.log(response)
            }
        });
    });


    (function ($) {
        /* Remover o plano de Contingencia */
        removerPlano = function (id_plano) {

            if (confirm("Deseja realmente deletar este Plano de Contingencia ?\nProcesso sem volta !")) {

                $.ajax({
                    url: 'mod_compdec/View/plano/process.php?v=<?= md5(VERSAO) ?>',
                    type: 'POST',
                    data: {
                        identificador: "removerPlano",
                        id_municipio: "<?= $id_municipio; ?>",
                        id_plano: id_plano,
                    },

                    success: function (response) {
                        console.log(response);
                        if (response == "sucesso") {
                            alert("Plano de Contingencia Deletado com Sucesso !");
                            window.location.reload();

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown, "-");
                    }


                });
            }

            return false;

        }

    })(jQuery);

</script>
</body>
</html>

