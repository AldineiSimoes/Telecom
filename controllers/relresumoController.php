<?php

class relresumoController extends controller {

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
        $data['user_name'] = $u->getName();
        $data['title'] = 'RELATORIOS';
        if ($u->hasPermission('Resumo')) {
            $data['group_list'] = $g->getList();
            $this->loadTemplate('relresumo', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function relresumoDetalhe() {
        $data = array();
        $d = new Diversos();
        $dti = $_GET['data_inicio'] . ' 00:00:00';
        $dtf = $_GET['data_fim'] . ' 23:59:59';
        $ddd = 0;
        $grupo = 0;
        if (isset($_GET['grupo']) && $_GET['grupo'] > 0) {
            $grupo = addslashes($_GET['grupo']);
        }
        if (isset($_GET['ddd']) && $_GET['ddd'] != '') {
            $ddd = addslashes($_GET['ddd']);
        }
        $data['relResumo'] = $d->resumoLig($dti, $dtf, $grupo, $ddd);
        $this->loadView("relResumo_view", $data);
    }

}
