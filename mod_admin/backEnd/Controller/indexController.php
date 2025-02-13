<?php

include_once "core/Controller/Controller.php";
include_once "core/Model/Model.php";

    
    class indexController extends Controller{
     
        public function index(){
            
            include_once("mod_admin/backEnd/View/index.php");
            
        }
        
        public function master(){
        
            include_once("mod_admin/View/master.php");
        }

    
        
 
}?>