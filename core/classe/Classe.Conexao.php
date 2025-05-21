<?php

class Conexao {

    public static $instance;

    private function __construct() {
        
    }

    public static function getInstance() {
        
        

        if (!isset(self::$instance)) {

            
            /* novo php 8.1 */
            if ($_SERVER['DOCUMENT_ROOT'] == '/web') {
                

                if (TESTE) {
                    //self::$instance = new PDO('mysql:host=200.198.29.229;dbname=teste', 'usuario', 'usuario', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                } else {
                    try {
                        self::$instance = new PDO('mysql:host=200.198.29.227;dbname=gestaocedec', 'usuario', 'usuario', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    } catch (Exception $e) {
                        print "erro ao Conectar!-";
                    }
                }

                /* localhost casa */
                
            } else if ($_SERVER['DOCUMENT_ROOT'] == '/var/www/html/cedec') {

                try {
                    self::$instance = new PDO('mysql:host=localhost;port=3306;dbname=gestaocedec', 'root', '12345678', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                } catch (Exception $e) {
                    print "erro ao Conectar ! - casa";
                }

                /* local host cedec */
            } else if ($_SERVER['DOCUMENT_ROOT'] == 'C:/wamp/www/gestaocedec'){
                
                try {
                    self::$instance = new PDO('mysql:host=localhost;port=3307;dbname=gestaocedec', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                } catch (Exception $e) {
                    print "erro ao Conectar !";
                }
            } else {
                 try {
                    // Load .env file if it exists
                    if (file_exists(__DIR__ . '/../../.env')) {
                        $lines = file(__DIR__ . '/../../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                        foreach ($lines as $line) {
                            if (strpos(trim($line), '#') === 0) continue;
                            list($key, $value) = array_map('trim', explode('=', $line, 2));
                            if (!array_key_exists($key, $_ENV)) {
                                $_ENV[$key] = $value;
                                putenv("$key=$value");
                            }
                        }
                    }
                    $host     = getenv('DB_HOST');
                    $port     = getenv('DB_PORT');
                    $name     = getenv('DB_DATABASE');
                    $user     = getenv('DB_USERNAME');
                    $password = getenv('DB_PASSWORD');

                    self::$instance = new PDO("mysql:host=$host;port=$port;dbname=$name", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    // self::$instance = new PDO('mysql:host=localhost;port=3306;dbname=gestaocedec_local', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                } catch (Exception $e) {
                    throw $e;
                    print "erro ao Conectar !";
                }
            }
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }

    public function __destruct() {

        self::$instance = null;
    }

}

?>