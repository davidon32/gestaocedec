<?php include_once(PATH.'/include.php');
	include(PATH.'/system/barra_usuario.php');
	

$_modulo = isset($_GET['modulo']) ? $_GET['modulo'] : "menu";
?>
<div class="container">
    <div class="row-fluid">
        <div class="span12">
            <img src="/imagem/logo_novo.png" alt="Topo" width="150px"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="font-size:15pt; color: #0055d4;"><?=FuncaoBase::getModulo($_modulo);?></span>
            <hr>
            <br><br>
        </div>
    
    </div>
</div>
