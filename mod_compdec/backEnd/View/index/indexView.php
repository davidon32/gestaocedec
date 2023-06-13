<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_compdec/Model/Model.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<div class="container">
    <!-- PAGINA -->
    <div class="container">
        <!-- CORPO -->
        <div class="row">
            <div class="col-md-3"></div>
            
            <div class="col-md-3 text-center">
                <a class="thumbnail" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=compdec&controller=compdec&action=buscarAlterar"><img width="110"src='/core/imagem/compdec_searc.png' ><br>Busca / Alteração dados Compdec</a><br> <br>  
            </div>
            
            <div class="col-md-3 text-center">
                <a class="thumbnail" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=compdec&controller=compdec&action=filtroRelatorio"><img width="110" src='/core/imagem/relatorio.png' ><br>Relatórios</a><br> <br>  
            </div>
            <div class='col-md-3'></div>
        </div>
        
        <div class="row">
            <div class='col-md-3'></div>
            
            <div class="col-md-3 text-center">
                <a class="thumbnail" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=compdec&controller=compdec&action=email&"><img width="110" src='/core/imagem/email_icon.png' ><br>Envio Email / Lote</a><br> <br>  
            </div>
            <div class="col-md-3 text-center">
                <!--<a class="btn btn-primary" href="?modulo=pipa&controller=pipa&action=usuario">Add Usuario Externo</a><br> <br>  -->
                <a class="thumbnail" href="<?= FuncaoBase::geraLink('pipa', 'pipa', 'usuario', array('volta' => 'compdec')); ?>"><img width="110" src='/core/imagem/manager_user.png' ><br>Ativar/Editar Usuario</a><br><br>   
            </div>
            <div class='col-md-3'></div>
        </div>
<!--            <div class="col-md-4">
                <a class="btn btn-primary" href="?modulo=compdec&controller=pipa&action=pmdaCom&a=adm">Lista Usuarios</a>   
                
            </div>;-->

            <div class="col-md-12">
                <br>
                <p class="text-center"><a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&&modulo=index&controller=index&action=menu">Voltar</a></p><br> <br>  
            </div>
            <!--<div class="col-md-6">-->
            <!--                <legend>Lista para alteração de dados do COMPDEC</legend>
                            
                            
            //                
            //                $compdecs = Compdec::listaCompdecAtualiza(0);
            //                
            //                //var_dump($compdecs);
            //                foreach ($compdecs as $key=>$compdec) {
            //                    print "<div class='col-md-1'>".($key+1)."</div>";
            //                    print "<div class='col-md-11'><a href='".FuncaoBase::geraLink("compdec", "compdec", "alterarCompdec", array('mun'=>$compdec['id_municipio']))."'>".Municipio::PegaNomeMunicipio($compdec['id_municipio'])."</a></div>";
            //                    
            //                }
            //-->            
            <!--</div>-->
            <div class='col-md-12 text-center'>
            </div>         
        </div> 
        <!-- =================== RODAPE CORPO ==================== -->
        <?php include_once "template/page/corpoRodape.php"; ?>
        <!-- =================== RODAPE  ======================== -->
        <?php include_once "template/page/rodape.php" ?>
        <?php include_once "template/page/barra_config_template.php"; ?>
        <!-- =============== HEADER HTML PAGE ================= -->
        <?php include_once "template/page/rodapePage.php"; ?>