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

<br>

    <div class="col-md-12 text-center">
        <?php
        if (isset($_GET['volta']) == 'compdec') {
            $volta = "&volta=compdec";
            print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("compdec", "compdec", "index") . "\">Voltar</a></div>";
        } else {
            print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("pipa", "pipa", "index") . "\">Voltar</a></div>";
            $volta = "";
        }
        ?>
    </div>


    <div class="col-md-12">
        <legend>Manutenção de Usuários - Pesquisa</legend><br>
        <span>Pesquisa pelo nome do Município ou <b>PARTE</b> do nome :</span>
        <br>
        <br>
        <!-- INICIO DO CORPO-->
        <form action="<?= FuncaoBase::geraLink("pipa", "pipa", "pesquisaUsuario", isset($_GET['volta']) ? array('volta' => 'compdec') : array()) ?>" class="form-search" method="post">
            <div class="col-md-12">
                <label>
                    <input type="radio" name="rbOpcao" id="0" value="0" >
                    Nome de Usuário
                </label><br>
                <label>
                    <input type="radio" name="rbOpcao" id="1" value="1" checked>
                    Município
                </label><br>
                <label>
                    <input type="radio" name="rbOpcao" id="2" value="2" >
                    Email
                </label>
            </div>
            <div class="col-md-4">
                <br>
                <input class="form-control " type="text" name="txtPesquisa" id="txtPesquisa" />
            </div>
            <div class="col-md-1">
                <br>
                <input  type="submit" name="btnPesquisa" id="btnPesquisa" class="btn btn-primary" value="Pesquisar"/>
            </div>
        </form>
    </div>

    <div class="col-md-12">
        <br>

        <?php
        $usuarioEx = new Usuario();

        $opcao = isset($_POST['rbOpcao']) ? $_POST['rbOpcao'] : "";
        $usuario = isset($_POST['txtPesquisa']) ? $_POST['txtPesquisa'] : "";
        $btn = isset($_POST['btnPesquisa']) ? $_POST['btnPesquisa'] : "";

        if (($btn == 'Pesquisar') && (!empty($usuario))) {
            # usuario
            if ($opcao == 0) {
                $dados = $usuarioEx->buscaUsuario($usuario);
                # Municipio
            } elseif ($opcao == 1) {
                $dados = $usuarioEx->buscaUsuarioMunicipio($usuario);
                # email
            } elseif ($opcao == 2) {
                $dados = $usuarioEx->buscaUsuarioEmail($usuario);
            }


            if (count($dados) > 0) {
                print "<div class='col-md-11'><table class='table table-bordered'>
                    <tr>
                <th>Usuario</th>
                <th>Municipio</th>
                <th>Email (rec senha)</th>
                <th>Status</th>
                <th>Opções</th>
                </tr>";
            }

            foreach ($dados as $key => $value) {

                print "<tr>";
                print "<td>" . $value['usuario'] . "</td>";
                print "<td>" . Municipio::PegaNomeMunicipio($value['id_municipio']) . "</td>";
                print "<td>" . $value['email_rec'] . "</td>";
                print "<td>" . $value['situacao'] . "</td>";
                print "<td>
						                      <a href='?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=pipa&controller=pipa&action=cUserEx&id=" . $value['id'] . $volta . "'><img src='core/imagem/editar.png' title='Editar dados do usuario externo'></a>
						                      <!--<a href='#'><img src='core/imagem/view.png'></a>-->						        
						          </td>";
            }
            print "</tr>";//var_dump($_POST);
        }
        print "</div></table>";
        ?>

</div> 

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type>


    $(document).ready(function () {

        $("#btn").change(function () {

            var dados = {
                "id_pmda": $("#txtIdPmda").val(),
                "status": "1",
                "opcao": "gravar",
            }

            $.ajax({
                type: 'POST',
                url: 'mod_pipa/app/pmda/funcAdm.php?v=<?= md5(VERSAO) ?>',
                data: dados,
                success: function (response) {
                    console.log(response);
                    //location.reload();
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });

        });

        $("#btnConfirm").hide();
        $("#txtProtocolo").hide();


        $("#lk_alteracao").click(function () {
            $("#btnConfirm").show();
            $("#txtProtocolo").show();
        });
        $("#btnConfirm").click(function () {
            alert("ok");
        });


    });


</script>