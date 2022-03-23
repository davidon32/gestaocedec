<?php include_once PATH . '/core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once "mod_compdec/Model/Model.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$_login = new Login();

$_funcaoBase = new FuncaoBase();

$_municipio = new Municipio();

$_compdec = new Compdec();

$_regiao = new Regiao();

$_associacao = new Associacao();

$_territorio = new Territorio();

$municipios = $_municipio->dadosSelectMunicipio($_COOKIE['seguranca']['rpm']);

$rpms = Municipio::listaRDC();

?>
<form action="index.php?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=compdec&controller=compdec&action=buscarAlterar" method="POST" accept-charset="utf-8">

    <label>Município</label>
    <input type="text" name="txtMunicipio" id="txtMunicipio">
    <input type="hidden" name="txtIdMunicipio" id="txtIdMunicipio">

    <br />
    <input class="btn btn-primary" type="submit" name="btn_enviar" id="btn_enviar" value="Buscar">
</form>
<br>
<?php
$_btn_enviar = isset($_POST['btn_enviar']) ? $_POST['btn_enviar'] : "";

$_id_municipio = isset($_POST['txtIdMunicipio']) ? $_POST['txtIdMunicipio'] : "";

$permissao = $_login->verificaPermissao("alt_comdec", "com_permissao", $pageSession['session']['seguranca']['login']);


