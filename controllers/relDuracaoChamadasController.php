<?php

class relDuracaoChamadasController extends controller {

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
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['p_count'] = 0;
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])) {
            $dti = addslashes($_POST['data_inicio']) . ' 00:00:00';
            $dtf = addslashes($_POST['data_fim']) . ' 23:59:39';
            $grupo = 0;
            if (isset($_POST['grupo']) && $_POST['grupo'] > 0) {
                $grupo = addslashes($_POST['grupo']);
            }
        }
        //              if($u->hasPermission('supervisor')) {
        $data['group_list'] = $g->getList(1);
        $data['agents_list'] = $a->agentesList();
        $data['campanha_list'] = $c->campanhaList($user);
        if ($u->hasPermission('Duracao das Chamadas')) {
            $this->loadTemplate('relDuracaoChamadas', $data);
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
            $dti = addslashes($_POST['data_inicio']).' 00:00:00';
            $dtf = addslashes($_POST['data_fim']).' 23:59:39';
            $grupo = 0;
            if (isset($_POST['grupo']) && $_POST['grupo'] > 0) {
                $grupo = addslashes($_POST['grupo']);
            }
            $data['duracao_chamadas'] = $r->getDuracaoChamadas($dti, $dtf,$grupo);
            $this->loadView("relDuracaoChamadasSel", $data);
        }
    }

}
