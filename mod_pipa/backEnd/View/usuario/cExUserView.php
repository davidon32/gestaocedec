<?php include_once "core/Model/indexModel.php" ?>
<?php include_once "mod_pipa/Model/IndexModel.php"; ?>
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
$dados = Usuario::buscaUsuarioId($_GET['id']);




$membro_compdec = MembroEqCompdec::getMembro($dados);

//var_dump($membro_compdec, $dados);

if (!$membro_compdec) {
    $membro_compdec = [
        'cpf' => "",
        'id_equipe' => "",
        'id_municipio' => "",
        'nome' => "",
        'telefone' => "",
        'celular' => "",
        'email' => "",
        'id_municipio' => $dados['id_municipio'],
    ];
}

?>


<form class="form-horizontal" action="<?= FuncaoBase::geraLink("pipa", "pipa", "resetarSenha") ?>" method="POST" id="cadUserEx" name="frm" lang='pt-Br'>


    <!-- Form Name -->
    <legend>Alteração / Ativação Senha de Acesso - <i style="color:blue; font-weight: bolder"><?= $dados['usuario'] ?></i> </legend>
    <div class="row">
        <div class="col">
            <p class="text-center"><a onclick="openInfo()"> Necessita de Ajuda <img src="/core/imagem/help.png" width="30"></a></p>
        </div>

        <div class="col">
            <legend>Dados do Usuário</legend>
            <label class="" for="textinput">Login Usuário:</label>

            <input id="textUsuario" name="textUsuario" type="text" value="<?= $dados['usuario'] ?>" class="form-control " readonly="readonly">
            <input id="id_municipio" name="id_municipio" type="hidden" value="<?= $dados['id_municipio'] ?>" class="form-control " readonly="readonly">
            <input id="id_usuario" name="id_usuario" type="hidden" value="<?= $dados['id'] ?>">
            
            <input id="funcao" name="funcao" type="hidden" value="reset">

            <input id="ck_pmda" name="ck_pmda" type="hidden" value="<?= $dados['mod_pipa'] ?>">
            <input id="ck_ajuda" name="ck_ajuda" type="hidden" value="<?= $dados['mod_ajuda'] ?>">
            <input id="ck_compdec" name="ck_compdec" type="hidden" value="<?= $dados['mod_compdec'] ?>">

            <br>
            <label class="" for="textinput">Email login / Recuperar Senha</label>: <small>(email institucional ex. nomemunicipio@municipio.mg.gov.br)</small>
            <input id="email_rec" name="email_rec" type="email" value="<?= $dados['email_rec']; ?>" class="form-control">

            <br>
            <label class="" for="textinput">CPF</label>: <small>CPF do Usuário</small>
            <input id="cpf" name="cpf" type="text" value="<?= $dados['cpf']; ?>" class="form-control">

            <br>
            <span class="alert alert-danger" id="email_branco" style="font-size:12px;">* Email não pode ficar em branco, pois o mesmo é usado para a recuperação de senha </span>

            <label class="" for="passwordinput">Situação do Cadastro</label>:
            <select name="txtSituacao" id="txtSituacao" class="form-control">
                <option><?= $dados['situacao']; ?></option>
                <option>ATIVADO</option>
                <option>DESATIVADO</option>
                <option>CADASTRO_RECUSADO</option>
            </select>

            <br>
            <input id="senha" name="senha" type="hidden" value="<?= $dados['senha'] ?>" class="form-control" readonly="readonly">
            <input id="trSenha" name="trSenha" type="hidden" value="0">
            <br>
            <input type="checkbox" id="ckReset" name="ckReset">

            <label style="color: red;"><h3>Marque está opção para Resetar Senha</h3></label>
            <br>
            Senha Padrão:   <b style='color:red'>defesa199</b> 
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Password input-->
            <br>

        </div>
    </div>
    <br>

    <div class="row">

        <!--            <div class="col-md-12">
                        <table class="table table-bordered table-striped" width="60%">
                            <tr>
                                <th style="text-align: center;" colspan="3"><h4>Habilitação Módulo de Acesso</h4></th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">
                                    Módulo Compdec
                                </th>
                                <th style="text-align: center;">
                                    Modulo TDAP (PMDA)
                                </th>
                                <th style="text-align: center;">
                                    <span class="dev">Modulo Ajuda Homanitária</span>
                                </th>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <input type="checkbox" name="ck_compdec" id="ck_compdec" <?= ($dados['mod_compdec']) == "1" ? "checked='checked' value='1'" : "" ?>>
                                </td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name="ck_pmda" id="ck_pmda" <?= ($dados['mod_pipa']) == "1" ? "checked='checked' value='1'" : "" ?>>
                                </td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name="ck_ajuda" id="ck_ajuda" title="Em Desenvolvimento" disabled <?= ($dados['mod_ajuda']) == "1" ? "checked='checked' value='1'" : "" ?>>
                                </td>
                            </tr>
                        </table>-->
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
    $(document).ready(function() {

        $('#btnAtua').hover(function() {

            var cpf_coord_atual = $("#cpf_atual").val();
            var cpf_coord = $("#cpfCoord").val();
            var nome_atual = $("#nomeCoordAtual").val();
            var nome_coord = $("#nomeCoord").val();

            var cpf_novo = cpf_coord.replaceAll('.', "").replace('-', "");
            var cpf_atual = cpf_coord_atual.replaceAll('.', "").replace('-', "");

            //        console.log(cpf_atual);;
            //        console.log(cpf_novo);
            //        console.log(nome_atual);
            //        console.log(nome_coord);

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



        $("#email_rec").blur(function() {

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

        $("#ck_compdec").click(function() {
            if ($("#ck_compdec").is(':checked')) {
                $("#ck_compdec").attr('value', '1');
            }
        });
        $("#ck_pmda").click(function() {
            if ($("#ck_pmda").is(':checked')) {
                $("#ck_pmda").attr('value', '1');
            }
        });
        $("#ck_ajuda").click(function() {
            if ($("#ck_ajuda").is(':checked')) {
                $("#ck_ajuda").attr('value', '1');
            }
        });

        $("#ckReset").click(function() {

            if ($("#ckReset").is(":checked")) {
                $("#senha").val("<?= md5('defesa199'); ?>");
                $("#trSenha").val("1");
            } else {
                //$("#senha").val("");
                $("#trSenha").val("0");
                alert('Você não resetou a senha, deseja continuar !');
            }
        });

        $("#email_rec").blur(function() {
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