<?php

/*  exemplo de formulario 
 * 
 * $html->form("secao.php?secao=login&acao=recsenha", "POST", "frmResSenha", "frmResSenha");
*     
*  $html->input("text", "txtLogin", "txtLogin", "Login");
*     
*  $html->input("text", "txtEmail", "txtEmail", "email", array("class"=>"pull-left")); 
*     
*  $html->span("Coloque o email que está Cadastro no sistema !");
* 
*  $html->input("submit", "btnEnviar", "btnEnviar", false, array("class"=>"btn", "value"=>"Resetar"));
*     
*  $html->endForm();
*
************************************************************************************************************/
class Html {
    
    /**
     *  Input HTML
     *  opções: classe
     *          maxlength
     *          evento javascript
     *          value
     *          placeholder
     * 
     * @param Tipo string
     * @param nome string
     * @param label string (label do campo)
     * @param arrauOpcao array (opcoes html ex. value etc.)
     * @param $options array para select
     * @param default opcao default para select ou radio, checkbox
     * 
     * ex: Html::input("text", "name", "label", array("value"=>"cadastro", "placeholder"=>"Digite seu nome"))
     */
    static function input($tipo, $nome, $label=false, $htmlOpcao = false, $dadosOptions = array(), $default = false, $span = false) {

        $html_op = "";
        
        $span_print = (strlen($span) > 0) ? " <span class=''>".$span."</span>" :"" ;
       

        if($htmlOpcao != false) {
            foreach ($htmlOpcao as $key => $value) {
    
                $html_op .= " ".$key . "=\"" . $value . "\" ";
    
            }
        }

        # INPUT
        if($tipo == 'submit') {
            
            $input = '<br>';
        
        # TEXT
        }else if($tipo == 'text') {

            print "<div class='span6' style='margin-left:5px; margin-right:5px;'>
                    <label id='lb".ucwords($nome)."'>".(!empty($label) ? $label : ucwords($nome))."</label>".$span_print."
                    <input class='form-control' type=\"" . $tipo . "\" name=\"txt".ucwords($nome)."\" id=\"txt".ucwords($nome)."\" " . $html_op . "/>    
                   </div>";
        
        # SELECT
        }else if($tipo == 'select'){
           
           print "<div class='span6' style='margin-left:5px; margin-right:5px;'>
                  <label>".(!empty($label) ? $label : ucwords($nome))."</label>
                  <select class='span12' name=\"sel".ucwords($nome)."\" id=\"sel".ucwords($nome)."\" />";
                  
                  if(!$default){
                    
                    print "<option value=\"\">Escolha um ".ucwords($label)."</option>";    
                      
                  }else {
                      
                      print "<option value=\"".$default[0][0]."\">".$default[0][1]."</option>";
                  }
                  
         for ( $i =0; $i < count($dadosOptions) ; $i++ ) {
             
             print "<option value=\"".$dadosOptions[$i][0]."\">".utf8_encode($dadosOptions[$i][1])."</option>";
         }
         
         print "</select>
                </div>";
    
        }elseif ($tipo == 'hidden'){
        	print "<input class='span6' type=\"" . $tipo . "\" name=\"txt".ucwords($nome)."\" id=\"txt".ucwords($nome)."\"" . $html_op . "/>";
        }
    }

    /**
     * Formulario HTML
     * @param action
     * @param method
     * @param name
     * @param titulo
     * @param opcoes array 
     * 
     * ex. Html::form("#", "POST", "frmCadastro", "frmCadastro");
     */
    static function form($action, $method, $nome, $titulo="Titulo do Formulario", $arrayOpcao = false) {

        $opcao = "";

        if ($arrayOpcao != false) {

            foreach ($arrayOpcao as $key => $value) {

                $opcao .= $key . "=\"" . $value . "\" ";

            }
        }
        
        print "<legend>".$titulo."</legend>";

        print "<form action=\"" . $action . "\" method=\"" . $method . "\" name=\"frm" . ucwords($nome) . "\" id=\"frm" . ucwords($nome) . "\" " . $opcao . "/>";

    }

    /**
     * fecha o formulario Html
     * 
     *  ex. Html::endForm();
     */
    static function formEnd($botao, $opcao=false) {
    	
    	$html = "";
    	if($opcao){
    		foreach ($opcao as $key => $value) {
    			$html .=" ".$key."='".$value."'"; 
    		}
    	}

        print "<div class='span12'>
                <input class='btn btn-primary' type='submit' name='btn".ucwords($botao)."' id='btn".ucwords($botao)."' value='".ucwords($botao)."' $html>
                </div>
               </form>";

    }
    
    
     
     /**
      * Elemento HTML span
      * 
      */
     function span($texto, $arrayOpcao = false){
         
         $opcao = "";
             
         if($arrayOpcao != false) {
         
             foreach ($arrayOpcao as $key => $value) {
                 
                 $opcao .= $key."=\"".$value."\" ";
             }

         }
         
         print "&nbsp;&nbsp<span ".$opcao.">".$texto."</span>";
         
     }
     
     
    
     
     /**
      * 
      * 
      * @param name 
      * @param id
      * @param label
      * @param dados <option>
      * @param default array("0", "Sim")
      * @param opcoes (opções Html)
      * 
      * @param dados array(
      * 					array('1','Ativo'),
      * 					array('0','Inativo')
      * 				  )
      * 
      */
     
     
     public static function inputSelect($name, $id, $label = null, $dadosArray=null, $defaultArray=null, $opcoes =null ) {

     	if(is_null($label)){
     			
     	}else {
         print "<label>".$label."</label>";
     	}
         
         print "<select class='form-control' name='sel".ucwords($name)."' id='sel".ucwords($id)."' ".$opcoes.">
         		<option value='".$defaultArray[0][0]."'>".$defaultArray[0][1]."</option>
         		";
         
         

         for ($i = 0; $i < count($dadosArray); $i++) {
             
             print "<option value=".$dadosArray[$i][0].">".utf8_encode($dadosArray[$i][1])."</option>";
             
         }
         
         
         print "</select>";
         
         
         
         
         
     }
     
     

    /**
     * Campo 
     * 
     * 
     */

// $option = array("1"=>"Demetrio", "2"=>"Jose", "3"=>"Maria");
// 
// Html::form("#", "POST", "frmCadastro", "frmCadastro");
    // Html::input("text", "txtNome", "txtNome", array('maxlength' => "10", 'value' => "Cadastrar"));
    // Html::select($option, "selNome", "selNome");
    // Html::input("submit", "btnEnviar", "btnEnviar", array('value' => "Cadastrar", "class" => "btn"));  
// Html::endForm();
// 
// var_dump($_REQUEST);

}?>