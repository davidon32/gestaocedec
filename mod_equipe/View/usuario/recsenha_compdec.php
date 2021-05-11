<?php include_once "mod_equipe/Model/indexModel.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';
?>
<?php include_once "template/page/headerPageSimples.php"; ?>
<style>
    #div-icon{
        display: none;
    }
</style>
<div style="width:600px; margin:0 auto;" class="fix-altura">
    <?php
    $sistema = isset($_SESSION['seguranca']['id_municipio']) ? true : false;

    $usuario = new Usuario();

    $_funcaoBase = new FuncaoBase();

    $helper = new Html();

    $enviaEmail = new Email();

    $_funcionario = new EquipeFuncionario();

    $municipio = new Municipio();
    ?>

    <br>
    <br>
    <br>
    <legend class="">Recuperação de Senha COMPDEC</legend>
    <br>
    <?php
    $helper->form(FuncaoBase::geraLink("equipe", "usuario", "recsenha_compdec"), "POST", "resSenha", "" );
    $helper->input("text", "municipio", "", false, array('class' => 'form-control'));
    $helper->input("hidden", "id_municipio", "", false, false);

    print "<br>";
    $helper->formEnd("resetar");

    $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : false;
    $nomeMun = isset($_POST['txtMunicipio']) ? $_POST['txtMunicipio'] : false;
    $btnEnviar = isset($_POST['btnResetar']) ? true : false;
    
    print <<<MSG
    <h4 class='msg'>:: ATENÇÃO ::</h4>
    <p class='alert alert-danger msg'>Você, <b>COORDENADOR MUNICIPAL DE PROTEÇÃO E DEFESA CIVIL</b>, receberá um email com um link para fazer a troca de senha, esse link terá validade de <b>4 horas</b>.</p>
    <p class='alert alert-danger msg'>Após expirar o tempo de alteração da senha você, <b>COORDENADOR MUNICIPAL DE PROTEÇÃO E DEFESA CIVIL</b>, deverá refazer o processo de recuperação de senha !</p>
MSG;
    ?>	
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<?php
$municipio = new Municipio();
$municipios = $municipio->dadosSelectMunicipio();
?>

<script>
    $(document).ready(function () {

        var itens = {
            data:
<?php print json_encode($municipios); ?>, // array com os dados

            getValue: "nome",

            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var value = $("#txtMunicipio").getSelectedItemData().id_municipio;
                    var id = $("#txtMunicipio").getSelectedItemData().id_municipio;

console.log(id);
                    //$("#txtMunicipio").val(value);
                    $("#txtId_municipio").val(id);
                }

            }

        };

        $("#txtMunicipio").easyAutocomplete(itens);

    });
</script>