if ($_btn_enviar && !empty($_id_municipio)) {

    $_dados = $_compdec->buscaCompdec($_id_municipio);

    $alteracao = ($permissao == '1') ? "<a href='" . FuncaoBase::geraLink("compdec", "compdec", "alterarCompdec", array('mun' => $_dados[0]['id_municipio'])) . "'><img src='/core/imagem/editar.png' title='Alterar Informações'></a>" :
            "<a href='" . FuncaoBase::geraLink("compdec", "compdec", "visualizar", array('mun' => $_dados[0]['id_municipio'])) . "'><img src='/core/imagem/view.png' title='Visualizar Informações'></a>";

    $_territorio_desenv = $_territorio->pegaNomeTerritorio($_dados[0]['id_territorio']);

    print "<table class=\"table table-bordered\">
						<tr>
							<th width=''>Município</th>
							<th width=''>Sit.Usuario</th>
							<th width=''>Possui Compdec</th>
							<th width=''>Cadastro COMPDEC</th>
							<th width='' title='Regional de Defesa Civil'>Região DC</th>
							<th width='' title='Acesso ao Módulo PMDA'>Módulo PMDA</th>
							<th width='' title='Acesso ao Módulo Ajuda Humanitária'>Módulo Ajuda Humanitária</th>
							<th width='' title='Plano Contingencia'>Plano de Contingëncia</th>
							<th width='' title='Histórico do Munícipio'>Histórico do Município</th>
						</tr>
						<tr>
							
							<td>
								<input type='hidden' value='" . $_dados[0]['id_municipio'] . "' name='txtId_municipio' id='txtId_municipio'>";
    print $_municipio->PegaNomeMunicipio($_dados[0]['id_municipio']);
    print "</td>
							<td>" . $_dados[0]['situacao'] . "</td>";
    print "<td>";

    $opcao = array(array(isset($_dados[0]['com_const']) ? $_dados[0]['com_const'] : '0', ($_dados[0]['com_const'] == '1') ? 'Sim' : 'Nao'));
    $simnao = array(array('1', 'Sim'), array('0', 'Nao'));
    print Html::inputSelect("compdec", "compdec", null, Config::$SIMNAO, $opcao, "class='pull-left'");
    print "</td>
							<td>" . $alteracao . "</td>
							<td><select name='sel_rdc' class='form form-control'>
                                                            <option value='".$_dados[0]['id_rpm']."'>".$_dados[0]['id_rpm']." RPM</option>";
    foreach ($rpms as $key => $rpm) {
        print "<option value='".$rpm['id']."'>".$rpm['nome']."</option>";
    }

                                                        print "</td>
							<td><input type='checkbox' name='ck_PMDA' id='ck_PMDA' " . ( ($_dados[0]['mod_pipa'] == 1) ? 'checked' : '') . "></td>
							<td><input type='checkbox' name='ck_AJUDA' id='ck_AJUDA' " . ( ($_dados[0]['mod_ajuda'] == 1) ? 'checked' : '') . "></td>
							<td><a href='" . FuncaoBase::geraLink("compdec", "compdec", "plano", array("id" => $_dados[0]['id_municipio'])) . "'>Visualizar</a></td>
							<td><a href='" . FuncaoBase::geraLink("compdec", "compdec", "informacoes", array("id" => $_dados[0]['id_municipio'])) . "'>Historico Município</a></td>

						</tr>
						<tr>
							<td colspan='9'>
								<table class='table'>
									<tr>
										<th>
											Telefone Compdec
										</th>
										<th>
											Telefone Outros Agentes
										</th>
										<th>
											Email Compdec
										</th>
										<th>
											Telefone Prefeitura
										</th>
										<th>
											Email Prefeitura
										</th>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td>" . $_dados[0]['fone_com1'] . "<br>" . $_dados[0]['fone_com2'] . "</td>
										<td>" . $_dados[0]['email'] . "</td>
									</tr>
								</table>

							</td>
							
						</tr>
						</table>";
}
?>	
<div class='col-md-12 text-center'>
    <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=compdec&controller=compdec&action=index">Voltar</a><br> <br> 
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>	
<script type="text/javascript">
    var itens = {
        data:
<?php print json_encode($municipios); ?>, // array com os dados

        getValue: "nome",

        list: {
            maxNumberOfElements: 15,
            match: {

                enabled: true
            },

            onSelectItemEvent: function () {
                var value = $("#txtMunicipio").getSelectedItemData().id_municipio;

                $("#txtIdMunicipio").val(value);
                //$("#txtIdComunidadeSearch").val(value).trigger("change");

            }

        }

    };

    $("#txtMunicipio").easyAutocomplete(itens);
    
    $('[name="sel_rdc"]').change(function () {

        var dados = {
            "btnEnviar": "rpm",
            "rpm": $(this).val(),
            "id_municipio": $("#txtId_municipio").val(),

        };

        $.ajax({
            url: 'mod_compdec/backEnd/View/compdec/status.php',
            type: 'POST',
            data: dados,
            success: function (response) {
                //console.log(response);
                if (response == true) {
                    //console.log(dados);	
                    alert("Procedimento realizado com Sucesso !");
                }
            }
        });

    });

    $("#selCompdec").change(function () {

        var dados = {
            "btnEnviar": "gravar",
            "status": $("#selCompdec").val(),
            "id_municipio": $("#txtId_municipio").val(),

        };

        $.ajax({
            url: 'mod_compdec/backEnd/View/compdec/status.php',
            type: 'POST',
            data: dados,
            success: function (response) {
                console.log(response);
                if (response == true) {
                    //console.log(dados);	
                    alert("Procedimento realizado com Sucesso !");
                }
            }
        });

    });


    $("#ck_PMDA").click(function () {

        var acesso = ($("#ck_PMDA").is(':checked')) ? 1 : 0;

        var dados = {
            "btnEnviar": "pmda",
            "modulo": "mod_pipa",
            "id_municipio": $("#txtId_municipio").val(),
            "acesso": acesso,
        };

        $.ajax({
            url: 'mod_compdec/backEnd/View/compdec/status.php',
            type: 'POST',
            data: dados,
            success: function (response) {
                if (response == true) {
                    alert("Procedimento realizado com Sucesso !");
                }
            }
        });



    });

    $("#ck_AJUDA").click(function () {

        var acesso = ($("#ck_AJUDA").is(':checked')) ? 1 : 0;
        var dados = {
            "btnEnviar": "ajuda",
            "modulo": "mod_ajuda",
            "id_municipio": $("#txtId_municipio").val(),
            "acesso": acesso,
        };

        $.ajax({
            url: 'mod_compdec/backEnd/View/compdec/status.php',
            type: 'POST',
            data: dados,
            success: function (response) {
                console.log(response);
                if (response == true) {
                    //console.log(dados);	
                    alert("Procedimento realizado com Sucesso !");
                }
            }
        });


    });

</script>