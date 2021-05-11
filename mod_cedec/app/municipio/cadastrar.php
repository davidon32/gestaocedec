<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
    print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    include_once 'include.php';

    $_login = new Login();
 
    $_login->logado();

    $_login->Sessao();
     
    $_login->VerificaBrowser(); 
      
    $_funcaoBase = new FuncaoBase();
    
    $id_municipio = isset($_GET['id']) ? $_GET['id'] : "";
    
    $municipio = new Municipio();
    
    $dados = $municipio->dadosMunicipio($id_municipio);
    
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
               <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
            </div>

            <!--CORPO PAGINA-->
            <div class="span9">
                <?php
                
                
                    
                
                	//var_dump($dados);
                
                    $helper = new Html();
                    
                    $helper->form("#", "POST", "cadastro", "Alterar dados Município");
                    $helper->input("text", "txtNome", 'Nome Município', array('value'=>$dados['nome'], 'readonly'=>'readonly'));
                    print "<input type='hidden' id='id_municipio' name='id_municipio' value='".$dados['id_municipio']."'>";
                    $helper->input("text", "prefeito" , "Nome Prefeito" , array('value'=>$dados['prefeito'])) ;
                    $helper->input("text", "endereco" , "Endereço Prefeitura" , array('value'=>$dados['endereco'])) ;
                    $helper->input("text", "bairro"	  , "Bairro Prefeitura"   , array('value'=>$dados['bairro'])) ;
                    $helper->input("text", "cep"	  , "Cep Prefeitura"      , array('value'=>$dados['cep'], 'data-mask'=>'99999-999')) ;
                    //'data-mask'=>'99° 99\' 99,99\'\''
                    $helper->input("text", "latitude", "Latitude", array('data-mask'=>'-99.999999', 'value'=>$dados['latitude']));
                    $helper->input("text", "distanciaBh", "Distância BH (km)", ( (array('value'=>$dados['distancia_bh']) =="") ? 0: array('value'=>$dados['distancia_bh'])) ) ;
                    $helper->input("text", "longitude", "Longitude", array('data-mask'=>'-99.999999', 'value'=>$dados['longitude']));
                    $helper->input("text", "email"    , "Email Prefeitura"    , array('value'=>$dados['email'])) ;
                    $helper->input("text", "tel_pref" , "Telefone Prefeito" , array('value'=>$dados['tel_pref'], 'data-mask'=>'(99)99999-9999')) ;
                    $helper->input("text", "cel_pref" , "Celular Prefeito" , array('value'=>$dados['cel_pref'], 'data-mask'=>'(99)99999-9999')) ;
                    $helper->input("text", "tel" , "Telefone Prefeitura" , array('value'=>$dados['tel'], 'data-mask'=>'(99)99999-9999')) ;
                    $helper->input("text", "fax" , "Fax Prefeitura" , array('value'=>$dados['fax'], 'data-mask'=>'(99)99999-9999')) ;
                    
                    print "<div class='span6' style='margin-left:5px; margin-right:5px;'>";
                    print "<label>Macroregiao</label>";
                    print '<select id="selMacroregiao" name="selMacroregiao">';
                    print "<option>".(isset($dados['macroregiao']) ? $dados['macroregiao'] : '')."</option>";
                    	foreach ($_MACRORREGIAO as $value) {
                    		print '<option>'.$value.'</option>';
                    		;
                    	}
                    print '</select>';
                    print "</div>";
                    $helper->input("text", "populacao", "População Urbana", ( (array('value'=>$dados['populacao'])=="") ? 0 : array('value'=>$dados['populacao'])) );
                    
                    print "<div class='span6' style='margin-left:5px; margin-right:5px;'>";
                    print "<label>Território Desenvolvimento</label>";
                    print '<select id="selTerritorioo" name="selTerritorio"';
                    print "<option>".(isset($dados['territorio_desenv']) ? $dados['territorio_desenv'] : '')."</option>";
                     
                    foreach ($_TERRITORIO_DESENVOLVIMENTO as $key=>$value) {
                    	print '<option>'.$value.'</option>';
                    	;
                    }
                    print '</select>';
                    print "</div>";
                    $helper->input("text", "pop_rural", "População Rural", ( (array('value'=>$dados['pop_rural']) == "") ? 0 : array('value'=>$dados['pop_rural'])) ) ;
                    $helper->input("text", "area"     , "area"     , array('value'=>$dados['area'])) ;
                    $helper->formEnd("Salvar");
                    
                    
                    
                    
                    $btn = isset($_POST['btnSalvar']) ? $_POST['btnSalvar'] : "";
                                                           
                    if($btn == "Salvar"){
                    	$post = $_POST;

                    	if($municipio->alterar($post)){
                    		print "<script>
                    				alert('Cadastro Atualizado Com Sucesso !');
                    				var url = window.location.href;
                    				url.substr(0, url.lenght-1);
                    				window.location.href=url.substr(0, url.lenght-1)";
                    		print "</script>";
                    	}

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
