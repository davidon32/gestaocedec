<?php define('MODEL_AJUDA', $_SERVER['DOCUMENT_ROOT']."/mod_ajuda/Model");
 
 define('MODEL_AJUDA_BACKEND', $_SERVER['DOCUMENT_ROOT']."/mod_ajuda/backEnd/Model");
   
define('CONTROLLER_AJUDA', $_SERVER['DOCUMENT_ROOT']."/mod_ajuda/Controller");

define('CONTROLLER_AJUDA_BACKEND', $_SERVER['DOCUMENT_ROOT']."/mod_ajuda/backEnd/Controller");

define('MODEL_EQUIPE', $_SERVER['DOCUMENT_ROOT']."/mod_equipe/model");
   
define('CONTROLLER_EQUIPE', $_SERVER['DOCUMENT_ROOT']."/mod_equipe/controller");

/*
* 
* DATA
*   05.05.2014
*
* TIPO
* 	p = producao
*   d = desenvolvimento
*
* NUM
*   numero da atualizacao ou desenvolvimento
*
* 
* CORRECOES
*   numero de correcoes de uma atualizacao
*    
* EXEMPLO 
*   data-tipo.num-correcoes
*   05.05.2014-a.1-00
* 
*/

define('PATH', $_SERVER['DOCUMENT_ROOT']);

define('TESTE', false);

#@ versao
define('VERSAO', 'versão - 3.4.1.4-24 -  22.03.2022');

# manutencao
define('MANUTENCAO', false);

#@ tempo sessao Adm
define('SESSAOADM', '14400');
// define('SESSAOADM', '15'); //teste debug

#@ tempo sessao Externo
define('SESSAOEX', '1800');
//define('SESSAOEX', '25'); // teste debug

#@ titulo página
define('TITULO', 'Coordenadoria Estadual de Defesa Civil de Minas Gerais');

#@ Modo do Intervalo da atualizacao de dados
/* 0 - QUANTIDADE DE ACESSO
 * 1 - DIAS DE ACESSO  */
define("MODOACESSO", 0);

    define('HASH', hash('sha256', VERSAO));
    
    //var_dump(HASH);

    # Acerto de Timezone do Sistema
    date_default_timezone_set('America/Sao_Paulo');
    
    /**
     * Data Atual CONSTANTE
     * @return Data Hoje formato BRASIL DD/MM/AAAA
     */
     define('HOJE', date('d/m/Y'));
     
     /**
      * Hora Atual
      * @return Hora atual do Sistema
      */
      define('AGORA', date('H:i:s'));
     
     /**
     * Data Atual CONSTANTE
     * @return Data Hoje formato MYSQL AAAA/MM/DD
     */
     define('HOJEBANCO', date('Y/m/d'));

    //var_dump($_SERVER);
  
    $_path = $_SERVER['DOCUMENT_ROOT'];


    if($_path == 'C:/wamp64/www/gestaocedec'){
          
        $_sistema = '';
        
        $_host = 'localhost';

    }else {

        $_sistema = '/web';
                
        $_host = '200.198.29.229';

    }

    //var_dump($_host);
    
    define("FUNC", 1);

    #@ modo de debub 0 = normal 1=debug
    define("DEBUG", 0);

    #pasta do sistema
    define('SISTEMA', $_sistema);


    #@ nome host mysql
    define('HOST', $_host);
    
    # modulo pipa
    define('PIPA', 'mod_pipa');

    # modulo ajuda humanitária
    define('AJUDA', 'mod_ajuda');

    #@ setando a data do sistema fuso horario
    date_default_timezone_set("Brazil/East");

    #@ dias prazo pagamento material
    define("PRAZO", 60); 

    #@ Modo quantidade de acesso para atualizacao de dados
    define("QTDACESSO", 3);
    
    #@ Modo dias de acesso
    define("DIASACESSO", 5);

    #@ rodape
    // define('RODAPE', 'Sistema de Gestão Estratégica da Coordenadoria Estadual de Defesa Civil - CEDEC-MG - '.VERSAO);
    define('RODAPE', '');


    #@ secretário executivo
    define('SECEXEC', 'JULIANO CANCADO DIAS, Ten Cel PM');
    
    define('CHEFEDRH', 'LUCIA HELENA PINTO ALVIM DA SILVA LINO, Cap PM');
    
    define('ODESPESA', 'GIOVANI DE SOUZA SILVA, Ten Cel PM');
    
    define('NUMODESPESA', '100476-1');
      

    //define("PATH_PIPA","");
    
    ####################################################################################################
    
    
    
    
    # MACRORREGIAO PMMG
    
    $_MACRORREGIAO = array('1'=>'SUL DE MINAS',
            '2'=>'ALTO PARANAIBA',
            '3'=>'CENTRAL',
            '4'=>'ZONA DA MATA',
            '5'=>'VALE DO RIO DOCE',
            '6'=>'TRIANGULO',
            '7'=>'CENTRO OESTE',
            '8'=>'JEQUITINHONHA MUCURI',
            '9'=>'NORTE DE MINAS',
            '10'=>'NOROESTE DE MINAS');
            
    
    # TERRITORIO DE DESENVOLVIMENTO       
    $_TERRITORIO_DESENVOLVIMENTO = array('1' => 'Vertentes',
                      '2' => 'Vale do Rio Doce',
                        '3' => 'Vale do Aco',
                        '4' => 'Triangulo Sul',
                        '5' => 'Triangulo Norte',
                        '6' => 'Sul',
                        '7' => 'Sudoeste',
                        '8' => 'Oeste',
                        '9' => 'Norte',
                        '10' => 'Noroeste',
                        '11' => 'Mucuri',
                        '12' => 'Metropolitana',
                        '13' => 'Medio e Baixo Jequitinhonha',
                        '14' => 'Mata',
                        '15' => 'Central',
                        '16' => 'Caparao',
                        '17' => 'Alto Jequitinhonha');
    
    define("VALIDADECOMPDEC", "2020-12-31");
    
    define("EMAILSUPORTECOMPDEC", "demetrio.passos@defesacicvil.mg.gov.br");
?>