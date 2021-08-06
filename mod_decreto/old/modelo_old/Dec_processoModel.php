<?php
/**
 * Grava novos dados do Tabela dec_processo
* Data: 12/11/2018
*
*/
Class Dec_processoModel {
	private $id_processo = null;
	private $ano_processo = null;
	private $data_entrada = null;
	private $num_processo = null;
	private $id_municipio = null;
	private $num_dec_munic = null;
	private $data_dec_munic = null;
	private $dec_vigencia_proc = null;
	private $cod_desastre_cobr = null;
	private $data_venc_process = null;
	private $id_funcionario = null;
	private $homo_num_dec = null;
	private $homo_dt_pub_dec = null;
	private $homo_num_dt_port_dec_rec = null;
	private $homo_num_dt_dou = null;
	private $stat_rec_uniao = null;
	private $stat_n_rec_uniao = null;
	private $stat_arq_estado = null;
	private $stat_hom_estado = null;
	private $stat_analis_estado = null;
	private $stat_aprov_pmda = null;
	private $stat_em_analis_pmda = null;
	private $analista = null;

	public function setId_processo($id_processo) {
		$this->id_processo= $id_processo;
	}

	function getId_processo(){
		return $this->id_processo;
	}

	public function setAno_processo($ano_processo) {
		$this->ano_processo= $ano_processo;
	}

	function getAno_processo(){
		return $this->ano_processo;
	}

	public function setData_entrada($data_entrada) {
		$this->data_entrada= $data_entrada;
	}

	function getData_entrada(){
		return $this->data_entrada;
	}

	public function setNum_processo($num_processo) {
		$this->num_processo= $num_processo;
	}

	function getNum_processo(){
		return $this->num_processo;
	}

	public function setId_municipio($id_municipio) {
		$this->id_municipio= $id_municipio;
	}

	function getId_municipio(){
		return $this->id_municipio;
	}

	public function setNum_dec_munic($num_dec_munic) {
		$this->num_dec_munic= $num_dec_munic;
	}

	function getNum_dec_munic(){
		return $this->num_dec_munic;
	}

	public function setData_dec_munic($data_dec_munic) {
		$this->data_dec_munic= $data_dec_munic;
	}

	function getData_dec_munic(){
		return $this->data_dec_munic;
	}

	public function setDec_vigencia_proc($dec_vigencia_proc) {
		$this->dec_vigencia_proc= $dec_vigencia_proc;
	}

	function getDec_vigencia_proc(){
		return $this->dec_vigencia_proc;
	}

	public function setCod_desastre_cobr($cod_desastre_cobr) {
		$this->cod_desastre_cobr= $cod_desastre_cobr;
	}

	function getCod_desastre_cobr(){
		return $this->cod_desastre_cobr;
	}

	public function setData_venc_process($data_venc_process) {
		$this->data_venc_process= $data_venc_process;
	}

	function getData_venc_process(){
		return $this->data_venc_process;
	}

	public function setId_funcionario($id_funcionario) {
		$this->id_funcionario= $id_funcionario;
	}

	function getId_funcionario(){
		return $this->id_funcionario;
	}

	public function setHomo_num_dec($homo_num_dec) {
		$this->homo_num_dec= $homo_num_dec;
	}

	function getHomo_num_dec(){
		return $this->homo_num_dec;
	}

	public function setHomo_dt_pub_dec($homo_dt_pub_dec) {
		$this->homo_dt_pub_dec= $homo_dt_pub_dec;
	}

	function getHomo_dt_pub_dec(){
		return $this->homo_dt_pub_dec;
	}

	public function setHomo_num_dt_port_dec_rec($homo_num_dt_port_dec_rec) {
		$this->homo_num_dt_port_dec_rec= $homo_num_dt_port_dec_rec;
	}

	function getHomo_num_dt_port_dec_rec(){
		return $this->homo_num_dt_port_dec_rec;
	}

	public function setHomo_num_dt_dou($homo_num_dt_dou) {
		$this->homo_num_dt_dou= $homo_num_dt_dou;
	}

	function getHomo_num_dt_dou(){
		return $this->homo_num_dt_dou;
	}

	public function setStat_rec_uniao($stat_rec_uniao) {
		$this->stat_rec_uniao= $stat_rec_uniao;
	}

	function getStat_rec_uniao(){
		return $this->stat_rec_uniao;
	}

	public function setStat_n_rec_uniao($stat_n_rec_uniao) {
		$this->stat_n_rec_uniao= $stat_n_rec_uniao;
	}

	function getStat_n_rec_uniao(){
		return $this->stat_n_rec_uniao;
	}

	public function setStat_arq_estado($stat_arq_estado) {
		$this->stat_arq_estado= $stat_arq_estado;
	}

	function getStat_arq_estado(){
		return $this->stat_arq_estado;
	}

	public function setStat_hom_estado($stat_hom_estado) {
		$this->stat_hom_estado= $stat_hom_estado;
	}

	function getStat_hom_estado(){
		return $this->stat_hom_estado;
	}

	public function setStat_analis_estado($stat_analis_estado) {
		$this->stat_analis_estado= $stat_analis_estado;
	}

	function getStat_analis_estado(){
		return $this->stat_analis_estado;
	}

	public function setStat_aprov_pmda($stat_aprov_pmda) {
		$this->stat_aprov_pmda= $stat_aprov_pmda;
	}

	function getStat_aprov_pmda(){
		return $this->stat_aprov_pmda;
	}

	public function setStat_em_analis_pmda($stat_em_analis_pmda) {
		$this->stat_em_analis_pmda= $stat_em_analis_pmda;
	}

	function getStat_em_analis_pmda(){
		return $this->stat_em_analis_pmda;
	}

	public function setAnalista($analista) {
		$this->analista= $analista;
	}

	function getAnalista(){
		return $this->analista;
	}

	/**
	 * Popular o model
	 */
	function popular($_post){
		$_post['id_processo'] = isset($_post['id_processo']) ? $_post['id_processo'] : "";
		$_post['ano_processo'] = isset($_post['ano_processo']) ? $_post['ano_processo'] : "";
		$_post['data_entrada'] = isset($_post['data_entrada']) ? $_post['data_entrada'] : "";
		$_post['num_processo'] = isset($_post['num_processo']) ? $_post['num_processo'] : "";
		$_post['id_municipio'] = isset($_post['id_municipio']) ? $_post['id_municipio'] : "";
		$_post['num_dec_munic'] = isset($_post['num_dec_munic']) ? $_post['num_dec_munic'] : "";
		$_post['data_dec_munic'] = isset($_post['data_dec_munic']) ? $_post['data_dec_munic'] : "";
		$_post['dec_vigencia_proc'] = isset($_post['dec_vigencia_proc']) ? $_post['dec_vigencia_proc'] : "";
		$_post['cod_desastre_cobr'] = isset($_post['cod_desastre_cobr']) ? $_post['cod_desastre_cobr'] : "";
		$_post['data_venc_process'] = isset($_post['data_venc_process']) ? $_post['data_venc_process'] : "";
		$_post['id_funcionario'] = isset($_post['id_funcionario']) ? $_post['id_funcionario'] : "";
		$_post['homo_num_dec'] = isset($_post['homo_num_dec']) ? $_post['homo_num_dec'] : "";
		$_post['homo_dt_pub_dec'] = isset($_post['homo_dt_pub_dec']) ? $_post['homo_dt_pub_dec'] : "";
		$_post['homo_num_dt_port_dec_rec'] = isset($_post['homo_num_dt_port_dec_rec']) ? $_post['homo_num_dt_port_dec_rec'] : "";
		$_post['homo_num_dt_dou'] = isset($_post['homo_num_dt_dou']) ? $_post['homo_num_dt_dou'] : "";
		$_post['stat_rec_uniao'] = isset($_post['stat_rec_uniao']) ? $_post['stat_rec_uniao'] : "";
		$_post['stat_n_rec_uniao'] = isset($_post['stat_n_rec_uniao']) ? $_post['stat_n_rec_uniao'] : "";
		$_post['stat_arq_estado'] = isset($_post['stat_arq_estado']) ? $_post['stat_arq_estado'] : "";
		$_post['stat_hom_estado'] = isset($_post['stat_hom_estado']) ? $_post['stat_hom_estado'] : "";
		$_post['stat_analis_estado'] = isset($_post['stat_analis_estado']) ? $_post['stat_analis_estado'] : "";
		$_post['stat_aprov_pmda'] = isset($_post['stat_aprov_pmda']) ? $_post['stat_aprov_pmda'] : "";
		$_post['stat_em_analis_pmda'] = isset($_post['stat_em_analis_pmda']) ? $_post['stat_em_analis_pmda'] : "";

		$this->setId_processo($_post['id_processo']);
		$this->setAno_processo($_post['ano_processo']);
		$this->setData_entrada($_post['data_entrada']);
		$this->setNum_processo($_post['num_processo']);
		$this->setId_municipio($_post['id_municipio']);
		$this->setNum_dec_munic($_post['num_dec_munic']);
		$this->setData_dec_munic($_post['data_dec_munic']);
		$this->setDec_vigencia_proc($_post['dec_vigencia_proc']);
		$this->setCod_desastre_cobr($_post['cod_desastre_cobr']);
		$this->setData_venc_process($_post['data_venc_process']);
		$this->setId_funcionario($_post['id_funcionario']);
		$this->setHomo_num_dec($_post['homo_num_dec']);
		$this->setHomo_dt_pub_dec($_post['homo_dt_pub_dec']);
		$this->setHomo_num_dt_port_dec_rec($_post['homo_num_dt_port_dec_rec']);
		$this->setHomo_num_dt_dou($_post['homo_num_dt_dou']);
		$this->setStat_rec_uniao($_post['stat_rec_uniao']);
		$this->setStat_n_rec_uniao($_post['stat_n_rec_uniao']);
		$this->setStat_arq_estado($_post['stat_arq_estado']);
		$this->setStat_hom_estado($_post['stat_hom_estado']);
		$this->setStat_analis_estado($_post['stat_analis_estado']);
		$this->setStat_aprov_pmda($_post['stat_aprov_pmda']);
		$this->setStat_em_analis_pmda($_post['stat_em_analis_pmda']);

		$dados['id_processo'] = $this->getId_processo();
		$dados['ano_processo'] = $this->getAno_processo();
		$dados['data_entrada'] = $this->getData_entrada();
		$dados['num_processo'] = $this->getNum_processo();
		$dados['id_municipio'] = $this->getId_municipio();
		$dados['num_dec_munic'] = $this->getNum_dec_munic();
		$dados['data_dec_munic'] = $this->getData_dec_munic();
		$dados['dec_vigencia_proc'] = $this->getDec_vigencia_proc();
		$dados['cod_desastre_cobr'] = $this->getCod_desastre_cobr();
		$dados['data_venc_process'] = $this->getData_venc_process();
		$dados['id_funcionario'] = $this->getId_funcionario();
		$dados['homo_num_dec'] = $this->getHomo_num_dec();
		$dados['homo_dt_pub_dec'] = $this->getHomo_dt_pub_dec();
		$dados['homo_num_dt_port_dec_rec'] = $this->getHomo_num_dt_port_dec_rec();
		$dados['homo_num_dt_dou'] = $this->getHomo_num_dt_dou();
		$dados['stat_rec_uniao'] = $this->getStat_rec_uniao();
		$dados['stat_n_rec_uniao'] = $this->getStat_n_rec_uniao();
		$dados['stat_arq_estado'] = $this->getStat_arq_estado();
		$dados['stat_hom_estado'] = $this->getStat_hom_estado();
		$dados['stat_analis_estado'] = $this->getStat_analis_estado();
		$dados['stat_aprov_pmda'] = $this->getStat_aprov_pmda();
		$dados['stat_em_analis_pmda'] = $this->getStat_em_analis_pmda();


		return $dados;
	}
}?>