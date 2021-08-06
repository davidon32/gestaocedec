<?php include_once 'Classe.Log.php';
/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 																					*
 * 	Classe manipulacao de dadas para visualizacao e inser��o no banco mysql			*
 * 																					*
 * 	Autor: Demetrio da Silva Passos													*
 * 																					*
 * 	Criacao : 01/02/2012															*
 ************************************************************************************/

class DataMysql extends Log {
    
    private $timesTamp ;

    /**
     * Formata a data para gravar no banco. Retorna data Padrão Americano "2015-12-31"
     * @param data formato Brasil ex. 31/12/2014
     * @return data no formato padrao banco de dados (americano)
     */
    static function dataForm($nDtForm) {
        if ($nDtForm != "") {

            $dia = substr($nDtForm, 0, 2);
            $mes = substr($nDtForm, 3, 2);
            $ano = substr($nDtForm, 6, 8);

            return $ano . '/' . $mes . '/' . $dia;
            # saida para gravar no banco 2012/12/31

        }

    }


    /**
     * Formata a data para visualizacao do formulario ou usuario
     * @param data formato ex. 2014/12/31
     * @return data no formato Brasil
     */
    static function dataVisual($nDtForm) {
        if ($nDtForm != "") {

            $ano = substr($nDtForm, 0, 4);
            $mes = substr($nDtForm, 5, 2);
            $dia = substr($nDtForm, 8, 2);

            return $dia . '/' . $mes . '/' . $ano;
            # saida para visualizacao no Form

        }

    }
    
    /**
     * Formata a data e hora para visualizacao do formulario ou usuario 31/12/2015 09:00
     * @param data formato ex. 2014/12/31 09:00:00
     * @return data no formato Brasil
     */
    static function dataCompletaVisual($nDtForm) {
        if ($nDtForm != "") {

            $ano = substr($nDtForm, 0, 4);
            $mes = substr($nDtForm, 5, 2);
            $dia = substr($nDtForm, 8, 2);
            $hora = substr($nDtForm, 11, 2);
            $minuto = substr($nDtForm, 14, 2);

            return $dia . '/' . $mes . '/' . $ano.' '.$hora.':'.$minuto;
            # saida para visualizacao no Form

        }

    }
    
    /**
     * Formata a data com hora para gravar no banco. Retorna data Padrão Americano "2014-12-31 09:00 "
     * @param data formato Brasil ex. 31/12/2014 09:00
     * @return data string
     */
    static function dataCompletaForm($nDtForm) {
        if ($nDtForm != "") {

            $dia = substr($nDtForm, 0, 2);
            $mes = substr($nDtForm, 3, 2);
            $ano = substr($nDtForm, 6, 4);
            $hora = substr($nDtForm, 11, 5);

            return $ano . '-' . $mes . '-' . $dia. ' '.$hora.':00';
            # saida para gravar no banco 2012/12/31 09:00

        }

    }
    

    /**
     * Funcao que devolve a data para documentos por extenso no padrao 31/12/2012
     * @param $nDtForm data no padrão  
     * @return '31 de Dezembro de 2012'
     */
    static function dataExtensoDocumento($nDtForm) {

        $_mes = substr($nDtForm, 3, 2);
        $_dia = substr($nDtForm, 0, 2);
        $_ano = substr($nDtForm, 6, 4);

        //global $mes, $dia, $ano;

        $array_dia = array(1 => 'Segunda', 2 => 'Terca', 3 => 'Quarta', 4 => 'Quinta', 6 => 'Sexta', 7 => 'Sabado', 8 => 'Domingo');

        $array_mes = array(1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro');

        for ($i = 1; $i <= count($array_mes); $i++) {

            if ($_mes == $i)
                return $_dia . ' de ' . $array_mes[$i] . ' de ' . $_ano;

        }

    }
    
    /**
     * Função para fazer somatorio de dados
     * @param $dada
     * @param $dias
     * @param $meses
     * @param $ano
     * @return
     */
    function SomarData($data, $dias, $meses, $ano) {

        //passe a data no formato dd/mm/yyyy
        $data = explode("/", $data);
        $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano));
        return $newData;
    }

    /**
     * Extrai a data de um campo datetime
     * @param data - string data formato completo 
     * @return data dia/mes/ano
     */
    static function extraiData($data) {

        $ano = substr($data, 0, 4);
        $mes = substr($data, 5, 2);
        $dia = substr($data, 8, 2);

        return $dia . '/' . $mes . '/' . $ano;

    }

    /**
     * Extrai a hora do campo date time
     * @param data - string data formato completo
     * @return hora - formato hora:minuto:segundo
     */
    static function extraiHora($hora) {

        $hor = substr($hora, 11, 2);
        $min = substr($hora, 14, 2);
        $seg = substr($hora, 17, 2);

        return $hor . ':' . $min . ':' . $seg;

    }


    // function dataCompleta($data) {
