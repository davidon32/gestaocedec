<?php

include_once 'core/include.php';
include_once PATH . '/core/Controller/Controller.php';
include_once PATH . '/core/Model/UsuarioModel.php';

class equipeController extends Controller {

    public function reg_dsp() {
        /* municipio */
        $municipio = Municipio::listaid_municipioAutocomplete();
        $lista = "";
        foreach ($municipio as $key => $value) {
            $lista .= "<option value=" . $value['id_municipio'] . ">" . $value['nome'] . "</option>";
        }
        /* Evento */
        $evento = CobradeModel::listaid_CobradeAutocomplete();
        $listaEvento = "";
        foreach ($evento as $key => $value) {
            $listaEvento .= "<option value=" . $value['id_cobrade'] . ">" . $value['codigo'] . " - " . $value['descricao'] . "</option>";
        }
        /* Viatura */
        $viaturas = RegDspViatura::listaid_ViaturaAutocomplete();
        $listaViatura = "";
        foreach ($viaturas as $key => $value) {
            $listaViatura .= "<option value=" . $value['id_viatura'] . ">" . $value['placa'] . " - " . $value['nome'] . "</option>";
        }

        /* Integrantes */
        $integrantes = Usuario::listaid_funcionarioAutocomplete();
        $listaInteg = "";
        foreach ($integrantes as $key => $value) {
            $listaInteg .= "<option value=" . $value['id_funcionario'] . ">" . $value['num_masp'] . " - " . $value['posto'] . "-" . $value['nome'] . "</option>";
        }

        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/dsp/reg_dsp.php';
    }

    public function editDsp() {
        $id_dsp = isset($_GET['id']) ? $_GET['id'] : "";


        if ($this->isPost()) {
            if (RegistroDspEquipeModel::edit($_POST)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $this->redirect('equipe', "index", 'index');
            }
        } else {

            $dados = RegistroDspEquipeModel::SearchDsp($id_dsp);
            /* municipio */
            $municipio = Municipio::listaid_municipioAutocomplete();
            $lista = "";
            foreach ($municipio as $key => $value) {
                $lista .= "<option value=" . $value['id_municipio'] . ">" . $value['nome'] . "</option>";
            }
            /* Evento */
            $evento = CobradeModel::listaid_CobradeAutocomplete();
            $listaEvento = "";
            foreach ($evento as $key => $value) {
                $listaEvento .= "<option value=" . $value['id_cobrade'] . ">" . $value['codigo'] . " - " . $value['descricao'] . "</option>";
            }
            /* Viatura */
            $viaturas = RegDspViatura::listaid_ViaturaAutocomplete();
            $listaViatura = "";
            foreach ($viaturas as $key => $value) {
                $listaViatura .= "<option value=" . $value['id_viatura'] . ">" . $value['placa'] . " - " . $value['nome'] . "</option>";
            }

            /* Integrantes */
            $integrantes = Usuario::listaid_funcionarioAutocomplete();
            $listaInteg = "";
            foreach ($integrantes as $key => $value) {
                $listaInteg .= "<option value=" . $value['id_funcionario'] . ">" . $value['num_masp'] . " - " . $value['posto'] . "-" . $value['nome'] . "</option>";
            }
            include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/dsp/reg_dsp_edit.php';
        }
    }

    public function busca_dsp() {
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/dsp/search.php';
    }

    public function reg_dsp_viatura() {
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp_viatura.php';
    }
    
    /* visualizar DSP */
    public function view_dsp() {
        
        $id_dsp = isset($_GET['id']) ? $_GET['id'] : die();
                
        $dados = RegistroDspEquipeModel::SearchDsp($id_dsp);
        
        $anexo = RegistroDspEquipeModel::listAnexo($id_dsp);
        
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/dsp/view.php';
    }

    /* upload de Documentos */

    public function upload_dsp() {

        if ($this->isPost()) {
            $link_google = isset($_POST['txtLinkGoogle']) ? $_POST['txtLinkGoogle'] : "";

                # upload
                if(RegistroDspEquipeModel::upload_doc()){
                    FuncaoBase::alert("Registro Gravado com Sucesso !");
                    $this->redirect('equipe', "index", 'index');
                }  

        } else {
            include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/dsp/upload_doc.php';
        }
    }

    /* gravar DSP */

    public function gravar_dsp() {

        if ($this->isPost()) {
            $registroDsp = new RegistroDspEquipeModel();
            if ($registroDsp->Gravar($_POST)) {
                FuncaoBase::alert("Registro Gravado com Sucesso !");
                $this->redirect('equipe', "equipe", 'reg_dsp');
            }
        }

        var_dump($_POST);
    }

}
