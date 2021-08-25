<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_equipe/Model/indexModel.php"; ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= VERSAO; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="template/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="template/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="template/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="template/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="template/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <?php
    $param = isset($_GET[md5('use70')]) ? $_GET[md5('use70')] : "";

    $usuario = new Usuario();

    if (isset($param[md5('use70')])) {
        $dados = $usuario->getResetUsuario($param);
        $dataBanco = new DateTime();
        $dataBanco->setTimestamp($data);
        //echo "Data Banco ".$dataBanco->format('d/m/Y H:i:s')."<br>";

        $expira = new DateTime();
        $expira->setTimestamp($data);
        $expira->modify('+4 hours');
        $expira->getTimestamp();
        //print "Data Prazo Expira " .$expira->format('d/m/Y H:i:s')."<br>";

        $agora = new DateTime();
        $agora->getTimestamp();
        echo "Data agora " . $agora->format('d/m/Y H:i:s') . "<br>";

        print "<br>";
    }

    if (isset($param[md5('use70')]) && (isset($dados))) {

        if (isset($dados['reset'])) {
            if ($agora <= $expira) {
                //print "nahora";
            } else {
                print "<script>";
                print "alert('Link Expirado !');";
                print "window.location.href ='" . FuncaoBase::geraLink("index", "index", "index") . "'";
                print "</script>";
            }
        }
    } else {
        ?>
        <br>
        <br>
        <div style="width:600px; margin:0 auto;">

            <legend>Troca de Senha Usuario<span style="color: red"<b> CEDEC</b></span></legend>

            <form action="#" method="POST" name="frm_trocasenha">

                <label>Senha Nova (Criar Nova Senha)</label>
                <input type="password" name="senha_nova" id="senha_nova" placeholder="Máximo de 15 caracteres"  class="form-control" maxlength="15">
                <br>
                <label>Confirmar Nova Senha</label>
                <input type="password" name="conf_senha_nova" id="conf_senha_nova" placeholder="Máximo de 15 caracteres"  class="form-control" maxlength="15">
                <input type="hidden" name="txtExterno" id="txtExterno" value="<?= isset($_GET['p']) ? $_GET['p'] : ""; ?>" >
                <br />
                <button type="submit" class="btn btn-primary" name="btn_trocasenha" id="btn_trocasenha" value="trocar">Trocar Senha</button>
                <?= FuncaoBase::voltar(false, FuncaoBase::geraLink("index", "index", "index")); ?>
            </form>
        </div>
        <?php
        $senha_nova = isset($_POST['senha_nova']) ? trim($_POST['senha_nova']) : "";
        $envia_troca = isset($_POST['btn_trocasenha']) ? $_POST['btn_trocasenha'] : "";
        $externo = isset($_POST['txtExterno']) ? $_POST['txtExterno'] : "";
        //$hashReset = isset($param) ? $_POST['hashReset'] :"";

        $login = Usuario::getUsuarioHash($param);
        
        //$login = (empty($externo) ? buscaLoginReset())

        $campo = array("Senha Nova" => $senha_nova);

        if ($envia_troca == "trocar") {

            # troca de senha via link 
            if (empty($externo)) {

                $campo_branco = FuncaoBase::CampoBranco($campo);

                if ($campo_branco) {
                    $_login = new Login();

                    if ($_login->TrocaSenha($login, $senha_nova)) {

                        print "<script type='text/javascript'>";

                        print "alert('Troca de Senha Realizada Com Sucesso !');";

                        print "window.location.href='index.php';";

                        print "</script>";
                    }
                }
            } else { # resetar usuario via admin

                $campo_branco = FuncaoBase::CampoBranco($campo);

                if ($campo_branco) {
                    $_login = new Login();

                    if ($_login->TrocaSenha($_COOKIE['seguranca']['login'], $senha_nova)) {

                        print "<script type='text/javascript'>";

                        print "alert('Troca de Senha Realizada Com Sucesso !');";

                        print "window.location.href='index.php';";

                        print "</script>";
                    }
                }
            }
        }
    }
    ?>
    <!-- jQuery 3 -->
    <script src="template/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="template/plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            $("#btn_trocasenha").hover(function () {

                if (($("#senha_nova").val() == "") || ($("#senha_antiga").val() == "")) {
                    alert("Favor preencher os campos Senha");
                } else if ($("#senha_nova").val() != $("#conf_senha_nova").val()) {
                    alert("As senhas nao conferem !");
                } else {
                }
            });
        });

    </script>
</html>