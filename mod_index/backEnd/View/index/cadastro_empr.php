<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";
?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php

//$empreendedores = "http://sdc.net:8081/api/pae_empdors";

$empreendedors = array(
    array(
        "id" => 1,
        "nome" => "AMG MINERAÇÃO",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 2,
        "nome" => "ANGLO AMERICAN",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 3,
        "nome" => "ANGLO GOLD ASHANTI",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 4,
        "nome" => "ARCELORMITTAL",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 5,
        "nome" => "AVG EMPREENDIMENTOS MINERÁRIOS",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 6,
        "nome" => "BRASIL EXPLORAÇÃO MINERAL - BEMISA/ GO4 PARTICIPAÇÕES",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 7,
        "nome" => "BRASMIC MINERAÇÃO AREIA E BRITA",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 8,
        "nome" => "BRAUMINAS MINERAÇÃO",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 9,
        "nome" => "BUNGE FERTILIZANTES S.A",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 10,
        "nome" => "COMPANHIA BRASILEIRA DE ALUMÍNIO - CBA",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 11,
        "nome" => "COMPANHIA BRASILEIRA DE METALURGIA E MINERAÇÃO - CBMM",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 12,
        "nome" => "COMPANHIA DE MINERAÇÃO SERRA AZUL - COMISA",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 13,
        "nome" => "COMPANHIA MINERADORA DO PIROCLORO DE ARAXÁ - COMIPA",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 14,
        "nome" => "COMPANHIA SIDERÚRGICA NACIONAL - CSN",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 15,
        "nome" => "EQUINOX GOLD",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 16,
        "nome" => "EXTRATIVA MINERAL",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 17,
        "nome" => "FERROUS",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 18,
        "nome" => "GALVANI - YARA",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 19,
        "nome" => "GERDAU AÇOMINAS",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 20,
        "nome" => "GRANHA LIGAS",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 21,
        "nome" => "HERCULANO MINERAÇÃO",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 22,
        "nome" => "HINDALCO DO BRASIL",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 23,
        "nome" => "INDÚSTRIAS NUCLEARES DO BRASIL - INB",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 24,
        "nome" => "ITAMINAS COMÉRCIO DE MINÉRIOS S.A",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 25,
        "nome" => "JAGUAR MINING/MSOL",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 26,
        "nome" => "KINROSS BRASIL MINERAÇÃO",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 27,
        "nome" => "LEAGOLD MINING/ EQUINOX GOLD",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 28,
        "nome" => "MATERIAIS BÁSICOS LTDA - MBL",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 29,
        "nome" => "MINERAÇÃO IBIRITÉ LTDA - MIB ",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 30,
        "nome" => "MINERAÇÃO MORRO DO IPÊ",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 31,
        "nome" => "MINERAÇÃO USIMINAS",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 32,
        "nome" => "MINÉRIOS ITAÚNA LTDA - MINERITA",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 33,
        "nome" => "MINÉRIOS NACIONAL - NAMISA",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 34,
        "nome" => "MOSAIC FERTILIZANTES",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 35,
        "nome" => "NACIONAL GRAFITE LTDA",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 36,
        "nome" => "NEXA RESOURCES - Nexa Recursos Minerais S.A",
        "updated_at" => "2024-04-29 09:57:02",
        "created_at" => NULL,
    ),
    array(
        "id" => 37,
        "nome" => "PETROBRÁS",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 38,
        "nome" => "SAFM MINERAÇÃO LTDA",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 39,
        "nome" => "SAINT-GOBAIN BRASIL",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 40,
        "nome" => "SAMARCO",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 41,
        "nome" => "VALE S.A",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 42,
        "nome" => "VALLOUREC",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 43,
        "nome" => "VOTORANTIN",
        "updated_at" => NULL,
        "created_at" => NULL,
    ),
    array(
        "id" => 44,
        "nome" => "CABRALT ESTE",
        "updated_at" => "2024-01-10 14:59:14",
        "created_at" => "2024-01-10 14:59:14",
    ),
    array(
        "id" => 45,
        "nome" => "Alcoa Aluminio S.A",
        "updated_at" => "2024-02-19 14:50:20",
        "created_at" => "2024-02-19 14:50:20",
    ),
    array(
        "id" => 46,
        "nome" => "ALCOA ALUMÍNIO S.A.",
        "updated_at" => "2024-02-29 15:56:49",
        "created_at" => "2024-02-29 15:56:49",
    ),
    array(
        "id" => 47,
        "nome" => "Brennand Energia",
        "updated_at" => "2024-03-07 11:27:59",
        "created_at" => "2024-03-07 11:27:59",
    ),
    array(
        "id" => 48,
        "nome" => "Mineração Geral do Brasil (MGB)",
        "updated_at" => "2024-04-18 10:53:50",
        "created_at" => "2024-04-18 10:53:50",
    ),
);

//$url = "http://sdc.net:8081/api/pae_empdors";
$url = "http://www.sdc.mg.gov.br/api/pae_empdors";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$emp = json_decode(curl_exec($ch));

if (curl_errno($ch)) {
    print "log: " . curl_error($ch);
}

//curl_close($ch);
//var_dump($emp);

?>

<div class="col-md-12 text-center">
    <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "userAtivo") ?>' class='btn btn-primary'>Voltar</a></p>
</div>


<div class="col-md-12">
    <legend>Cadastro Usuário Externo (Vinculado ao Empreendedor)</legend>
</div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-12">
        <form action="#" method="POST" name="frmPesquisa" id="frmPesquisa">
            <label>Empreendedor ( Mineradora )</label><br>

            <select name="selEmpreendedor" id="selEmpreendedor" class="form form-control">

                <option value="2">ANGLO</option>

                <?php
                foreach ($emp as $key => $empreendor) {
                    print "<option value='" . $empreendor->id . "'>" . $empreendor->nome . "</option>";
                }

                ?>

            </select>

            <label>CNPJ</label><br>
            <input type="text" class="form form-control" name="cnpj" id="cnpj" maxlength="18" required="required"><br>

            <!--<select class="js-data-example-ajax form form-control"></select>-->

            <label>Nome (Colaborador)</label><br>
            <input type="text" class="form form-control" name="nomeUser" id="nomeUser" required="required"><br>

            <label>CPF</label><br>
            <input type="text" class="form form-control" name="cpfUser" id="cpfUser" maxlength="14" required="required"><br>

            <label>E-mail</label><br>
            <input type="email" class="form form-control" name="emailUser" id="emailUser" maxlength="110" required="required"><br>

            <input type="submit" class="btn btn-success" name="btn" value="Salvar">
        </form>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="row">
</div>


</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>
    $('#cpfUser').mask("999.999.999-99");
    $('#cnpj').mask("99.999.999/9999-99");


    // var datas = "";
    // $('.js-data-example-ajax').select2({

    //     ajax: {
    //         data: datas,
    //         dataType: 'json'
    //         // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
    //     }
    // });
</script>