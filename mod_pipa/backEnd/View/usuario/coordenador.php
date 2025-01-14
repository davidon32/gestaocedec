<?php include_once "core/Model/indexModel.php" ?>
<?php include_once "mod_pipa/Model/IndexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php

$id_equipe = isset($_GET['id']) ? $_GET['id'] : "";

$id_municipio = isset($_GET['mun']) ? $_GET['mun'] : "";;

$nome_municipio = Municipio::PegaNomeMunicipio($id_municipio);

if($id_equipe != "") {
    $membro_compdec = MembroEqCompdec::buscaMembro($id_equipe);
    $funcao = "update";
    $readonly = "readonly='readonly'";
}else {
    $funcao = "novo";
    $membro_compdec = [
        'cpf' => "",
        'id_equipe' => "",
        'id_municipio' => "",
        'nome' => "",
        'telefone' => "",
        'celular' => "",
        'email' => "",
        'id_municipio' => "",
    ];
    $readonly = '';
}

    $municipios = Municipio::dadosSelectMunicipio();
?>


<form class="form-horizontal" action="<?= FuncaoBase::geraLink("compdec", "compdec", "storeCoordenador") ?>" method="POST" id="cadUserEx" name="frm" lang='pt-Br'> 


    <!-- Form Name -->
    <legend>Dados do Coordenador - <i style="color:blue; font-weight: bolder"><?= $nome_municipio ?></i>  </legend>

    <a id="btnNovo" href="<?=FuncaoBase::geraLink('compdec', 'compdec', 'alterarCoordenador', array('mun' => $id_municipio))?>" class="btn btn-warning">* Novo Registro</a>
    <br>
    <div class="row">
        
        <div class="col-md-12">

            <br>
            <label>Município</label>
            <input class="form-control" type="hidden" name="id_municipio" id="id_municipio" required value="<?= $id_municipio ?>" readonly>               
            <input class="form-control" type="text" name="nome_municipio" id="nome_municipio" required value="<?= $nome_municipio ?>" readonly>               
           
            <br>
            <input class="form-control" type="hidden" name="id_equipe" id="id_equipe" required maxlength="4" value="<?= $membro_compdec['id_equipe'] ?>">               
            <input class="form-control" type="hidden" name="funcao" id="funcao" value="<?=$funcao?>" required maxlength="6" readonly='readonly'>               

            <label>CPF do Coordenador <span style='color:red'>( não é possível alterar o CPF, para mudança do Coordenador será necessário cadastrar um novo )</span></label>:
            <input class="form-control" type="text" name="cpfCoord" id="cpfCoord" required maxlength="14" value="<?= $membro_compdec['cpf'] ?>" $readonly>

            <br>
            <label>Nome Coordenador</label>:
            <input class="form-control" type="text" name="nome" id="nome" required maxlength="50" value="<?= $membro_compdec['nome'] ?>">

           <br>
            <label>Telefone Coordenador</label>:
            <input class="form form-control" type="text" name="tel" id="tel" maxlength="16" required value="<?= $membro_compdec['telefone'] ?>" >

            <br>
            <label>Celular Coordenador</label>:
            <input class="form-control" type="text" name="cel" id="cel" maxlength="16" required value="<?= $membro_compdec['celular'] ?>" >

            <br>
            <label>E-mail Coordenador</label>:
            <input class="form-control" type="mail" name="email" id="email" maxlength="100" required value="<?= $membro_compdec['email'] ?>" >


        </div>
      
                            
    </div>



<!-- Button -->
<div class="control-group">
    <label class="control-label" for="singlebutton"></label>
    <div class="controls">
        <button id="btnAtua" name="btnAtua" class="btn btn-primary" id="btnAtua" value="btnAtua">Gravar / Salvar</button>
    </div>
</div>


</form>

<br>
<div class="col-md-12 text-center">
    <?php
    if (isset($_GET['volta']) == 'compdec') {
        print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("pipa", "pipa", "pesquisaUsuario", array('volta' => 'compdec')) . "\">Voltar</a></div>";
    } else {
        print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("pipa", "pipa", "pesquisaUsuario") . "\">Voltar</a></div>";
    }
    ?>

</div>

</div>       
</div> 
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>

<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>

<?php include_once "template/page/barra_config_template.php"; ?>

<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>

