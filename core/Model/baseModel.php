<?php include_once("Model.php");

class BaseModel extends Model {

    /**
     * @param $botao // primary success info
     * 
     */
    public static function link($botao, $texto, $acesso, $modulo, $controller, $action, $param =false){
        $id ="";
        if(!empty($param)){
            $id = "&id=".$param;
        }
    print "<a class=\"btn btn-".$botao."\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=".$acesso."&modulo=".$modulo."&controller=".$controller."&action=".$action.$id."\">".$texto."</a>";

    }


}?>