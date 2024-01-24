<?php include_once "core/model/UsuarioExternoModel.php";

class novoUserController extends Controller {
    /* gravar usuario da internet */

    public function gravar() {

        $files = $_FILES;

        $nome = htmlspecialchars($_POST['nome']);
        $cpf = str_replace(array('.', '-'), "", htmlentities($_POST['cpf']));
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $cel = filter_input(INPUT_POST, 'cel');
        $ci = htmlspecialchars($_POST['ci']);
        $profissao = htmlspecialchars($_POST['profissao']);
        $cargo = htmlspecialchars($_POST['cargo']);
        $municipio = filter_input(INPUT_POST, 'municipio', FILTER_VALIDATE_INT);
        $oficio = $files;
        
        $data = [
            'nome' => $nome,
            'cpf'  => $cpf,
            'email'=> $email,
            'cel'  => $cel,
            'ci'   => $ci,
            'profissao'=> $profissao,
            'cargo'=> $cargo,
            'municipio'=>$municipio,
        ];

        $nome_oficio = $municipio."_oficio_".date('is');

        /* veriricação upload file */
        if (
                $oficio['oficio']['error'] == 0 &&
                $oficio['oficio']['size'] <= 2097152 &&
                $oficio['oficio']['type'] == "application/pdf"
        ) {
            $upload = true;
        }

        # verificar usuario nao existe
        $usuario = ( empty(Usuario::buscaUsuarioCPF($cpf)) ) ? true : false;


        # verificar Upload
        if ($usuario && $upload) {
            if(UsuarioExternoModel::store($data, $nome_oficio)){
                print "<script>";
                print "window.location.href='".FuncaoBase::geraLink('admin', 'novoUser', 'sucesso')."'";
                print "</script>";
            }
            
        } else {
            
            print "Usuário ja cadastrado no sistema !";
                       
        }

    }

}