<script type="text/javascript">

    $(document).ready(function () {

        $('.js-example-basic-single').select2();
        $('#btnAtua').hover(function () {


            var cpf_coord_atual  = $("#cpf_atual").val();
            var cpf_coord  = $("#cpfCoord").val();
            var nome_atual = $("#nomeCoordAtual").val();
            var nome_coord = $("#nomeCoord").val();
            
            var cpf_novo = cpf_coord.replaceAll('.',"").replace('-',"");
            var cpf_atual = cpf_coord_atual.replaceAll('.',"").replace('-',"");
        

            if (cpf_atual !== cpf_novo && nome_atual === nome_coord) {

                Swal.fire({
                    title: "<h3>Para mudar o Coordenador do COMPDEC é,<br> necessário que o nome também seja mudado !</h3>",
                    width: 600,
                    icon: "info",
                });

            } else {

                if (cpf_atual != cpf_novo) {
                    Swal.fire({
                        title: "<strong>Prezado Usuário,</strong>",
                        icon: "info",
                        width: 600,
                        html: `<h3>Ao realizar a alteração do <b>CPF<b/> do Coordenador <br>
                            O sistema cadastrará um novo coordenador</h3><br><h3>Clique em confirmar para aceitar o novo cadastro</h3>`,
                        showCloseButton: true,
                        showCancelButton: true,
                        confirmButtonText: "Confirmar",
                        focusConfirm: false,
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        console.log(result);
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            //Swal.fire("Saved!", "", "success");
                            $('#btnAtua').trigger("click");
                        } else if (result.isDismissed) {
                            Swal.fire("Ação Cancelada !", "", "info");
                        }
                    });
                }
            }

//            alert("-");


        });


        //$("#senha").val("");

        $('#cpfCoord').mask("999.999.999-99");
        $('#cpf').mask("999.999.999-99");

        $("#cadUserEx").validate();

        /* email recuperacao em branco*/
        if ($("#email_rec").val() == "") {
            $("#email_branco").show();
        } else {
            $("#email_branco").hide();
        }



        $("#email_rec").blur(function () {

            var email = $("#email_rec").val();

            /*if (
             (email.indexOf('yahoo') > 0) ||
             (email.indexOf('live') > 0) ||
             (email.indexOf('bol') > 0) ||
             (email.indexOf('hotmail') > 0)
             ) {
             $("#email_rec").css('background-color', 'red');
             $("#email_rec").css('color', 'white');
             $("#btnAtua").attr("disabled", true);
             } else {
             $("#email_rec").css('background-color', '#fff');
             $("#email_rec").css('color', 'black');
             $("#btnAtua").attr("disabled", false);
             $("#email_branco").hide();
             }*/

        });

        $("#ck_compdec").click(function () {
            if ($("#ck_compdec").is(':checked')) {
                $("#ck_compdec").attr('value', '1');
            }
        });
        $("#ck_pmda").click(function () {
            if ($("#ck_pmda").is(':checked')) {
                $("#ck_pmda").attr('value', '1');
            }
        });
        $("#ck_ajuda").click(function () {
            if ($("#ck_ajuda").is(':checked')) {
                $("#ck_ajuda").attr('value', '1');
            }
        });

        $("#ckReset").click(function () {

            if ($("#ckReset").is(":checked")) {
                $("#senha").val("<?= md5('defesa199'); ?>");
                $("#trSenha").val("1");
            } else {
                //$("#senha").val("");
                $("#trSenha").val("0");
                alert('Você não resetou a senha, deseja continuar !');
            }
        });

        $("#email_rec").blur(function () {
            if ($("#email_rec").val() != "") {
                $("#btnAtua").removeProp("disabled", "disabled");
            }

        });

    });

    /* ajuda com informações do usuário */
    function openInfo() {
        Swal.fire({
            title: "Instruções",
            html: `<p>1) Atualização de E-mail de Recuperação de Senha :</p>
                <img src='/core/imagem/ajuda_atualizacao_senha.png'>`,
            width: 700
        });
    }
    
    /* ajuda com informações do coordenador*/
    function openInfo1() {
        Swal.fire({
            title: "Instruções",
            html: `<p>1) Atualização / Troca de Coordenador :</p>
                <img src='/core/imagem/ajuda_troca_coordenador_dc.png'>`,
            imageWidth: 800,
            width: 800
        });
    }

</script>
