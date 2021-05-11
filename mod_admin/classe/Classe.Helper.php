<?php //include_once("Classe.Funcao.Base.php");
/*************************************************
 *  Helper
 *  Autor : Demetrio da Silva Passos
 *  Data 18/11/2015 - 14:35
 *  
 */
class Helper {


        /**
        * Função para incluir os arquicos css automatico
        * @param $diretorio caminho e diretorio dos arquivos .css para inclusão
        *
        */
        public function css($diretorio){

            FuncaoBase::include_css($diretorio);

        }

        /**
        * Função para a inclusao de arquivos js automatico
        * @param $diretorio caminho e diretorio dos arquivos .js para inclusao
        *
        */
        public function js($diretorio){

            FuncaoBase::include_js($diretorio);

        }

        
        
        /**
         * Função para gerar formularios html  
         * @param $action Action do Formulario
         * @param $method Method post ou get Formulario
         * @param $nome   name e id do formulario
         * @param $titulo titulo exibido para o formulario
         * 
         */
        
        public function form($action = "#", $method = "POST", $nome = "cadastro", $titulo = "Titulo do Formulário"){

            print "";
            print "<div class='span12'>";
            print "<h4>".$titulo."</h4>";
            print "</div>";
            print "<div class='span6 formulario1'>
                        <form action='{$action}' method='{$method}' name='{$nome}' id='{$nome}'>";
            
        }

        /**
         * Função para fechar o formulario gerado
         * @param $botao nome do botão que acionará o formulario
         * 
         */
        public function formEnd($botao = false){

            print "<div class='span12'>";
            
            if($botao) {
                print "<br><p class='text-right'>
                            <input class='btn' type='submit' name='btn".ucwords($botao)."' id='btn".ucwords($botao)."' value='".ucwords($botao)."'>
                      </p>";
            }else {

                print "<br><p class='text-right'> <input class='btn' type='submit' name='btnEnviar' id='btnEnviar' value='Cadastrar'>";
            }
                     
            print "</div>
                </form>
                </div>
                ";

        }
        
        /**
         * 
         * @param $tipo String text, password
         * @param $nome String name, id
         * @param @focus boolean
         * @param $option Array dados com opcoes de input readonly, maxlength etc.
         *  
         *  input text, password
         *
         *
         *
         *
         */
        public function input($tipo = "text", $nome = "campo", $option = array()){
            
            $opcoes = null;
            
            $lista = explode(":", $nome);
            
            // input type=textarea
            if($tipo == "textarea"){
                
                print "<div class='col-md-6 formulario1'>
                        <br>
                        <label for='tex".ucwords($nome)."'>".ucwords($nome)."</label>
                        <textarea class='form-control' name='tex".ucwords($nome)."' id='tex".ucwords($nome)."'>".$option."</textarea>
                        </div>";
            
            // input type=button
            }else if($tipo == "button"){
                
                print "<input type='button' name='btn".ucwords($nome)."' id='btn".ucwords($nome)."' value='".ucwords($nome)."' />";
                
            // input type=radio
            }else if($tipo == "radio"){

                print "<div class='col-md-6 formulario1'>
                        <legend style='font-size:11pt; font-weight:bold;'>".ucwords($nome)."</legend>";

                        foreach ($option as $key => $value) {
                        
                            print "<input type='radio' name='rb".ucwords($nome)."' id='rb".ucwords($nome).$key."' value='".$key."'> ".ucwords($value)."<br>";
                        
                        }
                        
                        print "</div>";
                
            // input type=checkbox
            }else if($tipo == "checkbox") {
                
                print "<div class='col-md-6 formulario1'>
                <br>
                        <label>
                        <input type='checkbox' value='".$option."' name='ck".ucwords($nome)."' id='ck".ucwords($nome)."'>
                        ".ucwords($nome)."
                        </label>
                        </div>";
            
            // input type=select
            }else if($tipo == "select"){

                print "<div class='col-md-6 formulario1'>
                        <br>
                        <label for='txt".ucwords($nome)."'>".ucwords($nome)."</label>
                        <select class='form-control' name='sel".ucwords($nome)."' id='sel".ucwords($nome)."'>";

                print "<option value='0'>Escolha a opção</option>";

                foreach ($option[0] as $key => $value) {
                    
                    print "<option value=".$key.">".$value."</option>";

                }
                
                print "</select></div>";
                
            // input type=text e password
            }else {
                
                foreach ($option as $key => $value) {
                    
                    $opcoes .= " ".$key."='".$value."'";
                }
                
                print "<div class='col-md-6 formulario1'><br><label for='txt".ucwords($nome)."'>".ucwords($nome)."</label>
                <input class='form-control' type='{$tipo}' name='txt".ucwords($nome)."' id='txt".ucwords($nome)."' {$opcoes} >
                </div>";
            
            }
            
        }

        /**
        *   funcao para exibir uma linha no form
        *
        */
        public function linha(){

            print "<div class='col-md-12 formulario1'>
                    <hr>
                    </div>";


        }

}?>