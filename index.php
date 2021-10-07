<?php

if (!isset($_SESSION)) {
    session_start();
    $id = session_id();
}
    include_once 'core/system/config/config.inc.php';
    include_once 'core/include.php';
    
    /* valida link versao
     * $valida_link = false;
    
    if( isset($_GET['token']) ){
        if( $_GET['token'] == hash('sha256', md5(VERSAO)) || $_GET['token'] == hash('sha256', md5(VERSAO). date('dmY')) ){
            $valida_link = true;
        }
    }

//var_dump($valida_link, hash('sha256', md5(VERSAO)), hash('sha256', md5(VERSAO).date('dmY')) );
     * 
     */
    

if (MANUTENCAO && $_SERVER['SERVER_NAME'] != 'desenvolvimento.gestaocedec') {
    include('index_manutencao.php');
    
} else {
    
    if(MANUTENCAO){
        print "Manutencao : ". json_encode(MANUTENCAO);
    }

    $caminho = $_SERVER['REQUEST_URI'];
    $caminho = rtrim($caminho, '/');
    $caminho = filter_var($caminho, FILTER_SANITIZE_URL);
    $caminho = explode('/', $caminho);

    $parametro = $_SERVER['QUERY_STRING'];
    $parametro = rtrim($parametro, '/');
    $parametro = filter_var($parametro, FILTER_SANITIZE_URL);
    $parametro = explode('/', $parametro);

    $controller = isset($_GET['controller']) ? $_GET['controller'] . "Controller" : "indexController";
    $action = isset($_GET['action']) ? $_GET['action'] : "index";

    $param = isset($_GET['param']) ? "&param=" . $_GET['param'] : "";
    $modulo = isset($_GET['modulo']) ? $_GET['modulo'] : "index";

    $acesso = isset($_COOKIE['seguranca']['tipo']) ? $_COOKIE['seguranca']['tipo'] : null;
    

    # Acesso Externo
    # Acesso Interno
    # Acesso sem login
    # Acesso Comun (raiz modulo)
    # acesso externo

$acesso1 = isset($_GET['externo']) ? $_GET['externo'] :"";

    if ((isset($caminho[1]) && ($caminho[1] === 'mapa')) && ( (isset($caminho[2]) && $caminho[2] === 'site'))) { # mapas
        include_once "mod_ajuda/backEnd/Controller/relatorioController.php";
        $app = new relatorioController();
        $app->mapa();
    
    /* acesso externo sem login */
    }else if($acesso1 == md5('externo')){
        include_once "mod_" . $modulo . "/Controller/" . $controller . ".php";
    } else if (  
            ($action === 'recsenha') ||
            ($action === 'recsenha_compdec') ||
            ($action === 'trsenha_cedec') ||
            ($action === 'trsenha_compdec') ||
            ($modulo === 'index') ||
            ($action === 'visualiza') ||
            ($action === 'troca_senha_cedec_esqueci')
    ) {

        include_once "mod_" . $modulo . "/Controller/" . $controller . ".php";
    } else if ((isset($caminho[1]) && $caminho[1] == "tdap")) { # TDAP
        $controller = (isset($caminho[2])) ? ucfirst($caminho[2]) : "";
        $action = (isset($caminho[3])) ? $caminho[3] : "";
        $id = (isset($caminho[4])) ? $caminho[4] : "";
        include_once("/plugins/api-rest-php/view/" . ucfirst($controller) . "/" . $action . ".php");
    //$app = new $controller();
    //$app->$action($id);
    } else if (isset($_COOKIE['seguranca']['tipo'])) {

        if ($acesso === "e") {
            $ac = "frontEnd/";
        } elseif ($acesso === "i") {
            $ac = "backEnd/";
        }
        include_once "mod_" . $modulo . "/" . $ac . "Controller/" . $controller . ".php";
    } else if (!isset($_COOKIE['seguranca']['tipo'])) { # redireciona para pagina de login
    # acesso defesa civil agora
        if (
                ($controller == 'agoraController') && ($action == 'listasite') ||
                ($action == 'cadastro') ||
                ($controller == "cceController" && $action == 'boletimsite') ||
                ($action == "listacompdecativa") ||
                ($controller == 'agoraController' && $action == 'view') ||
                ($controller == 'agoraController' && $action == 'gravarComentario') ||
                ($controller == 'agoraController' && $action == 'cadpost') ||
                ($controller == 'agoraController' && $action == 'postagem')
        ) {
            

            $ac = 'backEnd/';

            include_once "mod_" . $modulo . "/" . $ac . "Controller/" . $controller . ".php";
        } else {
            if (isset($_COOKIE['SEGURANCA'])) {
                include_once "mod_" . $modulo . "/Controller/" . $controller . ".php";
                include_once "template/page/login.php";
            } else {
                print "<script>";
                print "window.location.href='index.php'";
                print "</script>";
                //include_once "template/page/login.php";
            }
        }
    }



    #agua doce / lista
    #agua doce / lancamento
    #boletim

    /*
      if(!isset($_COOKIE['seguranca']['tipo']) && ($action != "logar") && ($action != 'recsenha') && ($action != 'listasite') && ($action != 'boletimsite') && ($action != 'cadastro') && ($action != 'listacompdecativa') && ($action != 'view') && ($action != 'recsenha_compdec')){
      include_once "template/page/login.php";

      }else {


      # acesso Index
      if (($controller == "indexController") && ($modulo == "index")) {
      include_once "mod_".$modulo."/Controller/".$controller.".php";

      }elseif(empty($acesso)) {

      # acesso defesa civil agora
      if(
      ($controller == 'agoraController') && ($action == 'listasite') ||
      ($action == 'cadastro') ||
      ($controller == "cceController" && $action == 'boletimsite') ||
      ($action == "listacompdecativa") ||
      ($controller == 'agoraController' && $action == 'view')

      )
      {

      $ac = 'backEnd/';
      include_once "mod_".$modulo."/".$ac."Controller/".$controller.".php";
      }else {
      include_once "mod_".$modulo."/Controller/".$controller.".php";
      //print "erro de acesso !";

      }
      }else {

      if(($action == 'recsenha') && ($action == 'recsenha_compdec')) {
      $ac = "";
      }else if($acesso == "e") {
      $ac = "frontEnd/";
      }elseif($acesso == "i") {
      $ac = "backEnd/";
      }

      include_once "mod_".$modulo."/".$ac."Controller/".$controller.".php";

      }
     */


    //var_dump(get_included_files());

    if (class_exists($controller)) {

        $app = new $controller();

        if (method_exists($app, $action)) {
            $app->$action();
        } else {
            print <<<EOT
<div style='width:500px;padding:0; margin:0 auto;'>
<p style='font-size:20pt;float:left'>Ocorreu um erro interno !<br>chamada nao encontrada : <i style='color:blue'>$action</i></p>
<p style='float:right'><img width='120px' src='/core/imagem/erro.png'></p>
</div>

<div style='clear: both;text-align:center; font-size:13pt;font-weight:bold; color:#3333ff'>
      <a href='javascript:history.back();'>Voltar</a>
</div>
EOT;
        }
    } else {
        print FuncaoBase::mensagem("", "alert-error", "Arquivo:<br><br>- " . $controller . "<br><br> inexistente");
    }
}


/*  print "<script>
  console.log('".$modulo."');
  console.log('".$action."');
  console.log('".$controller."');
  </script>"; */

$useragent = $_SERVER['HTTP_USER_AGENT'];

/* trava acesso google chrome */
if (preg_match('#\b(Edg|Firefox|OPR)\b#', $useragent)) {

    print "<script type='text/javascript'>";
    print "Swal.fire({icon: 'error',
                        title: 'Oops... Navegador não Homologado !',

                        footer: 'favor entrar pelo google Ghrome ! <img src=\"/core/imagem/chrome-48.png\">'
                  });";
    print "setTimeout(() => {window.location = 'http://www.defesacivil.mg.gov.br';}, 3000);";
    print "</script>";
} else if (preg_match('#\b(Mozilla/4.0)\b#', $useragent)) {
    print "<script type='text/javascript'>";
    print "alert('Navegador nao homologado \n Favor Entrar pelo Google Chrome ! ');";
    print "setTimeout(function() {window.location = 'http://www.defesacivil.mg.gov.br';}, 1000);";
    print "</script>";
}
?>