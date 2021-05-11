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
    
                
                    $numOficio    = isset($_POST['txtNumOficio'])    ? $_POST['txtNumOficio']      : "";
                    $ano          = isset($_POST['txtAno'])          ? $_POST['txtAno']            : "";
                    $assunto      = isset($_POST['txtAssunto'])      ? $_POST['txtAssunto']        : "";
                    $destinatario = isset($_POST['txtDestinatario']) ? $_POST['txtDestinatario']   : "";
                    $responsável  = isset($_POST['selNomeFuncionario']) ? $_POST['selNomeFuncionario']   : "";
                    $arquivo      = isset($_POST['fileArquivo'])     ? $_POST['fileArquivo']       : "";
                    $dtOficio     = isset($_POST['txtData'])         ? $_POST['txtData']           : "";
                    $observacao   = isset($_POST['txtObservacao'])   ? $_POST['txtObservacao']     : "";

                    $btnEnviar    = isset($_POST['btnEnviar'])       ? $_POST['btnEnviar']         : "";
                    
                    //var_dump($_POST);
                    
                    if($btnEnviar != ""){
                        
                        //var_dump($_FILES);
                        
                        /* error 4 - sem arquivo anexado
                         * error 0 - ok arquivo anexado
                         *  */  
                        if($_FILES['fileArquivo']['error'] !== 4){
                            
                            $arquivoFiles = $_FILES;
                                
                            $resultado = $_arquivoOficio->arquivarOficio($numOficio,
                                                                         $ano,
                                                                         $assunto,
                                                                         $destinatario,
                                                                         $responsável,
                                                                         "Oficio_nr.-".$numOficio.".".date('d-m-Y.H.i.s').".pdf",
                                                                         DataMysql::dataForm($dtOficio),
                                                                         $observacao,
                                                                         $_SESSION['seguranca']['idUser']);    
                                
                            if($resultado){
                                        
                                    // upload arquivos
                                    $_arquivoOficio->uploadArquivo($arquivoFiles, $numOficio);
                                    
                                    $_funcaoBase->vifs("sucesso", "index.php?modulo=cedec&secao=arquivo&acao=cadastrar");
                            }else {
                                
                                print "erro";//die();
                                
                            }
                                    
    
                        }else {
                            
                           $_funcaoBase->alert("Favor Anexar um Arquivo");
                           
                           print $_funcaoBase->voltar();
                            
                        }
                     }else {
                            
                     }
 
            ?>         