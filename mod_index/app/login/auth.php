<?php include_once "template/page/headerPageSimples.php"; ?>

<style>
    .overlay1 {
        position: fixed;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: rgba(70,20,15,0.3);
        z-index: 2;
        background-image: url(https://i.stack.imgur.com/BNGOI.gif);
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 100px;
    }    
</style>

<!--<div class="overlay1"> <i class="fa fa-cog fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> </div>-->

<?php
$user = Usuario::getUserData($_COOKIE['seguranca']);
$cpf = isset($user['cpf']) ? $user['cpf'] : null;
$email = isset($user['email_rec']) ? $user['email_rec'] : null;


/* route sdclara */
$routeList = [
    "paebm" => 'drrd',
    "rat" => 'rat',
    "vistoria" => 'vistoria',
    "compdec" => 'compdec'
];

$actionApi = isset($_GET['action']) ? $_GET['action'] : "index";
$route = $routeList[$actionApi];
$url_redirect = '';
$token = '';

if ((is_null($cpf)) && (!is_numeric($cpf))) {
    ?>
    <!--<div class="modal fade" tabindex="-1" role="dialog" id="myModal" data-backdrop="static">-->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
    <!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title">Favor preencher o CPF do Usuário</h4>
            </div>
            <div class="modal-body">
                <p class="alert alert-danger bold">Após clicar no botão Salvar, Você será direcionado a nova plataforma do SDC !</p>

                <p>Gentileza informar o CPF do Coordenador ! (sem pontos somente os numeros )</p>
                <input type="text" name="cpf" id="cpf" maxlength="11" class="form form-control">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnSalvar">Salvar</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    <!--</div> /.modal -->

    <?php
    
} else {

    if ( ($_SERVER['HTTP_HOST'] == 'sistema.defesacivil.mg.gov.br') || ($_SERVER['HTTP_HOST'] == 'www.sistema.defesacivil.mg.gov.br') ){
        $url = 'https://sdcmg.com.br/api/auth/login';
        $url_redirect = 'https://sdcmg.com.br';
        $log_path = '/web/anexo/curl.log';
    } else {
        //var_dump($_SERVER['HTTP_HOST']);
        //die();
        $url = 'http://localhost:8081/api/auth/login';
        $url_redirect = 'http://localhost:8081';
        $log_path = 'log/curl.log';
    }

    $ch = curl_init();

    curl_setopt_array($ch, [
        //CURLOPT_URL => "https://sdcmg.com.br/api/auth/login", //Original
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_HTTPHEADER => [
            //'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'x-li-format: json'
        ],
        CURLOPT_POSTFIELDS => json_encode([
            'content' => [
                'cpf' => $cpf,
                'password' => 'cedecmg@new'
            ],
            'visibility' => [
                'code' => 'anyone'
            ]
        ]),
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
        CURLOPT_VERBOSE => true,
        CURLOPT_STDERR => fopen($log_path, 'w+') ,
    ]);

    $resultado = curl_exec($ch);

    if (curl_errno($ch)) {
        print "log: ".curl_error($ch);
    }

    curl_close($ch);

    $ret = json_decode($resultado);
    
    //var_dump($ret, $url, $cpf);

    $token = isset($ret->token->plainTextToken) ? $ret->token->plainTextToken : null;

    if (!is_null($token)) {

        print $token;
        print "<script>";
        print "window.location.href = '" . $url_redirect . '/' . $route . '?token=' . $token . '&routeInicio=' . $routeInicio . "'";
        print "</script>";
    } else {
        print "Ocorreu um erro";
        
        // enviar email com erro 
        $log_erro = file_get_contents($log_path, true);
    }
}
?>
<div style="height: 700px;">
</div>    
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {

        $(".overlay1").show();

        $('#cpf').keyup(function () {
            $('#cpf').val($('#cpf').val().replace(/\D/g, ""));
        });

        /* salvar cpf banco*/
        $("#btnSalvar").click(function () {

            var cpf = $("#cpf").val();

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
                    //print "opa";
                    window.location.href = '<?= $url_redirect . '/' . $route . '?token=' . $token . '&routeInicio=' . $routeInicio ?>';
                },
                error: function (e) {
                    console.log(cpf);
                }

            });
        });
    });

</script>


