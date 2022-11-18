<?php

include_once PATH . "/core/Controller/Controller.php";
include_once "core/Model/Model.php";
#include_once PATH. "/template/page/only_header.php";

class pipaController extends Controller {

    public function index() {
        include_once "mod_pipa/backEnd/View/index/index.php";
        //var_dump($pageSession);
    }
    
    /* editar pmda */
    public function pmda() {
        include_once "mod_pipa/backEnd/View/pmda/indexView.php";

    }

    # usuario index
    public function usuario() {
        include_once "mod_pipa/backEnd/View/usuario/indexView.php";
    }

    #cadastro Usuario
    public function caduser() {
        include_once "mod_pipa/backEnd/View/usuario/caduserView.php";
    }

    # pesquisa usuario

    public function pesquisaUsuario() {

        include_once "mod_pipa/backEnd/View/usuario/pesquisaUsuarioView.php";
    }

    #altera Usuario

    public function cUserEx() {

        include_once "mod_pipa/backEnd/View/usuario/cExUserView.php";
    }

    # Administração do pmda
    public function pmdaIndex() {
        include_once "mod_pipa/backEnd/View/index/indexPmda.php";
    }

    #pesquisa pmda

    public function pesquisaPmda() {
        include_once "mod_pipa/backEnd/View/pmda/pesquisaPmdaView.php";
    }

    #visualizar PMDA

    public function printView() {
        include_once "mod_pipa/backEnd/View/pmda/printView.php";
    }

    #impressao PMDA

    public function printPmda() {
        include_once "mod_pipa/backEnd/View/pmda/printPmdaView.php";
    }

    #visualizar MapaA

    public function printPmdaMapa() {
        include_once "mod_pipa/backEnd/View/pmda/printPmdaMapa.php";
    }

    #historico mensagem 

    public function historicoMsg() {
        include_once "mod_pipa/backEnd/View/pmda/mensagemView.php";
    }

    # comunidade 

    public function pmdaCom() {
        include_once "mod_pipa/backEnd/View/comunidade/pmdaComView.php";
    }

    # cad Com 

    public function cadcom() {
        include_once "mod_pipa/backEnd/View/comunidade/cadcom.php";
    }

    # validar comunidade 

    public function valcom() {
        include_once "mod_pipa/backEnd/View/comunidade/valcom.php";
    }

    # alterar comunidade 

    public function alteraComunidade() {
        include_once "mod_pipa/backEnd/View/comunidade/altera.php";
    }

    #mensagem

    public function mensagem() {
        include_once "mod_pipa/backEnd/View/pmda/mensagemView.php";
    }

    #declaracao

    public function declaracao() {
        include_once "mod_pipa/backEnd/View/pmda/declaracao.php";
    }

    # cadastro comunidade

    public function precadcom() {
        include_once "mod_pipa/backEnd/View/comunidade/precadcom.php";
    }

    # termo compromisso

    public function termo() {
        include_once "mod_pipa/backEnd/View/pmda/termo.php";
    }

    # termo compromisso

    public function declaracaoiss() {
        include_once "mod_pipa/backEnd/View/pmda/declaracao.php";
    }

    public function resetarSenha() {
        

                
        $btn = isset($_POST['btnAtua']) ? $_POST['btnAtua'] : "";

        if ($btn == 'btnAtua') {

            $_POST['ck_compdec'] = isset($_POST['ck_compdec']) ? $_POST['ck_compdec'] : 0;
            $_POST['ck_pmda'] = isset($_POST['ck_pmda']) ? $_POST['ck_pmda'] : 0;
            $_POST['ck_ajuda'] = isset($_POST['ck_ajuda']) ? $_POST['ck_ajuda'] : 0;

                       
            if ( Usuario::atuaUsuarioExterno($_POST) ) {
                print  "<script>
	 		alert('Usuario atualizado com Sucesso !');      
	 		</script>";

                if( isset($_POST['ckReset']) ){
                

                    print "<style>
                        body {
                        background-color: #F79A86 ;
                        }
                        .message{
                            width: 600px;
                            margin: 0 auto;
                            
                            padding: 10px;
                            font-size: 15pt;
                            text-align:justify;
                            border-radius: 13px;
                            border:0.1 solid;
                            background-color: #AACCF3;
                            font-family: 'calibri';
                        }
                        b {
                            color:red;
                        }
                    </style>
                        <br>
                        <br>
                        <div class='container message'>
                        <div class='col alert alert-success'>
                        <p style='text-align:center'><img width='80' src='/core/imagem/DEFESACIVILMG_400'></p>
                            <br>
                            <h4>Prezado Coordenador,<br><br>
                            Sua senha foi resetada, acesse : <br>
                            http://sistema.defesacivil.mg.gov.br
                            <br>
                            <br>
                            Usuario : <b>".$_POST['email_rec']."</b> 
                            <br>
                            <br>
                            Senha   : <b>defesa199</b>
                            <br>
                            <br>
                            Efetue a Troca de Senha !
                            <br><br></h4>
                            <h3><p style='color:#35231F'>Obs:<br> <i>O usuario de acesso, é o email que usamos para resetar a senha, fique atento pois alterar o email de resetar senha é também alterado o usuario de acesso.</i></p></h3>
                            
                        </div>
                        <p class='text-center'><a class='btn btn-primary' href='".FuncaoBase::geraLink('pipa', 'pipa', 'pesquisaUsuario')."' >Voltar</a></p>
                        </div>";
                }else {

                    print "<script>
                            window.location.href= '".FuncaoBase::geraLink('pipa', 'pipa', 'cUserEx', array('id'=>$_POST['id_usuario'], 'volta'=>'compdec'))."';
                            </script>";
                }
                
            } else {

                print "oi";
            }
        }
    }
    
    
    /* apagar pmda */
    public function deletePmda(){

        $id_pmda = $_GET['param'];
        $id_municipio = $_GET['idmun'];
        if(Pmda::deletePmda($id_pmda)){
            
            print "<script>
	 		alert('Pmda deletado com Sucesso !');
                        window.location.href = '".FuncaoBase::geraLink("pipa", "pipa", "pesquisaPmda", array("idmun"=>$id_municipio))."';
                    </script>";
       }
    }
    
    
    # Declaração de Conformidade 
    public function decIndex() {
        include_once "mod_pipa/backEnd/View/index/indexDconf.php";
    }
    
    
    # nova declaracao
    public function novoDconf() {
        include_once "mod_pipa/backEnd/View/tdap/declaracao.php";
    }
    
    
    # Visualizar Alteraçao de comunidade
    public function altera_com_view() {
        include_once "mod_pipa/backEnd/View/pmda/altera_comunidade_processo.php";
    }
    
    
    

}