// 
        // switch ($data) {
// 
            // case 01 :
                // $mes = 'Janeiro';
                // break;
            // case 02 :
                // $mes = 'Fevereiro';
                // break;
            // case 03 :
                // $mes = 'Mar�o';
                // break;
            // case 04 :
                // $mes = 'Abril';
                // break;
            // case 05 :
                // $mes = 'Maio';
                // break;
            // case 06 :
                // $mes = 'Junho';
                // break;
            // case 07 :
                // $mes = 'Julho';
                // break;
            // case 08 :
                // $mes = 'Agosto';
                // break;
            // case 09 :
                // $mes = 'Setembro';
                // break;
            // case 10 :
                // $mes = 'Outubro';
                // break;
            // case 11 :
                // $mes = 'Novembro';
                // break;
            // case 12 :
                // $mes = 'Dezembro';
                // break;
            // default :
                // $mes = null;
                // break;
        // }
// 
        // return $mes;
// 
    // }

    /**
     * Validação de data no calendário gregoriano
     * @param data formato dia/mes/ano
     * @return boolean 
     */
    function validaData($data) {

        $dia = substr($data, 0, 2);
        $mes = substr($data, 3, 2);
        $ano = substr($data, 6, 8);

        return checkdate($mes, $dia, $ano);
    }
    
    /**
     * Comparação entre a dataInicio é maior que a dataFinal
     * @param $dataInicio
     * @param $dataFinal
     * @return booleano
     */
     static function compararDatas($dataInicio, $dataFinal){
         
         // Comparando as Datas
        if(strtotime($dataInicio) > strtotime($dataFinal))
        {
        return true;
        }
          else
        {
        return false;
        }
             
     }
     
     /**
      * subtrai dias em uma data 
      * @param Date $data padrao brasil
      * @param String $dias
      * 
      */
     static function subtrairDias($data, $dias) {

        $dias = "-".$dias." days";
    
        return date('d/m/Y', strtotime($dias, strtotime($data)));
    
    }

    /**
      * soma dias em uma data 
      * @param Date $data padrao brasil
      * @param String $dias
      * 
      */
    static function somarDias($data, $dias) {
    
        $dias = "+".$dias." days";
    
        return date('d/m/Y', strtotime($dias, strtotime($data)));
    
    }
    
    
    private static function geraTimestamp($data) {
        $partes = explode('/', $data);

        return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
    }
    
    /**
     * Diferenca de dias entre datas
     * @param String $data_inicio (formato brasil)
     * @param Strinf $data_final
     * @return integer
     */
     static public function diferencaData($data_inicial, $data_final){
         
        
        // Usa a função criada e pega o timestamp das duas datas:
        $time_inicial = DataMysql::geraTimestamp($data_inicial);
        $time_final = DataMysql::geraTimestamp($data_final);
        
        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_inicial - $time_final; // 19522800 segundos
        
        // Calcula a diferença de dias
        $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 
        
        return ($dias >=0) ? $dias: "0";
         
         
     }

     /**
		* Somar datas
		* @param data string
		* @param soma string - dias
		*/

		public static function somarDatea($strDate, $soma){
			
			$dataObj = new DateTime($strDate);

			return $dataObj->add(new DateInterval('P'.$soma.'D'))->format('d-m-Y');
		}

		/**
		* subtrair datas 
		* @param data string
		* @param soma string - dias
		*/

		public static function somarDate($strDate, $sub){
			
			$dataObj = new DateTime($strDate);

			return $dataObj->sub(new DateInterval('P'.$sub.'D'))->format('d-m-Y');
		}

		/**
		* diferenca datas (dias)
		* @param date string
		* @param date1 string 
		*/

		public static function diferencaDate($strDate, $strDate1){
			
			$dataObj = new DateTime($strDate);
			$dataObj1 = new DateTime($strDate1);

			$dif = $dataObj->diff($dataObj1);
			return $dif->days;
		}
     
      
}?>