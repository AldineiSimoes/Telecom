<?php

class rotasController extends controller {

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
        $g = new Group();
        $o = new Operadoras();
        $r = new Rotas();
        $data['user_name'] = $u->getName();
        $data['title'] = 'CAMPANHAS';
        $data['title2'] = 'ROTAS';
        $data['idgroup'] = '';
        if ($u->hasPermission('Rotas')) {
            $data['group_list'] = $g->getList();
            $data['operadoras_list'] = $o->listOperadoras();
            $this->loadTemplate('rotas', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function rotas_sel($group) {
        $data = array();
        $o = new Operadoras();
        $r = new Rotas();
        $d = new Diversos();
        $data['operadoras_list'] = $o->listOperadoras();
        $data['rota_info'] = $r->listRotas($group);
        $data['mod_list'] = $d->listModalidades();
        $this->loadView("rotas_sel", $data);
    }

    public function rotas_save($group) {
        $r = new Rotas();
        $l = new Logs();
        $u = new Users();
        $u->setLoggedUser();
        $modalidade = $_POST['modalidade'];
        $oper = $_POST['oper'];
        $r->saveRotas($group, $modalidade, $oper);
        $l->setRota($group, $modalidade, $oper,$u->getName());
    }

}
