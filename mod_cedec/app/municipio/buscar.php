<?php $id_session = session_id();
    if(empty($id_session)) session_start();
    include_once 'include.php';
    
    print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
       
     $_login = new Login();

     $_login->logado();
 
     $_login->Sessao();
     
     $_login->VerificaBrowser(); 
    
    $_funcionario = new EquipeFuncionario();  
    $_funcaoBase = new FuncaoBase(); 
    $_arquivoOficio = new ArquivoOficio();
    
    $municipio = new Municipio();
    
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
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<?php include_once(PATH.'/system/topo.php'); ?>
    <div class="container">
        <div class="row-fluid text-center">
            <img src="../imagem/topo_pipa.png" />
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
               <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
            </div>

            <div class="span9">

            <?php
            
                     
            
                $helper = new Html();
                
                $helper->form("#", "POST", "BuscaMunicipio", 'Pesquisar Municipio');
                
                $helper->input("text", "Municipio", "Pesquisa");
                
                $helper->formEnd("Pesquisar");
                
                	
                
                    $_municipio   = isset($_POST['txtMunicipio'])  ? $_POST['txtMunicipio']    : "";
                    $btnEnviar    = isset($_POST['btnPesquisar'])     ? $_POST['btnPesquisar']         : "";

                    if($btnEnviar != ""){

                    print "<br<br><table class='table table-bordered'>";
                    print "<tr><td>Código</th>";
                    print "<th>Municipio</th>";
                    print "<th>Ação</th>";
                    print "</tr>";
                    
                    $dados = $municipio->BuscaMunicipio($_municipio);

                    foreach ($dados as $key=>$value) {
                    	print "<tr>";
                    	print "<td>".$value['id_municipio']."</td>";
                    	print "<td>".$value['nome']."</td>";
                    	print "<td><a href='?modulo=cedec&secao=municipio&acao=cadastrar&id=".$value['id_municipio']."'' title='Editar dados do Municipio'><img width='30px' src='imagem/editar.png'>";
                    	//print "<a href='?modulo=cedec&secao=relatorio&acao=info_municipio&id=".$value['id_municipio']."'' title='Visualizar Dados do Municipio'><img width='30px' src='imagem/impressao.png'></td>";
						print "</tr>";
                    }
                    
                    
                    
                    
                    print "</table>";
                    
                        
                        print "<script type='text/javascript'>
                        
                            //window.location = 'index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=&modulo=cedec&secao=relatorio&acao=info_municipio&id=".$_municipio."';
                        
                        </script>";
                        
   
                        
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
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jasny-bootstrap.js"></script>
    <script src="/js/funcaobase.js"></script>
</body>
</html>
