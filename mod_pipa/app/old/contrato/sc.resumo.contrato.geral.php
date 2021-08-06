<?php session_start();
  include_once "../include.php";

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
  <body>
  <div class="container">
    <div class="row-fluid text-center">
      <img src="<?php print SISTEMA."/";?>imagem/topo_pipa.png" />
      <hr>
    </div>
    
    <!-- BARRA -->
    <div class="row-fluid">
      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
    </div>

    <!-- LOGOUT -->
    <div class="row-fluid">
      <div class="span12 text-right">
        <a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
        <p>
        <hr>
      </div>
    </div>

      <!-- MENU -->
        <div class="row-fluid">
          <div class="span3">
            <!-- MENU -->
                <?php include_once 'visao/pipa.menu.php';?>
                <!-- FIM MENU -->
          </div>
          
          <!-- CONTEUDO -->
          <div class="span9 fdo_corpo">
              <legend>Filtro</legend><br>
              
                <form action="secao.php?secao=relatorio&acao=visualizar" method="post">
                    <table width="100%">
                        <tr>
                            <td width="45%">
                                <label>Ano Contratação</label>
                                <input type="text" name="txtAno" id="txtAno" maxlength="4" value="<?php print date('Y');?>" />
                                <br>
                                <label>Situação</label>
                                <select name="txtSituacao" id="txtSituacao" />
                                    <option value="">Geral</option>
                                    <option value="A">Ativo</option>
                                    <option value="R">Rescindido</option>
                                </select>
                            </td>
                            <td width="10%"></td>
                            <td width="45%">
                                <span>Ordem</span>
                                <br><br>
                                <div style="width: 100px; text-align: left;">
                                    <label style="float: right;" for="rbMotorista">Motorista</label>
                                    <input type="radio" name="rbOrdem" id="rbMotorista" value="0" checked="checked"/>
                                </div>
                                <br>
                                <div style="width: 100px; text-align: left;">
                                    <label style="float: right; width: 59px;" for="rbPlaca">Placa</label>
                                    <input type="radio" name="rbOrdem" id="rbPlaca" value="1" />
                                </div>
                                <br>
                                
                                <div style="width: 100px">
                                    <label style="float: right; width: 59px;" for="rbRota">Rota</label>
                                    <input type="radio" name="rbOrdem" id="rbRota" value="2" />
                                </div>
                                
                            </td>
                        </tr>
                        
                    </table>
                    
                    <br>
                    <input class="btn btn-primary" type="submit" name="btnEnviar" id="btnEnviar" value="Visualizar" />
                    <br>

                </form>
              
          </div>
        </div>
          <div class="row-fluid text-center">
            <small class="rodape"><?php print RODAPE;?></small>
          </div>
  </div>    
<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jasny-bootstrap.js"></script>
</body>
</html>