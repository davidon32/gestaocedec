<?php include_once 'include.php';
    print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    
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
    
    <!-- BARRA DE USUARIO-->
    <div class="barra_usuario">
        <?php require_once(PATH.'/app/elemento/menu.usuario.php');?>    
    </div>
    
    <!-- PAGINA -->
    <div class="container">
        
        <!-- TOPO -->
        <div class="row-fluid text-left">
            <!--<img src="imagem/topo_gestao.png" alt="Topo" />-->
            <img src="imagem/logo_novo.png" alt="Topo" width="150px"/>
            <legend>Módulo - <?=FuncaoBase::getModulo($_GET['modulo']);?></legend>
            <br><br>
        </div>

        <div class="row-fluid">

            <!-- MENU -->
            <div class="span3">
               <!-- menu -->
                <?php include_once PATH."/mod_".$modulo.'/app/elemento/config.menu.php';?>
            </div>

            <!--CORPO PAGINA-->
            <div class="span9">
            	<?php
$con = Conexao::getInstance();

$_funcionario = new EquipeFuncionario();

?>
     
          <!-- CORPO -->
            <div class="span10">
                <legend> Configurações Gerais </legend>
                <div class="tabbable"> <!-- Only required for left/right tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Configurações</a></li>
                        <li><a href="#tab2" data-toggle="tab">Backup</a></li>
                        <li><a href="#tab3" data-toggle="tab">Importar Operacao PIPA</a></li>
                        <li><a href="#tab4" data-toggle="tab">Mensagem do Sistema</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <p>Ordenador de Despesas<br>
                            <form action="#" method="POST">
                    
                                <?php
                        
                                    $_parametro = FuncaoBase::pegaParametro();
                            
                                    //var_dump($_parametro); 
                        
                                    $_funcionario->getNomeDiretoria(false, "6", $_parametro['ordDespesa']) ?>
                                    <input class="btn" type="submit" name="btnEnviar" id="btnEnviar" />
                            </form>
                            <?php 
                
                                //var_dump($_POST);
                                $id_ordenador = isset($_POST['sel_nDiretoria']) ? $_POST['sel_nDiretoria'] : "";
                    
                                $enviar = isset($_POST['btnEnviar']) ? $_POST['btnEnviar'] : "";  
                    
                                if($enviar) {
                        
                                    $result = $_funcionario->alterarOrdenador($id_ordenador);
                        
                                    if($result) {
                         
                                        print "<script type=\"text/javascript\">";

                                        print "alert('Alteração realizada com Sucesso !');";
            
                                        print "window.location.href = 'adm';";
            
                                        print "</script>"; 
                            
                                    }
  
                                }
   
                            ?>
                            </p>
                        </div>
                        
                        <!-- Backup Sistema -->
                        <div class="tab-pane" id="tab2">
                           <p>
                           Backup Sistema
    
                           <form method="POST" action="#" name="">
                                <input type="hiddem" name="" id="" size="" value="<?php print date('G.i.s_d-m-Y'); ?>" >
                                <input type="submit" name="backup" id="backup" size="7" value="enviar" >
                           </form>
                            <?php
                                #@ -- backup sistema -->
                                $nome = isset($_POST['backup']) ? $_POST['backup'] : "";
                                //FuncaoBase::Backup($nome);
                                print FuncaoBase::TamanhoBase($nome);
                            ?>
                </p>
                </div>
                <div class="tab-pane" id="tab3">
                    <?php
                    
                        $helper = new Helper();

                        $helper->form('#', 'POST', 'formImportar', 'Importação Arquivo Pipa');
                        
                            $helper->input('file', 'Arquivo');
                    
                        $helper->formEnd('Importar');
                        
                        # lista de dados do credenciamento
                        $lista[] = array('nome'=>'Demetrio da Silva Passos', 'cpf'=>'032.604.146-06', 'endereco'=> 'Rua Dom Helder Camara, 128');
                        $lista[] = array('nome'=>'ALDEREI DA SILVA BARROS', 'cpf'=>'004.407.486-74', 'endereco'=> '-');
                        $lista[] = array('nome'=>'ADAO DE JESUS CARDOSO-ME', 'cpf'=>'10.827.102/0001-39', 'endereco'=>'RUA PROFESSOR JOAO CANDIDO 224');

                        //var_dump($lista);
                        
                        
                    ?>
                    
                </div>
                
                <!-- MENSAGEM DO SISTEMA-->
                <div class="tab-pane" id="tab4">
                    <form action="/index.php?modulo=administrator&secao=mensagem&acao=valida" method="POST" name="cad_msg">
    
                        <table align="center" border="0">
                            <tr>
                                <th colspan="3">Mensagens e Avisos do Sistema</th>
                            </tr>
                            <tr><td colspan="2">&nbsp;</td></tr>
                            <tr>
                                <td>Titulo</td><td>:</td><td><input type="text" name="titulomsg" id="" size="74" value="" /></td>
                                
                            </tr>
                            
                            <tr>
                                <td valign="top">Mensagem</td>
                                <td valign="top">:</td>
                                <td valign="top"><textarea cols="45" id="msg" name="msg" rows="5" maxlength="255" onkeyup="mostrarResultado(this.value,254,'spcontando');contarCaracteres(this.value,254,'sprestante')"></textarea><br />
                                                    <span id="spcontando" >Ainda não temos nada digitado..</span><br />
                                                    <span id="sprestante" style="font-family:Georgia;"></span></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="3"><input class="btn" type="submit" name="enviar" id="enviar" value="Cadastrar" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
        </div>
            
               
               
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