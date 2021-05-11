<?php if(!empty($modulo)){
		include_once('mod_'.$modulo.'/app/'.$secao."/index.php");
	}else {
		
		include_once "core/app/".$secao."/".$action.".php".$param;
		//var_dump("core/app/".$secao."/".$action.".php".$param);
	}
?>