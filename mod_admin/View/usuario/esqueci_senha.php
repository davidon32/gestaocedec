<?php
include_once "mod_equipe/Model/indexModel.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';
?>
<?php include_once "template/page/headerPageSimples.php"; ?>
<style>
    #div-icon{
        display: none;
    }

    label {
        font-size: 15pt;
        color: blue;
    }
</style>
<div style="width:600px; height: 800px; margin:0 auto;">
    <?php
    $sistema = isset($_SESSION['seguranca']['id_municipio']) ? true : false;


    $_funcaoBase = new FuncaoBase();

    $helper = new Html();

    $enviaEmail = new Email();

    $_funcionario = new EquipeFuncionario();

    $municipio = new Municipio();
    ?>

    <br>
    <br>
    <br>
    <form action="" method="POST" id="frmTipoUsuario" name="frmTipoUsuario">
        <legend class="">Recuperação de Senha </legend>
        <br>
        <label>Qual tipo de Usuario voçê é ?</label>
        <select class="form form-control" id="selUser" name="selUser">
            <option value="recsenha_compdec">Coordenador Municipal</option>
            <option value="recsenha_cedec">CEDEC</option>
        </select>
        <br>
        <input class="btn btn-primary" type="submit" name="btnProsseguir" id="btnProsseguir" value="Prosseguir">

    </form>
    <?php ?>          

    <div class="col-md-12 text-center"><br><br>
        <a href="<?= FuncaoBase::geraLink("index", "index", "index") ?>" class="btn btn-success" name="lkvoltar" id="lkvoltar">Voltar</a>
    </div>

    <!-- =================== RODAPE CORPO ==================== -->
    <?php include_once "template/page/corpoRodape.php"; ?>
    <!-- =================== RODAPE  ======================== -->
    <?php include_once "template/page/rodape.php" ?>
    <?php include_once "template/page/barra_config_template.php"; ?>
    <!-- =============== HEADER HTML PAGE ================= -->
    <?php include_once "template/page/rodapePage.php"; ?>

    <script>

        $('document').ready(function () {
            
            var action = 'recsenha_compdec';
            var url = '/index.php?modulo=equipe&controller=usuario&action='+action;
            $('#frmTipoUsuario').attr('action', url);
            

            $("#selUser").change(function () {
      
                if($("#selUser").val() == 'recsenha_cedec'){
                    
                    url = '/index.php?<?=FuncaoBase::geraLink("admin", "admin", "recSenhaEsqueci", array('externo'=>md5('externo')))?>';
 
                }else if($("#selUser").val() == 'recsenha_compdec'){
                     
                    action = 'recsenha_compdec';
                    url = '/index.php?modulo=equipe&controller=usuario&action='+action;
                    
                }
                
                $('#frmTipoUsuario').attr('action', url);
           
            });


            // this is the id of the form
            /*$("#frmTipoUsuario").submit(function (e) {

                e.preventDefault(); // avoid to execute the actual submit of the form.

                var form = $(this);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function (data)
                    {
                        //  alert(data); // show response from the php script.
                    },
                    error: function(data){
                        alert(data);
                    }
                });


            });
*/
        });

    </script>
