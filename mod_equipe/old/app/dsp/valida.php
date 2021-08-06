<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

Login::Logado();

$_funcaoBase = new FuncaoBase();

$_municipio = new Municipio();

$_dsp = new EquipeDSP();

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</head>

<body>
<?php

//var_dump($_POST);

$_id = isset($_GET['id']) ? (int)$_GET['id'] : "";

$_txt_dt_dsp       = isset($_POST['txt_dt_dsp'])     ? $_POST['txt_dt_dsp']     : "";
$_txt_num_dsp      = isset($_POST['txt_num_dsp'])    ? $_POST['txt_num_dsp']    : "";
$_txt_missao       = isset($_POST['txt_missao'])     ? utf8_decode(strtoupper($_POST['txt_missao'])) : "";
$_sel_cod_dsp      = isset($_POST['sel_cod_dsp'])    ? $_POST['sel_cod_dsp']    : "";
$_txt_dt_partida   = isset($_POST['txt_dt_partida']) ? $_POST['txt_dt_partida'] : "";
$_txt_dt_chegada   = isset($_POST['txt_dt_chegada']) ? $_POST['txt_dt_chegada'] : "";
$_lista_id_destino = isset($_POST['txt_lista_destino']) ? utf8_decode(strtoupper($_POST['txt_lista_destino'])): "";
$_lista_funcionario= isset($_POST['txt_lista_func']) ? $_POST['txt_lista_func'] : "";
$_chefeDireto      = isset($_POST['selChefeDireto']) ? $_POST['selChefeDireto'] : "";
$_txt_ano          = isset($_POST['txt_ano'])        ? $_POST['txt_ano']        : "";
$tpDSP             = isset($_POST['tpDSP'])          ? (string)$_POST['tpDSP']          : "";
$tpTransporte      = isset($_POST['sel_transporte']) ? $_POST['sel_transporte'] : "";
$onus              = isset($_POST['rbOnus'])         ? $_POST['rbOnus']         : "";

$_btn_envia = isset($_POST['btn_envia']) ? true : "";


$_campo = array("Data DSP" => $_txt_dt_dsp,
                "Número DSP" => $_txt_num_dsp,
                "Missão" => $_txt_missao, 
                "Código DSP" => $_sel_cod_dsp, 
                "Data Partida" => $_txt_dt_partida, 
                "Data Chegada" => $_txt_dt_chegada, 
                "Lista de Destino" => $_lista_id_destino, 
                "Lista Equipe DSP" => $_lista_funcionario,
                "Tipo do Transporte" => $tpTransporte);
                
               
//var_dump($_POST);
/* ########### CADASTRO DSP ########### */

