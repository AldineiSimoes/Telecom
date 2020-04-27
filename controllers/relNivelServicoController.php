<?php

class relNivelServicoController extends controller {

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
        $user = $u->getId();
        $data['user_name'] = $u->getName();
        $data['title'] = 'RELATORIOS';
        $g = new Group();
        $c = new Campanhas(0);
        $d = new Diversos();
        if ($u->hasPermission('Ligacoes')) {
            $data['group_list'] = $g->getList();
            $data['campanha_list'] = $c->campanhaList($user);
            $data['operacao_list'] = $d->listTipoOperacao();
            $this->loadTemplate('relNivelServico', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function getNivelServico($tipo=0){
        $data = array();
        $r = new Reports();
        $data['tipo'] = $tipo;
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])) {
            $offset = 0;
            $dti = addslashes($_POST['data_inicio']) . ' 00:00:00';
            $dtf = addslashes($_POST['data_fim']) . ' 23:59:39';
            $oper = 0;
            $camp = 0;
            $grupo = 0;
            // if (isset($_POST['operacao']) && $_POST['operacao'] > 0) {
            //     $oper = addslashes($_POST['operacao']);
            // }
            if (isset($_POST['camp']) && $_POST['camp'] > 0) {
                $camp = addslashes($_POST['camp']);
            }
            if (isset($_POST['grupo']) && $_POST['grupo'] > 0) {
                $grupo = addslashes($_POST['grupo']);
            }
        }
        $data['nivel_list'] = $r->nivelServico($dti, $dtf, $grupo,$camp);
        $this->loadView("relNivelServicoSel", $data);
    }

    public function getNivelServicoDetalhe(){
        $data = array();
        $r = new Reports();
        $dti = $_GET['data_inicio'] . ' 00:00:00';
        $dtf = $_GET['data_fim'] . ' 23:59:59';
        $grupo = 0;
        $camp = 0;
        $agente = 0;
        $ddd = 0;
        $tel = 0;
        if (isset($_GET['camp']) && $_GET['camp'] > 0) {
            $camp = addslashes($_GET['camp']);
        }
        if (isset($_GET['agents']) && $_GET['agents'] > 0) {
            $agente = addslashes($_GET['agents']);
        }
        if (isset($_GET['OperadoraLig']) && $_GET['OperadoraLig'] > 0) {
            $operadora = addslashes($_GET['OperadoraLig']);
        }
        if (isset($_GET['ddd']) && $_GET['ddd'] != '') {
            $ddd = addslashes($_GET['ddd']);
        }
        if (isset($_GET['fone']) && $_GET['fone'] != '') {
            $tel = addslashes($_GET['fone']);
        }
        $data['nivel_list'] = $r->nivelServicoDetalhe($dti, $dtf, $grupo,$camp);
        $this->loadView("relNivelServicoDetalhe", $data);
    }
}
