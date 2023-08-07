<?php include_once "template/page/headerPageSimples.php"; ?>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php
include_once "template/page/rodapePage.php";

$usuario = Usuario::getCpfEmail($_COOKIE['seguranca']['idUser']);

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

        var cpf = '<?= $usuario['cpf'] ?>';

        if (cpf.length == 0) {
            $('#myModal').modal('show');
            $('#cpf').focus();
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
                    cpf: $('#cpf').val(),
                    id_usuario: '<?= $_COOKIE['seguranca']['idUser'] ?>',
                    opcao: 'updateCPF'
                },
                success: function (e) {
                    console.log(e);
                    if(e === 'true'){
                        //autentica();
                    }
                }
            });
        });



    });

    /*tenta autentica e se sucesso atualia o token */
    function autentica() {
        $.ajax({
            type: "POST",
            //url: 'http://localhost:8081/api/auth/login',
            url: 'http://localhost:8081/sdclaravel/public/autentica/<?= $usuario['token'] ?>',


            data: {
                token: '<?= $usuario['token'] ?>',
                cpf: '<?= $usuario['cpf'] ?>',
                password: '12345678',
                email: '<?= $usuario['email'] ?>',
                'url' : window.location.href
            },
            success: function (e) {
                console.log(e);
                window.location.href = 'http://localhost:8081/drrd';
//                $.ajax({
//                    type: "POST",
//                    url: '/mod_index/app/login/valida.php',
//                    data: {
//                        cpf: '<?= $usuario['cpf'] ?>',
//                        email: '<?= $usuario['email'] ?>',
//                        opcao: 'updateToken'
//                    },
//                    success: function (e) {
//                        console.log();
//                    }
//                });

            }
        });
    }




</script>

