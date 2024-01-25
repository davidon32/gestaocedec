<?php include_once "core/Model/indexModel.php" ?>
<?php include_once "mod_pipa/Model/IndexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<br>
<div class="container" style="height:80vh">
    <div class="d-flex align-items-start flex-column flex-md-row">
        <div class="col-md-12 text-center">
            <?php
            if (isset($_GET['volta']) == 'compdec') {
                print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("compdec", "compdec", "index") . "\">Voltar</a></div>";
            } else {
                print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("pipa", "pipa", "index") . "\">Voltar</a></div>";
            }
            ?>
        </div>

        <div class="col-md-12">
            <br><br>
          <!--	<a class='btn btn-primary btn-lg' href='<?= FuncaoBase::geraLink("pipa", "pipa", "caduser") ?>' title='Cadastro de Usuários COMPDEC'>Cadastro de Usuários (COMPDEC)</a><br>					-->
            <div class="row">
                <div class="col-md-6 text-center">
                    <a href='<?= FuncaoBase::geraLink("pipa", "pipa", "pesquisaUsuario", array('volta' => 'compdec')) ?>' title='Alterar dados do Usuário COMPDEC'><img src="/core/imagem/icon_app/edit_user.png" width="100"></a>
                    <br>
                    <span>Alteração Usuários (COMPDEC)</span>
                </div>
                <div class="col-md-6 text-center">
                    <a href='<?= FuncaoBase::geraLink("pipa", "pipa", "validauser", array('volta' => 'compdec')) ?>' title='Validar Novo Usuário'><img src="/core/imagem/icon_app/check_user.png" width="100"></a>
                    <br>
                    <span>Validar Novo Cadastro Usuário</span>
                </div>
            </div>
        </div> 
        <div class="col-md-12 p-2">
        <br>
        <br>

        <legend>Usuários pendente Validação de acesso</legend>
            <table class="table table-condensed table-bordered">
                <th>#</th>
                <th>Município</th>
                <th>Usuário</th>
                <th>CPF</th>
                <th>Cargo</th>
                <th>Profissão</th>
                <th>Ofício</th>
                <th>Validado por</th>
                <th>Ações</th>

                <?php
                
                # lista de usuario que estão em espera para validar
                
                foreach ($new_users as $key =>$new_user) {

                    print "<tr>";
                    print "<td>".($key+1)."</td>";
                    print "<td>".$new_user['id_municipio']."</td>";
                    print "<td>".$new_user['usuario']."</td>";
                    print "<td>".$new_user['cpf']."</td>";
                    print "<td>".$new_user['cargo']."</td>";
                    print "<td>".$new_user['profissao']."</td>";
                    print "<td>".$new_user['tmpAnexo']."</td>";
                    print "<td>".$new_user['user_id_valida']."</td>";
                    
                    # link de ações
                    print "<td>
                        
                    </td>";
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