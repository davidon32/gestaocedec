<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/core/system/config/config.inc.php';

# plugins
//include_once PATH . '/plugins/phplot-6.1.0/phplot.php';
include_once PATH . '/vendor/mk-j/php_xlsxwriter/xlsxwriter.class.php';




include_once PATH . '/vendor/mimemessage/email_message.php';
include_once PATH . '/vendor/mimemessage/sendmail_message.php';

//include PATH.'/vendor/autoload.php';

# core/classe 
spl_autoload_register(function ($class_name) {
    try{
    include PATH.'/core/classe/Classe.'.$class_name . '.php';
    } catch (Exception $e){
       Log::LogTxt();
    }
});


#model
include_once PATH . '/core/Model/baseModel.php';

#@ mod cedec
include_once PATH . '/mod_cedec/classe/Classe.ArquivoOficio.php';
include_once PATH . '/mod_cedec/classe/Classe.AcessoCedec.php';
include_once PATH . '/mod_cedec/classe/Classe.AnexoPref.php';
include_once PATH . '/mod_cedec/classe/Classe.Cedec.php';
include_once PATH . '/mod_cedec/classe/Classe.DefesaAgora.php';
include_once PATH . '/mod_cedec/classe/Classe.AguaDoce.php';

#@ modulo pipa
include_once PATH . '/mod_pipa/classe/Classe.Calculo.php';
include_once PATH . '/mod_pipa/classe/Classe.Caminhao.php';
include_once PATH . '/mod_pipa/classe/Classe.Motorista.php';
include_once PATH . '/mod_pipa/classe/Classe.Pipeiro.php';
include_once PATH . '/mod_pipa/classe/Classe.Rota.php';
include_once PATH . '/mod_pipa/classe/Classe.Relatorio.php';
include_once PATH . '/mod_pipa/classe/Classe.Pipeiro.php';
include_once PATH . '/mod_pipa/classe/Classe.Monetary.php';
include_once PATH . '/mod_pipa/classe/Classe.Contrato.php';
include_once PATH . '/mod_pipa/classe/Classe.Voltar.php';
include_once PATH . '/mod_pipa/classe/Classe.Acesso.Pipa.php';
include_once PATH . '/mod_pipa/classe/Classe.rpa.php';
include_once PATH . '/mod_pipa/classe/Classe.Comunidade.php';
include_once PATH . '/mod_pipa/classe/Classe.Pmda.php';
include_once PATH . '/mod_pipa/classe/Classe.PontoCap.php';
include_once PATH . '/mod_pipa/classe/Classe.EquipeCompdec.php';
include_once PATH . '/mod_pipa/classe/Classe.RepPmda.php';
include_once PATH . '/mod_pipa/classe/Classe.AnexoPmda.php';


#@ modulo decreatacao
include_once PATH . '/mod_decreto/classe/Classe.Decretacao.php';
include_once PATH . '/mod_decreto/classe/Classe.Acesso.Decreto.php';
include_once PATH . '/mod_decreto/classe/Classe.Desastre.php';
include_once PATH . '/mod_decreto/classe/Classe.Relatorio.Processo.php';

#@ modulo ajuda
include_once PATH . '/mod_ajuda/classe/Classe.Deposito.php';
include_once PATH . '/mod_ajuda/classe/Classe.Email.php';
include_once PATH . '/mod_ajuda/classe/Classe.fpdf.php';
include_once PATH . '/mod_ajuda/classe/Classe.Liberacao.php';
include_once PATH . '/mod_ajuda/classe/Classe.Acesso.Ajuda.php';
include_once PATH . '/mod_ajuda/classe/Classe.Saldo.php';
include_once PATH . '/mod_ajuda/classe/Classe.Oficial.php';
include_once PATH . '/mod_ajuda/classe/Classe.Pagamento.php';
include_once PATH . '/mod_ajuda/classe/Classe.Produto.php';
include_once PATH . '/mod_ajuda/classe/Classe.Pedido.php';
include_once PATH . '/mod_ajuda/classe/Classe.Material.php';
include_once PATH . '/mod_ajuda/classe/Classe.Transferencia.Material.php';
include_once PATH . '/mod_ajuda/classe/Classe.Transito.php';
include_once PATH . '/mod_ajuda/classe/Classe.Relatorio.ajuda.php';
include_once PATH . '/mod_ajuda/classe/Classe.Unidade.php';
include_once PATH . '/mod_ajuda/classe/Classe.Ajuda.php';
include_once PATH . '/mod_ajuda/Controller/UnidadeController.php';
include_once PATH . '/mod_ajuda/classe/Classe.Fornecedor.php';
include_once PATH . '/mod_ajuda/classe/Classe.H_ajuda.php';


