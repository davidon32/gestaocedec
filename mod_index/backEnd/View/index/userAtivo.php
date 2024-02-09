<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";
?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<div class="col-md-12 text-center">
    <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "paebmindex") ?>' class='btn btn-primary'>Voltar</a></p>
</div>

<div class="row">

    
    <div class="col-md-12 text-center">
        <legend>Usuários Ativos no Sistema</legend>
        
        <p>Os usuários abaixo, são os usuários queestá aptos a consultar os processos de Protocolo de PAE</p>
        
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Empreendedor</th>
                <th>CNPJ</th>
                <th>Nome Usuário</th>
                <th>CPF</th>
                <th>Opções</th>
            </tr>
            
            <?php
            
            $usuarios = Usuario::busca("ATIVADO", "pae");
            
            
            foreach ($usuarios as $key => $usuario) {
                
                print "<tr>";
                print "<td>".($key+1)."</td>";
                print "<td>".$usuario['usuario']."</td>";
                print "<td>".$usuario['usuario']."</td>";
                print "<td>".$usuario['usuario']."</td>";
                print "<td>".$usuario['cpf']."</td>";
                
                print "<td>";
                print "<a href='#' title='Desativar o Acesso do Usuário'><img src='/core/imagem/cancela.png' width='25'></a>";
                print "</td>";
                print "</tr>";
                
            }
            
            
            
            ?>
            
            
            
        </table>
    </div>
</div>


</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>