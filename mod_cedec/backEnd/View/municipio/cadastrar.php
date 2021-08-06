<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php

    $_funcaoBase = new FuncaoBase();
    
    $id_municipio = isset($_GET['id']) ? $_GET['id'] : "";
    
    $municipio = new Municipio();
    
    $dados = $municipio::dadosMunicipio($id_municipio);
    
 
    $_MACRORREGIAO = array('1'=>'SUL DE MINAS',
            '2'=>'ALTO PARANAIBA',
            '3'=>'CENTRAL',
            '4'=>'ZONA DA MATA',
            '5'=>'VALE DO RIO DOCE',
            '6'=>'TRIANGULO',
            '7'=>'CENTRO OESTE',
            '8'=>'JEQUITINHONHA MUCURI',
            '9'=>'NORTE DE MINAS',
            '10'=>'NOROESTE DE MINAS');
            
    
    # TERRITORIO DE DESENVOLVIMENTO       
    $_TERRITORIO_DESENVOLVIMENTO = array('1' => 'Vertentes',
                      '2' => 'Vale do Rio Doce',
                        '3' => 'Vale do Aco',
                        '4' => 'Triangulo Sul',
                        '5' => 'Triangulo Norte',
                        '6' => 'Sul',
                        '7' => 'Sudoeste',
                        '8' => 'Oeste',
                        '9' => 'Norte',
                        '10' => 'Noroeste',
                        '11' => 'Mucuri',
                        '12' => 'Metropolitana',
                        '13' => 'Medio e Baixo Jequitinhonha',
                        '14' => 'Mata',
                        '15' => 'Central',
                        '16' => 'Caparao',
                        '17' => 'Alto Jequitinhonha');               
                           
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
                    print '<select id="selMacroregiao" name="selMacroregiao" class="form-control">';
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
                    print '<select id="selTerritorioo" name="selTerritorio" class="form-control">';
                    print "<option>".(isset($dados['territorio_desenv']) ? $dados['territorio_desenv'] : '')."</option>";
                     
                    foreach ($_TERRITORIO_DESENVOLVIMENTO as $key=>$value) {
                    	print '<option>'.$value.'</option>';
                    	;
                    }
                    print '</select>';
                    print "</div>";
                    $helper->input("text", "pop_rural", "População Rural", ( (array('value'=>$dados['pop_rural']) == "") ? 0 : array('value'=>$dados['pop_rural'])) ) ;
                    $helper->input("text", "area"     , "area"     , array('value'=>$dados['area'])) ;
                    print "<br>";
                    $helper->formEnd("Salvar");
                    
                    
                    print FuncaoBase::voltar(0, FuncaoBase::geraLink("cedec", 'municipio', "buscar"));
                    
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
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>