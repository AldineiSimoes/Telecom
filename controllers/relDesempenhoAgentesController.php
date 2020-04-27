<?php

class relDesempenhoAgentesController extends controller {

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
            $oper = 0;
            $camp = 0;
            $agente = 0;
            if (isset($_POST['oper']) && $_POST['oper'] > 0) {
                $oper = addslashes($_POST['oper']);
            }
            if (isset($_POST['camp']) && $_POST['camp'] > 0) {
                $camp = addslashes($_POST['camp']);
            }
            if (isset($_POST['agents']) && $_POST['agents'] > 0) {
                $agente = addslashes($_POST['agents']);
            }
            $data['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $data['p'] = intval($_GET['p']);
                if ($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = ( 25 * ($data['p'] - 1));
            $data['p_count'] = $d->searchRecords($dti, $dtf, $oper, $camp, $agente, $ddd, $tel, -1);
            $data['record_list'] = $d->searchRecords($dti, $dtf, $oper, $camp, $agente, $ddd, $tel, $offset);
            $data['idgrav'] = '1';
        }
        //              if($u->hasPermission('supervisor')) {
        $data['agents_list'] = $a->agentesList();
        $data['campanha_list'] = $c->campanhaList($user);
        if ($u->hasPermission('Tabulacoes')) {
            $this->loadTemplate('relDesempenhoAgentes', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function desempenhoAgentes() {
        $data = array();
        $data1 = array();
        $u = new Users();
        $u->setLoggedUser();
        $a = new Agentes(0);
        $c = new Campanhas(0);
        $d = new Diversos();
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])){
            $offset = 0;
            $dti = addslashes($_POST['data_inicio']).' '.addslashes($_POST['hora_inicio']);
            $dtf = addslashes($_POST['data_fim']).' '.addslashes($_POST['hora_fim']);
            $oper = 0;
            $camp = 0;
            $agente = 0;
            if(isset($_POST['oper']) && $_POST['oper']>0){
                $oper = addslashes($_POST['oper']);
            }
            if(isset($_POST['camp']) && $_POST['camp']>0){
                $camp = addslashes($_POST['camp']);
            }
            if(isset($_POST['agents']) && $_POST['agents']>0){
                $agente = addslashes($_POST['agents']);
            }
            // $data['p'] = 1;
            // if(isset($_POST['p']) && !empty($_POST['p'])) {
            //     $data['p'] = intval($_POST['p']);
            //     if($data['p'] == 0) {
            //         $data['p'] = 1;
            //     }
            // }
            // $offset = ( 25 * ($data['p']-1));
//            $data['p_count'] = $d->searchRecords($dti,$dtf,$oper,$camp,$agente,$ddd,$tel,-1);
            $data['desempenho_list'] = $d->resumoOperacional($dti, $dtf, $oper, $camp, $agente);
            $data['idgrav'] = '1';
            $this->loadView("relDesempenhoAgentesSel", $data);
        }
        //print_r($data['record_list']);exit;
    }

    public function desempenhoAgentesExcel() {
        $data = array();
        $data1 = array();
        $u = new Users();
        $u->setLoggedUser();
        $a = new Agentes(0);
        $c = new Campanhas(0);
        $d = new Diversos();
        $dti = addslashes($_GET['data_inicio']).' '.addslashes($_GET['hora_inicio']);
        $dtf = addslashes($_GET['data_fim']).' '.addslashes($_GET['hora_fim']);
        $oper = 0;
        $camp = 0;
        $agente = 0;
        if(isset($_GET['oper']) && $_GET['oper']>0){
            $oper = addslashes($_GET['oper']);
        }
        if(isset($_GET['camp']) && $_GET['camp']>0){
            $camp = addslashes($_GET['camp']);
        }
        if(isset($_GET['agents']) && $_GET['agents']>0){
            $agente = addslashes($_GET['agents']);
        }
        $data['desempenho_list'] = $d->resumoOperacional($dti, $dtf, $oper, $camp, $agente);
        $this->loadView("relDesempenhoAgentesExcel", $data);
    }

}
