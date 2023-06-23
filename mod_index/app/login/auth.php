


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php
include_once "template/page/rodapePage.php";

$usuario = Usuario::getCpfEmail($_COOKIE['seguranca']['idUser']);

var_dump($usuario);
if(is_null($usuario['cpf'])){
    
    //modal colocar o cpf;
    
    
    
    
    
    
}




?>
<script>


    $.ajax({
        type: "POST",
        /*url: 'http://localhost/api/autentica',*/
        url: '/er',

        data: {
            token: '<?= $usuario['token'] ?>',
            cpf: '<?= $usuario['cpf'] ?>',
            email: '<?= $usuario['email_rec'] ?>'
        },
        success: function (e) {
            $.ajax({
                type: "POST",
                url: '/mod_index/app/login/valida.php',
                data: {
                    cpf: '<?= $usuario['cpf'] ?>',
                    email: '<?= $usuario['email_rec'] ?>',
                    opcao: 'updateToken'
                },
                success: function (e) {
                    console.log();
                }
            });

        }
    });




</script>

