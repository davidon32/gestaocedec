<?php
// Habilita CORS (permite requisições de diferentes origens)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Inclui o controlador
require_once "/mod_index/Controller/indexController.php";

//var_dump('opa_sdc')

// Obtém os dados da requisição POST
$data = json_decode(file_get_contents("php://input"));

// Verifica se os dados foram enviados
if (isset($data->usuario) && isset(md5($data->senha))) {
    $usuario = $data->usuario;
    $senha = $data->senha;

    // Instancia o controlador e chama a função logar
    $controller = new indexController();
    $resultado = $controller->logar($usuario, $senha);

    // Retorna a resposta como JSON
    echo json_encode($resultado);
} else {
    // Retorna um erro caso os dados não tenham sido enviados
    echo json_encode(["success" => false, "message" => "Dados incompletos."]);
}