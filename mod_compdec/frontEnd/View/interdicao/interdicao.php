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

$numero = interdicaoController::geraNumero($id_municipio, date('Y'));


$dadosVistoria = interdicaoController::listagem_geral_Autocomplete($id_municipio);
?>

<div class="col-md-12 text-center">
    <a class="btn btn-success" href="<?= FuncaoBase::geraLink('compdec', 'compdec', 'index') ?>">Voltar</a>   
</div>



<legend>Novo Termo de Notificação de Interdição</legend>

<legend>Nº <b><?= $numero; ?>/<?= date('Y') ?></b></legend>

<form action="<?= FuncaoBase::geraLink('compdec', 'interdicao', 'gravar') ?>" method="POST" name="frmInterdicao" id="frmInterdicao">
    <div class="row">
        <br><br>
        <div class="col-md-12">
            <label>Anexar Vistoria nº:</label>
            <input class='form form-control' type="text" id="vistoria" maxlength="10" placeholder="Digite o Número da Vistoria Realizada">
            <input type="hidden" name="id_vistoria" id="id_vistoria" >
            <input type="hidden" name="numero" id="numero" value="<?= $numero; ?>/<?= date('Y') ?>" >
            <br>
        </div>     
        <div class="col-md-6">
            <label>Proprietário/Morador:</label>
            <input class='form form-control' type="text" id="prop" maxlength="110" placeholder="Nome do Proprietário do Imóvel">
            <input type="hidden" name="municipio_id" id="municipio_id" value='<?= $id_municipio; ?>'>
            
        </div>     
        <div class="col-md-6">
            <label>Endereço do Imóvel:</label>
            <input class='form form-control' type="text" name="endereco" id="endereco" maxlength="110" placeholder="Endereço do Imóvel">
        </div>     
    </div>

    <div class="row">
        <br><br>
        <div class="col-md-6">
            <label>Contato/Telefone:</label>
            <input class='form form-control' type='text' id='tel' required maxlength="15" placehold='Telefone de Contato'>
        </div>     
        <div class="col-md-6">
            <label>Data da vistoria:</label>
            <input class='form form-control' type='date' name='dt_registro' id='dt_registro' required value=''>
        </div>     
    </div>

    <div class="row">
        <br>
        <div class="col-md-12">

            <legend>IDENTIFICAÇÃO DO NOTIFICADO</legend>
        </div>
            <br><br>
            <div class="col-md-6">
                <label>Nome do Notificado :</label>
                <input class='form form-control' type="text" name="nome_not" id="nome_not" value="" maxlength="70" required/>
            </div>
            <div class="col-md-6">
                <label>RG :</label>
                <input class='form form-control' type="text" name="rg_not" id="rg_not" value="" maxlength="50" />
            </div> 


            <div class="col-md-6">
                <label>Endereço do Notificado :</label>
                <input class='form form-control' type="text" name="endereco_not" id="endereco_not" value="" maxlength="110" required/>
            </div>
            <div class="col-md-6">
                <label>Contato</label>
                <input class='form form-control' type="text" name="cel_not" id="cel_not" value="" maxlength="20" />
            </div> 

    </div>



    <div class="row">
        <div class="col-md-12">
            <br>
            <legend> RESPONSÁVEL/VISTORIADOR</legend>
        </div>
            <div class="col-md-6">
                <label>Nome do Responsavel :</label><br>
                <input class="form form-control" type="text" name="vistoriador" id="vistoriador" maxlength="100">
            </div>
            <div class="col-md-6">
                <label>Matricula/Crea  :</label><br>
                <input class="form form-control" type="text" name="vistoriador_mat" id="vistoriador_mat" maxlength="100">
            </div>
            
    </div>
    <br>
    <label>Observações : </label><span id='restante' style="font-size: 9pt"> Caracteres Restantes :16776997</span>
    <textarea class="form form-control" maxlength="16777000" id='obs' name="obs" rows="8"></textarea>
    <br>
        

    <input class='btn btn-primary' type="submit" name="btnGravar" id="btnGravar" value="Gravar">
</form>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
              
        caracterestante( $('#obs').attr('id'), $('#restante').attr('id'), $('#obs').attr('maxlength') );
        
        /* auto complete deposito */
        var vistoria = {
            data:
            <?php print json_encode($dadosVistoria); ?>, // array com os dados
            getValue: "numero", /* alterar com nome do item BD */
            template: {
                    type: "custom",
                    method: function(value, item) {
			return "Número: " +item.numero + " | Proprietário: " + item.prop + " | Data :  " + item.dt_vistoria;
		}
                },
            list: {
                match: {
                    enabled: true
                },
                onSelectItemEvent: function () {
                    var id = $("#vistoria").getSelectedItemData().id;
                    var proprietario = $("#vistoria").getSelectedItemData().prop;
                    var endereco = $("#vistoria").getSelectedItemData().endereco;
                    var contato = $("#vistoria").getSelectedItemData().tel;
                    var vistoriador = $("#vistoria").getSelectedItemData().resp_vistoriador;
                    
                    $("#id_vistoria").val(id);
                    $("#prop").val(proprietario);
                    $("#endereco").val(endereco);
                    $("#tel").val(contato);
                    $("#vistoriador").val(vistoriador);
                },
            }
        };

        /*********** autocomplete origem ***********/
        $("#vistoria").easyAutocomplete(vistoria);
        
        
        


    });
    
    

</script>
</body>
</html>

