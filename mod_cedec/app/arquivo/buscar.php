<?php session_start();
    print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    include_once '/include.php';
       
     $_conexao = new ConexaoMysql();

     $_login = new Login();

     $_login->logado();
 
     $_login->Sessao();
     
     $_login->VerificaBrowser(); 
    
    $_funcionario = new EquipeFuncionario();  
    $_funcaoBase = new FuncaoBase(); 
    $_arquivoOficio = new ArquivoOficio();
    
    $_usuario = new Usuario();

/************************************************************************************+
 #  Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
 #  Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
 #  Autor       : Demetrio S. Passos                                                 #
 #  Criação     : 00/00/0000                                                         #
 #  Descrição   :
 #
 +************************************************************************************/
    
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
        <div class="row-fluid text-center">
            <img src="../images/topo_pipa.png" />
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
            <a class="btn btn-primary" href="controller/logout.php?logout=s" title="Logout do Sistema">Logout</a>
            <p><hr>
          </div>
        </div>

        <div class="row-fluid">

            <!-- MENU -->
            <div class="span3">
               <?php include_once "/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
            </div>

            <div class="span9">
                <legend>Consulta Arquivo Ofício</legend>
                <br>
                <form action="#" method="POST" name="frmConsultaOficio" >
                    <table>
                        <tr>
                            <td>Nº<br>
                                <input type="text" placeholder="Número do Ofício" name="txtNumOficio"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Ano<br>
                                <input type="text" placeholder="Ano" name="txtAno" data-mask="9999"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Assunto<br>
                                <input type="text" placeholder="Assunto" name="txtAssunto" disabled="disabled"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Destinatário<br>
                                <input type="text" placeholder="Destinatário" name="txtDestinatario" disabled="disabled"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Responsável<br>
                                <?php 
                                    //$_funcionario->ComboFuncionario();
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Pesquisar"name="btnEnviar" class="btn btn-primary"/>
                            </td>
                        </tr>
                        
                    </table>
                </form>
            
            
            <?php
                
                    $numOficio    = isset($_POST['txtNumOficio'])    ? $_POST['txtNumOficio']      : "";
                    $ano          = isset($_POST['txtAno'])          ? $_POST['txtAno']            : "";
                    $assunto      = isset($_POST['txtAssunto'])      ? $_POST['txtAssunto']        : "";
                    $destinatario = isset($_POST['txtDestinatario']) ? $_POST['txtDestinatario']   : "";
                    $responsável  = isset($_POST['sel_funcionario'])  ? $_POST['sel_funcionario']    : "";
                    $btnEnviar    = isset($_POST['btnEnviar'])       ? $_POST['btnEnviar']         : "";

                    if($btnEnviar != ""){
                        
                        //var_dump($_POST);
                        
                        
                        
                        $dados = $_arquivoOficio->pesquisarOficio($numOficio, $ano);
                        
                        //var_dump($dados);
                        
                        print "<table class='table table-bordered'>
                                    <tr>
                                        <td>Número</td>
                                        <td>Data</td>
                                        <td>Assunto</td>
                                        <td>destinatário</td>
                                        <td>Observação</td>
                                        <td>Responsável</td>
                                        <td>Opção</td>
                                    </tr>";
                     
                     for($i=0; $i<count($dados); $i++){
                         
                            print "<tr>
                                        <td colspan='7' style='text-align:center'>Registrado no sistema por :<b>".$_usuario->getNomeId($dados[$i]['id_user'])."</b></td>
                                    </tr>
                            <tr>
                                        <td>".$dados[$i]['numero']."</td>
                                        <td>".DataMysql::dataVisual($dados[$i]['dt_oficio'])."</td>
                                        <td>".$dados[$i]['assunto']."</td>
                                        <td>".$dados[$i]['destinatario']."</td>
                                        <td>".$dados[$i]['observacao']."</td>
                                        <td>".$_funcionario->getFuncionarioId($dados[$i]['id_resp'])."</td>
                                        <td><button onclick=\"javascript:NovaJanela('mod_cedec/oficio/".$dados[$i]['arquivo']."', 800, 900);\">visualizar</button></td>
                                        </tr>";

                        }
                     
                        print "</table>";

                    }
    
            
            ?>  
            </div>
            <!-- ESPAÇO CORPO -->
            <div class="row-fluid fdo_corpo"></div>
            
            <!-- RODAPE -->
            <div class="row-fluid">
                <div class="span12 text-center">
                    <small><?php print RODAPE;?></small>
                </div>  
            </div>
        </div>
            
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
    <script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</body>
</html>
