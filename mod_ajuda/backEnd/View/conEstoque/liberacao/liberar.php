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
$saldo = new ControleSaldo();

$_municipio = new Municipio();

$municipios = $_municipio->dadosSelectMunicipio($_COOKIE['seguranca']['rpm']);


$dadosOrigem = Material::ListFonte();

$dadosDeposito = Deposito::ListaDeposito();

# verifica se tem algum produto com vencimento de data limite
//$saldo->DevolvePedido();

/* * ***************************************************************************************
 *  	Orgão Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
 * 	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
 * 	
 * 	Autor        :  Demetrio Silva Passos
 * 	Fun��o   : Tela de Executar Libera��o de Materiais
 *
 * ***************************************************************************************** */
?>
<style>
    .tile {
        font-size: 9pt;
        color: silver;
    }
</style>
<div class="col-md-2"></div>
<div class="col-md-6 text-left">

        <div class="input-group">
            <!-- Adicionar Materiais na Liberacao -->
            <?php
            
                $attr = "";
                $id_deposito = "";
                $nome_deposito = "";
                
                if($_COOKIE['seguranca']['id_deposito'] != 1){
                    $attr = 'readonly';
                    $id_deposito = isset($_COOKIE['seguranca']['id_deposito']) ? $_COOKIE['seguranca']['id_deposito'] :"";
                    $nome_deposito = Deposito::PegaNomeDeposito($id_deposito);
                }
            ?>
            <input type="text" class="form col-md-12" name="nome_deposito" id="nome_deposito" <?=$attr?> value='<?=$nome_deposito?>' placeholder="Deposito Retirada">
            <input type="hidden" name="id_deposito" id="id_deposito" value="<?=$id_deposito?>"> 
            <span class="input-group-btn">
                <button type="button" class="btn btn-default" id='btnAddMaterial'>Adicionar Materiais</button>
            </span>
        </div><!-- /input-group -->
    
    <p style="text-align:center"><legend>Lista de Materiais a Liberar</legend></p>

    <div class="col-md-12 text-center">
        <?php
        if (isset($_SESSION['cesta']) && (!empty($_SESSION['cesta']))) {
            print Pedido::MostraPedido($_SESSION['cesta']);
        } else {
            print "<span class=\"alert alert-danger\">Não foi Adicionado Material para Liberaração</span>";
        }
        ?>
    </div>
</div>	
<div class='col-md-2'>&nbsp;</div>
<div class='col-md-2'>&nbsp;</div>

<div class="row"></div>
<hr>

<div class='col-md-2'>&nbsp;</div>
<div class='col-md-8'>

    <form method="POST" action="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=fechar_liberacao" name="flibera" style="background: #F2F2F2;"/>

    <div class="col-md-12">
        <legend>Liberação de Materiais</legend>

        <label>Munic&iacute;pio Destino</label>
        <input class="form-control" type="text" name="txtMunicipio" id="txtMunicipio">
        <!--<?php $_municipio->PegaMunicipio(); ?>-->
        <input type="hidden" name="id_municipio" id="id_municipio">
    </div>

    <div class="col-md-6">
        <label>Fonte de Origem<br/></label>
        <input type="text" class="form-control" name='fonte' id='fonte'>
        <input type="hidden" name='id_origem' id='id_origem'>
    </div>

    <div class="col-md-6">
        <label>Evento</label>
        <select name="evento" id="evento" class="form-control" required>
            <option value="">Selecione o Evento</option>
            <?php
            print Material::Evento();
            ?>
        </select>
    </div>

    <div class="col-md-12"><hr></div>

    <div class="col-md-12">
        <label>Benefici&aacute;rio : </label><span class='tile'>( Prefeitura / Órgao / Instituição Recebedora )</span>
        <input type="text" class="form-control" name="beneficiario" id="beneficiario" maxlength="50" title="Nome do Benefici&aacute;rio ex. Prefeitura" required />
    </div>

    <div class="col-md-12">
        <label>Representante Beneficiario:</label><span class='tile'> ( Representante Prefeitura / Coordenador Municipal ) </span>
        <input type="text" class="form-control" name="resp_receb" id="resp_receb" maxlength="50" title="Representante Prefeitura ou responsavel pela retirada do material" required />
    </div>
    <div class="col-md-6">
        <label>C.I:</label>  <span class='tile'>( Identidade do Representante ) </span>
        <input type="text" class="form-control" name="resp_receb_ci" id="resp_receb_ci" maxlength="15" title="Identidade do Representante" required />
    </div>
    <div class="col-md-6">
        <label>CPF:</label>  <span class='tile'>( CPF do Representante ) </span>
        <input type="text" class="form-control" name="resp_receb_cpf" data-mask='999.999.999-99' id="resp_receb_cpf" maxlength="20" title="CPF do Representante " required />
    </div>
    <div class="col-md-6">
        <label>Veículo:</label>  <span class='tile'>( VEÍCULO que vai fazer a retirada do Material ) </span>
        <input type="text" class="form-control" name="resp_receb_veiculo" id="resp_receb_veiculo" maxlength="50" title="VEÍCULO que vai fazer a retirada do Material" required />
    </div>
    <div class="col-md-6">
        <label>Placa:</label>  <span class='tile'>( PLACA veículo que vai fazer retirada do Material ) </span>
        <input type="text" class="form-control" name="pl_resp_receb" id="pl_resp_receb" maxlength="15" title="PLACA veículo que vai fazer retirada do Material" required />
    </div>

    <div class="col-md-12"><hr></div>

    <div class="col-md-6">
        <label>Responsável pela Liberação:</label>

        <?php
        $_login = new Login();

        $dados = $_login->getFuncionario();

        print "<select name=\"responsavel\" id=\"responsavel\" class=\"form-control\" required>";
        print "<option value=''></<option>";
        for ($i = 0; $i < count($dados); $i++) {
            print "<option value=" . $dados[$i]['id_funcionario'] . ">" . utf8_encode($dados[$i]['nome']) . " " . $dados[$i]['posto'] . "</<option>";
        }
        print "</select>";
        ?>
    </div>

    <div class="col-md-6">	
        <label>Data:</label>
        <input type="text" name="dt_libera" id="dt_libera" size="15" class="mask-data form-control" value="<?php print date('d/m/Y'); ?>"  maxlength="10"/>
    </div>

    <div class="col-md-12">
        <label title="Observações gerais">Observação:</label>
        <textarea class="col-md-5 form-control" name="obs" id="obs" rows="6" maxlength=255">-</textarea>
    </div>

    <div class="col-md-6">
        <br>
        <label>Vir&aacute; Buscar ?</label>
        <input type="checkbox" name="entrega" title="Modo de entrega" checked="checked"/>
    </div>

    <div class="col-md-12 text-center">
        <input class="btn btn-info" type="submit" value="Gravar Liberação" name="send" title="Fechar Pedido" />
    </div>


