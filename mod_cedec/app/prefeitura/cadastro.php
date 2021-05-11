<?php session_start();
    print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    include_once PATH.'/include.php';
    
    //var_dump($_SESSION);
    
    $_conexao = new ConexaoMysql();

    $_login = new Login();
 
    $_login->logado();

    $_login->Sessao();
     
    $_login->VerificaBrowser(); 
    
    $_funcionario = new EquipeFuncionario();  
    
    $_funcaoBase = new FuncaoBase(); 
    
    

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
            <img src="../imagem/topo_gestao.png" />
            <hr>
        </div>
        <!-- BARRA -->
        <div class="row-fluid">
          <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
          <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
        </div>

        
        <div class="row-fluid">

            <!-- MENU -->
            <div class="span3">
               <?php include_once 'visao/cedec.menu.php';?>
            </div>

            <!--CORPO PAGINA-->
            <div class="span9">
                <legend>Arquivamento Ofício</legend>
                <br>
                <form action="secao.php?secao=arquivo&acao=valida" method="POST" name="frmOficio" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Nº<br>
                                <input type="text" placeholder="Número do Ofício" name="txtNumOficio"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Data<br>
                                <input type="text" placeholder="Data" name="txtData" data-mask="99/99/9999" value="<?php print date("d/m/Y");?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Ano<br>
                                <input type="text" placeholder="Ano" name="txtAno" value="<?php print date("Y");?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Assunto<br>
                                <input type="text" placeholder="Assunto" name="txtAssunto" />
                            </td>
                        </tr>
                        <tr>
                            <td>Destinatário<br>
                                <input type="text" placeholder="Destinatário" name="txtDestinatario"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Produzido Por<br>
                                <?php 
                                    $_funcionario->ComboFuncionario();
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Observações<br>
                                <textarea cols="25" rows="5" name="txtObservacao"></textarea>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Arquivo<br>
                                <input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
                                <input type="file" name="fileArquivo" /><br><span style="color: red">Tamanho máximo 3Mb</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Arquivar"name="btnEnviar" class="btn btn-primary"/>
                            </td>
                        </tr>
                        
                    </table>
                </form>
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
