<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once "../include.php";

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login -> logado();

$_professor = new Professor();

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php print TITULO; ?></title>
    <!-- Bootstrap -->
    <link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
        <!-- TOPO -->
        <div class="row-fluid text-center">
            <img src="../imagem/topo_escola.png" />
            <hr>
        </div>
        <!-- BARRA -->
        <div class="row-fluid">
          <div class="span6 text-left"><small><?php print "Data :" . date("d/m/Y"); ?></small></div>
          <div class="span6 text-right"><small><?php print "Hora :" . date("H:i:s"); ?></small></div>
        </div>

        <!-- LOGOUT -->
        <div class="row-fluid">
          <div class="span12 text-right">
            <a class="btn btn-primary" href="../core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
            <p>
            <hr>
          </div>
        </div>

        <!-- MENU -->
        <div class="row-fluid">
            <div class="span3"><?php
            include_once 'visao/sc.escola.menu.php';
        ?>
        </div>
                    <div class="span9 fdo_corpo">
                            <br />
                                <form action="secao.php?secao=professor&acao=pesquisarAlterar" method="POST">
                                    <fieldset>
                                        <legend>Pesquisa de Professor</legend>
                                        <label>Nome do Professor</label>
                                        <input class="input-xlarge" type="text" placeholder="" name="txt_nome">
                                        <button type="submit" class="btn btn-primary" name="btn_pesquisar" value="btn_pesquisar">Pesquisar</button>                                      

                                        <span class="help-block"></span>

                                    </fieldset>
                                </form>
                                
                                <?php
                                
                                    $_nome          = isset($_REQUEST['txt_nome']) ? FuncaoBase::noSqlInjection($_REQUEST['txt_nome']) : "";
                                    $_btn_pesquisar = isset($_REQUEST['btn_pesquisar']) ? true : false ;
                                
                                    if($_btn_pesquisar && $_nome != ""){
  
                                        $_dados = $_professor->pesquisaProfessorId($_nome);
                                        
                                        print "<table class=\"table\">
                                                <tr>
                                                    <th width=\"20%\">Código</th>
                                                    <th width=\"60%\">Nome</th>
                                                    <th width=\"20%\">Ação</th>
                                                </tr>";
                                                                               
                                        foreach ($_dados as $key => $value) {
                                                
                                            print "<tr>
                                                    <td>".$value['id_professor']."</td>
                                                    <td>".$value['nome']."</td>
                                                    <td><a href=\"secao.php?secao=professor&acao=cadastrar&id=".$value['id_professor']."\">Alterar</a></td>
                                                   </tr>";
                                            
                                            
                                        }

                                       print "</table>";
                                        
                                        
                                        
                                    }
                                
                                ?>

                    </div>
                </div>
                    <!-- RODAPE -->
        <div>
            <div class="row-fluid text-center">
                <small><?php print RODAPE;?></small>
            </div>
        </div>
    </div>    
    <script src="<?php print SISTEMA; ?>/js/jquery.js"></script>
    <script src="<?php print SISTEMA; ?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/jasny-bootstrap.js"></script>
</body>
</html> 