</form>
</div>
<div class="col-md-2"></div>


<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxliberacao">Voltar</a>
</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">
    $(document).ready(function () {

        $(".box").css('height', '1324');

        $('#btnAddMaterial').click(function () {
            var id_deposito = $("#id_deposito").val();
            if (id_deposito.length > 0) {
                window.location.href = '<?= FuncaoBase::geraLink("ajuda", "conestoque", "add_material") ?>&id=' + id_deposito;
            }
        });

        $("#dt_libera").datepicker({
            maxDate: 3,
            minDate: -5,
            dateFormat: 'dd/mm/yy',
            orientation: "bottom left",
            beforeShow: function () { /* problema datapicker atras controle input*/
                setTimeout(function () {
                    $('.ui-datepicker').css('z-index', 99999999999999);
                }, 0);
            }
        }).attr('readonly', 'readonly');

        var itensMunicipio = {
            data:
<?php print json_encode($municipios); ?>, // array com os dados
            getValue: "nome",
            list: {
                maxNumberOfElements: 15,
                match: {
                    enabled: true
                },
                
                onClickEvent: function () {
                    var value = $("#txtMunicipio").getSelectedItemData().id_municipio;

                    $("#id_municipio").val(value);
                    //$("#txtIdComunidadeSearch").val(value).trigger("change");
                }

            }

        };
        $("#txtMunicipio").easyAutocomplete(itensMunicipio);

        /* auto complete origem */
        var itemOrigem = {
            data:
<?php print json_encode($dadosOrigem); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */

            list: {
                match: {
                    enabled: false
                },
                onClickEvent: function () {
                    var nome = $("#fonte").getSelectedItemData().nome;
                    $("#id_origem").val(nome);
                },
            }
        };
        /*********** autocomplete origem ***********/
        $("#fonte").easyAutocomplete(itemOrigem);

        /* auto complete deposito */
        var itemDeposito = {
            data:
<?php print json_encode($dadosDeposito); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */

            list: {
                match: {
                    enabled: true
                },
                onClickEvent: function () {
                    var id = $("#nome_deposito").getSelectedItemData().id_deposito;
                    $("#id_deposito").val(id);
                },
            }
        };
        /*********** autocomplete origem ***********/
        $("#nome_deposito").easyAutocomplete(itemDeposito);


        $("#dt_libera").datepicker({dateFormat: 'dd/mm/yy'});

        /* Quando algum hyperlink com a classe "window" for clicado */

        $('a.window').click(function ()
        {
            var dimensions = (this.rel)
                    ? this.rel
                    : '660x600';
            dimensions = dimensions.split('x');
            var width = dimensions[0];
            var height = dimensions[1];
            var bWindow = window.open(this.href, this.id, 'width=' + width + ',height=' + height + ',left=' + (((screen.width - width) / 2) - 20) + ',top=' + (((screen.height - height) / 2) - 20) + ',scrollbars=yes,resizable=yes,toolbars=no');
            bWindow.focus();
            return false;
        });
    });
</script>
