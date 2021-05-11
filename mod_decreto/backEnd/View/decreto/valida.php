<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once $_SERVER['DOCUMENT_ROOT'].'/include.php';

$_login = new Login ();

$_login->logado ();


include_once($_SERVER['DOCUMENT_ROOT'].'\mod_decreto\classe\Dec_processoCrud.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/classe\Classe.Data.php');

if((isset($_POST['opcao'])) && ($_POST['opcao'] == 'Salvar')){
     # salva
     $_POST['id_processo'] = DataMysql::dataForm($_POST['id_processo']);
     $_POST['ano_processo'] = DataMysql::dataForm($_POST['ano_processo']);
     $_POST['data_entrada'] = DataMysql::dataForm($_POST['data_entrada']);
     $_POST['num_processo'] = DataMysql::dataForm($_POST['num_processo']);
     $_POST['id_municipio'] = DataMysql::dataForm($_POST['id_municipio']);
     $_POST['num_dec_munic'] = DataMysql::dataForm($_POST['num_dec_munic']);
     $_POST['data_dec_munic'] = DataMysql::dataForm($_POST['data_dec_munic']);
     $_POST['dec_vigencia_proc'] = DataMysql::dataForm($_POST['dec_vigencia_proc']);
     $_POST['cod_desastre_cobr'] = DataMysql::dataForm($_POST['cod_desastre_cobr']);
     $_POST['data_venc_process'] = DataMysql::dataForm($_POST['data_venc_process']);
     $_POST['id_funcionario'] = DataMysql::dataForm($_POST['id_funcionario']);
     $_POST['homo_num_dec'] = DataMysql::dataForm($_POST['homo_num_dec']);
     $_POST['homo_dt_pub_dec'] = DataMysql::dataForm($_POST['homo_dt_pub_dec']);
     $_POST['homo_num_dt_port_dec_rec'] = DataMysql::dataForm($_POST['homo_num_dt_port_dec_rec']);
     $_POST['homo_num_dt_dou'] = DataMysql::dataForm($_POST['homo_num_dt_dou']);
     $_POST['stat_rec_uniao'] = DataMysql::dataForm($_POST['stat_rec_uniao']);
     $_POST['stat_n_rec_uniao'] = DataMysql::dataForm($_POST['stat_n_rec_uniao']);
     $_POST['stat_arq_estado'] = DataMysql::dataForm($_POST['stat_arq_estado']);
     $_POST['stat_hom_estado'] = DataMysql::dataForm($_POST['stat_hom_estado']);
     $_POST['stat_analis_estado'] = DataMysql::dataForm($_POST['stat_analis_estado']);
     $_POST['stat_aprov_pmda'] = DataMysql::dataForm($_POST['stat_aprov_pmda']);
     $_POST['stat_em_analis_pmda'] = DataMysql::dataForm($_POST['stat_em_analis_pmda']);
     $_POST['analista'] = DataMysql::dataForm($_POST['analista']);
     $salvar = new cce_diarioController();

     if($salvar->cce_diarioInsert($_POST)){
          print 'sucesso';
     }
}elseif ((isset($_POST['opcao'])) && ($_POST['opcao'] == 'Update')) {
     # Atualiza
     $_POST['id_processo'] = DataMysql::dataForm($_POST['id_processo']);
     $_POST['ano_processo'] = DataMysql::dataForm($_POST['ano_processo']);
     $_POST['data_entrada'] = DataMysql::dataForm($_POST['data_entrada']);
     $_POST['num_processo'] = DataMysql::dataForm($_POST['num_processo']);
     $_POST['id_municipio'] = DataMysql::dataForm($_POST['id_municipio']);
     $_POST['num_dec_munic'] = DataMysql::dataForm($_POST['num_dec_munic']);
     $_POST['data_dec_munic'] = DataMysql::dataForm($_POST['data_dec_munic']);
     $_POST['dec_vigencia_proc'] = DataMysql::dataForm($_POST['dec_vigencia_proc']);
     $_POST['cod_desastre_cobr'] = DataMysql::dataForm($_POST['cod_desastre_cobr']);
     $_POST['data_venc_process'] = DataMysql::dataForm($_POST['data_venc_process']);
     $_POST['id_funcionario'] = DataMysql::dataForm($_POST['id_funcionario']);
     $_POST['homo_num_dec'] = DataMysql::dataForm($_POST['homo_num_dec']);
     $_POST['homo_dt_pub_dec'] = DataMysql::dataForm($_POST['homo_dt_pub_dec']);
     $_POST['homo_num_dt_port_dec_rec'] = DataMysql::dataForm($_POST['homo_num_dt_port_dec_rec']);
     $_POST['homo_num_dt_dou'] = DataMysql::dataForm($_POST['homo_num_dt_dou']);
     $_POST['stat_rec_uniao'] = DataMysql::dataForm($_POST['stat_rec_uniao']);
     $_POST['stat_n_rec_uniao'] = DataMysql::dataForm($_POST['stat_n_rec_uniao']);
     $_POST['stat_arq_estado'] = DataMysql::dataForm($_POST['stat_arq_estado']);
     $_POST['stat_hom_estado'] = DataMysql::dataForm($_POST['stat_hom_estado']);
     $_POST['stat_analis_estado'] = DataMysql::dataForm($_POST['stat_analis_estado']);
     $_POST['stat_aprov_pmda'] = DataMysql::dataForm($_POST['stat_aprov_pmda']);
     $_POST['stat_em_analis_pmda'] = DataMysql::dataForm($_POST['stat_em_analis_pmda']);

     $update = new cce_diarioController();
if($update->cce_diarioUpdate($_POST)){
     print 'sucesso';
}
}elseif ((isset($_POST['opcao'])) && ($_POST['opcao'] == 'Delete')) {
     # delete
}elseif ((isset($_POST['opcao'])) && ($_POST['opcao'] == 'Listagem')) {
     # listagem
}elseif ((isset($_POST['opcao'])) && ($_POST['opcao'] == 'Pesquisa')) {
     
     $pesquisa = new dec_processoController();
     $lista = $pesquisa->listagemMunicipio($_POST['municipio']);
     
print "<table class='table'>
<tr><br><td>Código</td>
<td>Num. Processo</td>
<td>Ano</td>
<td>Município</td>
<td>Opções</td>
</tr>";
if(count($lista) > 0){
foreach ($lista as $key => $value) {
print "<tr>";
print "<td><a href='javascript:edit(".$value['id_processo'].")' name='lnk_click' id='".$value['id_processo']."' data-id_processo='".$value['id_processo']."'>".$value['id_processo']."</a></td>";
print "<td><a href='javascript:edit(".$value['id_processo'].")' name='lnk_click' id='".$value['num_processo']."' data-id_processo='".$value['id_processo']."'>".$value['num_processo']."</a></td>";
print "<td><a href='javascript:edit(".$value['id_processo'].")' name='lnk_click' id='".$value['id_processo']."' data-id_processo='".$value['id_processo']."'>".$value['ano_processo']."</a></td>";
print "<td><a href='javascript:edit(".$value['id_processo'].")' name='lnk_click' id='".$value['id_processo']."' data-id_processo='".$value['id_processo']."'>".$value['nome']."</a></td>";
print "<td><a href='javascript:delete(".$value['id_processo'].")' name='lnk_delete' id='".$value['id_processo']."' data-id_processo='".$value['id_processo']."'>deletar</a></td>";
print "</tr>";
}
}else {
print "<tr><td colspan='5'><span class='alert alert-danger'>A Busca não encontrou registros !</span></td></tr>";
}
print "</table>";
}else {
# algo errado
}?>