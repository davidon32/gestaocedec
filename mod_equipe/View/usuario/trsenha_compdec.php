<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_equipe/Model/indexModel.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistema CEDEC - versão - 3.0 - 26.04.2019</title>
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
    <br>
    <br>
    <div style="width:600px; margin:0 auto;">

        <legend>Troca de Senha <span style="color:red; font-weight: bold">COMPDEC</span></legend>

        <form action="#" method="POST" name="frm_trocasenha">

            <label>Senha Nova (Criar Nova Senha)</label>
            <input type="password" name="senha_nova" id="senha_nova" placeholder="Máximo de 8 caracteres"  class="form-control">
            <br>
            <label>Confirmar Nova Senha</label>
            <input type="password" name="conf_senha_nova" id="conf_senha_nova" placeholder="Máximo de 8 caracteres"  class="form-control">
            <input type="hidden" name="txtExterno" id="txtExterno" value="<?= isset($_GET['p']) ? $_GET['p'] : ""; ?>" >
            <br />
            <button type="submit" class="btn btn-primary" name="btn_trocasenha" id="btn_trocasenha" value="trocar">Trocar Senha</button>
        </form>
    </div>
    <?php
    
    $usuario = new Usuario();
    
    # troca de senha via link email
    if (isset($_GET['res'])) {

        $param = $_GET['has'];
        $data = $param[md5('use70')];

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
        //echo "Data agora " .$agora->format('d/m/Y H:i:s')."<br>";

        print "<br>";

        
        $dados = $usuario->getResetUsuarioEx($data);
        
        if (isset($param[md5('use70')]) && (isset($dados))) {

            if (isset($dados['reset'])) {
                if ($agora <= $expira) {
                    print "<script>";
                    //print "window.location.href ='".FuncaoBase::geraLink("index", "index", "index")."'";
                    print "</script>";
                } else {
                    print "<script>";
                    print "alert('Link Expirado !');";
                    //print "window.location.href ='" . FuncaoBase::geraLink("index", "index", "index") . "'";
                    print "</script>";
                }
            } else {
                
            }
        } else {
            print "<script>";
            print "alert('Link Expirado !');";
            print "window.location.href ='" . FuncaoBase::geraLink("index", "index", "index") . "'";
            print "</script>";
        }
        
    # grava a troca de senha via (Administrador CEDEC) sistema.
    } else {

        $dados = $usuario->getDadosUsuarioEx($_COOKIE['seguranca']['idUser']);
        
    }
        
        $senha_antiga = isset($_POST['senha_antiga']) ? trim($_POST['senha_antiga']) : "";
        $senha_nova = isset($_POST['senha_nova']) ? trim($_POST['senha_nova']) : "";
        $envia_troca = isset($_POST['btn_trocasenha']) ? $_POST['btn_trocasenha'] : "";
        $externo = isset($_POST['txtExterno']) ? $_POST['txtExterno'] : "";

        $campo = array("Senha Nova" => $senha_nova);

        if ($envia_troca == "trocar") {

            #interno
            if (empty($externo)) {

                $campo_branco = FuncaoBase::CampoBranco($campo);

                if ($campo_branco) {

                    $_loginExt = new LoginExterno();

                    if ($_loginExt->TrocaSenha($dados['usuario'], $senha_nova )) {

                        print "<script type='text/javascript'>";

                        print "alert('Troca de Senha Realizada Com Sucesso !');";

                        print "window.location.href='index.php';";

                        print "</script>";
                    }
                }
            }
        } else {
            
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

                if ($("#senha_nova").val() != $("#conf_senha_nova").val()) {
                    alert("As senhas nao conferem !");
                }

            });



        });

    </script>
</body>
</html>