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
$id = isset($_GET['id']) ? $_GET['id'] : "";
$voltar = isset($_GET['voltar']) ? $_GET['voltar'] : "";

if (empty($id)) {
    print "Ocorreu um Erro de acesso ao sistema !<br>";
    print "<a class='btn btn-success' href='index.php?" . FuncaoBase::geraLink("ajuda", "h_pedido_index", "index") . "'>voltar</a>";
    die();
}
?>

<legend>Upload de Arquivos</legend>
        <legend>Obs: Anexar um documento Digital PDF ou Colar o Link do google drive com o arquivo compartilhado</legend>
<form action="<?= FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "gravar", array('id' => $id, 'voltar' => 'idx_recente')); ?>" method="post" accept-charset="utf-8" name="frmH_pedido_anexo" id="frmH_pedido_anexo" enctype="multipart/form-data">

    <div class='row'>
        <div class='col-md-2'>
            <input type="hidden" class='form form-control' name='id_pedido' id='id_pedido' maxlength='' required value="<?= $id ?>">
            <input type="hidden" class='form form-control' name='voltar' id='voltar' maxlength='' required value="<?= $voltar ?>">
        </div>
    </div>
    <div class='row'>
         <div class='col-md-6'>
            <label>Nome do Arquivo</label>
            <input type="file" class='col-md-6 form form-control' name='nome_arquivo' id='nome_arquivo' maxlength='44' >
            <img id='tamanho_ok' style="float: right" width="25" src="/core/imagem/checar_comunidade.png">
            <img id='tamanho_erro' style="float: right" width="25" src="/core/imagem/remove.png">
            <span id='spAlerta' class='alert-danger'>Arquivo Maior que Permitido ! ( Máximo 2 Mb)</span>
        </div>
        <div class='col-md-6'>
            <label>Link Arquivo Google Drive </label><span class='labelInfo'> ( Cole aqui o link do arquivo compartilhado no Google Drive )</span>
            <input type="text" class='form form-control' name='linkGdrive' id='linkGdrive' maxlength='150' >
            
        </div>
    </div>

    <div class='row'>
        <div class='col-md-6'>
            <label>Descrição </label><span class='labelInfo'> ( Este campo será usado para informar o conteudo do seu arquivo ex: "Lei 4444 parte 1 de 3")</span>
            <input type="text" class='form form-control' name='descricao' id='descricao' maxlength='44' required >
        </div>
        <div class="col-md-6">

            <a href='https://www.youtube.com/watch?v=gm2LmELpBG8'>Veja aqui como Compartilhar arquivos no Google Drive &nbsp;&nbsp;&nbsp;&nbsp;<img src="/core/imagem/googledrive.png" width="100"></a>
        </div>
        
    </div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "edit", array('id' => $id, 'voltar' => 'idx_recente')) ?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    </div>
</form>




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

        $("#btnGravar").hover(function () {
            if ($("#nome_arquivo").val() == "") {
                $("#linkGdrive").prop('required', true);
            }

        });

        $("#spAlerta, #tamanho_erro, #tamanho_ok").hide();

        /* close focus pesquisa */
        $("#frmH_pedido_anexo").trigger("reset");


        $("#nome_arquivo").change(function () {

            var arquivo = $("#nome_arquivo").prop('files')[0];

            if (arquivo.size > 1999353) { /* 2MB*/
                $("#spAlerta, #tamanho_erro").show();
                $("#tamanho_ok").hide();
                $("#nome_arquivo").addClass('alert-danger');
                $("#btnGravar").hide();

            } else {
                $("#spAlerta, #tamanho_erro").hide();
                $("#tamanho_ok").show();
                $("#nome_arquivo").removeClass('alert-danger');
                $("#nome_arquivo").addClass('alert-success');
                $("#btnGravar").show();

            }
        });




    });
</script>
