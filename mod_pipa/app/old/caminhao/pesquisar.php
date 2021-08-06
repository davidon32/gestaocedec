<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';

$_login = new Login();

$_login->VerificaBrowser();

$_login->logado(CAD_CAMINHAO, $MODULO['mod_pipa']);

$_login->Sessao();

?>
<html>
    <head>
        <title>Pesquisa de Caminhao</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    </head>
    <body>

        <div class="container">
            <div class="row-fluid">

                <form action="#" method="POST" name="" id="" class="" />

                <legend>
                    Pesquisa de Caminhão
                </legend>
                <br>
                <i style="color: red;"> Obs: Digite a Placa para pesquisar o Caminhão previamente Cadastrado no Sistema.</i>
                <br>
                <br>
                <label>PLACA</label>
                <input type="text" name="placa" id="placa" data-mask="aaa-9999">
                <br>
                <input class="btn btn-primary" type="submit" name="pesquisar" id="pesquisar" value="Pesquisar" class="" />

                <br />
                <?php $_placa = isset($_POST['placa']) ? $_POST['placa'] : null;

                    if ($_placa != null) {

                        $dados = Caminhao::buscaCaminhao($_placa);

                        //var_dump($dados);

                        for ($i = 0; $i < count($dados); $i++) {

                            if ($dados[$i]['situacao'] == 'R') {

                                print "<table class=\"table text-center\">
            				                			<tr><td colspan=\"2\">Caminhão Cadastrado no Sistema</td></tr>
            				                			<tr>
            				                				<td>Placa</td>
            				                				<td>Situação</td>
            				                			</tr>
            				                			<tr>
            				                				<td colspan=\"2\">
            				                					<a href=\"#\" id=\"placa\" name=\"placa\" onclick=\"levarcodigo('" . $dados[$i]['id_caminhao'] . "', '" . $dados[$i]['placa'] . "')\">" . $dados[$i]['placa'] . " Caminhao sem Contrato</a></td>
            				                			</tr>
            				                		</table>
            				                		<br />";

                            } else {

                                print "<table class=\"table text-center\">
            				                			<tr><td colspan=\"2\">Caminhão Cadastrado no Sistema</td></tr>
            				                			<tr>
            				                				<td>Placa</td>
            				                				<td>Situação</td>
            				                			</tr>
            				                			<tr>
            				                				<td style=\"color:red\">" . $dados[$i]['placa'] . "</td>
            				                				<td style=\"color:red\">Contrato Ativo</td>
            				                			</tr></table>";
                            }

                        }
                    }
                ?>

                <br>
                <br>
                <div class="span12 text-center">
                    <?php FuncaoBase::Fechar(); ?>
                </div>
                
                

                </form>

                <script src="<?php print SISTEMA; ?>/js/jquery.js"></script>
                <script src="<?php print SISTEMA; ?>/js/bootstrap.js"></script>
                <script src="<?php print SISTEMA; ?>/js/jasny-bootstrap.js"></script>
                <script src="<?php print SISTEMA; ?>/js/funcaobase.js"></script>
                <script>
                    function levarcodigo( id_caminhao, placa )
                        {
                        /** O "segredo" está aqui nessas duas linhas, onde é passado o codigo para o <input>
                         *    e a descricao para o <label>
                         */
                         top.opener.document.getElementById("id_caminhao").value = id_caminhao;
                         top.opener.document.getElementById("placa1").value = placa;
                         window.close();
                        }

                </script>
    </body>
</html>