#@ modulo cce
include_once PATH . '/mod_cce/classe/Classe.Evento.php';
include_once PATH . '/mod_cce/classe/Classe.Acesso.Cce.php';
include_once PATH . '/mod_cce/classe/Classe.Diario.php';
include_once PATH . '/mod_cce/classe/Classe.Anexo.Cce.php';
include_once PATH . '/mod_cce/classe/Classe.Boletim.php';

#@ modulo compdec
include_once PATH . '/mod_compdec/classe/Classe.Compdec.php';
include_once PATH . '/mod_compdec/classe/Classe.Acesso.Comdec.php';
include_once PATH . '/mod_compdec/classe/Classe.Relatorio.Comdec.php';
include_once PATH . '/mod_compdec/classe/Classe.Associacao.php';
include_once PATH . '/mod_compdec/classe/Classe.Regiao.php';
include_once PATH . '/mod_compdec/classe/Classe.Territorio.php';
include_once PATH . '/mod_compdec/classe/Classe.AnexoCompdec.php';


#@ modulo Equipe de Apoio
include_once PATH . '/mod_equipe/classe/Classe.Acesso.Equipe.php';
include_once PATH . '/mod_equipe/classe/Classe.Equipe.Funcionario.php';
include_once PATH . '/mod_equipe/classe/Classe.Equipe.Dsp.php';

include_once PATH . '/mod_equipe/Model/FuncionarioEquipeModel.php';
include_once PATH . '/mod_equipe/Model/RegistroDspModel.php';

#@ administracao
include_once PATH . '/mod_admin/classe/Classe.Msg.php';
include_once PATH . '/mod_admin/classe/Classe.Conexao.php';


include_once PATH . '/mod_admin/Model/ReleaseModel.php';
include_once PATH . '/mod_admin/Model/dashboardModel.php';

#@ Mdulo Escola 
include_once PATH . '/mod_escola/classe/Classe.Acesso.Escola.php';
include_once PATH . '/mod_escola/classe/Classe.Professor.php';
include_once PATH . '/mod_escola/classe/Classe.Dao.php';
include_once PATH . '/mod_escola/classe/Classe.Curso.php';

#@ Acesso Externo
//include_once PATH . '/core/classe/Classe.LoginExterno.php';

#@ Plano Contingencia
include_once PATH . '/mod_compdec/classe/Classe.Plano.Cont.php';
include_once PATH .'/mod_cedec/backEnd/Model/DefesaCivilAgoraModel.php';

# estoque
#Model_inject
include_once PATH . '/mod_ajuda/Model/FornecedorEstoqueModel.php'; # tdap
include_once PATH . '/mod_ajuda/Model/ProdutoConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/MarcaConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/Unidade_medConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/CategoriaConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/AlmoxarifadoConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/DestinatarioConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/FornecedorConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/TransportadoraConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/Entrada_notaConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/Itens_notaConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/UnidadeConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/NaturezaConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/PedidoConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/Tp_pedidoConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/Destinatario_finalConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/MontagemConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/RelatorioConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/EventoConEstoqueModel.php';
include_once PATH . '/mod_ajuda/Model/H_pedido_an_tecajuda_hModel.php';
include_once PATH . '/mod_ajuda/Model/H_pedido_prestajuda_hModel.php';
include_once PATH . '/mod_ajuda/Model/H_pedido_benefajuda_hModel.php';
include_once PATH . '/mod_ajuda/Model/H_pedido_anexoajuda_hModel.php';
include_once PATH . '/mod_ajuda/Model/H_pedido_pedidajuda_hModel.php';
include_once PATH . '/mod_ajuda/Model/H_pedido_itensajuda_hModel.php';
include_once PATH . '/mod_ajuda/Model/TransferenciaConEstoqueModel.php';

include_once PATH . '/mod_decreto/Model/PermissaodecretoModel.php';
include_once PATH . '/mod_decreto/Model/ProcessodecretoModel.php';
include_once PATH . '/mod_decreto/Model/CobradeModel.php';
include_once PATH . '/mod_decreto/Model/ProcessodecretoModel.php';




include_once PATH . '/mod_teste/Model/TesteModel.php';