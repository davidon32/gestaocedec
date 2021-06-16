<?php


?>

<form action="#" method="post" enctype="multipart/form-data">
    
    <input type="file" name="fl_upload" id="fl_upload">
    
    <input type="submit" name="btn_enviar" id="btn_enviar" value="enviar">
</form>


<?php

$btn = isset($_POST['btn_enviar']) ? $_POST['btn_enviar']:"";
$files = isset($_FILES) ? $_FILES['fl_upload'] : "";
$error = isset($_FILES) ? $_FILES['fl_upload']['error'] : "";
if($_POST['btn_enviar'] == "enviar")
    
    if($error == 0 ){
        var_dump($_REQUEST, $_FILES);
        print ($files['size'] / (1024 * 1024));
    }else if ($error == 4) {
        print "arquivo nao anexado !";
    }

?>