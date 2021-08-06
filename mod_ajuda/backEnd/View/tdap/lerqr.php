<?php 
require 'vendor/autoload.php';

$app = new Slim\App;

//$app->response()->header('Content-Type', 'application/json;charset=utf-8');
$app->get('/', function () {
echo "SlimProdutos";
});



            
    //$app->response()->header('Content-Type', 'application/json;charset=utf-8');

    $app->post('/produtos','addProduto');


    function addProduto()
        {
            $request = \Slim\Slim::getInstance()->request();
            $produto = json_decode($request->getBody());
            $sql = "INSERT INTO produtos (nome,preco,dataInclusao,idCategoria) values (:nome,:preco,:dataInclusao,:idCategoria) ";
            $conn = getConn();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam("nome",$produto->nome);
            $stmt->bindParam("preco",$produto->preco);
            $stmt->bindParam("dataInclusao",$produto->dataInclusao);
            $stmt->bindParam("idCategoria",$produto->idCategoria);
            $stmt->execute();
            $produto->id = $conn->lastInsertId();
            echo json_encode($produto);
        }
        
        
        //var_dump($_POST);
        
        $app->run();