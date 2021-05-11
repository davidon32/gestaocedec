<?php

/*********************************************************************************
 *  Órgão : Coordenadoria Estadual de Defesa Civil de MG - CEDEC/MG
 *  Autor : Demetrio da Silva Passos
 *  Descrição : Montagem de Menu de sistema 
 *  Data: 13/01/2015
 *
 * *******************************************************************************/

class Menu{

/* cabecalho do menu */
function menuCabecalho(){
    
    print "<div class=\"span3\">
       <div class=\"dropdown clearfix\">
           <ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu\" style=\"display: block; position: static; margin-bottom: 5px; *width: 180px;\">";
 
}


/* fechamento do menu */
function menuRodape(){
    
    print "</ul>";
    print "</div>";
    print "</div>";
    
}

/* menu com 1 nivel */                                 
function menuNivel1($_itemNivel1){

        if(($_itemNivel1['permissao'] == 1)){
                        
            print "<li><a href=\"".$_itemNivel1['link']."\" title=\"".utf8_decode($_itemNivel1['title'])."\">".utf8_decode($_itemNivel1['nome'])."</a></li>";
            print ($_itemNivel1['divisor']) == true ? "&nbsp;&nbsp;------------------------------": "";

    }
   
}

/* menu com 2 niveis */
function menuNivel2($itemNivel2){
    
    # inicio item 3
            if(($itemNivel2[0]['permissao'] == 1)){
                     
                    print "<li class=\"dropdown-submenu\">
                                <a title=\"\" href=\"#\">".$itemNivel2[0]['nome']."</a>
                                <ul class=\"dropdown-menu\">";
                                         
                                    for ($i=1; $i < count($itemNivel2); $i++) {
                                                
                                        if($itemNivel2[$i]['permissao'] == 1){
                                                
                                            print "<li><a href=\"".$itemNivel2[$i]['link']."\" title=\"".$itemNivel2[$i]['title']."\">".$itemNivel2[$i]['nome']."</a>";
                                        
                                        }
                                                
                                                print "<ul class=\"dropdown-menu\">
                                                            <li>
                                                                <a href=\"".$itemNivel2[$i]['link']."\" title=\"".$itemNivel2[$i]['title']."\">".$itemNivel2[$i]['nome']."</a>
                                                            </li>
                                                       </ul>";
                                                print ($itemNivel2[$i]['divisor']) == true ? "&nbsp;&nbsp;------------------------------": "";
                                    }
            }
                                            print "</li>";
            
                    print "</li>"; 
    
                        print "</ul>"; 
                        # fim item 3
   
}

    /* menu com 3 niveis */
    function menuNivel3($itemNivel3){
       
    }


    public function buscaPermissao($item, $tabela){

        $con = Conexao::getInstance();

        $dados = "";

        $sql = "select ".$item."   
				from ".$tabela;
			
            $result = Conexao::getInstance()->query($sql);
            
            $result->execute();
                
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return $dados;



    }
}