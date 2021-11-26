<?php include_once('core/Controller/Controller.php');
 include_once 'core/include.php';

class agoraController extends Controller {
    /* Index */

    public function index() {
        include_once 'mod_cedec/backEnd/View/agora/index.php';
    }

    /* Cadastro */

    public function cadadm() {
        include_once 'mod_cedec/backEnd/View/agora/cadadm.php';
    }

    /* Cadastro */

    public function editar() {
        include_once 'mod_cedec/backEnd/View/agora/editar.php';
    }

    /* Cadastro */

    public function cadastro() {
        include_once 'mod_cedec/backEnd/View/agora/cadastro.php';
    }

    /* validar */

    public function valida() {
        include_once 'mod_cedec/backEnd/View/agora/valida.php';
    }

    /* lista */

    public function lista() {
        include_once 'mod_cedec/backEnd/View/agora/lista.php';
    }

    /* lista */

    public function listasite() {
        include_once 'mod_cedec/backEnd/View/agora/listasite.php';
    }

    /* lista */

    public function view() {
        include_once 'mod_cedec/backEnd/View/agora/view.php';
    }

    /* BUSCA */

    public function busca() {
        include_once 'mod_cedec/backEnd/View/agora/busca.php';
    }

    public function listCategoria() {
        
    }

    # grava comentario

    public function gravarComentario() {

        include_once 'mod_cedec/backEnd/View/agora/valida.php';
    }

    # form postagem

    public function cadpost() {
        include '/dc_agora/cadastro.php';
    }

    # gravar postagem

    public function postagem() {
        
        $post = $_POST;
        
        $agora = new DefesaCivilAgoraModel();

        $nomeImagem = date('dmYHis') . 'def_agora';

        $post['imagem1'] = $nomeImagem . ".png";

        $img = $_POST['imageData'];

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);

        $data = base64_decode($img);

        $file = $_SERVER['DOCUMENT_ROOT'] . "/anexo/def_civil_agora/" . $nomeImagem . ".png";

        $file_size = "1887436";
        if ($file_size <= "1887436") {
            
                # upload
                $success = file_put_contents($file, $data);
                # gravar nome arquivo
                var_dump($agora->gravarPost($post));
            } else {
                print "arquivo";
            }
    }

}

?>