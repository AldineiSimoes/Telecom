<?php

class relDesempenhoGrupoController extends controller {

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
            $offset = 0;
            $dti = addslashes($_POST['data_inicio']) . ' 00:00:00';
            $dtf = addslashes($_POST['data_fim']) . ' 23:59:39';
            $oper = 0;
            $camp = 0;
            $agente = 0;
            $ddd = 0;
            $tel = 0;
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
//            if($u->hasPermission('supervisor')) {
        $data['operacao_list'] = $d->listTipoOperacao();
        $data['group_list'] = $g->getList();
        $data['agents_list'] = $a->agentesList();
        $data['campanha_list'] = $c->campanhaList($user);
        if ($u->hasPermission('Desempnho do Grupo')) {
            $this->loadTemplate('relDesempenhoGrupo', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function selGrupo($idcamp) {
        $g = new Group();
        $data['group'] = $g->getGrupoCampanha($idcamp);
        echo json_encode($data);
    }

    public function relDesempenhoGrupo() {
        $data = array();
        $r = new Reports();
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])) {
            $offset = 0;
            $dti = addslashes($_POST['data_inicio']) . ' 00:00:00';
            $dtf = addslashes($_POST['data_fim']) . ' 23:59:39';
            $oper = 0;
            $camp = 0;
            $grupo = 0;
            if (isset($_POST['operacao']) && $_POST['operacao'] > 0) {
                $oper = addslashes($_POST['operacao']);
            }
            if (isset($_POST['camp']) && $_POST['camp'] > 0) {
                $camp = addslashes($_POST['camp']);
            }
            if (isset($_POST['grupo']) && $_POST['grupo'] > 0) {
                $grupo = addslashes($_POST['grupo']);
            }
        }
        $data['desempenho_total'] = $r->resDesempenhoTotal($dti, $dtf, $oper, $grupo, $camp);
        $data['desempenho_list'] = $r->resDesempenho($dti, $dtf, $oper, $grupo, $camp);
        $this->loadView("relDesempenhoGrupoView", $data);
    }

}
