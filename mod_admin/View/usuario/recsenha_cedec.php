<?php
include_once "mod_equipe/Model/indexModel.php";
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
    
    $usuarios = $usuario->dadosSelectUsuario();

    $_funcaoBase = new FuncaoBase();

    $helper = new Html();

    $enviaEmail = new Email();

    $_funcionario = new EquipeFuncionario();

    $municipio = new Municipio();
    ?>

    <br>
    <br>
    <br>
    <legend class="">Recuperação de Senha </legend>
    <br>
    <?php
    $helper->form(FuncaoBase::geraLink("admin", "admin", "recSenhaEsqueci", array('externo'=>md5('externo'))), "POST", "resSenha", "");

    $helper->input("text", "usuario", "Nome do Usuario", false, array('class' => 'form-control'));
    print "<br>";
    $helper->input("text", "email", "O sistema enviará Email Recuperação Senha para :", array('readonly'=>'readonly'), array('class' => 'form-control'));
    
    $helper->input("hidden", "id_usuario", "id_usuario", false);

        print "<br>";
    $helper->formEnd("Resetar");
    
    print "<br>";
    print <<<MSG
    <h4 class='msg'>:: ATENÇÃO ::</h4>
    <p class='alert alert-danger msg'>Você, <b>Servidor da CEDEC/MG</b>, receberá um email com um link para fazer a troca de senha, esse link terá validade de <b>4 horas</b>.</p>
    <p class='alert alert-danger msg'>Após expirar o tempo de alteração da senha você, <b>Servidor da CEDEC/MG</b>, deverá refazer o processo de recuperação de senha !</p>
MSG;

    $email = isset($_POST['txtUsuario']) ? $_POST['txtUsuario'] : false;
    $btnEnviar = isset($_POST['btnResetar']) ? true : false;


    ?>
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
        
        $(".msg").hide();


        var itens = {
            data:
<?php print json_encode($usuarios); ?>, // array com os dados

            getValue: "nome",

            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var value = $("#txtUsuario").getSelectedItemData().nome;
                    var id = $("#txtUsuario").getSelectedItemData().id_usuario;
                    var email = $("#txtUsuario").getSelectedItemData().email_rec;
                    
                    console.log(email);
                    if(typeof email == "undefined" || email == null){
                        email = 'não existe email para recuperação de senha na base de dados, favor entrar em contato com o suporte !';
                    }
                    
                    $("#txtUsuario").val(value);
                    $("#txtId_usuario").val(id);
                    $("#txtEmail").val(email);
                    
                    $(".msg").show();

                }
            }

        };

        $("#txtUsuario").easyAutocomplete(itens);

    });
</script>
