<?php
include_once "mod_equipe/Model/indexModel.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';
?>
<?php include_once "template/page/headerPageSimples.php"; ?>

<link href="plugins/select2/css/select2.min.css" rel="stylesheet" />
<link href="vendor/filepond/dist/filepond.min.css" rel="stylesheet" />

<?php
$municipios = Municipio::listaid_municipioAutocomplete();
?>
<style>
    #div-icon {
        display: none;
    }
</style>
<div style="width:700px; height: 900px; margin:0 auto;">

    <div class="col-md-12 text-center"><br><br>
        <a href="<?= FuncaoBase::geraLink("index", "index", "index") ?>" class="btn btn-success" name="lkvoltar" id="lkvoltar">Voltar</a>
    </div>
    <br>
    <br>
    <br>
    <form action="<?= FuncaoBase::geraLink("admin", "novoUser", "gravar") ?>" method="POST" id="frmNovoCadastro" name="frmNovoCadastro" enctype="multipart/form-data">
        <legend class="">Preencha o seu Cadastro</legend>
        <br>
        <label>Nome do Usuário :</label>
        <input class="form form-control" type="text" name="nome" id="nome" maxlength="50" required value="Demetrio da Silva teste">
        <br>
        <label>CPF :</label> <span>Formato: 999.999.999-99</span>
        <input class="form form-control" type="text" name="cpf" id="cpf" maxlength="14" required value="032.604.146-06">

        <br>
        <label>E-mail :</label>
        <input class="form form-control" type="email" name="email" id="email" maxlength="70" required value="teste@gmail.com">

        <br>
        <label>Telefone :</label> <span>Formato: (99)99999-9999</span><img src="/core/imagem/whatsapp.png" width="25">
        <input class="form form-control" type="text" name="cel" id="cel" maxlength="16" required value="(31)99999-9999">

        <br>
        <label>Carteira de Identidade :</label>
        <input class="form form-control" type="text" name="ci" id="ci" maxlength="70" required value="Mg10.118.418">
        
        <br>
        <label>Profissão :</label>
        <input class="form form-control" type="text" name="profissao" id="profissao" maxlength="70" value="Técnico">

        <br>
        <label>Cargo / Função executada na COMPDEC :</label>
        <select class="form form-control" name="cargo" id="cargo" required>
            <option value="">Selecione uma Função</option>
            <option value="Coordenador">Coordenador</option>
            <option value="Coordenador ">Membro da COMPDEC</option>
            <option value="Coordenador "></option>
                
        </select>

        <br>
        <label>Município :</label>
        <select class="js-example-basic-single form form-control" name="municipio" id="municipio" required>
            <option value="">Selecione seu Município</option>
            <?php
            foreach ($municipios as $municipio) {
                print "<option value='" . $municipio['id_municipio'] . "'>" . $municipio['nome'] . "</option>";
            }
            ?>


        </select>
        <br>
        <br>
        <a class="link-black" href="#">Clique aqui e baixe o Modelo do Ofício para o cadastro de novo Usuário do SDC </a>
        <br>
        <br>
        <label>Ofício de Solicitação de Cadastro :</label> <span style="color:red; font-weight: bold">( Tamanho Máximo 2MB )</span>
        <input id="max_id" type="hidden" name="MAX_FILE_SIZE" value="2097152" />
        <input type="file" onchange="upload_check()" class="form form-control" name="oficio" id="oficio" accept="application/pdf" required/><span id="msg"></span>



        <br>
        <input class="btn btn-primary" type="submit" name="btnEnviar" id="btnProsseguir" value="Enviar">

    </form>
    <?php ?>


    <!-- =================== RODAPE CORPO ==================== -->
    <?php include_once "template/page/corpoRodape.php"; ?>
    <!-- =================== RODAPE  ======================== -->
    <?php include_once "template/page/rodape.php" ?>
    <?php include_once "template/page/barra_config_template.php"; ?>
    <!-- =============== HEADER HTML PAGE ================= -->
    <?php include_once "template/page/rodapePage.php"; ?>


    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>


    <script src="vendor/filepond/dist/filepond.min.js"></script>
    <!-- include FilePond jQuery adapter -->
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <script>

        $('document').ready(function () {

            $('#msg').text("");

            $('.js-example-basic-single').select2();

            var itens = {
                data: <?php print json_encode($municipio); ?>, // array com os dados
                getValue: "nome",

                list: {
                    match: {
                        enabled: true
                    },

                    onSelectItemEvent: function () {
                        var value = $("#municipio").getSelectedItemData().nome;
                        var id = $("#municipio").getSelectedItemData().id_municipio;

                        $("#municipio_id").val(id);
                        $("#municipio").val(value);

                    }
                }

            };

            $("#municipio").easyAutocomplete(itens);

        });
        
        

        function upload_check()
        {
            var upl = document.getElementById("oficio");
            var max = document.getElementById("max_id").value;

            

            if (upl.files[0].size > max)
            {
                var tamanho = ((upl.files[0].size)/1024 /1000);
                
                $('#msg').text("Seu Arquivo está Grande ! "+tamanho.toFixed(2)+"MB");
                $('#msg').css('color', '#E54A4A');
                $('#msg').css('font-weight', 'bold');
                $('#msg').css('font-size', '15pt');
                
                $("#oficio").css('background-color','#E54A4A');
                $("#oficio").css('color','#ffffff');
                
                upl.value = "";
                
            }else {
                
            }
        }
        ;
    </script>