if(!$_id) {

if ($_btn_envia) {
    
    // cria a lista com o nome dos funcionarios
    $_lista = explode(",", $_lista_funcionario);
    
    array_pop($_lista);
    
    $verifica = (bool) "";
    $executa = (bool) "";
    
     if(count($_lista) == 0){
          
        FuncaoBase::alert("Favor Preencher os Diligentes", true); 
    
      
     }else if($tpDSP == "0") { /* valida funcionarios militares lista */
          
        foreach ($_lista as $key => $value) {

             $verifica = (bool) $_dsp->verificaFuncionarioMilitar($value);
             
             if(!$verifica){

                FuncaoBase::alert("Favor remover o funcionario Civil desta DSP", true);
                 $executa = false;
                break;
             }else {
                 $executa = true;
                 
             }

         }

    }else if($tpDSP == "1") { // busca militar em DSP de civil

           
            $verifica = (bool) $_dsp->verificaFuncionarioMilitar($_lista[0]);
            
            if($verifica) {
            
                FuncaoBase::alert("Favor remover o funcionario Militar desta DSP", true);
                $executa = false; 
                break;
            }else {
                $executa = true;
            }

            
     }
    
    
    if($executa) {  /* executa da dsp */        

        $_id_dsp = '';
    
        // valida campos em branco
        if ($_funcaoBase::campoBranco($_campo)) {
    
            if ($_dsp -> Cadastrar(DataMysql::dataForm($_txt_dt_dsp),
                            $_txt_num_dsp,
                            $_txt_missao,
                            $_lista_id_destino,
                            $_sel_cod_dsp,
                            DataMysql::dataCompletaForm($_txt_dt_partida),
                            DataMysql::dataCompletaForm($_txt_dt_chegada),
                            $_chefeDireto,
                            $_txt_ano,
                            $tpTransporte,
                            $tpDSP,
                            $onus)) {
                                
                $_id_dsp = $_dsp -> BuscaIdDsp($_txt_num_dsp, DataMysql::dataForm($_txt_dt_dsp));
    
                //var_dump($_id_dsp);
                foreach ($_lista as $key => $value) {
            
                    $_tipo = 0;
    
                    if($value != ''){
                        // o primeiro nome da lista é o chefe da diligencia 
                        if ($key == '0') {
        
                                $_tipo = 1;
                                // inserir os elementos na dsp
                                $_dsp -> InsereFuncionario($_id_dsp, $value, $_tipo);
        
                            } else {
        
                                $_tipo = 0;
                                // inserir os elementos na dsp
                                $_dsp -> InsereFuncionario($_id_dsp, $value, $_tipo);
                            }
                    }
                }
                
                
                print "<script type=\"text/javascript\">";
                        
                print "alert('Dsp Lancada com Sucesso !');";
                print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=dsp&acao=impressao&id=".$_id_dsp."&tp=".$tpDSP."';";
      
                print "</script>";
                
            }else {
                
                print "<script type=\"text/javascript\">";
                        
                print "alert('Ocorreu um erro Interno !');";
    
                print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=dsp&acao=cadastro';";
                        
                print "</script>";
            }
    
        }
    }

}

/*   #########  alterar dsp ########## */

}else if(is_int($_id)){

//var_dump($_POST);
//var_dump($tpDsp);
    
$_campo = array("Data DSP" => $_txt_dt_dsp,
                "Número DSP" => $_txt_num_dsp,
                "Missão" => $_txt_missao, 
                "Código DSP" => $_sel_cod_dsp, 
                "Data Partida" => $_txt_dt_partida, 
                "Data Chegada" => $_txt_dt_chegada, 
                "Lista de Destino" => $_lista_id_destino, 
                "Lista Equipe DSP" => $_lista_funcionario,
                "Tipo Transporte" => $tpTransporte);

    if ($_btn_envia) {
        
        
        
        if($ok = false) {// implementar a validação da alteracao somente da data chegada 
                    
        }else {
            
            
                
                //$_lista_id_destino = substr($_lista_id_destino, 0, -1);
                
                $_lista_funcionario = substr($_lista_funcionario, 0, -1);
            
                // cria a lista com o nome dos funcionarios
                $_lista = explode(",", $_lista_funcionario);
            
                // valida campos em branco
                if ($_funcaoBase::campoBranco($_campo)) {
            
                
                    if ($_dsp -> alterar(DataMysql::dataCompletaForm($_txt_dt_dsp),
                                    $_txt_num_dsp,
                                    $_txt_missao,
                                    $_lista_id_destino,
                                    $_sel_cod_dsp,
                                    DataMysql::dataCompletaForm($_txt_dt_partida),
                                    DataMysql::dataCompletaForm($_txt_dt_chegada),
                                    $_chefeDireto,
                                    $_txt_ano,
                                    $tpTransporte,
                                    $_id,
                                    $tpDSP)) {
                           
                        #remove os diligentes Antigos
                        $_dsp->removeDiligente($_id);
                            
                       
                        //var_dump($_lista);
                        # adicionar os diligentes
                        foreach ($_lista as $key => $value) {
                    
                            $_tipo = 0;
            
                            if($value != ''){
                                // o primeiro nome da lista é o chefe da diligencia 
                                if ($key == '0') {
                
                                        $_tipo = 1;
                                        // insere o comandante da dsp
                                        $_dsp -> InsereFuncionario($_id, $value, $_tipo);
                
                                    } else {
                
                                        $_tipo = 0;
                                        // inserir os elementos na dsp
                                        $_dsp -> InsereFuncionario($_id, $value, $_tipo);
                                    }
                            }
                            
                        }

                        print "<script type=\"text/javascript\">";
                                
                        print "alert('Dsp Lancada com Sucesso !');";
                        
                        print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=dsp&acao=impressao&id=".$_id."&tp=".$tpDSP."';";
                                
                        print "</script>";
                        
                    }else {
                        
                        print "<script type=\"text/javascript\">";
                                
                        print "alert('Ocorreu um erro Interno !');";
            
                        print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=dsp&acao=cadastro';";
                                
                        print "</script>";
                    }
            
                }else {
                    
                    print "teste";
                    
                }
            
            }

       }else {
           
           print "erro";
       }


    
    
}

?>