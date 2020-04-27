<?php

class relTabulacoesController extends controller {

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
        $o = new Operadoras();
        $u->setLoggedUser();
        $user = $u->getId();
        $data['user_name'] = $u->getName();
        $data['title'] = 'RELATORIOS';
        $g = new Group();
        $a = new Agentes(0);
        $c = new Campanhas(0);
        $d = new Diversos();
        $t = new Tabulacao();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['group_list'] = $g->getList();
        $data['agents_list'] = $a->agentesList();
        $data['campanha_list'] = $c->campanhaList($user);
        $data['tipotab_list'] = $t->tipotab();
        if ($u->hasPermission('Tabulacoes')) {
            $this->loadTemplate('relTabulacoes', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function getDetalhe(){
        $data = array();
        $r = new Reports();
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])) {
            $offset = 0;
            $dti = addslashes($_POST['data_inicio']).' '.addslashes($_POST['hora_inicio']);
            $dtf = addslashes($_POST['data_fim']).' '.addslashes($_POST['hora_fim']);
            $oper = 0;
            $camp = 0;
            $grupo = 0;
            $agente = 0;
            $ddd = 0;
            $tel = '';
            if (isset($_POST['oper']) && $_POST['oper'] > 0) {
                $oper = addslashes($_POST['oper']);
            }
            if (isset($_POST['camp']) && $_POST['camp'] > 0) {
                $camp = addslashes($_POST['camp']);
            }
            if (isset($_POST['grupo']) && $_POST['grupo'] > 0) {
                $grupo = addslashes($_POST['grupo']);
            }
            if (isset($_POST['camp']) && $_POST['camp'] > 0) {
                $camp = addslashes($_POST['camp']);
            }
            if (isset($_POST['agents']) && $_POST['agents'] > 0) {
                $agente = addslashes($_POST['agents']);
            }
            if (isset($_POST['ddd']) && $_POST['ddd'] != '') {
                $ddd = addslashes($_POST['ddd']);
            }
            if (isset($_POST['fone']) && $_POST['fone'] != '') {
                $tel = addslashes($_POST['fone']);
            }
            $data['dti'] = $dti;
            $data['dtf'] = $dtf;
            $data['grupo'] = $grupo;
            $data['camp'] = $camp;
            $data['agente'] = $agente;
            $data['ddd'] = $ddd;
            $data['tel'] = $tel;
            $data['tab_list'] = $r->tabulacaoDetalhe($dti, $dtf, $grupo,$camp, $agente, $ddd, $tel);
            $this->loadView("relTabulacaoDetalhe", $data);
        }
    }

    public function tabulacoesExcel(){
        $data = array();
        $r = new Reports();
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])) {
            $offset = 0;
            $dti = addslashes($_GET['data_inicio']).' '.addslashes($_GET['hora_inicio']);
            $dtf = addslashes($_GET['data_fim']).' '.addslashes($_GET['hora_fim']);
            $agente = addslashes($_GET['agente']);
            $camp = addslashes($_GET['camp']);
            $grupo = addslashes($_GET['grupo']);
            $tel = addslashes($_GET['fone']);
            $ddd = addslashes($_GET['ddd']);
            if ($camp==''){
                $camp = 0;
            }
            if ($camp==''){
                $grupo = 0;
            }
            if ($camp==''){
                $agente = 0;
            }
            if ($camp==''){
                $ddd = 0;
            }
            $data['tab_list'] = $r->tabulacaoDetalhe($dti, $dtf, $grupo,$camp, $agente, $ddd, $tel,0,100000);
            $this->loadView("relTabulacaoExcel", $data);
        }
    }

}
