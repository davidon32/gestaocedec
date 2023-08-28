<?php include_once "template/page/headerPageSimples.php"; ?>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php
include_once "template/page/rodapePage.php";

$user = Usuario::getUserData($_COOKIE['seguranca']);



if (isset($user['email_rec'])) {
    $email = $user['email_rec'];
}


$routeList = [
    "paebm" => 'drrd',
];

$actionApi = isset($_GET['action']) ? $_GET['action'] : "index";

$route = $routeList[$actionApi];

?>

<div class="modal fade" tabindex="-1" role="dialog" id="myModal" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title">Atualização Necessária</h4>
            </div>
            <div class="modal-body">
                <p class="alert alert-danger bold">Você será direcionado a nova plataforma do SDC !</p>

                <p>Gentileza informar o CPF do Coordenador ! (sem pontos somente os numeros )</p>
                <input type="text" name="cpf" id="cpf" maxlength="11" class="form form-control">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnSalvar">Salvar</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    $(document).ready(function () {

        var cpf = '<?= $user['cpf'] ?>';

        if (cpf.length === 0) {
            $('#myModal').modal('show');

        } else {
            autentica();
        }

        $('#cpf').keyup(function () {
            $('#cpf').val($('#cpf').val().replace(/\D/g, ""));
        });

        /* salvar cpf banco*/
        $("#btnSalvar").click(function () {

            $.ajax({
                type: "POST",
                url: '/mod_index/app/login/valida.php',
                data: {
                    cpf: cpf,
                    id_usuario: '<?= $_COOKIE['seguranca']['idUser'] ?>',
                    email: '<?= $email ?>',
                    opcao: 'updateCPF'
                },
                success: function (e) {
                    console.log(e);
                    if (e === 'true') {
                        //autentica();
                    }
                }
            });
        });





    });

    /*tenta autentica e se sucesso atualia o token */
    function autentica() {
    
    
        var route = '<?= $route ?>';
        
        $.ajax({
            type: "POST",
            url: 'https://sdcmg.com.br/api/auth/login',
            //url: 'http://localhost:8081/api/auth/login',
            //url: 'http://localhost:8081/public/api/auth/login',
            //url: 'http://localhost:8081/sdclaravel/public/autentica/'//$user['token'] ?>',
            data: {
                token: '<?= $user['token'] ?>',
                cpf: '<?= $user['cpf'] ?>',
                password: '12345678',
                email: '<?= $email ?>',
                route: route,
            },
            success: function (e) {
                console.log(e);
                
                var routeInicio = '<?=$routeInicio?>';
                if (e.data.result === true) {
                    var token = e.data.token.plainTextToken;
                    window.location.href = 'http://localhost:8081/public/'+route+'?token='+token+'&routeInicio='+routeInicio;
                } else {
                    console.log('erro login na api !');

                }



            }
        });
    }




</script>

