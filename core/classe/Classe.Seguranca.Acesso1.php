<?php

    ###########################################################################################
    
        /* seguranca para o acesso ao sistema */

    $MODULO = array("mod_ajuda"    => "aju_permissao",
                    "mod_pipa"     => "pip_permissao",
                    "mod_cce"      => "cce_permissao",
                    "mod_escola"   => "esc_permissao",
                    "mod_equipe"   => "equ_permissao",
                    "mod_poco"     => "poc_permissao",
                    "mod_processo" => "dec_permissao",
                    "mod_compdec"  => "com_permissao",
                    "mod_admin"    => "cedec_admin");
    
    /* define acesso a area administrativa */
    define("ADMIM", 'acessoAdm');


    /*  ACESSO AO MODULO PIPA */

    define("CAD_PIPEIRO"  , "cad_pipeiro");
    
    define("CAD_MOTORISTA", "cad_motorista");
    
    define("CAD_CAMINHAO" , "cad_caminhao");
    
    define("CAD_CONTRATO" , "cad_contrato");
    
    define("CAD_ACERTO"   , "acerto");
    
    define("REL_RPA"      , "rel_rpa");
    
    define("REL_BB"       , "rel_bb");
    
    define("REL_IMPOSTO"  , "rel_imposto");
    
    define("REL_CADASTRO" , "rel_cadastro");
    
    define("REL_CONTRATO" , "rel_contrato");
    
    define("CAD_ROTA"     , "cad_rota");
    
    define("REL"          , "sub_relatorio");
    
    define("REL_CONF"     , "rel_conf");
    
    define("REL_CONF_PG"  , "rel_conf_pg");
    
    define("REL_FALTA_PG" , "rel_falta_pg");
    
    define("REL_PG"       , "rel_pg");
    
    define("REL_CON"      , "rel_con");
    
    
    ##############################################################################

    /*  ACESSO AO MODULO EQUIPE */

    define("CAD_FUNCIONARIO", "cad_funcionario");

    define("RELATORIO"      , "relatorio");

    define("DSP"            , "dsp");

    define("CAD_BANCO"      , "cad_banco");

    define("ALT_CAD_FUNC"    , "alt_cad_func");
    
    ###############################################################################
    
    /*  ACESSO MODULO COMPDEC */
    
    define("CAD_COMPDEC", "cad_comdec");

    define("ALT_COMPDEC", "alt_comdec");

    define("CAD_COMSULTA", "cad_consulta");

    define("CAD_REL", "cad_rel");
    
    
    
    
    

?>