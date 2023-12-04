<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_admin/Model/admModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php
$usuario_gestao = Usuario::UsuarioCedecDados();

$usuario_externo = Usuario::UsuariocomdecDados();

//var_dump($usuario_externo[0]);

$userRpm = isset($_GET['user']) ? $_GET['user'] : "";


$log_path = '';

if (($_SERVER['HTTP_HOST'] == 'sistema.defesacivil.mg.gov.br') || ($_SERVER['HTTP_HOST'] == 'www.sistema.defesacivil.mg.gov.br')) {
    $url = 'http://sdc.mg.gov.br/api/auth/user';
    $url_ex = 'http://sdc.mg.gov.br/api/auth/userex';
    $log_path = '/web/anexo/curl.log';
} else {
    $url = 'http://sdc.net:8081/api/auth/user';
    $url_ex = 'http://sec.net:8081/api/auth/userex';
    $log_path = 'log/curl.log';
}


$api_data = array();

$api_data_ex = array();

$api = FuncaoBase::Api([
            'url' => $url,
            'post' => 0,
            'log_path' => $log_path,
        ]);

$api_ex = FuncaoBase::Api([
            'url' => $url_ex,
            'post' => 0,
            'log_path' => $log_path,
        ]);


if (isset($api) && !is_null($api) && is_array($api)) {
    $api_data = $api;
}

if (isset($api_ex) && !is_null($api_ex) && is_array($api_ex)) {
    $api_data_ex = $api_ex;
}

//var_dump($api_data_ex);
//die();
?>

<br>

<div class="row">

    <div class="col-md-12">

        <?php
        if (empty($userRpm)) {
            ?>

            <!-- USUARIOS CEDEC-->
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID_USUARIO</th>
                        <th>NOME</th>
                        <th>CPF</th>
                        <th>EMAIL_REC</th>
                        <th>ID_USER_CEDEC</th>
                        <th>CPF_LARA</th>
                        <th>EMAIL_LARA</th>
                    </tr>
                </thead>
                <tbody>

    <?php
    foreach ($usuario_gestao as $key => $value) {

        if (!is_null($api['data'])) {
            if (!is_null($value['cpf'])) {
                $ret_key = array_search($value['cpf'], array_column($api_data['data'], 'cpf'));
            } else {
                $ret_key = null;
            }
        }
        $id_user_cedec = '';
        $cpf = '';
        $email = '';

        $style = '';

        if (!is_null($ret_key)) {


            if ($value['id_usuario'] != $api['data'][$ret_key]['id_user_cedec']) {
                $style = "style='color:#FFFFFF;background-color:#D35400;white-space: nowrap'";
            } else {
                $style = "style='white-space: nowrap'";
            }


            $id_user_cedec = $api['data'][$ret_key]['id_user_cedec'];
            $cpf = $api['data'][$ret_key]['cpf'];
            $email = $api['data'][$ret_key]['email'];
        } else {
            $id_user_cedec = '-';
            $cpf = '-';
            $email = '-';
        }

        print "<tr>";
        print "<td {$style} >" . ($key + 1) . "</td>";
        print "<td {$style} >" . $value['id_usuario'] . "</td>";
        print "<td {$style} >" . Usuario::getNomeId($value['id_usuario']) . "</td>";
        print "<td {$style} >" . $value['cpf'] . "</td>";
        print "<td {$style} >" . $value['email_rec'] . "</td>";

        print "<td {$style} >" . $id_user_cedec . "</td>";
        print "<td {$style} >" . $cpf . "</td>";
        print "<td {$style} >" . $email . "</td>";

        print "</tr>";
    }
    ?>

                </tbody>
            </table>

    <?php
}
?>

        <!-- USUARIOS compdec-->
        <legend>LISTA DE USUARIOS COMPDEC</legend>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID_USUARIO</th>
                    <th>NOME</th>
                    <th>RPM_CEDEC</th>
                    <th>CPF</th>
                    <th>EMAIL_REC</th>
                    <th>ID_USER_CEDEC</th>
                    <th>CPF_LARA</th>
                    <th>EMAIL_LARA</th>
                </tr>
            </thead>
            <tbody>

<?php
foreach ($usuario_externo as $key => $value) {

    if (!is_null($api_ex['data_compdec'])) {
        if (!is_null($value['cpf'])) {
            $ret_key = array_search($value['cpf'], array_column($api_data_ex['data_compdec'], 'cpf'));
        } else {
            $ret_key = null;
        }
    }
    $id_user_cedec_comp = '';
    $cpf_comp = '';
    $email_comp = '';

    $style = '';

    //var_dump($ret_key);
    if (!is_null($ret_key)) {


        if ($value['id'] != $api_ex['data_compdec'][$ret_key]['id_user_cedec']) {
            $style = "style='color:#FFFFFF;background-color:#D35400'";
        } else {
            $style = "style='background-color:#DDF66E'";
        }


        $id_user_cedec_comp = $api_ex['data_compdec'][$ret_key]['id_user_cedec'];
        $cpf_comp = $api_ex['data_compdec'][$ret_key]['cpf'];
        $email_comp = $api_ex['data_compdec'][$ret_key]['email'];
    } else {
        $id_user_cedec_comp = '-';
        $cpf_comp = '-';
        $email_comp = '-';
    }



    print "<tr>";
    print "<td {$style} >" . ($key + 1) . "</td>";
    print "<td {$style} >" . $value['id'] . "</td>";
    print "<td {$style} >" . Usuario::getUserExNomeId($value['id'])['nome_municipio'] . "</td>";
    print "<td {$style} >" . Usuario::getUserExNomeId($value['id'])['rpm'] . "</td>";
    print "<td {$style} >" . (empty($value['cpf']) ? "<span style='color:red'>sem CPF</span>" : substr($value['cpf'], 0, 4) . "******") . "</td>";
    print "<td {$style} >" . $value['email_rec'] . "</td>";

    print "<td {$style} >" . $id_user_cedec_comp . "</td>";
    print "<td {$style} >" . (empty($cpf_comp) ? "<span style='color:red'>sem CPF</span>" : substr($cpf_comp, 0, 4) . "******") . "</td>";
    print "<td {$style} >" . $email_comp . "</td>";

    print "</tr>";
}
?>

            </tbody>
        </table>


    </div>


</div>



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
