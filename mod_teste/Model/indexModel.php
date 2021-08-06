<?php include_once('core/Model/Model.php');

$page = array(
    'model' => 'admin',
    'modulo' => 'admin',
    'action' => Model::getContexto($_GET['controller'], $_GET['action']),
);

Class indexModel extends Model {
    
}