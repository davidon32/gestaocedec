<?php include_once('core/Model/Model.php');

$page = array(
    'model' => 'ajuda',
    'modulo' => 'ajuda',
    'action' => Model::getContexto($_GET['controller'], $_GET['action']),
);

Class indexModel extends Model {
    
}