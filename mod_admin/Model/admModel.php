<?php

$page = array(
	'titulo' => "SGE - Sistema de Gestão Estratégica / CEDEC-MG",
	'titulo1' => "-",
	'model' => 'admin',
	'modulo' =>'admin',
);



    class AdmModel {
        
        public function index(){
             include_once('view/geral.php');  
        }
        
        public function usuarioexView(){
        	$aux = "";
        	include_once ('view/usuarioex.php');
        }
        
        public function buscausuex(){
        	$aux = "";
        	include_once ('view/buscausuex.php');
        }
        
        public function adm(){
        	$aux = "";
        	include_once ('view/index.php');
        }
        
        public function ativaCad(){
        	$aux = "";
        	include_once ('view/ativaCad.php');
        }
        
        
        
    }?>
