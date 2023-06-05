<?php

class Controller {

    public function isPost() {

        $post = $_POST;

        return (!empty($post)) ? true : false;
    }

    public function Contexto($action) {

        switch ($action) {
            case "index":
                $result = "Index";
                break;
            case "edit":
                $result = "Edição";
                break;
            case "view":
                $result = "Visualização";
                break;
            case "index1":
                $result = "Tela Inicial / Informações";
                break;
            case "menu":
                $result = "Menu Principal";
                break;
            case "movimentacao":
                $result = "Movimentação";
                break;
            case "separacao":
                $result = "Separação de Mercadoria";
                break;
            case "separar":
                $result = "Separação Mercadoria";
                break;
            case "cadgeral":
                $result = "Cadastro Geral";
                break;
            case "pesquisa":
                $result = "Busca Registro";
                break;
            default:
                $result = "-";
                break;
        }

        return $result;
    }

    /**
     * # redirecionamento de pagina
     * 
     * @param String ""
     * 
     */
    public function redirect($modulo, $controller, $action, $param = null) {

        if (!is_null($param)) {
            $param_array = array();
            foreach ($param as $key => $value) {
                $param_array[$key] = $value;
            }





            $link = FuncaoBase::geraLink($modulo, $controller, $action, $param_array);
        } else {
            $link = FuncaoBase::geraLink($modulo, $controller, $action);
        }


        print "<script>
                 window.location.href = '" . $link . "';
                </script>";
    }
}
