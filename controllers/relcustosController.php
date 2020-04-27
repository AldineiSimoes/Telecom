<?php

class relcustosController extends controller {

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
        $c = new Campanhas(0);
        $d = new Diversos();
//              if($u->hasPermission('supervisor')) {
        $data['group_list'] = $g->getList();
        $data['campanha_list'] = $c->campanhaList($user);
        $data['operadoras_list'] = $o->listOperadoras();
        if ($u->hasPermission('Custos')) {
            $this->loadTemplate('relcustos', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function relcustosDetalhe() {
        $data = array();
        $r = new Reports();
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])) {
            $offset = 0;
            $dti = addslashes($_POST['data_inicio']) . ' 00:00:00';
            $dtf = addslashes($_POST['data_fim']) . ' 23:59:39';
            $oper = 0;
            $camp = 0;
            $grupo = 0;
            $ddd = 0;
            $operadora = 0;
            if (isset($_POST['oper']) && $_POST['oper'] > 0) {
                $oper = addslashes($_POST['oper']);
            }
            if (isset($_POST['camp']) && $_POST['camp'] > 0) {
                $camp = addslashes($_POST['camp']);
            }
            if (isset($_POST['grupo']) && $_POST['grupo'] > 0) {
                $grupo = addslashes($_POST['grupo']);
            }
            if (isset($_POST['operadora']) && $_POST['operadora'] > 0) {
                $operadora = addslashes($_POST['operadora']);
            }
            if (isset($_POST['ddd']) && $_POST['ddd'] != '') {
                $ddd = addslashes($_POST['ddd']);
            }
        }
        $data['resumo_list'] = $r->resCustos($dti, $dtf, $oper, $grupo, $camp, $operadora, $ddd);
        $this->loadView("relCustos_view", $data);
    }

    public function relCustosExcel() {
        $data = array();
        $r = new Reports();
        $dti = addslashes($_GET['data_inicio']) . ' 00:00:00';
        $dtf = addslashes($_GET['data_fim']) . ' 23:59:39';
        $oper = addslashes($_GET['oper']);
        $camp = addslashes($_GET['camp']);
        $grupo = addslashes($_GET['grupo']);
        $operadora = addslashes($_GET['operadora']);
        $ddd = addslashes($_GET['ddd']);
        $data['custos_list'] = $r->analiticoCustos($dti, $dtf, $oper, $grupo, $camp, $operadora, $ddd);
        $this->loadView("relCustos_Detalhe", $data);
    }

}
