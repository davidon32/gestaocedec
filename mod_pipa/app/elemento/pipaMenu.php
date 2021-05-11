<?php 
      
	$campos['link']  = isset($campos['link']) ? $campos['link'] : false;
	$campos['class'] = isset($campos['class']) ? $campos['class'] : "fa fa-th";
	$campos['label'] = isset($campos['label']) ? $campos['label'] : "hot";
	$campos['modulo'] = "pipa";
	$campos['tabela'] = "pip_permissao";
	
	$menu = new Menu();
	
    //print $menu->montaMenu($campos);
    
	
	# menu principal
	print "<li>
	          <a href=\"?modulo=pipa&controller=pipa&action=index\">
	            <i class=\"".$campos['class']."\"></i> <span>Menu Principal</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">".$campos['label']."</small>
	            </span>
	          </a>
	        </li>";
	
	# PMDA
	print "<li>
	          <a href=\"?modulo=pipa&controller=pipa&action=pesquisaPmda\">
	            <i class=\"".$campos['class']."\"></i> <span>Gerencia PMDA</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">".$campos['label']."</small>
	            </span>
	          </a>
	        </li>";
	
	# cadastro Usuario
	print "<li>
	          <a href=\"?modulo=pipa&controller=pipa&action=usuario\">
	            <i class=\"".$campos['class']."\"></i> <span>Cadastro Usuario Compdec</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">".$campos['label']."</small>
	            </span>
	          </a>
	        </li>";
	
	#comunidade
	print "<li>
	          <a href=\"?modulo=pipa&controller=pipa&action=pmdaCom&a=adm\">
	            <i class=\"".$campos['class']."\"></i> <span>Validar Comunidade</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">".$campos['label']."</small>
	            </span>
	          </a>
	        </li>";

?>