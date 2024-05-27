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
    <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "index1") ?>' class='btn btn-primary'>Voltar</a></p>
</div>
<!-- modulos de acesso -->
<div class="row">

    <!--    PAEBM  -->
    <div class="col-md-6 text-center">
        <a class="" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=paebm" ?>" title="Protocolo PaeBM"><img width="120" src="core/imagem/pae.png"><br />Acessar Protocolo PAE</a>
    </div>
    <div class="col-md-6 text-center">
        <a class="" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=userAtivo" ?>" title="Usuários Ativos"><img width="120" src="core/imagem/manager_user.png"><br />Acesso Empreendedores</a>

    </div>
    <p>Os Usuários abaixo precisam ser validados para acesso os seus respectivos Processos de PAE </p>
    <div class="col-md-12 text-center">
        <legend>Usuários para Validação</legend>


        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Empreendedor</th>
                <th>CNPJ</th>
                <th>Nome Usuário</th>
                <th>CPF</th>
                <th>Situação</th>
                <th>Opções</th>
            </tr>

            <?php
            $usuarios = Usuario::busca(null, "pae");


            foreach ($usuarios as $key => $usuario) {


                if ($usuario['situacao'] == "ATIVADO") {
                    $opcao = true;
                    $status = "class='text-success'";
                } else {
                    $opcao = false;
                    $status = "class='text-danger'";
                }

                print "<tr>";
                print "<td>" . ($key + 1) . "</td>";
                print "<td>" . $usuario['empreendedor'] . "</td>";
                print "<td>" . $usuario['cnpj'] . "</td>";
                print "<td>" . $usuario['usuario'] . "</td>";
                print "<td>" . $usuario['cpf'] . "</td>";
                print "<td>" . $usuario['situacao'] . "</td>";

                print "<td " . $status . ">";

                if($opcao) {
                    //print "<a href='".FuncaoBase::geraLink("index", "index", "userManager", array('id'=>$usuario['id'], 'status' => 'DESATIVADO'))."' onclick=\"return confirm('Deseja Realmente desativar o o usuário ?')\"  title='Clique aqui para DESATIVAR Acesso !'><img src='/core/imagem/check.png' width='25'></a>";
                    # desativar usuario
                    print "<a href='".FuncaoBase::geraLink("index", "index", "userManager", array('id'=>$usuario['id'], 'status' => 'DESATIVADO'))."' onclick=\"if(!confirm('Deseja Realmente desativar o o usuário ?')) event.preventDefault()\"  title='Clique aqui para DESATIVAR Acesso !'><img src='/core/imagem/check.png' width='25'></a>";
                }else {
                 
                    # ativar usuario
                    print "<a href='".FuncaoBase::geraLink("index", "index", "userManager", array('id'=>$usuario['id'],'status' => 'ATIVADO'))."' onclick=\"if(!confirm('Deseja Realmente desativar o o usuário ?')) event.preventDefault()\" title='Clique aqui para ATIVAR Acesso !'><img src='/core/imagem/cancela.png' width='25'></a>";
                }
                    # resetar Senha
                    print "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='".FuncaoBase::geraLink("index", "index", "resetarSenha", array('id'=>$usuario['id']))."' onclick=\"if(!confirm('Deseja Resetar a senha do usuário ".$usuario['usuario']." ?')) event.preventDefault()\" title='Clique aqui para RESETAR A Senha !'><img src='/core/imagem/acesso40x40.png' width='25'></a>";

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
<script>
    
    
    $(document).ready(function(){
       
//       $("a").click(function(){
//          
//          //alert($(this).data('id'));
//           
//       });        
        
    });
    
    
    
    </script>