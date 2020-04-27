<?php

class relPausasController extends controller {

    public function __construct() {
        //parent::__construct();
        $user = new Users();
        if ($user->isLogged() == false) {
            header("Location: " . BASE_URL . "/login");
        }
    }

    public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $data['user_name'] = $u->getName();
        $data['title'] = 'RELATORIOS';
        $g = new Group();
        $a = new Agentes(0);
        $d = new Diversos();
        $data['group_list'] = $g->getList(1);
        $data['agents_list'] = $a->agentesList();
        if ($u->hasPermission('Pausas')) {
            $this->loadTemplate('relPausas', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function selecao(){
        $data = array();
        $data1 = array();
        $u = new Users();
        $u->setLoggedUser();
        $r = new Reports();
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])){
            $dti = addslashes($_POST['data_inicio']).' '.addslashes($_POST['hora_inicio']);
            $dtf = addslashes($_POST['data_fim']).' '.addslashes($_POST['hora_fim']);
            $grupo = 0;
            if (isset($_POST['grupo']) && $_POST['grupo'] > 0) {
                $grupo = addslashes($_POST['grupo']);
            }
            $agente = 0;
            if (isset($_POST['agente']) && $_POST['agente'] > 0) {
                $agente = addslashes($_POST['agente']);
            }
            $data['pausas_grupo'] = $r->relPausas($dti, $dtf,$grupo,$agente);
            $data['dti'] = $dti;
            $data['dtf'] = $dtf;
            $data['grupo'] = $grupo;
            $this->loadView("relPausasSel", $data);
        }
    }

    public function relPausasLista($dti, $dtf, $grupo,$agente){
        $r = new Reports();
        $data['pausas_agente'] = $r->relPausasLista($dti, $dtf,$grupo,$agente);
        return $data;
    }
    public function relPausasResumoAgentes($dti, $dtf,$agente){
        $r = new Reports();
        $data['pausas_agente'] = $r->relPausasResumoAgentes($dti, $dtf,$agente);
        return $data;
    }
    public function relPausasResumoTempoPausa($dti, $dtf,$agente,$pausa){
        $r = new Reports();
        $reg = $r->relPausasResumoTempoPausa($dti, $dtf,$agente,$pausa);
        return $reg;
    }
    public function relPausasTotal($dti, $dtf, $grupo,$agente){
        $r = new Reports();
        $reg = $r->relPausasTotal($dti, $dtf,$grupo,$agente);
        return $reg;
    }

    public function pausasResumo() {
        $data = array();
        $data1 = array();
        $u = new Users();
        $u->setLoggedUser();
        $a = new Agentes(0);
        $r = new Reports();
        $dti = addslashes($_GET['data_inicio']).' '.addslashes($_GET['hora_inicio']);
        $dtf = addslashes($_GET['data_fim']).' '.addslashes($_GET['hora_fim']);
        $oper = 0;
        $grupo = 0;
        $agente = 0;
        if(isset($_GET['camp']) && $_GET['camp']>0){
            $camp = addslashes($_GET['camp']);
        }
        if(isset($_GET['agents']) && $_GET['agents']>0){
            $agente = addslashes($_GET['agents']);
        }
        $data['dti'] = $dti;
        $data['dtf'] = $dtf;
        $data['grupo'] = $grupo;
        $data['agente'] = $agente;
        $data['resumo_pausas'] = $r->relPausasResumoPausas($dti, $dtf, $agente);
        $this->loadView("relPausasResumo", $data);
    }

    public function pausasDetalhe() {
        $data = array();
        $data1 = array();
        $u = new Users();
        $u->setLoggedUser();
        $a = new Agentes(0);
        $r = new Reports();
        $dti = addslashes($_GET['data_inicio']).' '.addslashes($_GET['hora_inicio']);
        $dtf = addslashes($_GET['data_fim']).' '.addslashes($_GET['hora_fim']);
        $oper = 0;
        $grupo = 0;
        $agente = 0;
        if(isset($_GET['grupo']) && $_GET['grupo']>0){
            $grupo = addslashes($_GET['grupo']);
        }
        if(isset($_GET['agents']) && $_GET['agents']>0){
            $agente = addslashes($_GET['agents']);
        }
        $data['dti'] = $dti;
        $data['dtf'] = $dtf;
        $data['grupo'] = $grupo;
        $data['pausas_grupo'] = $r->relPausas($dti, $dtf,$grupo,$agente);
        $this->loadView("relPausasDetalhe", $data);
    }
}
