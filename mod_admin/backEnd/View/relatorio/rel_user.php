<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_admin/Model/admModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<div class="row">
    <div class="col-md-12 text-center">
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("admin", "adm", "relatorio");?>">Voltar</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <legend>Relatório de Usuários do SDC </legend>
        <br>
        <table class="table table-bordered table-condensed">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Situação</th>
                <th>Email</th>
                <th>login</th>
                <th>Último Acesso</th>
                <th>Nivel</th>
                <th>Administrador</th>
                <th>Seção</th>
                <th>Posto</th>
                <th>Função</th>
                <th>Descrição Função</th>
            </tr>
            
            <?php
            
            $filtro = isset($agente) ? $agente : "";
            if(!empty($filtro)){
                $usuarios = Usuario::dadosUsuarios('agente');
            }else {
                $usuarios = Usuario::dadosUsuarios();
            }
            foreach ($usuarios as $key => $usuario) {
                
            
            
                print "<tr>";
                print "<td>".($key+1)."</td>";
                print "<td>".$usuario['nome']."</td>";
                print "<td>".(($usuario['situacao'] == 1) ? "Ativo" : "Inativo")."</td>";
                print "<td>".$usuario['email_rec']."</td>";
                print "<td>".$usuario['login']."</td>";
                print "<td>". DataMysql::dataCompletaVisual($usuario['ultimo_acesso'])."</td>";
                print "<td>".$usuario['nivel']."</td>";
                print "<td>".(($usuario['cedec_admin'] == 1) ? "Sim" : "Não")."</td>";
                print "<td>".$usuario['secao']."</td>";
                print "<td>".$usuario['posto']."</td>";
                print "<td>".$usuario['funcao']."</td>";
                print "<td>".$usuario['desc_funcao']."</td>";
                print "</tr>";
            }
            ?>
            
        </table>
        
    </div>
</div>
       
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>