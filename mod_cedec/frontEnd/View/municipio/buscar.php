<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php   
    $_funcionario = new EquipeFuncionario();  
    $_funcaoBase = new FuncaoBase(); 
    $_arquivoOficio = new ArquivoOficio();
    
    $municipio = new Municipio();
    
    $_usuario = new Usuario();
?>
    <?php
            
                     
            
                $helper = new Html();
                
                $helper->form("#", "POST", "BuscaMunicipio", 'Pesquisar Municipio');
                
                $helper->input("text", "Municipio", "Pesquisa");
                print "<br>";
                
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
                    	print "<td><a href='?modulo=cedec&controller=municipio&action=cadastrar&id=".$value['id_municipio']."'' title='Editar dados do Municipio'><img width='30px' src='core/imagem/editar.png'>";
                    	//print "<a href='?modulo=cedec&secao=relatorio&acao=info_municipio&id=".$value['id_municipio']."'' title='Visualizar Dados do Municipio'><img width='30px' src='imagem/impressao.png'></td>";
						print "</tr>";
                    }
                    
                    
                    
                    
                    print "</table>";
                    
                        
                        print "<script type='text/javascript'>
                        
                            //window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=cedec&secao=relatorio&acao=info_municipio&id=".$_municipio."';
                        
                        </script>";
                        
   
                        
                    }

            ?>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>