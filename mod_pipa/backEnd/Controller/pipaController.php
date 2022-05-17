<?php

include_once PATH . "/core/Controller/Controller.php";
include_once "core/Model/Model.php";

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

                       
            if (Usuario::atuaUsuarioExterno($_POST)) {

                print "<script>
	 			alert('Usuario atualizado com Sucesso !');
                                window.location.href = '".FuncaoBase::geraLink("pipa", "pipa", "pesquisaUsuario", array("volta"=>"compdec"))."';
                                
	 		</script>";
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
        include_once "mod_pipa/backEnd/View/dconf/declaracao.php";
    }
    
    

}
