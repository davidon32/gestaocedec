<?php include_once('core/Controller/Controller.php');
 
class AjudaHumanController extends Controller
{

    public function index(){
        include_once('mod_ajuda/FrontEnd/View/pedidoAjuda/index.php');
    }
    
    # novo pedido
    public function novo(){
        include_once('mod_ajuda/FrontEnd/View/pedidoAjuda/novopedido.php');
    }
    # Prestação de contas
    public function presconta(){
        include_once('mod_ajuda/FrontEnd/View/pedidoAjuda/prestconta.php');
    }
    
}


