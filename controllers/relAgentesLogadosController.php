<?php

class relAgentesLogadosController extends controller {

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
            $offset = 0;
            $dti = addslashes($_POST['data_inicio']) . ' 00:00:00';
            $dtf = addslashes($_POST['data_fim']) . ' 23:59:39';
            $offset = ( 25 * ($data['p'] - 1));
        }
        if ($u->hasPermission('Agentes Logados')) {
            $this->loadTemplate('relAgentesLogados', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function agentesLogados(){
        $data = array();
        $data1 = array();
        $u = new Users();
        $u->setLoggedUser();
        $r = new Reports();
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])){
            $dti = addslashes($_POST['data_inicio']).' 00:00:00';
            $dtf = addslashes($_POST['data_fim']).' 23:59:39';
            $data['agentes_logados'] = $r->agentesLogados($dti, $dtf);
            $this->loadView("relAgentesLogadosSel", $data);
        }

    }

}
