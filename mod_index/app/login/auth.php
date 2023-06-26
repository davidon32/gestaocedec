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

var_dump($usuario);
if (is_null($usuario['cpf'])) {

    //modal colocar o cpf;
}
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Salvar</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    
    $(document).ready(function(){
      
       var cpf = '<?=$usuario['cpf']?>';
       
       if(cpf.length == 0){
           $('#myModal').modal('show');
           $('#cpf').focus();
        }
        
        $('#cpf').keyup(function(){
            $('#cpf').val($('#cpf').val().replace(/\D/g, ""));
        });
        
    });


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

