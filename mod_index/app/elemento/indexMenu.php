<?php 

$campos['link']  = isset($campos['link']) ? $campos['link'] : false;
$campos['class'] = isset($campos['class']) ? $campos['class'] : "fa fa-th";
$campos['label'] = isset($campos['label']) ? $campos['label'] : "hot";
$campos['modulo'] = "index";
$campos['tabela'] = "cedec_usuario";

$usuario = new Usuario();
$menu = new Menu();

$dados = $usuario->pegaPermissao('cedec_usuario');

$menuModulo = array();
foreach ($dados as $value) {
	//var_dump(substr($value['COLUMN_NAME'], 0, 3));
	if(substr($value['COLUMN_NAME'], 0, 3) == "it_"){
		
		$menuModulo[] = $value['COLUMN_NAME'];
	}	
}



$itensVisivel = array();
foreach ($menuModulo as $value) {
		$itensVisivel[$value] = $menu->buscaPermissao($value, 'cedec_usuario');
}

#ajuda Humanitaria
/*if($itensVisivel['it_m_deposito']['it_m_deposito'] == '1'){
	print "<li>
	          <a href=\"?modulo=ajuda&controller=index&action=index\">
	            <i class=\"fa fa-th\"></i> <span>Ajuda Humanitaria</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">hot</small>
	            </span>
	          </a>
	        </li>";
# pipa
}*/

if($itensVisivel['it_m_pipa']['it_m_pipa'] == "1"){
	print "<li>
	          <a href='\?modulo=pipa&controller=pipa&action=index'>
	            <i class=\"fa fa-th\"></i> <span>TDAP</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">hot</small>
	            </span>
	          </a>
	        </li>";

#controle de emergencia
}
if($itensVisivel['it_m_cce']['it_m_cce'] == "1"){
	print "<li>
	          <a href=\"?modulo=cce&controller=cce&action=index\">
	            <i class=\"fa fa-th\"></i> <span>Controle de Emergencia</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">hot</small>
	            </span>
	          </a>
	        </li>";

#decretacao
}
/*if($itensVisivel['it_m_decretacao']['it_m_decretacao'] == "1"){
	print "<li>
	          <a href=\"?modulo=decreto&controller=menu\">
	            <i class=\"fa fa-th\"></i> <span>Decretação</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">hot</small>
	            </span>
	          </a>
	        </li>";
# compdec	
}*/
if($itensVisivel['it_m_comdec']['it_m_comdec'] == "1"){
	print "<li>
	          <a href=\"?modulo=compdec&controller=compdec&action=index\">
	            <i class=\"fa fa-th\"></i> <span>Compdec</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">hot</small>
	            </span>
	          </a>
	        </li>";
#equipe apoio
}
if($itensVisivel['it_m_apoio']['it_m_apoio'] == "1"){
	print "<li>
	          <a href=\"?modulo=equipe&controller=menu\">
	            <i class=\"fa fa-th\"></i> <span>Equipe</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">hot</small>
	            </span>
	          </a>
	        </li>";
#poco
}
if($itensVisivel['it_m_poco']['it_m_poco'] == "1"){
	print "<li>
	          <a href=\"?modulo=cedec&controller=index&action=index\">
	            <i class=\"fa fa-th\"></i> <span>CEdec</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">hot</small>
	            </span>
	          </a>
	        </li>";

#escola
}
/*if($itensVisivel['it_m_escola']['it_m_escola'] == "1"){
	print "<li>
	          <a href=\"?modulo=escola&controller=menu\">
	            <i class=\"fa fa-th\"></i> <span>Escola</span>
	            <span class=\"pull-right-container\">
	              <small class=\"label pull-right bg-green\">hot</small>
	            </span>
	          </a>
	        </li>";
	
}*/

?>