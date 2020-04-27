<?php

class recordingController extends controller {

    public function __construct() {
        //parent::__construct();
        $user = new Users();
        $acesso = 0;
        if ($user->isLogged() == false) {
            header("Location: " . BASE_URL . "/login");
        }
    }

    public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $g = new Group();
        $a = new Agentes(0);
        $c = new Campanhas(0);
        $d = new Diversos();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'GRAVAÇOES';
        $data['p_count'] = 0;
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])) {
            $offset = 0;
            $dti = addslashes($_POST['data_inicio']) .' '. addslashes($_POST['hora_inicio']);
            $dtf = addslashes($_POST['data_fim']) . ' '.addslashes($_POST['hora_fim']);
            $oper = 0;
            $camp = 0;
            $agente = 0;
            $ddd = 0;
            $tel = 0;
            $limit = 10;
            if (isset($_POST['oper']) && $_POST['oper'] > 0) {
                $oper = addslashes($_POST['oper']);
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
            if (isset($_POST['qtpg']) && $_POST['qtpg'] != '') {
                $limit = addslashes($_POST['qtpg']);
            }
            $data['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $data['p'] = intval($_GET['p']);
                if ($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = ( $limit * ($data['p'] - 1));
            $data['p_count'] = $d->searchRecords($dti, $dtf, $oper, $camp, $agente, $ddd, $tel, -1,$limit);
            $data['record_list'] = $d->searchRecords($dti, $dtf, $oper, $camp, $agente, $ddd, $tel, $offset,$limit);
            $data['idgrav'] = '1';
        }
        if ($u->hasPermission('Gravacoes')) {
            $data['group_list'] = $g->getList($u->getCompany());
            $data['agents_list'] = $a->agentesList();
            $data['campanha_list'] = $c->campanhaList($user);
            $this->loadTemplate('recording', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }
    public function listRecords() {
        $data = array();
        $data1 = array();
        $u = new Users();
        $u->setLoggedUser();
        $g = new Group();
        $a = new Agentes(0);
        $c = new Campanhas(0);
        $d = new Diversos();
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])){
            $offset = 0;
            // $dti = addslashes($_POST['data_inicio']).' 00:00:00';
            // $dtf = addslashes($_POST['data_fim']).' 23:59:39';
            $dti = addslashes($_POST['data_inicio']) .' '. addslashes($_POST['hora_inicio']);
            $dtf = addslashes($_POST['data_fim']) . ' '.addslashes($_POST['hora_fim']);

            $oper = 0;
            $camp =0;
            $agente = 0;
            $ddd = 0;
            $tel = 0;
            $limit = 10;
            if(isset($_POST['oper']) && $_POST['oper']>0){
                $oper = addslashes($_POST['oper']);
            }
            if(isset($_POST['camp']) && $_POST['camp']>0){
                $camp = addslashes($_POST['camp']);
            }
            if(isset($_POST['agents']) && $_POST['agents']>0){
                $agente = addslashes($_POST['agents']);
            }
            if(isset($_POST['ddd']) && $_POST['ddd']!=''){
                $ddd = addslashes($_POST['ddd']);
            }
            if(isset($_POST['fone']) && $_POST['fone']!=''){
                $tel = addslashes($_POST['fone']);
            }
            if(isset($_POST['qtpg']) && $_POST['qtpg']!=''){
                $limit = addslashes($_POST['qtpg']);
            }
            $data['p'] = 1;
            if(isset($_POST['p']) && !empty($_POST['p'])) {
                $data['p'] = intval($_POST['p']);
                if($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = ( $limit * ($data['p']-1));
            $data['limit'] = $limit;
            $data['p_count'] = $d->searchRecords($dti,$dtf,$oper,$camp,$agente,$ddd,$tel,-1,$limit);
            $data['record_list'] = $d->searchRecords($dti,$dtf,$oper,$camp,$agente,$ddd,$tel,$offset,$limit);
            $data['idgrav'] = '1';
        }
        //print_r($data['record_list']);exit;
        $this->loadView("recordingSel", $data);
    }

}
