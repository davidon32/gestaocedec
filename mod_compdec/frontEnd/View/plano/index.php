<?php include_once 'core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once 'mod_compdec/Model/Model.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menuExterno.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$id_municipio = isset($pageSession['session']['seguranca']['id_municipio']) ? $pageSession['session']['seguranca']['id_municipio'] : "";

$plano = new Plano();
?>	

<div class="col-md-12 text-center">
    <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')) ?>&ac=etn&modulo=index&controller=index&action=menue">Voltar</a>
</div>
<div class="col-md-12">
    <h4 class="alert alert-danger">PREZADOS SENHORES,<BR>
        O ENVIO DO PLANO DE CONTINGÊNCIA DEVE SERGUIR OS MESMOS PARÂMETROS DOS ANEXOS DE DOCUMENTAÇÕES/LEIS/DECRETOS.<br><BR>
        <ul>
            <li>-> ARQUIVOS EM FORMATO PDF, DOC OU DOCX.</li>
            <li>-> TAMANHO MÁXIMO 20MB(mega bytes) "no caso das documentações o tamanho é 2mb, mas aqui no plano de contingência é 20mb".</li>
            <li>-> O NOME DO ARQUIVO NÃO DEVE CONTER ESPAÇOS, ACENTOS E CARACTERES ESPECIAIS. ex: PLANO01.PDF, PLANO02.PDF, ETC</li>
        </ul>
    </h4>
</div>

<div class="col-md-12">

      <!--<a href="#" onClick="novoPlano()"><img src="core/imagem/add.png" width="35px;" alt="Novo Plano de Contingência" title="Criar novo Plano de Contingência"> Novo Plano de Contingência</a><span> (Em construção !)</span><br>-->
    <br>
    Obs: O plano de Contingencia deverá estar nos formados PDF, DOC e DOCX.<br><br>

    <a class="btn btn-primary" href="#" onClick="uploadModal()" title="Envio de Plano de Contingência"><img src="core/imagem/upload1.png"  width="35px;" alt="Upload de Plano de Contingência"> Upload de Plano de Contigencia</a><br>

</div>


<div class="col-md-2">&nbsp;</div>
<div class="col-md-8">
    <legend>Plano de Contingencia </legend>

    <table class="table table-bordered table-condensed table-striped" >
        <tr>
            <th class="col-md-2">Data</th>
            <th class="col-md-9">Nome</th>
            <th class="col-md-9">Tamanho MB</th>
            <th class="col-md-1">Ações</th>
        </tr>


        <?php
        $lista = $plano->listaPlano($id_municipio);

        foreach ($lista as $key => $value) {
            
                $kits = ($value['dt_upload'] > "2021-08-10") ? "style='color:blue' title='Plano enviado para o Edital Chamamento 01/2021'" : "";

                print "<tr>";
                print "<td " . $kits . ">" . $value['dt_upload'] . "</td>";
                print "<td " . $kits . "><a href=\"" . FuncaoBase::geraLink('compdec', 'app', 'vupload', array('id' => $value['id'])) . "\">Plano Versao " . $value['versao'] . " -  Data: " . $value['dt_upload'] . "</a></td>";
                print "<td " . $kits . ">" . number_format(($value['tamanho'] / 1024 / 1024), 2,  ".", " "). "</td>";
                print "<td " . $kits . ">";

                if ($value['dt_upload'] > "2021-08-11") {
                    //print "<a href=\"#\" title=\"Deletar Plano\" onclick=\"removerPlano(" . $value['id'] . ")\"><img width=\"20px;\" src=\"core/imagem/delete.png\"></a>";
                }
                print "</td>";
                print "</tr>";
            
        }
        ?>
    </table>

</div>
<div class="col-md-2"></div>

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
                <span id="tamanho" style="font-size:15pt"></span>
                <br>
                <span>VERSÃO / Descrição do Arquivo ( <i>ex: Parte1</i> )</span>
                <input type="text" name="descricao" id="descricao" class="form-control" maxlength="15" required>
                <input type="hidden" name="tamanho_size" id="tamanho_size">
                <br>
                <div class="alert alert-danger">
                    OBS:
                    <li>
                        Os planos deverão estar no formato, Arquivos com Extensão PDF e DOC, DOCX até <b>20 MB</b>
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
                <div id="progressbar"></div>
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
    
    Swal.fire({
        title: '<strong>UPLOAD arquivos SDC</u></strong>',
        width: 600,
        icon: 'info',
        html:
                'Antes de salvar seu documento WORD no formato PDF, faça a Compressão da Imagens, ' +
                '<br>' +
                '<a href="<?= FuncaoBase::geraLink('doc', 'doc', 'compdec') ?>">Clique aqui e Consulte o Manual</a>',

        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText:
                '',
        confirmButtonAriaLabel: 'Thumbs up, great!',
        cancelButtonText:
                '',
        cancelButtonAriaLabel: 'Thumbs down'
    });


    /* Criar novo plano de contingencia */
    (function ($) {

        /*$('#filePlano').change(function(){
         alert(); 
         });*/

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
                        //console.log(response);
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

    /* MODAL de plano de contingencia */
    (function ($) {
        uploadModal = function () {
            $("#myModal").modal('show');
        }
    })(jQuery);


    /* tamanho arquivo */
    $("#filePlano").change(function () {
        var size = this.files[0].size;
        var tamanho, bytes, limite = "";
        $("#tamanho").css("color", "blue");
        if (size <= 1048576) {
            bytes = " Kb";
            tamanho = size / 1024;
        } else if (size > 1048576) {
            bytes = " MB";
            tamanho = (size / 1024 / 1024);
        } else if (size >= 20971520) {
            bytes = " MB";
            tamanho = (size / 1024 / 1024);
            limite = "Tamanho de Arquivo Excedido !, favor reduzi-lo ou dividi-lo !";
            $("#tamanho").css("color", "red");
        }
        $("#tamanho").text(tamanho.toFixed(2) + bytes + limite);
    });


    /* Upload arquivo  */
    $('#btnUpload').on('click', function () {
        
        

        if ($("#descricao").val() == "") {
            alert('O campo descrição não pode ficar em branco !');
        } else if ($('#filePlano').val() == "") {
            alert('Favor Escolher um arquivo !');
        } else {

            var file_data = $('#filePlano').prop('files')[0];
            var descricao = $('#descricao').val();
            var dt = $('#txtData').val();
            var id = $('#txtIdMunicipio').val();
            var tamanho_size = $('#tamanho_size').val();

            var form_data = new FormData();
            

            form_data.append('file', file_data);
            form_data.append('identificador', 'upload')
            form_data.append('id', id);
            form_data.append('dt_upload', dt);
            form_data.append('descricao', descricao);
            form_data.append('tamanho', file_data.size);    
            
            $('.overlay1').show();
            
            
            $('.overlay1').css('z-index', 3000);
            $('.overlay1').css('position', 'absolute');
            $.ajax({
                url: 'mod_compdec/View/plano/process.php?v=<?= md5(VERSAO) ?>', // point to server-side PHP script 
                dataType: 'text', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    //console.log(response);
                    if(response == 'sucesso'){  
                        $("#myModal").modal('hide');
                        $('.overlay1').hide();
                        
                    }
                    $('.overlay1').hide();
                    window.location.reload();
                }
            });
        }
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

